<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Log;

use App\Models\Address;
use App\Models\Order;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\User;
use App\Models\OrderStatusTxn;
use App\Notifications\NewOrderNotification;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function categories()
    {
        $data = ProductCategory::get();
        return view('admin.order.booking.category', compact('data'));
    }

    public function subCategories($slug, $id)
    {
        $category = ProductCategory::findOrFail($id);
        $products = Product::with(['variations.variationType', 'variations.variationValue'])
            ->where('category_id', $category->id)
            ->get();
        return view('admin.order.booking.sub_category', compact('products', 'category'));
    }

    public function bookingDetails($slug)
    {
        $product = Product::with(['variations.variationType', 'variations.variationValue', 'variations.allValues'])
            ->where('slug', $slug)
            ->first();
        return view('admin.order.booking.add_booking', compact('product'));
    }

    public function ordereStore(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits_between:8,15',
            'address' => 'required|string|max:500',
            'country' => 'required|exists:countries,id',
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',
            'zipcode' => 'required|digits:6',
            'variations' => 'required|array',
            'variations.*' => 'required|string|max:255',
            'remark' => 'nullable|string|max:500',
            'file' => 'nullable|file|mimes:pdf,jpg,png|max:30720',
        ]);

        DB::beginTransaction();

        try {

            // 🔵 ORDER START
            Log::channel('processing')->info('ORDER PROCESS STARTED', [
                'user_id' => $user->id
            ]);

            $product = Product::findOrFail($request->product_id);
            $qty = (int) $request->quantity;
            $basePrice = (float) $product->disc_price;

            $extraCharges = 0;
            foreach ((array) $product->charge_details as $charge) {
                if (
                    isset($charge['name']) &&
                    $request->has($charge['name']) &&
                    $request->input($charge['name']) === 'yes'
                ) {
                    $extraCharges += (float) $charge['charge'];
                }
            }

            $subtotal = ($basePrice * $qty) + ($extraCharges * $qty);
            $gst = round($subtotal * 0.18, 2);
            $finalAmount = round($subtotal + $gst, 2);

            // 🔵 WALLET CHECK
            $wallet = Wallet::where('user_id', $user->id)->first();
            $walletBalance = $wallet ? $wallet->main_balance : 0;

            Log::channel('processing')->info('Wallet check started', [
                'wallet_balance' => $walletBalance,
                'order_amount' => $finalAmount
            ]);

            if (!$wallet || $walletBalance < $finalAmount) {

                Log::channel('processing')->warning('Insufficient wallet balance', [
                    'wallet_balance' => $walletBalance,
                    'required' => $finalAmount
                ]);

                DB::rollBack();
                return response()->json([
                    'errors' => ['wallet' => ['Insufficient wallet balance']]
                ], 500);
            }

            // 🔵 ORDER CREATE
            $client = User::updateOrCreate([
                'name' => $request->name,
                'phone_number' => $request->phone,
                'role_id' => 4
            ]);

            $address = Address::updateOrCreate(
                ['user_id' => $client->id],
                [
                    'type' => 'Home',
                    'address' => $request->address,
                    'country_id' => $request->country,
                    'state_id' => $request->state,
                    'city_id' => $request->city,
                    'zip' => $request->zipcode,
                    'default' => 'Yes',
                ]
            );

            $productDetails = json_encode([
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $basePrice,
                'quantity' => $qty,
                'extra_charges' => $extraCharges,
                'variations' => $request->variations ?? [],
                'remark' => $request->remark ?? null,
            ]);

            $order = Order::create([
                'code' => 'ORD-' . strtoupper(uniqid()),
                'order_by_id' => $user->id,
                'user_id' => $client->id,
                'product_details' => $productDetails,
                'payment_type' => 'wallet',
                'payment_status' => 'Pending',
                'total_amount' => $subtotal,
                'order_tax' => $gst,
                'final_amount_with_tax' => $finalAmount,
                'payment_status_id' => 1,
                'order_status_id' => 1,
            ]);

            Log::channel('processing')->info('Order created', [
                'order_id' => $order->id
            ]);

            // 🔵 WALLET DEBIT
            $ledgerResponse = Helper::debit_ledger([
                "user_id" => $user->id,
                "amount" => $finalAmount,
                "trans_id" => Helper::getTransId(3),
                "refrence_id" => $order->id,
                "cgst" => 0,
                "sgst" => 0,
                "ledger_type" => 'WALLET DEBIT',
                "trans_from" => 'ORDER',
                "description" => "Debited for Order {$order->code}",
                "wallet_type" => 1,
            ]);

            if ($ledgerResponse['status'] !== 'success') {

                Log::channel('processing')->error('Wallet debit failed', [
                    'order_id' => $order->id
                ]);

                DB::rollBack();
                return response()->json(['message' => 'Wallet debit failed'], 500);
            }

            // Update payment status to Success
            $order->update([
                'payment_status' => 'Success',
                'payment_status_id' => 2,
            ]);

            Log::channel('processing')->info('Wallet amount debited', [
                'amount' => $finalAmount
            ]);

            DB::commit();

            Log::channel('processing')->info('ORDER PROCESS COMPLETED', [
                'order_id' => $order->id
            ]);

            return response()->json([
                'success' => true,
                'redirect' => url('/user/thankyou')
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            Log::channel('processing')->error('ORDER PROCESS FAILED', [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

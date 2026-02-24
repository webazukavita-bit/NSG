<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Address;
use App\Models\Order;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\User;
use App\Models\OrderStatusTxn;
use App\Notifications\NewOrderNotification;
use App\Models\Wallet;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'product_id'     => 'required|exists:products,id',
            'quantity'       => 'required|integer|min:1',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'required|digits_between:8,15',
            'address'   => 'required|string|max:500',
            'country'   => 'required|exists:countries,id',
            'state'     => 'required|exists:states,id',
            'city'      => 'required|exists:cities,id',
            'zipcode'   => 'required|digits:6',

            'variations'     => 'required|array',
            'variations.*'   => 'required|string|max:255',

            'remark' => 'nullable|string|max:500',
            'file' => 'nullable|file|mimes:pdf,jpg,png|max:30720',

        ]);
        // dd($request->all());
        DB::beginTransaction();

        try {

            $product = Product::findOrFail($request->product_id);
            $qty        = (int) $request->quantity;
            $basePrice = (float) $product->disc_price;
            $totalamount = $basePrice * $qty;
            $extraCharges = 0;
            $selectedCharges = [];

            foreach ((array) $product->charge_details as $charge) {

                $chargeName = $charge['name'] ?? null;
                $chargeAmount = (float) ($charge['charge'] ?? 0);

                if (
                    $chargeName &&
                    $request->has($chargeName) &&
                    $request->input($chargeName) === 'yes'
                ) {
                    $extraCharges += $chargeAmount;

                    $selectedCharges[] = [
                        'name'   => $chargeName,
                        'charge' => $chargeAmount,
                    ];
                }
            }
            // dd($selectedCharges);
            $subtotal = ($basePrice * $qty) + ($extraCharges * $qty);
            $gst = round($subtotal * 0.18, 2);
            $finalAmount = round($subtotal + $gst, 2);

            // dd($totalamount, $subtotal, $finalAmount);
            $wallet = Wallet::where('user_id', $user->id)->first();

            if (!$wallet || $wallet->main_balance < $finalAmount) {
                DB::rollBack();

                return response()->json([
                    'errors' => [
                        'wallet' => ['Insufficient wallet balance']
                    ]
                ], 500);
            }


            $client = User::updateOrCreate([
                // 'code'     => Helper::getTransId(4),
                'name'     => $request->name,
                // 'email'    => $request->email,
                'phone_number' => $request->phone,
                // 'password' => Hash::make($request->phone),
                'role_id'  => 4
            ]);

            $address = Address::updateOrCreate(
                ['user_id' => $client->id],
                [
                    'type'       => 'Home',
                    'address'    => $request->address,
                    'country_id' => $request->country,
                    'state_id'   => $request->state,
                    'city_id'    => $request->city,
                    'zip'        => $request->zipcode,
                    'default'    => 'Yes',
                ]
            );

            $maxFileSizeMB = 10; // Default to 10 MB
            if ($product->category && $product->category->file_size) {
                $maxFileSizeMB = $product->category->file_size;
            }

            $maxSizeKB = $maxFileSizeMB * 1024;

            $request->validate([
                'file' => "nullable|file|mimes:pdf|max:$maxSizeKB",
            ], [
                'file.max' => "File size must not exceed $maxFileSizeMB MB",
            ]);

            $path = null;

            if ($request->hasFile('file')) {
                $fileName = 'variant_' . time() . '.' . $request->file->getClientOriginalExtension();
                $request->file->move(public_path('images/order'), $fileName);
                $path = $fileName;
            }


            $order = Order::create([
                'code'       => 'ORD-' . strtoupper(uniqid()),
                'order_by_id' => $user->id,
                'user_id'    => $client->id,

                'payment_type' => 'wallet',
                'payment_status' => 'Pending',

                'address' => json_encode([
                    'address' => $address->address,
                    'city'    => $address->city->name,
                    'state'   => $address->state->name,
                    'country' => $address->country->name,
                    'zip'     => $address->zip,
                ]),

                'product_details' => json_encode([
                    'product_id'    => $product->id,
                    'price'         => $basePrice,
                    'quantity'      => $qty,
                    'extra_charges' => $extraCharges,
                    'variations'    => $request->variations,
                ]),

                'total_amount' => $totalamount,
                'final_amount_without_tax' => $subtotal,
                'order_tax'                => $gst,
                'final_amount_with_tax'    => $finalAmount,
                'tax_type'                 => 'GST',
                'order_status_id'          => 1,
                'payment_status_id'        => 1,

                'remark' => $request->remark,
                'files'  => $path,
            ]);


            $ledgerResponse = Helper::debit_ledger([
                "user_id"      => $user->id,
                "refrence_id"  => auth()->id(),
                "amount"       => $finalAmount,
                "trans_id"     => Helper::getTransId(3),
                "cgst"         => 0,
                "sgst"         => 0,
                "ledger_type"  => 'WALLET DEBIT',
                "wallet_type"  => 1,
                "trans_from"   => 'Wallet',
                "description"  => "Debited for Order ID: {$order->code}",
            ]);

            if ($ledgerResponse["status"] != "success") {
                DB::rollBack();

                return response()->json([
                    'message' => '',
                ], 500);
            }

            // Update payment status to Success (ID 2) after successful wallet debit
            $order->update([
                'payment_status_id' => 2, // Success
            ]);

            try {
                $txn = OrderStatusTxn::create([
                    'order_id' => $order->id,
                    'order_status_id' => $order->order_status_id ?? 1,
                    'payment_status_id' => 2, // Success
                    'm11_creatby_user_type' => 'user',
                    'created_by_id' => $user->id,
                    'description' => 'Payment received via wallet',
                    'documents' => null,
                ]);
            } catch (\Exception $e) {
                // Log but don't fail the whole flow
                // logger()->error('Failed to create OrderStatusTxn: ' . $e->getMessage());
            }
            // Mark order as paid and attach ledger id if available
            try {
                $orderUpdate = [
                    'payment_status' => 'Paid',
                    'payment_status_id' => 2, // 2 = paid (used across app)
                ];

                $order->update($orderUpdate);


                try {
                    $txn = OrderStatusTxn::create([
                        'order_id' => $order->id,
                        'order_status_id' => $order->order_status_id ?? 1,
                        'payment_status_id' => $order->payment_status_id ?? 2,
                        'm11_creatby_user_type' => 'user',
                        'created_by_id' => $user->id,
                        'description' => 'Payment received via wallet',
                        'documents' => null,
                    ]);
                } catch (\Exception $e) {
                    // Log but don't fail the whole flow
                    // logger()->error('Failed to create OrderStatusTxn: ' . $e->getMessage());
                }

                // Notify user about successful payment
                try {
                    $link = url('/user/orders/' . $order->id);
                    $title = 'Payment Received';
                    $message = "Your payment of Rs. {$finalAmount} for order {$order->code} has been received.";
                    $icon = 'bx bx-credit-card';
                    $user->notify(new NewOrderNotification($title, $message, $link, $icon));
                } catch (\Exception $e) {
                    // logger()->error('Failed to send payment notification: ' . $e->getMessage());
                }
            } catch (\Exception $ex) {
                DB::rollBack();
                return response()->json([
                    'message' => 'Failed to update order payment status: ' . $ex->getMessage()
                ], 500);
            }

            DB::commit();
            // Log order booking
            Helper::createOrderTrackingLog(
                $order->id,
                'ORDER BOOKED',
                'Order booked successfully by ' . $user->name . '.'
            );

            // Log file upload (if any)
            if (!empty($path)) {
                Helper::createOrderTrackingLog(
                    $order->id,
                    'FILE UPLOADED',
                    'File uploaded during order booking: ' . $path
                );
            }
            return response()->json([
                'success' => true,
                'redirect' => url('/user/thankyou')
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

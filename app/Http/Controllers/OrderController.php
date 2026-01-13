<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Address;
use App\Models\Order;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\User;
use App\Models\Wallet;
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
        ]);

        DB::beginTransaction();

        try {

            // $product = Product::with('charge_details')->findOrFail($request->product_id);
            $product = Product::findOrFail($request->product_id);
            $qty        = (int) $request->quantity;
            $basePrice = (float) $product->disc_price;
            $totalamount = $basePrice * $qty;
            $extraCharges = 0;
            $selectedCharges = [];

            foreach ((array) $product->charge_details as $charge) {

                if (
                    is_array($charge) &&
                    isset($charge['name'], $charge['charge']) &&
                    $request->filled($charge['name'])
                ) {
                    $extraCharges += (float) $charge['charge'];

                    $selectedCharges[] = [
                        'name'   => $charge['name'],
                        'charge' => (float) $charge['charge'],
                    ];
                }
            }
            $subtotal = ($basePrice + $extraCharges) * $qty;
            $gst      = round($subtotal * 0.18, 2);
            $finalAmount = round($subtotal + $gst, 2);
            // dd($totalamount, $subtotal, $finalAmount);
            $wallet = Wallet::where('user_id', $user->id)
                ->lockForUpdate()
                ->first();

            if (!$wallet || $wallet->main_balance < $finalAmount) {
                return back()->withErrors([
                    'wallet' => 'Insufficient wallet balance'
                ]);
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
            ]);

            $payment = $wallet->decrement('main_balance', $finalAmount);

            if ($payment) {

                $order->update([
                    'payment_status' => 'paid',
                    'payment_status_id' => 2
                ]);
            }
            Wallet::updateOrCreate([
                'user_id' => $user->id,
            ]);

            DB::commit();

            return back()->with('success', 'Order placed successfully using wallet');
        } catch (\Exception $e) {

            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

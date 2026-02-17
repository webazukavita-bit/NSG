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

        // Build dynamic validation based on whether product has variations
        $validationRules = [
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
            'file_option' => 'required|in:online,email',
            'remark' => 'nullable|string|max:500',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:102400',
            'variations' => 'nullable|array',
            'variations.*' => 'nullable|string|max:255',
        ];

        // Get product to check if variations should be required
        $product = Product::findOrFail($request->product_id);
        
        // Check if this product should have variations by counting its variation associations
        $hasVariations = $product->variations()->exists();
        
        if ($hasVariations) {
            // Count how many variation types should be selected
            $variationTypes = $product->variations()
                ->with('variationType')
                ->get()
                ->pluck('variationType.name')
                ->unique()
                ->count();

            if ($variationTypes > 0) {
                // Require variations array to be present and have at least the required number of entries
                $validationRules['variations'] = ['required', 'array', 'min:' . $variationTypes];
                $validationRules['variations.*'] = ['required', 'string', 'max:255'];
            }
        }

        $request->validate($validationRules, [
            'variations.required' => 'Please select all product variations',
            'variations.array' => 'Variations must be an array',
            'variations.min' => 'Please select all required product variations',
            'variations.*.required' => 'All variations must be selected',
            'file_option.required' => 'Please select a file option (Online or Email)',
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

            // Check total available balance from all wallet types
            $totalAvailableBalance = (float) $wallet->main_balance + 
                                     (float) $wallet->bonus_balance + 
                                     (float) $wallet->ref_direct_balance;

            if (!$wallet || $totalAvailableBalance < $finalAmount) {
                DB::rollBack();

                return response()->json([
                    'errors' => [
                        'wallet' => ['Insufficient wallet balance. Available: Rs.' . $totalAvailableBalance . ', Required: Rs.' . $finalAmount]
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
            
            // Set max file size (default 100 MB if not set in category)
            $fileSizeMB = $product->category->file_size ?? 100;
            $maxSizeKB = $fileSizeMB * 1024;

            $request->validate([
                'file' => "nullable|file|mimes:pdf,jpg,jpeg,png|max:$maxSizeKB",
            ], [
                'file.max' => "File size must not exceed {$fileSizeMB} MB",
                'file.mimes' => 'File must be PDF, JPG, or PNG format',
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
                "ledger_type"  => "WITHDRAWAL",
                "wallet_type"  => 1,
                "trans_from"   => 'Wallet',
                "description"  => "Debited for Order ID: {$order->code}",
            ]);

            if ($ledgerResponse["status"] != "success") {
                DB::rollBack();
                
                return response()->json([
                    'errors' => [
                        'wallet' => [$ledgerResponse["message"] ?? 'Failed to process wallet transaction']
                    ]
                ], 500);
            }

            // Mark order as paid and attach ledger id if available
            try {
                $orderUpdate = [
                    'payment_status' => 'Paid',
                    'payment_status_id' => 2, // 2 = paid (used across app)
                ];

                $order->update($orderUpdate);

                // Create an OrderStatusTxn entry recording payment
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
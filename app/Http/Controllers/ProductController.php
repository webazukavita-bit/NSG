<?php

namespace App\Http\Controllers;
use App\Models\OrderStatusTxn;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Ledger;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\ProductVariation;
use App\Models\User;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }

    public function categories()
    {
        $data = ProductCategory::withTrashed()->latest()->get();
        return view('admin.product.category.list', compact('data'));
    }

    public function categoryAdd()
    {
        return view('admin.product.category.add');
    }

    public function categoryStore(Request $request)
    {
        $request->merge(['slug' => Str::slug($request->name)]);

        $request->validate([
            'name'  => 'required|string|max:255',
            'slug'  => 'required|string|unique:categories,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $category = new ProductCategory();
        $category->name = $request->name;
        $category->slug = $request->slug;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'product_category_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/product/category'), $fileName);
            $category->image = $fileName;
        }

        $check = $category->save();

        if($check) {
            return redirect()->route('product-categories')->with('success', 'Category created successfully.');
        } else {
            return redirect()->route('product-categories')->with('error', 'Category Not created.');
        }
    }

    public function categoryEdit($id)
    {
        $data = ProductCategory::findOrFail($id);
        return view('admin.product.category.edit', compact('data'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $request->merge(['slug' => Str::slug($request->name)]);

        $request->validate([
            'name'  => 'required|string|max:255',
            'slug'  => 'required|string|unique:categories,slug,'.$id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $category = ProductCategory::findOrFail($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        
        if ($request->hasFile('image')) {
                
            if ($category->image && file_exists(public_path('images/product/category/'.$category->image))) {
                unlink(public_path('images/product/category/'.$category->image));
            }

            $file = $request->file('image');
            $fileName = 'product_category_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/product/category'), $fileName);
            $category->image = $fileName;
        }

        $check = $category->save();

        if($check) {
            return redirect()->route('product-categories')->with('success', 'Category updated successfully.');
        } else {
            return redirect()->route('product-categories')->with('error', 'Category not updated.');
        }
    }

    public function categoryDelete($id)
    {
        $data = ProductCategory::withTrashed()->findOrFail($id);
        
        if ($data->trashed()) {
            $data->restore();
            $message = 'Product restored successfully!';
        } else {
            $data->delete();
            $message = 'Product deleted successfully!';
        }

        return redirect()->route('product-categories')->with('success', $message);
    }

    public function products(Request $request)
    {
        $category = ProductCategory::withTrashed()->latest()->get();
        
        if(empty($request->category_id)) {
            $request->merge(['category_id' => $category[0]->id??'0']);
        }
        $data = Product::with('category')->withTrashed()->latest()->get();

        return view('admin.product.list', compact('data','category'));
    }

    public function productAdd()
    {
        $category = ProductCategory::get();
        $brand = Brand::get();
        $variationType= Variation::where('parent_id',0)->get();
        $variationValue = Variation::whereNot('parent_id',0)->get();

        return view('admin.product.add', compact('category', 'brand','variationType','variationValue'));
    }

    public function productStore(Request $request)
    {
        $request->merge(['slug' => Str::slug($request->name)]);

        $validated = $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'slug' => 'required|string|unique:products,slug|min:3|max:255',
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sku' => 'required|string|max:100',
            'price' => 'required|numeric',
            'disc_price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'content' => 'required|string',
            'additional_name.*' => 'nullable|string',
            'charge.*' => 'nullable|numeric',
            'variation_type' => 'required|array|min:1',
            'variation_type.*' => 'required|exists:variations,id',
            'variation_value' => 'required|array|min:1',
            'variation_value.*' => 'required|exists:variations,id',

        ],[
            'slug.unique' => 'this product name is already exist'
        ]);



      DB::beginTransaction();
      try{

        $charges = [];
        $additionalNames = $request->additional_name;
        $chargeAmounts = $request->charge;

        foreach ($additionalNames as $index => $name) {
            $amount = $chargeAmounts[$index] ?? null;
            if ($name && $amount !== null) {
                $charges[] = [
                    'name' => $name,
                    'charge' => (float) $amount,
                ];
            }
        }
          
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->disc_price = $request->disc_price;
        $product->stock_quantity = $request->stock_quantity;
        $product->specifications = $request->content;
        $product->charge_details = $charges;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'product_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/product'), $fileName);
            $product->image = $fileName;
        }
         $product->save();

       
            $variationTypes = $request->variation_type;
            $variationValues = $request->variation_value;

                foreach ($variationTypes as $index => $typeId) {
                    $valueId = $variationValues[$index] ?? null;
                    if ($valueId) {
                        ProductVariation::create([
                            'product_id' => $product->id,
                            'variation_type_id' => $typeId,
                            'variation_value_id' => $valueId,
                        ]);
                    }
                }

            DB::commit();

      } catch(\Exception $e){
        DB::rollBack();
         if ($fileName && file_exists(public_path('images/product/'.$fileName))) { unlink(public_path('images/product/'.$fileName)); 
        }

         return redirect()->route('products')->with('error', 'Something went wrong:'.$e->getMessage());
      }
            return redirect()->route('products')->with('success', 'Product created successfully.');
    }

    public function productEdit($id)
    {
        $category = ProductCategory::get();
        $data = Product::withTrashed()->findOrFail($id);
        $brand = Brand::get();

    $variationType = Variation::where('parent_id', 0)->get();

    $variationValue = Variation::where('parent_id', '!=', 0)->get();
        return view('admin.product.edit', compact('data', 'category', 'brand','variationType','variationValue'));
    }

    public function productUpdate(Request $request, $id)
    {
        $request->merge(['slug' => Str::slug($request->name)]);
        
        $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100',
            'price' => 'required|numeric',
            'disc_price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'slug' => 'required|string|min:3|max:255|unique:products,slug,'.$id,
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
             'additional_name.*' => 'nullable|string',
            'charge.*' => 'nullable|numeric',
            'variation_type' => 'required|array|min:1',
            'variation_type.*' => 'required|exists:variations,id',
            'variation_value' => 'required|array|min:1',
            'variation_value.*' => 'required|exists:variations,id',
        ]);


         DB::beginTransaction();
          
         try{
          $charges = [];
        $additionalNames = $request->additional_name;
        $chargeAmounts = $request->charge;

        foreach ($additionalNames as $index => $name) {
            $amount = $chargeAmounts[$index] ?? null;
            if ($name && $amount !== null) {
                $charges[] = [
                    'name' => $name,
                    'charge' => (float) $amount,
                ];
            }
        }

        $product = Product::withTrashed()->findOrFail($id);
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->disc_price = $request->disc_price;
        $product->stock_quantity = $request->stock_quantity;
        $product->slug = $request->slug;
        $product->specifications = $request->content;
        $product->charge_details = $charges;
        

        if ($request->hasFile('image')) {
                
            if ($product->image && file_exists(public_path('images/product/'.$product->image))) {
                unlink(public_path('images/product/'.$product->image));
            }

            $file = $request->file('image');
            $fileName = 'product_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/product'), $fileName);
            $product->image = $fileName;
        }

        $product->save();

        ProductVariation::where('product_id', $product->id)->delete();

                $variationTypes = $request->variation_type;
                $variationValues = $request->variation_value; 
                foreach ($variationTypes as $index => $typeId) {
                    $valueId = $variationValues[$index] ?? null;
                    if ($valueId) {
                        ProductVariation::create([
                            'product_id' => $product->id,
                            'variation_type_id' => $typeId,
                            'variation_value_id' => $valueId,
                        ]);
                    }
                }

           DB::commit();

            return redirect()->route('products')->with('success', 'Product updated successfully.');

            } catch(\Exception $e){
                DB::rollBack();
            return redirect()->route('products')->with('error', 'Update failed' .$e->getMessage());
        }
    }

    public function productDelete($id)
    {
        $data = Product::withTrashed()->findOrFail($id);

        
        if ($data->trashed()) {
            $data->restore();
            $message = 'Product restored successfully!';
        } else {
            $data->delete();
            $message = 'Product deleted successfully!';
        }

        return redirect()->route('products')->with('success', $message);
    }

    
    public function brands()
    {
        $data = Brand::withTrashed()->latest()->get();
        return view('admin.product.brand.list', compact('data'));
    }

    public function brandAdd()
    {
        return view('admin.product.brand.add');
    }

    public function brandStore(Request $request)
    {
        $request->merge(['slug' => Str::slug($request->name)]);

        $request->validate([
            'name'  => 'required|string|max:255',
            'slug'  => 'required|string|unique:brand,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = $request->slug;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'brand_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/brand'), $fileName);
            $brand->image = $fileName;
        }

        $check = $brand->save();

        if($check) {
            return redirect()->route('brands')->with('success', 'Brand created successfully.');
        } else {
            return redirect()->route('brands')->with('error', 'Brand Not created.');
        }
    }

    public function brandEdit($id)
    {
        $data = Brand::findOrFail($id);
        return view('admin.product.brand.edit', compact('data'));
    }

    public function brandUpdate(Request $request, $id)
    {
        $request->merge(['slug' => Str::slug($request->name)]);

        $request->validate([
            'name'  => 'required|string|max:255',
            'slug'  => 'required|string|unique:brands,slug,'.$id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        
        if ($request->hasFile('image')) {
                
            if ($brand->image && file_exists(public_path('images/brand/'.$brand->image))) {
                unlink(public_path('images/brand/'.$brand->image));
            }

            $file = $request->file('image');
            $fileName = 'brand_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/brand'), $fileName);
            $brand->image = $fileName;
        }

        $check = $brand->save();

        if($check) {
            return redirect()->route('brands')->with('success', 'Brand updated successfully.');
        } else {
            return redirect()->route('brands')->with('error', 'Brand not updated.');
        }
    }

    public function brandDelete($id)
    {
        $data = Brand::withTrashed()->findOrFail($id);
        
        if ($data->trashed()) {
            $data->restore();
            $message = 'Brand restored successfully!';
        } else {
            $data->delete();
            $message = 'Brand deleted successfully!';
        }

        return redirect()->route('brand-categories')->with('success', $message);
    }




public function orderes()
{
    $order = Order::with(['user', 'status','paymentStatus'])
        ->latest()
        ->get();   
     
    return view('admin.order.list', compact('order'));
}



public function showInvoice($id)
{
    $order = Order::withTrashed()->findOrFail($id);
    $user  = User::where('id', $order->user_id)->first();
    $products = json_decode($order->product_details, true) ?? [];
    $address = json_decode($order->address, true);

    $subTotal = 0;
    foreach ($products as $product) {
        $subTotal += $product['price'] * $product['quantity'];
    }


    return view('admin.order.invoice', [
        'order'       => $order,
        'user'        => $user,
        'products'    => $products,
        'subTotal'    => $subTotal,
        'address'     => $address,
    ]);
}

  public function orderDelete($id)
    {
        $data = Order::withTrashed()->findOrFail($id);
        
        if ($data->trashed()) {
            $data->restore();
            $message = 'Order restored successfully!';
        } else {
            $data->delete();
            $message = 'Order deleted successfully!';
        }

        return redirect()->route('orderes')->with('success', $message);
    }

  public function orderStatusUpdate(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'status' => 'required|string|exists:order_status,name',
        ]);

        $order = Order::findOrFail($request->id);
        $orderStatus = OrderStatus::where('name', $request->status1)->first();
          
        if ($orderStatus->name =='pending') {
            $orderStatus->name=$request->status1;
            $order->commision=$request->advance;
            $order->order_status_id = $orderStatus->id;
            $check = $order->save();

        } else if ($orderStatus->name =='Confirm') {
            $orderStatus->name=$request->status2;
            $order->order_status_id = $orderStatus->id;
            $check = $order->save();

        } else {

            $orderStatus->name=$request->status3;
            $order->order_status_id = $orderStatus->id;
            $request->validate([
                'documents' => 'nullable|array',
                'documents.*' => 'file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

             $doc=OrderStatusTxn::where('order_id',$request->id)->first();
            if ($request->hasFile('documents')) {
                $documentPaths = [];
                foreach ($request->file('documents') as $file) {
                    $fileName = 'order_document_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/orders/document'), $fileName);
                    $documentPaths[] = $fileName;
                }

                $doc->documents = json_encode($documentPaths);
                $doc->save();
     } 
            $check = $order->save();
        }
            if($check) {
                return redirect()->route('orderes')->with('success', 'Order status updated successfully.');
            } else {
                return redirect()->route('orderes')->with('error', 'Order status not updated.');
            } 
    }
  

    // public function paymentUpdate(Request $request){
     

    

    //     $orderId = $order->id;

    //         $imagePath = null;
    //         if ($request->hasFile('utr_img')) {
    //             $image = $request->file('utr_img');
    //             $imageName = $code . '_' . $image->getClientOriginalName();
    //             $image->move(public_path('payment'), $imageName); // save to public/payment
    //             $imagePath = 'payment/' . $imageName; // store relative path in DB
    //         }

    //         $advancePayment = (float)$request->advance_payment;
    //         $type = 'Part Payment';
    //         if($advancePayment >= $finalAmount){
    //             $type = 'Full Payment';
    //         }

    //         if($advancePayment > 0) {
    //             OrderPayment::create([
    //                 'user_id' => $user->id,
    //                 'order_id' => $orderId,
    //                 'trans_type' => 'Received',
    //                 'type' => $type,
    //                 'method' => $request->payment_mode,
    //                 'utr_no' => $request->utr_no,
    //                 'amount' => $advancePayment,
    //                 'image' => $imagePath,
    //             ]);
    //         }
    // }


    public function variationType()
    {
        $data = Variation::where('parent_id', 0)->get();
        return view('admin.product.variationtype.list', compact('data'));
    }

    public function variationTypeAdd()
    {
        return view('admin.product.variationtype.add');
    }

    public function variationTypeStore(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'description' => 'nullable|string',
        ]);

        $data = new Variation();
        $data->name = $request->name;
          $data->parent_id = 0;
        $data->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'variation_type_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/variation/type'), $fileName);
            $data->image = $fileName;
        }

        $check = $data->save();

        if($check) {
            return redirect()->route('variation-type')->with('success', 'variation Type created successfully.');
        } else {
            return redirect()->route('variation-type')->with('error', 'variation Type Not created.');
        }
    }

    public function variationTypeEdit($id)
    {
        $data = Variation::findOrFail($id);
        return view('admin.product.variationtype.edit', compact('data'));
    }

    public function variationTypeUpdate(Request $request, $id)
    {

        $request->validate([
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'description' => 'nullable|string',
        ]);

        $data = Variation::findOrFail($id);
        $data->type = $request->type;
        $data->description = $request->description;
          $data->parent_id = 0;
        
        if ($request->hasFile('image')) {
                
            if ($data->image && file_exists(public_path('images/variation/type/'.$data->image))) {
                unlink(public_path('images/variation/type/'.$data->image));
            }

            $file = $request->file('image');
            $fileName = 'variation_type_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/variation/type'), $fileName);
            $data->image = $fileName;
        }

        $check = $data->save();

        if($check) {
            return redirect()->route('variation-type')->with('success', 'Variation
            Type updated successfully.');
        } else {
            return redirect()->route('variation-type')->with('error', 'Variation Type not updated.');
        }
    }

    public function variationTypeDelete($id)
    {
        $data = Variation::withTrashed()->findOrFail($id);
        
        if ($data->trashed()) {
            $data->restore();
            $message = 'Variation Type restored successfully!';
        } else {
            $data->delete();
            $message = 'Variation Type deleted successfully!';
        }

        return redirect()->route('variation-type')->with('success', $message);
    }

    public function variationValue()
    {
        $data = Variation::whereNot('parent_id', 0)->latest()->get();
         return view('admin.product.variationvalue.list', compact('data'));
    }

    public function variationValueAdd()
    {
         $data = Variation::where('parent_id', 0)->get();

        return view('admin.product.variationvalue.add', compact('data'));
    }

    public function variationValueStore(Request $request)
    {
        $request->validate([
            'parent_id'      => 'required|exists:variations,id',
            'value'       => 'required|string|max:255',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'description'=> 'nullable|string',
        ]);

        $data = new Variation();
        $data->parent_id=$request->parent_id;
        $data->name = $request->value;
        $data->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'variation_value_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/variation/value'), $fileName);
            $data->image = $fileName;
        }

        $check = $data->save();

        if($check) {
            return redirect()->route('variation-value')->with('success', 'variation Value created successfully.');
        } else {
            return redirect()->route('variation-value')->with('error', 'variation Value Not created.');
        }

    }

    public function variationValueEdit($id)
    {
        $data = Variation::findOrFail($id);
       $types = Variation::where('parent_id', 0)->latest()->get();

        return view('admin.product.variationvalue.edit', compact('data', 'types'));
    }

    public function variationValueUpdate(Request $request, $id)
    {
        $request->validate([
            'parent_id'       => 'required|exists:variations,id',
            'value'       => 'required|string|max:255',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'description'=> 'nullable|string',
        ]);


        $data = Variation::findOrFail($id);
        $data->parent_id = $request->parent_id;
        $data->name = $request->value;
        $data->description = $request->description;

        
        if ($request->hasFile('image')) {
                
            if ($data->image && file_exists(public_path('images/variation/value/'.$data->image))) {
                unlink(public_path('images/variation/value/'.$data->image));
            }

            $file = $request->file('image');
            $fileName = 'variation_value_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/variation/value'), $fileName);
            $data->image = $fileName;
        }

        $check = $data->save();

        if($check) {
            return redirect()->route('variation-value')->with('success', 'Variation
            Value updated successfully.');
        } else {
            return redirect()->route('variation-value')->with('error', 'Variation Value not updated.');
        }

    }

    public function variationValueDelete($id)
    {
        $data = Variation::withTrashed()->findOrFail($id);
        
        if ($data->trashed()) {
            $data->restore();
            $message = 'Variation Value restored successfully!';
        } else {
            $data->delete();
            $message = 'Variation Value deleted successfully!';
        }

        return redirect()->route('variation-value')->with('success', $message);
    }


    public function getVariationValue($id)
{
    $values = Variation::where('parent_id', $id)->get();

    return response()->json($values);
}

}

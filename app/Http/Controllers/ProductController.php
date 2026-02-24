<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function categories(Request $request)
    {
        $query = ProductCategory::withTrashed();

        // Apply search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $data = $query->latest()->get();
        $allCategories = ProductCategory::select('id', 'name')->get(); // For filter dropdown

        return view('admin.product.category.list', compact('data', 'allCategories'));
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
            'file_size' => 'required|numeric|min:0'
        ]);

        $category = new ProductCategory();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->file_size = $request->file_size;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'product_category_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/product/category'), $fileName);
            $category->image = $fileName;
        }

        $check = $category->save();

        if ($check) {
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
            'slug'  => 'required|string|unique:categories,slug,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'file_size' => 'required|numeric|min:0'
        ]);

        $category = ProductCategory::findOrFail($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->file_size = $request->file_size;

        if ($request->hasFile('image')) {

            if ($category->image && file_exists(public_path('images/product/category/' . $category->image))) {
                unlink(public_path('images/product/category/' . $category->image));
            }

            $file = $request->file('image');
            $fileName = 'product_category_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/product/category'), $fileName);
            $category->image = $fileName;
        }

        $check = $category->save();

        if ($check) {
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

        $query = Product::with('category')->where('parent_id', 0);

        if (!empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }
        $data = $query->withTrashed()->latest()->get();
        return view('admin.product.list', compact('data', 'category'));
    }

    public function productAdd()
    {
        $category = ProductCategory::get();
        $variationType = Variation::where('parent_id', 0)->get();
        $variationValue = Variation::whereNot('parent_id', 0)->get();

        return view('admin.product.add', compact('category', 'variationType', 'variationValue'));
    }

    public function productStore(Request $request)
    {
        $request->merge(['slug' => Str::slug($request->name)]);

        $validated = $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'slug' => 'required|string|unique:products,slug|min:3|max:255',
            'name' => 'required|string|max:255',
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sku' => 'required|string|max:100',
            'price' => 'required|numeric',
            'disc_price' => 'required|numeric',
            'max_quantity' => 'required|integer',
            'min_quantity' => 'required|integer',
            'content' => 'required|string',
            'additional_name.*' => 'nullable|string',
            'charge.*' => 'nullable|numeric',
            'variation_type' => 'required|array|min:1',
            'variation_type.*' => 'required|exists:variations,id',
            'variation_value' => 'required|array|min:1',
            'variation_value.*' => 'required|exists:variations,id',

        ], [
            'slug.unique' => 'this product name is already exist'
        ]);



        DB::beginTransaction();
        try {

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
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->sku = $request->sku;
            $product->price = $request->price;
            $product->disc_price = $request->disc_price;
            $product->max_quantity = $request->max_quantity;
            $product->min_quantity = $request->min_quantity;
            $product->specifications = $request->content;
            $product->charge_details = $charges;
            $product->parent_id = 0;


            $imageFiles = [];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $fileName = 'product_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/product'), $fileName);
                    $imageFiles[] = $fileName;
                }
            }

            $product->image = $imageFiles;
            $product->save();



            $variationTypes = $request->variation_type;
            $variationValues = $request->variation_value;

            foreach ($variationTypes as $index => $typeId) {

                if (!isset($variationValues[$index])) {
                    continue;
                }

                foreach ($variationValues[$index] as $valueId) {

                    ProductVariation::create([
                        'product_id' => $product->id,
                        'variation_type_id' => $typeId,
                        'variation_value_id' => $valueId,
                    ]);
                }
            }


            DB::commit();
        } catch (\Exception $e) {
            foreach ($imageFiles as $img) {
                $path = public_path('images/product/' . $img);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            return redirect()->route('products')->with('error', 'Something went wrong:' . $e->getMessage());
        }
        return redirect()->route('products')->with('success', 'Product created successfully.');
    }

    public function productEdit($id)
    {
        $category = ProductCategory::get();
        $data = Product::withTrashed()->findOrFail($id);

        $variationType = Variation::where('parent_id', 0)->get();

        $variationValue = Variation::where('parent_id', '!=', 0)->get();
        return view('admin.product.edit', compact('data', 'category', 'variationType', 'variationValue'));
    }

    public function productUpdate(Request $request, $id)
    {
        $request->merge(['slug' => Str::slug($request->name)]);

        $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100',
            'price' => 'required|numeric',
            'disc_price' => 'required|numeric',
            'max_quantity' => 'required|integer',
            'min_quantity' => 'required|integer',
            'slug' => 'required|string|min:3|max:255|unique:products,slug,' . $id,
            'content' => 'required|string',
            'images' => 'nullable|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'additional_name.*' => 'nullable|string',
            'charge.*' => 'nullable|numeric',
            'variation_type' => 'required|array|min:1',
            'variation_type.*' => 'required|exists:variations,id',
            'variation_value' => 'required|array|min:1',
            'variation_value.*' => 'required|exists:variations,id',
        ]);


        DB::beginTransaction();

        try {
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
            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->price = $request->price;
            $product->disc_price = $request->disc_price;
            $product->max_quantity = $request->max_quantity;
            $product->min_quantity = $request->min_quantity;
            $product->slug = $request->slug;
            $product->specifications = $request->content;
            $product->charge_details = $charges;


            if ($request->hasFile('images')) {
                if ($product->image && is_array($product->image)) {
                    foreach ($product->image as $oldImage) {
                        if (file_exists(public_path('images/product/' . $oldImage))) {
                            unlink(public_path('images/product/' . $oldImage));
                        }
                    }
                }

                $imageFiles = [];
                foreach ($request->file('images') as $file) {
                    $fileName = 'product_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/product'), $fileName);
                    $imageFiles[] = $fileName;
                }

                $product->image = $imageFiles;
            }

            $product->save();

            ProductVariation::where('product_id', $product->id)->delete();

            $variationTypes = $request->variation_type;
            $variationValues = $request->variation_value;

            foreach ($variationTypes as $index => $typeId) {

                if (!isset($variationValues[$index])) {
                    continue;
                }

                foreach ($variationValues[$index] as $valueId) {

                    ProductVariation::create([
                        'product_id' => $product->id,
                        'variation_type_id' => $typeId,
                        'variation_value_id' => $valueId,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('products')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('products')->with('error', 'Update failed' . $e->getMessage());
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
    public function variant(Request $request)
    {
        $category = ProductCategory::withTrashed()->latest()->get();

        if (empty($request->category_id)) {
            $request->merge(['category_id' => $category[0]->id ?? '0']);
        }
        $data = Product::with('category')->whereNot('parent_id', 0)->withTrashed()->latest()->get();
        return view('admin.product.variant.list', compact('data', 'category'));
    }

    public function variantAdd()
    {
        $category = ProductCategory::get();
        $brand = Brand::get();
        $variationType = Variation::where('parent_id', 0)->get();
        $variationValue = Variation::whereNot('parent_id', 0)->get();
        return view('admin.product.variant.add', compact('category', 'brand', 'variationType', 'variationValue'));
    }


    public function variantStore(Request $request)
    {
        $request->merge(['slug' => Str::slug($request->name)]);
        $user = $request->validate([
            'parent_product_id' => 'required|exists:products,id',
            'category_id'       => 'required|exists:categories,id',
            'name'              => 'required|string',
            'images'            => 'required|array|min:1',
            'images.*'          => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sku'               => 'required|string|unique:products,sku',
            'slug'              => 'required|string|unique:products,slug|min:3|max:255',
            'price'             => 'required|numeric',
            'disc_price'        => 'required|numeric',
            'max_quantity' => 'required|integer',
            'min_quantity' => 'required|integer',

            'variation_type'    => 'required|array|min:1',
            'variation_type.*'  => 'required|exists:variations,id',

            'variation_value'     => 'required|array|min:1',
            'variation_value.*'   => 'required|array|min:1',
            'variation_value.*.*' => 'required|exists:variations,id',


            'additional_name.*' => 'nullable|string',
            'charge.*'          => 'nullable|numeric',

            'content'           => 'required|string',
        ]);
        // dd($user);
        DB::beginTransaction();

        try {
            $charges = [];

            if ($request->additional_name && $request->charge) {
                foreach ($request->additional_name as $i => $name) {
                    if ($name && isset($request->charge[$i])) {
                        $charges[] = [
                            'name'   => $name,
                            'charge' => (float) $request->charge[$i],
                        ];
                    }
                }
            }

            $variant = new Product();
            $variant->parent_id         = $request->parent_product_id;
            $variant->category_id       = $request->category_id;
            // $variant->brand_id          = $request->brand_id;
            $variant->name              = $request->name;
            $variant->slug              = $request->slug;

            $variant->sku               = $request->sku;
            $variant->price             = $request->price;
            $variant->disc_price        = $request->disc_price;
            $variant->max_quantity      =  $request->max_quantity;
            $variant->min_quantity      =  $request->min_quantity;
            $variant->specifications    = $request->content;
            $variant->charge_details    = $charges;


            $imageFiles = [];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $fileName = 'variant_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/variant'), $fileName);
                    $imageFiles[] = $fileName;
                }
            }

            $variant->image = $imageFiles;
            $variant->save();

            $variationTypes  = $request->variation_type;
            $variationValues = $request->variation_value;

            foreach ($variationTypes as $typeId) {

                if (!isset($variationValues[$typeId])) {
                    continue;
                }

                foreach ($variationValues[$typeId] as $valueId) {
                    ProductVariation::create([
                        'product_id'        => $variant->id,
                        'variation_type_id' => $typeId,
                        'variation_value_id' => $valueId,
                    ]);
                }
            }


            DB::commit();

            return redirect()
                ->route('variant')
                ->with('success', ' Product Variant added successfully');
        } catch (\Exception $e) {

            DB::rollBack();
            foreach ($imageFiles as $img) {
                $path = public_path('images/variant/' . $img);

                if (file_exists($path)) {
                    unlink($path);
                }
            }
            return back()->with('error', $e->getMessage());
        }
    }



    public function variantEdit($id)
    {
        $category = ProductCategory::get();
        $data = Product::withTrashed()->findOrFail($id);
        $brand = Brand::get();
        $product = Product::where('parent_id', 0)
            ->where('category_id', $data->category_id)
            ->get();

        $variationType = Variation::where('parent_id', 0)->get();

        $variationValue = Variation::where('parent_id', '!=', 0)->get();
        return view('admin.product.variant.edit', compact('data', 'category', 'brand', 'variationType', 'variationValue', 'product'));
    }


    public function variantUpdate(Request $request, $id)
    {
        $request->merge(['slug' => Str::slug($request->name)]);

        $request->validate([
            'parent_product_id' => 'required|exists:products,id',
            'category_id' => 'required|integer|exists:categories,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100',
            'price' => 'required|numeric',
            'disc_price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'slug' => 'required|string|min:3|max:255|unique:products,slug,' . $id,
            'content' => 'required|string',
            'images' => 'nullable|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'additional_name.*' => 'nullable|string',
            'charge.*' => 'nullable|numeric',
            'variation_type' => 'required|array|min:1',
            'variation_type.*' => 'required|exists:variations,id',
            'variation_value' => 'required|array|min:1',
            'variation_value.*' => 'required|exists:variations,id',
        ]);


        DB::beginTransaction();

        try {
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
            $product->parent_id = $request->parent_product_id;


            if ($request->hasFile('images')) {
                if ($product->image && is_array($product->image)) {
                    foreach ($product->image as $oldImage) {
                        if (file_exists(public_path('images/variant/' . $oldImage))) {
                            unlink(public_path('images/variant/' . $oldImage));
                        }
                    }
                }

                $imageFiles = [];
                foreach ($request->file('images') as $file) {
                    $fileName = 'variant_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/variant'), $fileName);
                    $imageFiles[] = $fileName;
                }

                $product->image = $imageFiles;
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

            return redirect()->route('variant')->with('success', 'Product Variant updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('variant')->with('error', 'Update failed' . $e->getMessage());
        }
    }

    public function variationDelete($id)
    {
        $data = Product::withTrashed()->findOrFail($id);


        if ($data->trashed()) {
            $data->restore();
            $message = ' Product Variant restored successfully!';
        } else {
            $data->delete();
            $message = 'Product Variant deleted successfully!';
        }

        return redirect()->route('products')->with('success', $message);
    }
    public function getProductsByCategory(Request $request)
    {
        $category = ProductCategory::findOrFail($request->category_id);
        $products = Product::where('category_id', $category->id)
            ->where('parent_id', 0)
            ->get();

        return response()->json(['products' => $products]);
    }

    public function getProductDetails(Request $request)
    {
        $product = Product::with([
            'variations.variationType',
            'variations.variationValue'
        ])->findOrFail($request->product_id);

        $groupedVariations = $product->variations
            ->groupBy('variation_type_id')
            ->map(function ($items) {
                return [
                    'variation_type_id' => $items->first()->variation_type_id,
                    'variation_type' => [
                        'id' => $items->first()->variationType->id,
                        'name' => $items->first()->variationType->name,
                    ],
                    'selected_values' => $items->pluck('variation_value_id')->toArray()
                ];
            })
            ->values();

        return response()->json([
            'product' => [
                'id' => $product->id,
                'price' => $product->price,
                'disc_price' => $product->disc_price,
                'specifications' => $product->specifications,
                'variations' => $groupedVariations
            ]
        ]);
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

        if ($check) {
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
            'slug'  => 'required|string|unique:brands,slug,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->slug = $request->slug;

        if ($request->hasFile('image')) {

            if ($brand->image && file_exists(public_path('images/brand/' . $brand->image))) {
                unlink(public_path('images/brand/' . $brand->image));
            }

            $file = $request->file('image');
            $fileName = 'brand_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/brand'), $fileName);
            $brand->image = $fileName;
        }

        $check = $brand->save();

        if ($check) {
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



    public function orderes(Request $request)
    {
        $query = Order::with(['user', 'status', 'paymentStatus']);

        if (Auth::user()->role_id == 1) {
            // Admin can see all orders
        } else {
            // Employees can see orders assigned to them or unassigned
            $query->where(function ($q) {
                $q->where('assigned_to', Auth::user()->id)
                    ->orWhere('assigned_to', 0);
            });
        }

        // Apply filters
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('status_id')) {
            $query->where('order_status_id', $request->status_id);
        }

        $order = $query->get();
        $orderstatus = OrderStatus::orderBy('id')->get();
        $employee = User::where('role_id', 2)->get();

        // Get all users for the filter dropdown
        $users = User::select('id', 'name')->get();

        if ($orderstatus->count() == 0) {
            $orderstatus = collect([
                (object)['id' => 1, 'name' => 'Pending'],
                (object)['id' => 2, 'name' => 'Processing'],
                (object)['id' => 3, 'name' => 'Completed'],
                (object)['id' => 4, 'name' => 'Cancelled'],
            ]);
        }

        return view('admin.order.list', compact('order', 'orderstatus', 'employee', 'users'));
    }
    public function orderaccept($id)
    {
        $order = Order::findOrFail($id);
        $previousAssignee = $order->assigned_to;

        $order->assigned_to = Auth::user()->id;
        $order->save();

        // Track assignment (self-accept)
        \App\Helpers\Helper::createOrderTrackingLog(
            $order->id,
            $order->status->name ?? 'Order Accepted',
            'Order accepted by employee ID: ' . Auth::user()->id,
            $order->assigned_to,
            Auth::user()->id,
            optional(Auth::user()->department)->name ?? null
        );

        return redirect()->route('orderes')->with('success', 'Order accepted successfully.');
    }
    public function assignEmployeeOrder(Request $request)
    {

        $request->validate([
            'orderId' => 'required|integer|exists:orders,id',
            'employee_id' => 'required|integer|exists:users,id',
        ]);

        $order = Order::findOrFail($request->orderId);
        $order->assigned_to = $request->employee_id;
        $order->save();
        $employee = User::find($request->employee_id);
        // Track assignment by admin/manager
        \App\Helpers\Helper::createOrderTrackingLog(
            $order->id,
            'ORDER ASSIGNED',
            'Order assigned to employee ID: ' . $request->employee_id,
            $order->assigned_to,
            Auth::user()->id,
            $employee->department_id ? optional($employee->department)->name : null
        );

        return redirect()->route('orderes')->with('success', 'Order assigned to employee successfully.');
    }
    public function orderlist()
    {
        if (Auth::user()->role_id == 4) {
            $order = Order::with(['user', 'status', 'paymentStatus'])->where('order_by_id', Auth::user()->id)->get();
            $orderstatus = OrderStatus::orderBy('id')->get();


            if ($orderstatus->count() == 0) {
                $orderstatus = collect([
                    (object)['id' => 1, 'name' => 'Pending'],
                    (object)['id' => 2, 'name' => 'Processing'],
                    (object)['id' => 3, 'name' => 'Completed'],
                    (object)['id' => 4, 'name' => 'Cancelled'],
                ]);
            }

            return view('front.order.orderlist', compact('order', 'orderstatus'));
        }
        return view('front.index');
    }


    public function showInvoice($id)
    {
        $order = Order::withTrashed()->findOrFail($id);
        $user  = User::where('id', $order->user_id)->first();

        $product = json_decode($order->product_details, true) ?? [];
        $address = json_decode($order->address, true);

        $subTotal = 0;

        if (is_array($product) && isset($product['price']) && isset($product['quantity'])) {
            $price = (float) ($product['price'] ?? 0);
            $quantity = (int) ($product['quantity'] ?? 1);
            $subTotal = $price * $quantity;
        }
        $productId = $product['product_id'] ?? null;
        if ($productId) {
            $dbProduct = Product::withTrashed()->find($productId);
            if ($dbProduct) {
                $product['name'] = $dbProduct->name;
                $product['sku'] = $dbProduct->sku;
            }
        }
        return view('admin.order.invoice', [
            'order'       => $order,
            'user'        => $user,
            'products'     => $product,
            'subTotal'    => $subTotal,
            'address'     => $address,
        ]);
    }
    public function trackingList()
    {
        $user = Auth::user();

        // Get all orders for the current user
        if ($user->role_id == 1) {
            // Admin can see all orders
            $orders = Order::with(['user', 'status', 'paymentStatus', 'trackingLogs'])
                ->orderBy('created_at', 'desc')
                ->get();
        } else if ($user->role_id == 2) {
            // Employees can see assigned orders
            $orders = Order::with(['user', 'status', 'paymentStatus', 'trackingLogs'])
                ->where(function ($q) use ($user) {
                    $q->where('assigned_to', $user->id)
                        ->orWhere('assigned_to', 0);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        } else if ($user->role_id == 4) {
            // Customers can see their own orders
            $orders = Order::with(['user', 'status', 'paymentStatus', 'trackingLogs'])
                ->where('order_by_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $orders = collect();
        }

        return view('admin.order.tracking-list', [
            'orders' => $orders,
        ]);
    }
    public function orderTrackingView($id)
    {
        $order = Order::withTrashed()->findOrFail($id);
        $trackingLogs = $order->trackingLogs()->orderBy('created_at', 'desc')->get();

        return view('admin.order.ordertrackingview', [
            'order' => $order,
            'trackingLogs' => $trackingLogs,
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

    // public function orderStatusUpdate(Request $request)
    // {
    //     // dd($request->order_id);
    //     $request->validate([
    //         'order_id' => 'required|integer|exists:orders,id',
    //         'status' => 'required|integer|exists:order_status,id',
    //     ]);
    //     $order = Order::findOrFail($request->order_id);

    //     $oldStatusId = $order->order_status_id;
    //     $newStatusId = $request->status;

    //     $order->order_status_id = $newStatusId;

    //     if ($order->save()) {
    //         $oldStatus = OrderStatus::find($oldStatusId);
    //         $newStatus = OrderStatus::find($newStatusId);

    //         $remark = 'Order status changed from '
    //             . ($oldStatus->name ?? 'N/A')
    //             . ' to '
    //             . ($newStatus->name ?? 'N/A');

    //         Helper::createOrderTrackingLog(
    //             $order->id,
    //             $order->status->name ?? 'Status Updated',
    //             $remark,
    //             $order->assigned_to,
    //             Auth::user()->id,
    //             optional(Auth::user()->department)->name
    //         );

    //         return redirect()->route('orderes')->with('success', 'Order status updated successfully.');
    //     }
    //     return redirect()->route('orderes')->with('error', 'Failed to update order status.');
    // }

    public function orderStatusUpdate(Request $request)
    {
        // dd($request->order_id);
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'status' => 'required|integer|exists:order_status,id',
        ]);
        $order = Order::findOrFail($request->order_id);

        $oldStatusId = $order->order_status_id;
        $newStatusId = $request->status;

        $order->order_status_id = $newStatusId;

        // determine if this new status corresponds to "Cancelled" so we can refund wallet
        $cancelStatus = OrderStatus::where('name', 'Cancelled')->first();

        $isCancellation = $cancelStatus && $newStatusId == $cancelStatus->id;

        if ($order->save()) {
            $oldStatus = OrderStatus::find($oldStatusId);
            $newStatus = OrderStatus::find($newStatusId);

            $remark = 'Order status changed from '
                . ($oldStatus->name ?? 'N/A')
                . ' to '
                . ($newStatus->name ?? 'N/A');

            Helper::createOrderTrackingLog(
                $order->id,
                $order->status->name ?? 'Status Updated',
                $remark,
                $order->assigned_to,
                Auth::user()->id,
                optional(Auth::user()->department)->name
            );

            // if the order has just been cancelled and payment was already taken, refund the amount
            if ($isCancellation && $order->payment_status_id == 2) {
                // credit the wallet of the user who placed the order
                $refundAmount = $order->final_amount_with_tax ?: 0;

                $ledgerResp = Helper::creadit_ledger([
                    "user_id"     => $order->order_by_id,
                    "refrence_id" => Auth::id(),
                    "amount"      => $refundAmount,
                    "trans_id"    => Helper::getTransId(3),
                    "cgst"        => 0,
                    "sgst"        => 0,
                    "ledger_type" => 'WALLET CREDIT',
                    "wallet_type" => 1,
                    "trans_from"  => 'Order Cancellation',
                    "description" => "Refund for cancelled order {$order->code}",
                ]);

                // update payment status to refunded if ledger operation succeeded
                if ($ledgerResp['status'] == 'success') {
                    $refundedStatus = \App\Models\PaymentStatus::where('name', 'Refunded')->first();
                    if ($refundedStatus) {
                        $order->payment_status_id = $refundedStatus->id;
                    }
                    $order->save();

                    try {
                        OrderStatusTxn::create([
                            'order_id' => $order->id,
                            'order_status_id' => $order->order_status_id,
                            'payment_status_id' => $order->payment_status_id,
                            'm11_creatby_user_type' => 'user',
                            'created_by_id' => Auth::user()->id,
                            'description' => 'Amount credited to wallet after cancellation',
                            'documents' => null,
                        ]);
                    } catch (\Exception $e) {
                        // ignore logging failure
                    }
                }
            }

            $successMessage = 'Order status updated successfully.';
            if ($isCancellation) {
                $successMessage = 'Order cancelled successfully and amount credited back to wallet.';
            }
            return redirect()->route('orderes')->with('success', $successMessage);
        }
        return redirect()->route('orderes')->with('error', 'Failed to update order status.');
    }

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

        if ($check) {
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

            if ($data->image && file_exists(public_path('images/variation/type/' . $data->image))) {
                unlink(public_path('images/variation/type/' . $data->image));
            }

            $file = $request->file('image');
            $fileName = 'variation_type_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/variation/type'), $fileName);
            $data->image = $fileName;
        }

        $check = $data->save();

        if ($check) {
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
        $data = Variation::with('type')->whereNot('parent_id', 0)->latest()->get();
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
            'description' => 'nullable|string',
        ]);

        $data = new Variation();
        $data->parent_id = $request->parent_id;
        $data->name = $request->value;
        $data->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'variation_value_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/variation/value'), $fileName);
            $data->image = $fileName;
        }

        $check = $data->save();

        if ($check) {
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
            'description' => 'nullable|string',
        ]);


        $data = Variation::findOrFail($id);
        $data->parent_id = $request->parent_id;
        $data->name = $request->value;
        $data->description = $request->description;


        if ($request->hasFile('image')) {

            if ($data->image && file_exists(public_path('images/variation/value/' . $data->image))) {
                unlink(public_path('images/variation/value/' . $data->image));
            }

            $file = $request->file('image');
            $fileName = 'variation_value_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/variation/value'), $fileName);
            $data->image = $fileName;
        }

        $check = $data->save();

        if ($check) {
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

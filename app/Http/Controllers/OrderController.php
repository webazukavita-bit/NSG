<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function categories()
    {
         $data=ProductCategory::get();
         return view('admin.order.booking.category',compact('data'));
    }

    public function subCategories($slug,$id)
    {
        $category=ProductCategory::findOrFail($id);
        $products = Product::with(['variations.variationType','variations.variationValue' ])
        ->where('category_id', $category->id)
        ->get();
         return view('admin.order.booking.sub_category',compact('products','category'));
    }

    public function bookingDetails($slug)
    {
        $product = Product::with(['variations.variationType','variations.variationValue','variations.allValues' ])
        ->where('slug', $slug)
        ->first();
         return view('admin.order.booking.add_booking',compact('product'));
    }
}

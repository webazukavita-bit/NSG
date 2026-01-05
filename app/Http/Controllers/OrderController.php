<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function categories(){
         $data=ProductCategory::get();
         return view('admin.order.booking.category',compact('data'));
    }

    public function subCategories($id){
        $category=ProductCategory::where('id',$id)->first();
        $products = Product::with(['variations.variationType','variations.variationValue' ])
        ->where('category_id', $id)
        ->get();
         return view('admin.order.booking.sub_category',compact('products','category'));
    }

    public function bookingDetails($id){
        $category=ProductCategory::where('id',$id)->first();
        $products = Product::with(['variations.variationType','variations.variationValue','variations.allValues' ])
        ->where('category_id', $id)
        ->get();
         return view('admin.order.booking.add_booking',compact('products','category'));
    }
}

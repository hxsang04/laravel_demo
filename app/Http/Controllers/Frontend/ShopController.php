<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(){
        $products =  Product::all();
        return view('frontend.shop', ['products' => $products]);
    }
    
    public function product(Product $product){
        return view('frontend.product', ['product' => $product]);
    }
    
}

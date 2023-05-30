<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class ShopController extends Controller
{
    public function index(){
        $products =  Product::orderByDesc('id')->get();
        return view('frontend.shop', ['products' => $products]);
    }
    
    public function product(Product $product){
        return view('frontend.product', ['product' => $product]);
    }

    public function orderHistory(){
        return view('frontend.order_history');
    }

    public function orderHistoryDetail(Order $order){
        return view('frontend.order_history_detail', compact('order'));
    }
    
}

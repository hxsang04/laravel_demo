<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class ShopController extends Controller
{
    public function index(){
        return view('frontend.index');
    }

    public function shop(){
        $products =  Product::orderByDesc('id')->get();
        return view('frontend.shop', compact('products'));
    }
    
    public function product(Product $product){
        return view('frontend.product', compact('product'));
    }

    public function orderHistory(){
        return view('frontend.order-history');
    }

    public function orderHistoryDetail(Order $order){
        return view('frontend.order-history-detail', compact('order'));
    }
    
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index(){
        return view('frontend.cart');
    }

    public function addToCart(Request $request, $id){
        $quantity = $request->input('quantity');
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            $cart[$id]['quantity'] += $quantity;
        }
        else{
            $cart[$id] = [
                'product_id' => $id,
                'quantity' => $quantity,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully');
    }
}

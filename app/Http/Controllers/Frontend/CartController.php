<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request,Product $product){
        $quantity = $request->input('quantity');
        $cart = session()->get('cart');
        if(isset($cart[$product->id])){
            $cart[$product->id]['quantity'] += $quantity;
        }
        else{
            $cart[$product->id] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
            ];
        }
        session()->put('cart', $cart);
        dd(session('cart'));
        return redirect()->back()->with('success', 'Product added to cart successfully');
    }
}

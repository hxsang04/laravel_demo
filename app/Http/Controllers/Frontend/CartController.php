<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Collection;

class CartController extends Controller
{
    public function cart(){
        return view('frontend.cart');
    }

    public function addToCart(Request $request, Product $product){
        $quantity = $request->input('quantity');
        $cart = session('cart');

        if(isset($cart[$product->id])){
            $cart[$product->id]['quantity'] += $quantity;
            
        }
        else{
            $cart[$product->id] = [
                'product_id' => $product->id,
                'image' => $product->image,
                'name' => $product->name,
                'quantity' => $quantity,
                'price'=> $product->price,
            ];
        }
        session()->put('cart', $cart);

        $total_price = 0;
        foreach($cart as $item){
            $total_price += $item['quantity'] * $item['price'];
        }
        session()->put('total_price', $total_price);

        return redirect()->back()->with('success', 'Product added to cart successfully');
    }

}

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

    public function add(Request $request, Product $product){
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
        $this->totalPrice();
        return redirect()->back()->with('success', 'Product added to cart successfully');
    }

    public function delete($id){
        session()->pull('cart.'.$id);
        $this->totalPrice();
        return back()->with('success', 'Remove successful!');
    }

    protected function totalPrice(){
        $total_price = 0;
        foreach(session('cart') as $item){
            $total_price += $item['quantity'] * $item['price'];
        }
        session()->put('total_price', $total_price);
    }

}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CheckOutRequest;
use App\Models\Order;
use Auth;

class CheckOutController extends Controller
{
    public function checkOut(){
        return view('frontend.checkout');
    }

    public function checkOutPost(CheckOutRequest $request){
        // dd(session()->all());
        $data = $request->all();
        $data['total_price'] = session('total_price');
        $data['user_id'] = Auth::id();
        $order = Order::create($data);

        $cart = session('cart');
        foreach($cart as $item){
            $order->products()->attach($item['product_id'], [
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
            ]);
        }
        session()->forget(['cart','total_price']);

        return redirect()->route('orderHistory');

    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::orderByDesc('id')->get();
        return view('admin.order.view', compact('orders'));
    }

    public function show(Order $order){
        return view('admin.order.show', compact('order'));
    }
}

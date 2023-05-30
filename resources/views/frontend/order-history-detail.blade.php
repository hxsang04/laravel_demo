@extends('frontend.layout.master')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Chi tiết đơn hàng</span>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <div class="row checkout-form">
                <div class="col-lg-6">
                    <h4>Biiling Details</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="email">Email Address</label>
                            <input type="text" id="email" value="{{$order->email}}" readonly>
                        </div>
                        <div class="col-lg-12">
                            <label for="name">Name</label>
                            <input type="text" id="name" value="{{$order->name}}"readonly>
                        </div>
                        <div class="col-lg-12">
                            <label for="phone">Phone Number</label>
                            <input type="number" id="phone" value="{{$order->phone}}" readonly>
                        </div>
                        <div class="col-lg-12">
                            <label for="address">Address</label>
                            <input type="text" id="address"value="{{$order->address}}" readonly>
                        </div>
                        <div class="col-lg-12">
                            <label for="message">Message (Optional)</label>
                            <input type="text" id="message" value="{{$order->message}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="place-order">
                        <h4>Your Order</h4>
                        <div class="order-total">
                            <ul class="order-table">
                                <li>Product <span>Sub total</span></li>
                                @foreach ( $order->products as $product )
                                    <li class="fw-normal">{{$product->name }} x {{$product->pivot->quantity}} 
                                        <span>{{number_format($product->pivot->unit_price * $product->pivot->quantity)}} VNĐ</span>
                                    </li>
                                @endforeach
                                <li>Total Price
                                    <span>
                                        @if (session('total_price'))
                                            {{ number_format(session('total_price')) }} VNĐ
                                        @endif
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

@endsection
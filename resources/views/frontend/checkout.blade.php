@extends('frontend.layout.master')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <form method="POST" action="{{route('checkOutPost')}}" class="checkout-form">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Biiling Details</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="email">Email Address<span>*</span></label>
                                @error('email')
                                    <x-alert type="danger" message="{{ $message }}"/>
                                @enderror
                                <input type="text" name="email" id="email" value="{{Auth::user()->email}}">
                            </div>
                            <div class="col-lg-12">
                                <label for="name">Name<span>*</span></label>
                                @error('name')
                                    <x-alert type="danger" message="{{ $message }}"/>
                                @enderror
                                <input type="text" name="name" id="name" value="{{Auth::user()->name}}">
                            </div>
                            <div class="col-lg-12">
                                <label for="phone">Phone Number<span>*</span></label>
                                @error('phone')
                                    <x-alert type="danger" message="{{ $message }}"/>
                                @enderror
                                <input type="number" name="phone" id="phone">
                            </div>
                            <div class="col-lg-12">
                                <label for="address">Address<span>*</span></label>
                                @error('address')
                                    <x-alert type="danger" message="{{ $message }}"/>
                                @enderror
                                <input type="text" name="address" id="address">
                            </div>
                            <div class="col-lg-12">
                                <label for="message">Message (Optional)</label>
                                <input type="text" name="message" id="message">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Sub Total</span></li>
                                    @if (session('cart'))
                                        @foreach ( session('cart') as $product )
                                            <li class="fw-normal">{{$product['name']}} x {{$product['quantity']}} 
                                                <span>{{number_format($product['price'] * $product['quantity'])}} VNĐ</span>
                                            </li>
                                        @endforeach
                                    @endif
                                    <li>Total Price
                                        <span>
                                            @if (session('total_price'))
                                                {{ number_format(session('total_price')) }} VNĐ
                                            @endif
                                        </span>
                                    </li>
                                </ul>
                                <div class="order-btn">
                                    <button type="submit" class="site-btn place-btn">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

@endsection
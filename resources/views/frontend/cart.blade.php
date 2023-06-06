@extends('frontend.layout.master')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./home.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th><i class="ti-close"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session('cart'))
                                    @foreach(session('cart') as $product)
                                    <tr>
                                        <td class="cart-pic first-row"><img style='width: 100px' src="{{'storage/'.$product['image']}}" alt="{{$product['name']}}"></td>
                                        <td class="cart-title first-row">
                                            <a href="{{route('product', $product['product_id'])}}"><h5>{{$product['name']}}</h5></a>
                                        </td>
                                        <td class="p-price first-row">{{number_format($product['price'])}} VNĐ</td>
                                        <td class="qua-col first-row">{{$product['quantity']}}</td>
                                        <td class="total-price first-row">{{ number_format($product['price'] * $product['quantity'] )}} VNĐ</td>
                                        <td class="close-td first-row">
                                            <form method="POST" action="{{route('cart.delete', $product['product_id'])}}">
                                                @csrf
                                                <button type="submit" style="background: #fff; border: none;">
                                                    <i class="ti-close"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="cart-total">Total 
                                        <span>
                                            @if (session('total_price'))
                                                {{number_format(session('total_price'))}} VNĐ
                                            @endif
                                        </span>
                                    </li>
                                </ul>
                                <a href="{{route('checkOut')}}" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

@endsection
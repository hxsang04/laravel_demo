@extends('frontend.layout.master')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Đơn hàng đã mua</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date / Time</th>
                                    <th>Total Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::user()->orders as $order)
                                    <tr>
                                        <td class="cart-pic first-row ">#{{$order->id}}</td>
                                        <td class="first-row">
                                            {{$order->created_at}}
                                        </td>
                                        <td class="p-price first-row">{{number_format($order->total_price)}} VNĐ</td>
                                        <td class="close-td first-row">
                                            <a href="{{ route('orderHistoryDetail', $order)}}" >Chi tiết</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

@endsection
@extends('frontEnd.layouts.master')
@section('title','Review Order Page')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>My Orders</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Order Review Table Begin -->
    <section class="shop-cart spad">
        <div class="container">
            @if(Session::has('alert'))
                <div class="alert alert-danger text-center" role="alert">
                    {{session('alert')}}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table id="cartTable">
                            <thead>
                                <tr class="laptop_view">
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                <tr class="mobile_view">
                                    <th>Date</th>
                                    <th colspan="2">Detail Preview</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($review_orders->count() != 0)
                                    @foreach($review_orders as $review_order)
                                        @php
                                            $id = Crypt::encrypt($review_order->id);
                                        @endphp
                                        <tr class="laptop_view">
                                            <td class="cart__price rev_od">
                                                {{$review_order->order_date}}
                                            </td>
                                            <td class="cart__price rev_od">
                                                @if($review_order->preorder_status != 1)
                                                    In Stock
                                                @else
                                                    Pre Order
                                                @endif
                                            </td>
                                            <td class="cart__price rev_od">
                                                {{$review_order->total_quantity}}
                                            </td>
                                            <td class="cart__price rev_od">
                                                {{$review_order->final_cost}} MMK
                                            </td>
                                            <td class="cart__price rev_od">
                                                {{$review_order->payment_type}}
                                            </td>
                                            <td class="cart__price rev_od">
                                                @if ($review_order->status == 1)
                                                    Pending
                                                @elseif ($review_order->status == 3)
                                                    Delivering
                                                @elseif ($review_order->status == 4)
                                                    Completed
                                                @elseif ($review_order->status == 0)
                                                    @if ($review_order->preorder_status == 2)
                                                        Ordered
                                                    @elseif ($review_order->preorder_status == 3)
                                                        Arrived
                                                    @else
                                                        Confirmed
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="cart__delete">
                                                <a href="{{url('/review-order-detail',$id)}}" class="site-btn laptop_table_btn btn-viewall">Detail</a>
                                            </td>
                                        </tr>
                                        <tr class="mobile_view">
                                            <td class="cart__price rev_od">
                                                {{$review_order->order_date}}
                                            </td>
                                            <td class="cart__price rev_od">
                                                Type
                                                <br>
                                                Quantity
                                                <br>
                                                Total
                                                <br>
                                                Payment
                                                <br>
                                                Status
                                            </td>
                                            <td class="cart__price rev_od">
                                                @if($review_order->preorder_status == 1)
                                                    : Pre Order
                                                @elseif($review_order->preorder_status == 0)
                                                    : In Stock
                                                @endif
                                                <br>
                                                : {{$review_order->total_quantity}}
                                                <br>
                                                : {{$review_order->final_cost}} MMK
                                                <br>
                                                : {{$review_order->payment_type}}
                                                <br>
                                                @if ($review_order->status == 1)
                                                    : Pending
                                                @elseif ($review_order->status == 3)
                                                    : Delivering
                                                @elseif ($review_order->status == 4)
                                                    : Completed
                                                @elseif ($review_order->status == 0)
                                                    @if ($review_order->preorder_status == 2)
                                                        : Ordered
                                                    @elseif ($review_order->preorder_status == 3)
                                                        : Arrived
                                                    @else
                                                        : Confirmed
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="cart__delete">
                                                <a href="{{url('/review-order-detail',$id)}}" class="site-btn mobile_table_btn btn-viewall">
                                                    <span class="icon_document_alt"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">
                                            <div class="container text-center">
                                                <h5>No Pending Orders yet!</h5>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Order Review Table End -->
@endsection
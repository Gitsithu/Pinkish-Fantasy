@extends('frontEnd.layouts.master')
@section('title','My Favourites')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>My Favourites</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Favourite Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <!-- Alert begin -->
                        @if(Session::has('alert'))
                        <div class="flash-message col-md-12">
                            <div class="alert alert-danger">
                                {{session('alert')}}
                            </div>
                        </div>
                        @endif
                    <!-- Alert end -->
                    <div class="row">
                        @foreach($favourites as $favourite)
                            <?php
                                $id = Crypt::encrypt($favourite->id);
                            ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 mobile_product">
                                <div class="product__item">
                                    <div class="product__item__pic list_product_item set-bg" data-setbg="{{url($favourite->image_url1)}}">
                                        <ul class="product__hover">
                                            <li><a href="{{url($favourite->image_url1)}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            <li><a href="{{url('/remove_favourite',$favourite->id)}}"><span class="icon_trash_alt"></span></a></li>
                                            <li><a href="{{url('/item-detail',$id)}}"><span class="icon_document_alt"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        @if($favourite->name == null)
                                            <h6>Code : {{$favourite->item_code}}</h6>
                                        @else
                                            <h6>{{$favourite->name}}</h6>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-lg-12 text-center">
                            {{ $favourites->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Favourite Section End -->
@endsection
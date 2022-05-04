@extends('frontEnd.layouts.master')
@section('title','Career')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Career</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <section class="product spad pt-0">
        <div class="container">
            <section class="banner career">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 m-auto p-0">
                            <div class="banner__slider owl-carousel career_slider">
                                @foreach($career_img as $career)
                                    <div class="banner__item">
                                        <img src="{{ url($career->img_url) }}" class="career_img">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection
@extends('frontEnd.layouts.master')
@section('title','About Us')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>About Us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="blog__details__content">
                        <div class="blog__details__item">
                            <img src="{{$about_us->image}}" alt="">
                            <div class="blog__details__item__title">
                                <h4>{{$about_us->title}}</h4>
                                <ul>
                                    <li>by <span>{{$about_us->author}}</span></li>
                                    <li>{{$about_us->created_at}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog__details__desc">
                            <p>{{$about_us->paragraph1}}</p>
                            @if ($about_us->paragraph2 != null)
                                <p>{{$about_us->paragraph2}}</p>
                            @endif
                            @if ($about_us->paragraph3 != null)
                                <p>{{$about_us->paragraph3}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Product Categories</h4>
                            </div>
                            <ul>
                                <li><a>All <span>({{$all_items}})</span></a></li>
                                @foreach ($all_sub_categories as $sub_category)
                                    @if ($sub_category->total_items != 0)
                                        <li>
                                            <a style="cursor: default;">
                                                {{$sub_category->name}}
                                                <span>({{$sub_category->total_items}})</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Product Brands</h4>
                            </div>
                            <ul>
                                @foreach ($all_brands as $brand)
                                    @if ($brand->total_items != 0)
                                        <li>
                                            <a style="cursor: default;">
                                                {{$brand->name}}
                                                <span>({{$brand->total_items}})</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Trend Tags</h4>
                            </div>
                            <div class="blog__sidebar__tags">
                                <a>New Arrival</a>
                                <a>Best Seller</a>
                                <a>Promotion</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->
@endsection
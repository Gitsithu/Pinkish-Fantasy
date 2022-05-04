@extends('frontEnd.layouts.master')
@section('title','Pinkish Fantasy')
@section('slider')
    @if($promo_code != "")
        <div class="text-center promo-alert">
            <p>Dear Customers! You have a promo code ({{$promo_code->code}})!</p>
        </div>
    @endif
    @if (count($slider_img) != 0)
        @include('frontEnd.layouts.slider')
    @endif
@endsection
@section('content')
    <!-- Alert begin -->
        @if(Session::has('success'))
            <div class="flash-message col-md-12 mt-3 @if (count($slider_img) == 0 && $promo_code == "") no-slider @elseif (count($slider_img) == 0 && $promo_code != "") no-slider-with-promocode @endif">
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            </div>
        @elseif(Session::has('checkout_success'))
            <div class="flash-message col-md-12 mt-3 @if (count($slider_img) == 0 && $promo_code == "") no-slider @elseif (count($slider_img) == 0 && $promo_code != "") no-slider-with-promocode @endif">
                <div class="alert alert-success">
                    {{session('checkout_success')}}
                </div>
            </div>
        @endif
    <!-- Alert end -->

    <!-- New Product Section Begin -->
    @if($new_items != "")
        @if (Session::has('success') || Session::has('checkout_success'))
            <section class="product spad pt-5 mt-0">
        @else
            <section class="product spad pt-5 @if (count($slider_img) == 0 && $promo_code == "") mt-85 @elseif (count($slider_img) == 0 && $promo_code != "") mt-120 @endif">
        @endif
            <div class="container">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title text-center">
                        <div class="m-auto section-title-header">
                            <h4 class="mb-3">New Arrival</h4>
                        </div>
                    </div>
                </div>
                <div class="row property__gallery">
                    @foreach($new_items as $item)
                        <?php
                            $id = Crypt::encrypt($item->id);
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 mobile_product">
                            <div class="product__item">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner product__carousel">
                                        @for ($i = 1; $i < 9; $i++)
                                            @if($item->{'image_url'.$i} != "/item_images/")
                                                <div class="carousel-item {{$i == 1 ? 'active' : ''}}">
                                                    <div class="d-block product__item__pic set-bg" data-setbg="{{asset($item->{'image_url'.$i})}}" alt="">
                                                        @if(isset($item->promotion_id))
                                                            @if($item->promo_amount == null)
                                                                <div class="label sale">{{$item->promo_percent}}%</div>
                                                            @else
                                                                <div class="label sale">sale</div>
                                                            @endif
                                                        @else
                                                            <div class="label new">new</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endfor
                                        <ul class="product__hover">
                                            <li><a href="{{asset($item->image_url1)}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            @if(Auth::check())
                                                <?php
                                                    $favourite = DB::table('favourites')->where([['users_id', Auth::user()->id], ['items_id', $item->id]])->first();
                                                ?>
                                                @if($favourite == "")
                                                    <li><a href="{{url('/add_favourite',$item->id)}}"><span class="icon_heart_alt"></span></a></li>
                                                @endif
                                            @endif
                                        </ul>
                                        <div class="product__detail">
                                            @if(isset($item->promotion_id))
                                                <form method="GET" action="{{url('/item-detail',$id)}}">
                                                <input type="hidden" name="promotion_id" value="{{$item->promotion_id}}">
                                                <a onclick="this.closest('form').submit();return false;" class="click">
                                            @else
                                                <a href="{{url('/item-detail',$id)}}">
                                            @endif
                                                <div class="text">
                                                    <p>
                                                        @if($item->name == null)
                                                            Code - {{$item->item_code}}
                                                        @else
                                                            {{$item->name}}
                                                        @endif
                                                    </p>
                                                    @if($item->brand_name != null)
                                                        <p>{{$item->brand_name}}</p>
                                                    @endif
                                                    @if(isset($item->promotion_id))
                                                        <span class="text_span">{{number_format($item->saleprice)}} MMK</span>
                                                        <p>{{number_format($item->discount_price)}} MMK</p>
                                                    @else
                                                        <p>{{number_format($item->saleprice)}} MMK</p>
                                                    @endif
                                                </div>
                                            </a>
                                            @if(isset($item->promotion_id))
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-12 col-md-12 text-center">
                    <form method="GET" action="{{route('filter')}}">
                        <input type="hidden" name="trend" value="new">
                        <input type="submit" class="site-btn btn-viewall" value="VIEW ALL">
                    </form>
                </div>
            </div>
        </section>
    @endif
    <!-- New Product Section End -->

    <!-- Best Seller Section Begin -->
    @if($best_items != "")
        <section class="product spad">
            <div class="container">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title text-center">
                        <div class="m-auto section-title-header">
                            <h4 class="mb-3">Best Seller</h4>
                        </div>
                    </div>
                </div>
                <div class="row property__gallery">
                    @foreach($best_items as $item)
                        <?php
                            $id = Crypt::encrypt($item->id);
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 mobile_product">
                            <div class="product__item">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner product__carousel">
                                        @for ($i = 1; $i < 9; $i++)
                                            @if($item->{'image_url'.$i} != "/item_images/")
                                                <div class="carousel-item {{$i == 1 ? 'active' : ''}}">
                                                    <div class="d-block product__item__pic set-bg" data-setbg="{{asset($item->{'image_url'.$i})}}" alt="">
                                                        @if(isset($item->promotion_id))
                                                            @if($item->promo_amount == null)
                                                                <div class="label sale">{{$item->promo_percent}}%</div>
                                                            @else
                                                                <div class="label sale">sale</div>
                                                            @endif
                                                        @else
                                                            <div class="label best">best</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endfor
                                        <ul class="product__hover">
                                            <li><a href="{{asset($item->image_url1)}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            @if(Auth::check())
                                                <?php
                                                    $favourite = DB::table('favourites')->where([['users_id', Auth::user()->id], ['items_id', $item->id]])->first();
                                                ?>
                                                @if($favourite == "")
                                                    <li><a href="{{url('/add_favourite',$item->id)}}"><span class="icon_heart_alt"></span></a></li>
                                                @endif
                                            @endif
                                        </ul>
                                        <div class="product__detail">
                                            @if(isset($item->promotion_id))
                                                <form method="GET" action="{{url('/item-detail',$id)}}">
                                                <input type="hidden" name="promotion_id" value="{{$item->promotion_id}}">
                                                <a onclick="this.closest('form').submit();return false;" class="click">
                                            @else
                                                <a href="{{url('/item-detail',$id)}}">
                                            @endif
                                                <div class="text">
                                                    <p>
                                                        @if($item->name == null)
                                                            Code - {{$item->item_code}}
                                                        @else
                                                            {{$item->name}}
                                                        @endif
                                                    </p>
                                                    @if($item->brand_name != null)
                                                        <p>{{$item->brand_name}}</p>
                                                    @endif
                                                    @if(isset($item->promotion_id))
                                                        <span class="text_span">{{number_format($item->saleprice)}} MMK</span>
                                                        <p>{{number_format($item->discount_price)}} MMK</p>
                                                    @else
                                                        <p>{{number_format($item->saleprice)}} MMK</p>
                                                    @endif
                                                </div>
                                            </a>
                                            @if(isset($item->promotion_id))
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-12 col-md-12 text-center">
                    <form method="GET" action="{{route('filter')}}">
                        <input type="hidden" name="trend" value="best">
                        <input type="submit" class="site-btn btn-viewall" value="VIEW ALL">
                    </form>
                </div>
            </div>
        </section>
    @endif
    <!-- Best Seller Section End -->

    <!-- Promotion Section Begin -->
    @if($dis_items != "")
        <section class="product spad">
            <div class="container">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title text-center">
                        <div class="m-auto section-title-header">
                            <h4 class="mb-3">Promotion</h4>
                        </div>
                    </div>
                </div>
                <div class="row property__gallery">
                    @foreach($dis_items as $item)
                        <?php
                            $id = Crypt::encrypt($item->id);
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 mobile_product">
                            <div class="product__item">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner product__carousel">
                                        @for ($i = 1; $i < 9; $i++)
                                            @if($item->{'image_url'.$i} != "/item_images/")
                                                <div class="carousel-item {{$i == 1 ? 'active' : ''}}">
                                                    <div class="d-block product__item__pic set-bg" data-setbg="{{asset($item->{'image_url'.$i})}}" alt="">
                                                        @if($item->promo_amount == null)
                                                            <div class="label sale">{{$item->promo_percent}}%</div>
                                                        @else
                                                            <div class="label sale">sale</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endfor
                                        <ul class="product__hover">
                                            <li><a href="{{asset($item->image_url1)}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            @if(Auth::check())
                                                <?php
                                                    $favourite = DB::table('favourites')->where([['users_id', Auth::user()->id], ['items_id', $item->id]])->first();
                                                ?>
                                                @if($favourite == "")
                                                    <li><a href="{{url('/add_favourite',$item->id)}}"><span class="icon_heart_alt"></span></a></li>
                                                @endif
                                            @endif
                                        </ul>
                                        <div class="product__detail">
                                            <form method="GET" action="{{url('/item-detail',$id)}}">
                                            <input type="hidden" name="promotion_id" value="{{$item->promotion_id}}">
                                            <a onclick="this.closest('form').submit();return false;" class="click">
                                                <div class="text">
                                                    <p>
                                                        @if($item->name == null)
                                                            Code - {{$item->item_code}}
                                                        @else
                                                            {{$item->name}}
                                                        @endif
                                                    </p>
                                                    @if($item->brand_name != null)
                                                        <p>{{$item->brand_name}}</p>
                                                    @endif
                                                    <span class="text_span">{{number_format($item->saleprice)}} MMK</span>
                                                    <p>{{ number_format($item->discount_price) }} MMK</p>
                                                </div>
                                            </a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-12 col-md-12 text-center">
                    <form method="GET" action="{{route('allpromotions')}}">
                        <input type="submit" class="site-btn btn-viewall" value="VIEW ALL">
                    </form>
                </div>
            </div>
        </section>
    @endif
    <!-- Promotion Section End -->

    <!-- Instagram Begin -->
    @if (count($insta_img) != 0)
        <div class="instagram">
            @include('frontEnd.layouts.instagram')
        </div>
    @endif
    <!-- Instagram End -->

    <!-- Services Section Begin -->
    @if (count($ui_service) != 0)
        <section class="services spad">
            <div class="container">
                <div class="row">
                    @foreach($ui_service as $service)
                        @if (count($ui_service) == 4)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                        @elseif (count($ui_service) == 3)
                            <div class="col-lg-4 col-md-4 col-sm-6">
                        @elseif (count($ui_service) == 2)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                        @elseif (count($ui_service) == 1)
                            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        @endif
                            <div class="services__item">
                                <h6>{{ $service->title }}</h6>
                                <p>{{ $service->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- Services Section End -->

    <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>
@endsection

@section('javascript')
    <script>
        $('.carousel').carousel({
            interval: 2000
        })

        $(document).ready(function() {
            var checkout_success = '{{ Session::has('checkout_success') }}';
            if (checkout_success == 1) {
                localStorage.clear();
                $(".cart_tip").html(0);
                console.log("success");
            }
        })
    </script>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "154358638493632");
        chatbox.setAttribute("attribution", "biz_inbox");
  
        window.fbAsyncInit = function() {
            FB.init({
            xfbml            : true,
            version          : 'v12.0'
            });
        };
  
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>
@endsection
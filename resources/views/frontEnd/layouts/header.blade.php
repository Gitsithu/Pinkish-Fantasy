@php
    $logo = DB::table('ui_config')->where([['status',1],['indexname','Logo']])->value('img_url');
@endphp
<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__close">+</div>
    <div class="offcanvas__logo">
        <a href="{{url('/')}}"><img src="{{asset($logo)}}" alt=""></a>
    </div>
    <div class="offcanvas__auth">
        @if(Auth::check())
            <a href="{{url('/myaccount')}}">My Account</a>
            <a href="{{url('/logout')}}">Logout</a>
        @else
            <a href="{{url('/login_page')}}">Login</a>
            <a href="{{url('/login_page')}}">Register</a>
        @endif
    </div>
    <div id="mobile-menu-wrap"></div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header sticky-top">
    <div class="container-fluid">
        <div class="row laptop_site">
            <div class="col-xl-3 col-lg-2 col-md-2">
                <div class="header__logo">
                    <a href="{{url('/')}}"><img src="{{asset($logo)}}" alt="" class="header_logo_img"></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7 col-md-7">
                <nav class="header__menu text-center">
                <?php
                    $main_categories=DB::table('main_categories')->select('id','name')->where('status',1)->get();
                    $brands=DB::table('brands')->select('id','name')->where('status',1)->get();
                    $check_promotions = DB::table('promotion')
                                        ->where('promotion.status',1)
                                        ->where('promotion.start_date','<=',Carbon\Carbon::today()->toDateString())
                                        ->where('promotion.end_date','>=',Carbon\Carbon::today()->toDateString())
                                        ->count();
                    $promotions = DB::table('promotion')
                                    ->where('promotion.status',1)
                                    ->where('promotion.start_date','<=',Carbon\Carbon::today()->toDateString())
                                    ->where('promotion.end_date','>=',Carbon\Carbon::today()->toDateString())
                                    ->whereNull('promotion.promo_amount')
                                    ->groupBy('promotion.promo_percent')
                                    ->orderBy('promotion.promo_percent','desc')
                                    ->select('promotion.promo_percent')
                                    ->get();
                    $count_sale = DB::table('promotion')
                                    ->where('promotion.status',1)
                                    ->where('promotion.start_date','<=',Carbon\Carbon::today()->toDateString())
                                    ->where('promotion.end_date','>=',Carbon\Carbon::today()->toDateString())
                                    ->whereNull('promotion.promo_percent')
                                    ->count();
                ?>
                    <ul>
                        <li><a href="{{url('/')}}">Home</a></li>
                        @foreach($main_categories as $main_category)
                            <li><a href="{{route('maincat',$main_category->id)}}">{{$main_category->name}}</a>
                            <?php
                                $sub_categories=DB::table('sub_categories')->select('id','name')->where([['main_categories_id',$main_category->id],['status',1]])->get();
                            ?>
                                <ul class="dropdown dropdown_scrollbar" id="customize_scrollbar">
                                    @foreach($sub_categories as $sub_category) <!--17/03HH-->
                                        <li><a href="{{route('subcat',$sub_category->id)}}">{{$sub_category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                        <li><a class="click">Brands</a>
                            <ul class="dropdown dropdown_scrollbar" id="customize_scrollbar">
                                @foreach($brands as $brand)
                                    @if($brand->name != "" || $brand->name != NULL)
                                        <li><a href="{{route('brand',$brand->id)}}">{{$brand->name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        @if($check_promotions > 0)
                            <li><a href="{{route('allpromotions')}}">Promotions</a>
                                <ul class="dropdown dropdown_scrollbar" id="customize_scrollbar">
                                    @if($count_sale > 0)
                                        <li>
                                            <form method="GET" action="{{route('filter_promotions')}}">
                                                <input type="hidden" name="promotion" value="Sale">
                                                <a onclick="this.closest('form').submit();return false;" class="click">
                                                    Sale
                                                </a>
                                            </form>
                                        </li>
                                    @endif
                                    @foreach($promotions as $promotion)
                                        <li>
                                            <form method="GET" action="{{route('filter_promotions')}}">
                                                <input type="hidden" name="promotion" value="{{$promotion->promo_percent}}">
                                                <a onclick="this.closest('form').submit();return false;" class="click">
                                                    {{$promotion->promo_percent}}%
                                                </a>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if(Auth::check())
                            <li class="mobile_my_order" style="visibility: hidden;"><a href="{{url('/review-order')}}">My Orders</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3">
                <div class="header__right">
                    <ul class="header__right__widget">
                        <!-- Start Profile Icon 27/3 HH -->
                        <li><a href="{{url('/myaccount')}}"><span class="icon_profile"></span></a>
                            <ul class="dropdown dropdown_scrollbar" id="customize_scrollbar">
                                @if(Auth::check())
                                    <li><a href="{{url('/review-order')}}">MY ORDERS</a></li>
                                    <li><a href="{{url('/myaccount')}}">MY ACCOUNT</a></li>
                                    <li><a href="{{url('/logout')}}">LOGOUT</a></li>
                                @else
                                    <li><a href="{{url('/login_page')}}">LOGIN</a></li>
                                    <li><a href="{{url('/login_page')}}">REGISTER</a></li>
                                @endif
                            </ul>
                        </li>
                        <!-- End Profile Icon 27/3 HH -->
                        <li><span class="icon_search search-switch"></span></li>
                        <li><a href="{{url('/my_favourite')}}"><span class="icon_heart_alt"></span>
                            @if(Auth::check())
                            <?php
                                $fav_count=DB::table('favourites')->where([['users_id', Auth::user()->id]])->count();
                            ?>
                                <div class="tip">{{$fav_count}}</div>
                            @else
                                <div class="tip">0</div>
                            @endif
                        </a></li>
                        <li><a href="{{url('/viewcart')}}"><span class="icon_cart_alt"></span>
                                <div class="tip @if(Auth::check()) cart_tip @endif}}">0</div>
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mobile_site">
            <ul class="offcanvas__widget mobile_site_front">
                <li class="mobile-menu-icon">
                    <div class="canvas__open">
                        <i class="fa fa-bars"></i>
                    </div>
                </li>
                <li class="search-icon"><span class="icon_search search-switch"></span></li>
            </ul>
            <a href="{{url('/')}}"><h6 class="mobile_site_heading">Pinkish Fantasy</h6></a>
            <ul class="offcanvas__widget mobile_site_end">
                <li class="heart-icon"><a href="{{url('/my_favourite')}}"><span class="icon_heart_alt"></span>
                    @if(Auth::check())
                    <?php
                        $fav_count=DB::table('favourites')->where([['users_id', Auth::user()->id]])->count();
                    ?>
                        <div class="tip">{{$fav_count}}</div>
                    @else
                        <div class="tip">0</div>
                    @endif
                </a></li>
                <li><a href="{{url('/viewcart')}}"><span class="icon_bag_alt"></span>
                    <div class="tip @if(Auth::check()) cart_tip @endif}}">0</div>
                </a></li>
            </ul>
        </div>
    </div>
</header>
<!-- Header Section End -->
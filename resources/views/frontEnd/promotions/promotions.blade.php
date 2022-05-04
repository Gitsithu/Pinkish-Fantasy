@extends('frontEnd.layouts.master')
@section('title','Promotions')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <?php
                            if($byData != "") {
                                if($byData == "Sale") {
                                    echo '<a href="'.route("allpromotions").'">Promotions</a>';
                                    echo '<span>'.$byData.'</span>';
                                } else {
                                    echo '<a href="'.route("allpromotions").'">Promotions</a>';
                                    echo '<span>'.$byData.'%</span>';
                                }
                            } else {
                                echo '<span>Promotions</span>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Promotion Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <!-- Alert begin -->
                    @if(Session::has('success'))
                        <div class="flash-message col-md-12">
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        </div>
                    @endif
                <!-- Alert end -->
                <div class="col-lg-3 col-md-3 mb-5">
                    @include('frontEnd.promotions.promotion_menu')
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        @if(count($items) != 0)
                            @foreach($items as $item)
                                @if($item->status == 1)
                                <?php
                                    $id = Crypt::encrypt($item->id);
                                ?>
                                    <div class="col-lg-4 col-md-6 col-sm-6 mobile_product">
                                        <div class="product__item">
                                            <div class="product__item__pic list_product_item set-bg" data-setbg="{{url($item->image_url1)}}">
                                                <ul class="product__hover">
                                                    <li><a href="{{url($item->image_url1)}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                                    @if(Auth::check())
                                                        <?php
                                                            $favourite = DB::table('favourites')->where([['users_id', Auth::user()->id], ['items_id', $item->id]])->first();
                                                        ?>
                                                        @if($favourite == "")
                                                            <li><a href="{{url('/add_favourite',$item->id)}}"><span class="icon_heart_alt"></span></a></li>
                                                        @endif
                                                    @endif
                                                    <li>
                                                        @if(isset($item->promotion_id))
                                                            <form method="GET" action="{{url('/item-detail',$id)}}">
                                                                <input type="hidden" name="promotion_id" value="{{$item->promotion_id}}">
                                                                <a onclick="this.closest('form').submit();return false;"><span class="icon_document_alt"></span></a>
                                                            </form>
                                                        @else
                                                            <a href="{{url('/item-detail',$id)}}"><span class="icon_document_alt"></span></a>
                                                        @endif
                                                    </li>
                                                </ul>
                                                @if(isset($item->promotion_id))
                                                    @if($item->promo_amount == null)
                                                        <div class="label new">{{ $item->promo_percent }}%</div>
                                                    @else
                                                        <div class="label new">Sale</div>
                                                    @endif
                                                @else
                                                    @if(Session::get('trend') == "new")
                                                        <div class="label new">new</div>
                                                    @elseif(Session::get('trend') == "best")
                                                        <div class="label new">best</div>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="product__item__text">
                                                <h6>
                                                    @if($item->name == null)
                                                        Code : {{$item->item_code}}
                                                    @else
                                                        {{$item->name}}
                                                    @endif
                                                </h6>
                                                @if($item->brand_name != null)
                                                    <p>
                                                        {{$item->brand_name}}
                                                    </p>
                                                @endif
                                                @if(isset($item->promotion_id))
                                                    <div class="product__price">
                                                        <span>{{number_format($item->saleprice)}} MMK</span>
                                                    </div>
                                                    <div class="product__price">
                                                        {{ number_format($item->discount_price) }} MMK
                                                    </div>
                                                @else
                                                    <div class="product__price">{{number_format($item->saleprice)}} MMK</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="col-lg-12 text-center">
                                {{ $items->appends($data)->links() }}
                            </div>
                        @else
                            <p class="m-auto">No matches found accroding to your filter!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Promotion Section End -->

    <!-- Mobile Filter Modal Start -->
    <div class="modal fade" tabindex="-1" id="filter_modal" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Product Filter Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="GET" action="{{route('filter_promotions')}}">
                        <div class="shop__sidebar">
                            <div class="sidebar__sizes">
                                <div class="section-title">
                                    <h4>Promotions</h4>
                                </div>
                                <div class="size__list">
                                    <label for="L_all">
                                        All Promotions
                                        <input type="radio" id="L_all" class="radio" name="promotion" value="All"
                                        {{ Session::get('promotion') == 'All' ? 'checked' : 'checked' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="L_sale">
                                        Sale
                                        <input type="radio" id="L_sale" class="radio" name="promotion" value="Sale"
                                        {{ Session::get('promotion') == 'Sale' ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                    @if(!$promotions->isEmpty())
                                        @foreach($promotions as $promotion)
                                            <label for="L_percent_{{$promotion->promo_percent}}">
                                                {{$promotion->promo_percent}}%
                                                <input type="radio" id="L_percent_{{$promotion->promo_percent}}" class="radio" name="promotion" value="{{$promotion->promo_percent}}"
                                                {{ Session::get('promotion') == $promotion->promo_percent ? 'checked' : '' }}>
                                                <span class="checkmark"></span>
                                            </label>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="filter_btn mr-3 to_filter" value="Filter">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Filter Modal End -->
@endsection

@section('javascript')
    <script>
    </script>
@endsection
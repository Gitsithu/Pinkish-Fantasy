@extends('frontEnd.layouts.master')
@section('title','Pinkish Fantasy')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <a href="{{url('/list-products')}}"> Products</a>
                        <span>
                            @if($detail_item->name == "")
                                {{ $detail_item->item_code }}
                            @else
                                {{ $detail_item->name }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <!-- Alert begin -->
                    @if(Session::has('success'))
                        <div class="flash-message col-md-12">
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        </div>
                    @elseif(Session::has('alert'))
                        <div class="flash-message col-md-12">
                            <div class="alert alert-danger">
                                {{session('alert')}}
                            </div>
                        </div>
                    @endif
                <!-- Alert end -->

                <!-- Product Detail Start 01-Apr HH -->
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                            @for ($i = 1; $i < 9; $i++)
                                @if($detail_item->{'image_url'.$i} != "/item_images/")
                                    <img data-hash="product-{{$i}}" class="product__big__img" src="{{url($detail_item->{'image_url'.$i})}}" alt="">
                                @endif
                            @endfor
                            </div>
                        </div>
                        <div class="product__details__pic__left product__thumb nice-scroll" id="horizontal_scrollbar">
                            @for ($i = 1; $i < 9; $i++)
                                @if($detail_item->{'image_url'.$i} != "/item_images/")
                                <a class="pt active" href="#product-{{$i}}">
                                    <img src="{{url($detail_item->{'image_url'.$i})}}" alt="">
                                </a>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
                <!-- Product Detail End 01-Apr HH -->
                <div class="col-lg-6">
                    <input type="hidden" value="{{ Auth::check() ? Auth::user()->id : '' }}" id="user_id" placeholder="user_id">
                    <input type="hidden" name="org_order_type" value="{{$detail_item->sale_type == "0" ? 'Instock' : 'Preorder'}}" id="org_order_type" placeholder="original_order_type">
                    <input type="hidden" name="order_type" value="" id="dynamicOrderType" placeholder="dynamicOrderType">
                    <input type="hidden" name="item_id" value="{{$detail_item->id}}" id="dynamicItemid" placeholder="dynamicItemid">
                    <input type="hidden" name="item_spec_id" value="" id="dynamicItemSpec" placeholder="dynamicItemSpec">
                    <input type="hidden" name="item_name" value="{{$detail_item->name}}" id="dynamicItemname" placeholder="dynamicItemname">
                    <input type="hidden" name="item_code" value="{{$detail_item->item_code}}" id="dynamicItemcode" placeholder="dynamicItemcode">
                    <input type="hidden" name="item_image" value="{{$detail_item->image_url1}}" id="itemimage" placeholder="itemimage">
                    <input type="hidden" name="item_size" value="" id="dynamicSizeInput" placeholder="dynamicSizeInput">
                    <input type="hidden" name="item_color" value="" id="dynamicColorInput" placeholder="dynamicColorInput">
                    <input type="hidden" name="item_instock" value="" id="dynamicInstockInput" placeholder="dynamicInstockInput">
                    <input type="hidden" name="item_qty" value="" id="dynamicQtyInput" placeholder="dynamicQtyInput">
                    <input type="hidden" name="item_promotion" value="{{$detail_item->promotion_id}}" id="dyanmicItemPromotion" placeholder="dyanmicItemPromotion">
                    <input type="hidden" name="item_promotion_percent" value="{{$detail_item->promo_percent}}" id="dyanmicItemPromotionPercent" placeholder="dyanmicItemPromotionPercent">
                    <input type="hidden" name="item_promotion_amount" value="{{$detail_item->promo_amount}}" id="dyanmicItemPromotionAmount" placeholder="dyanmicItemPromotionAmount">
                    @if($detail_item->promo_amount == null && $detail_item->promo_percent == null)
                        <input type="hidden" name="item_price" value="{{$detail_item->saleprice}}" id="dynamicItemprice" placeholder="dynamicItemprice">
                    @else
                        <input type="hidden" name="item_price" value="{{$detail_item->discount_price}}" id="dynamicItemprice" placeholder="dynamicItemprice">
                    @endif

                    <div class="product__details__text">
                        @if($detail_item->name == null)
                            <h3>Code : {{$detail_item->item_code}}
                                @if($detail_item->brand_name != null)
                                    <span>{{$detail_item->brand_name}}</span>
                                @endif
                            </h3>
                        @else
                            <h3>{{$detail_item->name}}
                                <span>
                                    @if($detail_item->brand_name != null)
                                        {{$detail_item->brand_name}}
                                    @endif
                                </span>
                                <span>CodeID: {{$detail_item->item_code}}</span>
                            </h3>
                        @endif
                        <div class="product__details__price" id="dynamic_price">
                        @if($detail_item->promo_amount == null && $detail_item->promo_percent == null)
                            <p>{{number_format($detail_item->saleprice)}} MMK</p>
                        @elseif ($detail_item->promo_percent == null)
                            <span>{{number_format($detail_item->saleprice)}} MMK</span>
                            <p>{{number_format($detail_item->discount_price)}} MMK (Sale)<p>
                        @elseif ($detail_item->promo_amount == null)
                            <span>{{number_format($detail_item->saleprice)}} MMK</span>
                            <p>{{number_format($detail_item->discount_price)}} MMK ({{$detail_item->promo_percent}}%)<p>
                        @endif
                        </div>
                        <div class="product__details__widget mb-3">
                            <p style="background:#f5a8ae">* Please choose Size first, then Color and fill Quantity before Adding to Cart!</p>
                            <ul>
                                <li>
                                    <span>Availability:</span>
                                    <div class="stock__checkbox">
                                        @if($detail_item->sale_type == "0")
                                            <p id="availableStock">
                                                In Stock
                                            </p>
                                        @else
                                            <p id="availableStock">
                                                Pre Order
                                            </p>
                                        @endif
                                    </div>
                                </li>
                                @if($detail_item->sale_type == "0")
                                    <li class="stock_qty">
                                        <span>In Stock Amount:</span>
                                        <div class="color__checkbox">
                                            <p class="inputStock">{{$detail_item->total_instock}}</p>
                                        </div>
                                    </li>
                                @endif
                                <li>
                                    <span>Available size:</span>
                                    <div class="size__btn">
                                        <?php
                                            $list_size = array();
                                            foreach ($detail_item->specifications as $item_spec) {
                                                $size = $item_spec->size;
                                                array_push($list_size, $size);
                                            }

                                            $filter_size = array_unique($list_size);
                                        ?>
                                        <input type="hidden" id="count_size" value="{{ (count($filter_size) == 1) ? 1 : 0 }}">
                                        <div style="margin-left: 150px;">
                                            @foreach($filter_size as $size)
                                                <label for="{{$size}}" class="{{ (count($filter_size) == 1) ? 'active' : '' }}">
                                                    <input type="radio" class="idSize" id="{{$size}}" value="{{$item_spec->items_id}}-{{$size}}">
                                                    {{$size}}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                                <li id="checkbox">
                                    <span>Available color:</span>
                                    <div class="color__checkbox">
                                        <?php
                                            $list_color = array();
                                            foreach ($detail_item->specifications as $item_spec) {
                                                $color = $item_spec->color;
                                                array_push($list_color, $color);
                                            }

                                            $filter_color = array_unique($list_color);
                                        ?>
                                        <div style="margin-left: 150px;">
                                            @foreach($filter_color as $color)
                                                <label class="color" for="{{$color}}">
                                                    <input type="radio" class="idColor" name="color__radio" id="{{$color}}" {{ (count($filter_size) == 1) ? '' : 'disabled' }}>
                                                    <span class="checkmark" style="background:{{$color}} !important;"></span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                                <li id="checkbox2">
                                    <span>Available color:</span>
                                    <div class="color__checkbox checkbox2" style="margin-left: 150px">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="product__details__button" style="margin-bottom: 5px;">
                            <div class="quantity">
                                <span>Quantity:</span>
                                <div class="pro-qty pro-qty-UI">
                                    @if($detail_item->sale_type == "0")
                                    <input type="number" class="customized_input_number" value="1" id="inputStock" onkeypress="return numbersOnly(event)" max="{{$detail_item->total_instock}}" min="1">
                                    @else
                                    <input type="number" class="customized_input_number" value="1" id="inputStock" onkeypress="return numbersOnly(event)" max="30" min="1">
                                    @endif
                                </div>
                            </div>
                            <button class="cart-btn" id="buttonAddToCart">
                                <span class="icon_bag_alt"></span> Add to cart
                            </button>
                            <ul>
                                @if(Auth::check())
                                    <?php
                                        $favourite = DB::table('favourites')->where([['users_id', Auth::user()->id], ['items_id', $detail_item->id]])->first();
                                    ?>
                                    @if($favourite == "")
                                        <li><a href="{{url('/add_favourite',$detail_item->id)}}"><span class="icon_heart_alt"></span></a></li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                        <p class="outofstock hidden">* Currently this item is out of stock! Please come back later!</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                            </li>
                            @if ($detail_item->description != null || $detail_item->description != "")
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                                </li>
                            @else
                                @if ($detail_item->image_url10 != "/item_images/")
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                                    </li>
                                @endif
                            @endif
                            @if($related_items != "")
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Related</a>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                @if ($detail_item->remark != null || $detail_item->remark != "")
                                    <ul class="mb-3 mx-2">
                                        <li>
                                            <label><b>Remark</b> /</label>
                                            <span>{{$detail_item->remark}}</span>
                                        </li>
                                    </ul>
                                @endif
                                @for ($i = 1; $i < 10; $i++)
                                    @if($detail_item->{'image_url'.$i} != "/item_images/")
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="description__item">
                                            <div class="product__item__pic description__item__pic set-bg" data-setbg="{{url($detail_item->{'image_url'.$i})}}">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endfor
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <h6>Size Guide</h6>
                                @if ($detail_item->description != null || $detail_item->description != "")
                                    <ul class="mb-3 mx-2">
                                        <li>
                                            <span>Description / {{$detail_item->description}}</span>
                                        </li>
                                    </ul>
                                @endif
                                @if($detail_item->image_url10 != "/item_images/")
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="description__item">
                                            <img src="{{url($detail_item->image_url10)}}" alt="" class="size_guide_img">
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @if($related_items != "")
                                <div class="tab-pane" id="tabs-3" role="tabpanel">
                                    <div class="row">
                                        @foreach($related_items as $item)
                                            <?php
                                                $id = Crypt::encrypt($item->id);
                                            ?>
                                            @if($item->status == 1)
                                            <?php
                                                $item_specs=DB::table('items_specification')->select('size')->where('items_specification.items_id','=',$item->id)->get();
                                            ?>
                                            <div class="col-lg-3 col-md-4 col-sm-6 mobile_product">
                                                <div class="product__item">
                                                    <div id="carouselExampleControls" class="carousel1 slide" data-ride="carousel1">
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
                                                            <ul class="product__hover detail_product_hover">
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
                                                            <div class="product__detail detail__page">
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
                                                                            <p>Brand : {{$item->brand_name}}</p>
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
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->
@endsection

@section('javascript')
    <script>
        $('.carousel1').carousel({
                interval: 2000
        })

        $(document).ready(function () {
            $("#checkbox2").hide();
            $("#horizontal_scrollbar").removeAttr('style');
        });

        var count_size = $("#count_size").val();
        if (count_size != 1) {
            $('.idSize').click(function () {
                $("#checkbox").hide();
                $("#checkbox2").hide();
                $(".color").remove();
            });
        }

        document.getElementById("inputStock").oninput = function () {hiddenqty()};
        function hiddenqty() {
            var qty = document.getElementById("inputStock").value;
            $("#dynamicQtyInput").val(qty);
        }

        $('#buttonAddToCart').click(function() {
            var user_id = $('#user_id').val();
            var ordertype = $('#dynamicOrderType').val();
            var id = $('#dynamicItemid').val();
            var name = $('#dynamicItemname').val();
            var code = $('#dynamicItemcode').val();
            var spec_id = $('#dynamicItemSpec').val();
            var image = $('#itemimage').val();
            var size = $('#dynamicSizeInput').val();
            var color = $('#dynamicColorInput').val();
            var stock = parseInt($('#dynamicInstockInput').val());
            if($('#dynamicQtyInput').val() != "") {
                var qty = parseInt($('#dynamicQtyInput').val());
            } else {
                var qty = "";
            }
            var promotion = $('#dyanmicItemPromotion').val();
            var promo_percent = $('#dyanmicItemPromotionPercent').val();
            var promo_amount = $('#dyanmicItemPromotionAmount').val();
            var price = parseInt($('#dynamicItemprice').val());
            var subtotal = price * qty;

            var item = {
                ordertype:ordertype,
                id:id,
                name:name,
                code:code,
                spec_id:spec_id,
                image:image,
                size:size,
                color:color,
                stock:stock,
                qty:qty,
                promotion:promotion,
                promo_percent:promo_percent,
                promo_amount:promo_amount,
                price:price,
                subtotal:subtotal
            }

            var cart = localStorage.getItem('cart');
            var cartobj = JSON.parse(cart);
            var hasid = false;
            if(user_id == "") {
                alert('You must login first in order to shop in this website!')
                window.location.href="/login_page";
            } else {
                if(size == "") {
                    alert('Please Choose Size First!');
                } else {
                    if(color == "") {
                        alert('Please also Choose Color!');
                    } else {
                        if (qty == "") {
                            alert('You cannot add products to Shopping cart without quantity!');
                        } else if (qty == 0) {
                            alert('You cannot add products to Shopping cart with Quantity 0!');
                        } else {
                            if(ordertype == 0 ) {
                                if(qty > stock) {
                                    alert('Your Order amount must be less than In-stock amount!');
                                } else {
                                    if(!cart) {
                                        cart='{"itemlist":[]}';
                                        cartobj = JSON.parse(cart);
                                        cartobj.itemlist.push(item);
                                        localStorage.setItem('cart',JSON.stringify(cartobj));
                                        alert('Successfully added to Shopping Cart!');
                                        count_item();
                                        window.location.reload();
                                    } else {
                                        if(cartobj.itemlist.length >= 10) {
                                            alert('You cannot add more than 10 items in Shopping cart!');
                                        } else {
                                            $.each(cartobj.itemlist, function(i,v) {
                                                if(v.ordertype == ordertype) {
                                                    if(v.id == id && v.spec_id == spec_id) {
                                                        hasid = true;
                                                        var new_quantity = v.qty + qty;
                                                        var cart_stock = v.stock;
                                                        if(new_quantity > v.stock) {
                                                            alert('Your Order amount must be less than In-stock amount!');
                                                            prevent.default(e);
                                                        } else {
                                                            v.qty = new_quantity;
                                                            v.subtotal = price * new_quantity;
                                                        }
                                                    }
                                                } else {
                                                    alert('You can add only Instock or Only Preorder Products in Same Shopping Cart!');
                                                    prevent.default(e);
                                                }
                                            })
                                            if(!hasid) {
                                                cartobj.itemlist.push(item);
                                            }
                                            localStorage.setItem('cart',JSON.stringify(cartobj));
                                            alert('Successfully added to Shopping Cart!');
                                            count_item();
                                            window.location.reload();
                                        }
                                    }
                                }
                            } else {
                                if(qty > 30) {
                                    alert('You cannot Pre-order more than 30 amounts!');
                                } else {
                                    if(!cart) {
                                        cart='{"itemlist":[]}';
                                        var cartobj = JSON.parse(cart);
                                        cartobj.itemlist.push(item);
                                        localStorage.setItem('cart',JSON.stringify(cartobj));
                                        alert('Successfully added to Shopping Cart!');
                                        count_item();
                                        window.location.reload();
                                    } else {
                                        if(cartobj.itemlist.length >= 10) {
                                            alert('You cannot add more than 10 items in Shopping cart!');
                                        } else {
                                            $.each(cartobj.itemlist, function(i,v) {
                                                if(v.ordertype == ordertype) {
                                                    if(v.id == id && v.spec_id == spec_id) {
                                                        hasid = true;
                                                        var new_quantity = v.qty + qty;
                                                        if(new_quantity > 30) {
                                                            alert('You cannot Pre-order more than 30 amounts!');
                                                            prevent.default(e);
                                                        } else {
                                                            v.qty = new_quantity;
                                                            v.subtotal = price * new_quantity;
                                                        }
                                                    }
                                                } else {
                                                    alert('You can add only Instock or Only Preorder Products in Same Shopping Cart!');
                                                    prevent.default(e);
                                                }
                                            })
                                            if(!hasid) {
                                                cartobj.itemlist.push(item);
                                            }
                                            localStorage.setItem('cart', JSON.stringify(cartobj));
                                            alert('Successfully added to Shopping Cart!');
                                            count_item();
                                            window.location.reload();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        })
    </script>
@endsection

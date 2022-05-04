@extends('frontEnd.layouts.master')
@section('title','Cart Page')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <!-- Alert begin -->
                @if(Session::has('success'))
                    <div class="flash-message col-md-12 px-0">
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    </div>
                @elseif(Session::has('alert'))
                    <div class="flash-message col-md-12 px-0">
                        <div class="alert alert-danger">
                            {{session('alert')}}
                        </div>
                    </div>
                @endif
            <!-- Alert end -->
            @if ($deli_promo != "")
                <div class="flash-message col-md-12 px-0 deli_promo_alert hidden">
                    <div class="alert text-center">
                        Dear Customers! You Have Delivery Free Promotion for {{$deli_promo}} MMK or above!
                    </div>
                </div>
            @endif
            <div class="row">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table id="cartTable">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="cart__btn">
                                <a href="{{url('/list-products')}}">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <!-- @if(Session::has('message_coupon'))
                                <div class="alert alert-danger text-center" role="alert">
                                    {{Session::get('message_coupon')}}
                                </div>
                            @endif
                            <div class="discount__content">
                                <h6>Discount codes</h6>
                                <form action="{{url('/apply-coupon')}}" method="post" role="form">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="Total_amountPrice" id="Total_amountPrice" value="0">
                                    <input type="text" name="coupon_code" id="coupon_code" placeholder="Enter your coupon code">
                                    <button type="submit" class="site-btn">Apply</button>
                                    <span class="text-danger">{{$errors->first('coupon_code')}}</span>
                                </form>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-2">
                    @if(Session::has('message_apply_sucess'))
                        <div class="alert alert-success text-center" role="alert">
                            {{Session::get('message_apply_sucess')}}
                        </div>
                    @endif
                    <div class="cart__total__procced total_area">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Total <span class="Total_amountPrice"></span></li>
                        </ul>
                        <a href="{{url('/check-out')}}" class="site-btn primary-btn hidden" id="checkout">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            getCart();
        })
        /*-------------------
        Get Cart Item
        ---------------------*/
        function getCart() {
            var cart = localStorage.getItem('cart');
            var cartobj = JSON.parse(cart);
            if (cart) {
                $("#checkout").removeClass('hidden');
                $(".deli_promo_alert").removeClass('hidden');
                if (cartobj.itemlist.length == 0) {
                    localStorage.clear();
                    $(".cart_tip").html(0);

                    $("#cartTable tbody").html('');
                    var tr_data = $("<tr><td colspan=\"4\"><div class=\"container text-center\"><h5>No Items in Cart Yet!</h5></div></tr>");
                    $("#cartTable tbody").append(tr_data);
                    $(".Total_amountPrice").text('0 MMK');
                    $("#checkout").addClass('hidden');
                    $(".deli_promo_alert").addClass('hidden');
                } else {
                    var total = 0;
                    var html = '';
                    $.each(cartobj.itemlist,function(i,v) {
                        var user_id = v.user_id;
                        if (v.ordertype == 0) {
                            var ordertype = "Instock";
                        } else {
                            var ordertype = "Preorder";
                        }
                        var id = v.id;
                        var spec_id = v.spec_id;
                        if (v.name == "") {
                            var item = "Code_"+v.code;
                        } else {
                            var item = v.name;
                        }
                        var image = v.image;
                        var size = v.size;
                        var color = v.color;
                        var qty = v.qty;
                        if (v.ordertype == 0) {
                            var stock = v.stock;
                        } else {
                            var stock = 30;
                        }
                        if (v.promotion != "") {
                            if (v.promo_percent != "") {
                                var promotion = " / "+v.promo_percent+"%";
                            } else {
                                var promotion = " / Sale";
                            }
                        } else {
                            var promotion = "";
                        }
                        var price = v.price;
                        var subtotal = v.subtotal;
                        total += subtotal;
                        html +=`<tr>
                        <td class="cart__product__item">
                            <img class="cart_img" src="${image}">
                            <div class="cart__product__item__title">
                                <h6>${item} (${ordertype}${promotion})</h6>
                                <div class="rating row cart-row ml-0 mt-1">
                                    <div>${size} |</div>
                                    <span class="color-bg" style="background: ${color} !important;"></span>
                                </div>
                            </div>
                        </td>
                        <td class="cart__price">
                            ${new Intl.NumberFormat().format(price)} MMK
                        </td>
                        <td class="cart__quantity">
                            <div class="pro-qty">
                                <span class="dec qtybtn">-</span>
                                <input type="number" class="cart_quantity_input inputQty customized_input_number" onkeypress="return cart_numbersOnly(event)" value="${qty}" data-id="${id}" data-spec="${spec_id}" autocomplete="off" size="2" min="1" max="${stock}">
                                <span class="inc qtybtn">+</span>
                            </div>
                        </td>
                        <td class="cart__total">
                            ${new Intl.NumberFormat().format(subtotal)} MMK
                        </td>
                        <td class="cart__close cart_delete">
                            <a class="cart_quantity_delete" data-id="${id}" data-spec="${spec_id}">
                                <span class="icon_trash_alt"></span>
                            </a>
                        </td></tr>`;
                    })
                    $("#Total_amountPrice").attr('value',total);
                    $(".Total_amountPrice").text(new Intl.NumberFormat().format(total)+' MMK');
                    $("#cartTable tbody").html(html);
                }
            } else {
                var tr_data = $("<tr><td colspan=\"4\"><div class=\"container text-center\"><h5>No Items in Cart Yet!</h5></div></tr>");
                $("#cartTable tbody").append(tr_data);
                $(".Total_amountPrice").text('0 MMK');
            }
        }

        $(document).on('click', '.qtybtn', function() {
            var maxValue = parseFloat($(this).parent().find('input').attr('max'));
            var oldValue = parseFloat($(this).parent().find('input').val());
            if ($(this).hasClass('inc')) {
                // Don't allow incrementing above maximum value
                if (oldValue < maxValue) {
                    var newVal = oldValue + 1;
                } else if (oldValue > maxValue) {
                    newVal = maxValue;
                } else {
                    newVal = oldValue;
                }
            } else {
                // Don't allow decrementing below one
                if (oldValue > maxValue) {
                    var newVal = maxValue;
                } else if (oldValue > 1) {
                    newVal = oldValue - 1;
                } else {
                    newVal = 1;
                }
            }
            $(this).parent().find('input').val(newVal);
            var id = $(this).parent().find('input').data('id');
            var spec_id = $(this).parent().find('input').data('spec');

            var cart = localStorage.getItem('cart');
            var cartobj = JSON.parse(cart);
            $.each(cartobj.itemlist,function(i,v) {
                if (v.id == id && v.spec_id == spec_id) {
                    v.qty = newVal;
                    v.subtotal = v.price * newVal;
                }
            })
            localStorage.setItem('cart',JSON.stringify(cartobj));
            getCart();
            count_item();
        })

        function cart_numbersOnly(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            var value = Number(event.target.value + event.key) || 0;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
        }

        $(document).on('blur', '.inputQty', function() {
            var id = $(this).data('id');
            var spec_id = $(this).data('spec');
            var max = parseInt($(this).attr('max'));
            var qty = $(this).val();

            var cart = localStorage.getItem('cart');
            var cartobj = JSON.parse(cart);
            if (qty == "" || qty == 0) {
                if (confirm('You are inputting 0 or empty in quantity! So,are you sure to remove this item from shopping cart!')) {
                    for (var i = 0; i < cartobj.itemlist.length; i++) {
                        if (cartobj.itemlist[i].id == id && cartobj.itemlist[i].spec_id == spec_id) {
                            cartobj.itemlist.splice(i,1);
                            break;
                        }
                    }
                    localStorage.setItem('cart',JSON.stringify(cartobj));
                    getCart();
                    count_item();
                } else {
                    for (var i = 0; i < cartobj.itemlist.length; i++) {
                        if(cartobj.itemlist[i].id == id && cartobj.itemlist[i].spec_id == spec_id) {
                            $(this).val(cartobj.itemlist[i].qty);
                            break;
                        }
                    }
                }
            } else if (parseInt(qty) > max) {
                alert('This item has only '+max+' stock amounts! Therefore,you cannot add items more than existing stock quantity!')
                for (var i = 0; i < cartobj.itemlist.length; i++) {
                    if(cartobj.itemlist[i].id == id && cartobj.itemlist[i].spec_id == spec_id) {
                        $(this).val(cartobj.itemlist[i].qty);
                        break;
                    }
                }
            } else {
                for (var i = 0; i < cartobj.itemlist.length; i++) {
                    if(cartobj.itemlist[i].id == id && cartobj.itemlist[i].spec_id == spec_id) {
                        cartobj.itemlist[i].qty = parseInt(qty);
                        cartobj.itemlist[i].subtotal = cartobj.itemlist[i].price * parseInt(qty);
                        break;
                    }
                }
                localStorage.setItem('cart',JSON.stringify(cartobj));
                getCart();
                count_item();
            }
        })

        $(document).on('click', '.cart_quantity_delete', function() {
            var id = $(this).data('id');
            var spec_id = $(this).data('spec');
            if(confirm("Are you sure to remove this item from your Shopping Cart?")) {
                var cart = localStorage.getItem('cart');
                var cartobj = JSON.parse(cart);
                for (var i = 0; i < cartobj.itemlist.length; i++) {
                    if(cartobj.itemlist[i].id == id && cartobj.itemlist[i].spec_id == spec_id){
                        cartobj.itemlist.splice(i,1);
                    }
                }
                localStorage.setItem('cart',JSON.stringify(cartobj));
                getCart();
                count_item();
            }
        })
    </script>
@endsection

@extends('frontEnd.layouts.master')
@section('title','Order Detail Page')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <a href="{{url('/review-order')}}"> My Orders</a>
                        <span>Order Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Order Detail Begin -->
    <section class="services spad">
        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{session('success')}}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h4 class="mb-3">Order Detail</h4>
                        <p>Ref&nbsp;&nbsp;:&nbsp;&nbsp;{{$order->id}}</p>
                    </div>
                </div>
                <div class="col-lg-9 col-md-6 col-sm-12">
                    <div class="services__item" style="padding-left: 65px;">
                        <i class="fa fa-address-card"></i>
                        <h6>{{$order->contact_name}} </h6>
                        @php
                            $id = Crypt::encrypt($order->id);
                            $delivery = DB::table('delivery')->where('id',$order->delivery_id)->select('division','township')->first();
                        @endphp
                        <p>
                            {{$order->delivery_address}},
                            @if($delivery->division == 1)
                                Yangon Division
                            @elseif($delivery->division == 2)
                                Mandalay Division
                            @else
                                Other
                            @endif
                            @if($delivery->township != null)
                                , {{$delivery->township}} Township
                            @endif
                            <br> {{$order->phone}}, {{$order->email}}
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="services__item" style="padding-left: 65px;">
                        <i class="fa fa-calendar"></i>
                        <h6>Date : {{$order->order_date}} </h6>
                        <p>
                            @if($order->preorder_status != 1)
                                In Stock, {{$order->payment_type}}
                            @else
                                Pre-order, {{$order->payment_type}}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shop-cart spad pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Sub-Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($order_details as $order_detail)
                                <?php
                                    $item = DB::table('items')->where('id',$order_detail->item_id)->first();
                                    $item_spec = DB::table('items_specification')->where('id',$order_detail->specification_id)->first();
                                    $promotion = DB::table('promotion')->where('id',$order_detail->promotion_id)->select('promo_amount','promo_percent')->first();
                                    $promo_discount = DB::table('promo_code')->where('id',$order->promo_code_id)->select('promo_amount','promo_percent')->first();
                                ?>
                                <tr>
                                    <td class="cart__product__item">
                                        <img class="cart_img" src="{{$item->image_url1}}">
                                        <div class="cart__product__item__title">
                                            <h6>
                                                @if($item->name == null)
                                                    {{$item->item_code}}
                                                    @if($promotion)
                                                        @if($promotion->promo_amount == null)
                                                            ({{$promotion->promo_percent}}%)
                                                        @else
                                                            (Sale)
                                                        @endif
                                                    @endif
                                                @else
                                                    {{$item->name}}
                                                    @if($promotion)
                                                        @if($promotion->promo_amount == null)
                                                            ({{$promotion->promo_percent}} %)
                                                        @else
                                                            (Sale)
                                                        @endif
                                                    @endif
                                                @endif
                                            </h6>
                                            <div class="rating row cart-row ml-0 mt-1">
                                                <div>{{$item_spec->size}} |</div>
                                                <span class="color-bg" style="background: {{$item_spec->color}} !important;"></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">{{$order_detail->price}}</td>
                                    <td class="cart__price">{{$order_detail->quantity}}</td>
                                    <td class="cart__total">{{$order_detail->sub_total}} MMK</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td></td>
                                    <td colspan="2">
                                        <h6 class="order_costs my-3">Cart Total</h6>
                                        <h6 class="order_costs my-3">Delivery Cost</h6>
                                        @if($promo_discount)
                                            <h6 class="order_costs my-3">Promocode</h6>
                                        @endif
                                    </td>
                                    <td>
                                        <h6 class="cart__price my-3">{{$order->cart_total}} MMK</p>
                                        <h6 class="cart__price my-3">{{$order->delivery_cost == 0 ? 'Free' : $order->delivery_cost.' MMK'}}</p>
                                        @if($promo_discount)
                                            <h6 class="cart__price my-3">
                                                @if($promo_discount->promo_amount == null)
                                                    {{$promo_discount->promo_percent}} %
                                                @else
                                                    {{$promo_discount->promo_amount}} MMK
                                                @endif
                                            </h6>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="2">
                                        <h5 class="order_costs">Final Cost</h5>
                                    </td>
                                    <td>
                                        <h5 class="cart__price">{{$order->final_cost}} MMK</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if ($order->status == 1)
                <div class="row">
                    <div class="col-lg-6 col-md-6 text-center mb-2">
                        <button class="site-btn order_button btn-viewall btn-md w-250" data-toggle="modal" data-target="#PaymentSSModal">Payment Screentshot</button>
                    </div>
                    <div class="col-lg-6 col-md-6 text-center">
                        <a href="{{url('/cancel-order',$order->id)}}" class="site-btn order_button btn-viewall btn-md w-180" onclick="return myFunction();">Cancel Order</a>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-12 col-md-12 text-center">
                        <button class="site-btn order_button btn-viewall btn-md w-250" data-toggle="modal" data-target="#PaymentSSModal">Payment Screentshot</button>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- Order Detail End -->

    <!-- Edit Payment Screenshot Model Start -->
    <div class="modal fade" id="PaymentSSModal" tabindex="-1" role="dialog" aria-labelledby="PaymentSSModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="PaymentSSModalLabel">Customer Payment Screenshot</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{url('/edit-payment-ss',$id)}}" method="post" enctype="multipart/form-data" onsubmit="return validatePaymentssEditForm()">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="modal-body">
                    <p class="{{$order->status == 0 ? 'hidden' : ''}}">Please ensure image file is in .jpg, .jpeg, .png format.</p>
                    <img src="{{asset($order->payment_screenshot)}}" class="mb-2">
                    <div class="checkout__form__input {{$errors->has('payment_screenshot') ? 'has-error' : ''}} {{$order->status == 0 ? 'hidden' : ''}}">
                        <p class="mb-1">Choose New Image File to Update Payment Screenshot! <span>*</span></p>
                        <input type="file" class="form-control" name="payment_screenshot" id="payment_screenshot" value="">
                        <span class="text-danger image_error hidden"></span>
                        <span class="text-danger no_file hidden">Image file is empty! Please Choose Image to update!</span>
                        <span class="text-danger">{{$errors->first('payment_screenshot')}}</span>
                    </div>
                </div>
                <div class="modal-footer {{$order->status == 0 ? 'hidden' : ''}}">
                    <button type="submit" class="site-btn btn-viewall btn-lg btn-block update_payment_ss">Update Screentshot</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    <!-- Edit Payment Screenshot Model End -->
@endsection
@section('javascript')
    <script type="text/javascript">
        function myFunction() {
            if(!confirm("Are You Sure to cancel this order?"))
            event.preventDefault();
        }

        function validatePaymentssEditForm() {
            var payment_screenshot = $("input[type='file'][name='payment_screenshot']").val();
            if (payment_screenshot == null || payment_screenshot == "") {
                $('.no_file').removeClass('hidden');
                return false;
            }
        }

        $('#payment_screenshot').change(function () {
            $('.no_file').addClass('hidden');
            var ext = this.value.match(/\.(.+)$/)[1];
            var f=this.files[0];
            var fileSize = (f.size||f.fileSize);
            var imgkbytes = Math.round(parseInt(fileSize)/1024);

            if(imgkbytes > 5000){
                $('.image_error').removeClass('hidden');
                $('.image_error').text('The payment ss file size is too large');
                $('.update_payment_ss').addClass('disabled');
                $('.update_payment_ss').attr('disabled','disabled');
            }
            switch (ext) {
                case 'jpg':
                case 'JPG':
                case 'jpeg':
                case 'png':
                case 'PNG':
                    $('.image_error').addClass('hidden');
                    $('.update_payment_ss').removeClass('disabled');
                    $('.update_payment_ss').removeAttr('disabled');
                    break;
                default:
                    $('.image_error').removeClass('hidden');
                    $('.image_error').text('The payment ss must be a file type of: jpg, JPG, jpeg, png, PNG.');
                    $('.update_payment_ss').addClass('disabled');
                    $('.update_payment_ss').attr('disabled','disabled');
            }
        });
    </script>
@endsection
@extends('frontEnd.layouts.master')
@section('title','CheckOut Page')
@section('content')
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        @if($promo != null)
            <div class="text-center promo-alert">
                <p>Dear Customers! You have a promo code 
                    <span class="alert_promo" value="{{$promo->code}}" data-amount="{{$promo->promo_amount}}" data-percent="{{$promo->promo_percent}}">
                        ({{$promo->code}})
                    <span>!</p>
            </div>
        @endif
        <div class="container mt-3">
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="coupon__link"><span class="icon_tag_alt"></span> <a class="click" data-toggle="modal" data-target="#promocode_modal">Have a promocode? Click
                    here to enter your code.</a></h6>
                </div>
            </div>
            <form action="{{url('/submit-checkout')}}" class="checkout__form" enctype="multipart/form-data" id="checkout_form" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-lg-7">
                        <h5>Checkout detail</h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__form__input {{$errors->has('name')?'has-error':''}}">
                                    <p> Name <span>*</span></p>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user_data->name)}}" placeholder="Customer's Name">
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__input {{$errors->has('address')?'has-error':''}}">
                                    <p>Address <span>*</span></p>
                                    <textarea class="form-control" name="address" id="address" placeholder="Order Destinated Address" cols="30" rows="5">{{ old('address', $user_data->address)}}</textarea>
                                    <span class="text-danger">{{$errors->first('address')}}</span>
                                </div>
                                @if($deli_promo != null)
                                    <input type="hidden" id="deli_promo" value="{{$deli_promo->amt}}">
                                @else
                                    <input type="hidden" id="deli_promo" value="">
                                @endif
                                <div class="checkout__form__input {{$errors->has('division')?'has-error':''}}">
                                    <p>Division / State <span>*</span></p>
                                    <select name="division" id="division" class="form-control">
                                        <option value="">Please Choose Your State or Division</option>
                                        @foreach($deliveries as $delivery)
                                            @php
                                                if($delivery->division == 3) {
                                                    $delivery_name = "Other";
                                                } elseif($delivery->division == 2) {
                                                    $delivery_name = "Mandalay";
                                                } else {
                                                    $delivery_name = "Yangon";
                                                }
                                            @endphp
                                            <option value="{{$delivery->division}}">{{$delivery_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{$errors->first('division')}}</span>
                                    <span class="text-danger">{{$errors->first('township')}}</span>
                                </div>
                                <div class="checkout__form__input townships hidden">
                                    <p>Township <span>*</span></p>
                                    <select name="township" id="township" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input {{$errors->has('phone')?'has-error':''}}">
                                    <p>Phone <span>*</span></p>
                                    <input type="number" class="form-control customized_input_number" name="phone" onkeypress="return numbersOnly(event)" value="{{ old('phone', $user_data->phone)}}" id="phone" placeholder="Contactable Mobile Phone">
                                    <span class="text-danger">{{$errors->first('phone')}}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input {{$errors->has('email')?'has-error':''}}">
                                    <p>Email</p>
                                    <input type="text" class="form-control" name="email" value="{{ old('email', $user_data->email)}}" id="email" placeholder="Contactable Email Address">
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="checkout__order">
                            <h5>Your order</h5>
                            <div class="checkout__order__product">
                                <ul class="mb-2">
                                    <li>
                                        <span class="top__text">Product</span>
                                        <span class="top__text__right">Quantity</span>
                                    </li>
                                </ul>
                                <ul class="cart_summary">
                                </ul>
                            </div>
                            <div class="checkout__order__total mb-0">
                                <ul>
                                    <li>Total <span class="total"></span></li>
                                    <li class="deli hidden">Delivery <span class="delivery"></span></li>
                                    <input type="hidden" name="delivery_id" id="delivery_id" value="">
                                    <input type="hidden" name="delivery_cost" id="delivery_cost" value="">
                                    <li class="promo hidden">Promocode <span class="promocode"></span></li>
                                    <input type="hidden" name="promo_code" id="promo_code" value="">
                                </ul>
                            </div>
                            <div class="checkout__order__total final hidden">
                                <ul>
                                    <li>Final <span class="final_cost"></span></li>
                                    <input type="hidden" name="final_cost" id="final_cost" value="">
                                </ul>
                            </div>
                            <div class="checkout__order__widget">
                                <p>Our Shop only supports Pre-paid system!</p>
                                <label for="prepaid">
                                    Pre-paid
                                    <input type="checkbox" id="prepaid" checked="checked" disabled="disabled">
                                    <span class="checkmark"></span>
                                </label>
                                <div class="checkout__form__input {{$errors->has('bank')?'has-error':''}}">
                                    <select name="bank" id="bank" class="form-control">
                                        <option value="0">Please Choose Bank</option>
                                        @foreach($banks as $bank)
                                            <option value="{{$bank->id}}">{{$bank->bank}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{$errors->first('bank')}}</span>
                                </div>
                                <div class="checkout__form__input mb-1 bank_acc hidden">
                                    <p>Bank Account Name</p>
                                    <input type="text" class="form-control" id="bank_acc_name" value="" readonly="readonly">
                                </div>
                                <div class="checkout__form__input bank_acc hidden">
                                    <p>Bank Account Number</p>
                                    <input type="text" class="form-control" id="bank_acc_no" value="" readonly="readonly">
                                </div>
                                <div class="checkout__form__input {{$errors->has('payment_ss')?'has-error':''}}">
                                    <p>Attach Payment Screen Shot Here! <span>*</span></p>
                                    <input type="file" class="form-control" name="payment_ss" id="payment_ss" value="">
                                    <span class="text-danger image_error hidden"></span>
                                    <span class="text-danger">{{$errors->first('payment_ss')}}</span>
                                </div>
                            </div>
                            <input type="hidden" name="cart_item" id="cart_item" value="">
                            <button type="submit" class="site-btn" id="check_out">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- Promocode Input Modal -->
    <div class="modal fade" id="promocode_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Promo Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="input_promo" value="" placeholder="Enter Your Promo Code">
                <span class="text-danger promo_alert hidden"></span>
            </div>
            <div class="modal-footer">
                <button class="site-btn promo_modal" onclick="addPromo()">Submit</button>
            </div>
            </div>
        </div>
    </div>
    <!-- Promocode Input Modal -->
@endsection
@section('javascript')
    <script src="/backend/dist/jquery.validate.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var cart = localStorage.getItem('cart');
            $('#cart_item').val(cart);
            var cartobj = JSON.parse(cart);
            var total = 0;
            var html = '';
            $.each(cartobj.itemlist,function(i,v) {
                if(v.name == "") {
                    var item = "Code_"+v.code;
                } else {
                    var item = v.name;
                }
                var qty = v.qty;
                total += v.subtotal;
                html +=`<li>${item}<span>${qty}</span></li>`;
            })
            $('.total').text(total+' MMK');
            $('.checkout__order__product .cart_summary').html(html);
        })

        $(document).on('change', '#division', function() {
            var division = document.getElementById('division').value;
            if(division == 1) {
                $('.deli').addClass('hidden');
                $('.final').addClass('hidden');
                getTownships(division);
            } else if(division == "") {
                $('.townships').addClass('hidden');
                $('.deli').addClass('hidden');
                $('.final').addClass('hidden');
            } else {
                $('.townships').addClass('hidden');
                delivery(division);
            }
        })

        function getTownships(division) {
            $.ajax({
                type:'get',
                url:'/get-townships',
                data:{division:division},
                success:function(resp) {
                    var arr = JSON.parse(resp);
                    var html = '';
                    html = `<option value="">Please Choose Your Township</option>`;
                    for(let i = 0; i < arr.length; i++){
                        html +=`<option value="${arr[i]["id"]}">${arr[i]["township"]}</option>`;
                    }
                    $('.townships').removeClass('hidden');
                    $('#township').html(html);
                }
            })
        }

        $(document).on('change', '#township', function() {
            var division = document.getElementById('division').value;
            var delivery_id = $(this).val();
            if (delivery_id == 0) {
                $('.deli').addClass('hidden');
                $('.final').addClass('hidden');
            } else {
                delivery(division,delivery_id);
            }
        })

        function carttotal() {
            var cart = localStorage.getItem('cart');
            var cartobj = JSON.parse(cart);
            var carttotal = 0;
            $.each(cartobj.itemlist,function(i,v) {
                carttotal += v.subtotal;
            })
            return carttotal;
        }

        function delivery(division,delivery_id) {
            $.ajax({
                type:'get',
                url:'/delivery',
                data:{division:division, delivery_id:delivery_id},
                success:function(resp) {
                    var arr = resp.split(",");
                    var total = carttotal();
                    var deli_promo = $('#deli_promo').val();
                    if(deli_promo != "") {
                        if(total >= deli_promo) {
                            $('.delivery').text('Free');
                            $('.delivery').attr('value',0);
                            $('#delivery_cost').val(0);
                        } else {
                            $('.delivery').text(arr[1]+' MMK');
                            $('.delivery').attr('value',arr[1]);
                            $('#delivery_cost').val(arr[1]);
                        }
                    } else {
                        $('.delivery').text(arr[1]+' MMK');
                        $('.delivery').attr('value',arr[1]);
                        $('#delivery_cost').val(arr[1]);
                    }
                    $('#delivery_id').val(arr[0]);
                    $('.deli').removeClass('hidden');
                    final_cost();
                }
            });
        }

        function addPromo() {
            var alert_promo = $('.alert_promo').attr('value');
            var input_promo = $('#input_promo').val();
            if(alert_promo == input_promo) {
                $('#promo_code').val(input_promo);
                if($('.alert_promo').data('amount') == "") {
                    var discount = $('.alert_promo').data('percent');
                    $('.promo').removeClass('hidden');
                    $('.promocode').attr('type','percent');
                    $('.promocode').attr('value',discount);
                    $('.promocode').text('- '+discount+'%');
                    final_cost();
                } else {
                    var discount = $('.alert_promo').data('amount');
                    $('.promo').removeClass('hidden');
                    $('.promocode').attr('type','amount');
                    $('.promocode').attr('value',discount);
                    $('.promocode').text('- '+discount+' MMK');
                    final_cost();
                }
                $('.promo_alert').addClass('hidden');
                $('.promo_modal').attr('data-dismiss','modal');
            } else if(input_promo == "") {
                $('.promo_alert').removeClass('hidden');
                $('.promo_alert').text('Your Promo Code is empty!');
                $('.promo_modal').removeAttr('data-dismiss');
                $('.promo').addClass('hidden');
            } else {
                $('.promo_alert').removeClass('hidden');
                $('.promo_alert').text('Your Promo Code is incorrect!');
                $('.promo_modal').removeAttr('data-dismiss');
                $('.promo').addClass('hidden');
            }
        }

        function final_cost() {
            var total = carttotal();
            var delivery = $('.delivery').attr('value');
            var final = total + parseInt(delivery);
            if (delivery) {
                var discount = $('.promocode').attr('value');
                if ($('.promocode').attr('type') == 'percent') {
                    final = Math.round(final - (final * (discount/100)));
                } else if ($('.promocode').attr('type') == 'amount') {
                    final = final - discount;
                }
                $('.final').removeClass('hidden');
                $('.final_cost').text(final+' MMK');
                $('#final_cost').val(final);
            }
        }

        $('#bank').on('change', function() {
            var bank = $(this).val();
            if (bank == 0) {
                $('.bank_acc').addClass('hidden');
                $('#bank_acc_name').val('');
                $('#bank_acc_no').val('');
            } else {
                $.ajax({
                type:'get',
                url:'/get_bank_acc_no',
                data:{bank:bank},
                success:function(resp) {
                    var arr = resp.split(",");
                    $('.bank_acc').removeClass('hidden');
                    $('#bank_acc_name').val(arr[0]);
                    $('#bank_acc_no').val(arr[1]);
                }
            })
            }
        })

        $('#payment_ss').change(function () {
            var ext = this.value.match(/\.(.+)$/)[1];
            var f=this.files[0];
            var fileSize = (f.size||f.fileSize);
            var imgkbytes = Math.round(parseInt(fileSize)/1024);

            if(imgkbytes > 5000){
                $('.image_error').removeClass('hidden');
                $('.image_error').text('The payment ss file size is too large');
                $('#check_out').addClass('disabled');
                $('#check_out').attr('disabled','disabled');
            }
            switch (ext) {
                case 'jpg':
                case 'JPG':
                case 'jpeg':
                case 'png':
                case 'PNG':
                    $('.image_error').addClass('hidden');
                    $('#check_out').removeClass('disabled');
                    $('#check_out').removeAttr('disabled');
                    break;
                default:
                    $('.image_error').removeClass('hidden');
                    $('.image_error').text('The payment ss must be a file type of: jpg, JPG, jpeg, png, PNG.');
                    $('#check_out').addClass('disabled');
                    $('#check_out').attr('disabled','disabled');
            }
        });
    </script>
@endsection
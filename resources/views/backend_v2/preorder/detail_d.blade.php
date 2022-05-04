@include('layouts.partial.header')
<div class="row" style="width:100%!important;margin-top:100px!important;">
    
    <div class="col-md-12" style="margin-top:40px!important;padding-right:100px!important;">
        <div id="tableCaption" class="col-lg-12 col-12 layout-spacing detail_img">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Order Details</h4>
                        </div>
                    </div>
                    <div class="row">
                    @foreach($preorders as $mainorder)
                        <div class="col-xl-6 col-md-6 col-sm-12 col-12">
                            <p style="padding-left:16px;">
                                <b>{{ $mainorder->customer_name}}</b><br/>
                                {{ $mainorder->delivery_address}}<br/>
                                {{ $mainorder->phone}}<br/>
                                {{ $mainorder->email}}<br/>
                            </p>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12 col-12">
                            <p style="padding-left:30%;">
                                Order ID    ::  <b>{{ $mainorder->order_id}}</b><br/>
                                Order Date  ::  <b>{{ $mainorder->order_date}}</b><br/>
                                Payment Type  ::  <b>{{ $mainorder->payment_type}}</b><br/>
                                Bank  ::    <b>@foreach($banks as $bank)
                                                @if($bank->id == $mainorder->bank_id)
                                                {{$bank->bank}}
                                                @endif
                                                @endforeach
                                            </b><br/>
                            </p>
                        </div>
                    @break
                    @endforeach
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table mb-4">
                          <thead>
                                <tr>
                                    <th class="text-center">Item_Code</th>
                                    <th class="text-center">URL</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Color</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($preorders as $order)
                                <?php
                                            $parameter = $order->id;
                                            $parameter= Crypt::encrypt($parameter);
                                ?>
                                <tr>
                                    <td class="text-center">{{$order->item_code}}</td>
                                    <td class="text-center"><a href="{{$order->url}}" target="blank" class="btn-link">LINK</a></td>
                                    <td class="text-center">{{$order->size}}</td>
                                    <td class="text-center"><div style="border:1px solid;height:20px;background-color:{{$order->color}}">  </div></td>
                                    <td class="text-center">{{$order->quantity}}</td>
                                    <td class="text-center">{{$order->price}}</td>
                                    <td class="text-center">{{$order->remark}}</td>
                                </tr>
                                @endforeach
                                <tr style="border:2px;">
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td class="text-center">Sub Total</td>
                                    <td class="text-right" style="padding-right:30px;">{{$order->sub_total}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td class="text-center">Delivery Cost</td>
                                    <td class="text-right" style="padding-right:30px;">{{$order->delivery_cost}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td class="text-center" style="font-size:1.1em;"><b>Total</b></td>
                                    <td class="text-right" style="padding-right:30px;font-size:1.1em;"><b>{{$order->final_cost}}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <p style="padding-left:16px;font-size:1.1em;">
                            @if($order->preordered_date != NULL)
                                Preordered Date: {{$order->preordered_date}}<br/>
                            @endif
                            @if($order->received_date != NULL)
                                Receivde Date: {{$order->received_date}}<br/>
                            @endif
                            @if($order->delivered_date != NULL)
                                Delivered Date: {{$order->delivered_date}}<br/>
                            @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="width:100%!important;margin-bottom:50px!important;">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">
            <h4 class="detail_img text-center">Payment Screenshot</h4>
            <img src="{{$image}}" class="detail_img" style="width:80%!important;"/>
        </div>
        <div class="col-md-4">

        </div>
    </div>
   
    <div class="row" id="row-margin-control" style="width:100%!important;margin-bottom:50px!important;">

        
        <div class="col-md-4">
        </div>  
        <div class="col-md-4">
            <form action="/admin/preorder/change_4/{{ $parameter }}" method="post" >
                <!-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> -->
      {{csrf_field()}}
      {{ method_field('PATCH') }}
                   <button type="submit"  class="form-control btn btn-info" style="font-weight:bold;padding-top:10px;height:40px;background-color:#f5a8ae!important;border:#f5a8ae!important;" id="btn_new">Make Completed</button>
                      </form>
        </div>
        <div class="col-md-4">
        </div>
        
    </div>

 @include('layouts.partial.footer')

@include('layouts.partial.header')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
select {
    font-family: 'FontAwesome', 'sans-serif';
}
</style>
      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
            <div class="layout-px-spacing">


                <div class="row">
                 @if (session('success'))
                 <div class="flash-message col-md-12">
                     <div class="alert alert-success ">
                         {{session('success')}}
                     </div>
                 </div>
                 @elseif(session('fail'))
                 <div class="flash-message col-md-12">
                     <div class="alert alert-danger">
                         {{session('fail')}}
                     </div>
                 </div>

                 @endif
                       @if (count($errors) > 0)
                                       <div class="content mt-3">
                                           <!-- div class=row content start -->
                                           <div class="animated fadeIn">
                                               <!-- div class=FadeIn start -->
                                               <div class="card">
                                                   <!-- card start -->

                                                   <div class="card-body">
                                                       <!-- card-body start -->

                                                       <div class="row">
                                                           <!-- div class=row One start -->
                                                           @foreach ($errors->all() as $error)
                                                           <div class="col-md-12">
                                                               <!-- div class=col 12 One start -->
                                                               <p class="text-danger">* {{ $error }}</p>
                                                           </div><!-- div class=col 12 One end -->
                                                           @endforeach
                                                       </div><!-- div class=row One end -->


                                                   </div> <!-- card-body end -->

                                               </div><!-- card end -->
                                           </div><!-- div class=FadeIn start -->
                                       </div><!-- div class=row content end -->
                                       @endif
                        </div>
                        <!-- this is end for alert the message box when user take action -->


                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form action="/admin/order/store" method="post" enctype="multipart/form-data" id="general-info" class="section general-info">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <div class="info">
                                            <h6 class="">Creating Order</h6>
                                             <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3"> Item Code</label>
                                                                            <select onchange="getSpecsByItemId(this.value)" class="selectpicker" data-live-search="true" data-width="100%"  name="item_id" id="item_id">
                                                                            <option value="0">Pls select item code first!</option>

                                                                            @foreach($items as $item)
                                                                                    <option value="{{$item->id}}">{{$item->item_code}}</option>
                                                                        @endforeach
                                                                         </select>
                                                                        <p class="text-danger">{{$errors->first('item_code')}}</p>

                                                                    </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3"> Item Specifications</label>
                                                                         <select class="form-control"  name="items_spec_id" id="items_spec_id" >

                                                                         </select>
                                                                        <p class="text-danger">{{$errors->first('items_spec_id')}}</p>

                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Quantity</label>
                                                                                <input type="number" class="form-control" value="{{ old('quantity') }}" min="1" name="quantity" placeholder="Type quantity here">
                                                                                <p class="text-danger">{{$errors->first('quantity')}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Order Date</label>
                                                                                <input type="date" class="form-control" value="{{ old('order_date') }}" name="order_date" placeholder="Type order date here">
                                                                                <p class="text-danger">{{$errors->first('order_date')}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Contact Name</label>
                                                                                <input type="text" class="form-control" value="{{ old('contact_name') }}" name="contact_name" placeholder="Type contact name here">
                                                                                <p class="text-danger">{{$errors->first('contact_name')}}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Contact Phone</label>
                                                                                <input type="text" class="form-control" value="{{ old('contact_phone') }}" name="contact_phone" placeholder="Type contact phone here">
                                                                                <p class="text-danger">{{$errors->first('contact_phone')}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Email</label>
                                                                                <input type="text" class="form-control" value="{{ old('email') }}" name="email" placeholder="Type email here">
                                                                                <p class="text-danger">{{$errors->first('email')}}</p>
                                                                        </div>
                                                                    </div>

                                                                </div>



                                                <div class="row">
                                                <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="degree3"> Delivery Division</label>
                                                                            <select onchange="getTownshipsByDivisionId(this.value)" class="selectpicker" data-live-search="true" data-width="100%"  name="delivery_id" id="delivery_id">


                                                                                    <option value="1"> Yangon</option>
                                                                                    <option value="2"> Mandalay</option>
                                                                                    <option value="3"> Others</option>

                                                                         </select>
                                                                        <p class="text-danger">{{$errors->first('division')}}</p>

                                                                    </div>
                                                                    </div>
                                                               <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="degree3"> Township</label>
                                                                         <select class="form-control"  name="township_id" id="township_id" >
                                                                            @foreach($townships as $township)
                                                                                    <option value="{{$township->id}}">{{$township->township}}</option>
                                                                        @endforeach
                                                                         </select>
                                                                        <p class="text-danger">{{$errors->first('township_id')}}</p>

                                                                    </div>
                                                                    </div>
                                                <div class="col-sm-4">

                                                    <div class="form-group">
                                                        <label for="fullName">Delivery Address</label>
                                                            <input type="text" class="form-control" value="{{ old('delivery_address') }}" name="delivery_address" placeholder="Type delivery address here">
                                                            <p class="text-danger">{{$errors->first('delivery_address')}}</p>
                                                    </div>
                                                </div>



                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label for="fullName">Payment Type</label>
                                                            <input type="text" class="form-control" value="{{ old('payment_type') }}" name="payment_type" placeholder="Type payment type here">
                                                            <p class="text-danger">{{$errors->first('payment_type')}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label for="fullName">Band Id</label>
                                                                            <select class="selectpicker" data-live-search="true" data-width="100%"  name="bank_id" id="bank_id">

                                                                            @foreach($banks as $bank)
                                                                                    <option value="{{$bank->id}}">{{$bank->bank}}</option>
                                                                           @endforeach
                                                                         </select>
                                                            <p class="text-danger">{{$errors->first('bank_id')}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="card-title m-b-0">Payment ScreenShot </h5>
                                                <div class="form-group m-t-20">

                                                        <div class="add_image_div add_image_div_red" style="background-image: url({{ isset($orders)? $orderss->payment_screenshot:Request::old('payment_screenshot') }});">
                                                        </div>
                                                        <input type="hidden" id="removeImageFlag" value="0" name="removeImageFlag">
                                                        <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage"
                                                            name="removeImage">


                                                </div>

                                            </div>
                                        </div>


                                                                      <div class="row">
                                                                                <div class="col-sm-6">
                                                                                        <button type="submit" class="mt-4 btn btn-primary" style="background-color:#f5a8ae!important;border: #f5a8ae!important;">Save</button>
                                                                        </div>
                                                                    </div>
                                                                 </div>
                                                             </div>
                                                        </div>
                                                    </div>
                                                  </div>


                                        </div>


                                        @include('backend_v2.modals.image_upload_payment')
                                       <!--  -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">

    $(document).ready(function() {

        //Start Validation for Entry and Edit Form
        $('#general-info').validate({
            rules: {
                item_id         : 'required',
                items_spec_id              : 'required',
                qty            : 'required',
                contact_name                   : 'required',
                order_date           : 'required',
                contact_phone           : 'required',
                delivery_address           : 'required',



            },
            messages: {
                item_id         : 'Item code is required',
                items_spec_id              : 'Item specifications is required',
                qty            : 'Quantity is required',
                contact_name                   : 'Contact Name is required',
                order_date           : 'Order Date is required',
                contact_phone           : 'Contact Phone is required',
                delivery_address           : 'Delivery Address is required',

            },
            submitHandler: function(form) {

                $('input[type="submit"]').attr('disabled','disabled');
                form.submit();
            }

    })

    });

</script>
<script>
    function getTownshipsByDivisionId(selected_division_id){

if(selected_division_id != ""   ){

    let table_name = 'delivery';
    let conditions = {division:selected_division_id};
    let request_data = JSON.stringify(conditions);

    $.ajax({
        type:'POST',
        url:'/admin/order/create/api/' + table_name,
        data:{ _token: "{{csrf_token()}}", conditions : request_data},
        dataType: 'json',
        success:function(data){

            let temp_data = data.returned_obj;
            console.log(temp_data);
            $("#township_id").html(temp_data.objs);
            $("#township_id").trigger("chosen:updated");
        }
    });

}
}

function getSpecsByItemId(selected_item_id){

if(selected_item_id != ""){

    let table_name = 'items_specification';
    let conditions = {items_id:selected_item_id};
    let request_data = JSON.stringify(conditions);

    $.ajax({
        type:'POST',
        url:'/admin/order/api/' + table_name,
        data:{ _token: "{{csrf_token()}}", conditions : request_data},
        dataType: 'json',
        success:function(data){

            let temp_data = data.returned_obj;

            $("#items_spec_id").html(temp_data.objs);
            $("#items_spec_id").trigger("chosen:updated");
        }
    });

}
}
</script>
@include('layouts.partial.footer')

@include('layouts.partial.header')
      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">

                        <!-- this is end for alert the message box when user take action -->
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form action="/admin/promotion/store" method="post" enctype="multipart/form-data" id="general-info" class="section general-info">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <div class="info">
                                            <h6 class="">Creating Promotion</h6>
                                             <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Event Name</label>
                                                                                <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Type event name here" >
                                                                                <p class="text-danger">{{$errors->first('name')}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Start Date</label>
                                                                               <input type="date" class="form-control" value="{{ old('start_date') }}" name="start_date" placeholder="Choose your start date" >
                                                                                <p class="text-danger">{{$errors->first('start_date')}}</p>
                                                                        </div>
                                                                    </div>
                                                                     <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="degree3">End Date</label>
                                                                                <input type="date" class="form-control" value="{{ old('end_date') }}" name="end_date" placeholder="Choose your end date" >
                                                                                <p class="text-danger">{{$errors->first('end_date')}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Product status</label>
                                                                         <select onchange="GetSelectedTextValue(this)" class="selectpicker" data-live-search="true" data-width="100%" name="product_status" id="product_status">
                                                                         
                                                                                    <option value="1">All Items</option>
                                                                                    <option value="2">By Categories</option>
                                                                                    <option value="3">By Items</option>
                                                                                    <option value="4">By Brand</option>
                                                                     
                                                                         </select>
                                                                        <p class="text-danger">{{$errors->first('product_status')}}</p>

                                                                    </div>
                                                                    </div>
                                                                <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Product List</label>
                                                                         <select class="selectpicker" data-live-search="true" data-width="100%" style="width:100%!important;" name="product_id[]" id="product_id" multiple>
                                                                    
                                                                         </select>
                                                                        <p class="text-danger">{{$errors->first('product_id')}}</p>

                                                                    </div>
                                                                    </div>
                                                                </div>
                                                               
                                                                 <div class="row">
                                                                 <div class="col-sm-6">
                                                                 <br>
                                                                  <input type="radio" id="promo_percent" name="discount_id" value="1" checked>
                                                                  <label for="promo_percent">Percentage</label><br>
                                                                  <input type="radio" id="promo_amount" name="discount_id" value="2">
                                                                   <label for="promo_amount">Item_Discount_Amount</label><br>
                                                                  {{-- <input type="radio" id="promo_amount" name="discount_id" value="3">
                                                                   <label for="promo_discount_amount">Discount_Amount</label><br>
                                                                  --}}
                                                                    </div>
                                                                    
                                                                     <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Discount</label>
                                                                                <input type="text" class="form-control" value="{{ old('discount') }}" name="discount" placeholder="Type your discount" >
                                                                                <p class="text-danger">{{$errors->first('discount')}}</p>
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
                start_date                  : 'required',
                end_date                    : 'required',
                product_status              : 'required',
                discount                    : 'required',

            },
            messages: {
                start_date                  : 'Start Date is required',
                end_date                    : 'End Date is required',
                product_status              : 'Product Status is required',
                discount                    : 'Discount is required',
            },
            submitHandler: function(form) {

                $('input[type="submit"]').attr('disabled','disabled');
                form.submit();
            }

    })
    });

function GetSelectedTextValue(product_status) {
    var selectedValue = product_status.value;
    $.ajax({
        type:'POST',
        url:'/api/' + selectedValue,
        data:{ _token: "{{csrf_token()}}", productstatus : selectedValue},
        dataType: 'json',
        success:function(data){
            
            $('#product_id').empty();  
            var options = ''; 
            $.each(data, function(i, item) {
                // loop through the json and create an option for each result
                $('#product_id').append('<option value="' + item.id + '">' + item.name + '</option>');
            });
            $(".selectpicker").selectpicker('refresh');
        }
    }); 
}

</script>
@include('layouts.partial.footer')

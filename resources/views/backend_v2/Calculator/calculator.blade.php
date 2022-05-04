@include('layouts.partial.header')

      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                                            <!-- this is written for alert the message box when user take action -->

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form action="/admin/calculator/store" method="post" enctype="multipart/form-data" id="general-info" class="section general-info">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <div class="info">
                                            <h6 class="">Cost Calculator</h6>
                                             <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">


                                                                <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Country</label>
                                                                                <select class="form-control" value="{{ old('countries_id') }}" name="countries_id" id="countries_id">

                                                                                @foreach($countries as $country)
                                                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                                                                @endforeach

                                                                                </select>
                                                                        </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="degree3">Purchase Price</label>
                                                                                          <input type="text" class="form-control" value="{{ old('purchase_price') }}" name="purchase_price" placeholder="Enter Purchase Price">
                                                                                          <p class="text-danger">{{$errors->first('purchase_price')}}</p>
                                                                                </div>
                                                                            </div>

                                                                </div>
                                                                <div class="row">


                                                                 <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Shipping Fee</label>
                                                                                  <input type="text" class="form-control" value="{{ old('shipping_fee') }}" name="shipping_fee" placeholder="Enter Shipping Fee">
                                                                                  <p class="text-danger">{{$errors->first('shipping_fee')}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Cargo Fee</label>
                                                                                  <input type="text" class="form-control" value="{{ old('cargo_fee') }}" name="cargo_fee" placeholder="Enter Cargo Fee">
                                                                                  <p class="text-danger">{{$errors->first('cargo_fee')}}</p>
                                                                        </div>
                                                                    </div>
                                                                      <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Additonal Charges</label>
                                                                                  <input type="text" class="form-control" value="{{ old('additional_charges') }}" name="additional_charges" placeholder="Enter Additional Charges">
                                                                                  <p class="text-danger">{{$errors->first('additional_charges')}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="col-sm-6">
                                                                    <button type="submit" class="mt-4 btn btn-primary" style="background-color:#f5a8ae!important;border: #f5a8ae!important;">Calculate</button>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                <br>
                                                                <div class="col-sm-5">
                                                                <p style="border:3px solid #f5a8ae!important;"><b>Sale:price:{{$saleprice}}</b></p>
                                                                </div>
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
                purchase_price                  : 'required',

            },
            messages: {
                purchase_price                  : 'Purchasae Price is required',
            },
            submitHandler: function(form) {

                $('input[type="submit"]').attr('disabled','disabled');
                form.submit();
            }

    })
    });

</script>
@include('layouts.partial.footer')

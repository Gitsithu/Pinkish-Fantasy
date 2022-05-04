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
                                    <form action="/admin/country/store" method="post" enctype="multipart/form-data" id="general-info" class="section general-info">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <div class="info">
                                            <h6 class="">Creating Option</h6>
                                             <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName"> Name</label>
                                                                                <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Type option name here">
                                                                                  <p class="text-danger">{{$errors->first('name')}}</p>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Status</label>
                                                                                <select class="form-control" value="{{ old('status') }}" name="status" id="status">
                                                                                     <option value="1" selected>Active</option>
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Exchange Rate</label>
                                                                                  <input type="text" class="form-control" value="{{ old('exchange_rate') }}" name="exchange_rate" placeholder="Type exchange rate here">
                                                                                  <p class="text-danger">{{$errors->first('exchange_rate')}}</p>
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
                name                  : 'required',
                status                : 'required',

            },
            messages: {
                name                  : 'Option name is required',
                status                : 'Status is required',
            },
            submitHandler: function(form) {

                $('input[type="submit"]').attr('disabled','disabled');
                form.submit();
            }

    })
    });

</script>                        
@include('layouts.partial.footer')

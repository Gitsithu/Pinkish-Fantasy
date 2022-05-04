@include('layouts.partial.header')
      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">

                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">

                            <div class="row">

                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                   <form action="/admin/deli_promo/update/{{ isset($promotions)? $promotions->id:0 }}" method="post"  enctype="multipart/form-data" id="general-info" class="section general-info">
                    <!-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> -->
                                    {{csrf_field()}}
                                    {{ method_field('PATCH') }}
                                            <div class="info">
                                            <h6 class="">Editng Delivery Promotion</h6>

                                             <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                 
                                                                <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Start Date</label>
                                                                               <input type="date" class="form-control" value="{{ isset($promotions)? $promotions->start_date:Request::old('start_date') }}" name="start_date" placeholder="Choose your start date" >
                                                                                <p class="text-danger">{{$errors->first('start_date')}}</p>
                                                                        </div>
                                                                    </div>
                                                                     <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3">End Date</label>
                                                                                <input type="date" class="form-control" value="{{ isset($promotions)? $promotions->end_date:Request::old('end_date') }}" name="end_date" placeholder="Choose your end date" >
                                                                                <p class="text-danger">{{$errors->first('end_date')}}</p>
                                                                        </div>
                                                                    </div>
                                                                

                                                                
                                                                    </div>
                                                                <div class="row">
                                                                 <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Ammount</label>
                                                                                <input type="text" class="form-control" value="{{ isset($promotions)? $promotions->amt:Request::old('amt') }}" name="amt">
                                                                                <p class="text-danger">{{$errors->first('amt')}}</p>
                                                                        </div>
                                                                    </div>
                                                                
                                                                <div class="col-sm-6">
                                                                    <button type="submit" class="mt-4 btn btn-primary" style="background-color:#f5a8ae!important;border: #f5a8ae!important;">Update</button>
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
                             },
                    messages: {
                        name                  : 'Brand Name is required',
                       },
                    submitHandler: function(form) {
                        $('input[type="submit"]').attr('disabled','disabled');
                        form.submit();
                    }
                });
                //End Validation for Entry and Edit Form



            });
        </script>

@include('layouts.partial.footer')

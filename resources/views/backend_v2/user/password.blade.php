@include('layouts.partial.header')
      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">

                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">

                            <div class="row">

                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                   <form action="/admin/user/update/password" method="post"  enctype="multipart/form-data" id="general-info" class="section general-info">
                    <!-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> -->
                                    {{csrf_field()}}
                           
                                            <div class="info">
                                            <h6 class="">Editng Password</h6>

                                             <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class= "row">
      
                                                                    <div class="col-md-4">
                                                                    <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="current_password">Current Password</label>
                                                                                <input type="password" class="form-control" value="{{ old('current_password') }}" name="current_password" placeholder="Type current password here">
                                                                                    <p class="text-danger">{{$errors->first('current_password')}}</p>
                                                  
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                    <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="new_password">New Password</label>
                                                                                <input type="password" class="form-control" value="{{ old('password') }}" name="password" placeholder="Type new password here">
                                                                                    <p class="text-danger">{{$errors->first('password')}}</p>
                                                  
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                    <div class="row">
                                                                    <div class="col-sm-12">
                                                                    <label for="password-confirm">Confirm Password</label>
                                                                                <input type="password" class="form-control" value="{{ old('password_confirmation') }}" name="password_confirmation" placeholder="Type confirm password here">
                                                                                    <p class="text-danger">{{$errors->first('password_confirmation')}}</p>
                                                  
                                                  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                    </div>
                                                                

                                                               
                                                                
                                                </div>
                                                                <div class="row">
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
                                        @include('backend_v2.modals.image_upload_brand_v2')
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
                        current_password                  : 'required',
                        password                      : 'required',
                        password_confirmation             : 'required',
                             },
                    messages: {
                        current_password                  : 'Current password is required',
                        password                      : 'New Password is required',
                        password_confirmation             : 'Confirm Password is required',
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

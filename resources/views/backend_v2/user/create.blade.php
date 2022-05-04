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
                                    <form action="/admin/user/store" method="post" enctype="multipart/form-data" id="general-info" class="section general-info">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <div class="info">
                                            <h6 class="">Creating User</h6>
                                             <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fName">Name</label>
                                                                                <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Type Name here">
                                                                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                                  
                                                                        </div>
                                                                    </div>
                                                                   
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="email">Email</label>
                                                                                <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="Type email here">
                                                                                    <p class="text-danger">{{$errors->first('email')}}</p>
                                                  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="password">Password</label>
                                                                                <input type="password" class="form-control" value="{{ old('password') }}" name="password" placeholder="Type password here">
                                                                                    <p class="text-danger">{{$errors->first('password')}}</p>
                                                  
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="password-confirm">Confirm Password</label>
                                                                                <input type="password" class="form-control" value="{{ old('password_confirmation') }}" name="password_confirmation" placeholder="Type confirm password here">
                                                                                    <p class="text-danger">{{$errors->first('password_confirmation')}}</p>
                                                  
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="phone">Phone</label>
                                                                                <input type="text" class="form-control" value="{{ old('phone') }}" name="phone" placeholder="Type phone here">
                                                                                    <p class="text-danger">{{$errors->first('phone')}}</p>
                                                  
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="role">Role</label>
                                                                            <select class="form-control" value="{{ old('role') }}" name="role" id="role">
                                                                                    
                                                                                     <option value="3" selected>Admin</option>
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="col-md-6">
                                                    <h5 class="card-title m-b-0">Address</h5>
                                                    <div class="form-group m-t-20">

                                                        <textarea rows="2" cols="50" class="form-control" name="address" id="address"
                                                            placeholder="Enter Address">{{ isset($users)? $users->address:Request::old('address') }}</textarea>
                                                        <p class="text-danger">{{$errors->first('address')}}</p>

                                                    </div>
                                                </div>
                                                                <div class="col-md-6">
                                                    <h5 class="card-title m-b-0">Profile Image </h5>
                                                    <div class="form-group m-t-20">

                                                            <div class="add_image_div add_image_div_red" style="background-image: url({{ isset($users)? $users->image:Request::old('image') }});">
                                                            </div>
                                                            <input type="hidden" id="removeImageFlag" value="0" name="removeImageFlag">
                                                            <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage"
                                                                name="removeImage">

                                                    </div>
                                                    </div>

                                                </div>
                                                        <div class="row">
                                                                <div class="col-sm-6">
                                                                    <button type="submit" style="background-color:#f5a8ae!important;border: #f5a8ae!important;" class="mt-4 btn btn-primary">Save</button>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @include('backend_v2.modals.image_upload_user')
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
                email                       : 'required',
                password                    : 'required',
                c_password                  : 'required',
                phone                       : 'required',
                address                     : 'required',
                     },
            messages: {
                name                  : 'Name is required',
                email                       : 'Email is required',
                password                    : 'Password is required',
                c_password                  : 'Confirm Password is required',
                phone                       : 'Phone is required',
                address                     : 'Address is required',
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

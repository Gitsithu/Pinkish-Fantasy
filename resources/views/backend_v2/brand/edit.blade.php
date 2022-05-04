@include('layouts.partial.header')
      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">

                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">

                            <div class="row">

                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                   <form action="/admin/brand/update/{{ isset($brands)? $brands->id:0 }}" method="post"  enctype="multipart/form-data" id="general-info" class="section general-info">
                    <!-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> -->
                                    {{csrf_field()}}
                                    {{ method_field('PATCH') }}
                                            <div class="info">
                                            <h6 class="">Editng Brand</h6>

                                             <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Name</label>
                                                                                <input type="text" class="form-control" value="{{ isset($brands)? $brands->name:Request::old('name') }}" name="name" placeholder="Type brand name here">
                                                                                <p class="text-danger">{{$errors->first('name')}}</p>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Status</label>
                                                                                <select class="form-control" value="{{ old('status') }}" name="status" id="status">
                                                                                <?php
                                                                                if(isset($obj)){
                                                                                ?>

                                                                                    <option value="1" <?php if ($brands->status == 1){ echo 'selected'; } ?>>Active</option>
                                                                                    <option value="0" <?php if ($brands->status == 0){ echo 'selected'; } ?>>In-Active</option>

                                                                                <?php
                                                                                }
                                                                                else{
                                                                                ?>

                                                                                    <option value="1">Active</option>
                                                                                    <option value="0">In-active</option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                                </select>
                                                                                <p class="text-danger">{{$errors->first('status')}}</p>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                        <h5 class="card-title m-b-0">Brand Image </h5>
                                                                        <div class="form-group m-t-20">

                                                                                <div class="add_image_div add_image_div_red"
                                                                                    style="background-image: url({{ isset($brands)? $brands->image:Request::old('image') }});">
                                                                                </div>
                                                                                <input type="hidden" id="removeImageFlag" value="0" name="removeImageFlag">
                                                                                <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage"
                                                                                    name="removeImage">

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

@include('layouts.partial.header')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
<div class="layout-px-spacing">

<div class="account-settings-container layout-top-spacing">
<div class="account-content">
<div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
        <form action="/admin/ui/update/{{ isset($ui_config)? $ui_config->id:0 }}" method="post"  enctype="multipart/form-data" id="general-info" class="section general-info">
         
        {{csrf_field()}}
        {{ method_field('PATCH') }}

        <div class="info">
        <h6 class="">Editing UI</h6>
            <div class="row">
                <div class="col-lg-11 mx-auto">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                            <div class="form">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="fullName">Section Name</label>
                                            <input type="text" class="form-control" value="{{ isset($ui_config)? $ui_config->indexname:Request::old('indexname') }}" name="name" readonly>
                                        </div>
                                    </div>
                                </div>                                                                                                                                   

                                <div class="row">
                                    <div class="col-md-3">
                                        <h5 class="card-title m-b-0">Image</h5>
                                            <div class="form-group m-t-20">
                                                <div class="add_image_div add_image_div_red" style="background-image: url({{ isset($ui_config)? $ui_config->img_url:Request::old('img_url') }});">
                                                </div>
                                                <input type="hidden" id="removeImageFlag" value="0" name="removeImageFlag">
                                                <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage" name="removeImage">
                                                <p class="text-danger">{{$errors->first('img_url')}}</p>
                                            </div>
                                    </div>
                               </div>
                               
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="degree3">Status</label>
                                                <select class="form-control" value="{{ old('status') }}" name="status" id="status">
                                                <?php
                                                if(isset($obj)){
                                                ?>
                                                    <option value="1" <?php if ($ui_config->status == 1){ echo 'selected'; } ?>>Active</option>
                                                    <option value="0" <?php if ($ui_config->status == 0){ echo 'selected'; } ?>>In-Active</option>

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
            @include('backend_v2.modals.image_upload_ui')

        </div>
        </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

@include('layouts.partial.footer')
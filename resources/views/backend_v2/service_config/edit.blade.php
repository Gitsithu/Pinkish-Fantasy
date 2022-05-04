@include('layouts.partial.header')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="account-settings-container layout-top-spacing">
            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">                         
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form action="/admin/service/update/{{ isset($service_config)? $service_config->id:0 }}" method="post"  enctype="multipart/form-data" id="general-info" class="section general-info">
                            {{csrf_field()}}
                            {{ method_field('PATCH') }}
                                <div class="info">
                                    <h6 class="">Editing Service Tab</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="Type">Type</label>
                                                                    <input type="text" class="form-control" value="{{ isset($service_config)? $service_config->type:Request::old('type') }}" name="type" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="title">Title</label>
                                                                    <input type="text" class="form-control" value="{{ isset($service_config)? $service_config->title:Request::old('title') }}" name="title">
                                                                    <p class="text-danger">{{$errors->first('title')}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="description">Description</label>
                                                                    <input type="text" class="form-control" value="{{ isset($service_config)? $service_config->description:Request::old('description') }}" name="description">
                                                                    <p class="text-danger">{{$errors->first('description')}}</p>
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
                                                                            <option value="1" <?php if ($service_config->status == 1){ echo 'selected'; } ?>>Active</option>
                                                                            <option value="0" <?php if ($service_config->status == 0){ echo 'selected'; } ?>>In-Active</option>
                        
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
@include('layouts.partial.header')
      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
            <div class="layout-px-spacing">                
                    
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                        
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                   <form action="/admin/main_category/update/{{ isset($main_categories)? $main_categories->id:0 }}" method="post"  enctype="multipart/form-data" id="general-info" class="section general-info">
                    <!-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> -->
                                    {{csrf_field()}}
                                    {{ method_field('PATCH') }}
                                            <div class="info">
                                            <h6 class="">Editng Main Category</h6>
                                             <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Main Category Name</label>
                                                                                <input type="text" class="form-control" value="{{ isset($main_categories)? $main_categories->name:Request::old('name') }}" name="name" placeholder="Type category name here">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Status</label>
                                                                                <select class="form-control" value="{{ old('status') }}" name="status" id="status">
                                                                                <?php
                                                                                if(isset($obj)){
                                                                                ?>

                                                                                    <option value="1" <?php if ($main_categories->status == 1){ echo 'selected'; } ?>>Active</option>
                                                                                    <option value="0" <?php if ($main_categories->status == 0){ echo 'selected'; } ?>>In-Active</option>

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

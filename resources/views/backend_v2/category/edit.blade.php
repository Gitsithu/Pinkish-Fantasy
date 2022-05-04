@include('layouts.partial.header')
      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                   <form action="/admin/category/update/{{ isset($categories)? $categories->id:0 }}" method="post"  enctype="multipart/form-data" id="general-info" class="section general-info">
                    <!-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> -->
                                    {{csrf_field()}}
                                    {{ method_field('PATCH') }}
                                            <div class="info">
                                            <h6 class="">Editng Category</h6>
                                             <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Category Name</label>
                                                                                <input type="text" class="form-control" value="{{ isset($categories)? $categories->name:Request::old('name') }}" name="name" placeholder="Type category name here">
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

                                                                                    <option value="1" <?php if ($categories->status == 1){ echo 'selected'; } ?>>Active</option>
                                                                                    <option value="0" <?php if ($categories->status == 0){ echo 'selected'; } ?>>In-Active</option>

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
                                                                <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Sub Category</label>
                                                                        <select class="selectpicker" data-live-search="true" data-width="100%" name="sub_categories_id" id="sub_categories_id">
                                                                            {{-- dynamic looping--}}
                                                                            @foreach($sub_categories as $sub_category)
                                                                            @if($categories->sub_categories_id == $sub_category->id)
                                                                                <option value="{{$sub_category->id}}" selected>{{$sub_category->name}}</option>
                                                                            @else
                                                                                <option value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                                                                            @endif
                                                                        @endforeach
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
        <script type="text/javascript">
            $(document).ready(function() {


                //Start Validation for Entry and Edit Form
                $('#general-info').validate({
                    rules: {
                        name                  : 'required',
                        status                : 'required',
                        sub_categories_id     : 'required',
                    },
                    messages: {
                        name                  : 'Name is required',
                        status                : 'Status is required',
                        sub_categories_id     : 'Sub category is required',
                    },
                    submitHandler: function(form) {

                        $('input[type="submit"]').attr('disabled','disabled');
                        form.submit();
                    }

            })
            });

        </script>
@include('layouts.partial.footer')

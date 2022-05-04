@include('layouts.partial.header')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="account-settings-container layout-top-spacing">
            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">                         
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form action="/admin/about_us/update/{{ isset($about_us) ? $about_us->id:0 }}" method="post" enctype="multipart/form-data" id="general-info" class="section general-info" onsubmit="return myFunction();">
                            {{csrf_field()}}
                            {{ method_field('PATCH') }}
                                <div class="info">
                                    @if (session('success'))
                                        <div class="flash-message col-md-12">
                                            <div class="alert alert-success ">
                                                {{session('success')}}
                                            </div>
                                        </div>
                                    @elseif(session('fail'))
                                        <div class="flash-message col-md-12">
                                            <div class="alert alert-danger">
                                                {{session('fail')}}
                                            </div>
                                        </div>
                                    @endif
                                    <h6 class="">About Us Configuration</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <h5 class="card-title m-b-0">Image</h5>
                                                                    <div class="form-group m-t-20">
                                                                        <div class="add_image_div add_image_div_red" style="background-image: url({{ isset($about_us)? $about_us->image:Request::old('image') }});">
                                                                        </div>
                                                                        <input type="hidden" id="removeImageFlag" value="0" name="removeImageFlag">
                                                                        <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage" name="removeImage">
                                                                        <p class="text-danger">{{$errors->first('image')}}</p>
                                                                    </div>
                                                            </div>
                                                       </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="title">Title</label>
                                                                    <input type="text" class="form-control" value="{{ isset($about_us)? $about_us->title:Request::old('title') }}" name="title" id="title">
                                                                    <p class="text-danger">{{$errors->first('title')}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="author">Author</label>
                                                                    <input type="text" class="form-control" value="{{ isset($about_us)? $about_us->author:Request::old('author') }}" name="author" id="author">
                                                                    <p class="text-danger">{{$errors->first('author')}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="paragraph1">Paragraph 1</label>
                                                                    <textarea class="form-control" name="paragraph1" id="paragraph1" cols="10" rows="5">{{ isset($about_us)? $about_us->paragraph1:Request::old('paragraph1') }}</textarea>
                                                                    <p class="text-danger">{{$errors->first('paragraph1')}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="paragraph2">Paragraph 2</label>
                                                                    <textarea class="form-control" name="paragraph2" id="paragraph2" cols="10" rows="5">{{ isset($about_us)? $about_us->paragraph2:Request::old('paragraph2') }}</textarea>
                                                                    <p class="text-danger">{{$errors->first('paragraph2')}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="paragraph3">Paragraph 3</label>
                                                                    <textarea class="form-control" name="paragraph3" id="paragraph3" cols="10" rows="5">{{ isset($about_us)? $about_us->paragraph3:Request::old('paragraph3') }}</textarea>
                                                                    <p class="text-danger">{{$errors->first('paragraph3')}}</p>
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
                                    @include('backend_v2.modals.image_upload_about_us')
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
    function myFunction() {
        if(!confirm("Are You Sure to update About Us Page Contents?"))
        event.preventDefault();
    }
</script>

@include('layouts.partial.footer')
@include('layouts.partial.header')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="account-settings-container layout-top-spacing">
            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">                         
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form action="/admin/contact_us/update/{{ isset($contact_us) ? $contact_us->id:0 }}" method="post" id="general-info" class="section general-info" onsubmit="return myFunction();">
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
                                    <h6 class="">Contact Us Configuration</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="address">Address</label>
                                                                    <textarea class="form-control" name="address" id="address" cols="30" rows="3">{{ isset($contact_us)? $contact_us->address:Request::old('address') }}</textarea>
                                                                    <p class="text-danger">{{$errors->first('address')}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="phone">Phone</label>
                                                                    <input type="text" class="form-control" value="{{ isset($contact_us)? $contact_us->phone:Request::old('phone') }}" name="phone" id="phone">
                                                                    <p class="text-danger">{{$errors->first('phone')}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input type="text" class="form-control" value="{{ isset($contact_us)? $contact_us->email:Request::old('email') }}" name="email" id="email">
                                                                    <p class="text-danger">{{$errors->first('email')}}</p>
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
    function myFunction() {
        if(!confirm("Are You Sure to update Contact Us Page Contents?"))
        event.preventDefault();
    }
</script>

@include('layouts.partial.footer')
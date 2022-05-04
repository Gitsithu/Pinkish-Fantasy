@include('layouts.partial.header')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="account-settings-container layout-top-spacing">
            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">                         
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form action="/admin/banks_info/store" method="post" id="general-info" class="section general-info">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <div class="info">
                                    <h6 class="">Create Bank Information Tab</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="bank">Bank Name</label>
                                                                    <input type="text" class="form-control" value="{{ old('bank') }}" name="bank" id="bank">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="account_no">Account Name</label>
                                                                    <input type="text" class="form-control" value="{{ old('account_name') }}" name="account_name" id="account_name">
                                                                    <p class="text-danger">{{$errors->first('account_name')}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="account_no">Account Number</label>
                                                                    <input type="number" class="form-control" value="{{ old('account_no') }}" name="account_no" id="account_no">
                                                                    <p class="text-danger">{{$errors->first('account_no')}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <button type="submit" class="mt-4 btn btn-primary" style="background-color:#f5a8ae!important;border: #f5a8ae!important;">Save</button>
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
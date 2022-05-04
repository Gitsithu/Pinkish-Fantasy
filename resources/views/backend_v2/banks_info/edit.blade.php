@include('layouts.partial.header')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="account-settings-container layout-top-spacing">
            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">                         
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form action="/admin/banks_info/update/{{ isset($bank_info)? $bank_info->id:0 }}" method="post" id="general-info" class="section general-info">
                            {{csrf_field()}}
                            {{ method_field('PATCH') }}
                                <div class="info">
                                    <h6 class="">Edit Bank Information Tab</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="bank">Bank Name</label>
                                                                    <input type="text" class="form-control" value="{{ isset($bank_info)? $bank_info->bank:Request::old('bank') }}" name="bank" id="bank">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="account_no">Account Name</label>
                                                                    <input type="text" class="form-control" value="{{ isset($bank_info)? $bank_info->account_name:Request::old('account_name') }}" name="account_name" id="account_name">
                                                                    <p class="text-danger">{{$errors->first('account_name')}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="account_no">Account Number</label>
                                                                    <input type="number" class="form-control" value="{{ isset($bank_info)? $bank_info->account_no:Request::old('account_no') }}" name="account_no" id="account_no">
                                                                    <p class="text-danger">{{$errors->first('account_no')}}</p>
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
                                                                            <option value="1" <?php if ($bank->status == 1){ echo 'selected'; } ?>>Active</option>
                                                                            <option value="0" <?php if ($bank->status == 0){ echo 'selected'; } ?>>In-Active</option>
                        
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
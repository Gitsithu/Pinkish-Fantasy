@include('layouts.partial.header')
      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
            <div class="layout-px-spacing">                
                    
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                        
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                   <form action="/admin/delivery/update/{{ isset($deliveries)? $deliveries->id:0 }}" method="post"  enctype="multipart/form-data" id="general-info" class="section general-info">
                    <!-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> -->
                                    {{csrf_field()}}
                                    {{ method_field('PATCH') }}
                                            <div class="info">
                                            <h6 class="">Updating Delivery Set Up</h6>
                                             <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Division</label>
                                                                                <select class="selectpicker" data-live-search="true" data-width="100%" name="division" id="division" disabled>
                                                                         
                                                                              <?php
                                                                                if(isset($deliveries)){
                                                                                ?>

                                                                                    <option value="1" <?php if ($deliveries->division == 1){ echo 'selected'; } ?>>Yangon</option>
                                                                                    <option value="2" <?php if ($deliveries->division == 2){ echo 'selected'; } ?>>Mandalay</option>
                                                                                    <option value="3" <?php if ($deliveries->division == 3){ echo 'selected'; } ?>>Others</option>

                                                                                <?php
                                                                                }
                                                                           ?>
                                                                         </select>
                                                                        <p class="text-danger">{{$errors->first('division')}}</p>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                        @if(isset($deliveries)) 
                                                                        @if($deliveries->division==1)                                                                  
                                                                        <div class="row">
                                                                        <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3" id="township">Township</label>
                                                                               <input type="text" class="form-control" value="{{ isset($deliveries)? $deliveries->township:Request::old('township') }}" id="township" name="township" placeholder="Type township here" >
                                                                                <p class="text-danger">{{$errors->first('township')}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    @else
                                                                    @endif
                                                                    @endif
                                                                   <div class="row">
                                                                <div class="col-sm-6">
                                                                 <div class="form-group">
                                                                            <label for="degree3">Charges</label>
                                                                       
                                                                    <input type="text" class="form-control" value="{{ isset($deliveries)? $deliveries->charges:Request::old('charges') }}" name="charges" placeholder="Type delivery charges here" >
                                                                    <p class="text-danger">{{$errors->first('charges')}}</p>
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
        
        
<script type="text/javascript">
    $(document).ready(function() {        

        
        //Start Validation for Entry and Edit Form
        $('#general-info').validate({
            rules: {
                charges                  : 'required',

            },
            messages: {
                charges                  : 'Charges is required',
            },
            submitHandler: function(form) {

                $('input[type="submit"]').attr('disabled','disabled');
                form.submit();
            }

    })
    });
</script>
@include('layouts.partial.footer')

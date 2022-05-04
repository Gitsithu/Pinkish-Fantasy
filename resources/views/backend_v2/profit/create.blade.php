@include('layouts.partial.header')
      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form action="/admin/profit/store" method="post" enctype="multipart/form-data" id="general-info" class="section general-info">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <div class="info">
                                            <h6 class="">Creating Profit</h6>
                                             <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Minimum Range</label>
                                                                                <input type="text" class="form-control" value="{{ old('min') }}" name="min" placeholder="Type minimum range here">
                                                                                <p class="text-danger">{{$errors->first('min')}}</p>
                                                                        </div>
                                                                    </div>
                                                                     <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Maximum Range</label>
                                                                                <input type="text" class="form-control" value="{{ old('max') }}" name="max" placeholder="Type maximum range here">
                                                                                <p class="text-danger">{{$errors->first('max')}}</p>
                                                                        </div>
                                                                    </div>
                                                                   
                                                                    </div>
                                                                    <div class="row">
                                                                     <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3"> Country</label>
                                                                         <select class="selectpicker" data-live-search="true" data-width="100%" name="countries_id" id="countries_id">
                                                                         @foreach($countries as $country)
                                                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                                        @endforeach
                                                                         </select>
                                                                        <p class="text-danger">{{$errors->first('countries_id')}}</p>

                                                                    </div>
                                                                    </div>
                                                                     <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Percent</label>
                                                                                <input type="text" class="form-control" value="{{ old('percent') }}" name="percent" placeholder="Type profit percentage here">
                                                                                <p class="text-danger">{{$errors->first('percent')}}</p>
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
                percent                 : 'required',
                min                     : 'required',
              
            },
            messages: {
                percent             : 'Percentage is required',
                min                 : 'Minimum Range is required',

               
            },
            submitHandler: function(form) {

                $('input[type="submit"]').attr('disabled','disabled');
                form.submit();
            }

    })
    });

</script>
@include('layouts.partial.footer')

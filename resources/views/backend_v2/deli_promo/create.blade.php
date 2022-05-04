@include('layouts.partial.header')
      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">

                        <!-- this is end for alert the message box when user take action -->
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form action="/admin/deli_promo/store" method="post" enctype="multipart/form-data" id="general-info" class="section general-info">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <div class="info">
                                            <h6 class="">Creating Delivery Promotion</h6>
                                             <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                   
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Start Date</label>
                                                                               <input type="date" class="form-control" value="{{ old('start_date') }}" name="start_date" placeholder="Choose your start date" >
                                                                                <p class="text-danger">{{$errors->first('start_date')}}</p>
                                                                        </div>
                                                                    </div>
                                                                     <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3">End Date</label>
                                                                                <input type="date" class="form-control" value="{{ old('end_date') }}" name="end_date" placeholder="Choose your end date" >
                                                                                <p class="text-danger">{{$errors->first('end_date')}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                
                                                                    
                                                                     <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Ammount</label>
                                                                                <input type="text" class="form-control" value="{{ old('amt') }}" name="amt" placeholder="Type your discount" >
                                                                                <p class="text-danger">{{$errors->first('amt')}}</p>
                                                                        </div>
                                                                    </div>

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
        $(".chosen-select").chosen(); 

        //Start Validation for Entry and Edit Form
        $('#general-info').validate({
            rules: {
                start_date                  : 'required',
                end_date                    : 'required',
                product_status              : 'required',
                discount                    : 'required',

            },
            messages: {
                start_date                  : 'Start Date is required',
                end_date                    : 'End Date is required',
                product_status              : 'Product Status is required',
                discount                    : 'Discount is required',
            },
            submitHandler: function(form) {

                $('input[type="submit"]').attr('disabled','disabled');
                form.submit();
            }

    })
    });

    function getProductsByStatus(selected_status_id){

if(selected_status_id != 0){

    let table_name = 'promotion';
    let conditions = {product_status: selected_status_id};
    let request_data = JSON.stringify(conditions);

    $.ajax({
        type:'POST',
        url:'/api/' + table_name,
        data:{ _token: "{{csrf_token()}}", conditions : request_data},
        dataType: 'json',
        success:function(data){
            
            let temp_data = data.returned_obj;
            console.log(temp_data);
            $("#product_id").html(temp_data.objs);
            $("#product_id").trigger("chosen:updated");
        }
    }); 

}
}

</script>
@include('layouts.partial.footer')

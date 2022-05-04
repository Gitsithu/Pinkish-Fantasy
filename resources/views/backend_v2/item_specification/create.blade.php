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
                                    <form action="/admin/item_specification/store" method="post" enctype="multipart/form-data" id="general-info" class="section general-info">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <div class="info">
                                            <h6 class="">Creating Item Specification</h6>
                                             <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                            @foreach($items as $item)
                                                            <input type="hidden" name="item_id" value="{{$item->id}}">

                                                            @endforeach
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                            <table id="myTable" class="table order-list">
                                                            <thead>
                                                                <tr>
                                                                    <td style="color:black;" class="text-center">Size</td>
                                                                    <td style="color:black;" class="text-center">Color</td>

                                                                    <td style="color:black;" class="text-center" id="qty">Quantity</td>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <input type="text" name="size[]" class="form-control dz" id="size" required>
                                                                        {{-- <p class="text-danger">{{$errors->first('size')}}</p> --}}

                                                                    </td>
                                                                    <td class="text-center">
                                                                        <input type="color" name="color[]" class="form-control dy" id="color" required>
                                                                        {{-- <p class="text-danger">{{$errors->first('color')}}</p> --}}

                                                                    </td>

                                                                    <td class="text-center" id="qty">
                                                                        <input type="number" name="qty[]"  class="form-control dz" id="qty" min="0" >
                                                                        {{-- <p class="text-danger">{{$errors->first('qty')}}</p> --}}

                                                                    </td>


                                                                </tr>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="5" style="text-align: left;">
                                                                        <input type="button" style="background-color:white;color:black;border:1px solid black;" class="btn btn-lg btn-block " id="addrow" value="Add Row" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
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
                                            @include('backend_v2.modals.script')
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
                items_id              : 'required',

            },
            messages: {
                items_id              : 'Item is required',

            },
            submitHandler: function(form) {

                $('input[type="submit"]').attr('disabled','disabled');
                form.submit();
            }

    })
    });
//     function getSaleTypesByItemId(selected_item_id){
//         let b = selected_item_id.split(" ");
//         console.log(b);
//         let qty = document.querySelectorAll('#qty');

//  if(b[0] == 1){
//             let index = 0;
//             let length = qty.length;
//             for (; index < length; index++) {
//                 qty[index].style.display = "block";
//             }


//  }
// else{
//     let index = 0;
//             let length = qty.length;
//             for (; index < length; index++) {
//                 qty[index].style.display = "none";
//             }
// }
//     }

</script>
@include('layouts.partial.footer')

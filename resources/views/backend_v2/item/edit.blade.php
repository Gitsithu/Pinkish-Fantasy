@include('layouts.partial.header')
      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <form action="/admin/item/update/{{ isset($items)? $items->id:0 }}" method="post"  enctype="multipart/form-data" id="general-info" class="section general-info">
                    <!-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> -->
                                    {{csrf_field()}}
                                    {{ method_field('PATCH') }}

                                            <div class="info">
                                            <h6 class="">Editing Item</h6>
                                             <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Item Name</label>
                                                                                <input type="text" class="form-control" value="{{ isset($items)? $items->name:Request::old('name') }}" name="name" placeholder="Type item name here">
                                                                                <p class="text-danger">{{$errors->first('name')}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Sale Type</label>
                                                                            <select class="form-control"  value="{{ old('sale_type') }}" name="sale_type" id="sale_type">
                                                                                <?php
                                                                                if(isset($items)){
                                                                                ?>

                                                                                    <option value="0" <?php if ($items->sale_type == 0){ echo 'selected'; } ?>>Instock</option>
                                                                                    <option value="1" <?php if ($items->sale_type == 1){ echo 'selected'; } ?>>Pre Order</option>

                                                                                <?php
                                                                                }
                                                                                else{
                                                                                ?>

                                                                                    <option value="0">Instock</option>
                                                                                    <option value="1">Pre Order</option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="degree3">Status</label>
                                                                            <select class="form-control" value="{{ old('status') }}" name="status" id="status">
                                                                                <?php
                                                                                if(isset($items)){
                                                                                ?>

                                                                                    <option value="1" <?php if ($items->status == 1){ echo 'selected'; } ?>>Active</option>
                                                                                    <option value="0" <?php if ($items->status == 0){ echo 'selected'; } ?>>Archive</option>
                                                                                    <option value="2" <?php if ($items->status == 2){ echo 'selected'; } ?>>In-Active</option>

                                                                                <?php
                                                                                }
                                                                                else{
                                                                                ?>

                                                                                    <option value="1">Active</option>
                                                                                    <option value="0">Archive</option>
                                                                                    <option value="2">In-active</option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="degree3"> Category</label>
                                                                            <select class="selectpicker" data-live-search="true" data-width="100%" name="categories_id" id="categories_id" >
                                                                            {{-- dynamic looping--}}
                                                                            @foreach($categories as $category)
                                                                            @if($items->categories_id == $category->id)
                                                                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                                                            @else
                                                                            <option value="{{$category->id}}" >{{$category->name}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                        </select>
                                                                        <p class="text-danger">{{$errors->first('categories_id')}}</p>

                                                                    </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="degree3"> Brand</label>
                                                                            <select class="selectpicker" data-live-search="true" data-width="100%" name="brands_id" id="brands_id" >
                                                                            {{-- dynamic looping--}}
                                                                            @foreach($brands as $brand)
                                                                            @if($items->brands_id == $brand->id)
                                                                                <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                                                                                @else
                                                                                <option value="{{$brand->id}}" >{{$brand->name}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                        </select>
                                                                        <p class="text-danger">{{$errors->first('brands_id')}}</p>

                                                                    </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="degree3"> Option</label>
                                                                            <select class="selectpicker" data-live-search="true" data-width="100%" name="countries_id" id="countries_id" disabled>
                                                                            {{-- dynamic looping--}}
                                                                            @foreach($countries as $country)
                                                                            @if($items->countries_id == $country->id)
                                                                                <option value="{{$country->id}}" selected>{{$country->name}}</option>
                                                                                @else
                                                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                        </select>
                                                                        <p class="text-danger">{{$errors->first('countries_id')}}</p>

                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="fullUrl">Item Url</label>
                                                                                <input type="text" class="form-control"  value="{{ isset($items)? $items->url:Request::old('url') }}" name="url" placeholder="Type item url here">
                                                                                <p class="text-danger">{{$errors->first('url')}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="fullUrl">Purchase Price</label>
                                                                                <input type="text" class="form-control" value="{{ isset($items)? $items->purchase_price:Request::old('purchase_price') }}" name="purchase_price" placeholder="Type Purchase Price here">
                                                                                <p class="text-danger">{{$errors->first('purchase_price')}}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                    @if(isset($items))
                                                                    @if($items->additional_charges == null)
                                                                    <div class="custom-control custom-switch" style="margin-bottom:4px;">
                                                                <input type="checkbox" class="custom-control-input" id="customSwitch1" onclick="myFunction()">
                                                                 <label class="custom-control-label" for="customSwitch1">Additional charges</label>
                                                                </div>

                                                                <input style="display:none;" type="text" class="form-control" value="{{  isset($items)? $items->additional_charges:Request::old('additional_charges') }}" id="additional_charges" name="additional_charges" placeholder="Type Additional Charges here">
                                                                                <p class="text-danger">{{$errors->first('additional_charges')}}</p>
                                                                    </div>
                                                                    @else
                                                                    <div class="custom-control custom-switch" style="margin-bottom:4px;">
                                                                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked onclick="myFunction()">
                                                                 <label class="custom-control-label" for="customSwitch1">Additional charges</label>
                                                                </div>

                                                                <input style="display:block;" type="text" class="form-control" value="{{  isset($items)? $items->additional_charges:Request::old('additional_charges') }}" id="additional_charges" name="additional_charges" placeholder="Type Additional Charges here">
                                                                                <p class="text-danger">{{$errors->first('additonal_charges')}}</p>
                                                                    </div>
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                                <div class="row">
                                                                <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="fullUrl">Cargo Fee</label>
                                                                                <input type="text" class="form-control" value="{{ isset($items)? $items->cargo_fee:Request::old('cargo_fee') }}" name="cargo_fee" placeholder="Type Cargo Fee here">
                                                                                <p class="text-danger">{{$errors->first('cargo_fee')}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label for="fullUrl">Shipping Fee</label>
                                                                                <input type="text" class="form-control" value="{{ isset($items)? $items->shipping_fee:Request::old('shipping_fee') }}" name="shipping_fee" placeholder="Type Shipping Fee here">
                                                                                <p class="text-danger">{{$errors->first('shipping_fee')}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                    <br>
                                                                    @isset($items)
                                                                    @if($items->profit_id == 1)
                                                                  <input type="radio" id="promo_percent" name="profit_id" value="1" checked>
                                                                  <label for="promo_percent">Percentage</label><br>
                                                                  <input type="radio" id="promo_amount" name="profit_id" value="0">
                                                                   <label for="promo_amount">Amount</label><br>
                                                                   @else
                                                                   <input type="radio" id="promo_percent" name="profit_id" value="1" >
                                                                  <label for="promo_percent">Percentage</label><br>
                                                                  <input type="radio" id="promo_amount" name="profit_id" value="0" checked>
                                                                   <label for="promo_amount">Amount</label><br>
                                                                   @endif
                                                                   @endisset
                                                                    </div>

                                                                            </div>

                                                                <div class="row">
                                                                <div class="col-md-3">
                                                    <h5 class="card-title m-b-0">Item Image 1</h5>
                                                    <div class="form-group m-t-20">

                                                            <div class="add_image_div1 add_image_div_red"
                                                                style="background-image: url({{ isset($items)? $items->image_url1:Request::old('image_url1') }});">
                                                            </div>
                                                            <input type="hidden" id="removeImageFlag1" value="0" name="removeImageFlag1">
                                                            <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage1"
                                                                name="removeImage1">

                                                                <p class="text-danger">{{$errors->first('image_url1')}}</p>
                                                    </div>

                                                </div>
                                                <div class="col-md-3">
                                                    <h5 class="card-title m-b-0">Item Image 2</h5>
                                                    <div class="form-group m-t-20">

                                                            <div class="add_image_div2 add_image_div_red"
                                                                style="background-image: url({{ isset($items)? $items->image_url2:Request::old('image_url2') }});">
                                                            </div>
                                                            <input type="hidden" id="removeImageFlag2" value="0" name="removeImageFlag2">
                                                            <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage2"
                                                                name="removeImage2">


                                                    </div>

                                                </div>
                                                <div class="col-md-3">
                                                    <h5 class="card-title m-b-0">Item Image 3</h5>
                                                    <div class="form-group m-t-20">

                                                            <div class="add_image_div3 add_image_div_red"
                                                                style="background-image: url({{ isset($items)? $items->image_url3:Request::old('image_url3') }});">
                                                            </div>
                                                            <input type="hidden" id="removeImageFlag3" value="0" name="removeImageFlag3">
                                                            <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage3"
                                                                name="removeImage3">


                                                    </div>

                                                </div>
                                                <div class="col-md-3">
                                                    <h5 class="card-title m-b-0">Item Image 4</h5>
                                                    <div class="form-group m-t-20">

                                                            <div class="add_image_div4 add_image_div_red"
                                                                style="background-image: url({{ isset($items)? $items->image_url4:Request::old('image_url4') }});">
                                                            </div>
                                                            <input type="hidden" id="removeImageFlag4" value="0" name="removeImageFlag4">
                                                            <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage4"
                                                                name="removeImage4">


                                                    </div>

                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="col-md-3">
                                                    <h5 class="card-title m-b-0">Item Image 5</h5>
                                                    <div class="form-group m-t-20">

                                                            <div class="add_image_div5 add_image_div_red"
                                                                style="background-image: url({{ isset($items)? $items->image_url5:Request::old('image_url5') }});">
                                                            </div>
                                                            <input type="hidden" id="removeImageFlag5" value="0" name="removeImageFlag5">
                                                            <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage5"
                                                                name="removeImage5">


                                                    </div>

                                                </div>
                                                <div class="col-md-3">
                                                    <h5 class="card-title m-b-0">Item Image 6</h5>
                                                    <div class="form-group m-t-20">

                                                            <div class="add_image_div6 add_image_div_red"
                                                                style="background-image: url({{ isset($items)? $items->image_url6:Request::old('image_url6') }});">
                                                            </div>
                                                            <input type="hidden" id="removeImageFlag6" value="0" name="removeImageFlag6">
                                                            <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage6"
                                                                name="removeImage6">


                                                    </div>

                                                </div>
                                                <div class="col-md-3">
                                                    <h5 class="card-title m-b-0">Item Image 7</h5>
                                                    <div class="form-group m-t-20">

                                                            <div class="add_image_div7 add_image_div_red"
                                                                style="background-image: url({{ isset($items)? $items->image_url7:Request::old('image_url7') }});">
                                                            </div>
                                                            <input type="hidden" id="removeImageFlag7" value="0" name="removeImageFlag7">
                                                            <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage7"
                                                                name="removeImage7">


                                                    </div>

                                                </div>
                                                <div class="col-md-3">
                                                    <h5 class="card-title m-b-0">Item Image 8</h5>
                                                    <div class="form-group m-t-20">

                                                            <div class="add_image_div8 add_image_div_red"
                                                                style="background-image: url({{ isset($items)? $items->image_url8:Request::old('image_url8') }});">
                                                            </div>
                                                            <input type="hidden" id="removeImageFlag8" value="0" name="removeImageFlag8">
                                                            <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage8"
                                                                name="removeImage8">


                                                    </div>

                                                </div>
                                                                </div>
                                                                <div class="row">

                <div class="col-md-6">
                                                    <h5 class="card-title m-b-0">Detail Info</h5>
                                                    <div class="form-group m-t-20">

                                                            <div class="add_image_div9 add_image_div_red"
                                                                style="background-image: url({{ isset($items)? $items->image_url9:Request::old('image_url9') }});">
                                                            </div>
                                                            <input type="hidden" id="removeImageFlag9" value="0" name="removeImageFlag9">
                                                            <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage9"
                                                                name="removeImage9">


                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <h5 class="card-title m-b-0">Size Chart</h5>
                                                    <div class="form-group m-t-20">

                                                            <div class="add_image_div10 add_image_div_red"
                                                                style="background-image: url({{ isset($items)? $items->image_url10:Request::old('image_url10') }});">
                                                            </div>
                                                            <input type="hidden" id="removeImageFlag10" value="0" name="removeImageFlag10">
                                                            <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage10"
                                                                name="removeImage10">


                                                    </div>

                                                </div>



            </div>
            <div class="row">
            <div class="col-md-6">
                    <h5 class="card-title m-b-0">Description<span class="blue_remark_text"></span></h5>
                    <div class="form-group m-t-20">

                        <textarea rows="2" cols="50" class="form-control" name="description" id="description"
                            placeholder="Enter Description">{{ isset($items)? $items->description:Request::old('description') }}</textarea>
                        <p class="text-danger">{{$errors->first('description')}}</p>

                    </div>
                </div>
                <div class="col-md-6">
                    <h5 class="card-title m-b-0">Remark<span class="blue_remark_text"></span></h5>
                    <div class="form-group m-t-20">

                        <textarea rows="2" cols="50" class="form-control" name="remark" id="remark"
                            placeholder="Enter Remark">{{ isset($items)? $items->remark:Request::old('remark') }}</textarea>
                        <p class="text-danger">{{$errors->first('remark')}}</p>

                    </div>
                </div>
            </div>

                    <div class="row">
                                                                    <div class="col-sm-12">
                                                            <table id="myTable" class="table order-list">
                                                            <thead>
                                                                <tr>
                                                                    <td style="color:black;font-weight:bold;" class="text-center">Size</td>
                                                                    <td style="color:black;font-weight:bold;" class="text-center">Color</td>
                                                                    <td style="color:black;font-weight:bold;" class="text-center" id="qty">Quantity</td>

                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            @foreach($item_specifications as $item_specification)
                                                                <tr>
                                                                <input type="hidden" name="id[]" value="{{  $item_specification->id }}">
                                                                    <td class="text-center">
                                                                        <input type="text" name="size[]" value ="{{ $item_specification->size }}" class="form-control dz" id="size"/>

                                                                    </td>

                                                                    <td class="text-center">
                                                                        <input type="color" name="color[]" value ="{{ isset($item_specification)? $item_specification->color:Request::old('color') }}" class="form-control dy" id="color"/>

                                                                    </td>
                                                                    <td class="text-center" id="qty" >
                                                                        <input type="number" name="qty[]" value ="{{ isset($item_specification)? $item_specification->qty:Request::old('qty') }}" class="form-control dz" id="qty" min="0"/>

                                                                    </td>






                                                                </tr>
                                                                @endforeach

                                                            </tbody>
                                                            </table>
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
                                            @include('backend_v2.modals.image_upload_item1')
                                            @include('backend_v2.modals.image_upload_item2')
                                            @include('backend_v2.modals.image_upload_item3')
                                            @include('backend_v2.modals.image_upload_item4')
                                            @include('backend_v2.modals.image_upload_item5')
                                            @include('backend_v2.modals.image_upload_item6')
                                            @include('backend_v2.modals.image_upload_item7')
                                            @include('backend_v2.modals.image_upload_item8')
                                            @include('backend_v2.modals.image_upload_item9')
                                            @include('backend_v2.modals.image_upload_item10')

                                        </div>



                                       <!--  -->
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
                categories_id       : 'required',
                countries_id        : 'required',
            },
            messages: {
                categories_id       : 'Category is required',
                countries_id        : 'Country is required',
            },
            submitHandler: function(form) {
                $('input[type="submit"]').attr('disabled','disabled');
                form.submit();
            }
    })
    });
//     window.onload = function (){
//         var f = document.getElementById("sale_type").value;
//         let qty = document.querySelectorAll('#qty');
// if(f == 1){
//            let index = 0;
//            let length = qty.length;
//            for (; index < length; index++) {
//                qty[index].style.display = "block";
//            }
// }
// else{
//    let index = 0;
//            let length = qty.length;
//            for (; index < length; index++) {
//                qty[index].style.display = "none";
//            }
// }
//     };
//     function getQtyBySaleType(selected_sale_type_id){
//         let qty = document.querySelectorAll('#qty');
//  if(selected_sale_type_id == 1){
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
<script>
function myFunction() {
  var x = document.getElementById("additional_charges");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
@include('layouts.partial.footer')

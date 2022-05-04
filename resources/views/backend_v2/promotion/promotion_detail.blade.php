@include('layouts.partial.header')
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel"><b>Promotion Detail</b></h6>
                <a href="/admin/promotion" >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </a>
            </div>
            <div class="modal-body" style="padding:0px!important;opacity:1!important;">
            
            <form action="" id="frm_pre">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">
                            <div class="table-responsive mb-4 mt-4">

                            <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                        <th class="checkbox-column">
                                                <label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;">
                                                    <input type="checkbox" class="new-control-input todochkbox" id="todoAll">
                                                    <span class="new-control-indicator"></span>
                                                </label>
                                            </th>
                                            
                                            <th style="color: black;" class="text-center">Promotion_Name</th>
                                            <th style="color: black;" class="text-center">Status</th>
                                            <th style="color: black;" class="text-center">Product_Status</th>
                                            <th style="color: black;" class="text-center">Product</th>
                                            

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($promotions as $promotion)
                                         <tr>
                                         <td>

                                <label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;">
                                <input type="checkbox" class="new-control-input todochkbox"  name="id[]" value="{{$promotion->id}}" id="todo-1">
                                <span class="new-control-indicator"></span>

                                </td>
                                           
                                            <td class="text-center"><b style="color:black;!important">{{ $promotion->pname}}</b></td>
                                            <td>
                                            @if($promotion->pstatus == 1)
                                                <div class="t-dot bg-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active"></div>
                                            @else
                                                <div class="t-dot bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="In-active"></div>
                                            @endif
                                            </td>
                                           
                                            <td class="text-center"><b style="color:black;!important"> @if($promotion->product_status == 2 || $promotion->product_status == 1)
                                            Category
                                            @elseif($promotion->product_status == 4)
                                            Brand
                                            @else
                                            Item
                                            @endif</b></td>
                                            <td class="text-center"><b style="color:black;!important">@if($promotion->product_status==2 || $promotion->product_status == 1)
                                            @foreach($category as $categories)
                                            @if($promotion->product_id == $categories->id)
                                            {{ $categories->name}}
                                            @endif
                                            @endforeach

                                            @elseif($promotion->product_status==4)
                                            @foreach($brand as $brands)
                                            @if($promotion->product_id == $brands->id)
                                            {{ $brands->name}}
                                            @endif
                                            @endforeach
                                            
                                            @else
                                            @foreach($item as $items)
                                            @if($promotion->product_id == $items->id)
                                            {{ $items->item_code}}
                                            @endif
                                            @endforeach
                                            @endif</b></td>



                                         </tr>
                                        @endforeach

                                    </tbody>
                                
                                </table>

                            </div>
                            </form>
              {{-- modal body close tag  --}}
            </div>
         
            <div class="row" style="margin:0!important;">
            <div class="col-sm-6"></div>
            <div class="col-sm-3" id="width-control"> <button type="button" onclick="change()" style="font-weight:bold;" value="1" name="payment_status" class="form-control btn btn-danger" id="btn_3">Delete</button></div>
            <div class="col-sm-3" id="width-control">                <a href="/admin/promotion" class="btn btn-outline-danger" id="b_paid"><i class="flaticon-cancel-12"></i> Cancel</a></div>
           

            
            </div>
            
        </div>
    </div>
</div>
<script type="text/javascript">
    $(window).on('load', function() {
        $('#exampleModal2').modal('show');
    });
</script>
<script>
    checkall('todoAll', 'todochkbox');
    $('[data-toggle="tooltip"]').tooltip()
</script>

<script>

    function change(){

        var data = [];
    $("input[name='id[]']:checked").each(function() {
        data.push($(this).val());
    });

    var d = typeof(data);

                    //window.location = "/" + type + "/destroy/" + data;
                    //route path to do deletion in controller
                    $("#frm_pre").attr('action',"/admin/promotion/change2");
                    $("#frm_pre").attr('method', "POST");
                    $("#selected_checkboxes").val(data);
                    $("#frm_pre").submit();
                }
</script>
 @include('layouts.partial.footer')
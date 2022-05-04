@include('layouts.partial.header')
 <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3>Order List</h3>
                    </div>
                </div>
                <div class="row">
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
                       @if (count($errors) > 0)
                                       <div class="content mt-3">
                                           <!-- div class=row content start -->
                                           <div class="animated fadeIn">
                                               <!-- div class=FadeIn start -->
                                               <div class="card">
                                                   <!-- card start -->

                                                   <div class="card-body">
                                                       <!-- card-body start -->

                                                       <div class="row">
                                                           <!-- div class=row One start -->
                                                           @foreach ($errors->all() as $error)
                                                           <div class="col-md-12">
                                                               <!-- div class=col 12 One start -->
                                                               <p class="text-danger">* {{ $error }}</p>
                                                           </div><!-- div class=col 12 One end -->
                                                           @endforeach
                                                       </div><!-- div class=row One end -->


                                                   </div> <!-- card-body end -->

                                               </div><!-- card end -->
                                           </div><!-- div class=FadeIn start -->
                                       </div><!-- div class=row content end -->
                                       @endif

                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                         <a href="/admin/order" style="font-weight:bold;padding-top:10px;height:40px;" class="form-control btn btn-info"  id="btn_new">Orders</a>
                         </div>
                                     
                         <div class="col-md-6">
                            <a href="/admin/order/complete" style="font-weight:bold;padding-top:10px;height:40px;background-color:#f5a8ae!important;border:#f5a8ae!important;" class="form-control btn btn-success"  id="btn_new">Completed</a>
                            </div>
                        </div>
                <div class="row" id="cancel-row">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">

                            <div class="table-responsive mb-4 mt-4">

                                <table class="multi-table table sorting_desc " style="width:100%" >
                                    <thead class="sorting_desc">
                                        <tr>
                                            <th style="color: black;" class="text-center">Order_Id</th>
                                            <th style="color: black;" class="text-center">Contact_Name</th>
                                            <th style="color: black;" class="text-center">Item_Code</th>
                                            <th style="color: black;" class="text-center">Order Date</th>
                                            <th style="color: black;" class="text-center">Cart</th>
                                            <th style="color: black;" class="text-center">Quantity</th>
                                            <th style="color: black;" class="text-center">Total_Amt</th>
                                            <th style="color: black;" class="text-center">Status</th>


                                            <th style="color: black;" class="text-center">Order_Status</th>
                                            <th style="color: black;" class="text-center">Updated_by</th>

                                            <th style="color: black;" class="text-center">Action</th>
                                         


                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($orders as $order)
                                         <tr>
                                            <?php
                                            $parameter = $order->id;
                                            $parameter= Crypt::encrypt($parameter);
                                            ?>
                                             <td class="text-center"><b>{{ $order->order_id}}</b></td>
                                             <td class="text-center"><b>{{ $order->customer_name}}</b></td>
                                             <td class="text-center"><b>{{ $order->item_code}}</b></td>
                                             
                                             <td class="text-center"><b>{{ $order->order_date}}</b></td>
                                             <td class="text-center"><b>{{ $order->cart_total }}</b></td>
                                             <td class="text-center"><b>{{ $order->total_quantity }}</b></td>
                                             <td class="text-center"><b>{{ $order->final_cost}}</b></td>

                                            




                                              <td class="text-center">
                                            @if($order->status == '0')
                                            <p class="text-success">Confirm </p>
                                            @elseif($order->status == '1')
                                            <p class="text-warning">Pending </p>
                                            @elseif($order->status == '2')
                                            <p class="text-danger">Cancel </p>
                                            @elseif($order->status == '3')
                                            <p class="text-success">Delivered</p>
                                            @elseif($order->status == '4')
                                            <p class="text-success" style="color:#f5a8ae!important;">Completed</p>
                                            @endif
                                            </td>

                                             <td class="text-center">
                                             @foreach($orders as $order2)
                                             @if($order->id == $order2->order_id)
                                             @if($order2->sale_type == 0 && $order->payment_screenshot == NULL)
                                              <span  style="border:2px dashed #f5a8ae!important;color:#f5a8ae;padding:4px!important;font-weight:bold;border-radius:3px;">Open</span>
                                              @else
                                             @if($order->preorder_status == 2)
                                                 <span  style="border:2px dashed #E2A03F!important;color:#E2A03F;padding:4px!important;font-weight:bold;border-radius:3px;">Preorderd</span>
                                             @elseif($order->preorder_status == 1)
                                                 <span style="border:2px dashed #E7515A!important;color:#E7515A;padding:4px!important;font-weight:bold;border-radius:3px;">To preorder</span>
                                             @elseif($order->preorder_status == 3)
                                                 <span style="border:2px dashed #2195F1!important;color:#2195F1;padding:4px!important;font-weight:bold;border-radius:3px;">Received</span>
                                             @else
                                                 <span style="border:2px dashed #8DBF42!important;color: #8DBF42;padding:4px!important;font-weight:bold;border-radius:3px;">Delivered</span>

                                             @endif
                                             @endif
                                             @break
                                             @endif
                                             @endforeach
                                             </td>

                                             <td class="text-center">
                                             @foreach($users as $user)
                                             @if($order->updated_by == $user->id)
                                             <b>{{ $user->name}}</b>
                                             @endif
                                             @endforeach
                                             </td>
                                             <td class="text-center">
                                           
                                                
                                                    <a href="/admin/order/detail_d/{{$parameter}}"><button type="submit" onclick="return myFunction1();" class="btn btn-danger" style="font-weight:bold;background-color:#f5a8ae!important;border:#f5a8ae!important;" >View_Detail</button></a>
                                                      
                                                      
                                        </td>
                                         </tr>

                                       @endforeach

                                     </tbody>

                                </table>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel"><b>Adding Remark</b></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="order/change_2" method="post">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" id="o_id" name="o_id">
                    <label for="transaction_id">Remark</label>
                    <input class="form-control" type="text" name="remark" placeholder="Type Remark here">

            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                <button type="submit" class="btn btn-outline-success" id="c_paid">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel"><b>Payment Screenshot</b></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body" id="image">



            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
        <!--  END CONTENT AREA  -->
<script>
    function myFunction() {
        if(!confirm("Are You Sure to cancel this ?"))
        event.preventDefault();
    }

</script>
<script>
    checkall('todoAll', 'todochkbox');
    $('[data-toggle="tooltip"]').tooltip()
</script>

<script>
$('a').click(function(){
    var m = $(this).attr('data-id');
    console.log(m);
    $("#o_id").val(m);
});

    // function change_2(){

    //     var data  = [];
    //     var data2 = [];
    // $("input[name='id[]']:checked").each(function() {
    //     data.push($(this).val());
    //     var t_id = $(this).val();
    //     data2.push($('#'+t_id).val());
    // });


    // var d = typeof(data);

    //                 //window.location = "/" + type + "/destroy/" + data;
    //                 //route path to do deletion in controller
    //                 $("#frm_pre").attr('action',"/admin/order/change_2");
    //                 $("#frm_pre").attr('method', "POST");
    //                 $("#selected_checkboxes").val(data);
    //                 $("#selected_checkboxes2").val(data2);
    //                 $("#frm_pre").submit();
    //             }
    function getImage(image_src){

if(image_src != ""   ){

    let table_name = 'delivery';
    let conditions = {image_source:image_src};
    let request_data = JSON.stringify(conditions);

    $.ajax({
        type:'POST',
        url:'/admin/image/bigger/api/' + table_name,
        data:{ _token: "{{csrf_token()}}", conditions : request_data},
        dataType: 'json',
        success:function(data){

            let temp_data = data.returned_obj;
            console.log(temp_data);
            $("#image").html(temp_data.objs);
            $("#image").trigger("chosen:updated");
        }
    });

}
$('#exampleModal1').modal('show');
}
    </script>
 @include('layouts.partial.footer')

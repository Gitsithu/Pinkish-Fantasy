@include('layouts.partial.header')
 <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3>Order Report</h3>
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
                        <!-- this is end for alert the message box when user take action -->
                <div class="row" id="cancel-row">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                        <div class="row">
                        <div class="col-md-6">
                        <form method="post" action="/admin/order_report/search"  enctype="multipart/form-data">
                         <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                        @if($from_date == null )
                        From date:<input type="date" id="from_date" class="form-control" name="from_date"><br>
                        @else
                        From date:<input type="date" id="from_date" class="form-control" name="from_date" value="{{$from_date}}"><br>
                        @endif
                        </div>
                        <div class="col-md-6">
                        @if($to_date == null )
                        To date:<input type="date" id="to_date" class="form-control" name="to_date"><br>
                        @else
                        To date:<input type="date" id="to_date" class="form-control" name="to_date" value="{{$to_date}}"><br>
                        @endif
                        </div>
                       

                        </div>
                        <div class="row">
                        <div class="col-md-6">
                                         <button type="submit" name="button" value="1" style="font-weight:bold;padding-top:10px;height:40px;" class="form-control btn btn-info">View</button>
                        </div>
                        <div class="col-md-6">
                                         <button type="submit" name="button" value="3" style="font-weight:bold;padding-top:10px;height:40px;" class="form-control btn btn-success">Excel</button>
                         </div>
                    </form>
                        </div>

                            <div class="table-responsive mb-4 mt-4">
                                <table id="range-search" class="multi-table table table-hover" style="width:100%">
                                <thead>
                                        <tr>
                                            <th style="color: black;">User Name</th>
                                            <th style="color: black;" class="text-center">Item Code</th>
                                            <th style="color: black;" class="text-center">Order Date</th>
                                            <th style="color: black;" class="text-center">Contact_Name</th>
                                            <th style="color: black;" class="text-center">Address</th>
                                            <th style="color: black;" class="text-center">Phone</th>
                                            <th style="color: black;" class="text-center">Quantity</th>
                                            <th style="color: black;" class="text-center">Sub_Total</th>
                                            <th style="color: black;" class="text-center">Total_Amt</th>
                                            <th style="color: black;" class="text-center">Status</th>
                                            <th style="color: black;" class="text-center">Payment_Type</th>
                                            <th style="color: black;" class="text-center">Order_Status</th> </tr>
                                    </thead>
                                    <tbody>

                                       @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center"><b>{{ $order->name }}</b></td>
                                            <td class="text-center"><b>{{ $order->item_code}}</b></td>
                                            <td class="text-center"><b>{{ $order->order_date}}</b></td>
                                            <td class="text-center"><b>{{ $order->customer_name}}</b></td>
                                            <td class="text-center"><b>{{ $order->delivery_address}}</b></td>
                                            <td class="text-center"><b>{{ $order->phone}}</b></td>
                                            <td class="text-center"><b>{{ $order->total_quantity}}</b></td>
                                            <td class="text-center"><b>{{ $order->price}}</b></td>
                                            <td class="text-center"><b>{{ $order->final_cost}}</b></td>



                                            <td class="text-center">
                                                @if($order->status == 1)
                                                    <div class="t-dot bg-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active"></div>
                                                @else
                                                    <div class="t-dot bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="In-active"></div>
                                                @endif
                                                </td>
                                            <td class="text-center"><b>{{ $order->payment_type}}</b></td>
                                            
                                            <td class="text-center">
                                             @if($order->preorder_status == 2)
                                                 <span  style="border:2px dashed #E2A03F!important;color:#E2A03F;padding:4px!important;font-weight:bold;border-radius:3px;">Preorderd</span>
                                             @elseif($order->preorder_status == 1)
                                                 <span style="border:2px dashed #E7515A!important;color:#E7515A;padding:4px!important;font-weight:bold;border-radius:3px;">To preorder</span>
                                             @elseif($order->preorder_status == 3)
                                                 <span style="border:2px dashed #2195F1!important;color:#2195F1;padding:4px!important;font-weight:bold;border-radius:3px;">Received</span>
                                             @else
                                                 <span style="border:2px dashed #8DBF42!important;color: #8DBF42;padding:4px!important;font-weight:bold;border-radius:3px;">Delivered</span>

                                             @endif
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
        <!--  END CONTENT AREA  -->
    <script>

    function report_excel_export() {
                var type = $("#car_id").val();

        var form_action = "/admin/order_report/exportexcel/";
        window.location = form_action;
    }

    function report_pdf_export() {
                var from_date = $("#from_date").val();
                console.log(from_date);
                var to_date = $("#to_date").val();
                var type = $("#preorder_status").val();
        var form_action = "/admin/order_report/exportpdf/"+from_date"/"+to_date"/"+type;
        window.location = form_action;
    }


</script>
 @include('layouts.partial.footer')
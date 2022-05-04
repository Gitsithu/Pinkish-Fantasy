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
                          
                        <form method="post" action="/admin/instock_report/search"  enctype="multipart/form-data">
                         <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                         
                         
                        <div class="row">
                            <div class="col-md-4">
                                Instock type:<select class="form-control" id="instock_status" data-width="100%" name="instock_status">
                                  <?php
                                        if(isset($type)){
                                        ?>
                                        <option value="0" <?php if ($type == 0){ echo 'selected'; } ?>>All</option>
                                        <option value="1" <?php if ($type == 1){ echo 'selected'; } ?>>Out of stock</option>
                                        
        
        
                                        <?php
                                        }
                                        else{
                                        ?>
                                        <option value="0">All</option>
                                        <option value="1">Out of stock</option>
                                        
        
        
                                        <?php
                                        }
                                        ?>
        
        
                                </select>
                                 </div>
                        <div class="col-md-4">
                            <button type="submit" name="button" value="1" style="font-weight:bold;padding-top:10px;height:45px;margin-top:20px;" class="form-control btn btn-info">View</button>
                        </div>
                        <div class="col-md-4">
                                         <button type="submit" name="button" value="3" style="font-weight:bold;padding-top:10px;height:45px;margin-top:20px;" class="form-control btn btn-success">Excel</button>
                         </div>
                    </form>
                        </div>

                            <div class="table-responsive mb-4 mt-4">
                                <table id="range-search" class="multi-table table table-hover" style="width:100%">
                                <thead>
                                        <tr>
                                            
                                            
                                            <th style="color: black;" class="text-center">Category</th>
                                            <th style="color: black;" class="text-center">Country</th>
                                            <th style="color: black;" class="text-center">Brand</th>
                                            <th style="color: black;" class="text-center">Image</th>
                                            <th style="color: black;" class="text-center">Item_Code</th>
                                            <th style="color: black;" class="text-center">Size</th>
                                            <th style="color: black;" class="text-center">Color</th>
                                            <th style="color: black;" class="text-center">Quantity</th>
                                            <th style="color: black;" class="text-center">Cargo_Fee</th>
                                            <th style="color: black;" class="text-center">Shipping_Fee</th>
                                            <th style="color: black;" class="text-center">Purchase_Price</th>
                                            
                                            <th style="color: black;" class="text-center">Status</th>
                                            <th style="color: black;" class="text-center">Created_By</th>
                                            <th style="color: black;" class="text-center">Updated_By</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                       @foreach ($items as $item)
                                        <tr>
                                            <td class="text-center"><b>{{ $item->categories_name }}</b></td>
                                            <td class="text-center"><b>{{ $item->countries_name}}</b></td>
                                            <td class="text-center"><b>{{ $item->brands_name}}</b></td>
                                            <td class="text-center"><b>
                                                <img src="{{ $item->image_url1}}" class="img-fluid" style="width:50px; height:50px;" />
                                                </b></td>
                                            <td class="text-center"><b>{{ $item->item_code}}</b></td>
                                            <td class="text-center"><b>{{ $item->size}}</b></td>
                                            <td class="text-center">
                                                <div style="border:1px solid;height:20px;background-color:{{ $item->color }}">  </div>
                                                </td>
                                            <td class="text-center"><b>{{ $item->qty}}</b></td>
                                            <td class="text-center"><b>{{ $item->cargo_fee}}</b></td>
                                            <td class="text-center"><b>{{ $item->shipping_fee}}</b></td>
                                            <td class="text-center"><b>{{ $item->purchase_price}}</b></td>

                                            <td class="text-center">
                                                @if($item->status == 1)
                                                    <div class="t-dot bg-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active"></div>
                                                @elseif($item->status == 0 || $item->status == 3)
                                                    <div class="t-dot bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Archive"></div>
                                                @endif
                                                </td>
                                                <td class="text-center"><b>
                                                    @foreach($users as $user)
                                                    @if($item->created_by == $user->id)
                                                    {{$user->name}}
                                                    @endif
                                                    @endforeach
                                                </b></td>
                                                <td class="text-center"><b>
                                                    @foreach($users as $user)
                                                    @if($item->updated_by == $user->id)
                                                    {{$user->name}}
                                                    @endif
                                                    @endforeach
                                                </b></td>
                                            
                                            

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
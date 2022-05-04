@include('layouts.partial.header')
 <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3>Item</h3>

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
                        <div class="row">

                    <div class="col-md-8">
                    <a href="/admin/item/create" style="font-weight:bold;background-color:#f5a8ae!important;border: #f5a8ae!important;padding-top:10px;height:40px;" class="form-control btn btn-primary"  id="btn_new">Create New Item</a>
                    </div>
                    <div class="col-md-2">
                    <a href="/admin/item/inactive" style="padding-top:10px;height:40px;" class="form-control btn btn-danger"  id="btn_new">View Inactive</a>
                    </div>
                    <div class="col-md-2">
                    <a href="/admin/item/archive" style="padding-top:10px;height:40px;" class="form-control btn btn-danger"  id="btn_new">View Archive</a>
                    </div>

</div>

                <div class="row" id="cancel-row">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">

                                <table class="multi-table table table-hover" style="width:100%">

                                    <thead>

                                        <tr>
                                            <th style="color: black;" class="text-center">Item Code</th>
                                            <th style="color: black;" class="text-center">Category</th>
                                            <th style="color: black;" class="text-center">Brand</th>
                                            <th style="color: black;" class="text-center">Image</th>
                                           <!--17/3HH <th style="color: black;" class="text-center">Country</th> -->
                                            <th style="color: black;" class="text-center">Sale Type</th>
                                            <!-- 17/3HH<th style="color: black;" class="text-center">Purchase Price</th>
                                            <th style="color: black;" class="text-center">Additional Charges</th>-->
                                            <th style="color: black;" class="text-center">Status</th>
                                            <th style="color: black;" class="text-center">Created_at</th>
                                            <th style="color: black;" class="text-center">Updated_at</th>
                                            <th style="color: black;" class="text-center">Action</th>
                                            <th style="color: black;" class="text-center">Action</th>
                                            <th style="color: black;" class="text-center">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($items as $item)
                                        <tr>
                                            <td class="text-center"><b>{{ $item->item_code}}</b></td>
                                            <td class="text-center"><b>{{ $item->category_name}}</b></td>
                                            <td class="text-center"><b>{{ $item->brand_name}}</b></td>
                                            <td class="text-center"><img src="{{ $item->image_url1 }}" class="img-fluid" style="width:50px; height:50px;" /></td>

                                            <td class="text-center">
                                            @if($item->sale_type == '0')
                                            <p class="text-primary">Instock </p>
                                            @else
                                            <p class="text-danger">Pre Order </p>
                                            @endif
                                            </td>

                                            <!-- 17/3HH<td class="text-center"><b>{{ $item->purchase_price}}</b></td>-->
                                            <!-- 17/3HH<td class="text-center"><b>{{ $item->additional_charges}}</b></td>-->
                                            <td>
                                            @if($item->status == 1)
                                                <div class="t-dot bg-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active"></div>
                                            @elseif($item->status == 2)
                                                <div class="t-dot bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="In-active"></div>
                                            @else
                                                <div class="t-dot bg-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Archive"></div>
                                            @endif
                                            </td>
                                            <td class="text-center"><b>{{ $item->created_at}}</b></td>
                                            <td class="text-center"><b>{{ $item->updated_at}}</b></td>
                                             <?php
                                            $parameter = $item->id;
                                            $parameter= Crypt::encrypt($parameter);
                                            ?>
                                            <td class="text-center"><a onclick="return myFunction();" href="/admin/item/edit/{{ $parameter }}" class="btn btn-info" style="background-color:#f5a8ae!important;border:#f5a8ae!important;">Edit</a></td>
                                            <td class="text-center"><a onclick="return myFunction2();" href="/admin/delete/specification/{{ $parameter }}" class="btn btn-info" style="background-color:#f5a8ae!important;border:#f5a8ae!important;">Delete</a></td>
                                            <td class="text-center"><a onclick="return myFunction1();" href="/admin/add/specification/{{ $parameter }}" class="btn btn-info" style="background-color:#f5a8ae!important;border:#f5a8ae!important;">Add</a></td>

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
            function myFunction() {
                if(!confirm("Are You Sure to update this ?"))
                event.preventDefault();
            }
            function myFunction1() {
                if(!confirm("Are You Sure to add specifications to this ?"))
                event.preventDefault();
            }
            function myFunction2() {
                if(!confirm("Are You Sure to delete this ?"))
                event.preventDefault();
            }
        </script>

 @include('layouts.partial.footer')

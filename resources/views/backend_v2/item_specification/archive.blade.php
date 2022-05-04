@include('layouts.partial.header')
 <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3>Item Specification</h3>
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
                        <div class="col-md-10">
                                    <a href="/admin/item_specification/create" class="form-control btn btn-primary"  id="btn_new" style="font-weight:bold;background-color:#f5a8ae!important;border:#f5a8ae!important;padding-top:10px;height:40px;">Create New Item Specification</a>
                        </div>
                        <div class="col-md-2">
                    <a href="/admin/item_specification/" class="form-control btn btn-success" type="button" id="btn_new" style="height:40px;padding-top:10px;">View Active</a>
                    </div>
                    </div>
                <div class="row" id="cancel-row">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table class="multi-table table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="color: black;" class="text-center">Item_code</th>
                                            <th style="color: black;" class="text-center">Size</th>
                                            <th style="color: black;" class="text-center">Color</th>
                                            <th style="color: black;" class="text-center">Quantity</th>
                                            <th style="color: black;" class="text-center">Created_at</th>
                                            <th style="color: black;" class="text-center">Updated_at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($item_specifications as $item_specification)
                                        <tr>
                                        <?php $count1=0;?>
                                        <?php $count2=0;?>
                                        <?php $count3=0;?>
                                        <?php $count4=0;?>

                                            <td class="text-center"><b>{{ $item_specification->item_code}}</b></td>
                                            <td class="text-center">
                                            @foreach ($item_specifications_2 as $item_specification_2)
                                            @if($item_specification_2->items_id == $item_specification->items_id)
                                            <b>{{ $item_specification_2->size}}</b>
                                            <?php $count1=$count1+1; if($count1 == 3){ echo"<br>"; $count1=0; }?>
                                            @endif
                                            @endforeach
                                            </td>
                                            <td class="text-center">
                                            @foreach ($item_specifications_2 as $item_specification_2)
                                            @if($item_specification_2->items_id == $item_specification->items_id)
                                            <b>{{ $item_specification_2->color}}</b>
                                            <?php $count2=$count2+1; if($count2 == 3){ echo"<br>"; $count2=0; }?>
                                            @endif
                                            @endforeach
                                            </td>
                                            <td class="text-center">
                                            @foreach ($item_specifications_2 as $item_specification_2)
                                            @if($item_specification_2->items_id == $item_specification->items_id)
                                            <b>{{ $item_specification_2->qty}}</b>
                                            <?php $count3=$count3+1; if($count3 == 3){ echo"<br>"; $count3=0; }?>
                                            @endif
                                            @endforeach
                                            </td>
                                            @foreach ($item_specifications_2 as $item_specification_2)
                                            @if($item_specification_2->items_id == $item_specification->items_id)
                                            <td class="text-center"><b>{{ $item_specification_2->created_at}}</b></td>
                                            @break
                                            @endif
                                            @endforeach
                                            @foreach ($item_specifications_2 as $item_specification_2)
                                            @if($item_specification_2->items_id == $item_specification->items_id)
                                            <td class="text-center"><b>{{ $item_specification_2->updated_at}}</b></td>
                                            @break
                                            @endif
                                            @endforeach
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
 @include('layouts.partial.footer')

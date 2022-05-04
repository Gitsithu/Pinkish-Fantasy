@include('layouts.partial.header')
 <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3>Log</h3>
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
                            <div class="table-responsive mb-4 mt-4">
                                <table class="multi-table table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="color: black;" class="text-center">Item_code</th>
                                            <th style="color: black;" class="text-centr">Old_size</th>
                                            <th style="color: black;" class="text-center">Size</th>
                                            <th style="color: black;" class="text-centr">Old_color</th>
                                            <th style="color: black;" class="text-center">Color</th>
                                            <th style="color: black;" class="text-centr">Old_quantity</th>
                                            <th style="color: black;" class="text-center">Quantity</th>
                                            <th style="color: black;" class="text-centr">Old_price</th>
                                            <th style="color: black;" class="text-center">Price</th>
                                            <th style="color: black;" class="text-centr">Old_remark</th>
                                            <th style="color: black;" class="text-center">Remark</th>
                                            <th style="color: black;" class="text-center">Created_by</th>
                                            <th style="color: black;" class="text-center">Created_at</th>
                                            <th style="color: black;" class="text-center">Updated_by</th>
                                            <th style="color: black;" class="text-center">Updated_at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($logs as $log)
                                        <tr>
                                            <td class="text-center">{{ $log->item_code}}</td>
                                            <td class="text-center">{{ $log->old_size}}</td>
                                            <td class="text-center">{{ $log->size}}</td>
                                            <td class="text-center">
                                            <div style="border:1px solid;height:20px;background-color:{{ $log->old_color }}">  </div>
                                            </td>
                                            <td class="text-center">
                                            <div style="border:1px solid;height:20px;background-color:{{ $log->color }}">  </div>
                                            </td>
                                            <td class="text-center">{{ $log->old_qty}}</td>
                                            <td class="text-center">{{ $log->qty}}</td>
                                            <td class="text-center">{{ $log->old_price}}</td>
                                            <td class="text-center">{{ $log->price}}</td>
                                            <td class="text-center">{{ $log->old_remark}}</td>
                                            <td class="text-center">{{ $log->remark}}</td>
                                            
                                             <td class="text-center">
                                            @foreach($users as $user)
                                            @if($log->created_by == $user->id)
                                            <b>{{ $user->name}}</b>
                                            @endif
                                            @endforeach
                                            </td>
                                            <td class="text-center">{{ $log->created_at}}</td>
                                            <td class="text-center">
                                            @foreach($users as $user)
                                            @if($log->updated_by == $user->id)
                                            <b>{{ $user->name}}</b>
                                            @endif
                                            @endforeach
                                            </td>
                                            <td class="text-center">{{ $log->updated_at}}</td>


                                        </tr>
                                      @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">Item_code</th>
                                            <th class="text-center">Old_size</th>
                                            <th class="text-center">Size</th>
                                            <th class="text-centr">Old_color</th>
                                            <th class="text-center">Color</th>
                                            <th class="text-centr">Old_quantity</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-centr">Old_price</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Created_by</th>
                                            <th class="text-center">Created_at</th>
                                            <th class="text-center">Updated_by</th>
                                            <th class="text-center">Updated_at</th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!--  END CONTENT AREA  -->
 @include('layouts.partial.footer')

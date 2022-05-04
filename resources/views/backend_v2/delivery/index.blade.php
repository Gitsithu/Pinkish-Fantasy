@include('layouts.partial.header')
 <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3>Delivery</h3>
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

                    <div class="col-md-12">
                    <a href="/admin/delivery/create" style="font-weight:bold;background-color:#f5a8ae!important;border:#f5a8ae!important;padding-top:10px;height:40px;" class="form-control btn btn-primary" id="btn_new">Set Up New Delivery</a>
                    </div>

                 
</div>
                <div class="row" id="cancel-row">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table class="multi-table table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="color: black;" class="text-center">Division</th>
                                            <th style="color: black;" class="text-center">Township</th>
                                            <th style="color: black;" class="text-center">Charges</th>
                                            <th style="color: black;" class="text-center">Created_at</th>
                                            <th style="color: black;" class="text-center">Updated_at</th>
                                            <th style="color: black;" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($deliveries as $delivery)
                                        <tr>
                                            <td class="text-center">
                                            @if($delivery->division == 1)
                                            <b>Yangon</b>
                                            @elseif($delivery->division == 2)
                                            <b>Mandalay</b>
                                            @else
                                            <b>Others</b>
                                            @endif
                                            
                                            </td>
                                            <td class="text-center"><b>{{ $delivery->township}}</b></td>
                                            <td class="text-center"><b>{{ $delivery->charges}}</b></td>
                                            <td class="text-center"><b>{{ $delivery->created_at}}</b></td>
                                            <td class="text-center"><b>{{ $delivery->updated_at}}</b></td>

                                             <?php
                                            $parameter = $delivery->id;
                                            $parameter= Crypt::encrypt($parameter);
                                            ?>
                                            <td class="text-center"><a onclick="return myFunction();" href="/admin/delivery/edit/{{ $parameter }}" class="btn btn-info" style="background-color:#f5a8ae!important;border:#f5a8ae!important;">Edit</a>
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
            function myFunction() {
                if(!confirm("Are You Sure to update this ?"))
                event.preventDefault();
            }
        </script>

 @include('layouts.partial.footer')

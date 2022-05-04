@include('layouts.partial.header')
 <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3>Promo Code</h3>
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

                 <div class="col-md-12">
                 <a href="/admin/promocode/create" style="font-weight:bold;background-color:#f5a8ae!important;border:#f5a8ae!important;padding-top:10px;height:40px;" class="form-control btn btn-primary"  id="btn_new">Create New Promo Code</a>
                 </div>

              
                </div>
                <div class="row" id="cancel-row">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table class="multi-table table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="color: black;">Promo Code</th>
                                            <th style="color: black;" class="text-center">Start_date</th>
                                            <th style="color: black;" class="text-center">End_date</th>
                                            <th style="color: black;" class="text-center">User_limit</th>
                                            <th style="color: black;" class="text-center">Percentage</th>
                                            <th style="color: black;" class="text-center">Amount</th>
                                            <th style="color: black;" class="text-center">Status</th>
                                            <th style="color: black;" class="text-center">Created_by</th>
                                            <th style="color: black;" class="text-center">Updated_by</th>
                                            <th style="color: black;" class="text-center">Created_at</th>
                                            <th style="color: black;" class="text-center">Updated_at</th>
                                            <th style="color: black;" class="text-center">Action</th>
                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($promo_codes as $promo_code)
                                        <tr>
                                            <td><b>{{ $promo_code->code}}</b></td>
                                            <td><b>{{ $promo_code->start_date}}</b></td>
                                            <td><b>{{ $promo_code->end_date}}</b></td>
                                            <td class="text-center"><b>{{ $promo_code->user_limit}}</b></td>
                                            <td class="text-center"><b>
                                            @if($promo_code->promo_percent != null)
                                            {{ $promo_code->promo_percent}}%
                                            @endif
                                            </b></td>
                                            <td class="text-center"><b>{{ $promo_code->promo_amount}}</b></td>
                                            
                                            <td>
                                            @if($promo_code->status == 1)
                                                <div class="t-dot bg-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active"></div>
                                            @else
                                                <div class="t-dot bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="In-active"></div>
                                            @endif
                                            </td>
                                            <td class="text-center">
                                            @foreach($users as $user)
                                            @if($promo_code->created_by == $user->id)
                                            <b>{{ $user->name}}</b>
                                            @endif
                                            @endforeach
                                            </td>
                                             <td class="text-center">
                                            @foreach($users as $user)
                                            @if($promo_code->updated_by == $user->id)
                                            <b>{{ $user->name}}</b>
                                            @endif
                                            @endforeach
                                            </td>
                                            <td class="text-center"><b>{{ $promo_code->created_at}}</b></td>
                                            <td class="text-center"><b>{{ $promo_code->updated_at}}</b></td>

                                            <?php
                                            $parameter = $promo_code->id;
                                            $parameter= Crypt::encrypt($parameter);
                                            ?>

                                            <td class="text-center"><a onclick="return myFunction();" href="/admin/promocode/edit/{{ $parameter }}" class="btn btn-info" style="background-color:#f5a8ae!important;border:#f5a8ae!important;">Edit</a>
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

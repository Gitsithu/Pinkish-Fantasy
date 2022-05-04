@include('layouts.partial.header')
 <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3>Admin</h3>
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
                 <a href="/admin/user/create" style="font-weight:bold;background-color:#f5a8ae!important;border:#f5a8ae!important;padding-top:10px;height:40px;" class="form-control btn btn-primary"  id="btn_new">Create New Admin</a>
                 </div>

                </div>
                <div class="row" id="cancel-row">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table class="multi-table table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="color: black;">Name</th>
                                            <th style="color: black;" class="text-center">Email</th>
                                            <th style="color: black;" class="text-center">Image</th>
                                            <th style="color: black;" class="text-center">Phone</th>
                                            <th style="color: black;" class="text-center">Address</th>
                                            <th style="color: black;" class="text-center">Status</th>
                                            <th style="color: black;" class="text-center">Created_at</th>
                                            <th style="color: black;" class="text-center">Updated_at</th>
                                            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            <th style="color: black;" class="text-center">Action</th>
                                            @endif

                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($users as $user)
                                        <tr>
                                            <td><b>{{ $user->name}}</b></td>
                                            <td class="text-center"><b>{{ $user->email}}</b></td>
                                            <td class="text-center"><img src="{{ $user->avatar }}" class="img-fluid" style="width:50px; height:50px;" /></td>
                                            <td class="text-center"><b>{{ $user->phone}}</b></td>
                                            <td class="text-center"><b>{{ $user->address}}</b></td>
                                            <td>
                                                @if($user->status == 1)
                                                    <div class="t-dot bg-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active"></div>
                                                @else
                                                    <div class="t-dot bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="In-active"></div>
                                                @endif
                                            </td>
                                            <td class="text-center"><b>{{ $user->created_at}}</b></td>
                                            <td class="text-center"><b>{{ $user->updated_at}}</b></td>
                                            <?php
                                            $parameter = $user->id;
                                            $parameter= Crypt::encrypt($parameter);
                                            ?>
                                            @if($user->status == 1)

                                            <td class="text-center"><a onclick="return myFunction();" href="/admin/user/deactivate/{{ $parameter }}" class="btn btn-danger">Deactivate</a>
                                            </td>
                                            @endif



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
        if(!confirm("Are You Sure to deactivate this ?"))
        event.preventDefault();
    }
</script>
 @include('layouts.partial.footer')

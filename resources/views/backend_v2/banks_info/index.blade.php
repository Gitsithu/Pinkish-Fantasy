@include('layouts.partial.header')
 <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="page-header">
                    <div class="page-title">
                        <h3>Bank Information</h3>
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
                        <a href="/admin/banks_info/create" style="font-weight:bold;background-color:#f5a8ae!important;border:#f5a8ae!important;padding-top:10px;height:40px;" class="form-control btn btn-primary"  id="btn_new">Create New Bank Information</a>
                        </div>
                    <div class="col-md-2">
                        <a href="/admin/banks_info/inactive" style="padding-top:10px;height:40px;" class="form-control btn btn-danger" id="btn_new">View Inactive</a>
                    </div>
                </div>
                <div class="row" id="cancel-row">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table class="multi-table table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="color: black;" class="text-center">Bank Name</th>
                                            <th style="color: black;" class="text-center">Account Name</th>
                                            <th style="color: black;" class="text-center">Account Number</th>
                                            <th style="color: black;" class="text-center">Status</th>
                                            <th style="color: black;" class="text-center">Created_by</th>
                                            <th style="color: black;" class="text-center">Updated_by</th>
                                            <th style="color: black;" class="text-center">Created_at</th>
                                            <th style="color: black;" class="text-center">Updated_at</th>
                                            <th style="color: black;" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($banks_info as $bank)
                                        <tr>
                                            <td class="text-center"><b>{{ $bank->bank}}</b></td>
                                            <td class="text-center"><b>{{ $bank->account_name}}</b></td>
                                            <td class="text-center"><b>{{ $bank->account_no}}</b></td>
                                            <td>
                                                @if($bank->status == 1)
                                                    <div class="t-dot bg-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active"></div>
                                                @else
                                                    <div class="t-dot bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="In-active"></div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @foreach($users as $user)
                                                    @if($bank->created_by == $user->id)
                                                        <b>{{ $user->name}}</b>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                @foreach($users as $user)
                                                    @if($bank->updated_by == $user->id)
                                                        <b>{{ $user->name}}</b>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center"><b>{{ $bank->created_at}}</b></td>
                                            <td class="text-center"><b>{{ $bank->updated_at}}</b></td>
                                            <?php
                                                $parameter = $bank->id;
                                                $parameter= Crypt::encrypt($parameter);
                                            ?>
                                            <td class="text-center">
                                                <a onclick="return myFunction();" href="/admin/banks_info/edit/{{ $parameter }}" class="btn btn-info" style="background-color:#f5a8ae!important;border:#f5a8ae!important;">
                                                    Edit
                                                </a>
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

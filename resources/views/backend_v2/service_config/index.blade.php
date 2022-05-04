@include('layouts.partial.header')
 <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="page-header">
                    <div class="page-title">
                        <h3>Home Page Service Tab Configuration</h3>
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
                    <div class="col-md-2 offset-md-10">
                        <a href="/admin/service/inactive" style="padding-top:10px;height:40px;" class="form-control btn btn-danger"  id="btn_new">View Inactive</a>
                    </div>
                </div>
                <div class="row" id="cancel-row">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table class="multi-table table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="color: black;" class="text-center">Code</th>
                                            <th style="color: black;" class="text-center">Type</th>
                                            <th style="color: black;" class="text-center">Title</th>
                                            <th style="color: black;" class="text-center">Description</th>
                                            <th style="color: black;" class="text-center">Status</th>
                                            <th style="color: black;" class="text-center">Created_by</th>
                                            <th style="color: black;" class="text-center">Updated_by</th>
                                            <th style="color: black;" class="text-center">Created_at</th>
                                            <th style="color: black;" class="text-center">Updated_at</th>
                                            <th style="color: black;" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($service_config as $service)
                                        <tr>
                                            <td class="text-center"><b>{{ $service->id}}</b></td>
                                            <td class="text-center"><b>{{ $service->type}}</b></td>
                                            <td class="text-center"><b>{{ $service->title}}</b></td>
                                            <td class="text-center"><b>{{ $service->description}}</b></td>
                                            <td>
                                                @if($service->status == 1)
                                                    <div class="t-dot bg-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active"></div>
                                                @else
                                                    <div class="t-dot bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="In-active"></div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                            @foreach($users as $user)
                                            @if($service->created_by == $user->id)
                                            <b>{{ $user->name}}</b>
                                            @endif
                                            @endforeach
                                            </td>
                                            <td class="text-center">
                                            @foreach($users as $user)
                                            @if($service->updated_by == $user->id)
                                            <b>{{ $user->name}}</b>
                                            @endif
                                            @endforeach
                                            </td>
                                           
                                            <td class="text-center"><b>{{ $service->created_at}}</b></td>
                                            <td class="text-center"><b>{{ $service->updated_at}}</b></td>
                                            <?php
                                                $parameter = $service->id;
                                                $parameter= Crypt::encrypt($parameter);
                                            ?>
                                            <td class="text-center">
                                                <a onclick="return myFunction();" href="/admin/service/edit/{{ $parameter }}" class="btn btn-info" style="background-color:#f5a8ae!important;border:#f5a8ae!important;">
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

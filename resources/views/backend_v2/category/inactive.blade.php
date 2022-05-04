@include('layouts.partial.header')
 <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3>Category</h3>
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
                    <a href="/admin/category/create" style="font-weight:bold;background-color:#f5a8ae!important;border:#f5a8ae!important;padding-top:10px;height:40px;" class="form-control btn btn-primary"  id="btn_new">Create New Category</a>
                    </div>

                    <div class="col-md-2">
                    <a href="/admin/category" style="padding-top:10px;height:40px;" class="form-control btn btn-success"  id="btn_new">View Active</a>
                    </div>
                    <div class="col-md-2">
                <form method="post" action="/admin/category/activate">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">

                    <button type="submit" style="padding-top:10px;height:40px;" onclick="change()" class="form-control btn btn-info">Activate</button>
                </div>

                </div>
                <div class="row" id="cancel-row">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive">
                                <table class="multi-table table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="checkbox-column">
                                                <label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;">
                                                    <input type="checkbox" class="new-control-input todochkbox" id="todoAll">
                                                    <span class="new-control-indicator"></span>
                                                </label>
                                            </th>
                                            <th style="color: black;" class="text-center">Category Name</th>
                                            <th style="color: black;" class="text-center">Sub Category</th>
                                            <th style="color: black;" class="text-center">Status</th>
                                            <th style="color: black;" class="text-center">Created_by</th>
                                            <th style="color: black;" class="text-center">Updated_by</th>
                                            <th style="color: black;"class="text-center">Created_at</th>
                                            <th style="color: black;"class="text-center">Updated_at</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($categories as $category)
                                        <tr>
                                        <td>

                                            <label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;">
                                                <input type="checkbox" class="new-control-input todochkbox"  name="id[]" value="{{$category->id}}" id="todo-1">
                                                <span class="new-control-indicator"></span>

                                         </td>
                                            <td class="text-center"><b>{{ $category->name}}</b></td>
                                            <td class="text-center"><b>{{ $category->sub_category_name}}</b></td>
                                            <td>
                                            @if($category->status == 1)
                                                <div class="t-dot bg-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active"></div>
                                            @else
                                                <div class="t-dot bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="In-active"></div>
                                            @endif
                                            </td>
                                             <td class="text-center">
                                            @foreach($users as $user)
                                            @if($category->created_by == $user->id)
                                            <b>{{ $user->name}}</b>
                                            @endif
                                            @endforeach
                                            </td>
                                             <td class="text-center">
                                            @foreach($users as $user)
                                            @if($category->updated_by == $user->id)
                                            <b>{{ $user->name}}</b>
                                            @endif
                                            @endforeach
                                            </td>
                                            <td class="text-center"><b>{{ $category->created_at}}</b></td>
                                            <td class="text-center"><b>{{ $category->updated_at}}</b></td>




                                        </tr>
                                      @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>

                </div>
                </form>
            </div>
        </div>
        <!--  END CONTENT AREA  -->
        {{-- <script type="text/javascript">
  $(document).ready(function(){
    $('#select-all').click(function(){
      if(this.checked) {
        $(':checkbox').each(function(){
          this.checked = true;
        });
      }
      else {
        $(':checkbox').each(function(){
          this.checked = false;
        });
      }
    });
  });
</script> --}}
<script>
    checkall('todoAll', 'todochkbox');
    $('[data-toggle="tooltip"]').tooltip()
</script>
<script>
    function change(){

        var data = [];
    $("input[name='id[]']:checked").each(function() {
        data.push($(this).val());
    });

    var d = typeof(data);

                    //window.location = "/" + type + "/destroy/" + data;
                    //route path to do deletion in controller
                    $("#frm_pre").attr('action',"/admin/category/activate");
                    $("#frm_pre").attr('method', "POST");
                    $("#selected_checkboxes").val(data);
                    $("#frm_pre").submit();
                }


</script>

 @include('layouts.partial.footer')

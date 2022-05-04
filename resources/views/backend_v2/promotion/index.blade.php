@include('layouts.partial.header')
 <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3>Promotion</h3>
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

                 <div class="col-md-9">
                 <a href="/admin/promotion/create" style="font-weight:bold;background-color:#f5a8ae!important;border:#f5a8ae!important;padding-top:10px;height:40px;" class="form-control btn btn-primary"  id="btn_new">Create New Promotion</a>
                 </div>
                 <div class="col-md-3">

            <button type="button" onclick="change()" style="font-weight:bold;padding-top:10px;height:40px;" value="1" name="payment_status" class="form-control btn btn-danger" id="btn_2">Delete</button>
            <form action="" id="frm_pre">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">
            </div>
              
                </div>
                <div class="row" id="cancel-row">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table class="multi-table table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                        <th class="checkbox-column">
                                                <label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;">
                                                    <input type="checkbox" class="new-control-input todochkbox" id="todoAll">
                                                    <span class="new-control-indicator"></span>
                                                </label>
                                            </th>
                                            <th style="color: black;" class="text-center">Action</th>
                                            <th style="color: black;" class="text-center">Event Name</th>
                                            <th style="color: black;" class="text-center">Start_date</th>
                                            <th style="color: black;" class="text-center">End_date</th>
                                            <th style="color: black;" class="text-center">Percentage</th>
                                            <th style="color: black;" class="text-center">Amount</th>
                                            {{-- <th style="color: black;" class="text-center">Discount_Amount</th> --}}
                                            <th style="color: black;" class="text-center">Status</th>
                                            <th style="color: black;" class="text-center">Created_by</th>
                                            <th style="color: black;" class="text-center">Updated_by</th>
                                            <th style="color: black;" class="text-center">Created_at</th>
                                            <th style="color: black;" class="text-center">Updated_at</th>
                                            <th style="color: black;" class="text-center">Action</th>
                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($promotions as $promotion)
                                        <tr>
                                        <td>

<label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;">
    <input type="checkbox" class="new-control-input todochkbox"  name="id[]" value="{{$promotion->id}}" id="todo-1">
    <span class="new-control-indicator"></span>

</td>
                                            <td class="text-center">
                                               
                                                <?php
                                            $parameter = $promotion->id;
                                            $parameter= Crypt::encrypt($parameter);
                                            ?>


                                            <a href="/admin/promotion/detail/{{ $parameter }}"><i class="far fa-eye" style="margin-top:8px!important;color:#2195F1!important;" data-toggle="modal" data-target="#exampleModal2"data-placement="top" title="View Detail"></i></a>
                                            </td>
                                            <td><b>{{ $promotion->name}}</b></td>
                                            <td><b>{{ $promotion->start_date}}</b></td>
                                            <td><b>{{ $promotion->end_date}}</b></td>
                                            <td class="text-center"><b>
                                            @if($promotion->promo_percent != null)
                                            {{ $promotion->promo_percent}}%
                                            @endif
                                            </b></td>
                                            <td class="text-center"><b>{{ $promotion->promo_amount}}</b></td>

                                            <td>
                                            @if($promotion->status == 1)
                                                <div class="t-dot bg-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active"></div>
                                            @else
                                                <div class="t-dot bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="In-active"></div>
                                            @endif
                                            </td>
                                            <td class="text-center">
                                            @foreach($users as $user)
                                            @if($promotion->created_by == $user->id)
                                            <b>{{ $user->name}}</b>
                                            @endif
                                            @endforeach
                                            </td>
                                             <td class="text-center">
                                            @foreach($users as $user)
                                            @if($promotion->updated_by == $user->id)
                                            <b>{{ $user->name}}</b>
                                            @endif
                                            @endforeach
                                            </td>
                                            <td class="text-center"><b>{{ $promotion->created_at}}</b></td>
                                            <td class="text-center"><b>{{ $promotion->updated_at}}</b></td>



                                            <td class="text-center"><a onclick="return myFunction();" href="/admin/promotion/edit/{{ $parameter }}" class="btn btn-info" style="background-color:#f5a8ae!important;border:#f5a8ae!important;">Edit</a>
                                            </td>

                                           

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
<script>
    function myFunction() {
        if(!confirm("Are You Sure to update this ?"))
        event.preventDefault();
    }
</script>
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
                    $("#frm_pre").attr('action',"/admin/promotion/change");
                    $("#frm_pre").attr('method', "POST");
                    $("#selected_checkboxes").val(data);
                    $("#frm_pre").submit();
                }


$('a').click(function(){
    var m = $(this).attr('data-id');
    console.log(m);
    $("#o_id").val(m);
});
</script>

 @include('layouts.partial.footer')
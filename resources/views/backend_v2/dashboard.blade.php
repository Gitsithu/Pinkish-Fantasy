@include('layouts.partial.header');
 <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3>Dashboard</h3>
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

                <div class="row layout-top-spacing">

                                   <div class="col-md-3" style="margin-bottom:20px!important;">
                              <div class="widget widget-five">
    <div class="widget-content" >

        <div class="header">
            <div class="header-body">
                <h6>To Pre Order</h6>
                <p class="meta-date">{{$date}}</p>
            </div>
                   </div>

        <div class="w-content">
            <div class="">
                <p class="task-left" style="background-color:#E7515A!important;color:white;">{{$to_preorder_count}}</p>
                <p class="task-hight-priority"><span>{{$to_preorder_count}} Left</span></p>
            </div>
        </div>
    </div>
</div>
</div>

 <div class="col-md-3" style="margin-bottom:20px!important;">

                              <div class="widget widget-five">
    <div class="widget-content">

        <div class="header">
            <div class="header-body">
                <h6>Preordered</h6>
                <p class="meta-date">{{$date}}</p>
            </div>

        </div>
        <div class="w-content">
            <div class="">
                <p class="task-left" style="background-color:#E2A03F!important;color:white;">{{$preordered_count}}</p>
                <p class="task-completed" style="color:#E2A03F!important;"><span>{{$preordered_count}} Done</span></p>
            </div>
        </div>
    </div>
</div>
</div>

  <div class="col-md-3" style="margin-bottom:20px!important;">

                              <div class="widget widget-five">
    <div class="widget-content">

        <div class="header">
            <div class="header-body">
                <h6>Received Preorder</h6>
                <p class="meta-date">{{$date}}</p>
            </div>

        </div>
        <div class="w-content">
            <div class="">
                <p class="task-left" style="background-color:#2196F3!important;color:white;">{{$received_count}}</p>
                <p class="task-completed" style="color:#2196F3!important;"><span>{{$received_count}} received</span></p>
            </div>
        </div>
    </div>
</div>
</div>

  <div class="col-md-3" style="margin-bottom:20px!important;">

                              <div class="widget widget-five">
    <div class="widget-content">

        <div class="header">
            <div class="header-body">
                <h6>Delivered Order</h6>
                <p class="meta-date">{{$date}}</p>
            </div>
                   </div>
        <div class="w-content">
            <div class="">
                <p class="task-left" style="background-color:#8DBF42!important;color:white;" >{{$delivered_count}}</p>
                <p class="task-completed"><span>{{$delivered_count}} delivered</span></p>
            </div>
        </div>
    </div>
</div>
</div>

                            </div>
                            {{-- row end --}}
<div class="row layout-top-spacing">



  <div class="col-md-3" style="margin-bottom:20px!important;">

                              <div class="widget widget-five">
    <div class="widget-content">

        <div class="header">
            <div class="header-body">
                <h6>Pending Count</h6>
                <p class="meta-date">{{$date}}</p>
            </div>
                   </div>
        <div class="w-content">
            <div class="">
                <p class="task-left" style="background-color:#f5a8ae!important;color:white;" >{{$pending_count}}</p>
                <p class="task-completed" style="color:#f5a8ae;"><span>{{$pending_count}} Pending</span></p>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-md-3" style="margin-bottom:20px!important;">

    <div class="widget widget-five">
<div class="widget-content">

<div class="header">
<div class="header-body">
<h6>Customers</h6>
<p class="meta-date">{{$date}}</p>
</div>
</div>
<div class="w-content">
<div class="">
<p class="task-left" style="color:white;" >{{$users_count}}</p>
<p class="task-completed" style="color:grey;"><span>{{$users_count}} Customers</span></p>
</div>
</div>
</div>
</div>
</div>

                            </div>
                            {{-- row end --}}
                            {{-- <br>
                            <div class="row">
                            <div class="col-md-12 layout-spacing">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>





                        </div>
                    </div> --}}
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
//     window.onload = function () {

//  var chart = new CanvasJS.Chart("chartContainer", {
//      animationEnabled: true,
//      theme: "light2",
//      title: {
//          text: "Monthly Order Chart",
//          fontColor:"#f5a8ae",
//          padding:25
//      },
//      axisY: {
//          suffix: "",
//          scaleBreaks: {
//              autoCalculate: false,

//          }
//      },
//      data: [{
//          type: "column",
//          yValueFormatString: "#,##0.##",
//          dataPoints: <?php //echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
//      }]
//  });
//  chart.render();

//  }


</script>

 @include('layouts.partial.footer')

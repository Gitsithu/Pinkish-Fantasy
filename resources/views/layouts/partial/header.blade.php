<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $logo = DB::table('ui_config')->where([['status',1],['indexname','Logo']])->value('img_url');
    @endphp
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Pinkish Fantasy</title>
    <link rel="icon" type="image/x-icon" href="{{$logo}}"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="/backend/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/backend/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/backend/plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
    <link href="/backend/plugins/noUiSlider/nouislider.min.css" rel="stylesheet" type="text/css">
    <link href="/backend/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="/backend/plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
    <link href="/backend/plugins/noUiSlider/custom-nouiSlider.css" rel="stylesheet" type="text/css">
    <link href="/backend/plugins/bootstrap-range-Slider/bootstrap-slider.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/backend/plugins/dropify/dropify.min.css">
    <link href="/backend/assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/backend/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="/backend/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="/backend/plugins/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="/backend/plugins/table/datatable/custom_dt_custom.css">
    <link rel="stylesheet" type="text/css" href="/backend/plugins/table/datatable/custom_dt_multiple_tables.css">
    <link href="/backend/assets/css/apps/invoice.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/backend/plugins/select2/select2.min.css">
    <link href="/backend/assets/css/components/timeline/custom-timeline.css" rel="stylesheet" type="text/css" />
    <link href="/backend/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/backend/plugins/editors/markdown/simplemde.min.css">
    <link href="/backend/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/backend/plugins/jasny/css/jasny-bootstrap.css" media="all" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/backend/plugins/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/backend/plugins/bootstrap-select/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="/backend/assets/css/forms/theme-checkbox-radio.css">
    <link href="/backend/assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/backend/plugins/table/datatable/custom_dt_miscellaneous.css">
    <link href="/backend/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="/backend/assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="/backend/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link href="/backend/assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="/backend/plugins/apex/apexcharts.min.js"></script>
    <script src="/backend/assets/js/dashboard/dash_1.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <script src="/backend/plugins/table/datatable/custom_miscellaneous.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="/backend/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="/backend/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/backend/bootstrap/js/popper.min.js"></script>
    <script src="/backend/bootstrap/js/bootstrap.min.js"></script>
    <script src="/backend/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/backend/assets/js/app.js"></script>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->

    <script src="/backend/assets/js/scrollspyNav.js"></script>
    <script src="/backend/plugins/select2/select2.min.js"></script>
    <script src="/backend/plugins/select2/custom-select2.js"></script>
    <script src="/backend/plugins/bootstrap-select/bootstrap-select.min.js"></script>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->

    <script src="/backend/plugins/blockui/jquery.blockUI.min.js"></script>

    <script src="/backend/plugins/highlight/highlight.pack.js"></script>
    <script src="/backend/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/backend/assets/js/scrollspyNav.js"></script>
    <script src="/backend/plugins/file-upload/file-upload-with-preview.min.js"></script>

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="/backend/plugins/table/datatable/datatables.js"></script>
    <script>
        $(document).ready(function() {
            $('table.multi-table').DataTable({
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7,
                drawCallback: function () {
                    $('.t-dot').tooltip({ template: '<div class="tooltip status" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' })
                    $('.dataTables_wrapper table').removeClass('table-striped');
                }
            });
        } );
    </script>

    <script src="/backend/plugins/highlight/highlight.pack.js"></script>
    <script src="/backend/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->

    <script src="/backend/plugins/flatpickr/flatpickr.js"></script>
    <script src="/backend/plugins/noUiSlider/nouislider.min.js"></script>

    <script src="/backend/plugins/flatpickr/custom-flatpickr.js"></script>
    <script src="/backend/plugins/noUiSlider/custom-nouiSlider.js"></script>
    <script src="/backend/plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script>
    <script src="/backend/plugins/dropify/dropify.min.js"></script>
    <script src="/backend/plugins/tagInput/tags-input.js"></script>
    <script src="/backend/assets/js/users/account-settings.js"></script>
    <script src="/backend/assets/js/scrollspyNav.js"></script>
    <script src="/backend/plugins/select2/select2.min.js"></script>
    <script src="/backend/plugins/select2/custom-select2.js"></script>
       <script>
        // var e;
        var f4 = flatpickr(document.getElementById('timeFlatpick'), {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    defaultDate: "13:45"
});
       var f5 = flatpickr(document.getElementById('timeFlatpickr'), {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    defaultDate: "13:30"
});

        c1 = $('#style-1').DataTable({
            headerCallback:function(e, a, t, n, s) {
                e.getElementsByTagName("th")[0].innerHTML='<label class="new-control new-checkbox checkbox-outline-info m-auto">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
            },
            columnDefs:[ {
                targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
                    return'<label class="new-control new-checkbox checkbox-outline-info  m-auto">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                }
            }],
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 5
        });

        multiCheck(c1);

        c2 = $('#style-2').DataTable({
            headerCallback:function(e, a, t, n, s) {
                e.getElementsByTagName("th")[0].innerHTML='<label class="new-control new-checkbox checkbox-outline-info m-auto">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
            },
            columnDefs:[ {
                targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
                    return'<label class="new-control new-checkbox checkbox-outline-info  m-auto">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                }
            }],
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 5
        });

        multiCheck(c2);

        c3 = $('#style-3').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 5
        });

        multiCheck(c3);


    </script>

<script src="/backend/plugins/font-icons/feather/feather.min.js"></script>
<script type="text/javascript">
    feather.replace();
</script>
<script src="/backend/plugins/jasny/js/jasny-bootstrap.js"></script>
<script src="/backend/plugins/editors/markdown/simplemde.min.js"></script>
<link href="/backend/chosen_v1.8.7/chosen.css" rel="stylesheet">
     <link href="/backend/chosen_v1.8.7/chosen.min.css" rel="stylesheet">
     <script src="/backend/chosen_v1.8.7/chosen.jquery.min.js"></script>
     <script src="/backend/chosen_v1.8.7/chosen.proto.js"></script>


    <script src="/backend/dist/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="/backend/plugins/font-icons/fontawesome/css/regular.css">

    <link rel="stylesheet" href="/backend/plugins/font-icons/fontawesome/css/fontawesome.css">

    <style>
        .dropdown-item-inner span {
        
        font-weight:bold!important;
        color:black!important;
        }
        .main-content {
        font-family: Helvetica!important;
        }
        .menu span{
        text-transform: uppercase!important;
        }
        .submenu a{
        text-transform: uppercase!important;
        }
        .feather-icon .icon-section {
            padding: 30px;
        }
        .feather-icon .icon-section h4 {
            color: #3b3f5c;
            font-size: 17px;
            font-weight: 600;
            margin: 0;
            margin-bottom: 16px;
        }
        .feather-icon .icon-content-container {
            padding: 0 16px;
            width: 86%;
            margin: 0 auto;
            border: 1px solid #bfc9d4;
            border-radius: 6px;
        }
        .feather-icon .icon-section p.fs-text {
            padding-bottom: 30px;
            margin-bottom: 30px;
        }
        .feather-icon .icon-container { cursor: pointer; }
        .feather-icon .icon-container svg {
            color: #3b3f5c;
            margin-right: 6px;
            vertical-align: middle;
            width: 20px;
            height: 20px;
            fill: rgba(0, 23, 55, 0.08);
        }
        .feather-icon .icon-container:hover svg {
            color: #1b55e2;
            fill: rgba(27, 85, 226, 0.23921568627450981);
        }
        .feather-icon .icon-container span { display: none; }
        .feather-icon .icon-container:hover span { color: #1b55e2; }
        .feather-icon .icon-link {
            color: #1b55e2;
            font-weight: 600;
            font-size: 14px;
        }


        /*FAB*/
        .fontawesome .icon-section {
            padding: 30px;
        }
        .fontawesome .icon-section h4 {
            color: #3b3f5c;
            font-size: 17px;
            font-weight: 600;
            margin: 0;
            margin-bottom: 16px;
        }
        .fontawesome .icon-content-container {
            padding: 0 16px;
            width: 86%;
            margin: 0 auto;
            border: 1px solid #bfc9d4;
            border-radius: 6px;
        }
        .fontawesome .icon-section p.fs-text {
            padding-bottom: 30px;
            margin-bottom: 30px;
        }
        .fontawesome .icon-container { cursor: pointer; }
        .fontawesome .icon-container i {
            font-size: 20px;
            color: #3b3f5c;
            vertical-align: middle;
            margin-right: 10px;
        }
        .fontawesome .icon-container:hover i { color: #1b55e2; }
        .fontawesome .icon-container span { color: #888ea8; display: none; }
        .fontawesome .icon-container:hover span { color: #1b55e2; }
        .fontawesome .icon-link {
            color: #1b55e2;
            font-weight: 600;
            font-size: 14px;
        }
        .detail_img{
            margin-left:100px!important;
        }
        #row-margin-control{
            margin-left:100px!important;
        }
@media screen and (max-width:480px){
    .detail_img{
        margin-left:70px!important;
    }
    #row-margin-control{
            margin-left:15px!important;
            
        }
        #row-margin-control div{
            margin-bottom:10px!important;
        }
    #btn_2{
        font-size:10px;
        padding-top:5px!important;
        width:140px;
        float:right;
    }
    #btn_3{
        font-size:12px;
        font-family:'Nunito', sans-serif;
        font-weight: normal;
        padding:7px 20px!important;
        width:88px;
        height:38px;
        float:left;
    }
    #b_paid{
        float: right;
    }
    #width-control{
        width:50%!important;
    }
    .dy{
    width:130%!important;
}
  .dz{
    width:120%!important;
}
 .dx{
    width:100%!important;
}

}

/* For the Image Upload Div and Modal CSS - Start */
.error{ color:red!important;}

.image_remove_btn {
    width: 350px;
    height: 40px;
    font-weight: bold;
    color: #fff !important;
    text-decoration: none;
    background: rgba(168, 67, 67, 1);
}

.add_image_div,
.add_image_div1,
.add_image_div2,
.add_image_div3,
.add_image_div4,
.add_image_div5,
.add_image_div6,
.add_image_div7,
.add_image_div8,
.add_image_div9,
.add_image_div10 {
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    /* width: 350px;
    height: 150px; */
    width: 100%;
    height: 180px;
    border: 1px solid blue;
}


/*start modified design for file upload*/
.add_image_div,
.add_image_div1 {
    width: 100%;
    height: 180px;
}

.image_remove_btn {
    width: 100%;
    height: 40px;
}

.add_image_div_red,
.add_image_div_red1 {
    padding: 10px 2px 4px 2px;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    -o-border-radius: 5px;
    color: #fff;
    ;
    display: inline-block;
    -webkit-box-shadow: 0px 3px 0px 0px #862f30;
    -moz-box-shadow: 0px 3px 0px 0px #862f30;
    box-shadow: 0px 3px 0px 0px #862f30;
    font-weight: 700;
    font-size: 16px;
    overflow: auto;
    text-overflow: ellipsis;
    text-align: center;
    line-height: 15px;
    cursor: pointer;
    background-repeat: no-repeat;
}
.chosen-container-multi{
        width: 100%!important;
        }
#c_paid:hover{
    color:white!important;
}
#b_paid:hover{
    color:white!important;
}
#btn_3{
    margin-bottom: 5px;
    height:38px;
}
#sidebar ul.menu-categories li.menu > .dropdown-toggle:hover .bank {
    fill: #f5a8ae !important;
}

/*end modified design for file upload*/
</style>
</head>
<body class="alt-menu sidebar-noneoverflow">
    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm expand-header">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-item flex-row ml-auto">


                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                    </a>
                    <div class="dropdown-menu position-absolute e-animated e-fadeInUp" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                <img src="{{Auth::user()->avatar}}" class="img-fluid mr-2" alt="avatar">
                                <div class="media-body">

                                    <p>{{Auth::user()->name}}</p>

                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                        <?php
                        $parameter = Auth::user()->id;
                        $parameter= Crypt::encrypt($parameter);
                        ?>
                            <a href="/admin/user/edit/{{ $parameter }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span>My Profile</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                        <?php
                        $parameter = Auth::user()->id;
                        $parameter= Crypt::encrypt($parameter);
                        ?>
                            <a href="/admin/user/password/{{ $parameter }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> <span>Password Setting</span>
                            </a>
                        </div>


                        <div class="dropdown-item">
            <a class="dropdown-item" href="/admin/logout"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span>Log Out</span>
            </a>

            <form id="logout-form" action="/admin/logout" method="POST" style="display: none;">
                @csrf
            </form>



                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->
       <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container sidebar-closed sbar-open" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">

                <ul class="navbar-nav theme-brand flex-row  text-center">
                    <li class="nav-item theme-logo">
                        <a href="/admin" aria-expanded="true">
                            <img src="{{asset($logo)}}" class="navbar-logo" alt="logo">
                        </a>
                    </li>
                    <li class="nav-item theme-text">
                        <a href="/admin" class="nav-link" style="font-size:15px!important;"> PINKISH FANTASY </a>
                    </li>
                </ul>

                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu">
                        <a href="/admin" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>

                                <span>Dashboard</span>
                            </div>

                        </a>

                    </li>
                    <li class="menu">
                        <a href="#categories" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg><span>Manage Category</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="categories" data-parent="#accordionExample">
                            <li>
                                <a href="/admin/main_category">  Main Categories </a>
                            </li>
                            <li>
                                <a href="/admin/sub_category"> Sub Categories </a>
                            </li>
                            <li>
                                <a href="/admin/category">  Categories </a>
                            </li>
                        </ul>
                    </li>


                    <li class="menu">
                        <a href="/admin/create_order" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-gift"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>

                                <span>Create Order</span>
                            </div>
                        </a>
                    </li>


                    <li class="menu">
                        <a href="/admin/brand" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bold"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"></path><path d="M6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"></path></svg>
                                <span>Brands</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="#items" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg><span>Items</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="items" data-parent="#accordionExample">
                            <li>
                                <a href="/admin/item">  Items </a>
                            </li>
                            <li>
                                <a href="/admin/item_specification"> Items' Specifications </a>
                            </li>

                        </ul>
                    </li>

                    <li class="menu">
                        <a href="/admin/order" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-gift"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>

                                <span>Order</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="/admin/preorder" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-gift"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>

                                <span>Pre Order</span>
                            </div>
                        </a>
                    </li>



                    <li class="menu">
                        <a href="#costs" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg><span>Manage Cost</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="costs" data-parent="#accordionExample">
                            <li>
                                <a href="/admin/calculator">  Cost Calculator </a>
                            </li>
                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)

                            <li>
                                <a href="/admin/country"> Option </a>
                            </li>
                            <li>
                                <a href="/admin/profit"> Profit </a>
                            </li>
                        @endif

                        </ul>
                    </li>

                <li class="menu">
                        <a href="#promos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg><span>Manage Promo</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="promos" data-parent="#accordionExample">
                            <li>
                                <a href="/admin/promotion">Promotion </a>
                            </li>
                            <li>
                                <a href="/admin/promocode">Promo Code </a>
                            </li>
                             <li>
                                <a href="/admin/deli_promo">Delivery Promotion </a>
                            </li>
                           
                           

                        </ul>
                    </li>
                    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)

                    <li class="menu">
                        <a href="#report" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            <span>Report</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="report">
                            <li>
                                <a href="/admin/order_report">  Order Report </a>
                            </li>
                            <li>
                                <a href="/admin/instock_report">  Instock Report </a>
                            </li>

                        </ul>
                    </li>

                    <li class="menu">
                        <a href="/admin/log" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>

                                <span>Log</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="/admin/user" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Admin</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="/admin/customer" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Customer</span>
                            </div>
                        </a>
                    </li>
                    @endif
                    <li class="menu">
                        <a href="/admin/delivery" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                                <span>Delivery</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="#home_page_config" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                <span>Home Page Config</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="home_page_config" data-parent="#accordionExample">
                            <li>
                                <a href="/admin/ui">Image Config</a>
                            </li>
                            <li>
                                <a href="/admin/service">Service Config</a>
                            </li>
                            {{-- <li>
                                <a href="/admin/career">Career</a>
                            </li> --}}
                            <li>
                                <a href="/admin/contact_us">Contact Us</a>
                            </li>
                            <li>
                                <a href="/admin/about_us">About Us</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="/admin/banks_info" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bank" version="1.1" id="Capa_1" x="0px" y="0px" width="47.001px" height="47.001px" viewBox="0 0 47.001 47.001" style="fill: #0000006b;" xml:space="preserve">
                                <g>
                                    <g id="Layer_1_78_">
                                        <g>
                                            <path d="M44.845,42.718H2.136C0.956,42.718,0,43.674,0,44.855c0,1.179,0.956,2.135,2.136,2.135h42.708     c1.18,0,2.136-0.956,2.136-2.135C46.979,43.674,46.023,42.718,44.845,42.718z"/>
                                            <path d="M4.805,37.165c-1.18,0-2.136,0.956-2.136,2.136s0.956,2.137,2.136,2.137h37.37c1.18,0,2.136-0.957,2.136-2.137     s-0.956-2.136-2.136-2.136h-0.533V17.945h0.533c0.591,0,1.067-0.478,1.067-1.067s-0.478-1.067-1.067-1.067H4.805     c-0.59,0-1.067,0.478-1.067,1.067s0.478,1.067,1.067,1.067h0.534v19.219H4.805z M37.37,17.945v19.219h-6.406V17.945H37.37z      M26.692,17.945v19.219h-6.406V17.945H26.692z M9.609,17.945h6.406v19.219H9.609V17.945z"/>
                                            <path d="M2.136,13.891h42.708c0.007,0,0.015,0,0.021,0c1.181,0,2.136-0.956,2.136-2.136c0-0.938-0.604-1.733-1.443-2.021     l-21.19-9.535c-0.557-0.25-1.194-0.25-1.752,0L1.26,9.808c-0.919,0.414-1.424,1.412-1.212,2.396     C0.259,13.188,1.129,13.891,2.136,13.891z"/>
                                        </g>
                                    </g>
                                </g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                            </svg>

                                <span>Banks Information</span>
                            </div>
                        </a>
                    </li>
                </ul>

            </nav>

        </div>
        <!--  END SIDEBAR  -->

@yield('script')
<!DOCTYPE html>
<html lang="zxx">
<head>
    @php
        $logo = DB::table('ui_config')->where([['status',1],['indexname','Logo']])->value('img_url');
    @endphp
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Pinkish Fantasy')</title>
    <link rel="icon" type="image/x-icon" href="{{$logo}}"/>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link href="{{asset('customerSite/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('customerSite/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('customerSite/css/elegant-icons.css')}}" rel="stylesheet">
    <link href="{{asset('customerSite/css/jquery-ui.min.css')}}" rel="stylesheet">
    <link href="{{asset('customerSite/css/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{asset('customerSite/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('customerSite/css/slicknav.min.css')}}" rel="stylesheet">
    <link href="{{asset('customerSite/css/style.css')}}" rel="stylesheet">
    <style>
        .typeahead {
		/* position: relative; */
		width: 70%;
        top: 52% !important;
        margin-top: 22px;
		left: auto !important;
		max-height: 300px;
		overflow-y: auto;
    }

	.typeahead-item-img {
		height: 50px;
		width: 50px;
    }
    @media screen and (max-width:480px){
        .typeahead {
		/* position: relative; */
		width: 85%;
		top: 50% !important;
        }
    }
    @media only screen and (min-width: 767px) and (max-width: 991px) {
        .typeahead {
            margin-top: 5px;
        }
    }
    @media only screen and (max-width: 766px) {
        .typeahead {
            margin-top: 5px;
        }
    }
    </style>
</head>

<body>
    <!-- Page Preloder  -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include('frontEnd.layouts.header')
    @section('slider')
    @show
    @yield('content')

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form" method="post" action="/item_search" >
                <input type="hidden" name="_token" name="_token" value="{{ csrf_token() }}" />
                <input type="text" class="typeahead mt-0" id="typeahead" placeholder="Search here....." autocomplete="off" name="query">
                <button type="submit" class="site-btn btn-viewall search-button">Search</button>
                <p style="color:red;display:none;" id="no_result">There is no result</p>
            </form>
        </div>
    </div>
    <!-- Search End -->
    
    @include('frontEnd.layouts.footer')
    <script src="{{asset('customerSite/js/jquery-3.3.1.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

    <script src="{{asset('customerSite/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('customerSite/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('customerSite/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('customerSite/js/mixitup.min.js')}}"></script>
    <script src="{{asset('customerSite/js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('customerSite/js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('customerSite/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('customerSite/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('customerSite/js/main.js')}}"></script>
    <script>
        // function myFunction() {
        //     $("#frm_item").submit();
        // }

        $(document).ready(function() {
            count_item();
            var isuser = '{{ Auth::check() }}';
            if(isuser != 1) {
                localStorage.clear();
            }
        })
        
        function count_item(){
            var cart = localStorage.getItem('cart');
            if(cart) {
                var cartobj = JSON.parse(cart);
                var total_quantity = cartobj.itemlist.length;
                $(".cart_tip").html(total_quantity);
            }
        }

        var path = "{{ route('autocomplete_item') }}";
        $(document).ready(function() {

            // Or
            var typeahead = {
                typeaheadInit: function() {
                    var productNames = [];
                    $('.typeahead').typeahead({
                        source: function(query, process) {
                            return $.get(path, {
                                query: query
                            }, function(data) {
                                productNames = [];
                                if(data.length == 0){

                                document.getElementById('no_result').style.display = "block";

                                }
                                else{
                                document.getElementById('no_result').style.display = "none";
                                $.each(data, function(index, data) {
                                    productNames.push(data.id + "#" + data
                                        .name + "#" + data.image_url1 + "#" + data.item_code);
                                });
                            }
                                return process(productNames);
                            });
                        },

                        highlighter: function(args) {
                            var items = args.split('#');
                            html = '<img class="typeahead-item-img" src="' + items[2] + '">';
                            html += "<span> </span>" + items[1] + "(" + items[3] + ")";
                            return html;
                        },
                        updater: function(selectedName) {
                            var name = selectedName.split('#')[0];
                            return name;
                        },
                        afterSelect: function(selectedId) {
                            window.location = '/item-detail/' + selectedId;
                        }
                    });
                },

                initialize: function() {
                    var _this = this;
                    _this.typeaheadInit();
                }
            };
            typeahead.initialize();

        });

        function numbersOnly(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        // $(function() {
        //     var selected_value = 2;
        //     $(".calculate_select").val(selected_value);
        // })
    </script>
    @yield('javascript')
</body>
</html>

/*  ---------------------------------------------------
Template Name: Ashion
Description: Ashion ecommerce template
Author: Colorib
Author URI: https://colorlib.com/
Version: 1.0
Created: Colorib
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Product filter
        --------------------*/
        $('.filter__controls li').on('click', function () {
            $('.filter__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.property__gallery').length > 0) {
            var containerEl = document.querySelector('.property__gallery');
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Search Switch
    $('.search-switch').on('click', function () {
        $('.search-model').fadeIn(400);
    });

    $('.search-close-switch').on('click', function () {
        $('.search-model').fadeOut(400, function () {
            $('#search-input').val('');
        });
    });

    //Canvas Menu
    $(".canvas__open").on('click', function () {
        $(".offcanvas-menu-wrapper").addClass("active");
        $(".offcanvas-menu-overlay").addClass("active");
    });

    $(".offcanvas-menu-overlay, .offcanvas__close").on('click', function () {
        $(".offcanvas-menu-wrapper").removeClass("active");
        $(".offcanvas-menu-overlay").removeClass("active");
    });

    /*------------------
		Navigation
	--------------------*/
    $(".header__menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Accordin Active
    --------------------*/
    $('.collapse').on('shown.bs.collapse', function () {
        $(this).prev().addClass('active');
    });

    $('.collapse').on('hidden.bs.collapse', function () {
        $(this).prev().removeClass('active');
    });

    /*--------------------------
        Banner Slider
    ----------------------------*/
    $(".banner__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*--------------------------
        Product Details Slider
    ----------------------------*/
    $(".product__details__pic__slider").owlCarousel({
        loop: false,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<i class='arrow_carrot-left'></i>","<i class='arrow_carrot-right'></i>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false,
        mouseDrag: false,
        startPosition: 'URLHash'
    }).on('changed.owl.carousel', function(event) {
        var indexNum = event.item.index + 1;
        product_thumbs(indexNum);
    });

    function product_thumbs (num) {
        var thumbs = document.querySelectorAll('.product__thumb a');
        thumbs.forEach(function (e) {
            e.classList.remove("active");
            if(e.hash.split("-")[1] == num) {
                e.classList.add("active");
            }
        })
    }


    /*------------------
		Magnific
    --------------------*/
    $('.image-popup').magnificPopup({
        type: 'image'
    });


    $(".nice-scroll").niceScroll({
        cursorborder:"",
        cursorcolor:"#dddddd",
        boxzoom:false,
        cursorwidth: 5,
        background: 'rgba(0, 0, 0, 0.2)',
        cursorborderradius:50,
        horizrailenabled: false
    });

    /*------------------
        CountDown
    --------------------*/
    // For demo preview start
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    if(mm == 12) {
        mm = '01';
        yyyy = yyyy + 1;
    } else {
        mm = parseInt(mm) + 1;
        mm = String(mm).padStart(2, '0');
    }
    var timerdate = mm + '/' + dd + '/' + yyyy;
    // For demo preview end


    // Uncomment below and use your date //

    /* var timerdate = "2020/12/30" */

	$("#countdown-time").countdown(timerdate, function(event) {
        $(this).html(event.strftime("<div class='countdown__item'><span>%D</span> <p>Day</p> </div>" + "<div class='countdown__item'><span>%H</span> <p>Hour</p> </div>" + "<div class='countdown__item'><span>%M</span> <p>Min</p> </div>" + "<div class='countdown__item'><span>%S</span> <p>Sec</p> </div>"));
    });

    /*-------------------
		Range Slider
	---------------------*/
	var rangeSlider = $(".price-range"),
    minamount = $("#minamount"),
    maxamount = $("#maxamount"),
    minPrice = rangeSlider.data('min'),
    maxPrice = rangeSlider.data('max');
    rangeSlider.slider({
    range: true,
    min: minPrice,
    max: maxPrice,
    values: [minPrice, maxPrice],
    slide: function (event, ui) {
        minamount.val(ui.values[0]);
        maxamount.val(ui.values[1]);
        }
    });
    minamount.val(rangeSlider.slider("values", 0));
    maxamount.val(rangeSlider.slider("values", 1));

    /*------------------
		Single Product
	--------------------*/
	$('.product__thumb .pt').on('click', function(){
		var imgurl = $(this).data('imgbigurl');
		var bigImg = $('.product__big__img').attr('src');
		if(imgurl != bigImg) {
			$('.product__big__img').attr({src: imgurl});
		}
    });
    
    /*-------------------
		Quantity change
	---------------------*/
    var proQty = $('.pro-qty-UI');
	proQty.prepend('<span class="dec qtybtn">-</span>');
	proQty.append('<span class="inc qtybtn">+</span>');
	proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var maxValue = parseFloat($button.parent().find('input').attr('max'));
        var oldValue = parseFloat($button.parent().find('input').val());
		if ($button.hasClass('inc')) {
            // Don't allow incrementing above maximum value
            if (oldValue < maxValue) {
                var newVal = oldValue + 1;
            } else if (oldValue > maxValue) {
                newVal = maxValue;
            } else {
                newVal = oldValue;
            }
            $("#dynamicQtyInput").val(newVal);
		} else {
			// Don't allow decrementing below one
            if (oldValue > maxValue) {
                var newVal = maxValue;
            } else if (oldValue > 1) {
				newVal = oldValue - 1;
			} else {
				newVal = 1;
            }
            $("#dynamicQtyInput").val(newVal);
		}
		$button.parent().find('input').val(newVal);
    });
    
    /*-------------------
		Radio Btn
	--------------------- */
    $(".size__btn label").on('click', function () {
        $(".size__btn label").removeClass('active');
        $(this).addClass('active');
    });

    var count_size = $("#count_size").val();
    if (count_size != 1) {
        /*-------------------
            Item Colors
        ---------------------*/
        $('.idSize').click(function() {
            var SizeAttr = $(this).val();
            $("#dynamicSizeInput").val($(this).attr('id'));
            if(SizeAttr!=""){
                $.ajax({
                    type:'get',
                    url:'/get-item-color',
                    data:{size:SizeAttr},
                    success:function(resp){
                        var arr = resp.split(",");
                        var new_arr = [];
                        var empty = "";
                        for (let i = 0; i < arr.length; i++) {
                            if (arr[i] !== empty) {
                                new_arr.push(arr[i]);
                            }
                        }
                        for (let j = 0; j < new_arr.length; j++) {
                            var px = j*5;
                            var label = $("<label class=\"color\" for=\""+arr[j]+"\">");
                            var input = $("<input type=\"radio\" class=\"idColor\" name=\"color__radio\" id=\""+arr[j]+"\" value=\""+SizeAttr+"-"+arr[j]+"\">");
                            if (j == 0) {
                                var span = $("<span class=\"checkmark\" style=\"background:"+arr[j]+" !important;\"></span></label>");
                            } else {
                                var span = $("<span class=\"checkmark\" style=\"background:"+arr[j]+" !important; left: "+px+"px;\"></span></label>");
                            }
                            label.append(input);
                            label.append(span);
                            $(".checkbox2").append(label);
                        }
                        $("#checkbox2").show();
                    },error:function () {
                        alert("Error Select Size");
                    }
                });
            }
        })

        $(document).on("click", ".idColor", function () {
            var ColorAttr = $(this).val();
            $("#dynamicColorInput").val($(this).attr('id'));
            getSpecData(ColorAttr);
        })
    } else {
        var size = $(".idSize").attr('id');
        var SizeAttr = $(".idSize").val();
        $("#dynamicSizeInput").val(size);

        $(document).on("click", ".idColor", function () {
            var color =  $(this).attr('id');
            var ColorAttr = SizeAttr+'-'+color;
            $(this).val(ColorAttr);
            $("#dynamicColorInput").val(color);
            getSpecData(ColorAttr);
        })
    }

    /*-------------------
        Item Qty & Price
    ---------------------*/
    function getSpecData(ColorAttr) {
        var org_order_type = $("#org_order_type").val();
        if(ColorAttr!=""){
            $.ajax({
                type:'get',
                url:'/get-item-specs',
                data:{color:ColorAttr},
                success:function(resp){
                    var arr =  resp.split("/");
                    $("#dynamicItemSpec").val(arr[0]);
                    $("#dynamicQtyInput").val(1);
                    $("#inputStock").val(1); /*edit stock_qty->1 05/04 HH*/
                    if(arr[1] != 0 ) {
                        var out_of_stock = 1;
                    } else {
                        var out_of_stock = 0;
                    }
                    if (org_order_type == "Instock") {
                        if (out_of_stock != 0) {
                            $("#dynamicOrderType").val(0);
                            $("#dynamicInstockInput").val(arr[1]);
                            $("#availableStock").text("In Stock");
                            $(".inputStock").text(arr[1]);
                            $("#inputStock").attr('max',arr[1]);
                            // disabling quantity input and add to cart button on out of stock
                            $("#buttonAddToCart").removeAttr('disabled');
                            $("#buttonAddToCart").removeClass('disabled');
                            $('.pro-qty-UI').removeClass('disabled');
                            $(".dec").removeClass('not-clickable');
                            $('.customized_input_number').removeClass('disabled');
                            $('.customized_input_number').removeAttr('disabled');
                            $(".inc").removeClass('not-clickable');
                            // disabling quantity input and add to cart button on out of stock
                            $(".outofstock").addClass("hidden");
                        } else {
                            $("#availableStock").text("Out of Stock");
                            $(".inputStock").text(0);
                            // disabling quantity input and add to cart button on out of stock
                            $("#buttonAddToCart").attr('disabled','disabled');
                            $("#buttonAddToCart").addClass('disabled');
                            $('.pro-qty-UI').addClass('disabled');
                            $(".dec").addClass('not-clickable');
                            $('.customized_input_number').addClass('disabled');
                            $('.customized_input_number').attr('disabled','disabled');
                            $(".inc").addClass('not-clickable');
                            // disabling quantity input and add to cart button on out of stock
                            $(".outofstock").removeClass("hidden");
                        }
                    } else {
                        $("#dynamicOrderType").val(1);
                        $("#dynamicInstockInput").val(0);
                        $("#availableStock").text("Pre Order");
                        $("#inputStock").attr('max',30);
                        // disabling quantity input and add to cart button on out of stock
                        $("#buttonAddToCart").removeAttr('disabled');
                        $("#buttonAddToCart").removeClass('disabled');
                        $('.pro-qty-UI').removeClass('disabled');
                        $(".dec").removeClass('not-clickable');
                        $('.customized_input_number').removeClass('disabled');
                        $('.customized_input_number').removeAttr('disabled');
                        $(".inc").removeClass('not-clickable');
                        // disabling quantity input and add to cart button on out of stock
                        $(".outofstock").addClass("hidden");
                    }
                }
            });
        }
    }
    
    /*-------------------
    Exchange Rate Calculator
    ---------------------*/
    // $(document).on("click", ".calculate", function() {
    //     var country_id = $(".calculate_select").val();
    //     var price = $(".calculate_price").val();
    //     if(price != 0) {
                // $.ajax({
                //     type:'get',
                //     url:'/calculator',
                //     data:{country_id:country_id, price:price},
                //     success:function(resp){
                //         $(".calculate_result").val(resp);
                //     },error:function () {
                //         alert("Error Calculating Exchange Rate!")
                //     }
                // })
    //     } else {
    //         alert("Cannot Calculate without Items' Price!")
    //     }
    // })
})(jQuery);
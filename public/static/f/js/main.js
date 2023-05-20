/*  ---------------------------------------------------
    Template Name: Ogani
    Description:  Ogani eCommerce  HTML Template
    Author: Colorlib
    Author URI: https://colorlib.com
    Version: 1.0
    Created: Colorlib
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
            Gallery filter
        --------------------*/
        $('.featured__controls li').on('click', function () {
            $('.featured__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.featured__filter').length > 0) {
            var containerEl = document.querySelector('.featured__filter');
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

    //Humberger Menu
    $(".humberger__open").on('click', function () {
        $(".humberger__menu__wrapper").addClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").addClass("active");
        $("body").addClass("over_hid");
    });

    $(".humberger__menu__overlay").on('click', function () {
        $(".humberger__menu__wrapper").removeClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").removeClass("active");
        $("body").removeClass("over_hid");
    });

    /*------------------
        Navigation
    --------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    $('.dropdown a').click(function (e) { 
        e.preventDefault();
        if ($('.dropdown-menu').hasClass('active')) {
            $('.dropdown-menu').removeClass('active');
            $('.dropdown a').removeClass('active');
        }else{
            $(this).toggleClass('active');
            $(this).siblings('.dropdown-menu').toggleClass('active');
        }
        
    });


    $('.hero__slider').owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:1,
                nav:false,
            
            },
            1000:{
                items:1,
                nav:true,
                loop:false
            }
        }
    })

    /*-----------------------
        Categories Slider
    ------------------------*/
    $(".categories__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 6,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            0: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 3,
            },

            992: {
                items: 6,
            }
        }
    });


    $('.hero__categories__all').on('click', function () {
        $('.hero__categories .main__cats').slideToggle(400);
    });

    $('.main__cats .sub__cats').hide()
    $('.main__cats li').hover(function () {
        $('ul', this).stop(true, true).slideDown(200)
    }, function () {
        $('ul', this).stop(true, true).slideUp(200)
    }
    );

    /*--------------------------
        Latest Product Slider
    ----------------------------*/
    $(".latest-product__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*-----------------------------
        Product Discount Slider
    -------------------------------*/
    $(".product__discount__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 3,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            320: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 2,
            },

            992: {
                items: 3,
            }
        }
    });

    /*---------------------------------
        Product Details Pic Slider
    ----------------------------------*/
    $(".product__details__pic__slider").owlCarousel({
        loop: true,
        margin: 20,
        items: 4,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*-----------------------
        Price Range Slider
    ------------------------ */
    var rangeSlider = $(".price-range"),
        minamount = $("#minamount"),
        maxamount = $("#maxamount"),
        minPrice = rangeSlider.data('min'),
        maxPrice = rangeSlider.data('max');
    rangeSlider.slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minamount.attr('value') ? minamount.attr('value') : minPrice, maxamount.attr('value') ? maxamount.attr('value') : maxPrice],
        slide: function (event, ui) {
            minamount.val('$' + ui.values[0]);
            maxamount.val('$' + ui.values[1]);
        },
    });
    minamount.val('$' + rangeSlider.slider("values", 0));
    maxamount.val('$' + rangeSlider.slider("values", 1));

    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*------------------
        Single Product
    --------------------*/
    $('.product__details__pic__slider img').on('click', function () {

        var imgurl = $(this).data('imgbigurl');
        var bigImg = $('.product__details__pic__item--large').attr('src');
        if (imgurl != bigImg) {
            $('.product__details__pic__item--large').attr({
                src: imgurl
            });
        }
    });

    /*-------------------
        Quantity change
    --------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<button type="button" class="btn dec qtybtn">-</button>');
    proQty.append('<button type="button" class="btn inc qtybtn">+</button>');
    var valOfInp = $('.qtybtn', proQty).parent().find('input');
    for (const key in valOfInp) {
        if (Object.hasOwnProperty.call(valOfInp, key)) {
            const element = valOfInp[key];
            if (parseInt($(element).attr('value')) == parseInt($(element).attr('max'))) {
                $(element).siblings('button.inc').attr('disabled', true);
            }
        }
    }
    proQty.on('click', '.qtybtn', function () {
        $('.fa-shopping-bag').stop(true, true).effect('shake', {
            distance: 4,
        });
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
            if (newVal == parseInt($button.parent().find('input').attr('max'))) {
                $button.attr('disabled', true);
            }
            $('button[type="submit"]').attr('disabled', false);

        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
                $button.siblings('button.inc').attr('disabled', false)
                if (newVal == 0) {
                    $('button[type="submit"]').attr('disabled', true);
                }
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });

    if ($(window).width() <= 992) {
        $('.hero').addClass('hero-normal');
    }
    if (window.location.pathname === '/') {
        $(window).resize(function (e) { 
            if ($(window).width() <= 992) {
                $('.hero').addClass('hero-normal');
            }else{
                $('.hero').removeClass('hero-normal');
            }
        });
    }

    $('.product__details__tab ul li a').click(function (e) { 
        e.preventDefault();
        var tab_nav = $(this).data('target');
        $('.product__details__tab .tab-pane').slideUp();
        $(`.tab-pane#${tab_nav}`).slideDown();
        // .addClass('active');
                
    });
})(jQuery);
$(function() {
    'use strict';

    var $win = $(window);

    //Back to top
    $win.on('scroll', function() {
        // toggles the display of scroll to top button
        if ($(this).scrollTop() > 300) {
            $('.scrollup').fadeIn();

        } else {
            $('.scrollup').fadeOut();
        }
    });

    // scroll to top
    $('.scrollup').on("click", function() {
        $("html, body").animate({
            scrollTop: 0
        }, 1500);
        return false;
    });


    // filter option
    $('.sort-btn').on('click', function(e) {
        $('.fltr-optn-wrap').toggleClass("show");
        e.preventDefault();
    });

    //price range
    $('#slider-range').slider({
        range: true,
        min: 0,
        max: 300,
        values: [35, 219],
        slide: function(event, ui) {
            $('#amount').html("$" + ui.values[0] + " - $" + ui.values[1]);
            $('#amount1').val(ui.values[0]);
            $('#amount2').val(ui.values[1]);
        }
    });

    $('#amount').html("$" + $('#slider-range').slider("values", 0) +
        " - $" + $('#slider-range').slider("values", 1));

    //product gallery

    $('.pdt-gal1').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.pdt-thumb1',
        autoplay: false,
    });

    $('.pdt-thumb1').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.pdt-gal1',
        focusOnSelect: true,
        autoplay: true,
        vertical: true,
        verticalSwiping: true,
        arrows: false,
    });

    $('.pdt-gal2').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.pdt-thumb2',
        autoplay: false,
    });

    $('.pdt-thumb2').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.pdt-gal2',
        focusOnSelect: true,
        autoplay: true,
        infinite: true,
        centerMode: true,
        variableWidth: true,
        arrows: true
    });

    $('.product-slide2').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: true,
        responsive: [{
            breakpoint: 1200,
            settings: {
                slidesToShow: 4,
            }
        }, {
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
            }
        }, {
            breakpoint: 482,
            settings: {
                slidesToShow: 1,
                arrows: false,
            }
        }]
    });


     //increase quantity
    $('.qtyplus').on('click', function() {
        console.log("click");

        var $qty = $(this).closest('div').find('.qty');

        console.log($qty.val());
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal)) {
            $qty.val(currentVal + 1);
            console.log($qty.val());
            $qty.trigger("change");
        }


    });

    //decrease quantity
    $('.qtyminus').on('click', function() {
        var $qty = $(this).closest('div').find('.qty');
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal) && currentVal > 0) {
            $qty.val(currentVal - 1);
            $qty.trigger("change");
        }
    });

    // accordion
    $(".help-accordion").accordion({
        heightStyle: "content"
    });

    // newletter
    //$('#newsletter').modal('show')

    // full screen search
    $('.search-tigger').on('click', function(e) {
        $('.full-sreen-search').toggleClass("expand");
        e.preventDefault();
    });

    $('.screen-close').on('click', function(e) {
        $('.full-sreen-search').removeClass("expand");
        e.preventDefault();
    });

    // full screen menu
    $('.nav-trigger').on('click', function(e) {
        e.preventDefault();
        $('.menu').toggleClass("off").toggleClass("on");
    });

    // full screen menu
    $('.close-trigger').on('click', function(e) {
        e.preventDefault();
        $('.menu').toggleClass("off").toggleClass("on");
    });

    //countdown

    var
        $countWrap = $('.cont-wrap');
    if ($countWrap.length) {
        var endDate = new Date($countWrap.data("end-date"));
        $countWrap.countdown({
            date: endDate,
            render: function(data) {
                $(this.el).html(
                    '<div class="countdown-timer"><span class="time">DAYS</span> <span class="no counts">' + this.leadingZeros(data.days, 2) + '</span></div>' +
                    '<div class="countdown-timer"><span class="time">HOURS</span> <span class="no counts">' + this.leadingZeros(data.hours, 2) + '</span></div>' +
                    '<div class="countdown-timer"><span class="time">MINUTES</span> <span class="no counts">' + this.leadingZeros(data.min, 2) + '</span></div>' +
                    '<div class="countdown-timer"><span class="time">SEC</span> <span class="no counts">' + this.leadingZeros(data.sec, 2) + '</span></div>'
                );
            }
        });
    }

    //countdown

    var
        $countWrap2 = $('.cont-wrap2');
    if ($countWrap2.length) {
        var endDate = new Date($countWrap2.data("end-date"));
        $countWrap2.countdown({
            date: endDate,
            render: function(data) {
                $(this.el).html(
                    '<div class="countdown-timer"><span class="time">HOURS</span> <span class="no counts">' + this.leadingZeros(data.hours, 2) + '</span></div>' +
                    '<div class="countdown-timer"><span class="time">MINUTES</span> <span class="no counts">' + this.leadingZeros(data.min, 2) + '</span></div>' +
                    '<div class="countdown-timer"><span class="time">SEC</span> <span class="no counts">' + this.leadingZeros(data.sec, 2) + '</span></div>'
                );
            }
        });
    }

    //countdown

    var
        $countWrap3 = $('.cont-wrap3');
    if ($countWrap3.length) {
        var endDate = new Date($countWrap3.data("end-date"));
        $countWrap3.countdown({
            date: endDate,
            render: function(data) {
                $(this.el).html(
                    '<div class="countdown-timer"><span class="time">HOURS</span> <span class="no counts">' + this.leadingZeros(data.hours, 2) + '</span></div>' +
                    '<div class="countdown-timer"><span class="time">MINUTES</span> <span class="no counts">' + this.leadingZeros(data.min, 2) + '</span></div>' +
                    '<div class="countdown-timer"><span class="time">SEC</span> <span class="no counts">' + this.leadingZeros(data.sec, 2) + '</span></div>'
                );
            }
        });
    }

    // Counter
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });



    var winWidth = $win.width();

    if (winWidth < 768) {
        $('.first-menu .menu-wrap').find('.menu-list').hide();
        $('.header-2 .nav.navbar-nav li.menu-item-has-children').find('.sub-menu').hide();
        $('.header-2 .nav.navbar-nav li.menu-item-has-children.mega-menu').find('.mega-wrap').hide();
        $('.header-2 .nav.navbar-nav li.menu-item-has-children.mega-menu .mega-wrap').find('.menu-list').hide();

        $('.first-menu .menu-wrap').on('click', function() {
            $(this).find('.menu-list').slideToggle();
        });

         $('.header-2 .nav.navbar-nav li.menu-item-has-children>a').on('click', function(event) {
            event.preventDefault();
            $(this).next().slideToggle();
        });

        $('.header-2 .nav.navbar-nav li.menu-item-has-children.mega-menu .mega-wrap .megamenu-title').on('click', function(event) {
            event.preventDefault();
            $(this).next().slideToggle();
        });

    }


    if (winWidth < 992) {
        $('.header-1.menu-vertical .nav.navbar-nav li.menu-item-has-children').find('.sub-menu').hide();

        $('.header-1.menu-vertical .nav.navbar-nav li.menu-item-has-children>a').on('click', function(event) {
            event.preventDefault();
            $(this).next().slideToggle();
        });
    }

    // Tab to Accordian
    var $tabContent = $('.tab_content'),
        $tabHeading = $('.tab_drawer_heading'),
        $tabLi = $('ul.tabs li');

    $tabContent.hide();
    $(".tab_content:first").show();

    /* if in tab mode */
    $tabLi.on('click', function() {

        $tabContent.hide();
        var activeTab = $(this).attr("rel");
        $("#" + activeTab).fadeIn();

        $tabLi.removeClass("active");
        $(this).addClass("active");

        $tabHeading.removeClass("d_active");
        $(".tab_drawer_heading[rel^='" + activeTab + "']").addClass("d_active");
    });

    /* if in drawer mode */
    $tabHeading.on('click', function() {

        $tabContent.hide();
        var d_activeTab = $(this).attr("rel");
        $("#" + d_activeTab).fadeIn();

        $tabHeading.removeClass("d_active");
        $(this).addClass("d_active");

        $tabLi.removeClass("active");
        $("ul.tabs li[rel^='" + d_activeTab + "']").addClass("active");
    });


    /* Extra class "tab_last"
       to add border to right side
       of last tab */
    $tabLi.last().addClass("tab_last");

    // Subscribe Newsletter
    $('.notification-bar').find('.subscribe-newsletter-wrapper').hide();

    $('.notification-bar').find('.subscribe-newsletter-btn').on('click', function() {
        $('.notification-bar').find('.subscribe-newsletter-wrapper').slideToggle();
    });

    $('.notification-bar').find('.subscribe-newsletter-title span').on('click', function() {
        $('.notification-bar').find('.subscribe-newsletter-wrapper').slideToggle();
    });


    $('.banner-slide.v5').slick({
        arrows: false,
        autoplay: true,
        dots: true,
    });

    $('.banner-slide').slick({
        autoplay: true,
    });



});
$(document).ready(function() {
    $('#fullpage').fullpage({
        verticalCentered: false,

        //to avoid problems with css3 transforms and fixed elements in Chrome, as detailed here: https://github.com/alvarotrigo/fullPage.js/issues/208
        css3: false
    });
});

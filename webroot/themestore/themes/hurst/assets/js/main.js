(function ($) {
 "use strict";

/*----------------------------
	jQuery MeanMenu
------------------------------ */
	jQuery('nav#dropdown').meanmenu();
/*----------------------------
	wow js active
------------------------------ */
	new WOW().init();
 
/*----------------------------
	product-slider
------------------------------ */  
	$('.product-slider').slick({
		speed: 300,
		slidesToShow: 4,
		slidesToScroll: 1,
		prevArrow: '<button type="button" class="slick-prev">p<br />r<br />e<br />v</button>',
		nextArrow: '<button type="button" class="slick-next">n<br />e<br />x<br />t</button>',
		responsive: [
			{  breakpoint: 1169,  settings: { slidesToShow: 3,  }  },
			{  breakpoint: 969,   settings: { slidesToShow: 3,  }  },
			{  breakpoint: 767,   settings: { slidesToShow: 1, }   },
			{  breakpoint: 480,   settings: { slidesToShow: 1, }   },
		]
	}); 

/*----------------------------
	discount-product-slider
------------------------------ */  
	$('.discount-product-slider').slick({
		autoplay: false,
		arrows: false,
		dots: true,
		speed: 500,
		slidesToShow: 1,
		slidesToScroll: 1,
		responsive: [
			{  breakpoint: 1169,  settings: { slidesToShow: 1,  }  },
			{  breakpoint: 969,   settings: { slidesToShow: 1,  }  },
			{  breakpoint: 767,   settings: { slidesToShow: 1, }   },
		]
	});

/*----------------------------
	brand-slider
------------------------------ */  
	$('.brand-slider').slick({
		autoplay: false,
		arrows: false,
		dots: false,
		speed: 300,
		slidesToShow: 4,
		slidesToScroll: 1,
		responsive: [
			{  breakpoint: 1169,  settings: { slidesToShow: 4,  }  },
			{  breakpoint: 969,   settings: { slidesToShow: 3,  }  },
			{  breakpoint: 767,   settings: { slidesToShow: 2, }   },
			{  breakpoint: 480,   settings: { slidesToShow: 1, }   },
		]
	});

/*----------------------------
	single-pro-slider
------------------------------ */  
	 $('.slider-for').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: '.slider-nav'
	});
	$('.slider-nav').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		asNavFor: '.slider-for',
		dots: false,
		arrows: true,
		centerMode: false,
		responsive: [
			{  breakpoint: 480,   settings: { slidesToShow: 2, }   },
		],
		focusOnSelect: true,
		prevArrow: '<div class="single-pro-arrow arrow-left"><i class="zmdi zmdi-chevron-left"></i></div>',
		nextArrow: '<div class="single-pro-arrow arrow-right"><i class="zmdi zmdi-chevron-right"></i></div>',
	});	

/*---------------------
 Lightbox
--------------------- */	   
	$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox();
	});
	
/*----------------------------
	main-menu button
------------------------------ */
	$('.menu-toggle').on('click', function(){
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$('.main-menu').animate({left: '-225px'}, 500);
		}
		else{
			$(this).addClass('active');
			$('.main-menu').animate({left: '0'}, 500);
		}
	});
	
/*----------------------------
	search button
------------------------------ */
	$('.search-open').on('click', function(){
		$('.sidebar-search').removeClass('slideOutUp').addClass('slideInDown');
	});
	$('.close-search').on('click', function(){
		$('.sidebar-search').removeClass('slideInDown').addClass('slideOutUp');
	});
/*----------------------------
	Mega-menu Scroll
------------------------------ */
    $(".menu-scroll").niceScroll({cursorborder:"1px",cursorcolor:"#c87065",boxzoom:true}); // First scrollable DIV	
    $(".boxscrol2").niceScroll({cursorborder:"0px",cursorcolor:"#c87065",boxzoom:true}); // Second scrollable DIV	
	
/*----------------------
	sticky-menu
--------------------- */
    var sticky_menu = $("#sticky-menu");
    var pos = sticky_menu.position();
    if (sticky_menu.length) {
        var windowpos = sticky_menu.offset().top;
        $(window).on('scroll', function() {
            var windowpos = $(window).scrollTop();
            if (windowpos > pos.top) {
                sticky_menu.addClass("sticky");
            } else {
                sticky_menu.removeClass("sticky");
            }
        });
    }

/*--------------------------
	tooltip active jquery
---------------------------- */
	$('.product-action a').tooltip({
        container: 'body'
    });	
	
/*---------------------
	countdown
--------------------- */
	$('[data-countdown]').each(function() {
		var $this = $(this), finalDate = $(this).data('countdown');
		$this.countdown(finalDate, function(event) {
			$this.html(event.strftime('<span class="cdown days"><span class="time-count">%-D</span> <p>Days</p></span> <span class="cdown hour"><span class="time-count">%-H</span> <p>Hour</p></span> <span class="cdown minutes"><span class="time-count">%M</span> <p>Min</p></span>'));
		});
	});	
	
/*---------------------
	treeview
--------------------- */	
	$("#cat-treeview ul").treeview({
		animated: "normal",
		persist: "location",
		collapsed: true,
		unique: true,
	});
	
/*----------------------------
	price-slider active
------------------------------ */  
	$( "#slider-range" ).slider({
		range: true,
		min: 50,
		max: 2000,
		values: [ 0, 999 ],
		slide: function( event, ui ) {
			$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		}
	});
	$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
	" - $" + $( "#slider-range" ).slider( "values", 1 ) );  
	
/*----------------------------
	Cart Plus Minus Button
------------------------------ */
	$(".cart-plus-minus").prepend('<div class="dec qtybutton">-</div>');
	$(".cart-plus-minus").append('<div class="inc qtybutton">+</div>');
	$(".qtybutton").on("click", function() {
		var $button = $(this);
		var oldValue = $button.parent().find("input").val();
		if ($button.text() == "+") {
			var newVal = parseFloat(oldValue) + 1;
		} 
		else {
			// Don't allow decrementing below zero
			if (oldValue > 0) {
				var newVal = parseFloat(oldValue) - 1;
			} 
			else {
				newVal = 0;
			}
		}
		$button.parent().find("input").val(newVal);
		$button.parent().find("input").change();
	});

/*-------------------------
	accordion toggle function
--------------------------*/
	$('.payment-accordion').find('.payment-accordion-toggle').on('click', function(){
		//Expand or collapse this panel
		$(this).next().slideToggle(500);
		//Hide the other panels
		$(".payment-content").not($(this).next()).slideUp(500);
	});
/* -------------------------------------------------------
	accordion active class for style
----------------------------------------------------------*/
	$('.payment-accordion-toggle').on('click', function(event) {
		$(this).siblings('.active').removeClass('active');
		$(this).addClass('active');
		event.preventDefault();
	}); 	   
/*--------------------------
	scrollUp
---------------------------- */	
	$.scrollUp({
		scrollText: '<i class="zmdi zmdi-triangle-up"></i>',
		easingType: 'linear',
		scrollSpeed: 900,
		animation: 'fade'
	}); 	   

/*--------------------------	
	shop page manu dropdown	
---------------------------- */	
	$('.dropdown .option-btn').on('click', function(){
		if($(this).siblings('.dropdown-menu').hasClass('active')){
			$(this).siblings('.dropdown-menu').removeClass('active').slideUp();
			$(this).removeClass('active');
		}
		else{
			$('.dropdown .dropdown-menu').removeClass('active').slideUp();
			$('.dropdown .option-btn').removeClass('active');
			$(this).addClass('active');
			$(this).siblings('.dropdown-menu').addClass('active').slideDown();
		}
	});



})(jQuery);
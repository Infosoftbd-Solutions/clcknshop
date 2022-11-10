<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <title> {{ fetch(title_for_layout) }} : {{store_name}}</title>
    <meta name="keywords" content="{{store_name}},ecommerce" />
    <meta name="description" content="{{store_name}} ecommerce ">
    <meta name="google-site-verification" content="GfVNgXDDfbNhDvWeErqK04MaO5WqoSt1yFwpZ-GXQW4" />
    <meta name="author" content="clcknshop">

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{cdn_root}}images/favicon.png" />

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Bilbo+Swash+Caps%7CDroid+Sans:400,700%7CLibre+Baskerville:400,400i%7CPermanent+Marker%7CCutive+Mono" rel="stylesheet">

    <!-- CSS LIBRARY -->
    <link rel="stylesheet" type="text/css" href="{{cdn_root}}css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{cdn_root}}css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{cdn_root}}css/jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="{{cdn_root}}css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" type="text/css" href="{{cdn_root}}css/font.css" />
    <link rel="stylesheet" type="text/css" href="{{cdn_root}}css/slick.css" />
    <link rel="stylesheet" type="text/css" href="{{cdn_root}}css/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="{{cdn_root}}css/jquery.fullpage.min.css" />

    <!-- Main css -->
    <link rel="stylesheet" type="text/css"  href="{{cdn_root}}css/style.css" />
    <link rel="stylesheet" type="text/css" href="{{cdn_root}}css/responsive.css" />

    <!-- color skin -->
    <link rel="stylesheet" type="text/css" href="{{cdn_root}}css/color-skin/default.css" />
    <style>
        .ck-review .fill{
            color: #ff4f2c !important;
        }
    </style>
</head>

<body>
	<div class="outer-wrapper">
	    <header class="header-1" data-spy="affix" data-offset-top="300">
	       <!-- <div class="top-bar outer-wrap bg-dark txt-white">
	            <div class="row">
	                <div class="col-md-6 col-sm-6">Free international Shipping on orders above 100$</div>
	                <div class="col-md-6 col-sm-6 text-right">
	                    <ul class="top-bar-menu">
	                        <li>Help <i class="fa fa-angle-down"></i></li>

	                        <li>USD <i class="fa fa-angle-down"></i>
	                            <ul>
	                                <li><a href="#">USD</a></li>
	                                <li><a href="#">EURO</a></li>
	                            </ul>
	                        </li>

	                        <li>ENG <i class="fa fa-angle-down"></i>
	                            <ul>
	                                <li><a href="#">ENG</a></li>
	                                <li><a href="#">SPANISH</a></li>
	                            </ul>
	                        </li>
	                    </ul>
	                </div>
	            </div>
	        </div>       -->

	        <div class="outer-wrap">
	            <div class="row">
	                 <div class="col-md-12 col-sm-12 col-xs-12 header-cover">
	                    <nav class="navbar navbar-default">
	                        <div class="navbar-header">
	                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	                                <span class="sr-only">Toggle navigation</span>
	                                <span class="icon-bar"></span>
	                                <span class="icon-bar"></span>
	                                <span class="icon-bar"></span>
	                            </button>

	                            <a class="navbar-brand" href="">
	                                <img src="{{Shop.logo()}}" alt="Logo">
	                                <!-- <span class="site-header">Faslush</span> -->
	                            </a>
	                        </div>
	                        <!-- Collect the nav links -->

	                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	                            <ul class="nav navbar-nav">
	                                <li >
		                                <a href="/">Home</a>
		                                <!--<ul class="sub-menu first">
		                                    <li><a href="">Home v1</a></li>
		                                    <li><a href="index-v2.html">Home v2</a></li>
		                                    <li><a href="index-v3.html">Home v3</a></li>
		                                    <li><a href="index-v4.html">Home v4</a></li>
		                                    <li><a href="index-v5.html">Home v5</a></li>
		                                </ul> -->
		                            </li>

		                            <li class="menu-item-has-children mega-menu">
		                                <a href="javascript:void(0)" class="sub-title">Home Textile</a>
		                                <div class="mega-wrap">
		                                 	<div class="row mb-0">
		                                 		<div class="col-xs-12 col-sm-4 col-md-4 menu-wrap-1">
		                                 			<figure class="mb-25">
		                                 				<img src="images/pic1.png" alt="">
		                                 			</figure>
		                                 			<h6 class="megamenu-title">Home Textile</h6>
		                                 			<ul class="menu-list">
		                                 				<li tpleach="Shop.asset_menu(home-textile)"><a href="/{{val->href}}">{{val->text}} </a></li>
		                                 			</ul>
		                                 		</div>

		                                 		<div class="col-xs-12 col-sm-4 col-md-4 menu-wrap-1">
		                                 			<figure class="mb-25">
		                                 				<img src="images/pic4.png" alt="">
		                                 			</figure>
		                                 			<h6 class="megamenu-title">Handbags</h6>
		                                 			<ul class="menu-list">
														<li tpleach="Shop.asset_menu(handbags)"><a href="/{{val->href}}">{{val->text}} </a></li>
		                                 			</ul>
		                                 		</div>

		                                 		<div class="col-xs-12 col-sm-4 col-md-4 menu-wrap-1">
		                                 			<figure class="mb-25">
		                                 				<img src="images/pic3.png" alt="">
		                                 			</figure>
		                                 			<h6 class="megamenu-title">Footwear</h6>
		                                 			<ul class="menu-list">
														<li tpleach="Shop.asset_menu(footwear)"><a href="/{{val->href}}">{{val->text}} </a></li>
		                                 			</ul>
		                                 		</div>
		                                 	</div>
		                                </div>
		                            </li>

	                                <li class="menu-item-has-children">
		                                <a href="javascript:void(0)">Adult</a>
		                                <ul class="sub-menu first">
											<li tpleach="Shop.asset_menu(adult)"><a href="/{{val->href}}">{{val->text}} </a></li>
		                                </ul>
		                            </li>

	                                <li class="menu-item-has-children">
		                                <a href="javascript:void(0)">Kids</a>
		                                <ul class="sub-menu first">
											<li tpleach="Shop.asset_menu(kids)"><a href="/{{val->href}}">{{val->text}} </a></li>
		                                </ul>
		                            </li>

	                                <li><a href="page/contact-us">Contact</a></li>
	                                <li><a href="page/about-us">About Company</a></li>
	                            </ul>
	                        </div>
	                        <!-- /.navbar-collapse -->
	                    </nav>

	                    <div class="header-nav-wrap">
	                        <ul class="header-nav">
	                            <li>
	                                <a href="#" class="search-tigger">
	                                    <span class="pe-7s-search icon"></span>
	                                </a>
	                            </li>
	                            <!--search-->

	                           <!-- <li>
	                                <a href="#">
	                                    <span class="pe-7s-like icon"></span>
	                                    <span class="count rounded-crcl">5</span>
	                                </a>
	                            </li>  -->
	                            <!--wish-->

	                            <li id="cart_ajax">
	                            </li>
	                            <!--wish-->

	                            <li>
	                                <a href="login">
	                                    <span class="pe-7s-unlock icon"></span>
	                                    <!-- <span class="pe-7s-lock icon"></span> -->
	                                </a>
	                            </li>
	                        </ul>
	                    </div>
	                    <!--header right-->
	                 </div>
	            </div>
	        </div>
	    </header>
	    <!--header-->
      <div class="full-sreen-search">
          <button class="screen-close rounded-crcl" type="button"> <i class="pe-7s-close"></i></button>

          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <form action="collection/all">
                  <input type="search" placeholder="Search here..." name="q">
                  <button type="submit"><i class="fa fa-search"></i></button>
                </form>
                <!--form-->
              </div>
            </div>
          </div>
        </div>


        <!--search -->
		{{ Flash.render() }}
		{{ content_for_layout }}

	    <footer class="footer2 bg-gray">
	        <div class="container">
	            <div class="footer-top">
	                <div class="row">
	                    <div class="col-md-5 col-sm-5 col-xs-12">
	                        <h4>Sign up to our newsletter for exclusive updates & discounts</h4>

	                        <div class="subscription">
	                        	<form action="#" tplform="newsletter">
	                        		<input type="text" placeholder="Your email address" name="email">
	                        		<button type="submit">Subscribe <i class="fa fa-long-arrow-right"></i></button>
	                        	</form>
	                        </div>
	                    </div>

	                    <div class="col-md-5 col-sm-6 col-xs-12 pull-right">
	                        <ul class="footer-menu">
	                            <li tpleach="Shop.asset_menu(footer-menu)"><a href="{{val->href}}">{{ val->text }}</a></li>

	                        </ul>
	                    </div>
	                    <!--menu-->
	                </div>
	            </div>
	            <!--footer top-->
	        </div>

	        <div class="footer-bottom bg-dark">
	        	<div class="container">
	                <div class="row">
	                    <div class="col-md-6 col-sm-6 col-xs-12 copyright">
	                        &copy;Copyright 2018 <strong>Faslush Inc.</strong> All rights reserved.
	                    </div>

	                    <div class="col-md-6 col-sm-6 col-xs-12">
	                        <ul class="social pull-right">
	                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
	                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
	                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
	                        </ul>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </footer>
	    <!--footer-->
	</div>
	<!--outer wrapper-->

	<!-- Modal -->
    <div class="modal fade" id="quick-view">
        <div class="modal-dialog quick-view" role="document">
            <div class="modal-content bg-gray">
                <button type="button" class="close rounded-crcl" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7 col-sm-12 col-xs-12 product-gallery">
                            <ul class="pdt-gallery pdt-gal2">
                                <li><img src="images/detail-page-var-img.jpg" alt=""></li>
                                <li><img src="images/detail-page-var-img.jpg" alt=""></li>
                                <li><img src="images/detail-page-var-img.jpg" alt=""></li>
                                <li><img src="images/detail-page-var-img.jpg" alt=""></li>
                                <li><img src="images/detail-page-var-img.jpg" alt=""></li>
                            </ul>

                            <div class="thumb-wrap">
                                <ul class="pdt-gallery-thumb pdt-thumb2">
                                    <li><img src="images/detail-page-var-img.jpg" alt=""> </li>
                                    <li><img src="images/detail-page-var-img.jpg" alt=""> </li>
                                    <li><img src="images/detail-page-var-img.jpg" alt=""> </li>
                                    <li><img src="images/detail-page-var-img.jpg" alt=""> </li>
                                    <li><img src="images/detail-page-var-img.jpg" alt=""> </li>
                                </ul>
                            </div>
                        </div>
                        <!--product gallery-->

                        <div class="col-md-5 col-sm-12 col-xs-12 summary">
                            <div class="product-rating mb-10">
                                <span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>

                                <span class="rating-review">(1 customer review)</span>
                            </div>
                            <!--rating-->

                            <h3 class="product_title">Alderia Woven-Jacquard Tulip Dress</h3>

                            <div class="aviliblity mb-10">Availability: <strong>In Stock</strong></div>
                            <!--avilibity-->

                            <div class="price">
                                <del>$1,675.00 </del> <ins>$1,595.00</ins>
                            </div>
                            <!--price-->

                            <hr>

                            <div class="item-desc mb-20">
                                Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            </div>

                            <form action="#" class="cart mb-30">
                                <table class="group_table">
                                    <tr>
                                        <td class="product-thumb">
                                            <figure><img src="images/detail-page-group-product.jpg" alt=""></figure>
                                        </td>

                                        <td class="item-label">
                                            <h6>Alderia Woven-Jacquard Tulip </h6>
                                            <del>$ 595.00</del>
                                            <ins>$ 300.00</ins>
                                        </td>

                                        <td class="item-price">
                                            <div class="quantity-wrap">
                                                <button type="button" class="qtyminus">-</button>
                                                <input type="number" name="quantity" value="0" class="qty">
                                                <button type="button" class="qtyplus">+</button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="product-thumb">
                                            <figure><img src="images/detail-page-group-product.jpg" alt=""></figure>
                                        </td>

                                        <td class="item-label">
                                            <h6>Alderia Woven-Jacquard Tulip </h6>
                                            <del>$ 595.00</del>
                                            <ins>$ 300.00</ins>
                                        </td>

                                        <td class="item-price">
                                            <div class="quantity-wrap">
                                                <button type="button" class="qtyminus">-</button>
                                                <input type="number" name="quantity" value="0" class="qty">
                                                <button type="button" class="qtyplus">+</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <!--grouped product-->

                                <button type="submit" class="button">Add to cart <i class="pe-7s-cart"></i> </button>

                                <a href="#" class="add_to_wishlist button-wish"> Add to Wishlist  <i class="fa fa-heart-o"></i></a>
                            </form>

                            <div class="product-share">
                                <strong>Share:</strong>
                                <ul class="social">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--model body-->
            </div>
        </div>
    </div>
    <!--quick view-->

    <div class="modal fade" id="newsletter">
        <div class="modal-dialog" role="document">
            <div class="modal-content newsletter">
                <div class="modal-body">
                   <div class="row">
                      <div class="col-sm-6 col-xs-12">
                          <figure><img src="images/newsletter-pop-up.jpg" alt=""></figure>
                      </div>

                      <div class="col-sm-6 col-xs-12">
                          <div class="content">
                               <button type="button" class="close rounded-crcl" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                               <h4>Signup to Newsletter</h4>
                               <div class="content-wrap">
                                   <p>
                                       Hey Folks! Join us today and get access to our latest discounts and offers as well as daily tips and tricks.
                                   </p>
                               </div>

                               <form action="#">
                                   <div class="form-group">
                                       <label>Email Address</label>
                                       <input type="text">
                                   </div>

                                   <div class="form-group">
                                       <button type="submit">
                                           Subscribe Now <i class="fa fa-angle-right"></i>
                                       </button>
                                   </div>
                               </form>
                          </div>
                      </div>
                   </div>
                </div>
                <!--modal body-->
            </div>
        </div>
    </div>
    <!--modal newsletter-->

    <!-- back to top-->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>

    <!-- Js libery -->
    <script src="{{cdn_root}}js/jquery-3.1.1.min.js"></script>
    <script src="{{cdn_root}}js/bootstrap.min.js"></script>
    <script src="{{cdn_root}}js/jquery-rate-picker.js"></script>
    <script src="{{cdn_root}}js/modernizr.js"></script>

    <!--jquery ui-->
    <script src="{{cdn_root}}js/jquery-ui.js"></script>
    <script src="{{cdn_root}}js/jquery-ui-touch-punch.js"></script>

    <!--jquery dl menu-->
    <script src="{{cdn_root}}js/jquery.dlmenu.js"></script>

    <!--parallax-->
    <script src="{{cdn_root}}js/parallax.min.js"></script>

    <!--Count Down-->
    <script src="{{cdn_root}}js/countdown.js"></script>

    <!--slider-->
    <script src="{{cdn_root}}js/slick.min.js"></script>

    <!-- Counter -->
    <script src="{{cdn_root}}js/jquery.counterup.min.js"></script>
    <script src="{{cdn_root}}js/jquery.waypoints.min.js"></script>

    <!-- Full page -->
    <script src="{{cdn_root}}js/jquery.fullpage.min.js"></script>
	{{ Html.script(frontend_common) }}
    <!--Costom js-->
    <script src="{{cdn_root}}js/main.js"></script>
<script>
$(document).ready(function() {
    let fill = '<i class="fa fa-star fill"></i>'
    let outline = '<i class="fa fa-star"></i>'

    $(".ck-review").each(function (index) {
        let rating = parseInt($(this).attr('review'));
        ratingHtml = '';
        for (i = 1; i<=5; i++){
            ratingHtml += (i <= rating) ? fill : outline;
        }
        $(this).html(ratingHtml);
    });


    $.ratePicker("#rating", {
        max :5,
        rgbOn:"#ff4f2c",
        rgbOff:"#2d2d2d",
        rgbSelection:"#ff4f2c"
    });





	$(".ck-remove").click(function() {
		$(this).closest(".ck-flash").remove();
	});

	setTimeout(function () {
        if($(".ck-flash").length > 0){
            $(".ck-flash").remove();
        }
    },3000);
  loadCart();
  $("#variant_id").change(function(){
               console.log($(this));

               console.log("selection option val",$(this).val());
               if($(this).val() == 0){
                   $('.availability').html("<span style='color:red'>Sold out</span>");

               }else {
                   var variantopj = JSON.parse($( "#variant_id option:selected").attr("data-opt"));
                   $('.product-price').text("{{ Formats.moneySymbol() }}" + variantopj.price);
                   if(variantopj.compare_price) $('.product-cprice').text("{{ Formats.moneySymbol() }}" + variantopj.compare_price);
                   $('.availability').html("In Stock");

               }

  });
});

</script>
</body>

</html>

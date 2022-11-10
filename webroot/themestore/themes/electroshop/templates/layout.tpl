<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>{{ fetch(title_for_layout) }} : {{store_name}}</title>

	<meta name="keywords" content="{{store_name}} ,ecommerce" />
	<meta name="description" content="{{store_name}} ecommerce">
	<meta name="author" content="Clcknshop.com">

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="{{cdn_root}}images/icons/favicon.ico">


	<script type="text/javascript">
		WebFontConfig = {
			google: { families: [ 'Open+Sans:300,400,600,700','Poppins:300,400,500,600,700,800', 'Playfair+Display:900' ] }
		};
		(function(d) {
			var wf = d.createElement('script'), s = d.scripts[0];
			wf.src = '{{ cdn_root }}js/webfont.js';
			wf.async = true;
			s.parentNode.insertBefore(wf, s);
		})(document);
	</script>

	<!-- Plugins CSS File -->
	<link rel="stylesheet" href="{{cdn_root}}css/bootstrap.min.css">

	<!-- Main CSS File -->
	<link rel="stylesheet" href="{{cdn_root}}css/style.min.css">
	<link rel="stylesheet" type="text/css" href="{{cdn_root}}vendor/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="{{cdn_root}}vendor/simple-line-icons/css/simple-line-icons.min.css">
	{{ Html.css(frontend_common.css)}}
	<link rel="stylesheet" href="{{cdn_root}}css/custom.css">


	<style>
		.main-nav>ul>li:last-child{
			float: right;
		}


	</style>
</head>
<body>
	<div class="page-wrapper">
		<header class="header">
			<div class="header-top bg-primary text-uppercase">
				<div class="container">
					<div class="header-left">

					</div><!-- End .header-left -->

					<div class="header-right header-dropdowns ml-0 ml-sm-auto">
						<p class="top-message mb-0 mr-lg-5 pr-3 d-none d-sm-block">Welcome To ClcknShop!</p>
						<div class="header-dropdown dropdown-expanded mr-3">
							<a href="#">Links</a>
							<div class="header-menu">
								<ul>
									<li tpleach="Shop.asset_menu(top-menubar)" set="topbar"><a href="{{topbar->href}}">{{ topbar->text }} </a></li>
								</ul>
							</div><!-- End .header-menu -->
						</div><!-- End .header-dropown -->

						<span class="separator"></span>

						<div class="social-icons">
							<a href="#" class="social-icon social-instagram icon-instagram" target="_blank"></a>
							<a href="#" class="social-icon social-twitter icon-twitter" target="_blank"></a>
							<a href="https://www.facebook.com/ClcknshopSolutions" class="social-icon social-facebook icon-facebook" target="_blank"></a>
						</div><!-- End .social-icons -->
					</div><!-- End .header-right -->
				</div><!-- End .container -->
			</div><!-- End .header-top -->

			<div class="header-middle text-dark">
				<div class="container">
					<div class="header-left col-lg-2 w-auto pl-0">
						<button class="mobile-menu-toggler mr-2" type="button">
							<i class="icon-menu"></i>
						</button>
						<a href="/" class="logo">
							<img src="{{Shop.logo()}}" alt="Clcknshop Logo" style="height: 44px !important;">
						</a>
					</div><!-- End .header-left -->

					<div class="header-right w-lg-max pl-2">
						<div class="header-search header-icon header-search-inline header-search-category w-lg-max mr-lg-4">
							<a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
							<form action="collection/all" method="get">
								<div class="header-search-wrapper">
									<input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>

									<button class="btn p-0 icon-search-3" type="submit"></button>
								</div><!-- End .header-search-wrapper -->
							</form>
						</div><!-- End .header-search -->

						<div class="header-contact d-none d-lg-flex align-items-center pr-xl-5 mr-3 ml-xl-5">
							<i class="icon-phone-2"></i>
							<h6 class="pt-1 line-height-1">Call us now<a href="tel:#" class="d-block text-dark ls-10 pt-1">01734936561</a></h6>
						</div><!-- End .header-contact -->

						<a href="/login" class="header-icon "><i class="icon-user-2"></i></a>

						<div class="dropdown cart-dropdown" id="cart_ajax">

						</div><!-- End .dropdown -->
					</div><!-- End .header-right -->
				</div><!-- End .container -->
			</div><!-- End .header-middle -->

			<div class="sticky-wrapper" style=""><div class="header-bottom sticky-header d-none d-lg-block" style="">
				<div class="container">
					<nav class="main-nav w-100">
						<ul class="menu sf-js-enabled sf-arrows" style="touch-action: pan-y;">
							<li tpleach="Shop.asset_menu(navbar-menu)" set="menu">
								<a href="{{menu->href}}">{{ menu->text }}</a>
								<ul style="display: none;" tplcheck="Shop.hasmenuchild($menu)" >
									<li tpleach="menu->children" set="submenu"><a href="{{submenu->href}}">{{submenu->text}}</a></li>
								</ul>
							</li>
						</ul>
					</nav>
				</div><!-- End .container -->
			</div></div>
		</header><!-- End .header -->

    {{ Flash.render() }}
    {{ content_for_layout }}

        	<footer class="footer bg-dark">
			<div class="footer-middle">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
							<div class="widget">
								<h4 class="widget-title">About Us</h4>
								<img src="images/Clcknshop_demo_footer-6.png" alt="Logo" class="m-b-3">
								<p class="m-b-4 pb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapibus lacus. Duis nec vestibulum magna, et dapibus lacus.</p>
								<a href="#" class="read-more text-white">read more...</a>
							</div><!-- End .widget -->
						</div><!-- End .col-lg-3 -->

						<div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
							<div class="widget mb-2">
								<h4 class="widget-title mb-1 pb-1">Contact Info</h4>
								<ul class="contact-info m-b-4">
									<li>
										<span class="contact-info-label">Address:</span>House no# 38, Street no # 01, Sector# 05,Uttara, Dhaka-1230,Bangladesh
									</li>
									<li>
										<span class="contact-info-label">Phone:</span><a href="tel:">+880 1734-936561</a>
									</li>
									<li>
										<span class="contact-info-label">Email:</span> <a href="mailto:mail@example.com">iftekhairul_alam@infosoftbd.com</a>
									</li>
									<li>
										<span class="contact-info-label">Working Days/Hours:</span>
										Sun - Tues / 9:00 AM - 8:00 PM
									</li>
								</ul>
								<div class="social-icons">
									<a href="https://www.facebook.com/ClcknshopSolutions" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
									<a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
									<a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank" title="Linkedin"></a>
								</div><!-- End .social-icons -->
							</div><!-- End .widget -->
						</div><!-- End .col-lg-3 -->

						<div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
							<div class="widget">
								<h4 class="widget-title pb-1">Customer Service</h4>
								<ul class="links">
									<li tpleach="Shop.asset_menu(footer-menu-customer-service)" set="menu">
										<a href="{{menu->href}}"> {{menu->text}} </a>
									</li>
								</ul>
							</div><!-- End .widget -->
						</div><!-- End .col-lg-3 -->

						<div class="col-lg-3 col-sm-6 pb-5 pb-sm-0">
							<div class="widget">
								<h4 class="widget-title">Popular Tags</h4>

								<div class="tagcloud">
									<a href="/collection/all?tag=samsung-smart-phone">Samsung</a>
									<a href="/collection/all?tag=vivo-smart-phone">VIVO</a>
									<a href="/collection/all?tag=oppo-smart-phone">OPPO</a>
									<a href="/collection/all?tag=xiaomi-smart-phone">Xiaomi</a>
									<a href="/collection/all?tag=Realme-smart-phone">Realme</a>
									<a href="/collection/all?tag=smart-tv">TV</a>
									<a href="/collection/all?tag=iphone">Iphone</a>
									<a href="/collection/all?tag=air-conditioner">AC</a>
									<a href="/collection/all?tag=one-plus-smart-phone">OnePlus</a>
									<a href="/collection/all?tag=infinix-smart-phone">Infinix</a>
									<a href="/collection/all?tag=motorola-smart-phone">Motorola</a>
									<a href="/collection/all?tag=huawei--smart-phone">Huawei</a>
								</div>
							</div><!-- End .widget -->
						</div><!-- End .col-lg-3 -->
					</div><!-- End .row -->
				</div><!-- End .container -->
			</div><!-- End .footer-middle -->

			<div class="container">
				<div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap">
					<p class="footer-copyright py-3 pr-4 mb-0">� Clcknshop eCommerce. 2021. All Rights Reserved</p>

					<img src="images/payments.png" alt="payment methods" class="footer-payments py-3">
				</div>
			</div><!-- End .container -->
		</footer><!-- End .footer -->
	</div><!-- End .page-wrapper -->

	<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

	<div class="mobile-menu-container">
		<div class="mobile-menu-wrapper">
			<span class="mobile-menu-close"><i class="icon-cancel"></i></span>
			<nav class="mobile-nav">
				<ul class="mobile-menu mb-3">
					<li class="active"><a href="">Home</a></li>
					<li>
						<a href="#" class="sf-with-ul">SmartPhone</a>
						<ul style="display: none;">
							<li><a href="collection/samsung-smart-phone">Samsung</a></li>
									<li><a href="collection/Realme-smart-phone">Realme</a></li>
									<li><a href="collection/oppo-smart-phone">Oppo</a></li>
									<li><a href="collection/vivo-smart-phone">Vivo</a></li>
									<li><a href="collection/xiaomi-smart-phone">Xiaomi</a></li>
									<li><a href="collection/infinix-smart-phone">Infinix</a></li>
									<li><a href="collection/motorola-smart-phone">Motorola</a></li>
									<li><a href="collection/huawei-smart-phone">Huawei</a></li>
									<li><a href="collection/iphone">Iphone</a></li>
									<li><a href="collection/one-plus-smart-phone">Oneplus</a></li>

						</ul>
					</li>
					<li>
						<a href="#" class="sf-with-ul">Featured Phone</a>
						<ul style="display: none;">
							<li><a href="collection/samsung">Samsung</a></li>
							<li><a href="collection/nokia">Nokia</a></li>

						</ul>
					</li>
					<li><a href="#">Special Offer!<span class="tip tip-hot">Hot!</span></a>
						<li><a href="collection/Realme-smart-phone">Realme</a></li>
					</li>
				</ul>

				<ul class="mobile-menu">
					<li><a href="track-order">Track Order </a></li>
					<li><a href="page/about-us">About Us</a></li>
					<li><a href="page/contact-us">Contact Us</a></li>
					<li><a href="category.html">Our Stores</a></li>
					<li><a href="blog.html">Blog</a></li>
					<li><a href="#">Help &amp; FAQs</a></li>
				</ul>
			</nav><!-- End .mobile-nav -->

			<div class="social-icons">
				<a href="https://www.facebook.com/ClcknshopSolution" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>
				<a href="#" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>
				<a href="#" class="social-icon" target="_blank"><i class="icon-instagram"></i></a>
			</div><!-- End .social-icons -->
		</div><!-- End .mobile-menu-wrapper -->
	</div><!-- End .mobile-menu-container -->


	<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

	<!-- Plugins JS File -->
	<script src="{{cdn_root}}js/jquery.min.js"></script>
	<script src="{{cdn_root}}js/bootstrap.bundle.min.js"></script>
	<script src="{{cdn_root}}js/plugins.min.js"></script>

	<!-- Main JS File -->
	<script src="{{cdn_root}}js/main.min.js"></script>
	<!-- common JS File -->
	{{ Html.script(frontend_common) }}
	<script>

        $(document).ready(function (e) {
            loadCart();

            if($("#ck-flash").length > 0){
                setTimeout(() => {
                    $(this).find('.mfp-close').click();
                },3000);
            }

            $(document).on('click', '.option_selected', function(e){
                var li = $(this).closest("ul").find('li');
                li.each(function (index) {
                    $(this).removeClass("active");
                })

                $(this).closest('li').addClass('active');
                event.preventDefault();
                $('#option_' + $(this).attr('data-name')).val($(this).attr('data-value'));
                $('#option_' + $(this).attr('data-name')).trigger('change');

            });

            $("#variant_id").change(function(){
                console.log($(this));
                $(this).addClass("d-none");
                console.log("selection option val",$(this).val());
                if($(this).val() == 0){
                    $('.add-cart').text("Sold out");
                }else {
                    var variantopj = JSON.parse($( "#variant_id option:selected").attr("data-opt"));
                    $('.product-price').text("{{ Formats.moneySymbol() }}" + variantopj.price);
                    $('.add-cart').text("Add To Cart");
                }

            });
        })
	</script>
	<!--additional JS here -->
	 <tpl tplvar="fetch(scriptbottom)" />
</body>
</html>

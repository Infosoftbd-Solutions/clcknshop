<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>{{ fetch(title_for_layout) }} : {{store_name}}</title>

	<meta name="keywords" content="{{store_name}} ,ecommerce" />
	<meta name="description" content="{{store_name}} ecommerce">
	<meta name="author" content="Clcknshop.com">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	<!-- Place favicon.ico in the root directory -->

	<!-- Google Font -->
	<link href='https://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">

	<!-- all css here -->
	<!-- bootstrap v3.3.6 css -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- animate css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- jquery-ui.min css -->
	<link rel="stylesheet" href="css/jquery-ui.min.css">
	<!-- meanmenu css -->
	<link rel="stylesheet" href="css/meanmenu.min.css">
	<!-- nivo-slider css -->
	<link rel="stylesheet" href="lib/css/nivo-slider.css">
	<link rel="stylesheet" href="lib/css/preview.css">
	<!-- slick css -->
	<link rel="stylesheet" href="css/slick.css">
	<link rel="stylesheet" href="css/starrr.css">
	<!-- lightbox css -->
	<link rel="stylesheet" href="css/lightbox.min.css">
	<!-- material-design-iconic-font css -->
	<link rel="stylesheet" href="css/material-design-iconic-font.css">
	<!-- All common css of theme -->
	<link rel="stylesheet" href="css/default.css">
	<!-- style css -->
	<link rel="stylesheet" href="css/style.css">
	<!-- shortcode css -->
	<link rel="stylesheet" href="css/shortcode.css">
	<!-- responsive css -->
	<link rel="stylesheet" href="css/responsive.css">
	<!-- modernizr css -->
	<script src="js/vendor/modernizr-2.8.3.min.js"></script>

	<style>
		#mini-cart-form .ph-item {
			height: 90px !important;
			direction: ltr;
			position: relative;
			display: flex;
			flex-wrap: wrap;
			padding: 20px 15px 15px;
			overflow: hidden;
			background-color: #fff;
			border: none;
			border-radius: 0;
		}
	</style>
</head>

<body>
	<!-- WRAPPER START -->
	<div class="wrapper">

		<!-- HEADER-AREA START -->
		<header id="sticky-menu" class="header" style="border-bottom: 1px solid #f2f2f2;">
			<div class="header-area">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-4 col-sm-offset-4 col-xs-7">
							<div class="logo text-center">
								<a href=""><img src="{{Shop.logo()}}" alt="" /></a>
							</div>
						</div>
						<div class="col-sm-4 col-xs-5">
							<div class="mini-cart text-right" id="cart_ajax">

							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- MAIN-MENU START -->
			<div class="menu-toggle hamburger hamburger--emphatic hidden-xs">
				<div class="hamburger-box">
					<div class="hamburger-inner"></div>
				</div>
			</div>
			<div class="main-menu  hidden-xs">
				<nav>
					<ul>

						<li tpleach="Shop.asset_menu(navbar-menu)" set="menu">
							<a href="{{menu->href}}">{{menu->text}}</a>

							<div tplcheck="Shop.hasmenuchild($menu)" class="mega-menu menu-scroll">
								<div class="table">
									<div class="table-cell">
										<div class="half-width" style="width : 100%  !important">
											<ul>
												<li tpleach="menu->children" set="smenu">
													<a href="{{smenu->href}}">{{smenu->text}}</a>
												</li>
											</ul>
										</div>
										<div class="pb-80"></div>
									</div>
								</div>
							</div>
						</li>


					</ul>
				</nav>
			</div>
			<!-- MAIN-MENU END -->
		</header>
		<!-- HEADER-AREA END -->
		<!-- Mobile-menu start -->
		<div class="mobile-menu-area">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-12 hidden-lg hidden-md hidden-sm">
						<div class="mobile-menu">
							<nav id="dropdown">
								<ul>
									<li><a href="#">home</a>
									</li>

									<li><a href="#">Shop</a>
										<ul>
											<li><a href="collection">henning koppel</a></li>
											<li><a href="collection">jehs + Laub</a></li>
											<li><a href="collection">vicke lindstrand</a></li>
											<li><a href="collection">don chadwick</a></li>
											<li><a href="collection">akiko kuwahata</a></li>
											<li><a href="collection">barbro berlin</a></li>
											<li><a href="collection">cecilia hall</a></li>
											<li><a href="collection">don chadwick</a></li>
										</ul>
									</li>
									<li><a href="cart">Cart</a></li>
									<li><a href="about.html">about us</a></li>
									<li><a href="contact.html">contact</a></li>
									<li><a href="login.html">Login</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Mobile-menu end -->


		<div id="content">
			{{ Flash.render() }}
			{{ content_for_layout }}
		</div>


		<!-- SUBSCRIVE-AREA START -->
		<div class="subscribe-area pt-80">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="subscribe">
							<form action="#" tplform="newsletter">
								<input type="text" placeholder="Enter your email address" required name="email" />
								<button class="submit-button submit-btn-2 button-one" data-text="subscribe" type="submit">subscribe</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- SUBSCRIVE-AREA END -->
		<!-- FOOTER START -->
		<footer>
			<!-- Footer-area start -->
			<div class="footer-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="single-footer">
								<h3 class="footer-title  title-border">Contact Us</h3>
								<ul class="footer-contact">
									<li><span>Address :</span>28 Green Tower, Street Name,<br>New York City, USA</li>
									<li><span>Cell-Phone :</span>012345 - 123456789</li>
									<li><span>Email :</span>your-email@gmail.com</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
							<div class="single-footer">
								<h3 class="footer-title  title-border">LINkS</h3>
								<ul class="footer-menu">
									<li tpleach="Shop.asset_menu(footer-menu)" set="menu">
										<a href="{{menu->href}}"><i class="zmdi zmdi-dot-circle"></i>{{menu->text}}</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 hidden-sm col-xs-12">
							<div class="single-footer">
								<h3 class="footer-title  title-border">your choice Products</h3>
								<div class="footer-product">
									<div class="row">
										<div class="col-sm-6 col-xs-12">
											<div class="footer-thumb">
												<a href="#"><img src="img/footer/1.jpg" alt="" /></a>
												<div class="footer-thumb-info">
													<p><a href="#">Furniture Product<br>Name</a></p>
													<h4 class="price-3">$ 60.00</h4>
												</div>
											</div>
										</div>
										<div class="col-sm-6 col-xs-12">
											<div class="footer-thumb">
												<a href="#"><img src="img/footer/1.jpg" alt="" /></a>
												<div class="footer-thumb-info">
													<p><a href="#">Furniture Product<br>Name</a></p>
													<h4 class="price-3">$ 60.00</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Footer-area end -->
			<!-- Copyright-area start -->
			<div class="copyright-area">
				<div class="container">
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<div class="copyright">
								<p class="mb-0">&copy; <a href=" http://themeforest.net/user/codecarnival#contact " target="_blank"> CodeCarnival </a> 2016. All Rights Reserved.</p>
							</div>
						</div>
						<div class="col-sm-6 col-xs-12">
							<div class="payment  text-right">
								<a href="#"><img src="img/payment/1.png" alt="" /></a>
								<a href="#"><img src="img/payment/2.png" alt="" /></a>
								<a href="#"><img src="img/payment/3.png" alt="" /></a>
								<a href="#"><img src="img/payment/4.png" alt="" /></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Copyright-area start -->
		</footer>
		<!-- FOOTER END -->
	</div>
	<!-- WRAPPER END -->

	<!-- QUICKVIEW PRODUCT -->
	<div id="quickview-wrapper">
		<!-- Modal -->
		<div class="modal fade" id="productModal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="modal-product">
							<div class="product-images">
								<div class="main-image images">
									<img id="qv-image" alt="#" src="img/product/quickview-photo.jpg" />
								</div>
							</div><!-- .product-images -->

							<div class="product-info">
								<h1 id="qv-title">Aenean eu tristique</h1>
								<div class="price-box-3">
									<hr />
									<div class="s-price-box">
										<span id="qv-price" class="new-price">$160.00</span>
										<span id="qv-compare-price" class="old-price">$190.00</span>
									</div>
									<hr />
								</div>
								<a href="" id="qv-link" class="see-all">See all features</a>
								<div class="quick-add-to-cart">

									<form method="POST" action="add_to_cart" tplform="add_to_cart" class="cart">
										<input type="hidden" name="product_id" id="qv-cart_product_id">
										<input type="hidden" value="0" name="variant_id" id="qv-cart_variant_id">
										<div class="numbers-row">
											<input type="number" id="french-hens" name="quantity" value="1">
										</div>
										<button class="single_add_to_cart_button" type="submit">Add to cart</button>
									</form>
								</div>
								<div id="qv-desciption" class="quick-desc">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero.
								</div>
								<div class="social-sharing">
									<div class="widget widget_socialsharing_widget">
										<h3 class="widget-title-modal">Share this product</h3>
										<ul class="social-icons">
											<li><a target="_blank" title="Google +" href="#" class="gplus social-icon"><i class="zmdi zmdi-google-plus"></i></a></li>
											<li><a target="_blank" title="Twitter" href="#" class="twitter social-icon"><i class="zmdi zmdi-twitter"></i></a></li>
											<li><a target="_blank" title="Facebook" href="#" class="facebook social-icon"><i class="zmdi zmdi-facebook"></i></a></li>
											<li><a target="_blank" title="LinkedIn" href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
										</ul>
									</div>
								</div>
							</div><!-- .product-info -->
						</div><!-- .modal-product -->
					</div><!-- .modal-body -->
				</div><!-- .modal-content -->
			</div><!-- .modal-dialog -->
		</div>
		<!-- END Modal -->
	</div>
	<!-- END QUICKVIEW PRODUCT -->

	<!-- all js here -->
	<!-- jquery latest version -->
	<script src="js/vendor/jquery-1.12.0.min.js"></script>
	<!-- bootstrap js -->
	<script src="js/bootstrap.min.js"></script>
	<!-- jquery.meanmenu js -->
	<script src="js/jquery.meanmenu.js"></script>
	<!-- slick.min js -->
	<script src="js/slick.min.js"></script>
	<!-- jquery.treeview js -->
	<script src="js/jquery.treeview.js"></script>
	<!-- lightbox.min js -->
	<script src="js/lightbox.min.js"></script>
	<!-- jquery-ui js -->
	<script src="js/jquery-ui.min.js"></script>
	<!-- jquery.nivo.slider js -->
	<script src="lib/js/jquery.nivo.slider.js"></script>
	<script src="lib/home.js"></script>
	<!-- jquery.nicescroll.min js -->
	<script src="js/jquery.nicescroll.min.js"></script>
	<!-- countdon.min js -->
	<script src="js/countdon.min.js"></script>
	<!-- wow js -->
	<script src="js/wow.min.js"></script>
	<!-- plugins js -->
	<script src="js/plugins.js"></script>
	<!-- main js -->
	<script src="js/starrr.js"></script>
	<script src="js/main.js"></script>
	<!-- Main JS File -->
	{{ Html.script(frontend_common) }}

	<script>
		$(document).ready(function(e) {

			loadCart();

			var fill = '<a href="#"><i class="zmdi zmdi-star"></i></a>';
			var outline = '<a href="#"><i class="zmdi zmdi-star-outline"></i></a>';

			$(".review").each(function(index) {
				var ratingHtml = '';
				var rating = $(this).attr('review');
				for (var i = 1; i <= 5; i++) {
					if (i <= parseInt(rating)) ratingHtml += fill;
					else ratingHtml += outline;
				}

				$(this).html(ratingHtml);
			});

			$(".ck-cartlink").click(function(e) {
				e.preventDefault();

				var href = $(this).attr('href');
				//console.log(href);
				$.ajax({
					url: href,
					type: 'GET',
					// dataType: 'json', // added data type
					success: function(response) {
						// $("#overlay").fadeOut(300);
						if (response.status == "success") {
							//renderCartItems(response.items)
							loadCart();
							//$('.show_cart').closest("li").trigger('mouseover');
							//console.log(	$('.show_cart').closest("li").text());

						}

					}
				});


			})



			$(".quick-view").click(function(e) {
				e.preventDefault();

				var product = $(this).closest('.single-product');
				var title = product.find('.ck-pro-title').text();
				var price = product.find('.ck-pro-price').text();
				var description = product.find('.ck-pro-description').html();
				var image = product.find('.ck-pro-image').attr('src');
				var link = product.find('.ck-link').attr('href');
				var pid = $(this).attr('ck-pro-id');

				$("#qv-title").text(title);
				$("#qv-price").text(price);
				$("#qv-desciption").html(description);
				$("#qv-image").attr('src', image);
				$("#qv-link").attr('href', link);
				$("#qv-compare-price").text('');
				$("#qv-cart_product_id").val(pid);


				$("#productModal").modal();
			});


			var cart_placeholder = '<div class="ph-item">'
			cart_placeholder += '<div class="ph-col-4">'
			cart_placeholder += '<div class="ph-picture"></div></div>'
			cart_placeholder += '<div><div class="ph-row">'
			cart_placeholder += '<div class="ph-col-12 big"></div>'
			cart_placeholder += '<div class="ph-col-8"></div>'
			cart_placeholder += '<div class="ph-col-6"></div>'
			cart_placeholder += '<div class="ph-col-4 empty"></div>'
			cart_placeholder += '<div class="ph-col-2"></div>'
			cart_placeholder += '</div></div></div>'




			$(".add-to-cart-form").click(function(e) {
				e.preventDefault();
				var formData = $(this).closest('form').serialize();
				$.ajax({
					url: window.location.protocol + '//' + window.location.host + '/add_to_cart',
					type: "POST",
					data: formData,
					success: function(response) {
						if (response.status == "success") {
							renderCartItems(response.items);
						}
					}
				});
			})

			$("#mini-cart-product").on("click", ".mini-cart-delete", function() {
				$(this).closest(".single-cart").remove();
				var formData = $("#mini-cart-form form").serialize();
				var pholder = cart_placeholder;

				for (var i = 1; i < $("#mini-cart-product .single-cart").length; i++) pholder += cart_placeholder;

				$("#mini-cart-product").html(pholder);
				$.ajax({
					url: window.location.protocol + '//' + window.location.host + '/cart',
					type: "POST",
					data: formData,
					success: function(response) {
						if (response.status == "success") {
							renderCartItems(response.items);
						}
					}
				});
			})




		});
	</script>

	<tpl tplvar="fetch(scriptbottom)" />
</body>

</html>

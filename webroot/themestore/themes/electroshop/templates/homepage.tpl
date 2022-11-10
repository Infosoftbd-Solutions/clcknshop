
		<main class="main">
			<div class="container mb-2">
				<div class="info-boxes-container row row-joined mt-2 mb-2 font2">
					<div class="info-box info-box-icon-left col-lg-4">
						<i class="icon-shipping"></i>

						<div class="info-box-content">
							<h4>FREE SHIPPING &amp; RETURN</h4>
							<p class="text-body">Free shipping on all orders over $99</p>
						</div><!-- End .info-box-content -->
					</div><!-- End .info-box -->

					<div class="info-box info-box-icon-left col-lg-4">
						<i class="icon-money"></i>

						<div class="info-box-content">
							<h4>MONEY BACK GUARANTEE</h4>
							<p class="text-body">100% money back guarantee</p>
						</div><!-- End .info-box-content -->
					</div><!-- End .info-box -->

					<div class="info-box info-box-icon-left col-lg-4">
						<i class="icon-support"></i>

						<div class="info-box-content">
							<h4>ONLINE SUPPORT 24/7</h4>
							<p class="text-body">Lorem ipsum dolor sit amet.</p>
						</div><!-- End .info-box-content -->
					</div><!-- End .info-box -->
				</div>

				<div class="row">
					<div class="col-lg-9">
						<div class="home-slider owl-carousel owl-theme owl-carousel-lazy mb-2" data-owl-options="{
							'loop': false,
							'dots': true,
							'nav': false
						}">
							<div class="home-slide home-slide1 banner banner-md-vw banner-sm-vw">
								<img class="owl-lazy slide-bg" src="images/lazy.png" data-src="{{ Shop.asset_image(slider-1) }}" alt="slider image">
								<!--<div class="banner-layer banner-layer-middle">
									<h4 class="text-white pb-4 mb-0">Find the Boundaries. Push Through!</h4>
									<h2 class="text-white mb-0">Summer Sale</h2>
									<h3 class="text-white text-uppercase m-b-3">70% Off</h3>
									<h5 class="text-white text-uppercase d-inline-block mb-0 ls-n-20 align-text-bottom">Starting At <b class="coupon-sale-text bg-secondary text-white d-inline-block">$<em class="align-text-top">199</em>99</b></h5>
									<a href="collection/all" class="btn btn-dark btn-md ls-10">Shop Now!</a>
								</div>--><!-- End .banner-layer -->
							</div><!-- End .home-slide -->

							<div class="home-slide home-slide2 banner banner-md-vw banner-sm-vw">
								<img class="owl-lazy slide-bg" src="images/lazy.png" data-src="{{ Shop.asset_image(slider-2) }}" alt="slider image">
								<!--<div class="banner-layer banner-layer-middle text-uppercase">
									<h4 class="m-b-2">Over 200 products with discounts</h4>
									<h2 class="m-b-3">Great Deals</h2>
									<h5 class="d-inline-block mb-0 align-top mr-5">Starting At <b>$<em>299</em>99</b></h5>
									<a href="collection/all" class="btn btn-dark btn-md ls-10">Get Yours!</a>
								</div>--><!-- End .banner-layer -->
							</div><!-- End .home-slide -->

							<div class="home-slide home-slide3 banner banner-md-vw banner-sm-vw">
								<img class="owl-lazy slide-bg" data-src="{{ Shop.asset_image(slider-3) }}"></img>
								<!--<div class="banner-layer banner-layer-middle text-uppercase">
									<h4 class="m-b-2">Up to 70% off</h4>
									<h2 class="m-b-3">New Arrivals</h2>
									<h5 class="d-inline-block mb-0 align-top mr-5">Starting At <b>$<em>299</em>99</b></h5>
									<a href="collection/all" class="btn btn-dark btn-md ls-10">Get Yours!</a>
								</div>--><!-- End .banner-layer -->
							</div><!-- End .home-slide -->
						</div><!-- End .home-slider -->
					</div><!-- End .col-lg-9 -->
					<div class="sidebar-overlay"></div>
					<div class="sidebar-toggle"><i class="fas fa-sliders-h"></i></div>
					<aside class="sidebar-home col-lg-3 order-lg-first mobile-sidebar">
						<div class="widget widget-banners px-5 pb-3 text-center">
							<div class="owl-carousel owl-theme">
								<div class="banner d-flex flex-column align-items-center">
									<h3 class="badge-sale bg-primary d-flex flex-column align-items-center justify-content-center text-uppercase"><em class="pt-3 ls-0">Sale</em>Many Item</h3>
									<h4 class="sale-text font1 text-uppercase m-b-3">45<sup>%</sup><sub>off</sub></h4>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									<a href="collection/all" class="btn btn-dark btn-md font1">View Sale</a>
								</div><!-- End .banner -->

								<div class="banner d-flex flex-column align-items-center">
									<h3 class="badge-sale bg-primary d-flex flex-column align-items-center justify-content-center text-uppercase"><em class="pt-3 ls-0">Sale</em>Many Item</h3>
									<h4 class="sale-text font1 text-uppercase m-b-3">55<sup>%</sup><sub>off</sub></h4>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									<a href="collection/all" class="btn btn-dark btn-md font1">View Sale</a>
								</div><!-- End .banner -->

								<div class="banner d-flex flex-column align-items-center">
									<h3 class="badge-sale bg-primary d-flex flex-column align-items-center justify-content-center text-uppercase"><em class="pt-3 ls-0">Sale</em>Many Item</h3>
									<h4 class="sale-text font1 text-uppercase m-b-3">65<sup>%</sup><sub>off</sub></h4>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									<a href="collection/all" class="btn btn-dark btn-md font1">View Sale</a>
								</div><!-- End .banner -->
							</div><!-- End .banner-slider -->
						</div><!-- End .widget -->
					</aside><!-- End .col-lg-3 -->
				</div><!-- End .row -->

				<div class="row">
					<div class="col-lg-12">
						<div class="banners-container m-b-2 owl-carousel owl-theme" data-owl-options="{
							'dots': false,
							'margin': 20,
							'loop': false,
							'responsive': {
								'480': {
									'items': 2
								},
								'768': {
									'items': 3
								}
							}
						}">
							<div class="banner banner1 banner-hover-shadow mb-2">
								<figure>
									<img src="{{Shop.asset_image(home-page-flash-image-1)}}" alt="banner">
								</figure>
								<div class="banner-layer banner-layer-middle">
									<h3 class="m-b-2">Casio Watches</h3>
									<h4 class="m-b-4 text-primary"><sup class="text-dark"><del>20%</del></sup>30%<sup>OFF</sup></h4>
									<a href="collection/all" class="text-dark text-uppercase ls-10">Shop Now</a>
								</div>
							</div><!-- End .banner -->
							<div class="banner banner2 text-uppercase banner-hover-shadow mb-2">
								<figure>
									<img src="{{Shop.asset_image(home-page-flash-image-2)}}" alt="banner">
								</figure>
								<div class="banner-layer banner-layer-middle text-center pt-2">
									<h3 class="m-b-1 ls-n-20">Deal Promos</h3>
									<h4 class="m-b-4 text-body">Starting at $99</h4>
									<a href="collection/all" class="text-dark text-uppercase ls-10">Shop Now</a>
								</div>
							</div><!-- End .banner -->
							<div class="banner banner3 banner-hover-shadow mb-2">
								<figure>
									<img src="{{Shop.asset_image(home-page-flash-image-3)}}" alt="banner">
								</figure>
								<div class="banner-layer banner-layer-middle text-right">
									<h3 class="m-b-2">Handbags</h3>
									<h4 class="mb-3 pb-1 text-secondary text-uppercase">Starting at $99</h4>
									<a href="collection/all" class="text-dark text-uppercase ls-10">Shop Now</a>
								</div>
							</div><!-- End .banner -->
						</div>

						<h2 class="section-title ls-n-10 m-b-4">New Arrival</h2>

						<div class="products-slider owl-carousel owl-theme dots-top m-b-1 pb-1">
							<div class="product-default inner-quickview inner-icon" tpleach="Shop.products(all, new_arrival:30, limit:12)" set="product">
								<figure>
									<a href="{{ product->link }}">
										<img src="" tplimage="product->imagepath" width="265" height="265">
									</a>
									<div class="label-group">
										<div class="product-label label-hot">New</div>
									</div>
									
								</figure>
								<div class="product-details" style="text-align: center">
									<div class="category-wrap">
										<div class="category-list">
											<a href="collection/all?product_type={{product->prouduct_type}}" class="product-category">{{ product->product_type }}</a>
										</div>
									</div>
									<h2 class="product-title">
										<a href="{{ product->link }}"> {{product->title}} </a>
									</h2>
									<div class="ratings-container">
										<div class="product-ratings">
											<span class="ratings" style="width:{{Formats.mul(20, $product->rating)}}%"></span><!-- End .ratings -->
											<span class="tooltiptext tooltip-top"></span>
										</div><!-- End .product-ratings -->
									</div><!-- End .product-container -->
									<div class="price-box">
										<span class="product-price">{{ Formats.moneyFormat($product->price) }}</span>
									</div><!-- End .price-box -->
								</div><!-- End .product-details -->
							</div>
						</div><!-- End .featured-proucts -->

						<hr class="mt-1">

						<h2 class="section-title ls-n-10 m-b-4">Special Offer Products</h2>

						<div class="products-slider owl-carousel owl-theme dots-top m-b-1 pb-1">
							<div class="product-default inner-quickview inner-icon" tpleach="Shop.products(special-offer, limit:12)" set="product">
								<figure>
									<a href="{{ product->link }}">
										<img src="" tplimage="product->imagepath" width="265" height="265">
									</a>
									<div class="label-group">
										<div class="product-label label-hot">Offer</div>
									</div>
									
								</figure>
								<div class="product-details" style="text-align: center">
									<div class="category-wrap">
										<div class="category-list">
											<a href="collection/all?product_type={{product->prouduct_type}}" class="product-category">{{ product->product_type }}</a>
										</div>
									</div>
									<h2 class="product-title">
										<a href="{{ product->link }}"> {{product->title}} </a>
									</h2>


									<div class="ratings-container">
										<div class="product-ratings">
											<span class="ratings" style="width:{{Formats.mul(20, $product->rating)}}%"></span><!-- End .ratings -->
											<span class="tooltiptext tooltip-top"></span>
										</div><!-- End .product-ratings -->
									</div><!-- End .product-container -->
									<div class="price-box">
										<span class="old-price">{{ Formats.moneyFormat($product->compare_price)}}</span>
										<span class="product-price">{{ Formats.moneyFormat($product->price)}}</span>
									</div><!-- End .price-box -->
								</div><!-- End .product-details -->
							</div>
						</div><!-- End .featured-proucts -->


						<hr class="mt-1">

						<h2 class="section-title ls-n-10 m-b-4">Top Ratted Products</h2>

						<div class="products-slider owl-carousel owl-theme dots-top m-b-1 pb-1">
							<div class="product-default inner-quickview inner-icon" tpleach="Shop.products(all,top-ratted, limit:12)" set="product">
								<figure>
									<a href="{{ product->link }}">
										<img src="" tplimage="product->imagepath" width="265" height="265">
									</a>
									<div class="label-group">
										<div class="product-label label-hot">Offer</div>
									</div>
									
								</figure>
								<div class="product-details" style="text-align: center">
									<div class="category-wrap">
										<div class="category-list">
											<a href="collection/all?product_type={{product->prouduct_type}}" class="product-category">{{ product->product_type }}</a>
										</div>
									</div>
									<h2 class="product-title">
										<a href="{{ product->link }}"> {{product->title}} </a>
									</h2>


									<div class="ratings-container">
										<div class="product-ratings">
											<span class="ratings" style="width:{{Formats.mul(20, $product->rating)}}%"></span><!-- End .ratings -->
											<span class="tooltiptext tooltip-top"></span>
										</div><!-- End .product-ratings -->
									</div><!-- End .product-container -->
									<div class="price-box">
										<span class="old-price">{{ Formats.moneyFormat($product->compare_price)}}</span>
										<span class="product-price">{{ Formats.moneyFormat($product->price)}}</span>
									</div><!-- End .price-box -->
								</div><!-- End .product-details -->
							</div>
						</div><!-- End .featured-proucts -->


						<hr class="mt-1 mb-4">

						<div class="feature-boxes-container">
							<div class="row">
								<div class="col-md-4">
									<div class="feature-box px-sm-3 feature-box-simple text-center">
										<i class="icon-earphones-alt"></i>

										<div class="feature-box-content">
											<h3 class="m-b-1">Customer Support</h3>
											<h5 class="m-b-3">Need Assistance?</h5>

											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapib.</p>
										</div><!-- End .feature-box-content -->
									</div><!-- End .feature-box -->
								</div><!-- End .col-md-4 -->

								<div class="col-md-4">
									<div class="feature-box px-sm-3 feature-box-simple text-center">
										<i class="icon-credit-card"></i>

										<div class="feature-box-content">
											<h3 class="m-b-1">Secured Payment</h3>
											<h5 class="m-b-3">Safe & Fast</h5>

											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapib.</p>
										</div><!-- End .feature-box-content -->
									</div><!-- End .feature-box -->
								</div><!-- End .col-md-4 -->

								<div class="col-md-4">
									<div class="feature-box px-sm-3 feature-box-simple text-center">
										<i class="icon-action-undo"></i>

										<div class="feature-box-content">
											<h3 class="m-b-1">Returns</h3>
											<h5 class="m-b-3">Easy & Free</h5>

											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapib.</p>
										</div><!-- End .feature-box-content -->
									</div><!-- End .feature-box -->
								</div><!-- End .col-md-4 -->
							</div><!-- End .row -->
						</div><!-- End .feature-boxes-container -->
					</div>
				</div>






			</div><!-- End .container -->
		</main><!-- End .main -->

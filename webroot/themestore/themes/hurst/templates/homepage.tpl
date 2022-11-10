<!-- SLIDER-BANNER-AREA START -->
<section class="slider-banner-area clearfix" style="margin-top: 30px">
	<!-- Sidebar-social-media start -->
	<div class="sidebar-social hidden-xs">
		<div class="table">
			<div class="table-cell">
				<ul>
					<li><a href="#" target="_blank" title="Google Plus"><i class="zmdi zmdi-google-plus"></i></a></li>
					<li><a href="#" target="_blank" title="Twitter"><i class="zmdi zmdi-twitter"></i></a></li>
					<li><a href="#" target="_blank" title="Facebook"><i class="zmdi zmdi-facebook"></i></a></li>
					<li><a href="#" target="_blank" title="Linkedin"><i class="zmdi zmdi-linkedin"></i></a></li>
				</ul>
			</div>
		</div>
	</div>



    {% product=Shop.product(test) %}
	<!-- Sidebar-social-media start -->
	<div class="banner-left floatleft">
		<!-- Slider-banner start -->
		<div class="slider-banner">
			<div class="single-banner banner-1">
				<a class="banner-thumb" href="#" tplvar="product->link"><img src="" tplimage="product->image" width="450" height="375" alt="" /></a>
				<span class="pro-label new-label hidden-md">new</span>
				<span class="price hidden-md" >{{ Shop.productPrice($product) }} </span>
				<div class="banner-brief">
					<h2 class="banner-title hidden-md"><a href="" tplvar="product->link"> <tpl tplvar="product->title"></tpl> </a></h2>
					<p class="mb-0 hidden-md" tplvar="product->product_type">Furniture</p>
				</div>
				<a href="{{ product->cartlink }}" class="button-one font-16px" data-text="Buy now">Buy now</a>
			</div>

          {% product=Shop.product(magazine-rack-0003-wf-wn) %}

			<div class="single-banner banner-1" style="margin-top: 30px">
				<a class="banner-thumb" href="#" tplvar="product->link"><img src="" tplimage="product->image" width="450" height="375" alt="" /></a>
				<span class="pro-label sale-label hidden-md">sale</span>
				<span class="price hidden-md" >{{ Shop.productPrice($product) }}</span>
				<div class="banner-brief">
					<h2 class="banner-title hidden-md"><a href="" tplvar="product->link"> <tpl tplvar="product->title"></tpl> </a></h2>
					<p class="mb-0 hidden-md" tplvar="product->product_type">Furniture</p>
				</div>
				<a href="{{ product->cartlink }}" class="button-one font-16px" data-text="Buy now">Buy now</a>
			</div>

		</div>
		<!-- Slider-banner end -->
	</div>
	<div class="slider-right floatleft">
		<!-- Slider-area start -->
		<div class="slider-area">
			<div class="bend niceties preview-2">
				<div id="ensign-nivoslider" class="slides">
					<img src="{{Shop.asset_image(slider-1)}}" alt="" title="#slider-direction-1"  />
					<img src="{{Shop.asset_image(slider-2)}}" alt="" title="#slider-direction-2"  />
					<img src="{{Shop.asset_image(slider-3)}}" alt="" title="#slider-direction-3"  />
				</div>
				<!-- direction 1 -->
				<div id="slider-direction-1" class="t-cn slider-direction">
					<div class="slider-progress"></div>
					<div class="slider-content t-lfl s-tb slider-1">
						<div class="title-container s-tb-c title-compress">
							<div class="layer-1">
								<div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
									<h2 class="slider-title3 text-uppercase mb-0" >welcome to our</h2>
								</div>
								<div class="wow fadeIn" data-wow-duration="1.5s" data-wow-delay="1.5s">
									<h2 class="slider-title1 text-uppercase mb-0">furniture</h2>
								</div>
								<div class="wow fadeIn" data-wow-duration="2s" data-wow-delay="2.5s">
									<h3 class="slider-title2 text-uppercase" >gallery 2016</h3>
								</div>
								<div class="wow fadeIn" data-wow-duration="2.5s" data-wow-delay="3.5s">
									<a href="#" class="button-one style-2 text-uppercase mt-20" data-text="Shop now">Shop now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- direction 2 -->
				<div id="slider-direction-2" class="slider-direction">
					<div class="slider-progress"></div>
					<div class="slider-content t-lfl s-tb slider-1">
						<div class="title-container s-tb-c title-compress">
							<div class="layer-1">
								<div class="wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.5s">
									<h2 class="slider-title3 text-uppercase mb-0" >welcome to our</h2>
								</div>
								<div class="wow fadeInUpBig" data-wow-duration="1.5s" data-wow-delay="0.5s">
									<h2 class="slider-title1 text-uppercase">furniture</h2>
								</div>
								<div class="wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.5s">
									<p class="slider-pro-brief">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</p>
								</div>
								<div class="wow fadeInUpBig" data-wow-duration="2.5s" data-wow-delay="0.5s">
									<a href="#" class="button-one style-2 text-uppercase mt-20" data-text="Shop now">Shop now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- direction 3 -->
				<div id="slider-direction-3" class="slider-direction">
					<div class="slider-progress"></div>
					<div class="slider-content t-lfl s-tb slider-1">
						<div class="title-container s-tb-c title-compress">
							<div class="layer-1">
								<div class="wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.5s">
									<h2 class="slider-title3 text-uppercase mb-0" >welcome to our</h2>
								</div>
								<div class="wow fadeInUpBig" data-wow-duration="1.5s" data-wow-delay="0.5s">
									<h2 class="slider-title1 text-uppercase mb-0">furniture</h2>
								</div>
								<div class="wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.5s">
									<h3 class="slider-title2 text-uppercase" >gallery 2016</h3>
								</div>
								<div class="wow fadeInUpBig" data-wow-duration="2.5s" data-wow-delay="0.5s">
									<p class="slider-pro-brief">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</p>
								</div>
								<div class="wow fadeInUpBig" data-wow-duration="3s" data-wow-delay="0.5s">
									<a href="#" class="button-one style-2 text-uppercase mt-20" data-text="Shop now">Shop now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Slider-area end -->
	</div>
</section>
<!-- End Slider-section -->
<!-- sidebar-search Start -->
<!--
<div class="sidebar-search animated slideOutUp">
	<div class="table">
		<div class="table-cell">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2 p-0">
						<div class="search-form-wrap">
							<button class="close-search"><i class="zmdi zmdi-close"></i></button>
							<form action="#">
								<input type="text" placeholder="Search here..." />
								<button class="search-button" type="submit">
									<i class="zmdi zmdi-search"></i>
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
-->

<!-- sidebar-search End -->
<!-- PRODUCT-AREA START -->
<div class="product-area pt-80 pb-35">
	<div class="container">
		<!-- Section-title start -->
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title text-center">
					<h2 class="title-border">Featured Products</h2>
				</div>
			</div>
		</div>
		<!-- Section-title end -->
		<div class="row cus-row-30">
			<div class="product-slider arrow-left-right">
				<!-- Single-product start -->

				<div class="single-product col-lg-12" tpleach="Shop.products(featured,,8)">

						<img class="ck-pro-image" style="display: none" src=""  tplimage="val->image" width="320" height="390"/>
					<span class="ck-pro-description" style="display: none" tplvar="val->description"> </span>



					<div class="product-img">
						<span class="pro-label new-label">new</span>
						<a href="" class="ck-link" tplvar="val->link"><img src="img/product/1.jpg" tplimage="val->image" alt="" height="263" width="263" /></a>
						<div class="product-action clearfix">
							<a href="#" class="quick-view" title="Quick View" tplvar="val->id" set="ck-pro-id"><i class="zmdi zmdi-zoom-in"></i></a>
							<a href="#" data-toggle="tooltip" class="ck-cartlink" tplvar="val->cartlink" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
						</div>
					</div>
					<div class="product-info clearfix">
						<div class="fix">
							<h4 class="ck-pro-title post-title floatleft"><a href="#" tplvar="val->link"> <tpl tplvar="val->title"></tpl> </a></h4>
							<p class="floatright hidden-sm hidden-xs" tplvar="val->product_type"></p>
						</div>
						<div class="fix">
							<span class="ck-pro-price pro-price floatleft" tplvar="{{ Shop.productPrice($val) }} "></span>

									<span class="pro-rating floatright review" tplvar="product->rating" set="review">

											<a href="#"><i class="zmdi zmdi-star"></i></a>
											<a href="#"><i class="zmdi zmdi-star"></i></a>
											<a href="#"><i class="zmdi zmdi-star"></i></a>
											<a href="#"><i class="zmdi zmdi-star-half"></i></a>
											<a href="#"><i class="zmdi zmdi-star-half"></i></a>

										</span>
						</div>
					</div>
				</div>
				<!-- Single-product end -->
			</div>
		</div>
	</div>
</div>
<!-- PRODUCT-AREA END -->
<!-- DISCOUNT-PRODUCT START -->
<div class="discount-product-area">
	<div class="container">
		<div class="row">
			<div class="discount-product-slider dots-bottom-right">
				<!-- single-discount-product start -->
				<div class="col-lg-12">
					<div class="discount-product">
						<img src="{{Shop.asset_image(flash-slider-1)}}" alt="" />
						<div class="discount-img-brief">
							<div class="onsale">
								<span class="onsale-text">On Sale</span>
								<span class="onsale-price">$ 80.00</span>
							</div>
							<div class="discount-info">
								<h1 class="text-dark-red hidden-xs">Discount 50%</h1>
								<p class="hidden-xs">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed does eiusmodes tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim venim, quis nostrud exercitation ullamco laboris.</p>
								<a href="#" class="button-one font-16px style-3 text-uppercase mt-5" data-text="Buy now">Buy now</a>
							</div>
						</div>
					</div>
				</div>
				<!-- single-discount-product end -->
				<!-- single-discount-product start -->
				<div class="col-lg-12">
					<div class="discount-product">
						<img src="{{Shop.asset_image(flash-slider-2)}}" alt="" />
						<div class="discount-img-brief">
							<div class="onsale">
								<span class="onsale-text">On Sale</span>
								<span class="onsale-price">$ 80.00</span>
							</div>
							<div class="discount-info">
								<h1 class="text-dark-red hidden-xs">Discount 50%</h1>
								<p class="hidden-xs">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed does eiusmodes tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim venim, quis nostrud exercitation ullamco laboris.</p>
								<a href="#" class="button-one font-16px style-3 text-uppercase mt-5" data-text="Buy now">Buy now</a>
							</div>
						</div>
					</div>
				</div>
				<!-- single-discount-product end -->
				<!-- single-discount-product start -->
				<div class="col-lg-12">
					<div class="discount-product">
						<img src="{{Shop.asset_image(flash-slider-3)}}" alt="" />
						<div class="discount-img-brief">
							<div class="onsale">
								<span class="onsale-text">On Sale</span>
								<span class="onsale-price">$ 80.00</span>
							</div>
							<div class="discount-info">
								<h1 class="text-dark-red hidden-xs">Discount 50%</h1>
								<p class="hidden-xs">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed does eiusmodes tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim venim, quis nostrud exercitation ullamco laboris.</p>
								<a href="#" class="button-one font-16px style-3 text-uppercase mt-5" data-text="Buy now">Buy now</a>
							</div>
						</div>
					</div>
				</div>
				<!-- single-discount-product end -->
				<!-- single-discount-product start -->
				<div class="col-lg-12">
					<div class="discount-product">
						<img src="{{Shop.asset_image(flash-slider-4)}}" alt="" />
						<div class="discount-img-brief">
							<div class="onsale">
								<span class="onsale-text">On Sale</span>
								<span class="onsale-price">$ 80.00</span>
							</div>
							<div class="discount-info">
								<h1 class="text-dark-red hidden-xs">Discount 50%</h1>
								<p class="hidden-xs">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed does eiusmodes tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim venim, quis nostrud exercitation ullamco laboris.</p>
								<a href="#" class="button-one font-16px style-3 text-uppercase mt-5" data-text="Buy now">Buy now</a>
							</div>
						</div>
					</div>
				</div>
				<!-- single-discount-product end -->
			</div>
		</div>
	</div>
</div>
<!-- DISCOUNT-PRODUCT END -->
<!-- PURCHASE-ONLINE-AREA START -->
<div class="purchase-online-area pt-80">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title text-center">
					<h2 class="title-border">Purchase Online on Hurst</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 text-center">
				<!-- Nav tabs -->
				<ul class="tab-menu clearfix">
					<li class="active"><a href="#new-arrivals" data-toggle="tab">New Arrivals</a></li>
					<li><a href="#best-seller"  data-toggle="tab">Best Seller </a></li>
					<li><a href="#most-view" data-toggle="tab">Most View </a></li>
					<li><a href="#discounts" data-toggle="tab">Discounts</a></li>
				</ul>
			</div>
			<div class="col-lg-12">
				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane active" id="new-arrivals">
						<div class="row">
							<!-- Single-product start -->
							<div tpleach="Shop.products(all,new_arrival,8)" set="product" class="single-product col-lg-3 col-md-4 col-sm-4 col-xs-12">

								<img class="ck-pro-image" style="display: none" src=""  tplimage="product->image" width="320" height="390"/>
								<span class="ck-pro-description" style="display: none" tplvar="product->description"> </span>

								<div class="product-img">
									<span class="pro-label new-label">new</span>
									<a href="single-product.html" class="ck-link" tplvar="product->link"><img src="img/product/5.jpg" tplimage="product->image" height="263" width="263" alt="" /></a>
									<div class="product-action clearfix">
										<a href="#" class="quick-view" title="Quick View" tplvar="product->id" set="ck-pro-id"><i class="zmdi zmdi-zoom-in"></i></a>
										<a href="#" class="ck-cartlink" tplvar="product->cartlink" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
									</div>
								</div>
								<div class="product-info clearfix">
									<div class="fix">
										<h4 class="ck-pro-title post-title floatleft"><a href="#" tplvar="product->link"> <tpl tplvar="product->title"></tpl></a></h4>
										<p class="floatright hidden-sm" tplvar="product->product_type"></p>
									</div>
									<div class="fix">
										<span class="ck-pro-price pro-price floatleft" tplvar="{{ Shop.productPrice($product) }} "></span>
										<span class="pro-rating floatright review" tplvar="product->rating" set="review">
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star-half"></i></a>
														<a href="#"><i class="zmdi zmdi-star-half"></i></a>
													</span>
									</div>
								</div>
							</div>
							<!-- Single-product end -->
						</div>
					</div>
					<div class="tab-pane" id="best-seller">
						<div class="row">
							<!-- Single-product start -->
							<div tpleach="Shop.products(all,best_seller,8)" set="product" class="single-product col-lg-3 col-md-4 col-sm-4 col-xs-12">

								<img class="ck-pro-image" style="display: none" src=""  tplimage="product->image" width="320" height="390"/>
								<span class="ck-pro-description" style="display: none" tplvar="product->description"> </span>

								<div class="product-img">
									<span class="pro-label new-label">new</span>
									<a href="single-product.html" class="ck-link" tplvar="product->link"><img src="img/product/5.jpg" tplimage="product->image" height="263" width="263" alt="" /></a>
									<div class="product-action clearfix">
										<a href="#" class="quick-view" title="Quick View" tplvar="product->id" set="ck-pro-id"><i class="zmdi zmdi-zoom-in"></i></a>
										<a href="#" class="ck-cartlink" tplvar="product->cartlink" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
									</div>
								</div>
								<div class="product-info clearfix">
									<div class="fix">
										<h4 class="ck-pro-title post-title floatleft"><a href="#" tplvar="product->link"> <tpl tplvar="product->title"></tpl></a></h4>
										<p class="floatright hidden-sm" tplvar="product->product_type"></p>
									</div>
									<div class="fix">
										<span class="ck-pro-price pro-price floatleft" tplvar="{{ Shop.productPrice($product) }} "></span>
										<span class="pro-rating floatright review" tplvar="product->rating" set="review">
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star-half"></i></a>
														<a href="#"><i class="zmdi zmdi-star-half"></i></a>
													</span>
									</div>
								</div>
							</div>

							<!-- Single-product end -->
						</div>
					</div>
					<div class="tab-pane" id="most-view">
						<div class="row">
							<!-- Single-product start -->
							<div tpleach="Shop.products(all,most_view,8)" set="product" class="single-product col-lg-3 col-md-4 col-sm-4 col-xs-12">

								<img class="ck-pro-image" style="display: none" src=""  tplimage="product->image" width="320" height="390"/>
								<span class="ck-pro-description" style="display: none" tplvar="product->description"> </span>

								<div class="product-img">
									<span class="pro-label new-label">new</span>
									<a href="single-product.html" class="ck-link" tplvar="product->link"><img src="img/product/5.jpg" tplimage="product->image" height="263" width="263" alt="" /></a>
									<div class="product-action clearfix">
										<a href="#" class="quick-view" title="Quick View" tplvar="product->id" set="ck-pro-id"><i class="zmdi zmdi-zoom-in"></i></a>
										<a href="#" class="ck-cartlink" tplvar="product->cartlink" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
									</div>
								</div>
								<div class="product-info clearfix">
									<div class="fix">
										<h4 class="ck-pro-title post-title floatleft"><a href="#" tplvar="product->link"> <tpl tplvar="product->title"></tpl></a></h4>
										<p class="floatright hidden-sm" tplvar="product->product_type"></p>
									</div>
									<div class="fix">
										<span class="ck-pro-price pro-price floatleft" tplvar="{{ Shop.productPrice($product) }} "></span>
										<span class="pro-rating floatright review" tplvar="product->rating" set="review">
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star-half"></i></a>
														<a href="#"><i class="zmdi zmdi-star-half"></i></a>
													</span>
									</div>
								</div>
							</div>

							<!-- Single-product end -->
						</div>
					</div>
					<div class="tab-pane" id="discounts">
						<div class="row">
							<!-- Single-product start -->
							<div tpleach="Shop.products(all,discounts,8)" set="product" class="single-product col-lg-3 col-md-4 col-sm-4 col-xs-12">

								<img class="ck-pro-image" style="display: none" src=""  tplimage="product->image" width="320" height="390"/>
								<span class="ck-pro-description" style="display: none" tplvar="product->description"> </span>

								<div class="product-img">
									<span class="pro-label new-label" tplcheck="product->isNew">new</span>
									<span class="pro-label new-label" tplcheck="product->onSale">sale</span>
									<a href="single-product.html" class="ck-link" tplvar="product->link"><img src="img/product/5.jpg" tplimage="product->image" height="263" width="263" alt="" /></a>
									<div class="product-action clearfix">
										<a href="#" class="quick-view" title="Quick View" tplvar="product->id" set="ck-pro-id"><i class="zmdi zmdi-zoom-in"></i></a>
										<a href="#" class="ck-cartlink" tplvar="product->cartlink" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
									</div>
								</div>
								<div class="product-info clearfix">
									<div class="fix">
										<h4 class="ck-pro-title post-title floatleft"><a href="#" tplvar="product->link"> <tpl tplvar="product->title"></tpl></a></h4>
										<p class="floatright hidden-sm" tplvar="product->product_type"></p>
									</div>
									<div class="fix">
										<span class="ck-pro-price pro-price floatleft" tplvar="{{ Shop.productPrice($product) }} "></span>
										<span class="pro-rating floatright review" tplvar="product->rating" set="review">
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star-half"></i></a>
														<a href="#"><i class="zmdi zmdi-star-half"></i></a>
													</span>
									</div>
								</div>
							</div>

							<!-- Single-product end -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- PURCHASE-ONLINE-AREA END -->

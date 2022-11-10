<!-- HEADING-BANNER START
<div class="heading-banner-area overlay-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading-banner">
					<div class="heading-banner-title">
						<h2>Shop</h2>
					</div>
					<div class="breadcumbs pb-15">
						<ul>
							<li><a href="#">Home</a></li>
							<li>Shop</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 HEADING-BANNER END -->
<!-- PRODUCT-AREA START -->
<div class="product-area pt-80 pb-80 product-style-2">
	<div class="container">
		<!-- Shop-Content End -->
		<div class="shop-content">
			<div class="section-title text-center">
					<h2 class="title-border">{{ collection_title }}</h2>
				</div>
			<div class="row">
				<div class="col-md-12">
					<div class="product-option mb-30 clearfix">
						<!-- Categories start -->
						<div class="dropdown floatleft">
							<button class="option-btn" >
								Categories
							</button>
							<div class="dropdown-menu dropdown-width" >
								<!-- Widget-Categories start -->
								<aside class="widget widget-categories">
									<div class="widget-title">
										<h4>Categories</h4>
									</div>
									<div id="cat-treeview"  class="widget-info product-cat boxscrol2">
										<ul>
											<li><span>Dining</span>
												<ul>
													<li><a href="collection/dining">Dining Tables</a></li>

												</ul>
											</li>
											<li class="open"><span>Living Room</span>
												<ul>
													<li><a href="collection/almirah">Almirah</a></li>
													<li><a href="collection/dressing">Dressing Table</a></li>
													<li><a href="collection/shelf">Shelf</a></li>

												</ul>
											</li>

										</ul>
									</div>
								</aside>
								<!-- Widget-categories end -->
							</div>
						</div>
						<!-- Categories end -->
						<!-- Price start -->
						<div class="dropdown floatleft">
							<button class="option-btn" >
								Price
							</button>
							<div class="dropdown-menu dropdown-width" >
								<!-- Shop-Filter start -->
								<aside class="widget shop-filter">
									<div class="widget-title">
										<h4>Price</h4>
									</div>
									<div class="widget-info">
										<div class="price_filter">
											<div class="price_slider_amount">
												<input type="submit"  value="You range :"/>
												<input type="text" id="amount" name="price"  placeholder="Add Your Price" />
											</div>
											<div id="slider-range"></div>
										</div>
									</div>
								</aside>
								<!-- Shop-Filter end -->
							</div>
						</div>
						<!-- Price end -->
						<!-- Color start -->
						<div class="dropdown floatleft">
							<button class="option-btn">
								Color
							</button>
							<div class="dropdown-menu dropdown-width" >
								<!-- Widget-Color start -->
								<aside class="widget widget-color">
									<div class="widget-title">
										<h4>Color</h4>
									</div>
									<div class="widget-info color-filter clearfix">
										<ul>
											<li><a href="#"><span class="color color-1"></span>LightSalmon<span class="count">12</span></a></li>
											<li><a href="#"><span class="color color-2"></span>Dark Salmon<span class="count">20</span></a></li>
											<li><a href="#"><span class="color color-3"></span>Tomato<span class="count">59</span></a></li>
											<li class="active"><a href="#"><span class="color color-4"></span>Deep Sky Blue<span class="count">45</span></a></li>
											<li><a href="#"><span class="color color-5"></span>Electric Purple<span class="count">78</span></a></li>
											<li><a href="#"><span class="color color-6"></span>Atlantis<span class="count">10</span></a></li>
											<li><a href="#"><span class="color color-7"></span>Deep Lilac<span class="count">15</span></a></li>
										</ul>
									</div>
								</aside>
								<!-- Widget-Color end -->
							</div>
						</div>
						<!-- Color end -->
						<!-- Size start -->
						<div class="dropdown floatleft">
							<button class="option-btn">
								Size
							</button>
							<div class="dropdown-menu dropdown-width" >
								<!-- Widget-Size start -->
								<aside class="widget widget-size">
									<div class="widget-title">
										<h4>Size</h4>
									</div>
									<div class="widget-info size-filter clearfix">
										<ul>
											<li><a href="#">M</a></li>
											<li class="active"><a href="#">S</a></li>
											<li><a href="#">L</a></li>
											<li><a href="#">SL</a></li>
											<li><a href="#">XL</a></li>
										</ul>
									</div>
								</aside>
								<!-- Widget-Size end -->
							</div>
						</div>
						<!-- Size end -->
						<div class="showing text-right">
							<p class="mb-0 hidden-xs">Showing {{ pagination->count }} of total {{ pagination->total }} Results</p>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<!-- Single-product start -->
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12" tpleach="products" set="product">

							<div class="single-product">

								<img class="ck-pro-image" style="display: none" src=""   tplimage="product->image" width="320" height="320"/>
								<span class="ck-pro-description" style="display: none" tplvar="product->description"> </span>

								<div class="product-img">
									<span class="pro-label new-label">new</span>
									<span class="ck-pro-price pro-price-2"  >{{ Formats.moneyFormat($product->price) }}</span>
									<a href="single-product.html" class="ck-link" tplvar="product->link"><img src="img/product/6.jpg" alt="" tplimage="product->image" width="320" height="320"/></a>
								</div>
								<div class="product-info clearfix text-center">
									<div class="fix">
										<h4 class="ck-pro-title post-title"><a href="#" tplvar="product->link"><tpl tplvar="product->title"></tpl></a></h4>

									</div>
									<div class="fix">
													<span class="pro-rating">
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star-half"></i></a>
														<a href="#"><i class="zmdi zmdi-star-half"></i></a>
													</span>
									</div>
									<div class="product-action clearfix">
										<a href="#" class="quick-view" title="Quick View" tplvar="product->id" set="ck-pro-id"><i class="zmdi zmdi-zoom-in"></i></a>
										<a href="#" class="ck-cartlink" tplvar="product->cartlink" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
									</div>
								</div>
							</div>
						</div>
						<!-- Single-product end -->
					</div>
				</div>
				<div class="col-md-12">
					<!-- Pagination start -->
					<div class="shop-pagination  text-center">
						<div class="pagination">
							<ul>
								<li><a href="#" tplvar="pagination_link_prev"><i class="zmdi zmdi-long-arrow-left"></i></a></li>
								<li tpleach="pagination_links"><a href="#" tplvar="val"><tpl tplvar="key"></tpl></a></li>
								<li><a href="#" tplvar="pagination_link_next"><i class="zmdi zmdi-long-arrow-right"></i></a></li>
							</ul>
						</div>
					</div>
					<!-- Pagination end -->
				</div>
			</div>
		</div>
		<!-- Shop-Content End -->
	</div>
</div>
<!-- PRODUCT-AREA END -->
<!-- HEADING-BANNER START
<div class="heading-banner-area overlay-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading-banner">
					<div class="heading-banner-title">
						<h2>Single Product</h2>
					</div>
					<div class="breadcumbs pb-15">
						<ul>
							<li><a href="index.html">Home</a></li>
							<li>Single Product</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
HEADING-BANNER END -->




<!-- PRODUCT-AREA START -->
<div class="product-area single-pro-area pt-30 pb-80 product-style-2">
	<div class="container">
		<div class="row shop-list single-pro-info no-sidebar">
			<!-- Single-product start -->
			<div class="col-lg-12">
				<div class="single-product clearfix">
					<span style="display: none">
						<img class="ck-pro-image" src=""  tplimage="product->imagepath" width="320" height="390"/>
						<a href="" class="ck-cartlink" tplvar="product->cartlink"></a>
						<a href="" class="ck-link" tplvar="product->link"></a>
					</span>
					<!-- Single-pro-slider Big-photo start -->
					<div class="single-pro-slider single-big-photo view-lightbox slider-for">
						<div tpleach="product->product_media" set="media">
							<img src="img/single-product/medium/1.jpg" tplimage="media->imagepath"  width="416" height="507" alt="" />
							<a class="view-full-screen" href="img/single-product/large/1.jpg" tplimage="media->imagepath"  data-lightbox="roadtrip" data-title="My caption">
								<i class="zmdi zmdi-zoom-in"></i>
							</a>
						</div>
					</div>
					<!-- Single-pro-slider Big-photo end -->
					<div class="product-info">
						<div class="fix">
							<h4 class="ck-pro-title post-title floatleft" tplvar="product->title"></h4>
							<span class="pro-rating floatright review" tplvar="product->rating" set="review">

							</span>
						</div>
						<div class="fix mb-20">
							<span class="ck-pro-price pro-price" tplvar="Formats.moneyFormat($product->price)"></span>
						</div>
						<div class="ck-pro-description product-description">
							<p tplvar="product->overview"></p>
						</div>

						<form action="add_to_cart" id="add-to-cart" tplform="">
							<!-- color start -->
							<input type="hidden" name="product_id" tplvar="product->id" set='value'>
							<input type="hidden" name="variant_id" id="variant_id">

						<!--	<div class="color-filter single-pro-color mb-20 clearfix">
								<ul>
									<li><span class="color-title text-capitalize">color</span></li>
									<li class="active"><a href="#"><span class="color color-1"></span></a></li>
									<li><a href="#"><span class="color color-2"></span></a></li>
									<li><a href="#"><span class="color color-7"></span></a></li>
									<li><a href="#"><span class="color color-3"></span></a></li>
									<li><a href="#"><span class="color color-4"></span></a></li>
								</ul>
							</div> -->
							<!-- color end -->
							<!-- Size start -->
							<div class="size-filter single-pro-size mb-35 clearfix" tplcheck="shop.checkexists($product->product_variants)" >
								<ul>
									<li><span class="color-title text-capitalize">Options</span></li>
									<li tpleach="product->product_variants" set="variant" class="product_options" data-price="{{ formats.moneyFormat($variant->price) }}"  data-vid="{{ variant->id }}" data-inventory="{{ variant->q_available }}"><a href="javascript:;;" title="{{ variant->option_text }}"><img src="" tplimage="variant->image"  width="20" height="20"></a></li>

								</ul>
							</div>
							<!-- Size end -->
							<div class="clearfix">
								<div class="cart-plus-minus">
									<input type="text" value="1" name="quantity" class="cart-plus-minus-box">
								</div>
								<div class="product-action clearfix">
									<a href="#" class="add-to-cart" data-toggle="tooltip" onclick="document.getElementById('add-to-cart').submit();" href="#" data-placement="top" title="Buy Now"><i class="zmdi zmdi-shopping-basket"></i></a>
									<a href="#" class="add-to-cart" data-toggle="tooltip" onclick="document.getElementById('add-to-cart').submit();" href="#" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i> </a>
								</div>
							</div>
						</form>

						<!-- Single-pro-slider Small-photo start -->
						<div class="single-pro-slider single-sml-photo slider-nav">
							<div tpleach="product->product_media">
								<img src="img/single-product/small/1.jpg" tplimage="val->imagepath" height="150" width="125" alt="" />
							</div>

						</div>
						<!-- Single-pro-slider Small-photo end -->
					</div>
				</div>
			</div>
			<!-- Single-product end -->
		</div>
		<!-- single-product-tab start -->
		<div class="single-pro-tab">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="single-pro-tab-menu">
						<!-- Nav tabs -->
						<ul class="">
							<li class="active"><a href="#description" data-toggle="tab">Description</a></li>
							<li ><a href="#reviews"  data-toggle="tab">Reviews</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="description">
							<div class="pro-tab-info pro-description">
								<h3 class="tab-title title-border mb-30" tplvar="product->title"></h3>
								<p tplvar="product->description"></p>
							</div>
						</div>
						<div class="tab-pane " id="reviews">
							<div class="pro-tab-info pro-reviews">
								<div class="customer-review mb-60">
									<h3 class="tab-title title-border mb-30">Customer review</h3>
									<ul class="product-comments clearfix">
										<li class="mb-30 clearfix" tpleach="product->reviews">
											<div class="pro-reviewer">
												<img src="img/reviewer/1.jpg" alt="" />
											</div>
											<div class="pro-reviewer-comment">
												<div class="fix">
													<div class="floatleft mbl-center">
														<h5 class="text-uppercase mb-0"><strong> <tpl tplvar="val->customer->first_name"/> <tpl tplvar="val->customer->last_name" /></strong></h5>
														<p class="reply-date" tplvar="val->created"></p>
														<span class="pro-rating review" tplvar="val->rating" set="review">
																<a href="#"><i class="zmdi zmdi-star"></i></a>
																<a href="#"><i class="zmdi zmdi-star"></i></a>
																<a href="#"><i class="zmdi zmdi-star"></i></a>
																<a href="#"><i class="zmdi zmdi-star-half"></i></a>
																<a href="#"><i class="zmdi zmdi-star-half"></i></a>
														</span>
													</div>
												</div>
												<p class="mb-0" tplvar="val->comment"></p>
											</div>
										</li>
									</ul>
								</div>

								<div class="leave-review"  tpluser="0">
									<h3 class="tab-title title-border mb-30">Leave your reviw</h3>
									<p>You must <a style="font-size: 17px; color: #C8A165;" href="login">login</a> to review</p>
								</div>

								<div class="leave-review"  tpluser="1">
									<h3 class="tab-title title-border mb-30">Leave your reviw</h3>
									<div class="your-rating mb-30">
										<p class="mb-10"><strong>Your Rating</strong></p>
										<div class='starrr'></div>
									</div>
									<div class="reply-box">
										<form action="review" method="post" tplform="">
											<!--
											<div class="row">
												<div class="col-md-6">
													<input type="text" placeholder="Your name here..." name="name" />
												</div>
												<div class="col-md-6">
													<input type="text" placeholder="Subject..." name="name" />
												</div>
											</div>
											-->
											<div class="row">
												<div class="col-md-12">
													<input type="hidden" name="product_id" tplvar="product->id" set="value">
													<input type="hidden" id="review-rating-value" name="rating" value="5">
													<textarea class="custom-textarea" name="comment" required placeholder="Your review here..." ></textarea>
													<button type="submit" data-text="submit review" class="button-one submit-button mt-20">submit review</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- single-product-tab end -->
		<div class="row">
			<div class="section-title text-center">
					<h2 class="title-border">You may also like</h2>
				</div>
			<!-- Single-product start -->
			<div tpleach="Shop.related_products($product->product_type,10)" set="product" class="single-product col-lg-3 col-md-4 col-sm-4 col-xs-12">

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
</div>
<!-- PRODUCT-AREA END -->


<script tplblock="start(scriptbottom)">
	$(document).ready(function (e){

	
		$('.product_options').click(function(){
       $('.product_options').removeClass("active");
			 $(this).addClass("active");
			 $('#variant_id').val($(this).attr("data-vid"));
			 $('.ck-pro-price').html($(this).attr("data-price"));
			// console.log($(this).attr("data-vid"));
		});

		$('.starrr').starrr({
			rating: 5
		})

		$('.starrr').on('starrr:change', function(e, value){
			$("#review-rating-value").val(value)
		})

	});

</script>

<!-- HEADING-BANNER START
<div class="heading-banner-area overlay-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading-banner">
					<div class="heading-banner-title">
						<h2>Shopping Cart</h2>
					</div>
					<div class="breadcumbs pb-15">
						<ul>
							<li><a href="index.ctp">Home</a></li>
							<li>Shopping Cart</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
HEADING-BANNER END -->

<!-- SHOPPING-CART-AREA START -->
<div class="shopping-cart-area  pt-0 pb-80">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="shopping-cart">

					<!-- Nav tabs -->
					<!-- Tab panes -->
					<div class="tab-content">
						<!-- shopping-cart start -->
						<div class="tab-pane active" id="shopping-cart">
							<form method="post" tplform="" action="cart" class="ck-cart-form">
								<div class="shop-cart-table">
									<div class="table-content table-responsive">
										<table>
											<thead>
											<tr>
												<th class="product-thumbnail">Product</th>
												<th class="product-price">Price</th>
												<th class="product-quantity">Quantity</th>
												<th class="product-subtotal">Total</th>
												<th class="product-remove">Remove</th>
											</tr>
											</thead>
											<tbody id="cart_items">
											<tr tpleach="cart_products" class="ck-cart-item">
												<input type="hidden" value="{{ val->id }}" name="product_id[]">
	                      <input type="hidden" value="{{ val->vid }}" name="variant_id[]">

												<td class="product-thumbnail  text-left">
													<!-- Single-product start -->
													<div class="single-product">
														<div class="product-img">
															<a href="single-product.html" tplvar="val->link"><img src="img/product/2.jpg" tplimage="val->image" width="100" alt="" /></a>
														</div>
														<div class="product-info">
															<h4 class="post-title"><a class="text-light-black" href="#" tplvar="val->link"><tpl tplvar="val->title"></tpl></a></h4>
															<p class="mb-0">{{ val->option }}</p>

														</div>
													</div>
													<!-- Single-product end -->
												</td>
												<td class="product-price item-price" tplvar="Formats.moneyFormat($val->price)"></td>
												<td class="product-quantity">
													<div class="cart-plus-minus">
														<input type="text" value="01" tplvar="val->quantity" name="quantity[]" class="cart-plus-minus-box quantity ck-cart-item-quantity">
													</div>
													<div tplcheck="val->out_of_stock">out of stock</div>
												</td>
												<td class="product-subtotal item-total" tplvar="Formats.moneyFormat($val->total)">$112.00</td>
												<td class="product-remove">
													<a href="javascript::void(0)" class="remove-item ck-cart-item-remove"><i class="zmdi zmdi-close"></i></a>
												</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12 p-sm-0 pt-40" style="padding-top: 73px; padding-left: 60px;">

									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="customer-login payment-details mt-30">
											<h4 class="title-1 title-border text-uppercase">payment details</h4>
											<table>
												<tbody>
												<tr>
													<td class="text-left">Cart Subtotal</td>
													<td class="text-right" id="subtotal"><tpl tplvar="Formats.moneyFormat($cart_total)"></tpl></td>
												</tr>

												<tr>
													<td class="text-left">Order Total</td>
													<td class="text-right" id="total"><tpl tplvar="Formats.moneyFormat($cart_total)"></tpl></td>
												</tr>
												</tbody>
											</table>

											<div class="text-right">
												<a class="button-link mt-15" href="collection">Continue to shopping</a>
												<a href="checkout" class="button-link mt-15">Process to Checkout</a>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- shopping-cart end -->
					</div>

				</div>
			</div>
		</div>

		<div class="row">
			<div class="section-title text-center">
					<h2 class="title-border">Products Viewed Recently</h2>
				</div>
			<!-- Single-product start -->
			<div tpleach="Shop.recent_viewed_products(10)" set="product" class="single-product col-lg-3 col-md-4 col-sm-4 col-xs-12">

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
<!-- SHOPPING-CART-AREA END -->


<script tplblock="start(scriptbottom)">
	$(document).ready(function (e) {

		console.log($(".quantity").val());


		$(".remove-item").click(function (e) {
			e.preventDefault();
			$(this).closest("tr").remove();
			calculate_total();
			/*item_price = parseFloat($(this).parent().prev().text());
            total = parseFloat($("#total").text().replaceAll(',', ''));
            $("#total").text(total-item_price);
            $(this).parent().parent().remove();

             */
		});


		$(".quantity").change(function (e) {
			let qnty = parseInt($(this).val());
			console.log(qnty)

			let unit_price = parseFloat(find_class(this,'item-price').replaceAll(',', ''));
			let item_total = parseFloat(unit_price * qnty);
			find_class(this, 'item-total', item_total);
			calculate_total()
		});



		function find_class(_this, classname, value = false) {
			let el = $(_this).closest("tr").find("."+classname);

			if (value === false){
				return el.text();
			}else{
				el.text(value);
			}
		}
		function calculate_total(){
			let elements = $("#cart_items").find(".item-total");
			let total = 0;
			$.each(elements, function (index, item) {
				let price = parseFloat(item.innerHTML);
				total += price;
			})
			$("#subtotal").text(total);
			$("#total").text(total);
		}
	});

</script>

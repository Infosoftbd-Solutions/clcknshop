
									<ul>
										<li>
											<a class="cart-icon" href="#">
												<i class="zmdi zmdi-shopping-cart"></i>
												<span>{{ cart_count }}</span>
											</a>
											<div class="mini-cart-brief text-left">
												<div class="cart-items">
													<p class="mb-0">You have <span>{{ cart_count }} items</span> in your shopping bag</p>
												</div>
												<div class="all-cart-product clearfix">
													<div class="single-cart clearfix" tpleach="cart_products" set="cart_item">
														<div class="cart-photo">
															<a href="#"><img src="img/cart/1.jpg" alt="" tplimage="cart_item->image" width="90" height="90"></a>
														</div>
														<div class="cart-info">
															<h5><a href="{{ cart_item->link }}">{{ cart_item->title }}</a></h5>
															<p class="mb-0">Price : {{ Formats.moneyFormat($cart_item->price) }}</p>
															<p class="mb-0">Qty : {{ cart_item->quantity }} </p>
															<span class="cart-delete"><a href="#"><i class="zmdi zmdi-close"></i></a></span>
														</div>
													</div>

												</div>
												<div class="cart-totals">
													<h5 class="mb-0">Total <span class="floatright">{{ Formats.moneyFormat($cart_total) }}</span></h5>
												</div>
												<div class="cart-bottom  clearfix">
													<a href="/cart" class="button-one floatleft text-uppercase" data-text="View cart">View cart</a>
													<a href="/checkout" class="button-one floatright text-uppercase" data-text="Check out">Check out</a>
												</div>
											</div>
										</li>
									</ul>

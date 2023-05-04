

<main class="main">
    <div class="home-slider owl-carousel owl-theme owl-carousel-lazy show-nav-hover nav-big mb-2 text-uppercase" data-owl-options="{
				'loop': false
			}">
        <div class="home-slide home-slide1 banner">
            <img class="owl-lazy slide-bg" src="images/lazy.png" data-src="{{ Shop.asset_image(slider-1) }}" alt="slider image">
            
        </div><!-- End .home-slide -->

        <div class="home-slide home-slide2 banner banner-md-vw">
            <img class="owl-lazy slide-bg" src="images/lazy.png" data-src="{{ Shop.asset_image(slider-2) }}" alt="slider image">
            
        </div><!-- End .home-slide -->
    </div><!-- End .home-slider -->

    <div class="container" style="margin-top: 40px">
        <div class="info-boxes-slider owl-carousel owl-theme mb-2" data-owl-options="{
					'dots': false,
					'loop': false,
					'responsive': {
						'576': {
							'items': 2
						},
						'992': {
							'items': 3
						}
					}
				}">
            <div class="info-box info-box-icon-left">
                <i class="icon-shipping"></i>

                <div class="info-box-content">
                    <h4>Fastest Shipping</h4>
                    <p class="text-body">For all orders.</p>
                </div><!-- End .info-box-content -->
            </div><!-- End .info-box -->

            <div class="info-box info-box-icon-left">
                <i class="icon-money"></i>

                <div class="info-box-content">
                    <h4>100% money Back Gaurantee</h4>
                    <p class="text-body">30 days money return</p>
                </div><!-- End .info-box-content -->
            </div><!-- End .info-box -->

            <div class="info-box info-box-icon-left">
                <i class="icon-support"></i>

                <div class="info-box-content">
                    <h4>Support 24/7</h4>
                    <p class="text-body">Hotline 09342342343.</p>
                </div><!-- End .info-box-content -->
            </div><!-- End .info-box -->
        </div><!-- End .info-boxes-slider -->
    </div><!-- End .container -->

    <section class="featured-products-section">
        <div class="container">
            <h2 class="section-title heading-border ls-20 border-0">Recent Products</h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center" data-owl-options="{
						'dots': false,
						'nav': true
					}">
                <div class="product-default" tpleach="Shop.products(all, limit:10)">
                    <figure>
                        <a href="{{val->link}}">
                            <img src="" tplimage="val->imagepath" width="280" height="280" alt="product">
                        </a>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="collection/all?product-type={{val->product_type}}" class="product-category">{{val->product_type}}</a>
                        </div>
                        <h3 class="product-title">
                            <a href="{{val->link}}">{{ val->title }}</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{Formats.mul(20, $val->rating)}}%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <del class="old-price"></del>
                            <span class="product-price">{{Formats.moneyFormat($val->price)}}</span>
                        </div><!-- End .price-box -->
                        <!--<div class="product-action">
                            <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal">ADD TO CART</button>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                        </div>-->
                    </div><!-- End .product-details -->
                </div>

            </div><!-- End .featured-proucts -->
        </div>
    </section>

    <section class="featured-products-section">
        <div class="container">
            <h2 class="section-title heading-border ls-20 border-0">All Products </h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center" data-owl-options="{
						'dots': false,
						'nav': true
					}">
                <div class="product-default" tpleach="Shop.products(all,limit:8)">
                    <figure>
                        <a href="{{val->link}}">
                            <img src="" tplimage="val->imagepath" width="280" height="280" alt="product">
                        </a>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="collection/all?product-type={{val->product_type}}" class="product-category">{{val->product_type}}</a>
                        </div>
                        <h3 class="product-title">
                            <a href="{{val->link}}">{{ val->title }}</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{Formats.mul(20, $val->rating)}}%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <del class="old-price"></del>
                            <span class="product-price">{{Formats.moneyFormat($val->price)}}</span>
                        </div><!-- End .price-box -->
                        <!--<div class="product-action">
                            <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal">ADD TO CART</button>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                        </div>-->
                    </div><!-- End .product-details -->
                </div>

            </div><!-- End .featured-proucts -->
        </div>
    </section>


    <section class="feature-boxes-container">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <i class="icon-earphones-alt"></i>

                        <div class="feature-box-content">
                            <h3 class="m-b-1">Customer Support</h3>
                            <h5 class="m-b-3">You Won't Be Alone</h5>

                            <p>We really care about you and your website as much as you do. Purchasing Porto or any other theme from us you get 100% free support.</p>
                        </div><!-- End .feature-box-content -->
                    </div><!-- End .feature-box -->
                </div><!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <i class="icon-credit-card"></i>

                        <div class="feature-box-content">
                            <h3 class="m-b-1">Fully Customizable</h3>
                            <h5 class="m-b-3">Tons Of Options</h5>

                            <p>With Porto you can customize the layout, colors and styles within only a few minutes. Start creating an amazing website right now!</p>
                        </div><!-- End .feature-box-content -->
                    </div><!-- End .feature-box -->
                </div><!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <i class="icon-action-undo"></i>

                        <div class="feature-box-content">
                            <h3 class="m-b-1">Powerful Admin</h3>
                            <h5 class="m-b-3">Made To Help You</h5>

                            <p>Porto has very powerful admin features to help customer to build their own shop in minutes without any special skills in web development.</p>
                        </div><!-- End .feature-box-content -->
                    </div><!-- End .feature-box -->
                </div><!-- End .col-md-4 -->
            </div><!-- End .row -->
        </div><!-- End .container-->
    </section><!-- End .feature-boxes-container -->
</main><!-- End .main -->

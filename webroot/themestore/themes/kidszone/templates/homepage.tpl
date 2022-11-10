<style>
    .header-wrapper{
        min-height: 0px !important;
    }
</style>


<main class="main">
    <section class="section-1 home-section position-relative">
        <div class="home-banner banner bg-img" style="background-image: url({{Shop.asset_image(slider-image)}})">
            <div class="banner-layer banner-layer-middle">
                <h4 class="text-transform-none m-b-3">Find the Boundaries. Push Through!</h4>
                <h2 class="text-transform-none mb-0">Summer Sale</h2>
                <h3 class="m-b-3">70% Off</h3>
                <h5 class="d-inline-block mb-0">
                    <span>Starting At</span>
                    <b class="coupon-sale-text text-white bg-secondary align-middle"><sup>$</sup>199<sup>99</sup></b>
                </h5>
                <a href="/collection/all" class="btn btn-dark btn-lg ls-10">Shop Now!</a>
            </div><!-- End .banner-layer -->
        </div><!-- End .home-banner -->

        <div class="cat-section container position-absolute">
            <div class="owl-carousel owl-theme" data-owl-options="{
						'items': 2,
						'dots': false,
						'nav': false,
						'margin': 20,
						'autoplay': false,
						'responsive': {
							'576': {
								'items': 3
							},
							'768': {
								'items': 4
							},
							'992': {
								'items': 5
							},
							'1200': {
								'items': 6
							}
						}
					}">
                <a href="/collection/all" class="btn btn-dark btn-lg">ACCESSORIES</a>
                <a href="/collection/all" class="btn btn-dark btn-lg">CAPS</a>
                <a href="/collection/all" class="btn btn-dark btn-lg">DRESS</a>
                <a href="/collection/all" class="btn btn-dark btn-lg">ELECTRONICS</a>
                <a href="/collection/all" class="btn btn-dark btn-lg">FASHION</a>
                <a href="/collection/all" class="btn btn-dark btn-lg">HEADPHONE</a>
            </div>
        </div><!-- End .cat-section -->
    </section><!-- End .home-section -->

    <section id="home-section-2" class="section-2 banner-section appear-animate">
        <div class="banners-grid grid">
            <div class="banner banner-2 grid-item"">
                <figure>
                    <img src="{{Shop.asset_image(homepage-banner-1)}}" alt="banner">
                </figure>

                <div class="banner-layer banner-layer-middle">
                    <div class="banner-layer banner-layer-middle">
                        <h4 class="text-transform-none text-white">Find the Boundaries. Push Through!</h4>
                        <h2 class="text-transform-none mb-0 text-white">Sunglasses</h2>
                        <h3 class="text-white">70% OFF</h3>
                        <h5 class="d-inline-block mb-0">
                            <span class="text-white">Starting At</span>
                            <b class="coupon-sale-text text-white bg-secondary"><sup>$</sup>199<sup>99</sup></b>
                        </h5>
                        <a href="category.html" class="btn btn-dark btn-lg ls-10">Shop Now!</a>
                    </div><!-- End .banner-layer -->
                </div>
            </div>

            <div class="banner banner-2 grid-item">
                <figure>
                    <img src="{{Shop.asset_image(homepage-banner-2)}}" alt="banner">
                </figure>

                <div class="banner-layer banner-layer-middle d-flex align-items-end flex-column">
                    <h3 class="text-white text-right">ELECTRONIC<br>DEALS</h3>

                    <div class="coupon-sale-content">
                        <h4 class="coupon-sale-text bg-white d-block ext-transform-none mr-0 ls-0">Exclusive COUPON</h4>
                        <h5 class="coupon-sale-text text-white ls-0 p-0"><i class="ls-0">UP TO</i><b class="text-dark">$100</b><sub>OFF</sub></h5>
                        <a href="#" class="btn btn-block btn-lg ls-10 text-white btn-dark">Get Yours!</a>
                    </div>
                </div>
            </div>
            <div class="banner banner-2 grid-item">
                <figure>
                    <img src="{{Shop.asset_image(homepage-banner-3)}}" alt="banner">
                </figure>

                <div class="banner-layer banner-layer-middle text-right">
                    <h2 class="m-b-2 text-secondary ls-n-20 font1">FLASH SALE</h2>
                    <h3 class="m-b-2 ls-n-20">TOP BRANDS<br>SUMMER SUNGLASSES</h3>
                    <h4 class="text-white ls-n-20 mb-3">STARTING<br>AT <sup>$</sup>199<sup>99</sup></h4>
                    <a href="#" class="btn btn-light ls-5 btn-lg">VIEW SALE</a>
                </div>
            </div>



            <div class="grid-col-sizer p-0"></div>
        </div>
    </section><!-- End .banner-section -->


    


    <section class="section-4 top-collection appear-animate">
        <h2 class="section-title text-center">TOP BRANDS COLLECTION</h2>

        <div class="container">
            <div class="products-slider owl-carousel owl-theme" data-owl-options="{
						'items': 2,
						'margin': 2,
						'dots': false,
						'responsive': {
							'1200': {
								'items': 5
							}
						}
					}">
                <div class="product-default" tpleach="Shop.products(top-brands-collection,limit:8)" set="product">
                    <figure>
                        <a href="{{product->link}}">
                            <img src="" alt="product" tplimage="product->imagepath" width="278" height="278">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h2 class="product-title">
                            <a href="{{product->link}}">{{product->title}}</a>
                        </h2>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width: 0%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top">0</span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">{{Formats.moneyFormat($product->price)}}</span>
                        </div><!-- End .price-box -->

                        <div class="product-action">
                            <button onclick="window.location.href ='{{product->cartlink}}'" class="btn-icon btn-add-cart">Add To Cart</button>
                        </div>
                    </div><!-- End .product-details -->
                </div><!-- End .product-default -->
            </div>
        </div>
    </section><!-- End .top-collection -->




    <section class="section-2 banner-section appear-animate">
        <div class="banners-grid grid">
            <div class="banner banner-1 grid-item">
                <figure>
                    <img src="{{Shop.asset_image(homepage-banner-4)}}" alt="banner">
                </figure>

                <div class="banner-layer banner-layer-middle text-right">
                    <div class="banner-layer banner-layer-middle">
                        <h4 class="text-transform-none text-white">Find the Boundaries. Push Through!</h4>
                        <h2 class="text-transform-none mb-0 text-white">Sunglasses</h2>
                        <h3 class="text-white">70% OFF</h3>
                        <h5 class="d-inline-block mb-0">
                            <span class="text-white">Starting At</span>
                            <b class="coupon-sale-text text-white bg-secondary"><sup>$</sup>199<sup>99</sup></b>
                        </h5>
                        <a href="category.html" class="btn btn-dark btn-lg ls-10">Shop Now!</a>
                    </div><!-- End .banner-layer -->
                </div>
            </div>

            <div class="banner banner-2 grid-item">
                <figure>
                    <img src="{{Shop.asset_image(homepage-banner-5)}}" alt="banner">
                </figure>

                <div class="banner-layer banner-layer-middle d-flex align-items-start flex-column">
                    <h3 class="text-white">ELECTRONIC<br>DEALS</h3>

                    <div class="coupon-sale-content">
                        <h4 class="coupon-sale-text bg-white d-block ext-transform-none mr-0 ls-0">Exclusive COUPON</h4>
                        <h5 class="coupon-sale-text text-white ls-0 p-0"><i class="ls-0">UP TO</i><b class="text-dark">$100</b><sub>OFF</sub></h5>
                        <a href="#" class="btn btn-block btn-lg ls-10 text-white btn-dark">Get Yours!</a>
                    </div>
                </div>
            </div>

            <div class="banner banner-3 grid-item">
                <figure>
                    <img src="{{Shop.asset_image(homepage-banner-6)}}" alt="banner">
                </figure>

                <div class="banner-layer text-center" style="bottom: 20%">
                    <h4 class="heading-border">AMAZING</h4>
                    <h3>COLLECTION</h3>
                    <hr class="mb-1 mt-1">
                    <h4 class="sub-title">CHECK OUR DISCOUNTS</h4>
                </div>

                <div class="banner-layer banner-layer-bottom d-flex justify-content-center">
                    <a href="#" class="btn btn-dark ls-10 btn-lg">Shop Now!</a>
                </div>
            </div>

            <div class="banner banner-4 grid-item">
                <figure>
                    <img src="{{Shop.asset_image(homepage-banner-7)}}" alt="banner">
                </figure>

                <div class="banner-layer banner-layer-middle d-flex justify-content-between flex-wrap">
                    <div class="banner-layer-left">
                        <h2 class="text-white">Outlet Selected Items</h2>
                        <h4 class="text-white ls-0"><b>BIG SALE UP TO</b></h4>
                    </div>

                    <div class="banner-layer-right">
                        <h3 class="text-white mb-0">80%<small class="d-inline-block text-center"><b>OFF</b></small></h3>
                    </div>
                </div>
            </div>
            <div class="grid-col-sizer p-0"></div>
        </div>
    </section><!-- End .banner-section -->



    <section class="section-5 sale-collection appear-animate">
        <h2 class="section-title text-center">SUMMER SALE - UP TO 70%</h2>

        <div class="container">
            <div class="products-slider owl-carousel owl-theme" data-owl-options="{
						'items': 2,
						'margin': 2,
						'dots': false,
						'responsive': {
							'1200': {
								'items': 5
							}
						}
					}">
                <div class="product-default" tpleach="Shop.products(exclusive-collection, limit:8)" set="product">
                    <figure>
                        <a href="{{product->link}}">
                            <img src="" alt="product" tplimage="product->imagepath" width="278" height="278">
                        </a>
                        <!--
                        <div class="label-group">
                            <span class="product-label label-sale">-15%</span>
                        </div>
                        -->
                    </figure>

                    <div class="product-details">
                        <h2 class="product-title">
                            <a href="{{product->link}}">{{product->title}}</a>
                        </h2>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width: {{Formats.mul(20, $product->rating)}}%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->

                        <div class="price-box">
                            <span class="old-price">{{Formats.moneyFormat($product->compare_price)}}</span>
                            <span class="product-price">{{Formats.moneyFormat($product->price)}}</span>
                        </div><!-- End .price-box -->

                        <div class="product-action">
                            <button onclick="window.location.href ='{{product->cartlink}}'" class="btn-icon btn-add-cart"><i class="icon-bag"></i>ADD TO CART</button>
                        </div>
                    </div><!-- End .product-details -->
                </div><!-- End .product-default -->

            </div>
        </div>
    </section><!-- End .sale-collection -->


</main><!-- End .main -->
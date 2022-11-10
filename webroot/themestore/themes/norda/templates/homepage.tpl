

<div class="slider-area">
    <div class="hero-slider-active-1 nav-style-1 dot-style-2 dot-style-2-position-2 dot-style-2-active-black">
        <div class="single-hero-slider single-animation-wrap slider-height-2 custom-d-flex custom-align-item-center bg-img hm2-slider-bg res-white-overly-xs" style="background-image:url('{{Shop.asset_image(slider-1)}}');">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-slider-content-4 slider-animated-1">
                            <h4 class="animated">Lookbook</h4>
                            <h1 class="animated">Denim Mixed <br>Layering Combine <br>collect</h1>
                            <p class="animated">We love seeing how our Raifa wearers like to wear their Norda</p>
                            <div class="btn-style-1">
                                <a class="animated btn-1-padding-1" href="product-details.html">Explore Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-hero-slider single-animation-wrap slider-height-2 custom-d-flex custom-align-item-center bg-img hm2-slider-bg res-white-overly-xs " style="background-image:url({{Shop.asset_image(slider-2)}});">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-slider-content-4 slider-animated-1">
                            <h4 class="animated">Lookbook</h4>
                            <h1 class="animated">Denim Mixed <br>Layering Combine <br>collect</h1>
                            <p class="animated">We love seeing how our Raifa wearers like to wear their Norda</p>
                            <div class="btn-style-1">
                                <a class="animated btn-1-padding-1" href="product-details.html">Explore Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-area pt-115 pb-80">
    <div class="container">
        <div class="section-title-tab-wrap mb-55">
            <div class="section-title-4">
                <h2>New Arrivals</h2>
            </div>
            <div class="tab-btn-wrap-2">
                <div class="tab-style-5 nav">
                    <a class="active" href="#product-all" data-toggle="tab">All </a>
                    <a href="#clothing" data-toggle="tab"> Clothing </a>
                    <a href="#bags" data-toggle="tab">Bags </a>
                    <a href="#shoes" data-toggle="tab"> Shoes</a>
                    <a href="#accessories" data-toggle="tab"> Accessories</a>
                </div>
                <div class="btn-style-6 ml-60">
                    <a href="collection">All Product</a>
                </div>
            </div>
        </div>
        <div class="tab-content jump">
            <div id="product-all" class="tab-pane active">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12" tpleach="Shop.products(all, limit:8)" set="product">
                        <div class="single-product-wrap mb-35">
                            <div class="product-img product-img-zoom mb-15">
                                <a href="product-details.html" tplvar="product->link">
                                    <img src="images/product/product-13.jpg" alt="" tplimage="product->image" width="270" height="324">
                                </a>
                            </div>

                            <div class="product-content-wrap-2 text-center">
                                <div class="product-rating-wrap">
                                    <div class="product-rating review" tplvar="product->rating" set="review">
                                    </div>
                                    <span>(<tpl tplvar="product->ratingTotal"></tpl>)</span>
                                </div>
                                <h3><a href="product-details.html" tplvar="product->link"><span tplvar="product->title"></span></a></h3>
                                <div class="product-price-2">
                                    <span tplvar="product->price">$20.50</span>
                                </div>
                            </div>
                            <div class="product-content-wrap-2 product-content-position text-center">
                                <div class="product-rating-wrap">
                                    <div class="product-rating review" tplvar="product->rating" set="review">

                                    </div>
                                    <span>(<tpl tplvar="product->ratingTotal"></tpl>)</span>
                                </div>
                                <h3><a href="product-details.html" tplvar="product->link"><span tplvar="product->title"></span></a></h3>
                                <div class="product-price-2">
                                    <span tplvar="product->price"></span>
                                </div>
                                <div class="pro-add-to-cart">
                                    <a href="{{ product->cartlink }}"><button title="Add to Cart">Add To Cart</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="clothing" class="tab-pane">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12" tpleach="Shop.products(clothing, new_arrival:30, limit:8)" set="product">
                        <div class="single-product-wrap mb-35">
                            <div class="product-img product-img-zoom mb-15">
                                <a href="product-details.html" tplvar="product->link">
                                    <img src="images/product/product-13.jpg" alt="" tplimage="product->image" width="270" height="324">
                                </a>
                            </div>

                            <div class="product-content-wrap-2 text-center">
                                <div class="product-rating-wrap">
                                    <div class="product-rating review" tplvar="product->rating" set="review">
                                    </div>
                                    <span>(<tpl tplvar="product->ratingTotal"></tpl>)</span>
                                </div>
                                <h3><a href="product-details.html" tplvar="product->link"><span tplvar="product->title"></span></a></h3>
                                <div class="product-price-2">
                                    <span tplvar="product->price">$20.50</span>
                                </div>
                            </div>
                            <div class="product-content-wrap-2 product-content-position text-center">
                                <div class="product-rating-wrap">
                                    <div class="product-rating review" tplvar="product->rating" set="review">

                                    </div>
                                    <span>(<tpl tplvar="product->ratingTotal"></tpl>)</span>
                                </div>
                                <h3><a href="product-details.html" tplvar="product->link"><span tplvar="product->title"></span></a></h3>
                                <div class="product-price-2">
                                    <span tplvar="product->price"></span>
                                </div>
                                <div class="pro-add-to-cart">
                                    <a href="{{ product->cartlink }}"><button title="Add to Cart">Add To Cart</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="bags" class="tab-pane">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12" tpleach="Shop.products(bags, new_arrival:30, limit:8)" set="product">
                        <div class="single-product-wrap mb-35">
                            <div class="product-img product-img-zoom mb-15">
                                <a href="product-details.html" tplvar="product->link">
                                    <img src="images/product/product-13.jpg" alt="" tplimage="product->image" width="270" height="324">
                                </a>
                            </div>

                            <div class="product-content-wrap-2 text-center">
                                <div class="product-rating-wrap">
                                    <div class="product-rating review" tplvar="product->rating" set="review">
                                    </div>
                                    <span>(<tpl tplvar="product->ratingTotal"></tpl>)</span>
                                </div>
                                <h3><a href="product-details.html" tplvar="product->link"><span tplvar="product->title"></span></a></h3>
                                <div class="product-price-2">
                                    <span tplvar="product->price">$20.50</span>
                                </div>
                            </div>
                            <div class="product-content-wrap-2 product-content-position text-center">
                                <div class="product-rating-wrap">
                                    <div class="product-rating review" tplvar="product->rating" set="review">

                                    </div>
                                    <span>(<tpl tplvar="product->ratingTotal"></tpl>)</span>
                                </div>
                                <h3><a href="product-details.html" tplvar="product->link"><span tplvar="product->title"></span></a></h3>
                                <div class="product-price-2">
                                    <span tplvar="product->price"></span>
                                </div>
                                <div class="pro-add-to-cart">
                                    <a href="{{ product->cartlink }}"><button title="Add to Cart">Add To Cart</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="shoes" class="tab-pane">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12" tpleach="Shop.products(shoes, new_arrival:30, limit:8)" set="product">
                        <div class="single-product-wrap mb-35">
                            <div class="product-img product-img-zoom mb-15">
                                <a href="product-details.html" tplvar="product->link">
                                    <img src="images/product/product-13.jpg" alt="" tplimage="product->image" width="270" height="324">
                                </a>
                            </div>

                            <div class="product-content-wrap-2 text-center">
                                <div class="product-rating-wrap">
                                    <div class="product-rating review" tplvar="product->rating" set="review">
                                    </div>
                                    <span>(<tpl tplvar="product->ratingTotal"></tpl>)</span>
                                </div>
                                <h3><a href="product-details.html" tplvar="product->link"><span tplvar="product->title"></span></a></h3>
                                <div class="product-price-2">
                                    <span tplvar="product->price">$20.50</span>
                                </div>
                            </div>
                            <div class="product-content-wrap-2 product-content-position text-center">
                                <div class="product-rating-wrap">
                                    <div class="product-rating review" tplvar="product->rating" set="review">

                                    </div>
                                    <span>(<tpl tplvar="product->ratingTotal"></tpl>)</span>
                                </div>
                                <h3><a href="product-details.html" tplvar="product->link"><span tplvar="product->title"></span></a></h3>
                                <div class="product-price-2">
                                    <span tplvar="product->price"></span>
                                </div>
                                <div class="pro-add-to-cart">
                                    <a href="{{ product->cartlink }}"><button title="Add to Cart">Add To Cart</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="accessories" class="tab-pane">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12" tpleach="Shop.products(accessories, new_arrival:30, limit:8)" set="product">
                        <div class="single-product-wrap mb-35">
                            <div class="product-img product-img-zoom mb-15">
                                <a href="product-details.html" tplvar="product->link">
                                    <img src="images/product/product-13.jpg" alt="" tplimage="product->image" width="270" height="324">
                                </a>
                            </div>

                            <div class="product-content-wrap-2 text-center">
                                <div class="product-rating-wrap">
                                    <div class="product-rating review" tplvar="product->rating" set="review">
                                    </div>
                                    <span>(<tpl tplvar="product->ratingTotal"></tpl>)</span>
                                </div>
                                <h3><a href="product-details.html" tplvar="product->link"><span tplvar="product->title"></span></a></h3>
                                <div class="product-price-2">
                                    <span tplvar="product->price">$20.50</span>
                                </div>
                            </div>
                            <div class="product-content-wrap-2 product-content-position text-center">
                                <div class="product-rating-wrap">
                                    <div class="product-rating review" tplvar="product->rating" set="review">

                                    </div>
                                    <span>(<tpl tplvar="product->ratingTotal"></tpl>)</span>
                                </div>
                                <h3><a href="product-details.html" tplvar="product->link"><span tplvar="product->title"></span></a></h3>
                                <div class="product-price-2">
                                    <span tplvar="product->price"></span>
                                </div>
                                <div class="pro-add-to-cart">
                                    <a href="{{ product->cartlink }}"><button title="Add to Cart">Add To Cart</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="banner-area section-padding-2 pb-85">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-wrap mb-30">
                    <div class="banner-img banner-img-zoom">
                        <a href="collection"><img src="{{Shop.asset_image(home-page-flash-image-1)}}" alt=""></a>
                    </div>
                    <div class="banner-content-9">
                        <span>new arrivals <br>women</span>
                        <h2>Minimalist <br>Blazer</h2>
                        <p>A collection in minilaist style for basic blazer</p>
                        <div class="btn-style-1">
                            <a class="btn-1-padding-3 bg-white banner-btn-res" href="collection">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-wrap mb-30">
                    <div class="banner-img banner-img-zoom">
                        <a href="collection"><img src="{{Shop.asset_image(home-page-flash-image-2)}}" alt=""></a>
                    </div>
                    <div class="banner-content-10">
                        <span>mega sale</span>
                        <h2><span>50%</span> OFF <br>for Autumn</h2>
                        <p>Backpack BYORK, don’t miss out in this mage sale</p>
                        <div class="btn-style-1">
                            <a class="btn-1-padding-3 bg-white banner-btn-res" href="collection">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="stricky-header stricked-menu main-menu">
    <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
</div><!-- /.stricky-header -->


<section class="main-slider">
    <div class="swiper-container thm-swiper__slider" data-swiper-options='{
"slidesPerView": 1,
"loop": true,
"effect": "fade",
"autoplay": {
"delay": 5000
},
"navigation": {
"nextEl": "#main-slider__swiper-button-next",
"prevEl": "#main-slider__swiper-button-prev"
}
}'>
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="image-layer" style="background-image: url({{ Shop.asset_image(slider-1) }});">
                </div>
                <!-- /.image-layer -->
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 text-center">

                            <!-- /.thm-btn dynamic-radius -->
                        </div><!-- /.col-lg-7 text-right -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.swiper-slide -->
            <div class="swiper-slide">
                <div class="image-layer" style="background-image: url({{ Shop.asset_image(slider-2) }});">
                </div>
                <!-- /.image-layer -->
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 text-center">
                            <!--  <h2><span>Oragnic</span> <br>
                                Food Market</h2>
                            <a href="products.html" class=" thm-btn">Order Now</a> -->
                            <!-- /.thm-btn dynamic-radius -->
                        </div><!-- /.col-lg-7 text-right -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.swiper-slide -->
        </div><!-- /.swiper-wrapper -->

        <!-- If we need navigation buttons -->
        <div class="main-slider__nav">
            <div class="swiper-button-prev" id="main-slider__swiper-button-next"><i class="organik-icon-left-arrow"></i>
            </div>
            <div class="swiper-button-next" id="main-slider__swiper-button-prev"><i
                    class="organik-icon-right-arrow"></i></div>
        </div><!-- /.main-slider__nav -->

    </div><!-- /.swiper-container thm-swiper__slider -->
</section><!-- /.main-slider -->

<section class="feature-box">
    <div class="container">
        <div class="inner-container wow fadeInUp" data-wow-duration="1500ms">
            <div class="thm-tiny__slider" id="contact-infos-box" data-tiny-options='{
    "container": "#contact-infos-box",
    "items": 1,
    "slideBy": "page",
    "gutter": 0,
    "mouseDrag": true,
    "autoplay": true,
    "nav": false,
    "controlsPosition": "bottom",
    "controlsText": ["<i class=\"fa fa-angle-left\"></i>", "<i class=\"fa fa-angle-right\"></i>"],
    "autoplayButtonOutput": false,
    "responsive": {
        "640": {
          "items": 2,
          "gutter": 30
        },
        "992": {
          "gutter": 30,
          "items": 3
        },
        "1200": {
          "disable": true
        }
      }
}'>
                <div>
                    <div class="feature-box__single">
                        <i class="organik-icon-global-shipping feature-box__icon"></i>
                        <div class="feature-box__content">
                            <h3>Return Policy</h3>
                            <p>Money back guarantee</p>
                        </div><!-- /.feature-box__content -->
                    </div><!-- /.feature-box__single -->
                </div>
                <div>
                    <div class="feature-box__single">
                        <i class="organik-icon-delivery-truck feature-box__icon"></i>
                        <div class="feature-box__content">
                            <h3>Free Shipping</h3>
                            <p>On all orders over $25.00</p>
                        </div><!-- /.feature-box__content -->
                    </div><!-- /.feature-box__single -->
                </div>
                <div>
                    <div class="feature-box__single">
                        <i class="organik-icon-online-store feature-box__icon"></i>
                        <div class="feature-box__content">
                            <h3>Store Locator</h3>
                            <p>Find your nearest store</p>
                        </div><!-- /.feature-box__content -->
                    </div><!-- /.feature-box__single -->
                </div>
            </div>
        </div><!-- /.inner-container -->
    </div><!-- /.container -->
</section><!-- /.feature-box -->

<section class="new-products">
    <img src="{{cdn_root}}images/shapes/new-product-shape-1.png" alt="" class="new-products__shape-1">
    <div class="container">
        <div class="new-products__top">
            <div class="block-title ">
                <div class="block-title__decor"></div><!-- /.block-title__decor -->
                <p>Recently Added</p>
                <h3>New Products</h3>
            </div><!-- /.block-title -->

            <ul class="post-filter filters list-unstyled">
                <li class="active filter" data-filter=".filter-item">All</li>
                <li class="filter" data-filter=".dairy">Dairy</li>
                <li class="filter" data-filter=".pantry">Pantry
                </li>
                <li class="filter" data-filter=".meat">Meat
                </li>
                <li class="filter" data-filter=".fruits">Fruits
                </li>
                <li class="filter" data-filter=".veg">Vagetables
                </li>
            </ul>
        </div><!-- /.new-products__top -->
        <div class="row filter-layout">
            <div class="col-lg-4 col-md-6 filter-item dairy" tpleach="shop.products(all)" set="product">
                <div class="product-card__two">
                    <div class="product-card__two-image">
                        <span class="product-card__two-sale">sale</span>
                        <img src="images/products/product-2-1.jpg" alt="" tplimage="product->image" width="270"
                            height="283">
                        <div class="product-card__two-image-content">
                            <a href="{{ product->link }}"><i class="organik-icon-visibility"></i></a>

                            <a href="{{ product->cartlink }}"><i class="organik-icon-shopping-cart"></i></a>
                        </div><!-- /.product-card__two-image-content -->
                    </div><!-- /.product-card__two-image -->
                    <div class="product-card__two-content">
                        <h3><a href="product-details.html">{{ product->title}}</a></h3>

                        <div class="product-card__two-stars" data-rating-stars="5" data-rating-readonly="true"
                            data-rating-value="{{ product->rating }}"></div>
                        <p>{{ Formats.moneyFormat($product->price)}}</p>
                    </div><!-- /.product-card__two-content -->
                </div><!-- /.product-card__two -->
            </div><!-- /.col-lg-4 -->

        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.new-products -->

<section class="offer-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-6 wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                <div class="offer-banner__box"
                    style="background-image: url({{cdn_root}}images/resources/offer-banner-1-1.jpg);">
                    <div class="offer-banner__content">
                        <h3><span>100%</span> <br>Organic</h3>
                        <p>Quality Organic Food Store</p>
                        <a href="products.html" class="thm-btn">Order Now</a><!-- /.thm-btn -->
                    </div><!-- /.offer-banner__content -->
                </div><!-- /.offer-banner__box -->
            </div><!-- /.col-md-6 -->
            <div class="col-md-6 wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="100ms">
                <div class="offer-banner__box"
                    style="background-image: url({{cdn_root}}images/resources/offer-banner-1-2.jpg);">
                    <div class="offer-banner__content">
                        <h3><span>100%</span> <br>Organic</h3>
                        <p>Quality Organic Food Store</p>
                        <a href="products.html" class="thm-btn">Order Now</a><!-- /.thm-btn -->
                    </div><!-- /.offer-banner__content -->
                </div><!-- /.offer-banner__box -->
            </div><!-- /.col-md-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.offer-banner -->

<section class="funfact-one jarallax" data-jarallax data-speed="0.3" data-imgPosition="50% 50%">
    <img src="{{cdn_root}}images/backgrounds/funfact-bg-1-1.jpg" class="jarallax-img" alt="">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-6 col-lg-3  wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
                <div class="funfact-one__single">
                    <h3 class="odometer" data-count="8080">00</h3>
                    <p>Organic Products Available</p>
                </div><!-- /.funfact-one__single -->
            </div><!-- /.col-md-6 col-lg-3 -->
            <div class="col-md-6 col-lg-3  wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="100ms">
                <div class="funfact-one__single">
                    <h3 class="odometer" data-count="697">00</h3>
                    <p>Healthy Recipes</p>
                </div><!-- /.funfact-one__single -->
            </div><!-- /.col-md-6 col-lg-3 -->
            <div class="col-md-6 col-lg-3  wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="200ms">
                <div class="funfact-one__single">
                    <h3 class="odometer" data-count="440">00</h3>
                    <p>Expert Team Mebers</p>
                </div><!-- /.funfact-one__single -->
            </div><!-- /.col-md-6 col-lg-3 -->
            <div class="col-md-6 col-lg-3  wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="300ms">
                <div class="funfact-one__single">
                    <h3 class="odometer" data-count="2870">00</h3>
                    <p>Satisfied Customers</p>
                </div><!-- /.funfact-one__single -->
            </div><!-- /.col-md-6 col-lg-3 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.funfact-one -->


<section class="testimonials-one">
    <div class="testimonials-one__head">
        <div class="container">
            <div class="block-title text-center">
                <div class="block-title__decor"></div><!-- /.block-title__decor -->
                <p>Our Testimonials</p>
                <h3>What People Say?</h3>
            </div><!-- /.block-title -->
        </div><!-- /.container -->
    </div><!-- /.testimonials-one__head -->
    <div class="container">
        <div class="thm-tiny__slider" id="testimonials-one-box" data-tiny-options='{
    "container": "#testimonials-one-box",
    "items": 1,
    "slideBy": "page",
    "gutter": 0,
    "mouseDrag": true,
    "autoplay": true,
    "nav": false,
    "controlsPosition": "bottom",
    "controlsText": ["<i class=\"fa fa-angle-left\"></i>", "<i class=\"fa fa-angle-right\"></i>"],
    "autoplayButtonOutput": false,
    "responsive": {
        "640": {
          "items": 2,
          "gutter": 30
        },
        "992": {
          "gutter": 30,
          "items": 3
        },
        "1200": {
          "disable": true
        }
      }
}'>
            <div>
                <div class="testimonials-one__single">
                    <div class="testimonials-one__image">
                        <img src="{{cdn_root}}images/resources/testi-1-1.png" alt="">
                    </div><!-- /.testimonials-one__image -->
                    <div class="testimonials-one__content">
                        <p>I was very impresed by the osfins service lorem ipsum is simply free text used by copy typing
                            refreshing. Neque porro est qui dolorem ipsum.</p>
                        <h3>Winnie Collier</h3>
                        <span>Customer</span>
                    </div><!-- /.testimonials-one__content -->
                </div><!-- /.testimonials-one__single -->
            </div>
            <div>
                <div class="testimonials-one__single">
                    <div class="testimonials-one__image">
                        <img src="{{cdn_root}}images/resources/testi-1-2.png" alt="">
                    </div><!-- /.testimonials-one__image -->
                    <div class="testimonials-one__content">
                        <p>I was very impresed by the osfins service lorem ipsum is simply free text used by copy typing
                            refreshing. Neque porro est qui dolorem ipsum.</p>
                        <h3>Helen Woods</h3>
                        <span>Customer</span>
                    </div><!-- /.testimonials-one__content -->
                </div><!-- /.testimonials-one__single -->
            </div>
            <div>
                <div class="testimonials-one__single">
                    <div class="testimonials-one__image">
                        <img src="{{cdn_root}}images/resources/testi-1-3.png" alt="">
                    </div><!-- /.testimonials-one__image -->
                    <div class="testimonials-one__content">
                        <p>I was very impresed by the osfins service lorem ipsum is simply free text used by copy typing
                            refreshing. Neque porro est qui dolorem ipsum.</p>
                        <h3>Ethan Thomas</h3>
                        <span>Customer</span>
                    </div><!-- /.testimonials-one__content -->
                </div><!-- /.testimonials-one__single -->
            </div>
        </div>
    </div><!-- /.container -->
</section><!-- /.testimonials-one -->
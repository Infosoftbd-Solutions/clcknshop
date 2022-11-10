<div class="stricky-header stricked-menu main-menu">
    <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
</div><!-- /.stricky-header -->
<section class="page-header">
    <div class="page-header__bg"
        style="background-image: url({{ theme_root }}images/backgrounds/slider-vegetables.jpg);"></div>
    <!-- /.page-header__bg -->
    <div class="container">
        <h2>Product</h2>
        <ul class="thm-breadcrumb list-unstyled">
            <li><a href="index.html">Home</a></li>
            <li>/</li>
            <li><span>Product</span></li>
        </ul><!-- /.thm-breadcrumb list-unstyled -->
    </div><!-- /.container -->
</section><!-- /.page-header -->


<section class="product_detail">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="product_detail_image">
                    <img src="assets/images/products/product-d-1.jpg" alt="" tplimage="product->image">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="product_detail_content">
                    <h2>{{ product->title}}</h2>
                    <div class="product_detail_review_box">
                        <div class="product_detail_price_box">
                            <p>{{Formats.moneyFormat($product->price)}}</p>
                        </div>
                        <div class="product_detail_review">
                            <span data-rating-stars="5" data-rating-readonly="true"
                                data-rating-value="{{ product->rating }}"></span>

                            <span>{{product->rating_total}} Customer Reviews</span>
                        </div>
                    </div>
                    <div class="product_detail_text">
                        <p> {{product->overview}}</p>
                    </div>
                    <ul class="list-unstyled product_detail_address">
                        <li>REF. 4231/406</li>
                        <li>Available in store</li>
                    </ul>
                    <form action="add_to_cart" tplform="">
                        {{Formats.printProductHiddenFields($product)}}
                        {{Formats.printProductOptions($product)}}
                        <div class="product-quantity-box">

                            <div class="quantity-box">
                                <button type="button" class="sub">-</button>
                                <input type="number" id="2" value="1" />
                                <button type="button" class="add">+</button>
                            </div>
                            <div class="addto-cart-box">
                                <button class="thm-btn" type="submit">Add to Cart</button>
                            </div>
                            <div class="wishlist_btn">
                                <button class="thm-btn" type="submit" name="action">Buy now</button>
                            </div>


                        </div>
                    </form>
                    <ul class="list-unstyled category_tag_list">
                        <li><span>Category:</span> {{product->product_type}}</li>
                        <li><span>Tags:</span> {{product->tags}}</li>
                    </ul>
                    <div class="product_detail_share_box">
                        <div class="share_box_title">
                            <h2>Share with friends</h2>
                        </div>
                        <div class="share_box_social">
                            <a href="#"><i class="fab fa-facebook-square"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="product-tab-box tabs-box">
                    <ul class="tab-btns tab-buttons clearfix list-unstyled">
                        <li data-tab="#desc" class="tab-btn active-btn"><span>description</span></li>

                        <li data-tab="#review" class="tab-btn "><span>reviews</span></li>
                    </ul>
                    <div class="tabs-content">
                        <div class="tab active-tab" id="desc">
                            <div class="product-details-content">
                                <div class="desc-content-box">
                                    {{product->description}}
                                </div>
                            </div>
                        </div>



                        <div class="tab " id="review">
                            <div class="reviews-box">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="product_reviews_box">
                                            <h3 class="product_reviews_title">2 Product reviews</h3>
                                            <div class="product_reviews_single">
                                                <div class="product_reviews_image">
                                                    <img src="assets/images/products/review-1.jpg" alt="">
                                                </div>
                                                <div class="product_reviews_content">
                                                    <h3>Kevin Martins<span>15 Nov, 2019</span></h3>
                                                    <p>Lorem ipsum is simply free text used by copytyping refreshing.
                                                        Neque porro est qui dolorem ipsum quia quaed inventore veritatis
                                                        et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                                    <div class="product_reviews_rating product_detail_review">
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#" class="deactive"><i class="fa fa-star"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product_reviews_single">
                                                <div class="product_reviews_image">
                                                    <img src="assets/images/products/review-2.jpg" alt="">
                                                </div>
                                                <div class="product_reviews_content">
                                                    <h3>Kevin Martins<span>15 Nov, 2019</span></h3>
                                                    <p>Lorem ipsum is simply free text used by copytyping refreshing.
                                                        Neque porro est qui dolorem ipsum quia quaed inventore veritatis
                                                        et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                                    <div class="product_reviews_rating product_detail_review">
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#" class="deactive"><i class="fa fa-star"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="add_review_box">
                                            <h3 class="add_review_title">Add a review</h3>
                                            <div class="add_review_rating">
                                                <span>Rate this Product?</span>
                                                <span data-rating-stars="5" data-rating-input="#rating"></span>
                                            </div>
                                            <form action="review" class="add_review_form" tplform="">
                                                <input type="hidden" name="product_id" value="{{ product->id }}">
                                                <input type="hidden" name="rating" id="rating">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-box">
                                                            <textarea name="comment" placeholder="Write review"
                                                                required=""></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="review_submit_btn">
                                                            <a href="#" class="thm-btn">Submit Review</a>
                                                        </div>
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
        </div>
    </div>
</section>

<section class="product-two">
    <div class="container">
        <div class="block-title text-center">
            <div class="block-title__decor"></div><!-- /.block-title__decor -->
            <p>Recently Added</p>
            <h3>Similar Products</h3>
        </div><!-- /.block-title -->
        <div class="thm-tiny__slider" id="product-two__carousel" data-tiny-options='{
         "container": "#product-two__carousel",
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
            <div tpleach="Shop.related_products($product->product_type)" set="rproduct">
                <div class="product-card__two">
                    <div class="product-card__two-image">
                        <span class="product-card__two-sale">sale</span>
                        <img src="assets/images/products/product-2-1.jpg" alt="" tplimage="rproduct->image">
                        <div class="product-card__two-image-content">
                            <a href="{{ rproduct->link }}"><i class="organik-icon-visibility"></i></a>

                            <a href="{{ rproduct->cartlink }}"><i class="organik-icon-shopping-cart"></i></a>
                        </div><!-- /.product-card__two-image-content -->
                    </div><!-- /.product-card__two-image -->
                    <div class="product-card__two-content">
                        <h3><a href="product-details.html">{{ rproduct->title }}</a></h3>
                        <div class="product-card__two-stars" data-rating-stars="5" data-rating-readonly="true"
                            data-rating-value="{{ rproduct->rating }}"></div>
                        <!-- /.product-card__two-stars -->
                        <p>{{Formats.moneyFormat($product->price)}}</p>

                    </div><!-- /.product-card__two-content -->
                </div><!-- /.product-card__two -->
            </div>

        </div>
    </div><!-- /.container -->
</section><!-- /.product-two -->
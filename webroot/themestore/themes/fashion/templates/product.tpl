

<main class="main">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="/collection/all?product_type={{product->product_type}}">{{product->product_type}}</a></li>
            </ol>
        </nav>
        <div class="product-single-container product-single-default">
            <div class="row">
                <div class="col-md-5 product-single-gallery">
                    <div class="product-slider-container">
                        <div class="product-single-carousel owl-carousel owl-theme">
                            <div class="product-item" tpleach="product->product_media">
                                <img class="product-single-image" src="" tplimage="val->image" data-zoom-image="/{{val->image}}"/>
                            </div>
                        </div>
                        <!-- End .product-single-carousel -->
                        <span class="prod-full-screen">
									<i class="icon-plus"></i>
								</span>
                    </div>
                    <div class="prod-thumbnail owl-dots" id='carousel-custom-dots'>
                        <div class="owl-dot col-3" tpleach="product->product_media">
                            <img width="90" tplimage="val->image" src=""/>
                        </div>
                    </div>
                </div><!-- End .product-single-gallery -->

                <div class="col-md-7 product-single-details">
                    <h1 class="product-title">{{ product->title}}</h1>

                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:{{Formats.mul(20, $product->rating)}}%"></span><!-- End .ratings -->
                        </div><!-- End .product-ratings -->

                        <a href="#product-reviews-content" class="rating-link">(<tpl tplvar="product->ratingTotal"></tpl> reviews)</a>
                    </div><!-- End .ratings-container -->

                    <hr class="short-divider">


                    <div class="price-box">
                        <span class="old-price">{{Formats.moneyFormat($product->compare_price)}}</span>
                        <span class="product-price">{{Formats.moneyFormat($product->price)}}</span>
                    </div><!-- End .price-box -->

                    <div class="product-desc">
                        <p>
                            {{product->overview}}
                        </p>
                    </div><!-- End .product-desc -->

                    <form action="add_to_cart" tplform="">
                        {{Formats.printProductHiddenFields($product)}}
                        {{Formats.printProductOptions($product)}}

                        <div class="product-filters-container" tpleach="product->product_options" set="option">
                            <div class="product-single-filter mb-2">
                                <label>{{ option->option_name }}:</label>
                                <ul class="config-size-list">
                                    <li tpleach="Formats.split($option->option_values)" set="option_value"><a href="javascript:void(0)" class="option_selected" data-name="{{ option->option_name }}"   data-value="{{ option_value }}">{{ option_value }}</a></li> <!--class="active" -->
                                </ul>
                            </div><!-- End .product-single-filter -->
                        </div><!-- End .product-filters-container -->
                        <hr class="divider">

                    <div class="product-action">
                        <div class="product-single-qty">
                            <input name="quantity" class="horizontal-quantity form-control" type="text">
                        </div><!-- End .product-single-qty -->

                        <button class="btn btn-dark add-cart icon-shopping-cart" title="Add to Cart">Add to Cart</button>
                    </div><!-- End .product-action -->

                    </form>

                    <hr class="divider mb-1">

                    <div class="product-single-share">
                        <label class="sr-only">Share:</label>

                        <div class="social-icons mr-2">
                            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                            <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank" title="Linkedin"></a>
                            <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank" title="Google +"></a>
                            <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank" title="Mail"></a>
                        </div><!-- End .social-icons -->

                    </div><!-- End .product single-share -->
                </div><!-- End .product-single-details -->
            </div><!-- End .row -->
        </div><!-- End .product-single-container -->

        <div class="product-single-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews (<tpl tplvar="product->ratingTotal"></tpl>)</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                    <div class="product-desc-content">
                        {{ product->description }}
                    </div><!-- End .product-desc-content -->
                </div><!-- End .tab-pane -->



                <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                    <div class="product-reviews-content">
                        <div class="row">
                            <div class="col-xl-7">
                                <h2 class="reviews-title">{{ product->ratingTotal }} reviews for {{product->title}}</h2>

                                <ol class="comment-list">
                                    <li class="comment-container" tpleach="product->reviews" set="review">
                                        <!--<div class="comment-avatar" style="width: 95px">
                                            <img src="images/avatar/avatar1.jpg" width="65" height="65" alt="avatar"/>
                                        </div>--><!-- End .comment-avatar-->

                                        <div class="comment-box">
                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:{{Formats.mul(20, $review->rating)}}%"></span><!-- End .ratings -->
                                                </div><!-- End .product-ratings -->
                                            </div><!-- End .ratings-container -->

                                            <div class="comment-info mb-1">
                                                <h4 class="avatar-name">{{ review->customer->first_name }} {{ review->customer->last_name }}</h4> - <span class="comment-date">{{ review->created }}</span>
                                            </div><!-- End .comment-info -->

                                            <div class="comment-text">
                                                <p>{{ review->comment }}</p>
                                            </div><!-- End .comment-text -->
                                        </div><!-- End .comment-box -->
                                    </li><!-- comment-container -->
                                </ol><!-- End .comment-list -->
                            </div>

                            <div class="col-xl-5">
                                <div class="" tpluser="0">
                                    <h5>You must be <a href="login"><b class="text-danger">login</b></a> to Review</h5>
                                </div>

                                <div class="add-product-review" tpluser="1">
                                    <form action="review" class="comment-form m-0" tplform="">
                                        <h3 class="review-title">Add a Review</h3>
                                        <input type="hidden" name="product_id" value="{{ product->id }}">

                                        <div class="rating-form">
                                            <label for="rating">Your rating</label>
                                            <span class="rating-stars">
														<a class="star-1" href="#">1</a>
														<a class="star-2" href="#">2</a>
														<a class="star-3" href="#">3</a>
														<a class="star-4" href="#">4</a>
														<a class="star-5" href="#">5</a>
													</span>

                                            <select name="rating" id="rating" required="" style="display: none;">
                                                <option value="">Rate…</option>
                                                <option value="5">Perfect</option>
                                                <option value="4">Good</option>
                                                <option value="3">Average</option>
                                                <option value="2">Not that bad</option>
                                                <option value="1">Very poor</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Your Review</label>
                                            <textarea cols="5" rows="6" name="comment" class="form-control form-control-sm"></textarea>
                                        </div><!-- End .form-group -->

                                        <input type="submit" class="btn btn-dark ls-n-15" value="Submit">
                                    </form>
                                </div><!-- End .add-product-review -->
                            </div>
                        </div>
                    </div><!-- End .product-reviews-content -->
                </div><!-- End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .product-single-tabs -->

        <div class="products-section pt-0">
            <h2 class="section-title">Related Products</h2>

            <div class="products-slider owl-carousel owl-theme dots-top">
                <div class="product-default inner-quickview inner-icon" tpleach="Shop.products(all, product_type:$product->product_type, limit:2)">
                    <figure>
                        <a href="{{ val->link }}">
                            <img src="images/products/product-14.jpg" tplimage="val->imagepath"  width="280" height="280">
                        </a>
                      <!--  <div class="btn-icon-group">
                            <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
                        </div> -->
                        <!--<a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a> -->
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
                                <a href="category.html" class="product-category">{{ val->product_type }}</a>
                            </div>
                        </div>
                        <h3 class="product-title">
                            <a href="{{ val->link }}">{{ val->title }}</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:{{ val->rating }}%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .ratings-container -->
                        <div class="price-box">
                            <span class="old-price">{{ Formats.moneyFormat($val->compire_price) }}</span>
                            <span class="product-price">{{ Formats.moneyFormat($val->price) }}</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div><!-- End .products-slider -->
        </div><!-- End .products-section -->
    </div><!-- End .container -->
</main><!-- End .main -->

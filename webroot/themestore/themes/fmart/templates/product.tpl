<style>
    #variant-form ul {
        display: inline-block;
    }

    #variant-form ul li {
        display: inline-block;
        border: 1px solid #f2f2f2;
        margin: auto 5px;
        padding: 10px;
    }

    #variant-form ul li:hover {
        background-color: #108bea;
        cursor: pointer;
    }

    #variant-form ul li:hover a {
        color: #fff;
    }

    #variant-form ul .active {
        background-color: #108bea;
    }

    #variant-form ul .active a {
        color: #fff;
    }

    .add_review_rating i {
        font-size: 16px !important;
    }
</style>



<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li><a href="#">Clothing</a></li>
                <li class='active'>{{product->title}}</li>
            </ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row single-product'>

            <div class='col-md-12'>
                <div class="detail-block">
                    <div class="row  wow fadeInUp">
                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">
                                <div id="owl-single-product">
                                    <div class="single-product-gallery-item" id="slide{{key}}"
                                        tpleach="product->product_media" set="media">
                                        <a href="javascript::void(0)">
                                            <img class="img-responsive" alt="" src="images/blank.gif"
                                                data-echo="/image?src={{media->imagepath}}&size=371x371" height="317px" width="317px" />
                                        </a>
                                    </div>
                                    <!-- /.single-product-gallery-item -->
                                </div>
                                <!-- /.single-product-slider -->
                                <div class="single-product-gallery-thumbs gallery-thumbs">
                                    <div id="owl-single-product-thumbnails">
                                        <div class="item" tpleach="product->product_media" set="media">
                                            <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="1"
                                                href="#slide{{key}}">
                                                <img class="img-responsive" alt="" src="images/blank.gif"
                                                    data-echo="/image?src={{media->imagepath}}&size=84x85"
                                                    style="width: 85px !important; height: 85px !important;" />
                                            </a>
                                        </div>
                                    </div>
                                    <!-- /#owl-single-product-thumbnails -->
                                </div>
                                <!-- /.gallery-thumbs -->
                            </div>
                            <!-- /.single-product-gallery -->
                        </div>
                        <!-- /.gallery-holder -->
                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
                                <h1 class="name">{{ product->title }}</h1>
                                <div class="rating-reviews m-t-20">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div data-rating-stars="5" data-rating-value="{{ product->rating}}"
                                                data-rating-readonly="true"></div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="reviews">
                                                <a href="#" class="lnk">({{product->rating_total}} Reviews)</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.rating-reviews -->
                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="stock-box">
                                                <span class="label">Availability :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="stock-box">
                                                <span class="value">{{Shop.stock($product->max_stock)}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.stock-container -->
                                <div class="description-container m-t-20">
                                    {{ product->short_description }}
                                </div>
                                <!-- /.description-container -->
                                <div class="price-container info-container m-t-20">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="price-box">
                                                <span class="price"> {{ Formats.moneyFormat($product->price)}} </span>
                                                <span class="price-strike"> {{
                                                    Formats.moneyFormat($product->compare_price) }} </span>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.price-container -->
                                <div class="quantity-container info-container">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form id="variant-form" action="add_to_cart" tplform="">
                                                {{Formats.printProductHiddenFields($product)}}
                                                {{Formats.printProductOptions($product)}}

                                                <div class="product-filters-container"
                                                    tpleach="product->product_options" set="option">
                                                    <div class="product-single-filter mb-2"
                                                        style="margin-bottom: 20px;">
                                                        <span><b>{{ option->option_name }}:</b></span>
                                                        <ul class="config-size-list">
                                                            <li tpleach="Formats.split($option->option_values)"
                                                                set="option_value">
                                                                <a href="javascript:void(0)" class="option_selected"
                                                                    data-name="{{ option->option_name }}"
                                                                    data-value="{{ option_value }}">{{option_value
                                                                    }}</a>
                                                            </li>
                                                            <!--class="active" -->
                                                        </ul>
                                                    </div><!-- End .product-single-filter -->
                                                </div><!-- End .product-filters-container -->

                                                <div class="col-sm-2">
                                                    <span class="label">Qty :</span>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="cart-quantity">
                                                        <div class="quant-input">
                                                            <div class="arrows">
                                                                <div class="arrow plus gradient"><span class="ir"><i
                                                                            class="icon fa fa-sort-asc"></i></span>
                                                                </div>
                                                                <div class="arrow minus gradient"><span class="ir"><i
                                                                            class="icon fa fa-sort-desc"></i></span>
                                                                </div>
                                                            </div>
                                                            <input name="quantity" type="text" value="1">
                                                        </div>
                                                    </div>
                                                </div>


                                                <a href="javascript::void()" class="btn btn-primary"
                                                    onclick="document.getElementById('variant-form').submit()">
                                                    <i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART
                                                </a>
                                            </form>
                                        </div>


                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.quantity-container -->
                            </div>
                            <!-- /.product-info -->
                        </div>
                        <!-- /.col-sm-7 -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                <li><a data-toggle="tab" href="#tags">TAGS</a></li>
                            </ul>
                            <!-- /.nav-tabs #product-tabs -->
                        </div>
                        <div class="col-sm-9">
                            <div class="tab-content">
                                <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                        <p class="text"> {{ product->description }} </p>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div id="review" class="tab-pane">
                                    <div class="product-tab">
                                        <div class="product-reviews">
                                            <h4 class="title">Customer Reviews</h4>
                                            <div class="reviews">
                                                <div class="review" tpleach="product->reviews" set="review">
                                                    <div class="review-title">
                                                        <p style="font-size: 17px;">{{ review->customer->first_name }}
                                                            {{ review->customer->last_name}}</span>
                                                            <span class="date"><i class="fa fa-calendar"></i><span>
                                                                    {{review->created}} </span></span>
                                                    </div>
                                                    <div class="text"> {{ review->comment }}</div>
                                                </div>
                                            </div>
                                            <!-- /.reviews -->
                                        </div>
                                        <!-- /.product-reviews -->
                                        <div class="product-add-review">
                                            <div class="review-form">
                                                <div class="form-container" tpluser="1">
                                                    <form tplform="review" role="form" class="cnt-form">
                                                        <input type="hidden" name="product_id"
                                                            value="{{ product->id }}">
                                                        <input type="hidden" id="rating" required="" name="rating">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="add_review_rating"
                                                                    style=" padding-bottom: 15px;">
                                                                    <span>Rate this Product?</span><br><br>
                                                                    <span data-rating-stars="5"
                                                                        data-rating-input="#rating"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">

                                                                <div class="form-group">
                                                                    <label for="exampleInputReview">Comment <span
                                                                            class="astk">*</span></label>
                                                                    <textarea name="comment" required
                                                                        class="form-control txt txt-review"
                                                                        id="exampleInputReview" rows="4"
                                                                        placeholder=""></textarea>
                                                                </div>
                                                                <!-- /.form-group -->
                                                            </div>
                                                        </div>
                                                        <!-- /.row -->
                                                        <div class="action text-right">
                                                            <button class="btn btn-primary btn-upper">SUBMIT
                                                                REVIEW</button>
                                                        </div>
                                                        <!-- /.action -->
                                                    </form>
                                                    <!-- /.cnt-form -->
                                                </div>
                                                <!-- /.form-container -->
                                            </div>
                                            <!-- /.review-form -->
                                        </div>
                                        <!-- /.product-add-review -->
                                    </div>
                                    <!-- /.product-tab -->
                                </div>
                                <!-- /.tab-pane -->
                                <div id="tags" class="tab-pane">
                                    <div class="product-tag">
                                        <h4 class="title">Product Tags</h4>
                                        <div class="tag-list">
                                            <a class="item" title="{{tag}}" href="collection/all?tag={{tag}}"
                                                tpleach="Formats.split($product->tags)" set="tag">{{tag}}</a>
                                        </div>

                                    </div>
                                    <!-- /.product-tab -->
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.product-tabs -->
                <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">upsell products</h3>
                    <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                        <div class="item item-carousel" tpleach="Shop.related_products($product->product_type, 6)"
                            set="product">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image">
                                            <a href="{{product->link}}"><img src="images/products/p1.jpg" alt=""
                                                    tplimage="product->imagepath" height="189" width="189"></a>
                                        </div>
                                        <!-- /.image -->
                                        <div class="tag sale"><span>sale</span></div>
                                    </div>
                                    <!-- /.product-image -->
                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="{{product->link}}">{{product->title}}</a></h3>
                                        <span data-rating-stars="5" data-rating-readonly="true"
                                            data-rating-value="{{product->rating}}"></span>
                                        <div class="description"></div>
                                        <div class="product-price">
                                            <span class="price">
                                                {{Formats.moneyFormat($product->price)}} </span>
                                            <span class="price-before-discount">{{
                                                Formats.moneyFormat($product->compare_price) }}</span>
                                        </div>
                                        <!-- /.product-price -->
                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">

                                        <div class="action">
                                            <ul class="list-unstyled">

                                                <li class="add-cart-button btn-group">
                                                    <a target="_blank" class="btn btn-primary icon"
                                                        href="{{product->link}}">
                                                        <i class="fa fa-external-link"></i>
                                                    </a>
                                                </li>
                                                <li class="lnk">
                                                    <a class="add-to-cart" href="{{product->link}}">
                                                        View
                                                    </a>
                                                </li>
                                            </ul>

                                        </div>

                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->
                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.item -->
                    </div>
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
            </div>
            <!-- /.col -->
            <div class="clearfix"></div>
        </div>
        <!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <div id="brands-carousel" class="logo-slider wow fadeInUp">
            <div class="logo-slider-inner">
                <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                    <div class="item m-t-15">
                        <a href="#" class="image">
                            <img data-echo="images/brands/brand1.png" src="images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item m-t-10">
                        <a href="#" class="image">
                            <img data-echo="images/brands/brand2.png" src="images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="images/brands/brand3.png" src="images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="images/brands/brand4.png" src="images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="images/brands/brand5.png" src="images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="images/brands/brand6.png" src="images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="images/brands/brand2.png" src="images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="images/brands/brand4.png" src="images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="images/brands/brand1.png" src="images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="images/brands/brand5.png" src="images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->
                </div>
                <!-- /.owl-carousel #logo-slider -->
            </div>
            <!-- /.logo-slider-inner -->
        </div>
        <!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->
</div>
<!-- /.body-content -->
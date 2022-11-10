<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">
            <!-- ============================================== SIDEBAR ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
                <!-- ================================== TOP NAVIGATION ================================== -->
                <div class="side-menu animate-dropdown outer-bottom-xs">
                    <div class="head"> Categories</div>
                    <nav class="yamm megamenu-horizontal" role="navigation" id="category-menu">
                        <ul class="nav">
                            <li class="dropdown menu-item" tpleach="Shop.asset_menu(category-menu)" set="category">
                                <a tplcheck="Shop.hasmenuchild($category)" href="{{ category->href }}"
                                    class="dropdown-toggle" data-toggle="dropdown">{{category->text }}</a>
                                <a tplcheck="Shop.hasmenuchild($category,0)"
                                    href="{{ category->href }}">{{category->text }}</a>

                                <ul class="dropdown-menu col-menu" tplcheck="Shop.hasmenuchild($category)">
                                    <li class="yamm-content">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-3">
                                                <ul class="links list-unstyled">
                                                    <li tpleach="category->children" set="subcat"><a
                                                            href="{{subcat->href}}">{{ subcat->text }}</a></li>
                                                </ul>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </li>
                                    <!-- /.yamm-content -->
                                </ul>
                                <!-- /.dropdown-menu -->
                            </li>
                            <!-- /.menu-item -->
                        </ul>
                        <!-- /.nav -->
                    </nav>
                    <!-- /.megamenu-horizontal -->
                </div>
                <!-- /.side-menu -->
                <!-- ================================== TOP NAVIGATION : END ================================== -->

                <!-- ============================================== HOT DEALS ============================================== -->
                <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
                    <h3 class="section-title">hot deals</h3>
                    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
                        <div class="item" tpleach="Shop.products(hot-deals,limit:3)" set="product">
                            <div class="products">
                                <div class="hot-deal-wrapper">
                                    <div class="image">
                                        <img src="images/hot-deals/p25.jpg" alt="" tplimage="product->imagepath"
                                            width="223" height="223">
                                    </div>
                                    <div class="sale-offer-tag"><span>49%<br>off</span></div>
                                </div>
                                <!-- /.hot-deal-wrapper -->
                                <div class="product-info text-left m-t-20">
                                    <h3 class="name"><a href="{{product->link}}">{{product->title}}</a></h3>
                                    <div data-rating-stars="5" data-rating-value="{{ product->rating}}"
                                        data-rating-readonly="true"></div>

                                    <div class="product-price">
                                        <span class="price">
                                            {{ Formats.moneyFormat($product->price)}}
                                        </span>
                                        <span
                                            class="price-before-discount">{{Formats.moneyFormat($product->compare_price)}}</span>
                                    </div>
                                    <!-- /.product-price -->
                                </div>
                                <!-- /.product-info -->
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <a href="{{product->cartlink}}">
                                            <div class="add-cart-button btn-group">
                                                <button class="btn btn-primary icon" data-toggle="dropdown"
                                                    type="button">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                                <button class="btn btn-primary cart-btn" type="button">Add to
                                                    cart</button>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- /.action -->
                                </div>
                                <!-- /.cart -->
                            </div>
                        </div>
                    </div>
                    <!-- /.sidebar-widget -->
                </div>
                <!-- ============================================== HOT DEALS: END ============================================== -->
                <!-- ============================================== SPECIAL OFFER ============================================== -->
                <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                    <h3 class="section-title">Special Offer</h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                            <div class="item">
                                <div class="products special-product">
                                    <div class="product" tpleach="Shop.products(special-offer,limit:5)" set="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="{{product->link}}">
                                                                <img src="images/products/p30.jpg" alt=""
                                                                    tplimage="product->imagepath" height="90"
                                                                    width="90">
                                                            </a>
                                                        </div>
                                                        <!-- /.image -->
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a
                                                                href="{{product->link}}">{{product->title}}</a></h3>

                                                        <div data-rating-stars="5"
                                                            data-rating-value="{{ product->rating}}"
                                                            data-rating-readonly="true"></div>

                                                        <div class="product-price">
                                                            <span class="price">{{ Formats.moneyFormat($product->price)
                                                                }} </span>
                                                        </div>
                                                        <!-- /.product-price -->
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-micro-row -->
                                        </div>
                                        <!-- /.product-micro -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== SPECIAL OFFER : END ============================================== -->
                <!-- ============================================== PRODUCT TAGS ============================================== -->
                <div class="sidebar-widget product-tag wow fadeInUp">
                    <h3 class="section-title">Product tags</h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <div class="tag-list">
                            <a class="item" title="{{tag}}" href="collection/all?tag={{tag}}"
                                tpleach="Shop.prdouct_tags(10)" set="tag">{{tag}}</a>
                        </div>
                        <!-- /.tag-list -->
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== PRODUCT TAGS : END ============================================== -->
            </div>
            <!-- /.sidemenu-holder -->
            <!-- ============================================== SIDEBAR : END ============================================== -->
            <!-- ============================================== CONTENT ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                <!-- ========================================== SECTION – HERO ========================================= -->
                <div id="hero">
                    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                        <div class="item" style="background-image: url({{ Shop.asset_image(slider-1) }})">
                            <div class="container-fluid">
                                <div class="caption bg-color vertical-center text-left">
                                    <div class="slider-header fadeInDown-1">Top Brands</div>
                                    <div class="big-text fadeInDown-1">
                                        New Collections
                                    </div>
                                    <div class="excerpt fadeInDown-2 hidden-xs">
                                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                                    </div>
                                    <div class="button-holder fadeInDown-3">
                                        <a href="/collection/all"
                                            class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a>
                                    </div>
                                </div>
                                <!-- /.caption -->
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                        <!-- /.item -->
                        <div class="item" style="background-image: url({{ Shop.asset_image(slider-2) }});">
                            <div class="container-fluid">
                                <div class="caption bg-color vertical-center text-left">
                                    <div class="slider-header fadeInDown-1">Spring 2016</div>
                                    <div class="big-text fadeInDown-1">
                                        Women <span class="highlight">Fashion</span>
                                    </div>
                                    <div class="excerpt fadeInDown-2 hidden-xs">
                                        <span>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
                                            fugit</span>
                                    </div>
                                    <div class="button-holder fadeInDown-3">
                                        <a href="/collection/all"
                                            class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a>
                                    </div>
                                </div>
                                <!-- /.caption -->
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                        <!-- /.item -->
                    </div>
                    <!-- /.owl-carousel -->
                </div>
                <!-- ========================================= SECTION – HERO : END ========================================= -->
                <!-- ============================================== INFO BOXES ============================================== -->
                <div class="info-boxes wow fadeInUp">
                    <div class="info-boxes-inner">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">money back</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">30 Days Money Back Guarantee</h6>
                                </div>
                            </div>
                            <!-- .col -->
                            <div class="hidden-md col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">free shipping</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Shipping on orders over $99</h6>
                                </div>
                            </div>
                            <!-- .col -->
                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">Special Sale</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Extra $5 off on all items </h6>
                                </div>
                            </div>
                            <!-- .col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.info-boxes-inner -->
                </div>


                <!-- /.info-boxes -->
                <!-- ============================================== INFO BOXES : END ============================================== -->
                <!-- ============================================== SCROLL TABS ============================================== -->
                <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                    <div class="more-info-tab clearfix ">
                        <h3 class="new-product-title pull-left">New Products</h3>
                        <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                            <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a>
                            </li>
                            <li><a data-transition-type="backSlide" href="#clothing" data-toggle="tab">Clothing</a></li>
                            <li><a data-transition-type="backSlide" href="#electronics"
                                    data-toggle="tab">Electronics</a></li>
                            <li><a data-transition-type="backSlide" href="#shoes" data-toggle="tab">Shoes</a></li>
                        </ul>
                        <!-- /.nav-tabs -->
                    </div>
                    <div class="tab-content outer-top-xs">
                        <div class="tab-pane in active" id="all">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                    <div class="item item-carousel" tpleach="Shop.products(all,limit:6)" set="product">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="{{product->link}}"><img src="images/products/p1.jpg"
                                                                tplimage="product->imagepath" width="249" height="249"
                                                                alt=""></a>
                                                    </div>
                                                    <!-- /.image -->
                                                    <!--<div class="tag new"><span>new</span></div>-->
                                                </div>
                                                <!-- /.product-image -->
                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="{{product->link}}">{{product->title}}</a>
                                                    </h3>
                                                    <div data-rating-stars="5" data-rating-value="{{ product->rating}}"
                                                        data-rating-readonly="true"></div>


                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        <span class="price">
                                                            {{Formats.moneyFormat($product->price)}}</span>
                                                        <span
                                                            class="price-before-discount">{{Formats.moneyFormat($product->compare_price)}}</span>
                                                    </div>
                                                    <!-- /.product-price -->
                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">

                                                            <li onclick="window.location.href='{{product->cartlink}}' "
                                                                class="add-cart-button btn-group">
                                                                <button class="btn btn-primary icon"
                                                                    data-toggle="dropdown" type="button">
                                                                    <i class="fa fa-shopping-cart"></i>
                                                                    Add to cart
                                                                </button>
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
                            </div>
                            <!-- /.product-slider -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="clothing">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                    <div class="item item-carousel" tpleach="Shop.products(clothing,limit:6)"
                                        set="product">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="{{product->link}}"><img src="images/products/p1.jpg"
                                                                tplimage="product->imagepath" width="249" height="249"
                                                                alt=""></a>
                                                    </div>
                                                    <!-- /.image -->
                                                    <!--<div class="tag new"><span>new</span></div>-->
                                                </div>
                                                <!-- /.product-image -->
                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="{{product->link}}">{{product->title}}</a>
                                                    </h3>
                                                    <div data-rating-stars="5" data-rating-value="{{ product->rating}}"
                                                        data-rating-readonly="true"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        <span class="price">
                                                            {{Formats.moneyFormat($product->price)}}</span>
                                                        <span
                                                            class="price-before-discount">{{Formats.moneyFormat($product->compare_price)}}</span>
                                                    </div>
                                                    <!-- /.product-price -->
                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">


                                                            <li onclick="window.location.href='{{product->cartlink}}' "
                                                                class="add-cart-button btn-group">
                                                                <button class="btn btn-primary icon"
                                                                    data-toggle="dropdown" type="button">
                                                                    <i class="fa fa-shopping-cart"></i>
                                                                    Add to cart
                                                                </button>
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
                            </div>
                            <!-- /.product-slider -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="electronics">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                    <div class="item item-carousel" tpleach="Shop.products(electronics,limit:6)"
                                        set="product">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="{{product->link}}"><img src="images/products/p1.jpg"
                                                                tplimage="product->imagepath" width="249" height="249"
                                                                alt=""></a>
                                                    </div>
                                                    <!-- /.image -->
                                                    <!--<div class="tag new"><span>new</span></div>-->
                                                </div>
                                                <!-- /.product-image -->
                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="{{product->link}}">{{product->title}}</a>
                                                    </h3>
                                                    <div data-rating-stars="5" data-rating-value="{{ product->rating}}"
                                                        data-rating-readonly="true"></div>

                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        <span class="price">
                                                            {{Formats.moneyFormat($product->price)}}</span>
                                                        <span
                                                            class="price-before-discount">{{Formats.moneyFormat($product->compare_price)}}</span>
                                                    </div>
                                                    <!-- /.product-price -->
                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">


                                                            <li onclick="window.location.href='{{product->cartlink}}' "
                                                                class="add-cart-button btn-group">
                                                                <button class="btn btn-primary icon"
                                                                    data-toggle="dropdown" type="button">
                                                                    <i class="fa fa-shopping-cart"></i>
                                                                    Add to cart
                                                                </button>
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
                            </div>
                            <!-- /.product-slider -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="shoes">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                    <div class="item item-carousel" tpleach="Shop.products(shoes,limit:6)"
                                        set="product">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="{{product->link}}"><img src="images/products/p1.jpg"
                                                                tplimage="product->imagepath" width="249" height="249"
                                                                alt=""></a>
                                                    </div>
                                                    <!-- /.image -->
                                                    <!--<div class="tag new"><span>new</span></div>-->
                                                </div>
                                                <!-- /.product-image -->
                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="{{product->link}}">{{product->title}}</a>
                                                    </h3>
                                                    <div data-rating-stars="5" data-rating-value="{{ product->rating}}"
                                                        data-rating-readonly="true"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        <span class="price">
                                                            {{Formats.moneyFormat($product->price)}}</span>
                                                        <span
                                                            class="price-before-discount">{{Formats.moneyFormat($product->compare_price)}}</span>
                                                    </div>
                                                    <!-- /.product-price -->
                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">

                                                            <li onclick="window.location.href='{{product->cartlink}}' "
                                                                class="add-cart-button btn-group">
                                                                <button class="btn btn-primary icon"
                                                                    data-toggle="dropdown" type="button">
                                                                    <i class="fa fa-shopping-cart"></i>
                                                                    Add to cart
                                                                </button>
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
                            </div>
                            <!-- /.product-slider -->
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.scroll-tabs -->
                <!-- ============================================== SCROLL TABS : END ============================================== -->
                <!-- ============================================== WIDE PRODUCTS ============================================== -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                    <div class="row">
                        <div class="col-md-7 col-sm-7">
                            <div class="wide-banner cnt-strip">
                                <div class="image">
                                    <img class="img-responsive" src="{{Shop.asset_image(home-page-flash-image-1)}}"
                                        alt="">
                                </div>
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-5 col-sm-5">
                            <div class="wide-banner cnt-strip">
                                <div class="image">
                                    <img class="img-responsive" src="{{Shop.asset_image(home-page-flash-image-2)}}"
                                        alt="">
                                </div>
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.wide-banners -->
                <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">Featured products</h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                        <div class="item item-carousel" tpleach="Shop.products(electronics,limit:6)" set="product">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image">
                                            <a href="{{product->link}}"><img src="images/products/p1.jpg"
                                                    tplimage="product->imagepath" width="249" height="249" alt=""></a>
                                        </div>
                                        <!-- /.image -->
                                        <!--<div class="tag new"><span>new</span></div>-->
                                    </div>
                                    <!-- /.product-image -->
                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="{{product->link}}">{{product->title}}</a></h3>
                                        <div data-rating-stars="5" data-rating-value="{{ product->rating}}"
                                            data-rating-readonly="true"></div>

                                        <div class="description"></div>
                                        <div class="product-price">
                                            <span class="price"> {{Formats.moneyFormat($product->price)}}</span>
                                            <span
                                                class="price-before-discount">{{Formats.moneyFormat($product->compare_price)}}</span>
                                        </div>
                                        <!-- /.product-price -->
                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">

                                                <li onclick="window.location.href='{{product->cartlink}}' "
                                                    class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown"
                                                        type="button">
                                                        <i class="fa fa-shopping-cart"></i>
                                                        Add to cart
                                                    </button>
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
                <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
                <!-- ============================================== WIDE PRODUCTS ============================================== -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="wide-banner cnt-strip">
                                <div class="image">
                                    <img class="img-responsive" src="{{Shop.asset_image(home-page-flash-image-3)}}"
                                        alt="">
                                </div>
                                <div class="strip strip-text">
                                    <div class="strip-inner">
                                        <h2 class="text-right">New Mens Fashion<br>
                                            <span class="shopping-needs">Save up to 40% off</span>
                                        </h2>
                                    </div>
                                </div>
                                <div class="new-label">
                                    <div class="text">NEW</div>
                                </div>
                                <!-- /.new-label -->
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.wide-banners -->
                <!-- ============================================== WIDE PRODUCTS : END ============================================== -->



            </div>
            <!-- /.homebanner-holder -->
            <!-- ============================================== CONTENT : END ============================================== -->
        </div>
        <!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <div id="brands-carousel" class="logo-slider wow fadeInUp">
            <div class="logo-slider-inner">
                <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                    <div class="item m-t-15">
                        <a href="#" class="image">
                            <img data-echo="{{cdn_root}}images/brands/brand1.png" src=" {{cdn_root}}images/blank.gif"
                                alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item m-t-10">
                        <a href="#" class="image">
                            <img data-echo="{{cdn_root}}images/brands/brand2.png" src=" {{cdn_root}}images/blank.gif"
                                alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="{{cdn_root}}images/brands/brand3.png" src="{{cdn_root}}images/blank.gif"
                                alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="{{cdn_root}}images/brands/brand4.png" src="{{cdn_root}}images/blank.gif"
                                alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="{{cdn_root}}images/brands/brand5.png" src="{{cdn_root}}images/blank.gif"
                                alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="{{cdn_root}}images/brands/brand6.png" src="{{cdn_root}}images/blank.gif"
                                alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="{{cdn_root}}images/brands/brand2.png" src="{{cdn_root}}images/blank.gif"
                                alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="{{cdn_root}}images/brands/brand4.png" src="{{cdn_root}}images/blank.gif"
                                alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="{{cdn_root}}images/brands/brand1.png" src="{{cdn_root}}images/blank.gif"
                                alt="">
                        </a>
                    </div>
                    <!--/.item-->
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="{{cdn_root}}images/brands/brand5.png" src="{{cdn_root}}images/blank.gif"
                                alt="">
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
<!-- /#top-banner-and-menu -->
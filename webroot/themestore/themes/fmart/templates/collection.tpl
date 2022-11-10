<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>{{ collection_title }}</li>
            </ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>




<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-3 sidebar'>
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
                                                    <li tpleach="category->children" set="subcat">
                                                        <a href="{{subcat->href}}">{{ subcat->text }}</a>
                                                    </li>
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
                <div class="sidebar-module-container">
                    <div class="sidebar-filter">

                        <!-- /.sidebar-widget -->
                        <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->
                        

                        <!-- /.sidebar-widget -->
                        <!-- ============================================== PRICE SILDER : END ============================================== -->
                        <!-- ============================================== MANUFACTURES============================================== -->
                        <div class="sidebar-widget wow fadeInUp">
                            <div class="widget-header">
                                <h4 class="widget-title">Vendors</h4>
                            </div>
                            <div class="sidebar-widget-body">
                                <ul class="list">
                                    <li tpleach="Shop.product_vendors(10)" set="vendor">
                                        <a href="collection/all?vendor={{vendor}}">{{vendor}}</a>
                                    </li>
                                </ul>
                                <!--<a href="#" class="lnk btn btn-primary">Show Now</a>-->
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div>
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== MANUFACTURES: END ============================================== -->
                        <!-- ============================================== COLOR============================================== -->
                        <div class="sidebar-widget wow fadeInUp">
                            <div class="widget-header">
                                <h4 class="widget-title">Product Type</h4>
                            </div>
                            <div class="sidebar-widget-body">
                                <ul class="list">
                                    <li tpleach="Shop.product_types(10)" set="type">
                                        <a href="collection/all?product_type={{type}}">{{type}}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div>
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== COLOR: END ============================================== -->


                        <!-- ============================================== PRODUCT TAGS ============================================== -->
                        <div class="sidebar-widget product-tag wow fadeInUp outer-top-vs">
                            <h3 class="section-title">Product tags</h3>
                            <div class="sidebar-widget-body outer-top-xs">
                                <div class="tag-list">
                                    <a tpleach="Shop.prdouct_tags(10)" set="tag" class="item" title="Phone"
                                        href="collection/all?tag={{tag}}">{{tag}}</a>
                                </div>
                                <!-- /.tag-list -->
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div>
                        <!-- /.sidebar-widget -->
                        <!-- ============================================== PRODUCT TAGS : END ============================================== -->
                        <!-- ============================================== Testimonials============================================== -->

                    </div>
                    <!-- /.sidebar-filter -->
                </div>
                <!-- /.sidebar-module-container -->
            </div>
            <!-- /.sidebar -->
            <div class='col-md-9'>
                <!-- ========================================== SECTION – HERO ========================================= -->
                <div id="category" class="category-carousel hidden-xs">
                    <div class="item">
                        <div class="image">
                            <img src="{{ Shop.asset_image(collection-page-hero-image) }}" alt="" class="img-responsive">
                        </div>
                        <div class="container-fluid">
                            <div class="caption vertical-top text-left">
                                <div class="big-text">
                                    Big Sale
                                </div>
                                <div class="excerpt hidden-sm hidden-md">
                                    Save up to 49% off
                                </div>
                                <div class="excerpt-normal hidden-sm hidden-md">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                </div>
                            </div>
                            <!-- /.caption -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                </div>
                <!-- ========================================= SECTION – HERO : END ========================================= -->
                <div class="clearfix filters-container m-t-10">
                    <div class="row">
                        <div class="col col-sm-6 col-md-2">
                            <div class="filter-tabs">
                                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                    <li class="active">
                                        <a data-toggle="tab" href="#grid-container"><i
                                                class="icon fa fa-th-large"></i>Grid</a>
                                    </li>
                                    <li><a data-toggle="tab" href="#list-container"><i
                                                class="icon fa fa-th-list"></i>List</a></li>
                                </ul>
                            </div>
                            <!-- /.filter-tabs -->
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-12 col-md-6">
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt">
                                    <!-- <span class="lbl">Sort by</span> -->
                                    <select name="orderby" class="form-control" id="ck-sort-by"> {{sort_by}}</select>

                                </div>
                                <!-- /.lbl-cnt -->
                            </div>
                            <!-- /.col -->
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt">
                                    <!-- <span class="lbl">Show</span> -->
                                    <select name="count" class="form-control" id="ck-limit">
                                        <option value="12">12</option>
                                        <option value="24">24</option>
                                        <option value="36">36</option>
                                        <option value="48">48</option>
                                    </select>
                                    <!-- /.fld -->
                                </div>
                                <!-- /.lbl-cnt -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-6 col-md-4 text-right">
                            <div class="pagination-container">
                                <ul class="list-inline list-unstyled">
                                    <li tpleach="pagination_links" set="link" class="page-item">
                                        <a href="{{ link }}">{{ key }}</a>
                                    </li>
                                </ul>
                                <!-- /.list-inline -->
                            </div>
                            <!-- /.pagination-container -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list">
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 wow fadeInUp" tpleach="products" set="product">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="{{product->link}}"><img src="images/products/p5.jpg"
                                                                alt="" tplimage="product->imagepath" height="250"
                                                                width="250"></a>
                                                    </div>
                                                    <!-- /.image -->

                                                </div>
                                                <!-- /.product-image -->
                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="{{product->link}}">{{Formats.limit($product->title,
                                                            30) }}</a></h3>
                                                    <div data-rating-stars="5" data-rating-value="{{ product->rating}}"
                                                        data-rating-readonly="true"></div>


                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        <span class="price">
                                                            {{ Formats.moneyFormat($product->price)}}</span>
                                                        <span class="price-before-discount"> {{
                                                            Formats.moneyFormat($product->compare_price) }} </span>
                                                    </div>
                                                    <!-- /.product-price -->
                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <a href="{{product->cartlink}}">
                                                                <li onclick="window.location.href='{{product->cartlink}}' " class="add-cart-button btn-group">
                                                                    <button class="btn btn-primary icon"
                                                                        data-toggle="dropdown" type="button">
                                                                        <i class="fa fa-shopping-cart"></i>
                                                                        Add to cart
                                                                    </button>
                                                                </li>
                                                            </a>
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
                                <!-- /.row -->
                            </div>
                            <!-- /.category-product -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="list-container">
                            <div class="category-product">
                                <div class="category-product-inner wow fadeInUp" tpleach="products" set="product">
                                    <div class="products">
                                        <div class="product-list product">
                                            <div class="row product-list-row">
                                                <div class="col col-sm-4 col-lg-4">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <img src="images/products/p3.jpg" alt=""
                                                                tplimage="product->imagepath" height="249" width="249">
                                                        </div>
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-sm-8 col-lg-8">
                                                    <div class="product-info">
                                                        <h3 class="name"><a href="{{ product->title }}">{{
                                                                product->title }}</a>
                                                        </h3>
                                                        <div data-rating-stars="5"
                                                            data-rating-value="{{ product->rating}}"
                                                            data-rating-readonly="true"></div>
                                                        <div class="product-price">
                                                            <span class="price">
                                                                {{ Formats.moneyFormat($product->price)}} </span>
                                                            <span class="price-before-discount">{{
                                                                Formats.moneyFormat($product->compare_price)}} </span>
                                                        </div>
                                                        <!-- /.product-price -->
                                                        <div class="description m-t-10">
                                                            {{ product->short_description}}
                                                        </div>
                                                        <div class="cart clearfix animate-effect">
                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    <a href="{{product->cartlink}}">
                                                                        <li class="add-cart-button btn-group">
                                                                            <button class="btn btn-primary icon"
                                                                                data-toggle="dropdown" type="button">
                                                                                <i class="fa fa-shopping-cart"></i>
                                                                            </button>
                                                                            <button class="btn btn-primary cart-btn"
                                                                                type="button">Add to cart</button>
                                                                        </li>
                                                                    </a>
                                                                </ul>
                                                            </div>
                                                            <!-- /.action -->
                                                        </div>
                                                        <!-- /.cart -->
                                                    </div>
                                                    <!-- /.product-info -->
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-list-row -->
                                            <!-- <div class="tag new"><span>new</span></div> -->
                                        </div>
                                        <!-- /.product-list -->
                                    </div>
                                    <!-- /.products -->
                                </div>
                                <!-- /.category-product-inner -->
                            </div>
                            <!-- /.category-product -->
                        </div>
                        <!-- /.tab-pane #list-container -->
                    </div>
                    <!-- /.tab-content -->
                    <div class="clearfix filters-container">
                        <div class="text-right">
                            <div class="pagination-container">
                                <ul class="list-inline list-unstyled">
                                    <li tpleach="pagination_links" set="link" class="page-item">
                                        <a href="{{ link }}">{{ key }}</a>
                                    </li>
                                </ul>
                                <!-- /.list-inline -->
                            </div>
                            <!-- /.pagination-container -->
                        </div>
                        <!-- /.text-right -->
                    </div>
                    <!-- /.filters-container -->
                </div>
                <!-- /.search-result-container -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
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
<!-- /.body-content -->
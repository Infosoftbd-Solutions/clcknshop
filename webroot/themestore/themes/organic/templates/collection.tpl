<div class="stricky-header stricked-menu main-menu">
        <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
    </div><!-- /.stricky-header -->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ Shop.asset_image(collection-page-hero-image) }});"></div>
        <!-- /.page-header__bg -->
        <div class="container">
            <h2>Products</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="index.html">Home</a></li>
                <li>/</li>
                <li><span>Products</span></li>
            </ul><!-- /.thm-breadcrumb list-unstyled -->
        </div><!-- /.container -->
    </section><!-- /.page-header -->


    <section class="products-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-3">
                    <div class="product-sidebar">
                        <div class="product-sidebar__single product-sidebar__search-widget">
                            <form action="#">
                                <input type="text" placeholder="Search">
                                <button class="organik-icon-magnifying-glass" type="submit"></button>
                            </form>
                        </div><!-- /.product-sidebar__single -->
                        <div class="product-sidebar__single">
                            <h3>Price</h3>
                            <div class="product-sidebar__price-range">
                                <div class="range-slider-price" id="range-slider-price"></div>
                                <div class="form-group">
                                    <div class="left">
                                        <p>$<span id="min-value-rangeslider"></span></p>
                                        <span>-</span>
                                        <p>$<span id="max-value-rangeslider"></span></p>
                                    </div><!-- /.left -->
                                    <div class="right">
                                        <input type="submit" class="thm-btn" value="Filter">
                                    </div><!-- /.right -->
                                </div>
                            </div><!-- /.product-sidebar__price-range -->
                        </div><!-- /.product-sidebar__single -->
                        <div class="product-sidebar__single">
                            <h3>Categories</h3>
                            <ul class="list-unstyled product-sidebar__links">
                                <li tpleach="Shop.asset_menu(category-menu)" set="menu"><a href="{{menu->href}}">{{menu->text}} <i class="fa fa-angle-right"></i></a></li>

                            </ul><!-- /.list-unstyled product-sidebar__links -->
                        </div><!-- /.product-sidebar__single -->
                    </div><!-- /.product-sidebar -->
                </div><!-- /.col-sm-12 col-md-12 col-lg-3 -->
                <div class="col-sm-12 col-md-12 col-lg-9">
                    <div class="product-sorter">
                        <p>Showing 1–9 of 12 results</p>
                        <div class="product-sorter__select">
                            <select class="selectpicker" name="orderby" id="ck-sort-by">
                            {{sort_by}}
                            </select>
                        </div><!-- /.product-sorter__select -->
                    </div><!-- /.product-sorter -->
                    <div class="row">

                        <div class="col-md-6 col-lg-4" tpleach="products" set="product">
                            <div class="product-card">
                                <div class="product-card__image">
                                     <img src="assets/images/products/product-1-1.jpg" alt="" tplimage="product->image">
                                    <div class="product-card__image-content">

                                        <a href="{{ product->cartlink}}"><i class="organik-icon-shopping-cart"></i></a>
                                    </div><!-- /.product-card__image-content -->
                                </div><!-- /.product-card__image -->
                                <div class="product-card__content">
                                    <div class="product-card__left">
                                        <h3><a href="{{ product->link }}">{{ product->title}}</a></h3>
                                        <p>{{ Formats.moneyFormat($product->price)}}</p>
                                    </div><!-- /.product-card__left -->
                                    <div class="product-card__right">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div><!-- /.product-card__right -->
                                </div><!-- /.product-card__content -->
                            </div><!-- /.product-card -->
                        </div><!-- /.col-md-6 col-lg-4 -->

                    </div><!-- /.row -->
                    <div class="text-center">
                        <a href="#" class="thm-btn products__load-more">Load More</a><!-- /.thm-btn -->
                    </div><!-- /.text-center -->
                </div><!-- /.col-sm-12 col-md-12 col-lg-9 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.products-page -->

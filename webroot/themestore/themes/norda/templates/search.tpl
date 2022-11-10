<div class="breadcrumb-area bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="">Home</a>
                </li>
                <li class="active">Shop </li>
            </ul>
        </div>
    </div>
</div>
<div class="shop-area pt-120 pb-120">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="shop-topbar-wrapper">
                    <div class="shop-topbar-left">
                        <div class="view-mode nav">
                            <a class="active" href="#shop-1" data-toggle="tab"><i class="icon-grid"></i></a>
                            <a href="#shop-2" data-toggle="tab"><i class="icon-menu"></i></a>
                        </div>
                        <p>Showing 1 - 20 of 30 results </p>
                    </div>
                    <div class="product-sorting-wrapper">
                        <div class="product-shorting shorting-style">
                            <label>View :</label>
                            <select>
                                <option value=""> 20</option>
                                <option value=""> 23</option>
                                <option value=""> 30</option>
                            </select>
                        </div>
                        <div class="product-show shorting-style">
                            <label>Sort by :</label>
                            <select>
                                <option value="">Default</option>
                                <option value=""> Name</option>
                                <option value=""> price</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="shop-bottom-area">
                    <div class="tab-content jump">
                        <div id="shop-1" class="tab-pane active">
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" tpleach="products">
                                    <div class="single-product-wrap mb-35">
                                        <div class="product-img product-img-zoom mb-15">
                                            <a href="{{ val->link }}">
                                                <img src="assets/images/product/product-13.jpg" tplimage="val->imagepath" alt="">
                                            </a>
                                            <div class="product-action-2 tooltip-style-2">
                                                <button title="Quick View" class="quick-view" data-toggle="modal" data-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap-2 text-center">
                                            <div class="product-rating-wrap">
                                                <div class="product-rating review" review="{{ val->rating }}">
                                                </div>
                                                <span>({{ val->ratingTotal }})</span>
                                            </div>
                                            <h3><a href="{{ val->link }}">{{ val->title }}</a></h3>
                                            <div class="product-price-2">
                                                <span>{{ val->price }}</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap-2 product-content-position text-center">
                                            <div class="product-rating-wrap">
                                                <div class="product-rating review" review="{{ val->rating }}">

                                                </div>
                                                <span>({{ val->ratingTotal}})</span>
                                            </div>
                                            <h3><a href="{{ val->link }}">{{ val->title }}</a></h3>
                                            <div class="product-price-2">
                                                <span>{{ val->price }}</span>
                                            </div>
                                            <div class="pro-add-to-cart">
                                                <button href="{{ val->cartlink }}" class="ck-cartlink" title="Add to Cart">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="shop-2" class="tab-pane">
                            <div class="shop-list-wrap mb-30" tpleach="products">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6">
                                        <div class="product-list-img">
                                            <a href="{{ val->link }}">
                                                <img src="assets/images/product/product-13.jpg" tplimage="val->imagepath" alt="Product Style">
                                            </a>
                                            <div class="product-list-quickview">
                                                <button title="Quick View" class="quick-view" data-toggle="modal" data-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8 col-lg-7 col-md-6 col-sm-6">
                                        <div class="shop-list-content">
                                            <h3><a href="{{ val->link }}">{{ val->title }}</a></h3>
                                            <div class="pro-list-price">
                                                <span class="new-price">{{ val->price }}</span>
                                                <span class="old-price"> {{ val->compare_price }}</span>
                                            </div>
                                            <div class="product-list-rating-wrap">
                                                <div class="product-list-rating review" review="{{ val->rating }}">
                                                </div>
                                                <span>({{ val->ratingTotal }})</span>
                                            </div>
                                            <p>{{ val->overview }}</p>
                                            <div class="product-list-action">
                                                <button class="ck-cartlink" href="{{ val->cartlink }}" title="Add To Cart"><i class="icon-basket-loaded"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pro-pagination-style text-center mt-10">
                        <ul>
                            <li><a class="prev" href="{{ pagination_link_prev }}"><i class="icon-arrow-left"></i></a></li>
                            <li tpleach="pagination_links"><a href="{{ val }}"> {{ key }}</a></li>

                            <li><a class="next" href="{{ pagination_link_next }}"><i class="icon-arrow-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="sidebar-wrapper sidebar-wrapper-mrg-right">
                    <div class="sidebar-widget mb-40">
                        <h4 class="sidebar-widget-title">Search </h4>
                        <div class="sidebar-search">
                            <form class="sidebar-search-form" action="search" method="get">
                                <input type="text" name="keyword" placeholder="Search here...">
                                <button type="submit">
                                    <i class="icon-magnifier"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar-widget shop-sidebar-border mb-35 pt-40">
                        <h4 class="sidebar-widget-title">Categories </h4>
                        <div class="shop-catigory">
                            <ul>
                                <li><a href="shop.html">T-Shirt</a></li>
                                <li><a href="shop.html">Shoes</a></li>
                                <li><a href="shop.html">Clothing </a></li>
                                <li><a href="shop.html">Women </a></li>
                                <li><a href="shop.html">Baby Boy </a></li>
                                <li><a href="shop.html">Accessories </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
                        <h4 class="sidebar-widget-title">Price Filter </h4>
                        <div class="price-filter">
                            <span>Range:  $100.00 - 1.300.00 </span>
                            <div id="slider-range"></div>
                            <div class="price-slider-amount">
                                <div class="label-input">
                                    <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                </div>
                                <button type="button">Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
                        <h4 class="sidebar-widget-title">Refine By </h4>
                        <div class="sidebar-widget-list">
                            <ul>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox"> <a href="#">On Sale <span>4</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value=""> <a href="#">New <span>5</span></a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value=""> <a href="#">In Stock <span>6</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
                        <h4 class="sidebar-widget-title">Size </h4>
                        <div class="sidebar-widget-list">
                            <ul>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value=""> <a href="#">XL <span>4</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value=""> <a href="#">L <span>5</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value=""> <a href="#">SM <span>6</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value=""> <a href="#">XXL <span>7</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
                        <h4 class="sidebar-widget-title">Color </h4>
                        <div class="sidebar-widget-list">
                            <ul>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value=""> <a href="#">Green <span>7</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value=""> <a href="#">Cream <span>8</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value=""> <a href="#">Blue <span>9</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value=""> <a href="#">Black <span>3</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-widget shop-sidebar-border pt-40">
                        <h4 class="sidebar-widget-title">Popular Tags</h4>
                        <div class="tag-wrap sidebar-widget-tag">
                            <a href="#">Clothing</a>
                            <a href="#">Accessories</a>
                            <a href="#">For Men</a>
                            <a href="#">Women</a>
                            <a href="#">Fashion</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
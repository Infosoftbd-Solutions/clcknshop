<main class="main mt-3">
    <div class="container collection">
        <nav class="toolbox">
            <div class="toolbox-left">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=""><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">{{ collection_title }}</a></li>
                </ol>
            </div><!-- End .toolbox-left -->

            <div class="toolbox-right">
                <div class="toolbox-item toolbox-sort">
                    <label>Sort By:</label>
                    <div class="select-custom">
                        <select name="orderby" class="form-control" id="ck-sort-by"> {{sort_by}}</select>
                    </div><!-- End .select-custom -->
                </div><!-- End .toolbox-item -->

                <div class="toolbox-item toolbox-show">
                    <label>Show:</label>
                    <div class="select-custom">
                        <select name="count" class="form-control" id="ck-limit">
                            <option value="12">15</option>
                            <option value="24">30</option>
                            <option value="36">45</option>
                            <option value="36">60</option>
                            <option value="36">75</option>
                            <option value="36">90</option>
                        </select>
                    </div><!-- End .select-custom -->
                </div><!-- End .toolbox-item -->
            </div><!-- End .toolbox-right -->
        </nav>

        <div class="row">
            <div class="col-6 col-sm-4 col-md-3 col-xl-5col" tpleach="products" set="product">
                <div class="product-default inner-quickview inner-icon">
                    <figure>
                        <a href="{{ product->link }}">
                            <img src="images/products/product-1.jpg" tplimage="product->image" width="220" height="220">
                        </a>
                        <!--<div class="label-group">
                            <div class="product-label label-hot">HOT</div>
                            <div class="product-label label-sale">-20%</div>
                        </div>-->

                        <div class="btn-icon-group">
                            <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-shopping-cart"></i></button>
                        </div>
                        <a href="{{ product->link }}" class="btn-quickview" title="Quick View">Quick View</a>
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <div class="category-list">
                                <a href="collection/all?product_type={{product->product_type}}" class="product-category">{{ product->product_type }}</a>
                            </div>
                            <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                        </div>
                        <h2 class="product-title">
                            <a href="{{ product->link }}">{{ product->title}}</a>
                        </h2>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width: {{Formats.mul(20, $product->rating)}}%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <span class="old-price">{{ Formats.moneyFormat($product->compare_price)}}</span>
                            <span class="product-price">{{ Formats.moneyFormat($product->price)}}</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div><!-- End .col-xl-2 -->
        </div><!-- End .row -->

        <nav class="toolbox toolbox-pagination">
            <div class="toolbox-item toolbox-show">
            </div><!-- End .toolbox-item -->

            <ul class="pagination toolbox-item">
                <li tpleach="pagination_links" set="link"  class="page-item"><a class="page-link" href="{{ link }}">{{ key }}</a></li>
            </ul>
        </nav>
    </div><!-- End .container -->

    <div class="mb-3"></div><!-- margin -->
</main><!-- End .main -->
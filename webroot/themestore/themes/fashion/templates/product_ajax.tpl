<div class="product-single-container product-single-default product-quick-view">
    <div class="row row-sparse">
        <div class="col-lg-6 product-single-gallery">
            <div class="product-slider-container">
                <div class="product-single-carousel owl-carousel owl-theme">
                    <div class="product-item" tpleach="product->product_media">
                        <img class="product-single-image" src="" tplimage="val->image" data-zoom-image="/{{val->image}}"/>
                    </div>
                </div>
                <!-- End .product-single-carousel -->
            </div>
            <div class="prod-thumbnail owl-dots" id='carousel-custom-dots'>
                <div class="owl-dot col-3" tpleach="product->product_media">
                    <img width="90" tplimage="val->image" src=""/>
                </div>
            </div>
        </div><!-- End .product-single-gallery -->

        <div class="col-lg-6 product-single-details">
            <h1 class="product-title">{{ product->title }}</h1>

            <div class="ratings-container">
                <div class="product-ratings">
                    <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                </div><!-- End .product-ratings -->

                <a href="#" class="rating-link">( 6 Reviews )</a>
            </div><!-- End .product-container -->

            <div class="price-box">
                <span class="old-price">{{Formats.moneyFormat($product->compare_price)}}</span>
                <span class="product-price">{{Formats.moneyFormat($product->price)}}</span>
            </div><!-- End .price-box -->

            <div class="product-desc">
                <p>{{ product->overview }}</p>
            </div><!-- End .product-desc -->

            <form action="add_to_cart" tplform="">
                {{Formats.printProductHiddenFields($product)}}
                {{Formats.printProductOptions($product)}}

                <div class="product-filters-container" tpleach="product->product_options" set="option">
                    <div class="product-single-filter mb-2">
                        <label>{{ option->option_name }}:</label>
                        <ul class="config-size-list " data-name="{{ option->option_name }}" >
                            <li tpleach="Formats.split($option->option_values)" set="option_value"><a  href="javascript:void(0)" style="background-color: red" class="option_selected bg-{{option_value}}" data-name="{{ option->option_name }}"   data-value="{{ option_value }}">{{ option_value }}</a></li> <!--class="active" -->
                        </ul>
                    </div><!-- End .product-single-filter -->
                </div><!-- End .product-filters-container -->
                <hr class="divider">

                <div class="product-action">
                    <div class="product-single-qty">
                        <input name="quantity" class="horizontal-quantity form-control" type="text">
                    </div><!-- End .product-single-qty -->

                    <button class="btn btn-dark add-cart" title="Add to Cart">Add to Cart</button>
                </div><!-- End .product-action -->
                <hr class="divider">

            </form>


        </div><!-- End .product-single-details -->
    </div><!-- End .row -->
</div><!-- End .product-single-container -->


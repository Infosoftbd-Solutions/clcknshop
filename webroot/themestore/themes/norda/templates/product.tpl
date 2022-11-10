<style>
    .ck-active {
        background-color: #ff2f2f;
        color: #ffffff;
        border: 1px solid #ff2f2f;
    }
</style>

<div class="breadcrumb-area bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="">Home</a>
                </li>
                <li class="active">product</li>
            </ul>
        </div>
    </div>
</div>
<div class="product-details-area pt-120 pb-115">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="product-details-tab">
                    <div class="product-dec-right pro-dec-big-img-slider">
                        <div class="easyzoom-style" tpleach="product->product_media">
                            <div class="easyzoom easyzoom--overlay">
                                <a href="assets/images/product-details/b-large-1.jpg" tplimage="val->image" width="1200" height="1125">
                                    <img src="assets/images/product-details/large-1.jpg" alt="" tplimage="val->image" width="455" height="564">
                                </a>
                            </div>
                            <a class="easyzoom-pop-up img-popup" href="assets/images/product-details/b-large-1.jpg" width="1200" height="1125" tplimage="val->image"><i class="icon-size-fullscreen"></i></a>
                        </div>
                    </div>

                    <div class="product-dec-left product-dec-slider-small-2 product-dec-small-style2">
                        <div class="product-dec-small" tpleach="product->product_media">
                            <img src="assets/images/product-details/small-1.jpg" tplimage="val->imagepath" alt="" width="90" height="115" tplimage="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="product-details-content pro-details-content-mt-md">
                    <h2 tplvar="product->title">Simple Black T-Shirt</h2>
                    <div class="product-ratting-review-wrap">
                        <div class="product-ratting-digit-wrap">
                            <div class="product-ratting review" tplvar="product->rating" set="review">
                            </div>
                            <div class="product-digit">
                                <span tplvar="product->rating"></span>
                            </div>
                        </div>
                        <div class="product-review-order">
                            <span tplvar="product->ratingTotal">62</span> Reviews
                        </div>
                    </div>
                    <p tplvar="product->overview">Seamlessly predominate enterprise metrics without performance based process improvements.</p>
                    <div class="pro-details-price">
                        <span class="new-price" tplvar="Formats.moneyFormat($product->price)">$75.72</span>
                        <span class="old-price" tplvar="Formats.moneyFormat($product->compare_price)">$95.72</span>
                    </div>
                    <form action="add_to_cart" id="pro-add-to-cart" tplform="">
                        {{Formats.printProductHiddenFields($product)}}
                        {{Formats.printProductOptions($product)}}

                        <div class="pro-details-size" tpleach="product->product_options" set="option">
                            <span>{{ option->option_name }}:</span>
                            <div class="pro-details-size-content">
                                <ul>
                                    <li tpleach="Formats.split($option->option_values)" set="option_value"><a href="javascript:void(0)" class="option_selected" data-name="{{ option->option_name }}"   data-value="{{ option_value }}">{{ option_value }}</a></li> <!--class="active" -->
                                </ul>
                            </div>
                        </div>

                        <div class="pro-details-quality">
                            <span>Quantity:</span>
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="text" name="quantity" value="1">
                            </div>
                        </div>
                        <div class="product-details-meta">
                            <ul>
                                <li><span>Categories:</span>
                                    <a href="/collection/all?product-type={{product->product_type}}">{{product->product_type}}</a>
                                </li>
                                <li><span>Tag: </span>
                                    <a href="/collection/all?tag={{val}}" tpleach="Formats.split($product->tags)">{{ val }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-action-wrap">
                            <div class="pro-details-add-to-cart">
                                <a title="Add to Cart" class="add-to-cart-form" href="javascript:void(0)">Add To Cart </a>
                            </div>
                            <div class="pro-details-action">
                                <a class="social" title="Social" href="#"><i class="icon-share"></i></a>
                                <div class="product-dec-social">
                                    <a class="facebook" title="Facebook" href="#"><i class="icon-social-facebook"></i></a>
                                    <a class="twitter" title="Twitter" href="#"><i class="icon-social-twitter"></i></a>
                                    <a class="instagram" title="Instagram" href="#"><i class="icon-social-instagram"></i></a>
                                    <a class="pinterest" title="Pinterest" href="#"><i class="icon-social-pinterest"></i></a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="description-review-wrapper pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="dec-review-topbar nav mb-45">
                    <a class="active" data-toggle="tab" href="#des-details1">Description</a>
                    <a data-toggle="tab" href="#des-details4">Reviews and Ratting </a>
                </div>
                <div class="tab-content dec-review-bottom">
                    <div id="des-details1" class="tab-pane active">
                        <div class="description-wrap"> {{ product->description }}
                        </div>
                    </div>
                    <div id="des-details4" class="tab-pane">
                        <div class="review-wrapper">
                            <h2><tpl tplvar="product->ratingTotal"></tpl> review for Sleeve Button Cowl Neck</h2>
                            <div class="single-review" tpleach="product->reviews">
                                <div class="review-img">
                                    <img src="images/product-details/client-1.png" alt="">
                                </div>
                                <div class="review-content">
                                    <div class="review-top-wrap">
                                        <div class="review-name pr-20">
                                            <h5><span><tpl tplvar="val->customer->first_name"></tpl> <tpl tplvar="val->customer->last_name"></tpl></span> - <tpl tplvar="val->created"></tpl></h5>
                                        </div>
                                        <div class="product-rating review" tplvar="val->rating" set="review">

                                        </div>
                                    </div>
                                    <p tplvar="val->comment">Donec accumsan auctor iaculis. Sed suscipit arcu ligula, at egestas magna molestie a. Proin ac ex maximus, ultrices justo eget, sodales orci. Aliquam egestas libero ac turpis pharetra, in vehicula lacus scelerisque</p>
                                </div>
                            </div>
                        </div>
                        <div class="" tpluser="0">
                            <h5>You must be <a href="login"><b class="text-danger">login</b></a> to Review</h5>
                        </div>
                        <div class="ratting-form-wrapper" tpluser="1">
                            <span>Add a Review</span>
                            <div class="ratting-form">
                                <form action="review" method="post" tplform="">
                                    <input type="hidden" name="product_id" tplvar="product->id" set="value">
                                    <input type="hidden" id="review-rating-value" name="rating" value="5">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class='starrr'></div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="rating-form-style mb-20">
                                                <label>Your review <span>*</span></label>
                                                <textarea name="Your Review"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-submit">
                                                <input type="submit" value="Submit">
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
<div class="related-product pb-115">
    <div class="container">
        <div class="section-title mb-45 text-center">
            <h2>Related Product</h2>
        </div>
        <div class="related-product-active">
            <div class="product-plr-1" tpleach="Shop.related_products($product->product_type , 6)">
                <div class="single-product-wrap">
                    <div class="product-img product-img-zoom mb-15">
                        <a href="product-details.html" tplvar="val->link">
                            <img src="assets/images/product/product-13.jpg" alt="" tplimage="val->imagepath" width="270" height="324">
                        </a>

                    </div>
                    <div class="product-content-wrap-2 text-center">
                        <div class="product-rating-wrap">
                            <div class="product-rating review" tplvar="val->rating" set="review">
                            </div>
                            <span>({{ val->ratingTotal }})</span>
                        </div>
                        <h3><a href="{{val->link}}">{{ val->title }}</a></h3>
                        <div class="product-price-2">
                            <span>{{ val->price }}</span>
                        </div>
                    </div>
                    <div class="product-content-wrap-2 product-content-position text-center">
                        <div class="product-rating-wrap">
                            <div class="product-rating review" review="{{ val->rating }}">

                            </div>
                            <span>({{ val->ratingTotal }})</span>
                        </div>
                        <h3><a href="{{ val->link }}">{{ val->title }}</a></h3>
                        <div class="product-price-2">
                            <span>{{ val->price }}</span>
                        </div>
                        <div class="pro-add-to-cart">
                            <a href="{{ val->cartlink }}"><button title="View Details">Add To Cart</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script tplblock="start(scriptbottom)">
    $(document).ready(function (e){
        $('.starrr').starrr({
            rating: 5
        });

        $('.starrr').on('starrr:change', function(e, value){
            $("#review-rating-value").val(value)
        });


        $(document).on('click', '.option_selected', function(e){
            var li = $(this).closest("ul").find('li a');
            li.each(function (index) {
                $(this).removeClass("ck-active");
            })

            $(this).closest('li a').addClass('ck-active');
            event.preventDefault();
            $('#option_' + $(this).attr('data-name')).val($(this).attr('data-value'));
            $('#option_' + $(this).attr('data-name')).trigger('change');

        });

        $("#variant_id").change(function(){
            console.log($(this));
            $(this).addClass("d-none");
            console.log("selection option val",$(this).val());
            if($(this).val() == 0){
                $('.add-cart').text("Sold out");
            }else {
                var variantopj = JSON.parse($( "#variant_id option:selected").attr("data-opt"));
                $('.product-price').text("{{ Formats.moneySymbol() }}" + variantopj.price);
                $('.add-cart').text("Add To Cart");
            }

        });


       $('.add-to-cart-form').click(function(){
          $('#pro-add-to-cart').submit();
       });

    });

</script>

<div data-moneySymbol="{{ Formats.moneySymbol()}}" id="breadcrumb-area" class="breadcrumb-area bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="">Home</a>
                </li>
                <li class="active">{{ collection_title }} </li>
            </ul>
        </div>
    </div>
</div>
<div class="shop-area pt-80 pb-120">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="shop-topbar-wrapper">
                    <div class="shop-topbar-left">
                        <div class="view-mode nav">
                            <a class="active" href="#shop-1" data-toggle="tab"><i class="icon-grid"></i></a>
                            <a href="#shop-2" data-toggle="tab"><i class="icon-menu"></i></a>
                        </div>
                    </div>
                    <div class="product-sorting-wrapper">
                        <div class="product-shorting shorting-style">
                            <label>View :</label>
                            <select name="limit" id="limit">
                                <option value="20"> 20</option>
                                <option value="30"> 30</option>
                                <option value="40"> 40</option>
                            </select>
                        </div>
                        <div class="product-show shorting-style">
                            <label>Sort by :</label>
                            <select name="sort-by" id="sort-by">
                              {{ sort_by }}
                            </select>
                        </div>
                    </div>
                </div>
                <div tplcheck="Shop.check_result_set($products)" style="text-align: center">
                    <h4>Sorry. We cannot find any matches product!</h4>
                </div>
                <div  tplcheck="Shop.check_result_set($products, 0)">
                    <div class="tab-content jump">
                        <div id="shop-1" class="tab-pane active">
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" tpleach="products">
                                    <div class="single-product-wrap mb-35">
                                        <div class="product-img product-img-zoom mb-15">
                                            <a href="{{ val->link }}">
                                                <img src="assets/images/product/product-13.jpg" tplimage="val->imagepath" alt="" width="270" height="324">
                                            </a>
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
                                                <a href="{{ val->cartlink }}"><button title="Add to Cart">Add To Cart</button></a>
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
                                                <img src="assets/images/product/product-13.jpg" tplimage="val->imagepath" alt="Product Style" width="270" height="270">
                                            </a>
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
                                </div >
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
                        <div class="sidebar-search">
                            <form class="sidebar-search-form" method="GET" action="{{ request_uri }}">
                                <input type="text" name="q" placeholder="Search here...">
                                <button type="submit">
                                    <i class="icon-magnifier"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
                        <h4 class="sidebar-widget-title">Price Filter </h4>
                        <div class="price-filter">
                            <div id="slider-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
                            <div class="price-slider-amount">
                                <form method="GET" action="{{ request_uri }}">
                                    <div class="label-input">
                                        <h4 id="price-filter-label"></h4>
                                        <input type="hidden" id="amount" name="price-range" placeholder="Add Your Price">
                                    </div>
                                    <button type="submit">Filter</button>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="sidebar-widget shop-sidebar-border mb-35 pt-40">
                        <h4 class="sidebar-widget-title">Categories </h4>
                        <div class="shop-catigory">
                            <ul>
                                <li><a href="collection/bags">Bags</a></li>
                                <li><a href="collection/shalwarkameez">Shalwar Kameez</a></li>
                                <li><a href="collection/couple-dress">Couple Dress </a></li>
                                <li><a href="collection/shari">Shari </a></li>
                                <li><a href="collection/hoodie">Hoodie </a></li>
                                <li><a href="collection/t_shirt">T-Shirt </a></li>
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

<script tplblock="start(scriptbottom)">
    $(document).ready(function (e){
      var href = new URL(window.location.href);
      var url_redirect = function(key,val){

        href.searchParams.set(key,val);
        console.log(href.toString()); // https://google.com/?q=dogs
        window.location.href = href;

      };

      $('#sort-by').change(function(){
        url_redirect('sort-by', $(this).val());
      });

      $('#limit').change(function(){
        url_redirect('limit', $(this).val());
      });

      if(href.searchParams.get("limit") != null) $('#limit').val(href.searchParams.get("limit"));

        var money_symbol = $("#breadcrumb-area").attr('data-moneySymbol');
        var urlParams = new URLSearchParams(window.location.search);
        var price_range = urlParams.get('price-range');
        if (price_range !== null){
            price_range = price_range.split('-');
            $('#slider-range').slider({
                range: true,
                values: [price_range[0], price_range[1]]
            })
            $("#amount").val($('#slider-range').slider("values", 0) + "-" + $('#slider-range').slider("values", 1));
            $("#price-filter-label").text(money_symbol+ " " + $('#slider-range').slider("values", 0) + " - "+ money_symbol + " "+$('#slider-range').slider("values", 1));
        }
    });
</script>

<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
    <div class="items-cart-inner">
        <div class="basket">
            <i class="glyphicon glyphicon-shopping-cart"></i>
        </div>
        <div class="basket-item-count"><span class="count">{{cart_count}}</span></div>
        <div class="total-price-basket">
            <!-- <span class="lbl">cart -</span> -->
            <span class="total-price">
                <span class="sign"></span><span class="value">{{ Formats.moneyFormat($cart_total)}}</span>
            </span>
        </div>
    </div>
</a>
<ul class="dropdown-menu">
    <li>
        <div class="cart-item product-summary" tpleach="cart_products" set="product">
            <div class="row">
                <div class="col-xs-4">
                    <div class="image">
                        <a href="{{ product->link }}"><img src="images/cart.jpg" alt="" tplimage="product->imagepath"
                                height="41" height="41"></a>
                    </div>
                </div>
                <div class="col-xs-7">
                    <h3 class="name"><a href="">{{Formats.tokenTruncate($product->title, 20)}}</a></h3>
                    <div class="price">{{ Formats.moneyFormat($product->price) }}</div>
                </div>
            </div>
        </div>






        <!-- /.cart-item -->
        <div class="clearfix"></div>
        <hr>
        <div class="clearfix cart-total">
            <div class="pull-right">
                <span class="text">Sub Total :</span><span class='price'>{{
                    Formats.moneyFormat($cart_total)}}</span>
            </div>
            <div class="clearfix"></div>
            <a href="cart" class="btn btn-upper btn-primary btn-block m-t-20">Cart</a>
        </div>
        <!-- /.cart-total-->
    </li>
</ul>
<!-- /.dropdown-menu-->
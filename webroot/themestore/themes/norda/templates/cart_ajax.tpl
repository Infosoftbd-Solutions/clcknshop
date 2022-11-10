
<h3>Shopping Cart</h3>
<form action="cart" tplform="" id="mini-cart-form">
    <ul id="mini-cart-product">
        <li class="single-product-cart" tpleach="cart_products" set="product">
            <div class="cart-img">
                <a href="{{product->link}}"><img src="images/cart/cart-1.jpg" tplimage="product->imagepath" height="78" width="68" alt=""></a>
            </div>
            <div class="cart-title">
                <h4><a href="{{ product->link }}">{{ product->title }}</a></h4>
                <span> {{product->quantity}} × {{Formats.moneyFormat($product->price)}}	</span>
            </div>
            <!--<div class="cart-delete">
                <a href="#">×</a>
            </div>-->


        </li>
    </ul>
</form>
<div class="cart-total">
    <h4>Subtotal: <span id="mini-cart-total">{{ Formats.moneyFormat($cart_total) }}</span></h4>
</div>
<div class="cart-checkout-btn">
    <a class="btn-hover cart-btn-style" href="cart">view cart</a>
    <a class="no-mrg btn-hover cart-btn-style" href="checkout">checkout</a>
</div>
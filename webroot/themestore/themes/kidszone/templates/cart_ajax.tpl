
<a href="#" class="dropdown-toggle dropdown-arrow" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
    <i class="icon-shopping-cart"></i>
    <span class="cart-count badge-circle">{{ cart_count }}</span>
</a>

<div class="dropdown-menu">
    <div class="dropdownmenu-wrapper">
        <div class="dropdown-cart-header">
            <span>{{ cart_count }} Items</span>

            <a href="cart" class="float-right">View Cart</a>
        </div><!-- End .dropdown-cart-header -->

        <div class="dropdown-cart-products">
            <div class="product" tpleach="cart_products" set="product">
                <div class="product-details">
                    <h4 class="product-title">
                        <a href="{{ product->link }}">{{ product->title }}</a>
                    </h4>
                    <span class="cart-product-info"><span class="cart-product-qty">{{ product->quantity }}</span>x {{Formats.moneyFormat($product->price)}}</span>
                </div><!-- End .product-details -->

                <figure class="product-image-container">
                    <a href="{{ product->link }}" class="product-image">
                        <img src="images/products/cart/product-1.jpg" tplimage="product->image" alt="product" width="80" height="80">
                    </a>
                    <!--<a href="#" class="btn-remove icon-cancel" title="Remove Product"></a> -->
                </figure>
            </div><!-- End .product -->
        </div><!-- End .cart-product -->

        <div class="dropdown-cart-total">
            <span>Total</span>

            <span class="cart-total-price float-right">{{ cart_total }}</span>
        </div><!-- End .dropdown-cart-total -->

        <div class="dropdown-cart-action">
            <a href="checkout" class="btn btn-dark btn-block">Checkout</a>
        </div><!-- End .dropdown-cart-total -->
    </div><!-- End .dropdownmenu-wrapper -->
</div><!-- End .dropdown-menu -->
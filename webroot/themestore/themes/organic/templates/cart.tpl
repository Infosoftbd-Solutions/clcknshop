<div class="stricky-header stricked-menu main-menu">
    <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
</div><!-- /.stricky-header -->

<section class="page-header">
    <div class="page-header__bg" style="background-image: url({{ theme_root }}images/backgrounds/slider-vegetables.jpg);"></div>
    <!-- /.page-header__bg -->
    <div class="container">
        <h2>Cart</h2>
        <ul class="thm-breadcrumb list-unstyled">
            <li><a href="index.html">Home</a></li>
            <li>/</li>
            <li><span>Cart</span></li>
        </ul><!-- /.thm-breadcrumb list-unstyled -->
    </div><!-- /.container -->
</section><!-- /.page-header -->

<section class="cart-page">
    <div class="container">
        <div class="table-responsive">
            <form action="cart" tplform="" class="ck-cart-form">
            <table class="table cart-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <tr tpleach="cart_products" set="product">
                        <td>
                          <input type="hidden" value="{{ product->id }}" name="product_id[]">
                          <input type="hidden" value="{{ product->vid }}" name="variant_id[]">
                            <div class="product-box">
                                <img src="assets/images/products/cart-1-1.jpg" alt=""  tplimage="product->image" width="100">
                                <h3><a href="{{ product->link }}">{{ product->title }}</a></h3>
                            </div><!-- /.product-box -->
                        </td>
                        <td>{{Formats.moneyFormat($product->price)}}</td>
                        <td>
                            <div class="quantity-box">
                                <button type="button" class="sub">-</button>
                                <input type="number" name="quantity[]" value="{{ product->quantity }}" class="ck-cart-item-quantity"/>
                                <button type="button" class="add">+</button>
                            </div>
                        </td>
                        <td>
                            {{ Formats.moneyFormat($product->total) }}
                        </td>
                        <td>
                          <a href="/cart?action=remove&p_id={{ product->id }}&v_id={{ product->vid }}" class=" rmcartitem">  <i class="organik-icon-close remove-icon "></i></a>
                        </td>
                    </tr>

                </tbody>

            </table><!-- /.table -->
          </form>
        </div><!-- /.table-responsive -->
        <div class="row">
            <div class="col-lg-8">

            </div><!-- /.col-lg-8 -->
            <div class="col-lg-4">
                <ul class="cart-total list-unstyled">


                    <li>
                        <span>Total</span>
                        <span>{{ Formats.moneyFormat($cart_total) }}</span>
                    </li>
                </ul><!-- /.cart-total -->
                <div class="button-box">
                    <a href="/" class="thm-btn">Continue</a>
                      &nbsp;&nbsp;&nbsp;
                    <a href="/checkout" class="thm-btn">Checkout</a><!-- /.thm-btn -->
                </div><!-- /.button-box -->
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.cart-page -->

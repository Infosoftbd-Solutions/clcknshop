<div class="breadcrumb-wrap" style="margin-top: 10px !important;">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <ul id="breadcrumbs" class="breadcrumb">
                <li> <a href="/">Home</a> </li>

                <li class="item-current">Cart</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
	    <!--page title-->

	    <main>
	    	 <div class="product sec-gap">
	    	 	<div class="container">
	    	 		<div class="row">
	    	 			<div class="col-md-12 col-sm-12">
	    	 				<form action="cart" class="ck-cart-form" tplform="cart">
                                <table class="shop_table cart">
                                    <thead>
                                        <tr>
                                        	<th class="product-remove"> </th>
                                            <th class="product-name">Product Detail</th>
                                            <th class="product-price">Unit Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr class="cart_item ck-cart-item" tpleach="cart_products" set="product">

                                        	<td class="product-remove" data-title="Remove">
																						<input type="hidden" value="{{ product->id }}" name="product_id[]">
																					   <input type="hidden" value="{{ product->vid }}" name="variant_id[]">
																					      <a href="#" class="remove ck-cart-item-remove" title="Remove this item">
                                                    <i class="pe-7s-close-circle"></i>
                                                </a>
                                            </td>

                                            <td data-title="Product">
                                                <a href="{{ product->link }}" class="cart-product">
                                                    <img src="assets/images/product-small.jpg" alt="Product thumbnail" tplimage="product->image">
                                                </a>
                                                <span>{{ product->title }} </span>
                                                <small>{{product->option}}</small>
                                            </td>

                                            <td class="product-price" data-title="Price">
                                                {{ Formats.moneyFormat($product->price) }}
                                            </td>

                                            <td class="product-quantity" data-title="Quantity">
                                                <div class="quantity-wrap">
                                                    <button type="button" class="qtyminus">-</button>
                                                    <input type="number" name="quantity[]" value="{{ product->quantity }}"  class="qty ck-cart-item-quantity">
                                                    <button type="button" class="qtyplus">+</button>
                                                </div>
                                            </td>

                                            <td class="product-subtotal" data-title="Shop">
                                                {{ Formats.moneyFormat($product->total) }}
                                            </td>
                                        </tr>
                                        <!--cart item-->



                                        <tr>
                                            <td colspan="5" class="actions">
                                                <!-- <div class="coupon">
                                                    <input type="text"  placeholder="Coupon code">
                                                    <input type="submit" value="Apply coupon">
                                                </div>

                                                <input type="submit" class="button" value="Update cart"> -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                            <!--cart form-->

                            <div class="cart-collaterals">
                                <div class="cart_totals">
                                    <h2>Cart Totals</h2>

                                    <table class="shop_table">
                                        <tr class="cart-subtotal">
                                            <th>Subtotal:</th>
                                            <td>{{ Formats.moneyFormat($cart_total) }}</td>
                                        </tr>

                                        <tr class="cart-subtotal">
                                            <th>Shipping/Handling:</th>
                                            <td>Calculate next step</td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td>{{ Formats.moneyFormat($cart_total) }}</td>
                                        </tr>
                                    </table>

                                    <div class="cart-proceed">
                                        <a href="/checkout" class="btn btn-default ">
                                             Checkout <i class="pe-7s-cart"></i>
                                        </a>

                                        <a href="/" class="btn bdr">
                                            Continue Shopping <i class="pe-7s-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
	    	 			</div>
	    	 		</div>
	    	 	</div>
	    	 </div>
	    </main>
	    <!--main-->
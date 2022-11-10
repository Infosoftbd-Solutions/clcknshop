<main class="main">
  <nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href=""><i class="icon-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
      </ol>
    </div><!-- End .container -->
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="cart-table-container">
          <form action="cart" tplform="" class="ck-cart-form">
            <table class="table table-cart">
              <thead>
              <tr>
                <th class="product-col">Product</th>
                <th class="price-col">Price</th>
                <th class="qty-col">Qty</th>
                <th>Subtotal</th>
              </tr>
              </thead>
              <tbody>
              <tr class="product-row ck-cart-item" tpleach="cart_products">
                <input type="hidden" value="{{ val->id }}" name="product_id[]">
                <input type="hidden" value="{{ val->vid }}" name="variant_id[]">
                <td class="product-col">
                  <figure class="product-image-container">
                    <a href="{{val->link}}" class="product-image">
                      <img src="" tplimage="val->image" width="50" height="50" alt="product">
                    </a>
                  </figure>
                  <h2 class="product-title">
                    <a href="{{ val->link }}">{{ val->title }}</a><br>
                    <small>{{val->option}}</small>
                  </h2>
                </td>
                  <td>{{Formats.moneyFormat($val->price)}}</td>
                  <td>
                    <input name="quantity[]" value="{{ val->quantity }}" class="vertical-quantity form-control ck-cart-item-quantity" type="text">
                  </td>
                  <td>{{ Formats.moneyFormat($val->total) }}</td>
                  <td>
                    <a href="javascript::void(0)" class="btn-remove icon-cancel ck-cart-item-remove" title="Remove Product"></a>
                  </td>
              </tr>
              </tbody>

              <tfoot>
              <tr>
                <td colspan="4" class="clearfix">
                  <div class="float-left">
                    <a href="" class="btn btn-outline-secondary">Continue Shopping</a>
                  </div><!-- End .float-left -->
                </td>
              </tr>
              </tfoot>
            </table>
          </form>
        </div><!-- End .cart-table-container -->
      </div><!-- End .col-lg-8 -->

      <div class="col-lg-4">
        <div class="cart-summary">
          <h3>Summary</h3>
          <table class="table table-totals">
            <tfoot>
            <tr>
              <td>Cart Total</td>
              <td>{{ Formats.moneyFormat($cart_total) }}</td>
            </tr>
            </tfoot>
          </table>
          <div class="checkout-methods">
            <a href="checkout" class="btn btn-block btn-sm btn-primary">Go to Checkout</a>
          </div><!-- End .checkout-methods -->
        </div><!-- End .cart-summary -->
      </div><!-- End .col-lg-4 -->
    </div><!-- End .row -->
  </div><!-- End .container -->

  <div class="mb-6"></div><!-- margin -->
</main><!-- End .main -->

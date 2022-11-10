<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>Shopping Cart</li>
            </ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class="container">
        <div class="row ">
            <div class="shopping-cart">
                <div class="shopping-cart-table ">
                    <div class="table-responsive">
                        <form action="cart" tplform="" class="ck-cart-form">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="cart-romove item">Remove</th>
                                        <th class="cart-description item">Image</th>
                                        <th class="cart-product-name item">Product Name</th>

                                        <th class="cart-qty item">Quantity</th>
                                        <th class="cart-sub-total item">Subtotal</th>
                                        <th class="cart-total last-item">Grandtotal</th>
                                    </tr>
                                </thead>
                                <!-- /thead -->

                                <tbody>
                                    <tr class="product-row ck-cart-item" tpleach="cart_products" set="item">
                                        <input type="hidden" value="{{ item->id }}" name="product_id[]">
                                        <input type="hidden" value="{{ item->vid }}" name="variant_id[]">

                                        <td class="romove-item">
                                            <a href="javascript::void(0)" title="cancel"
                                                class="icon ck-cart-item-remove"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                        <td class="cart-image">
                                            <a class="entry-thumbnail" href="{{ item->link }}">
                                                <img src="images/products/p1.jpg" alt="" tplimage="item->imagepath">
                                            </a>
                                        </td>
                                        <td class="cart-product-name-info">
                                            <h4 class='cart-product-description'>
                                                <a href="{{ item->link }}">{{item->title}}</a>
                                            </h4>

                                            <!-- /.row -->
                                            <div class="cart-product-info">
                                                <span class="product-color">{{item->option}}</span>
                                            </div>
                                        </td>

                                        <td class="cart-product-quantity">
                                            <div class="quant-input">
                                                <div class="arrows">
                                                    <div class="arrow plus gradient"><span class="ir"><i
                                                                class="icon fa fa-sort-asc"></i></span></div>
                                                    <div class="arrow minus gradient"><span class="ir"><i
                                                                class="icon fa fa-sort-desc"></i></span></div>
                                                </div>
                                                <input name="quantity[]" type="text" value="{{item->quantity}}"
                                                    class="ck-cart-item-quantity">
                                            </div>
                                        </td>
                                        <td class="cart-product-sub-total">
                                            <span
                                                class="cart-sub-total-price">{{Formats.moneyFormat($item->price)}}</span>
                                        </td>
                                        <td class="cart-product-grand-total">
                                            <span class="cart-grand-total-price">
                                                {{Formats.moneyFormat($item->total)}}
                                            </span>
                                        </td>
                                    </tr>

                                </tbody>
                                <!-- /tbody -->
                            </table>
                            <!-- /table -->
                        </form>

                    </div>
                </div>
                <!-- /.shopping-cart-table -->

                <div class="col-md-4 col-sm-12 cart-shopping-total pull-right">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="cart-grand-total">
                                        Grand Total<span class="inner-left-md"> {{Formats.moneyFormat($cart_total)}}
                                        </span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <!-- /thead -->
                        <tbody>

                            <tr>
                                <td>
                                    <div class="pull-right">
                                        <a href="checkout" class="btn btn-primary checkout-btn">PROCCED TO
                                            CHEKOUT</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <!-- /tbody -->
                    </table>
                    <!-- /table -->
                </div>
                <!-- /.cart-shopping-total -->
            </div>
            <!-- /.shopping-cart -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
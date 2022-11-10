<div class="breadcrumb-area bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li class="active">Cart Page </li>
            </ul>
        </div>
    </div>
</div>

<div class="cart-main-area pt-115 pb-120">
    <div class="container">
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12" id="shopping-cart">
                <form action="cart" tplform="" class="ck-cart-form">
                    <div class="table-content table-responsive cart-table-content">
                        <div tplcheck="Shop.check_array($cart_products)" style="text-align: center">
                            <h4>You have no items in your shopping cart.</h4>
                        </div>

                        <table tplcheck="Shop.check_array($cart_products, 0)">
                            <thead>
                            <tr>
                                <th width="10%">Image</th>
                                <th width="60%">Product Name</th>
                                <th width="10%">Until Price</th>
                                <th width="5%">Qty</th>
                                <th width="10%">Subtotal</th>
                                <th width="5%">action</th>
                            </tr>
                            </thead>
                            <tbody id="cart_items">
                            <tr tpleach="cart_products">
                                <input type="hidden" name="product_id[]" value="0" tplvar="val->id">
                                <input type="hidden" name="variant_id[]" value="0" tplvar="val->vid">

                                <td class="product-thumbnail">
                                    <a href="{{val->link}}"><img src="" tplimage="val->imagepath" width="95" height="110" alt=""></a>
                                </td>
                                <td class="product-name" style="text-align: left">
                                    <a href="{{ val->link }}"> {{ val->title }}</a>
                                    <p><small>{{val->option}}</small></p>
                                </td>
                                <td class="product-price-cart item-price"><span class="amount" tplvar="Formats.moneyFormat($val->price)"></span></td>
                                <td class="product-quantity pro-details-quality">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box quantity" type="text" tplvar="val->quantity" name="quantity[]" value="1">
                                    </div>
                                </td>
                                <td class="product-subtotal item-total" tplvar="Formats.moneyFormat($val->total)"> </td>
                                <td class="product-remove">
                                    <a href="javascript:void(0)" class="remove-item"><i class="icon_close"></i></a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="">Continue Shopping</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-4 ml-auto col-md-12">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                            </div>
                            <h5>Total products <span id="subtotal" tplvar="Formats.moneyFormat($cart_total)">0.00</span></h5>
                            <a href="checkout">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script tplblock="start(scriptbottom)">
    $(document).ready(function (e) {
        $(".quantity").change(function (e) {
           e.preventDefault();
           console.log($(this).val());
            $(".ck-cart-form")[0].submit();
        });

        $(".remove-item").click(function (e) {
            e.preventDefault();
            $(this).closest("tr").remove();
            $(".ck-cart-form")[0].submit();
        });

    });

</script>

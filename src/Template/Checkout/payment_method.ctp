<?php
$shipping_address = $checkout['shipping_address'];
$cart_products = $checkout['products'];
$order = $checkout['order'];
$order_total = $order['order_total'];
//pr($payment_processors);
$this->assign("layout","checkout");
?>

<div class="row py-5">
    <div class="col-md-7 order-md-1" style="padding-right: 50px !important; border-right: 1px solid #ededed">
        <div class="d-flex justify-content-between pb-3">
            <h4 class="font-weight-normal">Payment Method</h4>
            <h6 class="pt-2 text-muted font-weight-light"><a
                        href="<?= $this->Url->build(['controller' => 'checkout', 'action' => 'index', '?'=>['c_sess_id'=>$checkout['sess_id']]]) ?>"><i
                            class="fa fa-arrow-left"></i>Back to information</a></h6>
        </div>

        <?= $this->Form->create(null, ['id' => 'checkout', 'url' => ['action' => 'payment','?'=>['c_sess_id'=>$checkout['sess_id']]]]) ?>
        <?php foreach ($payment_processors as $payment_processor): ?>
            <div class="d-flex justify-content-between">
                <div data-charge="60" class="custom-control custom-radio">
                    <input required name="payment_processor" type="radio" value="<?= $payment_processor['id'] ?>"
                           class="custom-control-input" id="payment_<?= $payment_processor['class'] ?>">
                    <label class="custom-control-label"
                           for="payment_<?= $payment_processor['class'] ?>"><?= $payment_processor['name'] ?> </label>
                </div>
            </div>
            <?php
            $c = strtolower($payment_processor['class']);
            $element = $this->Tplparser->compile("payment_processor/{$c}.tpl");
            if(!empty($element)){
                include_once $element;
            }else{
                if ($this->elementExists("{$payment_processor['class']}Payment.checkout"))
                    echo $this->element("{$payment_processor['class']}Payment.checkout");
            }
            ?>
        <?php endforeach; ?>

        <div class="row pt-5">
            <div class="col-12">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="1" name="same_address" checked class="custom-control-input"
                           id="same-address">
                    <label class="custom-control-label" for="same-address">Billing address is the same as my Shipping
                        address</label>
                </div>
            </div>


            <div class="col-12 pb-2 pt-3">
                <h5 class="font-weight-light">Billing Information</h5>
            </div>
        </div>
        <div id="billing-form">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" name="billing[first_name]" class="form-control" id="firstName"
                           placeholder="First Name"
                           value="<?= isset($shipping_address['first_name']) ? $shipping_address['first_name'] : '' ?>"
                           required="">
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <!--                    <label for="lastName">Last name</label>-->
                    <input type="text" name="billing[last_name]" class="form-control" id="lastName"
                           placeholder="Last Name"
                           value="<?= isset($shipping_address['last_name']) ? $shipping_address['last_name'] : '' ?>"
                           required="">
                    <div class="invalid-feedback">
                        Valid last name is required.
                    </div>
                </div>

            </div>

            <div class="mb-3">
                <!--                <label for="email">Email</label>-->
                <input type="email" name="billing[email]" class="form-control" id="email"
                       placeholder="Email - jerry@example.com"
                       value="<?= isset($shipping_address['email']) ? $shipping_address['email'] : '' ?>">
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
            </div>

            <div class="mb-3">
                <!--                <label for="address">Address</label>-->
                <textarea rows="3" name="billing[address]" class="form-control" id="address"
                          placeholder="Address - 1234 Main St"
                          required=""><?= isset($shipping_address['address']) ? $shipping_address['address'] : '' ?></textarea>
                <div class="invalid-feedback">
                    Please enter your shipping address.
                </div>
            </div>

            <div class="mb-3 mt-1">
                <!--                <label for="email">Email</label>-->
                <input type="email" name="billing[area]" class="form-control" id="area" placeholder="Area"
                       value="<?= isset($shipping_address['area']) ? $shipping_address['area'] : '' ?>">
                <div class="invalid-feedback">
                    Please enter area address for shipping updates.
                </div>
            </div>

            <div class="row">
                <?= $this->TablerForm->control('city', ['row' => 6, 'label' => false, 'id' => 'shipping_city', 'required', 'value' => isset($shipping_address['city']) ? $shipping_address['city'] : '']); ?>
                <div class="col-md-6 mt-1">
                    <!--                    <label for="zip">Zip</label>-->
                    <input name="billing[post_code]" type="text" class="form-control" id="zip"
                           value="<?= isset($shipping_address['post_code']) ? $shipping_address['post_code'] : '' ?>"
                           placeholder="Zip/Post Code" required="">
                    <div class="invalid-feedback">
                        post code required.
                    </div>
                </div>
            </div>


            <div class="row">
                <?= $this->TablerForm->control('country', ['country' => true, 'row' => 6, 'label' => false, 'required', 'value' => isset($shipping_address['country']) ? $shipping_address['country'] : '']) ?>

                <div class="col-md-6 mt-1">
                    <!--                    <label for="zip">Zip</label>-->
                    <input name="billing[phone]" type="text" class="form-control" id="phone"
                           value="<?= isset($shipping_address['phone']) ? $shipping_address['phone'] : '' ?>"
                           placeholder="Phone Number" required="">
                    <div class="invalid-feedback">
                        phone number required.
                    </div>
                </div>
            </div>

        </div>

        <?= $this->Form->end() ?>

    </div>

    <div class="col-md-5 order-md-2 mb-4" style="padding-left: 50px !important; border-left: 1px solid #ededed">

        <?php

        $subtotal = 0;
        foreach ($cart_products as $product):
            $subtotal += $product['price'] * $product['quantity'];
            ?>
            <div class="row product-item py-3 justify-content-between" style="border-bottom: 1px solid #e3e3e3">
                <div class="d-flex justify-content-start">

                    <div class="checkout-product-img-wrapper d-inline-block" style="position: relative;">
                        <img class="item-thumb img-thumbnail img-rounded "
                             src="<?= $this->Media->productImage($product['image'], $product['id'], ['width' => '64px', 'height' => '64px', 'path' => true]) ?>"
                             alt="<?= $product['title'] ?>" title="<?= $product['title'] ?>"
                             style="width: 64px; height: 64px;">
                        <span style="position: absolute; right: 0; top: 0; border-radius: 50%;"
                              class="badge badge-success"><?= $product['quantity'] ?></span>
                    </div>

                    <div class="item-text d-flex align-items-center " style="padding-left: 15px;">
                        <p style="margin-bottom: 0;"><?= substr($product['title'], 0, 45) ?> </br>
                            <small>
                                <?php
                                $opt = '';
                                $options = json_decode($product['option'], true);
                                if ($options)
                                    foreach ($options as $key => $option) $opt .= $key . " : " . $option . ", ";
                                echo substr($opt, 0, -2);
                                ?>
                            </small>
                        </p>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <span><?= $this->Formats->moneySymbol() ?> <?= number_format($product['price'] * $product['quantity'], 2) ?></span>
                </div>
            </div>

        <?php endforeach; ?>

        <div class="d-flex justify-content-between" style="padding-top: 30px; !important;">
            <b>Subtotal</b>
            <p><b><?= $this->Formats->moneySymbol() ?> <span
                            id="subtotal"><?= number_format($order['subtotal'], 2) ?></span></b></p>
        </div>

        <div class="d-flex justify-content-between">
            <p>Discount(-)</p>
            <span><?= $this->Formats->moneySymbol() ?> <span
                        id="discount"><?= number_format($order['discount'], 2) ?></span></span>
        </div>

        <div class="row" style="border-top: 1px solid #e3e3e3">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <b>Total</b>
                    <p><b><?= $this->Formats->moneySymbol() ?> <span
                                    id="total"><span> <?= number_format($order['subtotal'] - $order['discount'], 2) ?> </span></span></b>
                    </p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <p>Shipping Charge(+)</p>
            <p><?= $this->Formats->moneySymbol() ?> <span
                        id="shipping_charge"><?= number_format($order['shipping_fee'], 2) ?></span></p>
        </div>
        <div class="row" style="border-top: 1px solid #e3e3e3">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <p><b>Grand Total</b></p>
                    <b><?= $this->Formats->moneySymbol() ?> <span
                                id="grand_total"><?= number_format(($order['subtotal'] - $order['discount']) + $order['shipping_fee'], 2) ?></span></b>
                </div>
            </div>
        </div>


        <button class="btn btn-primary mt-5"
                onclick="event.preventDefault(); document.getElementById('checkout').submit();" type="button">Continue
            to checkout
        </button>

    </div>

</div>

<script>

    require(['jquery'], function ($) {
        $(document).ready(function () {

            $("input:radio[name=payment_processor]:first").attr('checked', true);
            $("input:radio[name=payment_processor]").change(function () {
                console.log("on change", "." + $(this).attr('id'));
                $('.payment_processor_div').hide();
                if ($(this).is(':checked')) {
                    $("." + $(this).attr('id')).show();
                } else {
                    console.log($("." + $(this).attr('id')));
                    $("." + $(this).attr('id')).hide();
                }
            });

            $("input:radio[name=payment_processor]").trigger("change");

            $("#billing-form input, #billing-form textarea, #billing-form select").prop("disabled", true);
            $('#same-address').click(function (e) {
                if ($(this).is(":checked")) {
                    $("#billing-form input, #billing-form textarea, #billing-form select").prop("disabled", true);
                } else if ($(this).is(":not(:checked)")) {
                    $("#billing-form input, #billing-form textarea, #billing-form select").prop("disabled", false);
                }
            });
        });
    });

</script>

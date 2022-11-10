<?php
    $cart_products = $checkout['products'];
    $shipping_address = $checkout['shipping_address'];
    $discount = $checkout['order']['discount'];
    //  pr($checkout['sess_id']);
    $this->assign("layout","checkout");
?>

<div class="row py-5">
    <div class="col-md-7 order-md-1" style="padding-right: 50px !important; border-right: 1px solid #ededed">
        <div class="d-flex justify-content-between pb-3">
            <h4 class="font-weight-normal">Shipping Address</h4>
            <?php if (!$this->getRequest()->session()->read('customer_logged_in')):?>
                <h6 class="pt-2 text-muted font-weight-light">Already have an account? <a href="<?= $this->Url->build(['controller' => 'Customers', 'action' => 'login']) ?>">Log in</a></h6>
            <?php endif; ?>
        </div>

        <?= $this->Form->create(null, ['id'=>'checkout','url' => ['action'=>'index','?'=>['c_sess_id'=>$checkout['sess_id']]]]) ?>
        <div class="row">
            <div class="col-md-6 mb-3">
                <!--                    <label for="firstName">First name</label>-->
                <input type="text" name="first_name" class="form-control" id="firstName" placeholder="First Name" value="<?= isset($shipping_address['first_name'])? $shipping_address['first_name'] : ''?>" required>
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <!--                    <label for="lastName">Last name</label>-->
                <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Last Name" value="<?= trim(isset($shipping_address['last_name'])? $shipping_address['last_name'] : '')?>" required>
                <div class="invalid-feedback">
                    Valid last name is required.
                </div>
            </div>
        </div>
        <div class="mb-3">
            <!--                <label for="email">Email</label>-->
            <input type="email" name="email" class="form-control" id="email" placeholder="Email - jerry@example.com" value="<?= isset($shipping_address['email'])? $shipping_address['email'] : ''?>" >
            <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
            </div>
        </div>

        <div class="mb-3">
            <!--                <label for="address">Address</label>-->
            <textarea rows="3" name="address" class="form-control" id="address" placeholder="Address - 1234 Main St" required><?= isset($shipping_address['address'])? $shipping_address['address'] : ''?></textarea>
            <div class="invalid-feedback">
                Please enter your shipping address.
            </div>
        </div>

        <!--            <div class="mb-3">-->
        <!--                <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>-->
        <!--                <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">-->
        <!--            </div>-->

        <div class="row">

            <?= $this->TablerForm->control('area',['row'=>12,'label'=>false,'id'=>'area','required', 'placeholder' => 'Area', 'value' => isset($shipping_address['area']) ? $shipping_address['area'] : '']); ?>
            <?= $this->TablerForm->control('city',['row'=>6,'label'=>false,'id'=>'shipping_city','required','placeholder' => 'City']); ?>

            <div class="col-md-6 mt-2">
                <!--                    <label for="zip">Zip</label>-->
                <input name="post_code" type="text" class="form-control" id="zip" value="<?= isset($shipping_address['post_code']) ? $shipping_address['post_code'] : '' ?>" placeholder="Zip/Postal Code-1219" >
                <div class="invalid-feedback">
                    Post code required.
                </div>
            </div>

            <?= $this->TablerForm->control('country', ['country' => true, 'row' => 6, 'label' => false, 'required', 'value'=>isset($shipping_address['country']) ? $shipping_address['country'] : '']) ?>

            <div class="col-md-6 mt-2">
                <!--                    <label for="zip">Zip</label>-->
                <input name="phone" type="text" class="form-control" id="phone" value="<?= isset($shipping_address['phone']) ? $shipping_address['phone'] : '' ?>" placeholder="Phone Number" required>
                <div class="invalid-feedback">
                    Phone Number required.
                </div>
            </div>

        </div>

      <!--  <div class="custom-control mt-3 custom-checkbox">
            <input name="save_info" type="checkbox" class="custom-control-input" id="save-info">
            <!--<label class="custom-control-label" for="save-info">Save this information for next time</label> -->
      <!--  </div> -->
        <div class="row">
          <div class="col-md-6 mt-2">
          </div>
          <div class="col-md-6 mt-2" align="right">
          <!--  <button class="btn btn-primary mt-5" onclick="event.preventDefault(); document.getElementById('checkout').submit();" type="button">Continue to checkout</button> -->
            <button class="btn btn-primary mt-5"  type="submit">Continue to checkout</button>

          </div>
        </div>


        <!--            <div class="custom-control custom-checkbox">-->
        <!--                <input type="checkbox" checked class="custom-control-input" id="same-address">-->
        <!--                <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>-->
        <!--            </div>-->

<!--        <input type="hidden" id="" class="form-control" name="code" required placeholder="Promo code">-->
        <?= $this->Form->hidden('code', ['id' => 'coupon_code', 'value' => '']) ?>

        <?= $this->Form->end() ?>
    </div>

    <div class="col-md-5 order-md-2 mb-4" style="padding-left: 50px !important; border-left: 1px solid #ededed">

        <?php

            $subtotal = 0;
            foreach ($cart_products as $product):
            $subtotal += $product['price'] * $product['quantity'];

        ?>
            <div class="row product-item py-3 justify-content-between" style="border-bottom: 1px solid #e3e3e3" >
                <div class="d-flex justify-content-start">

                    <div class="checkout-product-img-wrapper d-inline-block" style="position: relative;">
                        <img class="item-thumb img-thumbnail img-rounded " src="<?= $this->Media->productImage($product['image'],$product['id'],['width'=>'64px', 'height'=> '64px', 'path'=>true]) ?>" alt="<?= $product['title'] ?>" title="<?= $product['title'] ?>" style="width: 64px; height: 64px;">
                        <span style="position: absolute; right: 0; top: 0; border-radius: 50%;" class="badge badge-success"><?= $product['quantity'] ?></span>
                    </div>

                    <div class="item-text d-flex align-items-center " style="padding-left: 15px;">
                        <p style="margin-bottom: 0;"><?= substr($product['title'], 0, 45)  ?> </br>
                        <small>
                            <?php
                            $opt = '';
                            $options = json_decode($product['option'], true);
                            if ($options)
                                foreach ($options as $key => $option) $opt .=  $key." : ".$option.", ";
                            echo substr($opt, 0, -2);
                            ?>
                        </small>
                        </p>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <span><?= $this->Formats->moneySymbol() ?> <?= number_format($product['price'] * $product['quantity'], 2)  ?></span>
                </div>
            </div>

        <?php endforeach; ?>


        <div class="d-flex justify-content-between" style="padding-top: 30px; !important; border-top: 1px solid #e3e3e3">
            <p><b>Subtotal</b></p>
            <p><?= $this->Formats->moneySymbol() ?> <?= number_format($subtotal, 2)?></p>
        </div>

        <div class="d-flex justify-content-between">
            <p><b>Discount</b></p>
            <p><?= $this->Formats->moneySymbol() ?> <?= number_format($discount, 2)?></p>
        </div>

        <div class="d-flex justify-content-between" style="padding-top: 30px; !important; border-top: 1px solid #e3e3e3">
            <p><b>Total</b></p>
            <p><?= $this->Formats->moneySymbol() ?> <?= number_format($subtotal-$discount, 2)?></p>
        </div>



        <div class="pt-5">

            <div class="input-group">
                <input type="text" class="form-control" name="code" id="coupon_input" placeholder="Promo code">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary checkout-form-btn">Apply</button>
                </div>
                <div id="invalidfeedback" class="invalid-feedback">
                    Please provide your coupon code.
                </div>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>


        </div>


    </div>
</div>

<script>

    require(['jquery'], function ($, autocomplete) {
        $(document).ready(function() {
            $(".checkout-form-btn").click(function (e) {
                e.preventDefault();
                let v = $("#coupon_input").val().trim();
                if (v.length > 0){
                    $("#coupon_code").val(v);
                    $("#checkout").submit()
                }else{
                    $("#coupon_input").addClass('is-invalid');
                }

            })
            $("#coupon_input").keyup(function (e) {
                if($("#coupon_input").val().trim().length > 6){
                    $("#coupon_input").removeClass('is-invalid');
                    $("#coupon_input").addClass('is-valid');
                }else{
                    $("#coupon_input").removeClass('is-valid');
                    $("#coupon_input").addClass('is-invalid');
                }
            })


        });
    });


</script>

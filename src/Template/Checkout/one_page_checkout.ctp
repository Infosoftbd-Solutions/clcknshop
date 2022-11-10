<?php
    // pr($checkout);
    $cart_products = $checkout['products'];
    $shipping_address = $checkout['shipping_address'];
    $billing_address = $checkout['billing_address'];
    $shipping_methods = $checkout['shipping_methods'];
    $payment_processors = $checkout['payment_processors'];
    $discount = $checkout['order']['discount'];
    $sub_total = $checkout['order']['sub_total'];
    $order_total = $checkout['order']['sub_total'];
    $shipping_weight = $checkout['order']['shipping_weight'];
    $this->assign("layout","checkout");
?>
<style>
  .bg-ckout {
    background: #f6f6f6;
  }
</style>

<div class="my-3 my-md-5">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?= $this->Form->create(null, ['action' => 'OnePageCheckout']) ?>
          <div class="row">
            <div class="col-md-6 col-lg-4">
              <div class="card bg-ckout">
                <div class="card-header">
                  <h4>Shipping Address</h3>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <input type="text" name="shipping[first_name]" class="form-control" id="firstName" placeholder="First Name" value="<?= isset($shipping_address['first_name'])? $shipping_address['first_name'] : ''?>" required>
                  </div>
                  <div class="form-group">
                    <input type="text" name="shipping[last_name]" class="form-control" id="lastName" placeholder="Last Name" value="<?= isset($shipping_address['last_name'])? $shipping_address['last_name'] : ''?>" required>
                  </div>
                  <div class="form-group">
                    <input type="text" name="shipping[email]" class="form-control" id="email" placeholder="email- jerry@example.com" value="<?= isset($shipping_address['email'])? $shipping_address['email'] : ''?>" required>
                  </div>
                  <div class="form-group">
                    <input name="shipping[phone]" type="text" class="form-control" id="phone" value="<?= isset($shipping_address['phone']) ? $shipping_address['phone'] : '' ?>" placeholder="Phone Number" required>
                  </div>

                  <div class="form-group">
                    <textarea name="shipping[address]" class="form-control" id="address" placeholder="Address - 1234 Main St" required><?= isset($shipping_address['address'])? $shipping_address['address'] : ''?></textarea>
                  </div>
                  <div class="form-group">
                    <input type="text" name="shipping[area]" class="form-control" id="area" placeholder="Area" value="<?= isset($shipping_address['area'])? $shipping_address['area'] : ''?>" required>
                  </div>
                  <div class="form-group">
                    <input type="text" name="shipping[city]" class="form-control" id="city" placeholder="City" value="<?= isset($shipping_address['city'])? $shipping_address['city'] : ''?>" required>
                  </div>
                  <div class="form-group">
                    <input name="shipping[post_code]" type="text" class="form-control" id="zip" value="<?= isset($shipping_address['post_code']) ? $shipping_address['post_code'] : '' ?>" placeholder="Zip/Postal Code-1219">
                  </div>

                  <div class="form-group">
                    <?=$this->Form->select('shipping[country]',$this->TablerForm->country_data(),['value'=>isset($shipping_address['country']) ? $shipping_address['country'] : '','class'=>"form-control", 'id'=>"country"])?>
                    <!--<input name="shipping[country]" type="text" class="form-control" id="country" value="<?= isset($shipping_address['country']) ? $shipping_address['country'] : '' ?>" placeholder="Country"> -->
                  </div>

                  <div class="form-group">
                    <input  name="shipping[password]" type="text" class="form-control d-none" id="password" value="<?= isset($shipping_address['password']) ? $shipping_address['password'] : '' ?>" placeholder="Password">
                  </div>


                  <div class="form-group">
                    <label class="custom-switch" style="padding-left:0px !important">
                      <input type="checkbox" name="custom-switch-checkbox-password" class="custom-switch-input" id="check_box_password">
                      <span class="custom-switch-indicator"></span>
                      <span class="custom-switch-description">Create an account for later use</span>
                    </label>
                  </div>

                  <div class="form-group">
                    <label class="custom-switch" style="padding-left:0px !important">
                      <input type="checkbox" name="custom-switch-checkbox-billing" class="custom-switch-input" id="check_box_billing_address" checked>
                      <span class="custom-switch-indicator"></span>
                      <span class="custom-switch-description">Billing address is the same as my Shipping address</span>
                    </label>
                  </div>

                  <div class="billing_address d-none" id="billing_address">
                        <div class="form-group">
                            <input type="text" name="billing[first_name]" class="form-control" id="firstName" placeholder="First Name" value="<?= isset($billing_address['first_name'])? $billing_address['first_name'] : ''?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="billing[last_name]" class="form-control" id="lastName" placeholder="Last Name" value="<?= isset($billing_address['last_name'])? $billing_address['last_name'] : ''?>" >
                        </div>
                        <div class="form-group">
                            <input type="text" name="billing[email]" class="form-control" id="email" placeholder="email- jerry@example.com" value="<?= isset($billing_address['email'])? $billing_address['email'] : ''?>" >
                        </div>
                        <div class="form-group">
                            <input name="billing[phone]" type="text" class="form-control" id="phone" value="<?= isset($billing_address['phone']) ? $billing_address['phone'] : '' ?>" placeholder="Phone Number" >
                        </div>

                        <div class="form-group">
                            <textarea novalidate name="billing[address]" class="form-control" id="address" placeholder="Address - 1234 Main St"><?= isset($billing_address['address'])? $billing_address['address'] : ''?></textarea>
                        </div>

                        <div class="form-group">
                            <input type="text" name="billing[area]" class="form-control" id="area" placeholder="Area" value="<?= isset($billing_address['area'])? $billing_address['area'] : ''?>" >
                        </div>
                        <div class="form-group">
                            <input type="text" name="billing[city]" class="form-control" id="city" placeholder="City" value="<?= isset($billing_address['city'])? $billing_address['city'] : ''?>" >
                        </div>
                        <div class="form-group">
                            <input name="billing[post_code]" type="text" class="form-control" id="zip" value="<?= isset($billing_address['post_code']) ? $billing_address['post_code'] : '' ?>" placeholder="Zip/Postal Code-1219">
                        </div>

                        <div class="form-group">
                            <input name="billing[country]" type="text" class="form-control" id="country" value="<?= isset($billing_address['country']) ? $billing_address['country'] : '' ?>" placeholder="Country">
                        </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card bg-ckout">
                    <div class="card-header">
                    <h4 id="shipping_weight" data-weight="<?= $shipping_weight ?>" >Shipping Method</h4>
                    </div>
                    <div class="card-body ship_method">
                        <?php foreach ($shipping_methods as $key => $shipping_method): ?>
                            <div class="d-flex justify-content-between">
                                <div class="custom-control custom-radio">
                                    <input <?= $key == 0 ? 'checked' : '' ?> data-price="<?= $shipping_method['price'] ?>" data-flat="<?= $shipping_method['flat_rate'] == 1 ? 1 : 0 ?>" required name="shipping_method" type="radio" value="<?= $shipping_method['id']?>" class="custom-control-input shipping_method" id="shipping-<?=$shipping_method['id'] ?>">
                                    <label class="custom-control-label" for="shipping-<?=$shipping_method['id']?>"><?= $shipping_method['name']?> <?= $shipping_method['flat_rate']?'':'(Unit)' ?></label>
                                </div>
                                <p>  <?= $this->Formats->moneySymbol() ?> <?= $shipping_method['price'] ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="card bg-ckout">
                    <div class="card-header">
                        <h4>Payment Method</h4>
                    </div>
                    <div class="card-body">
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
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="card bg-ckout">
                <div class="card-body">
                  <div class="order-md-2 mb-4">

                    <?php

                        // $subtotal = 0;
                        foreach ($cart_products as $product):
                        // $subtotal += $product['price'] * $product['quantity'];

                    ?>


                    <div class="row product-item py-3 justify-content-between">
                      <div class="d-flex justify-content-start">

                        <div class="checkout-product-img-wrapper d-inline-block" style="position: relative;">
                          <img class="item-thumb img-thumbnail img-rounded " src="<?= $this->Media->productImage($product['image'],$product['id'],['width'=>'64px', 'height'=> '64px', 'path'=>true]) ?>" alt="<?= $product['title'] ?>"
                            title="<?= $product['title'] ?>" style="width: 64px; height: 64px;">
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
                      <p><?= $this->Formats->moneySymbol() ?> <span id="sub_total"> <?= number_format($sub_total, 2)?> </span> </p>
                    </div>



                    <div class="d-flex justify-content-between" style="padding-top: 30px; !important; border-top: 1px solid #e3e3e3">
                      <p><b>Shipping Charge</b></p>
                      <p><?= $this->Formats->moneySymbol() ?> <span id="shipping_fee"> 0.00 </span> </p>
                    </div>


                    <div class="d-flex justify-content-between">
                      <p><b>Discount</b></p>
                      <p><?= $this->Formats->moneySymbol() ?> <span id="discount"> <?= number_format($discount, 2)?> </span> </p>
                    </div>

                    <div class="d-flex justify-content-between" style="padding-top: 30px; !important; border-top: 1px solid #e3e3e3">
                      <p><b>Total</b></p>
                      <p><?= $this->Formats->moneySymbol() ?> <span id="total"><?= number_format($sub_total-$discount, 2)?></span></p>
                    </div>



                    <div class="pt-5">
                      <h5 id="coupon_msg"></h5>
                      <div id="coupon">
                          <div class="input-group">
                            <input type="text" class="form-control" name="code" id="coupon_input" placeholder="Promo code">
                            <div class="input-group-append">
                              <button type="submit" id="coupon_submit_btn" class="btn btn-primary checkout-form-btn">Apply</button>
                            </div>
                            <div id="invalidfeedback" class="invalid-feedback">
                              Please provide your coupon code.
                            </div>
                            <div class="valid-feedback">
                              Looks good!
                            </div>
                          </div>
                        </div>
                        <div class="pt-5">
                                <input type="submit" value="Place Order" class="btn btn-block btn-primary">
                        </div>
                      </div>
                    

                  </div>

                </div>
              </div>

            </div>
          </div>
        <?= $this->Form->end() ?>
      </div>

    </div>
  </div>
</div>

<script>
  require(['jquery'], function($, autocomplete) {
    $(document).ready(function() {
      var shipping_weight = $("#shipping_weight").attr('data-weight');
      var discount  = parseFloat(clean($("#discount").text()));
      var sub_total = parseFloat(clean($("#sub_total").text()));

      //Apply Coupon
      let url = "<?=  $this->Url->build(['controller' => 'Checkout', 'action' => 'OnePageCheckout' ], true) ?>"
      
      $("#coupon_submit_btn").click((e) => {
        let coupon = $("#coupon_input").val().trim();
        if($("#coupon_input").hasClass('is-valid') == true){
          $.get(url+ '/' +coupon, (res) => {
            discount = parseFloat(res);

            if(discount > 0 ){
              $("#coupon_msg").html('<span style="color: #5eba00"> Yahoo! You got '+ discount.toFixed(2) + " Discount </span>");
              $("#coupon").hide();
              $("#discount").text(discount.toFixed(2));

              total = (( sub_total + parseFloat($("#shipping_fee").text().trim()) ) - discount ).toFixed(2)
              $("#total").text(total);
              // console.log(discount)
            }
            else{
              $("#coupon_msg").html('<span style="color: #ba001c"> Ops! Your Coupon is not valid </span>');
            }
          });
        }
        // console.log(coupon);

      })



      var selected_ship_method = $(".ship_method input:checked");
      calculateShippingFee(selected_ship_method.attr('data-price'), selected_ship_method.attr('data-flat'), shipping_weight)

    $(".shipping_method").change(function(e){
      let price =  $(this).attr('data-price');
      let flat = $(this).attr('data-flat').trim();
      calculateShippingFee(price, flat, shipping_weight)
    })

    

    function clean(amount){
      amount = amount.trim();
      return amount.replaceAll(',', '');
    }

    function calculateShippingFee(price, flat, weight){
      s_fee = parseFloat(price).toFixed(2);
      weight = parseFloat(weight);
    
      if(flat == 0)
        s_fee = parseFloat(s_fee * weight).toFixed(2)
      
    
      total = (( sub_total + parseFloat(s_fee) ) - discount ).toFixed(2)
      

      $("#shipping_fee").text(s_fee);
      $("#total").text(total);

      $(".pay_amout").each((index, item) => {
        // $(this).text(total);
        $(item).text(total);
      })


    }

    $("#check_box_billing_address").change(function(e){
        if($(this).is(":checked") == true){
            $("#billing_address").addClass('d-none');

            $("#billing_address .form-control").each((key, value) => {
                $(value).attr('required', false);
            })
            
        }
        else{
            $("#billing_address").removeClass('d-none');
            
            $("#billing_address .form-control").each((key, value) => {
                $(value).attr('required', true);
            })
        
        }
    });

    $("#check_box_password").change(function(e){
        if($(this).is(":checked") == true){
            $("#password").removeClass('d-none');
            $("#password").attr('required', true);
        }
        else{
            $("#password").attr('required', false);
            $("#password").addClass('d-none');
        }
    });



      $(".checkout-form-btn").click(function(e) {
        e.preventDefault();
        let v = $("#coupon_input").val().trim();
        if (v.length > 0) {
          $("#coupon_code").val(v);
          $("#checkout").submit()
        } else {
          $("#coupon_input").addClass('is-invalid');
        }

      })
      
       // $("input:radio[name=payment_processor]:first").attr('checked', true);

        $(".payment_processor_div").each(function() {
           $(this).find('.col-lg-6').each(function(){
               $(this).removeClass('col-lg-6');
               $(this).addClass('col-lg-12');
           })
        });

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
        $("input:radio[name=payment_processor]:first").click();


      $("#coupon_input").keyup(function(e) {
        if ($("#coupon_input").val().trim().length > 6) {
          $("#coupon_input").removeClass('is-invalid');
          $("#coupon_input").addClass('is-valid');
        } else {
          $("#coupon_input").removeClass('is-valid');
          $("#coupon_input").addClass('is-invalid');
        }
      })


    });
  });
</script>

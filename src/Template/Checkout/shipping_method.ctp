<?php
    $cart_products      = $checkout['products'];
    $shipping_address   = $checkout['shipping_address'];
    $order              = $checkout['order'];
  //  pr($checkout['sess_id']);
  //  pr($_GET['c_sess_id']);
  $this->assign("layout","checkout");
  //pr($this->Session->read('payment'));
  //pr($this->Session->read('shipping'));
  //$this->request->getSession()->write('payment', $checkout);
?>


<div class="row py-5">
    <div class="col-md-7 order-md-1" style="padding-right: 50px !important; border-right: 1px solid #ededed">
        <div class="d-flex justify-content-between pb-3">
            <h4 class="font-weight-normal">Shipping Method</h4>
            <h6 class="pt-2 text-muted font-weight-light"><a href="<?= $this->Url->build(['controller'=> 'checkout', 'action'=> 'index','?'=>['c_sess_id'=>$checkout['sess_id']]]) ?>"><i class="fa fa-arrow-left"></i>Back to information</a></h6>
        </div>

        <?= $this->Form->create(null, ['id'=>'checkout','url'=> ['action' => 'shipping','?'=>['c_sess_id'=>$checkout['sess_id']]]]) ?>
        <?php foreach ($shipping_methods as $key => $shipping_method): ?>
            <div class="d-flex justify-content-between">
                <div class="custom-control custom-radio">
                    <input <?= $key == 0 ? 'checked' : '' ?> data-price="<?= $shipping_method['price'] ?>" data-flat="<?= $shipping_method['flat_rate'] == 1 ? 1 : 0 ?>" required name="shipping_method" type="radio" value="<?= $shipping_method['id']?>" class="custom-control-input" id="shipping-<?=$shipping_method['id'] ?>">
                    <label class="custom-control-label" for="shipping-<?=$shipping_method['id']?>"><?= $shipping_method['name']?> <?= $shipping_method['flat_rate']?'':'(Unit)' ?></label>
                </div>
                <p>  <?= $this->Formats->moneySymbol() ?> <?= $shipping_method['price'] ?></p>
            </div>
        <?php endforeach; ?>
        <?= $this->Form->hidden('product_weight',['value'=>'1', 'id'=>'shipping_total_weight']) ?>
        <?= $this->Form->end() ?>

        <div class="card mt-5">
            <div class="card-header d-flex justify-content-between" style="background-color: transparent !important;">
                <h5 class="font-weight-light">Shipping Information</h5>
                <a class="btn btn-outline-primary btn-sm" href="<?= $this->Url->build(['controller' => 'checkout', 'action' => 'index','?'=>['c_sess_id'=>$checkout['sess_id']]] ) ?>">Edit</a>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td width="30%">Name</td>
                        <td><?= $shipping_address['first_name']." ".$shipping_address['last_name'] ?></td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td><?= $shipping_address['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><?= $shipping_address['phone'] ?></td>
                    </tr>

                    <tr>
                        <td>Address</td>
                        <td><?= $shipping_address['address'] ?></td>
                    </tr>
                    <tr>
                        <td>Area</td>
                        <td><?= $shipping_address['area'] ?></td>
                    </tr>
                    <tr>
                        <td>Cit</td>
                        <td><?= $shipping_address['city'] ?></td>
                    </tr>
                    <tr>
                        <td>Post Code / Zip Code</td>
                        <td><?= $shipping_address['post_code'] ?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><?= $shipping_address['country'] ?></td>
                    </tr>

                </table>
            </div>
        </div>


    </div>

    <div class="col-md-5 order-md-2 mb-4" style="padding-left: 50px !important; border-left: 1px solid #ededed">

        <?php
        $weight = 0;
        foreach ($cart_products as $product):
            $weight += $product['weight'] * $product['quantity'];
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

        <div class="d-flex justify-content-between" style="padding-top: 30px; !important;">
            <b>Subtotal</b>
            <p data-weight="<?= $weight ?>" data-subtotal="<?=$order['subtotal']?>" id="subtotal"><b> <?= $this->Formats->moneySymbol() ?> <?= number_format($order['subtotal'], 2)?></b></p>
        </div>

        <div class="d-flex justify-content-between">
            <p>Discount(-)</p>
            <span><?= $this->Formats->moneySymbol() ?> <span id="discount"><?= number_format($order['discount'], 2) ?></span></span>
        </div>
        <div class="row" style="border-top: 1px solid #e3e3e3">
            <div class="col-12">
            <div class="d-flex justify-content-between">
                <b>Total</b>
                <p data-weight="<?= $weight ?>" data-total="<?= $order['subtotal'] - $order['discount'] ?>" id="total"><b><?= $this->Formats->moneySymbol() ?>  <?= number_format($order['subtotal'] - $order['discount'], 2) ?> </b></p>
            </div>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <p>Shipping Charge(+)</p>
            <span><?= $this->Formats->moneySymbol() ?> <span id="shipping_charge">0.00</span></span>
        </div>
        <div class="row" style="border-top: 1px solid #e3e3e3">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <p><b>Grand Total</b></p>
                    <span><?= $this->Formats->moneySymbol() ?> <b id="grand_total"><?= number_format(0, 2) ?></b></span>
                </div>
            </div>
        </div>


        <button class="btn btn-primary mt-5" onclick="event.preventDefault(); document.getElementById('checkout').submit();" type="button">Continue to checkout</button>

    </div>

</div>

<script>
    require(['jquery'], function ($, autocomplete) {
        $(document).ready(function() {
            shipping_charge();

            $('input[name="shipping_method"]').click(function (e) {
                shipping_charge();
            });

            function shipping_charge(){
                let el = $('input[name="shipping_method"]:checked');
                let flat = el.attr('data-flat');
                let price = Number(el.attr('data-price'));
                let total = Number($("#total").attr('data-total'));
                let weight = parseFloat($("#total").attr('data-weight'));

                if (flat == 1){
                    $("#grand_total").text(parseFloat(total + price).toFixed(2));
                    $("#shipping_charge").text(parseFloat(price).toFixed(2));
                }else{
                    price = Number(price * weight);
                    $("#grand_total").text(parseFloat(total + price).toFixed(2));
                    $("#shipping_charge").text(parseFloat(price).toFixed(2));
                }
                $("#shipping_total_weight").val(weight);
            }

        });



    });


</script>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
   $this->assign("layout","checkout");
?>
<?php
//    dd($order);
?>
<script>
    require.config({
        shim: {
            'autocomplete': ['jquery', 'bootstrap']
        },
        paths: {
            'autocomplete': 'assets/js/vendors/bootstrap-autocomplete.min'
        }
    });

    /*require.config({
      shim: {
          'btvalidator': ['jquery', 'bootstrap']
      },
      paths: {
          'btvalidator': 'assets/js/vendors/bootstrap-validate'
      }
    });*/

</script>


<?=$this->Html->css('/js/x-editable/bootstrap-editable')?>
<script>
    require.config({
        shim: {
            'xeditable': ['jquery', 'core']
        },
        paths: {
            'xeditable': 'js/x-editable/bootstrap-editable.min'
        }
    });
</script>

<script>
    require.config({
        shim: {
            'jqtoast': ['jquery']
        },
        paths: {
            'jqtoast': 'assets/js/jquery.toast.min'
        }
    });
</script>

<div class="container">

    <div class="row py-5">
        <div class="col-12">
            <div class="row justify-content-between">
                <div class="order-tracking completed">
                    <span class="is-complete"></span>
                    <p>Order Placement<br><span><!--Mon, June 24--></span></p>
                </div>
                <div class="order-tracking <?php if($order->order_status >=1) echo 'completed'?>">
                    <span class="is-complete"></span>
                    <p>Order Processing<br><span><!--Tue, June 25--></span></p>
                </div>
                <div class="order-tracking <?php if($order->order_status >=2 && $order->order_status != 4) echo 'completed'?>">
                    <span class="is-complete"></span>
                    <p>Order Shipped<br><span><!--Fri, June 28--></span></p>
                </div>
                <div class="order-tracking <?php if($order->order_status == 3) echo 'completed'?>">
                    <span class="is-complete"></span>
                    <p><?php echo $order->order_status == 4 ? 'Order Cancelled' : 'Order Delivered' ?><br><span><!--Fri, June 28--></span></p>
                </div>
            </div>
        </div>
    </div>

    <br  />
    <div class="row">

        <div class="col-lg-3 order-lg-1 mb-4">

            <div class="card" id="customerdetailarea">
                <ul class="list-group card-list-group">
                    <li class="list-group-item pb-3 py-4">
                        <div class="media-heading">
                            <h3 class="card-title">Customer Info</h3>
                        </div>
                        <div style="line-height: 24px">
                            <?php $customer = $order->customer ?>
                            <?= $customer->first_name." ".$customer->last_name ?> <br />
                            <?= $customer->email ?> <br />
                            Tel: <?= $customer->phone ?>
                        </div>
                    </li>
                    <li class="list-group-item pb-3 py-4">
                        <div class="media-heading">
                            <h3 class="card-title">Shipping Address</h3>
                        </div>
                        <div style="line-height: 24px">
                            <?php $shipping = json_decode($order->shipping_address);?>
                            <?=  $shipping->first_name." ".$shipping->last_name ?><br />
                            <?= $shipping->address?>, <br  />
                            Area: <?= isset($shipping->area) ? $shipping->area : '' ?> <br/>
                            <?= $shipping->city." ".$shipping->post_code?>, <?= $shipping->country ?>  <br  />
                            Tel: <?= $shipping->phone?>
                        </div>
                    </li>

                    <li class="list-group-item pb-3 py-4">
                        <div class="media-heading">

                            <h3 class="card-title">Billing Address</h3>
                        </div>
                        <div style="line-height: 24px">
                            <?php if ($order->billing_address): ?>
                                <?php $billing = json_decode($order->billing_address);?>
                                <?=  $billing->first_name." ".$billing->last_name ?><br />
                                <?= $billing->address?>, <br  />
                                Area: <?= isset($billing->area) ? $billing->area : ''?> <br/>
                                <?= $billing->city." ".$billing->post_code?>, <?= $billing->country ?> <br  />
                                Tel: <?= $billing->phone?>
                            <?php else: ?>
                                Same as shipping
                            <?php endif; ?>
                        </div>
                    </li>

                    <li class="list-group-item pb-3 py-4">
                        <div class="media-heading">

                            <h3 class="card-title">Payment Processor</h3>
                        </div>
                        <div style="line-height: 24px">
                            <?= isset($order->payment_processor->name) ? $order->payment_processor->name : '' ?>
                        </div>
                    </li>

                    <li class="list-group-item pb-3 py-4">
                        <div class="media-heading pb-3">

                            <h3 class="card-title">Shipping Method</h3>
                        </div>
                        <div style="line-height: 24px">
                            <?php
                            if ($order->shipping_method){
                                echo $order->shipping_method->name;
                                if($order->shipping_method->flat_rate !=1) echo (" (Unit)");
                            }
                            ?>
                        </div>
                    </li>

                </ul>

            </div>




        </div>
        <div class="col-lg-9">
            <div class="table-responsive">
                <table class="table table-bordered" style="margin-bottom: 0px !important; background-color: #ffffff">
                    <thead>
                    <td colspan="5" style="border-bottom-width: 0px">
                        <div class="d-flex">
                            <p style="margin-bottom: 0px !important; font-weight: bold; font-size: 18px;">
                                <?php echo "Order # " . $order->order_id; ?>
                            </p>
                            <a href="<?= $this->Url->build('track-order', true) ?>" class="btn btn-sm btn-outline-primary ml-auto">Back</a>
                        </div>
                    </td>
                    </thead>
                    <tbody>
                    <tr>
                        <th class="text-center" style="width: 8%;">SL. No</th>
                        <th style="width: 60%">Product</th>
                        <th class="text-center" style="width: 5%">Qnt</th>
                        <th class="text-center" style="width: 10%">Unit</th>
                        <th class="text-center" style="width: 10%">Amount</th>
                    </tr>

                    <?php  foreach ($order->order_products as $key => $product): ?>
                        <tr>
                            <td class="text-center"><?php echo ++$key ?></td>
                            <td>
                                <p class="strong mb-1"><?php echo $product->product_title?></p>
                                <div class="text-muted"><?php echo $product->product_options ?></div>
                            </td>
                            <td class="text-center">
                                <?php echo $product->product_quantity ?>
                            </td>
                            <td class="text-center"><?php echo number_format($product->product_price,2) ?></td>
                            <td class="text-center"><?php echo number_format(($product->product_price * $product->product_quantity),2) ?> </td>
                        </tr>

                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" rowspan="7"><?php echo $order->notes ?></td>
                        <td class="strong text-right" style="width: 12%">Subtotal</td>
                        <td class="text-center"><?php echo $order->sub_total ? $order->sub_total : 0 ?></td>
                    </tr>
                    <tr>
                        <td class="strong text-right">Discount</td>
                        <td class="text-center">- <?php  echo number_format($order->discount,2)?></td>
                    </tr>
                    <tr>
                        <td class="strong text-right">Tax</td>
                        <td class="text-center"><?php echo number_format($order->taxes,2) ?></td>
                    </tr>
                    <tr>
                        <td class="strong text-right">Shipping</td>
                        <td class="text-center"><?php echo number_format($order->shipping_fee,2) ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold text-right">Total</td>
                        <td class="font-weight-bold text-center"><?php echo number_format($order->order_total,2) ?></td>
                    </tr>
                    <tr>
                        <td class="strong text-right">Deposit</td>
                        <td class="text-center"><?php echo number_format($order->total_paid,2) ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold text-uppercase text-right">Total Due</td>
                        <td class="font-weight-bold text-center"><?php  echo number_format($order->due,2) ?></td>
                    </tr>
                    </tbody></table>
            </div>
        </div>
    </div>


    <div class="row row-cards row-deck mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h4 style="margin-bottom: 0px !important;">Order Log</h4>
                    <!--                <a href="javascript;;" data-target="#statusModal" data-toggle="modal" class="btn btn-sm btn-outline-primary ml-auto">Change Status</a>-->
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead style="font-weight: bold">
                        <tr>
                            <th width="12%" class="text-center">Status</th>
                            <th>Log</th>
                            <th class="text-center">Date</th>
                            <th>Added By</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $badge = [0=>'badge-primary',1=>'badge-info', 2=>'badge-warning',3=>'badge-success', 4=>'badge-danger', 5=> 'badge-secondary'];
                        $order_statuses = [0=>'Pending',1=>'Processing',2=>'Shipped',3=>'Delivered',4=>'Cancelled',5=>'Payment'];
                        foreach ($order->order_logs as $log) :?>
                            <tr>
                                <td class="text-center"><span class="badge <?=$badge[$log->order_status] ?>"><?= $order_statuses[$log->order_status]?></span></td>
                                <td class="text-left"><?= $log->notes ? $log->notes : 'Order marked as '.$order_statuses[$log->order_status] ?></td>
                                <td class="text-center"><?= $log->created ?></td>
                                <td class="text-left"><?= $log->added_by ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .hh-grayBox {
        background-color: #F8F8F8;
        margin-bottom: 20px;
        padding: 35px;
        margin-top: 20px;
    }
    .pt45{padding-top:45px;}
    .order-tracking{
        text-align: center;
        width: 25%;
        position: relative;
        display: block;
    }
    .order-tracking .is-complete{
        display: block;
        position: relative;
        border-radius: 50%;
        height: 30px;
        width: 30px;
        border: 0px solid #AFAFAF;
        background-color: #f7be16;
        margin: 0 auto;
        transition: background 0.25s linear;
        -webkit-transition: background 0.25s linear;
        z-index: 2;
    }
    .order-tracking .is-complete:after {
        display: block;
        position: absolute;
        content: '';
        height: 14px;
        width: 7px;
        top: -2px;
        bottom: 0;
        left: 5px;
        margin: auto 0;
        border: 0px solid #AFAFAF;
        border-width: 0px 2px 2px 0;
        transform: rotate(45deg);
        opacity: 0;
    }
    .order-tracking.completed .is-complete{
        border-color: #27aa80;
        border-width: 0px;
        background-color: #27aa80;
    }
    .order-tracking.completed .is-complete:after {
        border-color: #fff;
        border-width: 0px 3px 3px 0;
        width: 7px;
        left: 11px;
        opacity: 1;
    }
    .order-tracking p {
        color: #A4A4A4;
        font-size: 16px;
        margin-top: 8px;
        margin-bottom: 0;
        line-height: 20px;
    }
    .order-tracking p span{font-size: 14px;}
    .order-tracking.completed p{color: #000;}
    .order-tracking::before {
        content: '';
        display: block;
        height: 3px;
        width: calc(100% - 40px);
        background-color: #f7be16;
        top: 13px;
        position: absolute;
        left: calc(-50% + 20px);
        z-index: 0;
    }
    .order-tracking:first-child:before{display: none;}
    .order-tracking.completed:before{background-color: #27aa80;}

</style>

<script>
    require(['jquery'], function ($, autocomplete) {
        $(document).ready(function() {

        });
    });
</script>

<?php //debug($order); debug($shipping_methods);?>

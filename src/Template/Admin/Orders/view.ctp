<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
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


<div class="row">
    <div class="col-12">
        <div class="row justify-content-between">
            <div class="order-tracking completed">
                <span class="is-complete"></span>
                <p><?= __('Order Placement') ?><br><span>
                        <!--Mon, June 24-->
                    </span></p>
            </div>
            <div class="order-tracking <?php if($order->order_status >=1) echo __('completed')?>">
                <span class="is-complete"></span>
                <p><?= __('Order Processing') ?><br><span>
                        <!--Tue, June 25-->
                    </span></p>
            </div>
            <div
                class="order-tracking <?php if($order->order_status >=2 && $order->order_status != 4) echo __('completed') ?>">
                <span class="is-complete"></span>
                <p><?= __('Order Shipped') ?><br><span>
                        <!--Fri, June 28-->
                    </span></p>
            </div>
            <div class="order-tracking <?php if($order->order_status == 3) echo __('completed') ?>">
                <span class="is-complete"></span>
                <p><?php echo $order->order_status == 4 ? __('Order Cancelled') : __('Order Delivered') ?><br><span>
                        <!--Fri, June 28-->
                    </span></p>
            </div>
        </div>
    </div>
</div>

<br />
<div class="row">

    <div class="col-lg-3 order-lg-1 mb-4">

        <div class="card" id="customerdetailarea">
            <ul class="list-group card-list-group">
                <li class="list-group-item py-5">
                    <div class="media-heading pb-3">
                        <h3 class="card-title"><?= __('Customer Info') ?></h3>
                    </div>
                    <div style="line-height: 24px">
                        <?php $customer = $order->customer ?>
                        <a href="<?= $this->Url->build(['controller' => 'Customers', 'action' => 'view', $customer->id]) ?>"> <?= $customer->first_name." ".$customer->last_name ?> </a> <br />
                        <?= $customer->email ?> <br />
                        Tel: <?= $customer->phone ?>
                    </div>
                </li>
                <li class="list-group-item py-5">
                    <div class="media-heading pb-3">
                        <h3 class="card-title"><?= __('Shipping Address') ?></h3>
                    </div>
                    <div style="line-height: 24px">
                        <?php $shipping = json_decode($order->shipping_address);?>
                        <?=  $shipping->first_name." ".$shipping->last_name ?><br />
                        <?= $shipping->address?>, <br />

                        <?= isset($shipping->area) ? $shipping->area : '' ?> <br />
                        <?= $shipping->city." - ".$shipping->post_code?>,
                        <?= $shipping->country ?> </br>
                        Tel: <?= $shipping->phone?>
                    </div>
                </li>

                <li class="list-group-item py-5">
                    <div class="media-heading pb-3">

                        <h3 class="card-title"><?= __('Billing Address') ?></h3>
                    </div>
                    <div style="line-height: 24px">
                        <?php if ($order->billing_address): ?>
                        <?php $billing = json_decode($order->billing_address);?>
                        <?=  $billing->first_name." ".$billing->last_name ?><br />
                        <?= $billing->address?>, <br />
                        <?= __('Apartment:') ?> <?= isset($billing->apartment) ? $billing->apartment : " "?> <br />
                        <?= $billing->city." - ".$billing->post_code?>,
                        <?= $shipping->country ?> </br>
                        <?= __('Tel:') ?> <?= $billing->phone?>
                        <?php else: ?>
                            <?= __('Same as shipping') ?>
                        <?php endif; ?>
                    </div>
                </li>

                <li class="list-group-item py-5">
                    <div class="media-heading pb-3">

                        <h3 class="card-title"><?= __('Shipping Method') ?></h3>
                    </div>
                    <div style="line-height: 24px">
                        <?php
                            if ($order->shipping_method){
                                echo $order->shipping_method->name;
                                if($order->shipping_method->flat_rate !=1) echo __("(Unit)");
                            }
                        ?>
                    </div>
                </li>

                <li class="list-group-item py-5">
                    <div class="media-heading pb-3">

                        <h3 class="card-title"><?= __('Payment Processor') ?></h3>
                    </div>
                    <div style="line-height: 24px">
                        <?= $order->payment_processor ? $order->payment_processor->name : '' ?>
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
                        <div class="d-flex justify-content-between">
                            <div>
                                <p style="margin-bottom: 0px !important; font-weight: bold; font-size: 18px;">
                                    <?php echo __("Order # ") . $order->order_id; ?>
                                </p>
                            </div>
                            <div>
                                <a href="<?= $this->Url->build(['action' => 'Invoice', $order->order_id, $order->order_password, '_ext'=>'pdf']) ?>"
                                    class="btn btn-sm btn-outline-secondary mr-2">
                                    <i class="fe fe-download"></i>
                                    <?= __('Invoice') ?>
                                </a>
                                <a href="<?= $this->Url->build(['action' => 'PackingSlip', $order->order_id, $order->order_password, '_ext'=>'pdf']) ?>"
                                    class="btn  btn-sm btn-outline-secondary mr-2">
                                    <i class="fe fe-download"></i>
                                    <?= __('Packing Slip') ?>
                                </a>


                                <a 
                                    href="<?= $this->Url->build(['action' => 'Invoice', $order->order_id]) ?>"
                                    class="btn  btn-sm btn-outline-secondary mr-2">
                                    <i class="fe fe-printer"></i>
                                    <?= __('Invoice') ?>
                                </a>
                                <a 
                                    href="<?= $this->Url->build(['action' => 'PackingSlip', $order->order_id, $order->order_password]) ?>"
                                    class="btn  btn-sm btn-outline-secondary">
                                    <i class="fe fe-printer"></i>
                                    <?= __('Packing Slip') ?>
                                </a>
                            </div>
                            <div>
                                <a href="<?php echo $this->Url->build(['action'=>'edit', $order->id]) ?>"
                                    class="btn btn-sm btn-outline-secondary ml-auto"><?= __('Edit Order') ?></a>

                            </div>
                        </div>
                    </td>
                </thead>
                <tbody>
                    <tr>
                        <th class="text-center" style="width: 8%"><?= __('SL. No') ?></th>
                        <th style="width: 60%"><?= __('Product') ?></th>
                        <th class="text-center" style="width: 5%"><?= __('Qnt') ?></th>
                        <th class="text-center" style="width: 10%"><?= __('Unit') ?></th>
                        <th class="text-center" style="width: 10%"><?= __('Amount') ?></th>
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
                        <td class="text-center">
                            <?php echo $this->Formats->moneySymbol(); echo number_format($product->product_price,2) ?>
                        </td>
                        <td class="text-center">
                            <?php echo $this->Formats->moneySymbol(); echo number_format(($product->product_price * $product->product_quantity),2) ?>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" rowspan="7"><?php echo $order->notes ?></td>
                        <td class="strong text-right" style="width: 12%"><?= __('Subtotal') ?></td>
                        <td class="text-center">
                            <?php echo $this->Formats->moneySymbol(); echo $order->sub_total ? $order->sub_total : 0 ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="strong text-right"><?= __('Discount') ?></td>
                        <td class="text-center">
                            -<?php echo $this->Formats->moneySymbol(); echo number_format($order->discount,2) ?></td>
                    </tr>
                    <tr>
                        <td class="strong text-right"><?= __('Tax') ?></td>
                        <td class="text-center">
                            <?php echo $this->Formats->moneySymbol(); echo number_format($order->taxes,2) ?></td>
                    </tr>
                    <tr>
                        <td class="strong text-right"><?= __('Shipping') ?></td>
                        <td class="text-center">
                            <?php  echo $this->Formats->moneySymbol(); echo number_format($order->shipping_fee,2) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold text-right"><?= __('Total') ?></td>
                        <td class="font-weight-bold text-center">
                            <?php echo $this->Formats->moneySymbol(); echo number_format($order->order_total,2) ?></td>
                    </tr>
                    <tr>
                        <td class="strong text-right"><?= __('Deposit') ?></td>
                        <td class="text-center">
                            <?php echo $this->Formats->moneySymbol(); echo number_format($order->total_paid,2) ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold text-uppercase text-right"><?= __('Total Due') ?></td>
                        <td class="font-weight-bold text-center">
                            <?php echo $this->Formats->moneySymbol(); echo number_format($order->due,2) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="row row-cards row-deck mt-3">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex">
                <h4 style="margin-bottom: 0px !important;"><?= __('Order Log') ?></h4>
                <a href="javascript;;" data-target="#statusModal" data-toggle="modal"
                    class="btn btn-sm btn-outline-primary ml-auto"><?= __('Change Status') ?></a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                    <thead style="font-weight: bold">
                        <tr>
                            <th width="12%" class="text-center"><?= __('Status') ?></th>
                            <th><?= __('Log') ?></th>
                            <th class="text-center"><?= __('Date') ?></th>
                            <th><?= __('Added By') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $badge = [0=>'badge-primary',1=>'badge-info', 2=>'badge-dark',3=>'badge-success', 4=>'badge-danger', 5=> 'badge-secondary', 6 => 'badge-warning'];
                    $order_statuses = [0=>'Pending',1=>'Processing',2=>'Shipped',3=>'Delivered',4=>'Cancelled',5=>'Payment', 6 => 'Refund'];
                    foreach ($order->order_logs as $log) :?>
                        <tr>
                            <td class="text-center"><span
                                    class="badge <?=$badge[$log->order_status] ?>"><?= $order_statuses[$log->order_status]?></span>
                            </td>
                            <td class="text-left">
                                <?= $log->notes ? $log->notes : 'Order marked as '.$order_statuses[$log->order_status] ?>
                            </td>
                            <td class="text-center"><?= $log->created ?></td>
                            <td class="text-left"><?= $log->added_by ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex">
                <h4 style="margin-bottom: 0px !important;"><?= __('Payment Log') ?></h4>

                <div class="dropdown ml-auto">
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Payment
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <?php if ($order->due > 0): ?>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#PaymentModal"
                            data-id="<?=$order->id?>" data-order-id="<?=$order->order_id?>" data-due="<?=$order->due?>"
                            class="dropdown-item"><i class="dropdown-icon fe fe-dollar-sign"></i> <?= __('Process Payment') ?> </a>
                        <?php endif; ?>
                        <?php if ($order->total_paid > 0): ?>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#RefundModal"
                            data-id="<?=$order->id?>" data-order-id="<?=$order->order_id?>"
                            data-paid="<?=$order->total_paid?>" class="dropdown-item"><i
                            class="dropdown-icon fe fe-dollar-sign"></i> <?= __('Process Refund') ?> </a>
                        <?php endif; ?>
                        
                    </div>
                </div>

            </div>
            <div class="table-responsive">
                <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                    <thead style="font-weight: bold">
                        <tr>
                            <th class="text-center"><?= __('Method') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th class="text-center"><?= __('Payment Date') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_payment = 0; foreach ($order->order_payments as $payment) :?>
                        <tr>
                            <td class="text-center"> <?= $methods[$payment->payment_method] ?> </td>
                            <td class="text-left">
                                <?php 
                                    echo \Cake\Core\Configure::read('App.currency') . $payment->amount;

                                    if($payment->amount > 0) $total_payment += $payment->amount;
                                    else  $total_payment -= abs($payment->amount);

                                ?>


                            </td>
                            <td class="text-center"> <?= $payment->payment_date ?></td>
                            
                        </tr>
                        <?php endforeach; ?>

                        <tr>
                            <td><b> Total Amount </b></td>
                            <td colspan="2"><b> <?= \Cake\Core\Configure::read('App.currency') . $total_payment ?> </b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php include_once 'payment_modal.ctp'?>
<?php include_once 'refund_modal.ctp'?>
<?php include_once 'status_modal.ctp'?>

<style>
.hh-grayBox {
    background-color: #F8F8F8;
    margin-bottom: 20px;
    padding: 35px;
    margin-top: 20px;
}

.pt45 {
    padding-top: 45px;
}

.order-tracking {
    text-align: center;
    width: 25%;
    position: relative;
    display: block;
}

.order-tracking .is-complete {
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

.order-tracking.completed .is-complete {
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

.order-tracking p span {
    font-size: 14px;
}

.order-tracking.completed p {
    color: #000;
}

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

.order-tracking:first-child:before {
    display: none;
}

.order-tracking.completed:before {
    background-color: #27aa80;
}
</style>

<script>
require(['jquery'], function($, autocomplete) {
    $(document).ready(function() {
        $('#PaymentModal').on('show.bs.modal', function (event) {
              console.log(event.relatedTarget);
              $('#payment_frm')[0].reset();
              $('#payment_frm #order_no_span').html($(event.relatedTarget).attr('data-order-id'));
              $('#payment_frm #orders_id').val($(event.relatedTarget).attr('data-id'));
              $('#payment_frm #amount').val($(event.relatedTarget).attr('data-due'));

          });

          $('#RefundModal').on('show.bs.modal', function (event) {
              console.log(event.relatedTarget);
              $('#refund_frm')[0].reset();
              $('#refund_frm #order_no_span').html($(event.relatedTarget).attr('data-id'));
              $('#refund_frm #orders_id').val($(event.relatedTarget).attr('data-id'));
              $('#refund_frm #amount').val($(event.relatedTarget).attr('data-paid'));

          });

          $("#payment_frm").submit(function(e) {

                var frm = this;
                var valid = ($(this).find("input.is-invalid").length === 0);
                if (!valid) {
                   return false;
                }

                  e.preventDefault(); // avoid to execute the actual submit of the form.

                  var form = $(this);
                  var url = form.attr('action');

                  $.ajax({
                         type: "POST",
                         url: url,
                         data: form.serialize(), // serializes the form's elements.
                         success: function(data)
                         {
                            location.reload();

                            // if(data.hasOwnProperty("error")){
                            //     console.log(data.error);
                            //     $.each( data.error, function( key, value ) {
                            //       //alert( key + ": " + value );
                            //       $(frm).find('input[name ="'  + key  +  '"]').addClass("is-invalid");
                            //       $(frm).find('input[name ="'  + key  +  '"]').after('<div style="display: inline-block;" class="invalid-feedback has-error-email">' +  value[Object.keys(value)[0]] + '</div>');

                            //     });

                            // }else{
                            //     var customer = data.data;
                            //     setCustomer(customer,customer,{});
                            //     $("#customerAddressModal").modal('hide');
                            //     location.reload();   

                            // }

                         }
                 });


              });

            



              $("#refund_frm").submit(function(e) {

                var frm = this;
                var valid = ($(this).find("input.is-invalid").length === 0);
                if (!valid) {
                   return false;
                }

                  e.preventDefault(); // avoid to execute the actual submit of the form.

                  var form = $(this);
                  var url = form.attr('action');

                  $.ajax({
                         type: "POST",
                         url: url,
                         data: form.serialize(), // serializes the form's elements.
                         success: function(data)
                         {
                            location.reload();

                            // if(data.hasOwnProperty("error")){
                            //     console.log(data.error);
                            //     $.each( data.error, function( key, value ) {
                            //       //alert( key + ": " + value );
                            //       $(frm).find('input[name ="'  + key  +  '"]').addClass("is-invalid");
                            //       $(frm).find('input[name ="'  + key  +  '"]').after('<div style="display: inline-block;" class="invalid-feedback has-error-email">' +  value[Object.keys(value)[0]] + '</div>');

                            //     });

                            // }else{
                            //     var customer = data.data;
                            //     setCustomer(customer,customer,{});
                            //     $("#customerAddressModal").modal('hide');
                            //     location.reload();

                            // }

                         }
                 });


              });
              

    });
});
</script>

<?php //debug($order); debug($shipping_methods);?>
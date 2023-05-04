<html>
<head>
    
    <style>
        body {font-family: sans-serif;
            font-size: 10pt;
            color:#495057 !important;
        }
        p {   margin: 0pt; }
        table.items {
            border: 0.1mm solid #ccd4e0;
        }
        td { vertical-align: top; }
        .items td {
            border-left: 0.1mm solid #ccd4e0;
            border-right: 0.1mm solid #ccd4e0;
        }
        table thead td { background-color: #e5e9ef;
            text-align: center;
            border: 0.1mm solid #ccd4e0;
        }
        .items td.blanktotal {
            background-color: #e5e9ef;
            border: 0.1mm solid #ccd4e0;
            background-color: #FFFFFF;
            border: 0mm none #ccd4e0;
            border-top: 0.1mm solid #ccd4e0;
            border-right: 0.1mm solid #ccd4e0;
        }
        .items td.totals {
            text-align: center;
            border: 0.1mm solid #ccd4e0;
        }
        .items td.cost {
            text-align: center;
        }


    </style>
</head>
<body>
    <table width="100%" style="font-family: serif;">
        <tr>
            <td width="45%">
                <span style="font-size: 15pt; font-weight:bold; font-family: sans;"><?= __('Invoice') ?> </span > <span style="font-size:12pt; font-weight:bold">#INV-<?php echo $order->order_id?></span>
            </td>
            <td width="10%">&nbsp;</td>

            <td width="45%" style="text-align: right;">
                <div style="width:50%; font-weight:bold;">
                    Date: <?php echo date('d M, Y') ?>
                </div>
            </td>
        </tr>
    </table>

    <br />

    <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
        <thead>
        <tr>
            <td width="15%"><?= __('SL. No.') ?></td>
            <td width="45%"><?= __('Product') ?></td>
            <td width="10%"><?= __('Quantity') ?></td>
            <td width="15%"><?= __('Unit Price') ?></td>
            <td width="15%"><?= __('Amount') ?></td>
        </tr>
        </thead>
        <tbody>
        <!-- ITEMS HERE -->

        <?php foreach ($order->order_products as $key => $product): ?>
        <tr>
            <td align="center"><?php echo ++$key ?></td>
            <td><?php echo $product->product_title ?><br /><span style="font-size:7pt"><?php echo $product->product_options ?></span></td>
            <td align="center"><?php echo $product->product_quantity ?></td>
            <td class="cost"><?php echo number_format($product->product_price,2) ?></td>
            <td class="cost"><?php echo number_format($product->product_price * $product->product_quantity, 2) ?></td>
        </tr>

        <?php endforeach; ?>

        <!-- END ITEMS HERE -->
        <tr>
            <td class="blanktotal" colspan="3" rowspan="7"></td>
            <td class="totals"><?= __('Subtotal') ?> </td>
            <td class="totals cost"><?php echo $order->sub_total ? number_format($order->sub_total, 2) : 0 ?></td>
        </tr>
        <tr>
            <td class="totals"><?= __('Discount') ?> </td>
            <td class="totals cost"><?php echo $order->discount ? "-".number_format($order->discount, 2): 0 ?></td>
        </tr>
        <tr>
            <td class="totals"><?= __('Tax') ?> </td>
            <td class="totals cost"><?php echo number_format($order->taxes, 2) ?></td>
        </tr>
        <tr>
            <td class="totals"><?= __('Shipping') ?> </td>
            <td class="totals cost"><?php echo number_format($order->shipping_fee,2) ?></td>
        </tr>
        <tr>
            <td class="totals"><b><?= __('TOTAL') ?> </b></td>
            <td class="totals cost"><b><?php echo number_format($order->order_total, 2)?></b></td>
        </tr>
        <tr>
            <td class="totals"><?= __('Deposit') ?> </td>
            <td class="totals cost"><?php echo number_format($order->total_paid, 2)?></td>
        </tr>
        <tr>
            <td class="totals"><b><?= __('Balance due') ?> </b></td>
            <td class="totals cost"><b><?php echo number_format($order->due, 2) ?></b></td>
        </tr>
        </tbody>
    </table>


    <div style="text-align: center; font-size:7pt; font-style: italic;"><?= __('Payment terms: payment due in 30 days') ?></div>


</body>
</html>

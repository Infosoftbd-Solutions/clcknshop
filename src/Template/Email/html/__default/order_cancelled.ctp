<!-- Email Body -->
<tr>
    <td class="email-body" width="100%" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1>Hi <?= $order->customer->first_name. " " . $order->customer->last_name ?>,</h1>
                        <p>
                            Your order #<b><?= $order->order_id ?></b> have been cancelled for the reasons indicated below. The items listed below were part of the cancelled order.
                        </p>
                        <p>
                            <b>Cancellation Reason : </b> <?= isset($order->notes) ? $order->notes : '' ?>
                        </p>
                        <!-- Action -->
                        <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td align="center">

                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                        <tr>
                                            <td align="center">
                                                <a style="color: #FFFFFF !important;"  href="<?= $this->Url->build("track-order/{$order->order_id}/{$order->order_password}", true); ?>" class="f-fallback button button--green" target="_blank">Track Order</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td class="attributes_content">
                                    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                        <tr>
                                            <td class="attributes_item">
                                                <span class="f-fallback">
                                                    <strong>Order Total:</strong> <?= $this->Formats->moneyFormat(number_format( $order->order_total, 2))  ?>
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <table class="purchase" width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <h3>Order ID #<?= $order->order_id ?></h3>
                                </td>
                                <td>
                                    <h3 class="align-right">Date- <?= $order->order_date ?></h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <th width="85%" class="purchase_heading" align="left">
                                                <p class="f-fallback">Description</p>
                                            </th>
                                            <th width="15%" class="purchase_heading" align="right">
                                                <p class="f-fallback">Amount</p>
                                            </th>
                                        </tr>

                                        <?php foreach($order->order_products as $product):?>

                                            <tr>
                                                <td class="purchase_item">
                                                <span class="f-fallback" style="line-height: 12px">
                                                    <div class="img" style="display: inline-block; max-width: 20%; border: 1px solid #eeeeee; border-radius: 5px">
                                                        <img src="<?= $this->Url->build("images/?src={$product->product_image}&size=48x48",true) ?>">
                                                    </div>
                                                    <div class="description"  style="display: inline-block; max-width: 80%">
                                                        <?= $product->product_title ?> X<?= $product->product_quantity ?><br>
                                                        <span style="font-size: 12px">
                                                            <?= isset($product->product_options) ?  $product->product_options.'<br>' : '' ?>
                                                            <?= $product->product_sku ?>
                                                        </span>
                                                    </div>
                                                </span>
                                                </td>
                                                <td class="align-right" width="20%" class="purchase_item"><span class="f-fallback"><?= $this->Formats->moneyformat($product->product_price * $product->product_quantity) ?></span></td>
                                            </tr>
                                        <?php endforeach; ?>


                                        <tr style="font-size: 16px">
                                            <td class="purchase_footer" valign="middle" style="border: none">
                                                <p class="f-fallback purchase_total purchase_total--label">Discount</p>
                                            </td>
                                            <td width="30%" class="purchase_footer" valign="middle" style="border: none">
                                                <p class="f-fallback purchase_total"><?= $this->Formats->moneyFormat($order->discount, false) ?></p>
                                            </td>
                                        </tr>

                                        <tr style="font-size: 16px">
                                            <td class="purchase_footer" valign="middle" style="border: none">
                                                <p class="f-fallback purchase_total purchase_total--label">Tax</p>
                                            </td>
                                            <td width="30%" class="purchase_footer" valign="middle" style="border: none">
                                                <p class="f-fallback purchase_total"><?= $this->Formats->moneyFormat($order->taxes, false) ?></p>
                                            </td>
                                        </tr>

                                        <tr style="font-size: 16px">
                                            <td class="purchase_footer" valign="middle" style="border: none">
                                                <p class="f-fallback purchase_total purchase_total--label">Shipping</p>
                                            </td>
                                            <td width="30%" class="purchase_footer" valign="middle" style="border: none">
                                                <p class="f-fallback purchase_total"><?= $this->Formats->moneyFormat($order->shipping_fee, false) ?></p>
                                            </td>
                                        </tr>

                                        <tr style="font-size: 16px">
                                            <td class="purchase_footer" valign="middle" style="border: none">
                                                <p class="f-fallback purchase_total purchase_total--label">Total</p>
                                            </td>
                                            <td width="30%" class="purchase_footer" valign="middle" style="border: none">
                                                <p class="f-fallback purchase_total"><?= $this->Formats->moneyFormat($order->order_total) ?></p>
                                            </td>
                                        </tr>

                                        <tr style="font-size: 16px">
                                            <td class="purchase_footer" valign="middle" style="border: none">
                                                <p class="f-fallback purchase_total purchase_total--label">Total Due</p>
                                            </td>
                                            <td width="30%" class="purchase_footer" valign="middle" style="border: none">
                                                <p class="f-fallback purchase_total"><?= $this->Formats->moneyFormat($order->order_total - $order->total_paid) ?></p>
                                            </td>
                                        </tr>


                                    </table>

                                    <table style="text-align: left" width="100%">
                                        <tr>
                                            <th colspan="2"><h3>DELIVERY DETAILS</h3></th>
                                        </tr>

                                        <tr>
                                            <th width="20%">Name </th>
                                            <td width="80%"><?= $shipping_address->first_name . " " . $shipping_address->last_name ?> </td>
                                        </tr>

                                        <tr>
                                            <th>Address </th>
                                            <td><?= $shipping_address->address . ', '. $shipping_address->area . ", "  . $shipping_address->city . '-' . $shipping_address->post_code . ", " . $shipping_address->country?>.</td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td><?= $shipping_address->phone ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td><?= $shipping_address->email ?> </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </table>
                        <p>If you have any questions about this invoice, simply reply to this email or reach out to our <a href="">support team</a> for help.</p>

                    </div>
                </td>
            </tr>
        </table>
    </td>
</tr>

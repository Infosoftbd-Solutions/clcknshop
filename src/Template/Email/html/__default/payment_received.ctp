

<!-- Email Body -->
<tr>
    <td class="email-body" width="100%" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1>Hi <?= $customer_name ?>,</h1>
                        <p>We received <?= $total_amount ?> from your order #<b><?= $order->order_id ?></b>.</p>
                        <p>
                            We hope you are enjoying your recent purchase! Once you have a chance, we would love to hear your shopping experience to keep us constantly improving.
                        </p>
                        <!-- Action -->


                        <p>If you have any questions about this invoice, simply reply to this email or reach out to our <a href="">support team</a> for help.</p>

                    </div>
                </td>
            </tr>
        </table>
    </td>
</tr>

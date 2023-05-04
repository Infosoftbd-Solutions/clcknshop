<!-- Email Body -->
<tr>
    <td class="email-body" width="100%" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tr>
                <td class="content-cell">
                <p>
                    We recieved order payment for order id <?=$order->order_id?> . <br /> 
                    Payment amount : <?=$payment->amount?> <br />
                    notes: <?=$notes?> <br />
                    Order due: <?= $this->Formats->moneyFormat($order->order_total - $order->total_paid) ?>

                </p>
                </td>
            </tr>    

        </table>
    </td>
</tr>            
<?php foreach ($paymentLogs as $log): ?>
    <tr>
        <td> <?= $log->pay_method->name ?></td>
        <td> <?= $this->Formats->moneyFormat($log->amount) ?></td>
        <td> <?= $log->payment_date ?></td>
    </tr>
<?php endforeach; ?>


<table cellpadding="0" cellspacing="0" class="table table-hover table-outline table-vcenter text-nowrap card-table">
    <thead>
    <tr>
        <th width="10%" scope="col"><?= $this->Paginator->sort('order_id') ?></th>
        <th width="10%" scope="col"><?= $this->Paginator->sort('Payment Processor') ?></th>
        <th width="10%" scope="col"><?= $this->Paginator->sort('transaction_number') ?></th>
        <th width="50%"  scope="col"><?= $this->Paginator->sort('Transaction Info') ?></th>
        <th width="10%" scope="col"><?= $this->Paginator->sort('Order Total') ?></th>
        <th width="10%" scope="col"><?= $this->Paginator->sort('status') ?></th>
        <th width="10%" scope="col"><?= $this->Paginator->sort('Action') ?></th>

    </tr>
    </thead>
    <tbody>
    <?php foreach ($transactions as $key => $transaction): ?>

        <tr>
            <td><?= $transaction->order->order_id ?></td>
            <td>
                <?= $transaction->order->payment_processor->name ?>
            </td>
            <td>
                <?= $transaction->transaction_number ?>
            </td>
            <td>
                <ul>
                    <?php
                    $payment_data = json_decode($transaction->payment_data, true);
                    foreach ($payment_data as $key => $data):
                        ?>
                        <li><b><?= ucfirst($key) ?></b> - <?= $data ?></li>

                    <?php endforeach; ?>
                </ul>

            </td>

            <td>
                <?= $this->Formats->moneyFormat(number_format($transaction->order->order_total, 2)) ?>
            </td>

            <td>
                <?php if ($transaction->status == 1 ):  ?>
                    <span class="badge badge-success"><?= __('Verified') ?></span>
                <?php else: ?>
                    <span class="badge badge-danger"><?= __('Not Verified') ?></span>
                <?php endif; ?>
            </td>

            <td>
                <?php if ($transaction->status == 0): ?>
                    <?= $this->Form->postLink(__('Approve'), ['action' => 'approved', $transaction->id], ['escape' => false,'class' => 'btn btn-sm btn-outline-primary', 'confirm' => __('Are you sure you want to Approve the transaction ?')]) ?>
                <?php endif; ?>
            </td>


        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?=$this->TablerPaginator->links()?>

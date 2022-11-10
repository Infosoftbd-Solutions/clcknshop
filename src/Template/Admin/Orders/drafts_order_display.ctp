<table cellpadding="0" cellspacing="0" class="table table-hover table-outline table-vcenter text-nowrap card-table">
    <thead>
    <tr>
        <th width="10%" scope="col"><?= $this->Paginator->sort('order_id') ?></th>

        <th width="30%" scope="col"><?= $this->Paginator->sort('customers_id') ?></th>
        <th width="20%" scope="col"><?= $this->Paginator->sort('order_date') ?></th>
        <th width="12%" scope="col"><?= $this->Paginator->sort('order_total') ?></th>
        <th width="12%" scope="col"><?= $this->Paginator->sort('due') ?></th>
        <th  width="5%" scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td>  <?= $this->Html->link($order->order_id, ['action' => 'edit', $order->id, 'draft']) ?></td>
            <td><?= $order->has('customer') ? $this->Html->link($order->customer->first_name . " " . $order->customer->last_name, ['controller' => 'Customers', 'action' => 'view', $order->customer->id]) : '' ?></td>

            <td><?= h($order->order_date) ?></td>
            <td><?= $this->Formats->moneyFormat($order->order_total) ?></td>
            <td><?= $this->Formats->moneyFormat($order->due) ?></td>
            <td class="actions">
                <div class="item-action dropdown">
                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(15px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a href="<?= $this->Url->build(['action' => 'edit', $order->id, 'draft']) ?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> <?= __('Edit Order') ?></a>
                        <a href="<?= $this->Url->build(['action' => 'draftToOrder', $order->id]) ?>" class="dropdown-item"><i class="dropdown-icon fe fe-arrow-right"></i> <?= __('Mark as Pending') ?></a>
                        <?= $this->Form->postLink('<i class="dropdown-icon fe fe-trash-2"></i>' . __('Delete Order'), ['action' => 'delete', $order->id, 'draft'], ['escape' => false, 'class'=>'dropdown-item','confirm' => __('Are you sure you want to delete # {0}?', $order->order_id)]) ?>
                    </div>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?=$this->TablerPaginator->links()?>

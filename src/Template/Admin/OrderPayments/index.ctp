<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderPayment[]|\Cake\Collection\CollectionInterface $orderPayments
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Order Payment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orderPayments index large-9 medium-8 columns content">
    <h3><?= __('Order Payments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('orders_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_method') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderPayments as $orderPayment): ?>
            <tr>
                <td><?= $this->Number->format($orderPayment->id) ?></td>
                <td><?= $orderPayment->has('order') ? $this->Html->link($orderPayment->order->id, ['controller' => 'Orders', 'action' => 'view', $orderPayment->order->id]) : '' ?></td>
                <td><?= $this->Number->format($orderPayment->amount) ?></td>
                <td><?= h($orderPayment->payment_date) ?></td>
                <td><?= $this->Number->format($orderPayment->payment_method) ?></td>
                <td><?= h($orderPayment->created_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $orderPayment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderPayment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderPayment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderPayment->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

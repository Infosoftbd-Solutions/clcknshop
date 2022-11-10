<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderPayment $orderPayment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Order Payment'), ['action' => 'edit', $orderPayment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order Payment'), ['action' => 'delete', $orderPayment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderPayment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Order Payments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order Payment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="orderPayments view large-9 medium-8 columns content">
    <h3><?= h($orderPayment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Order') ?></th>
            <td><?= $orderPayment->has('order') ? $this->Html->link($orderPayment->order->id, ['controller' => 'Orders', 'action' => 'view', $orderPayment->order->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($orderPayment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($orderPayment->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Method') ?></th>
            <td><?= $this->Number->format($orderPayment->payment_method) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Date') ?></th>
            <td><?= h($orderPayment->payment_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($orderPayment->created_at) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comments') ?></h4>
        <?= $this->Text->autoParagraph(h($orderPayment->comments)); ?>
    </div>
</div>

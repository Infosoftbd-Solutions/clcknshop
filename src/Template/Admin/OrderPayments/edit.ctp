<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderPayment $orderPayment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $orderPayment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $orderPayment->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Order Payments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orderPayments form large-9 medium-8 columns content">
    <?= $this->Form->create($orderPayment) ?>
    <fieldset>
        <legend><?= __('Edit Order Payment') ?></legend>
        <?php
            echo $this->Form->control('orders_id', ['options' => $orders]);
            echo $this->Form->control('amount');
            echo $this->Form->control('payment_date',['type'=>'text']);
            echo $this->Form->control('payment_method');
            echo $this->Form->control('comments');
            echo $this->Form->control('created_at');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

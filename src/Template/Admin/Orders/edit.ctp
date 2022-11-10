<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $order->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Shipping Methods'), ['controller' => 'ShippingMethods', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Shipping Method'), ['controller' => 'ShippingMethods', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Payment Methods'), ['controller' => 'PaymentMethods', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Payment Method'), ['controller' => 'PaymentMethods', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Order Products'), ['controller' => 'OrderProducts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order Product'), ['controller' => 'OrderProducts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orders form large-9 medium-8 columns content">
    <?= $this->Form->create($order) ?>
    <fieldset>
        <legend><?= __('Edit Order') ?></legend>
        <?php
            echo $this->Form->control('shipping_methods_id', ['options' => $shippingMethods]);
            echo $this->Form->control('payment_methods_id', ['options' => $paymentMethods]);
            echo $this->Form->control('customers_id', ['options' => $customers]);
            echo $this->Form->control('billing_first_name');
            echo $this->Form->control('billing_last_name');
            echo $this->Form->control('billing_address');
            echo $this->Form->control('billing_phone_number');
            echo $this->Form->control('shipping_first_name');
            echo $this->Form->control('shipping_last_name');
            echo $this->Form->control('shipping_phone_number');
            echo $this->Form->control('shipping_address');
            echo $this->Form->control('subtotal');
            echo $this->Form->control('discount');
            echo $this->Form->control('shipping');
            echo $this->Form->control('comments');
            echo $this->Form->control('stuff_notes');
            echo $this->Form->control('order_status');
            echo $this->Form->control('order_date', ['empty' => true]);
            echo $this->Form->control('shipping_weight');
            echo $this->Form->control('shipping_dimention');
            echo $this->Form->control('payment_reference');
            echo $this->Form->control('shipping_reference');
            echo $this->Form->control('city');
            echo $this->Form->control('post_code');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

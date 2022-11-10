<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PaymentProcessor $paymentProcessor
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Payment Processor'), ['action' => 'edit', $paymentProcessor->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Payment Processor'), ['action' => 'delete', $paymentProcessor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paymentProcessor->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Payment Processor'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment Processor'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Payment Methods'), ['controller' => 'PaymentMethods', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment Method'), ['controller' => 'PaymentMethods', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="paymentProcessor view large-9 medium-8 columns content">
    <h3><?= h($paymentProcessor->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Payment Method') ?></th>
            <td><?= $paymentProcessor->has('payment_method') ? $this->Html->link($paymentProcessor->payment_method->name, ['controller' => 'PaymentMethods', 'action' => 'view', $paymentProcessor->payment_method->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($paymentProcessor->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($paymentProcessor->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($paymentProcessor->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $paymentProcessor->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Options') ?></h4>
        <?= $this->Text->autoParagraph(h($paymentProcessor->options)); ?>
    </div>
</div>

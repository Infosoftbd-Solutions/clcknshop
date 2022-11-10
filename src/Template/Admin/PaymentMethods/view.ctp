<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PaymentMethod $paymentMethod
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Payment Method'), ['action' => 'edit', $paymentMethod->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Payment Method'), ['action' => 'delete', $paymentMethod->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paymentMethod->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Payment Methods'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment Method'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="paymentMethods view large-9 medium-8 columns content">
    <h3><?= h($paymentMethod->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($paymentMethod->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Icon') ?></th>
            <td><?= h($paymentMethod->icon) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($paymentMethod->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($paymentMethod->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($paymentMethod->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($paymentMethod->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Options') ?></h4>
        <?= $this->Text->autoParagraph(h($paymentMethod->options)); ?>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ShippingMethod $shippingMethod
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Shipping Method'), ['action' => 'edit', $shippingMethod->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Shipping Method'), ['action' => 'delete', $shippingMethod->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shippingMethod->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Shipping Methods'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shipping Method'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="shippingMethods view large-9 medium-8 columns content">
    <h3><?= h($shippingMethod->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($shippingMethod->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zone Id') ?></th>
            <td><?= h($shippingMethod->zone_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($shippingMethod->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($shippingMethod->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($shippingMethod->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($shippingMethod->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($shippingMethod->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Flat Rate') ?></th>
            <td><?= $shippingMethod->flat_rate ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

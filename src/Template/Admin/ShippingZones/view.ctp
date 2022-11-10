<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ShippingZone $shippingZone
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Shipping Zone'), ['action' => 'edit', $shippingZone->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Shipping Zone'), ['action' => 'delete', $shippingZone->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shippingZone->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Shipping Zones'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shipping Zone'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="shippingZones view large-9 medium-8 columns content">
    <h3><?= h($shippingZone->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($shippingZone->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($shippingZone->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($shippingZone->id) ?></td>
        </tr>
    </table>
</div>

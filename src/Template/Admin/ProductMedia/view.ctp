<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductMedia $productMedia
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Product Media'), ['action' => 'edit', $productMedia->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product Media'), ['action' => 'delete', $productMedia->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productMedia->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Product Media'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product Media'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="productMedia view large-9 medium-8 columns content">
    <h3><?= h($productMedia->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Product') ?></th>
            <td><?= $productMedia->has('product') ? $this->Html->link($productMedia->product->title, ['controller' => 'Products', 'action' => 'view', $productMedia->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Path') ?></th>
            <td><?= h($productMedia->path) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Caption') ?></th>
            <td><?= h($productMedia->caption) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($productMedia->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Variant Id') ?></th>
            <td><?= $this->Number->format($productMedia->variant_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= $this->Number->format($productMedia->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($productMedia->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated') ?></th>
            <td><?= h($productMedia->updated) ?></td>
        </tr>
    </table>
</div>

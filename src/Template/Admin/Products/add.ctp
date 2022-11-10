<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($product) ?>
    <fieldset>
        <legend><?= __('Add Product') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('description');
            echo $this->Form->control('media');
            echo $this->Form->control('price');
            echo $this->Form->control('cost');
            echo $this->Form->control('compare_price');
            echo $this->Form->control('sku');
            echo $this->Form->control('barcode');
            echo $this->Form->control('track_inventory');
            echo $this->Form->control('sell_w_stock');
            echo $this->Form->control('q_available');
            echo $this->Form->control('is_physical');
            echo $this->Form->control('wieight');
            echo $this->Form->control('weight_unit');
            echo $this->Form->control('active');
            echo $this->Form->control('tags._ids', ['options' => $tags]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ShippingMethod $shippingMethod
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Shipping Methods'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="shippingMethods form large-9 medium-8 columns content">
    <?= $this->Form->create($shippingMethod) ?>
    <fieldset>
        <legend><?= __('Add Shipping Method') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('price');
            echo $this->Form->control('flat_rate');
            echo $this->Form->control('zone_id');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

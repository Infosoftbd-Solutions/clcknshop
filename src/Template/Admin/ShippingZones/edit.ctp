<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ShippingZone $shippingZone
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $shippingZone->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $shippingZone->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Shipping Zones'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="shippingZones form large-9 medium-8 columns content">
    <?= $this->Form->create($shippingZone) ?>
    <fieldset>
        <legend><?= __('Edit Shipping Zone') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('city');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

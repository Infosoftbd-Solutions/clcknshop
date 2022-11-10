<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PaymentMethod $paymentMethod
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $paymentMethod->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $paymentMethod->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Payment Methods'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="paymentMethods form large-9 medium-8 columns content">
    <?= $this->Form->create($paymentMethod) ?>
    <fieldset>
        <legend><?= __('Edit Payment Method') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('options');
            echo $this->Form->control('icon');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

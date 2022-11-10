<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PaymentProcessor $paymentProcessor
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $paymentProcessor->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $paymentProcessor->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Payment Processor'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Payment Methods'), ['controller' => 'PaymentMethods', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Payment Method'), ['controller' => 'PaymentMethods', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="paymentProcessor form large-9 medium-8 columns content">
    <?= $this->Form->create($paymentProcessor) ?>
    <fieldset>
        <legend><?= __('Edit Payment Processor') ?></legend>
        <?php
            echo $this->Form->control('payment_method_id', ['options' => $paymentMethods]);
            echo $this->Form->control('name');
            echo $this->Form->control('image');
            echo $this->Form->control('options');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

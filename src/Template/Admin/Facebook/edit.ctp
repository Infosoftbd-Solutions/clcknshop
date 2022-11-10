<?php
/**
 * @var AppView $this
 * @var Facebook $facebook
 */

use App\Model\Entity\Facebook;
use App\View\AppView; ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $facebook->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $facebook->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('List Facebook'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="facebook form large-9 medium-8 columns content">
    <?= $this->Form->create($facebook) ?>
    <fieldset>
        <legend><?= __('Edit Facebook') ?></legend>
        <?php
        echo $this->Form->control('name');
        echo $this->Form->control('email');
        echo $this->Form->control('token');
        echo $this->Form->control('page_name');
        echo $this->Form->control('page_id');
        echo $this->Form->control('page_token');
        echo $this->Form->control('business_id');
        echo $this->Form->control('catalog_id');
        echo $this->Form->control('feed_id');
        echo $this->Form->control('feed_url');
        echo $this->Form->control('pixel_id');
        echo $this->Form->control('pixel_code');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

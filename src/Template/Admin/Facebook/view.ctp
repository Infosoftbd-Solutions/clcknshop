<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Facebook $facebook
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Facebook'), ['action' => 'edit', $facebook->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Facebook'), ['action' => 'delete', $facebook->id], ['confirm' => __('Are you sure you want to delete # {0}?', $facebook->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Facebook'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Facebook'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="facebook view large-9 medium-8 columns content">
    <h3><?= h($facebook->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($facebook->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($facebook->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Page Name') ?></th>
            <td><?= h($facebook->page_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Feed Url') ?></th>
            <td><?= h($facebook->feed_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($facebook->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Page Id') ?></th>
            <td><?= $this->Number->format($facebook->page_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Business Id') ?></th>
            <td><?= $this->Number->format($facebook->business_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Catalog Id') ?></th>
            <td><?= $this->Number->format($facebook->catalog_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Feed Id') ?></th>
            <td><?= $this->Number->format($facebook->feed_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pixel Id') ?></th>
            <td><?= $this->Number->format($facebook->pixel_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($facebook->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated') ?></th>
            <td><?= h($facebook->updated) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Token') ?></h4>
        <?= $this->Text->autoParagraph(h($facebook->token)); ?>
    </div>
    <div class="row">
        <h4><?= __('Page Token') ?></h4>
        <?= $this->Text->autoParagraph(h($facebook->page_token)); ?>
    </div>
    <div class="row">
        <h4><?= __('Pixel Code') ?></h4>
        <?= $this->Text->autoParagraph(h($facebook->pixel_code)); ?>
    </div>
</div>

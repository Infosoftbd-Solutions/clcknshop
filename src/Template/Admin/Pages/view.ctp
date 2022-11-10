<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Page $page
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Page'), ['action' => 'edit', $page->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Page'), ['action' => 'delete', $page->id], ['confirm' => __('Are you sure you want to delete # {0}?', $page->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Pages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Facebook'), ['controller' => 'Facebook', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Facebook'), ['controller' => 'Facebook', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pages view large-9 medium-8 columns content">
    <h3><?= h($page->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($page->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($page->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Slug') ?></h4>
        <?= $this->Text->autoParagraph(h($page->slug)); ?>
    </div>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($page->content)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Facebook') ?></h4>
        <?php if (!empty($page->facebook)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Token') ?></th>
                <th scope="col"><?= __('Page Name') ?></th>
                <th scope="col"><?= __('Page Id') ?></th>
                <th scope="col"><?= __('Page Token') ?></th>
                <th scope="col"><?= __('Business Id') ?></th>
                <th scope="col"><?= __('Catalog Id') ?></th>
                <th scope="col"><?= __('Feed Id') ?></th>
                <th scope="col"><?= __('Feed Url') ?></th>
                <th scope="col"><?= __('Pixel Id') ?></th>
                <th scope="col"><?= __('Pixel Code') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($page->facebook as $facebook): ?>
            <tr>
                <td><?= h($facebook->id) ?></td>
                <td><?= h($facebook->name) ?></td>
                <td><?= h($facebook->email) ?></td>
                <td><?= h($facebook->token) ?></td>
                <td><?= h($facebook->page_name) ?></td>
                <td><?= h($facebook->page_id) ?></td>
                <td><?= h($facebook->page_token) ?></td>
                <td><?= h($facebook->business_id) ?></td>
                <td><?= h($facebook->catalog_id) ?></td>
                <td><?= h($facebook->feed_id) ?></td>
                <td><?= h($facebook->feed_url) ?></td>
                <td><?= h($facebook->pixel_id) ?></td>
                <td><?= h($facebook->pixel_code) ?></td>
                <td><?= h($facebook->created) ?></td>
                <td><?= h($facebook->updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Facebook', 'action' => 'view', $facebook->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Facebook', 'action' => 'edit', $facebook->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Facebook', 'action' => 'delete', $facebook->id], ['confirm' => __('Are you sure you want to delete # {0}?', $facebook->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

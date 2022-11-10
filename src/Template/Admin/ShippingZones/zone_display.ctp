<?php foreach ($shippingZones as $zone): ?>
    <tr>

        <td><?= h($zone->id) ?></td>
        <td><?= h($zone->name) ?></td>
        <td><?= h($zone->city) ?></td>
        <td class="actions">
            <?= $this->Html->link(__('View'), ['action' => 'view', $zone->id],['class'=>['btn', 'btn-outline-primary', 'btn-sm']]) ?>
            <a href="#" data-id="<?php echo $zone->id?>" class="btn edit btn-outline-primary btn-sm">Edit</a>
            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $zone->id], ['class'=>['btn', 'btn-outline-primary', 'btn-sm'],'confirm' => __('Are you sure you want to delete # {0}?', $zone->id)]) ?>
        </td>
    </tr>
<?php endforeach; ?>
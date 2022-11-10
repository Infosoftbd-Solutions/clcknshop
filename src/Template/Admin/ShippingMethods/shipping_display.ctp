<?php foreach ($shippingMethods as $method): ?>
    <tr data-id="<?= $method->id ?>" data-name="<?= $method->name?>" data-price="<?= $method->price ?>" data-flat_rate="<?= $method->flat_rate ?>" data-status="<?= $method->status?>">

        <td><?= h($method->id) ?></td>
        <td><?= h($method->name) ?></td>
        <td><?= h($method->price) ?></td>
        <td class="text-center"><?php echo $method->flat_rate ? '<span class="badge badge-success">Yes</span>':'<span class="badge badge-success">No</span>' ?></td>
        <td><?php echo $method->status ? '<span class="badge badge-info">Active</span>':'<span class="badge badge-danger">Inactive</span>' ?></td>
        <td class="actions">
            <a href="javascript::void(0)" class="btn btn-sm btn-outline-primary btn-edit"><i class="fe fe-edit"></i></a>
            <?= $this->Form->postLink(__('<i class="fe fe-trash"></i>'), ['action' => 'delete', $method->id], ['escape' => false,'class' => 'btn btn-sm btn-outline-primary', 'confirm' => __('Are you sure you want to delete # {0}?', $method->id)]) ?>
        </td>
    </tr>
<?php endforeach; ?>
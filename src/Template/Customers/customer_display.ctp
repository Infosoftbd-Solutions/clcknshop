<table cellpadding="0" cellspacing="0"
       class="table table-hover table-outline table-vcenter text-nowrap card-table">
    <thead>
    <tr>

        <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
        <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
        <th scope="col"><?= $this->Paginator->sort('email') ?></th>
        <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
        <th scope="col"><?= $this->Paginator->sort('passwd') ?></th>

        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($customers as $customer): ?>
        <tr>

            <td><?= h($customer->first_name) ?></td>
            <td><?= h($customer->last_name) ?></td>
            <td><?= h($customer->email) ?></td>
            <td><?= h($customer->phone) ?></td>
            <td><?= h($customer->passwd) ?></td>

            <td class="actions">

                <?= $this->Html->link(__('View'), ['action' => 'view', $customer->id], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customer->id], ['class' => 'btn btn-sm btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $customer->id)]) ?>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>

<?= $this->TablerPaginator->links() ?>

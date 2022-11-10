<table cellpadding="0" cellspacing="0"
       class="table table-hover table-outline table-vcenter card-table">
    <thead>
    <tr>

        <th width="20%" scope="col"><?= $this->Paginator->sort('first_name',"Name") ?></th>

        <th width="15%" scope="col"><?= $this->Paginator->sort('email') ?></th>
        <th width="15%" scope="col"><?= $this->Paginator->sort('phone') ?></th>
        <th width="40%" scope="col"><?= __('Address') ?></th>

        <th width="10%" scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($customers as $customer): ?>
        <tr>

            <td><a href="<?= $this->Url->build(['action' => 'view', $customer->id]) ?>"> <?= $customer->first_name ?> <?= $customer->last_name ?></a></td>
            
            <td><?= h($customer->email) ?></td>
            <td><?= h($customer->phone) ?></td>
            <td><?= h($customer->address) ?>,<?= h($customer->area) ?>,<?= h($customer->city) ?>-<?= h($customer->post_code) ?>,<?= h($customer->country) ?> </td>

            <td class="actions">
                <a href="<?= $this->Url->build(['action' => 'view', $customer->id]) ?>" class="btn btn-sm btn-outline-primary"><i class="fe fe-chevrons-right"></i></a>
                <?= $this->Form->postLink(__('<i class="fe fe-trash"></i>'), ['action' => 'delete', $customer->id], ['escape' => false,'class' => 'btn btn-sm btn-outline-primary', 'confirm' => __('Are you sure you want to delete # {0}?', $customer->id)]) ?>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>

<?= $this->TablerPaginator->links() ?>

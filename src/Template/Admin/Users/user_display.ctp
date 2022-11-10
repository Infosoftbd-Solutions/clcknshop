<table cellpadding="0" cellspacing="0"
       class="table table-hover table-outline table-vcenter text-nowrap card-table">
    <thead>
    <tr>

        <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
        <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
        <th scope="col"><?= $this->Paginator->sort('email') ?></th>
        <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
        <th scope="col"><?= $this->Paginator->sort('role') ?></th>
        <th scope="col"><?= $this->Paginator->sort('status') ?></th>


        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= h($user->first_name) ?></td>
            <td><?= h($user->last_name) ?></td>
            <td><?= h($user->email) ?></td>
            <td><?= h($user->phone) ?></td>
            <td>
                <span class="badge <?= $user->role == 1 ? 'badge-primary' : 'badge-secondary' ?>"> <?= $user->role == 1 ? 'Admin' : 'POS'?></span>
            </td>
            <td>
                <span class="badge <?= $user->status == 1 ? 'badge-success' : 'badge-danger' ?>"> <?= $user->status == 1 ? 'Active' : 'Disabled'?></span>
            </td>

            <td class="actions">
                <a href="<?= $this->Url->build(['action' => 'edit', $user->id]) ?>" class="btn btn-sm btn-outline-primary"><i class="fe fe-edit"></i></a>
                <?= $this->Form->postLink(__('<i class="fe fe-trash"></i>'), ['action' => 'delete', $user->id], ['escape' => false,'class' => 'btn btn-sm btn-outline-primary', 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>

<?= $this->TablerPaginator->links() ?>

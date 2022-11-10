<table cellpadding="0" cellspacing="0"
       class="table table-hover table-outline table-vcenter text-nowrap card-table">
    <thead>
    <tr>

        <th width="15%" scope="col"><?= $this->Paginator->sort('mobile') ?></th>
        <th width="45%" scope="col"><?= $this->Paginator->sort('message') ?></th>
        <th width="15%" scope="col"><?= $this->Paginator->sort('sent_time') ?></th>
        <th width="25%" scope="col"><?= $this->Paginator->sort('status') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($histories as $history): ?>
        <tr>
            <td><?= h($history->mobile) ?></td>
            <td><?= h($history->message) ?></td>
            <td><?= h($history->sent_time) ?></td>

            <td>
                <?php if ($history->status == 0): ?>
                    <span class="badge badge-primary"><?= __('SMS Sent Successfully') ?></span>
                <?php elseif ($history->status == 88): ?>
                    <span class="badge badge-danger"><?= __('SMS failed due to insufficient Balance') ?></span>
                <?php endif; ?>
            </td>

        </tr>
    <?php endforeach; ?>

    </tbody>
</table>

<?= $this->TablerPaginator->links() ?>

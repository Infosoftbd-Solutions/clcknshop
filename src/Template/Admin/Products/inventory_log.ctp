
<div class="row row-cards row-deck mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex">
                <h4 style="margin-bottom: 0px !important;"><?= __("Inventory Log for {0}", [$product->title]) ?></h4>
                <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'inventory']) ?>" class="btn btn-sm btn-outline-primary ml-auto"><?= __('Back') ?></a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                    <thead style="font-weight: bold">
                    <tr>
                        <th width="25%"><?= __("Product") ?></th>
                        <th width="5%"><?= __("Previous") ?></th>
                        <th width="5%"><?= __("Current") ?></th>
                        <th width="5%"><?= __("Order") ?></th>
                        <th width="40%"><?= __("Log") ?></th>
                        <th width="10%"><?= __("Date") ?></th>
                        <th width="10%"><?= __("Added By") ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($logs as $key=> $log) : ?>

                        <tr>
                            <td><div><?= $log->product->title ?></div>
                                <span class="text-danger"><?php if ($log->variant){ $variants = json_decode($log->variant->option_values, true); foreach ($variants as $key => $value) echo "(". $key." - ". $value . ")"; }?></span>
                            </td>
                            <td><?= $log->prev_inventory ?></td>
                            <td><?= $log->current_inventory ?></td>
                            <td>
                                <?php if ($log->order): ?>
                                    <a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'view', $log->order->id]) ?>"> <?= $log->order->order_id ?> </a></td>
                                <?php  endif; ?>
                            <td><?= $log->comment ?></td>
                            <td><?= $log->created ?></td>
                            <td>
                                <?php if($log->user) echo $log->user->first_name. " " . $log->user->last_name ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<style>
    .dataTables_wrapper .table{
        border-top: none;
        border-bottom: none;
    }
</style>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                <table cellpadding="0" cellspacing="0"
                       class="table table-hover table-outline table-vcenter text-nowrap card-table">
                    <thead>
                        <th><?= __('Product Title') ?> </th>
                        <th> <?= __('Product SKU') ?> </th>
                        <th> <?= __('total orders') ?> </th>
                        <th><?= __('Total Quantity') ?> </th>
                        <th><?= __('Selling Price') ?> </th>
                    </thead>
                    <tbody>
                    <?php foreach ($proudct_orders as $order) : ?>
                        <tr>
                            <td><?= $order->product_title ?></td>
                            <td><?= $order->product_sku ?></td>
                            <td><?= $order->total_order ?></td>
                            <td><?= $order->total_quantity ?></td>
                            <td><?= number_format($order->product_price, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
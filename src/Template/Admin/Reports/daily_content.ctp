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
                        <th><?= __('Date') ?></th>
                        <th><?= __('total orders ') ?></th>
                        <th><?= __('subtotal') ?></th>
                        <th><?= __('discount(-)') ?></th>
                        <th><?= __('shipping fee') ?></th>
                        <th><?= __('taxes') ?></th>
                        <th><?= __('Total sales') ?></th>
                    </thead>
                    <tbody>
                    <?php foreach ($sales as $sale) : ?>
                        <tr>
                            <td><?= date_format($sale->order_date,'d-m-Y') ?></td>
                            <td><?= $sale->total_order ?></td>
                            <td><?= \Cake\Core\Configure::read('App.currency') . number_format($sale->total_subtotal, 2) ?></td>
                            <td><?= \Cake\Core\Configure::read('App.currency') . number_format($sale->total_discount ? $sale->total_discount : 0, 2) ?></td>
                            <td><?= \Cake\Core\Configure::read('App.currency') . number_format($sale->total_shipping_fee ? $sale->total_shipping_fee : 0, 2) ?></td>
                            <td><?= \Cake\Core\Configure::read('App.currency') . number_format($sale->total_taxes ? $sale->total_taxes : 0 , 2)?></td>
                            <td><b><?= \Cake\Core\Configure::read('App.currency') . number_format($sale->order_total_sum, 2) ?></b></td>
                        </tr>

                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
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
                    <thead class="text-center">
                        <th>#</th>
                        <th><?= __('Customer Name') ?> </th>
                        <th> <?= __('City ') ?> </th>
                        <th> <?= __('total orders') ?>  </th>
                        <th><?= __('subtotal') ?> </th>
                        <th><?= __('discount(-)') ?> </th>
                        <th><?= __('shipping fee') ?> </th>
                        <th><?= __('taxes') ?> </th>
                        <th><?= __('Total sales') ?> </th>
                    </thead>
                    <tbody>
                    <?php foreach ($customer_orders as $key => $customer_order) : ?>
                        <tr class="text-center">
                            <td><?= ++$key ?></td>
                            <td>   <a href="<?= $this->Url->build(['controller' => 'Customers', 'action' => 'view', $customer_order->customers_id ]);?>"><?= $customer_order->first_name." ".$customer_order->last_name ?></a></td>
                            <td><?= $customer_order->city ?></td>
                            <td><?= \Cake\Core\Configure::read('App.currency') . money_format($customer_order->total_order ? $customer_order-> total_order: 0,2) ?></td>
                            <td><?= \Cake\Core\Configure::read('App.currency') . money_format($customer_order->total_subtotal ? $customer_order->total_subtotal : 0,2) ?></td>
                            <td><?= \Cake\Core\Configure::read('App.currency') . money_format($customer_order->total_discount ? $customer_order->total_discount : 0,2) ?></td>
                            <td><?= \Cake\Core\Configure::read('App.currency') . money_format($customer_order->total_shipping_fee ? $customer_order->total_shipping_fee : 0,2) ?></td>
                            <td><?= \Cake\Core\Configure::read('App.currency') . money_format($customer_order->total_taxes ? $customer_order->total_taxes : 0 ,2) ?></td>
                            <td><b><?= \Cake\Core\Configure::read('App.currency') . number_format($customer_order->order_total_sum, 2) ?></b></td>
                        </tr>

                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
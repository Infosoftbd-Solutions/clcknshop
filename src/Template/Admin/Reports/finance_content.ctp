<div class="col-md-6 px-lg-5 mb-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= __('Sales') ?></h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                    <div class="dataTables_length mx-0" id="DataTables_Table_0_length">

                    </div>
                    <div id="DataTables_Table_0_filter" class="dataTables_filter mx-0">

                    </div>

                    <table class="table table-vcenter table-borderless" style="border: none">
                        <thead>
                        <tr>
                            <td width="70%"><?= __('Total Orders') ?></td>
                            <td width="30%" class="text-right"> <?= \Cake\Core\Configure::read('App.currency') ?><?= key_exists('order_total', $sales) ? number_format($sales['order_total'], 2) : number_format(0,2)   ?></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?= __('Discounts') ?></td>
                            <td class="text-right"> <?= "- " . \Cake\Core\Configure::read('App.currency') ?><?= key_exists('discounts', $sales) ? number_format($sales['discounts'], 2) : number_format(0,2)   ?></td>
                        </tr>
                        <tr>
                            <td><?= __('Returns') ?></td>
                            <td class="text-right"> <?= "-" .  \Cake\Core\Configure::read('App.currency') ?><?= key_exists('returns', $sales) ? number_format($sales['returns'], 2) : number_format(0,2)   ?></td>
                        </tr>
                        <tr style="border-top:1px solid rgba(0, 40, 100, 0.12);">
                            <td><b><?= __('Net sales') ?> </b></td>
                            <td class="text-right"><b> <?= \Cake\Core\Configure::read('App.currency') ?><?= key_exists('net_sales', $sales) ? number_format($sales['net_sales'], 2) : number_format(0,2)   ?></b></td>

                        </tr>
                        <tr>
                            <td><?= __('Shipping') ?></td>
                            <td class="text-right"> <?= \Cake\Core\Configure::read('App.currency') ?><?= key_exists('shipping', $sales) ? number_format($sales['shipping'], 2) : number_format(0,2)   ?></td>

                        </tr>
                        <tr>
                            <td><?= __('Taxes') ?></td>
                            <td class="text-right"> <?= \Cake\Core\Configure::read('App.currency') ?><?= key_exists('taxes', $sales) ? number_format($sales['taxes'], 2) : number_format(0,2)   ?></td>
                        </tr>
                         <tr>
                            <td><?= __('Quantity') ?></td>
                            <td class="text-right"> <?= key_exists('total_quantity', $sales) ? $sales['total_quantity']:""   ?></td>

                        </tr>
                        
                        <tr style="border-top:1px solid rgba(0, 40, 100, 0.12);">
                            <td><b><?= __('Total sales') ?> </b></td>
                            <td class="text-right"><b> <?= \Cake\Core\Configure::read('App.currency') ?><?= key_exists('total_sales', $sales) ? number_format($sales['total_sales'], 2) : number_format(0,2)   ?></b></td>

                        </tr>

                        
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<!--payments-->
<div class="col-md-6 px-lg-5 mb-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= __('Payments') ?></h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                    <div class="dataTables_length mx-0" id="DataTables_Table_0_length">

                    </div>
                    <div id="DataTables_Table_0_filter" class="dataTables_filter mx-0">

                    </div>

                    <table class="table table-vcenter table-borderless" style="border: none">
                        <thead>
                        <?php foreach ($payments as $payment): ?>
                            <tr>
                                <td width="70%"><?= $payment['name'] ?></td>
                                <td width="30%" class="text-right"><?= \Cake\Core\Configure::read('App.currency') . number_format($payment['value'], 2) ?> </td>
                            </tr>
                        <?php endforeach; ?>
                        </thead>
                        <tbody>
                        <tr style="border-top:1px solid rgba(0, 40, 100, 0.12);">
                            <td><b><?= __('Total Payments') ?></b></td>
                            <td class="text-right"><b><?= \Cake\Core\Configure::read('App.currency') . number_format(($total_payments), 2); ?></b></td>
                        </tr>

                        <tr>
                            <td width="70%"><?= __('Total Refunds') ?></td>
                            <td width="30%" class="text-right"><?= \Cake\Core\Configure::read('App.currency') . number_format($total_refunds, 2) ?> </td>
                        </tr>

                        <tr>
                            <td><?= __('Total Dues') ?></td>
                            <td class="text-right">
                            <?= \Cake\Core\Configure::read('App.currency') ?><?= key_exists('total_sales', $sales) ? number_format($sales['total_sales'] - ($total_payments - abs($total_refunds)), 2) : number_format(0,2)   ?></td>

                        </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<!--
<div class="col-md-6 px-lg-5 mb-5">
    <div class="card">
        <div class="card-header d-print-none">
            <h3 class="card-title">Liabilities</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                    <div class="dataTables_length mx-0" id="DataTables_Table_0_length">

                    </div>
                    <div id="DataTables_Table_0_filter" class="dataTables_filter mx-0">

                    </div>

                    <table class="table table-vcenter table-borderless" style="border: none">
                        <thead>
                        <tr>
                            <td width="70%">Cash</td>
                            <td width="30%" class="text-right">$5128</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Bkash</td>
                            <td class="text-right">-$350</td>
                        </tr>
                        <tr>
                            <td>Datch Bangla Bank Ltd</td>
                            <td class="text-right">-$100</td>
                        </tr>
                        <tr>
                            <td><b>Net sales</b></td>
                            <td class="text-right"><b>$1,245</b></td>

                        </tr>
                        <tr>
                            <td>Shipping</td>
                            <td class="text-right">$854</td>

                        </tr>
                        <tr>
                            <td>Taxes</td>
                            <td class="text-right">$650</td>
                        </tr>

                        <tr style="border-top:1px solid rgba(0, 40, 100, 0.12);">
                            <td><b>Total Payments</b></td>
                            <td class="text-right"><b>$12,445</b></td>

                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 px-lg-5 mb-5">
    <div class="card">
        <div class="card-header d-print-none">
            <h3 class="card-title">Gross Profit</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                    <div class="dataTables_length mx-0" id="DataTables_Table_0_length">

                    </div>
                    <div id="DataTables_Table_0_filter" class="dataTables_filter mx-0">

                    </div>

                    <table class="table table-vcenter table-borderless" style="border: none">
                        <thead>
                        <tr>
                            <td width="70%">Cash</td>
                            <td width="30%" class="text-right">$5128</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Bkash</td>
                            <td class="text-right">-$350</td>
                        </tr>
                        <tr>
                            <td>Datch Bangla Bank Ltd</td>
                            <td class="text-right">-$100</td>
                        </tr>
                        <tr>
                            <td><b>Net sales</b></td>
                            <td class="text-right"><b>$1,245</b></td>

                        </tr>
                        <tr>
                            <td>Shipping</td>
                            <td class="text-right">$854</td>

                        </tr>
                        <tr>
                            <td>Taxes</td>
                            <td class="text-right">$650</td>
                        </tr>

                        <tr style="border-top:1px solid rgba(0, 40, 100, 0.12);">
                            <td><b>Total Payments</b></td>
                            <td class="text-right"><b>$12,445</b></td>

                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

-->
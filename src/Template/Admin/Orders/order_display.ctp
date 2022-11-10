
<table cellpadding="0" cellspacing="0" class="table card-table table-hover table-outline table-vcenter text-nowrap  datatable dataTable card-table">
    <thead>
        <tr>
            <th width="10%" scope="col"><?= $this->Paginator->sort('order_id') ?></th>

            <th width="27%" scope="col"><?= $this->Paginator->sort('customers_id') ?></th>
            <th width="20%" scope="col"><?= $this->Paginator->sort('order_date') ?></th>
            <th width="12%" scope="col"><?= $this->Paginator->sort('order_total') ?></th>
            <th width="12%" scope="col"><?= $this->Paginator->sort('due') ?></th>
            <th width="11%" scope="col"><?= $this->Paginator->sort('order_status') ?></th>
            <th width="5%" scope="col" class="actions"></th>
            <th width="3%" scope="col" class="actions"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            
        <tr >
            <td> <?= $this->Html->link($order->order_id, ['action' => 'view', $order->id],['class'=>"text-muted "]) ?></td>
            <td><?= $order->has('customer') ? $this->Html->link($order->customer->first_name . " " . $order->customer->last_name, ['controller' => 'Customers', 'action' => 'view', $order->customer->id],['class'=>"text-inherit "]) : '' ?>
            </td>

            <td><?= $this->Html->link(h($order->order_date), ['action' => 'view', $order->id],['class'=>"text-inherit "]) ?></td>
            <td>
                <?= $this->Formats->moneyFormat($order->order_total) ?>
                <?php 
                    if(strtolower($subdomain) == 'easyvpn'){
                        echo "({$order->total_quantity})";
                    }
                ?>
            </td>
            <td><?= $this->Formats->moneyFormat($order->due) ?></td>
            <td>
                <?php
                        $badge = [0=>'badge-primary',1=>'badge-info', 2=>'badge-warning',3=>'badge-success', 4=>'badge-danger'];
                        $order_statuses = [0=>'Pending',1=>'Processing',2=>'Shipped',3=>'Delivered',4=>'Cancelled',5=>'Payment'];
                    ?>
                <span style="cursor: pointer;" class="order_status badge <?=$badge[$order->order_status] ?>"
                    data-oid="<?= $order->id ?>"
                    data-sid="<?= $order->order_status ?>"><?= $order_statuses[$order->order_status]?></span>
            </td>

            <td class="actions">
           
            <div class="dropdown">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                             Payment
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <?php if ($order->due > 0): ?>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#PaymentModal"
                            data-id="<?=$order->id?>" data-order-id="<?=$order->order_id?>" data-due="<?=$order->due?>"
                            class="dropdown-item"><i class="dropdown-icon fe fe-dollar-sign"></i> <?= __('Process Payment') ?> </a>
                        <?php endif; ?>

                        <?php if ($order->total_paid > 0): ?>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#RefundModal"
                            data-id="<?=$order->id?>" data-order-id="<?=$order->order_id?>"
                            data-paid="<?=$order->total_paid?>" class="dropdown-item"><i
                                class="dropdown-icon fe fe-dollar-sign"></i> <?= __('Process Refund') ?> </a>
                        <?php endif; ?>

                        <a href="javascript:void(0)" data-id="<?=$order->id?>" data-order-id="<?=$order->order_id?>"
                            class="dropdown-item order_payment_log"><i class="dropdown-icon fe fe-share-2"></i> <?= __('Payment Log') ?> </a>
                            </div>
                          </div>
                          
                <div class="item-action dropdown">
                
                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon" aria-expanded="false"><i
                            class="fe fe-more-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                        style="position: absolute; transform: translate3d(15px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">
                 
                        <a 
                            href="<?= $this->Url->build(['action' => 'Invoice', $order->order_id]) ?>"
                            class="dropdown-item"><i class="dropdown-icon fe fe-printer"></i> <?= __('Print Invoice') ?></a>
                        <a 
                            href="<?= $this->Url->build(['action' => 'PackingSlip', $order->order_id]) ?>"
                            class="dropdown-item"><i class="dropdown-icon fe fe-printer"></i> <?= __('Print Packing Slip') ?></a>
                        <a href="<?= $this->Url->build(['action' => 'Invoice', $order->order_id, $order->order_password, '_ext'=>'pdf']) ?>"
                            class="dropdown-item"><i class="dropdown-icon fe fe-download-cloud"></i> <?= __('Download Invoice') ?>
                            </a>
                        <a href="<?= $this->Url->build(['action' => 'PackingSlip', $order->order_id, $order->order_password, '_ext'=>'pdf']) ?>"
                            class="dropdown-item"><i class="dropdown-icon fe fe-download-cloud"></i> <?= __('Download Packing Slip') ?>
                            </a>
                    </div>
                </div>
               
            </td>
            <td>
            <a class="icon" href="<?=$this->Url->build( ['action' => 'view', $order->id])?>">
                              <i class="fe fe-edit"></i>
                            </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?=$this->TablerPaginator->links()?>

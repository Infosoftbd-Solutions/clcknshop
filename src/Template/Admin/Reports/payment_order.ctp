<style>
    .dataTables_wrapper .table{
        border-top: none;
        border-bottom: none;
    }
</style>

<script>
    require.config({
        shim: {
            'flatpickr': ['jquery']
        },
        paths: {
            'flatpickr': 'assets/js/vendors/flatpickr.min'
        }
    });
</script>

    <div class="row">
        <div class="col-12 d-flex justify-content-between pb-5">
            <div class="title">
                <h2 class="pl-3 page-title">
                <?= __('Orders Payment Reports') ?>
                </h2>
            </div>

            <div class="filter-action pr-3">
                
                <form method="get" action="<?= $this->Url->build(['controller' => 'Reports', 'action' => 'orderPaymentReports']) ?>">

                    <div class="input-group">
                        
                        <div class="input-group-prepend">
                            <input type="text" name="order_id" value="<?= isset($_GET['order_id']) ? $_GET['order_id'] : '' ?>" class="form-control" placeholder="Order ID">
                        </div>
                            <select class="form-control" name="payment_type">
                                <option value="">Payment Type</option>
                                <option <?= (isset($_GET['payment_type']) && $_GET['payment_type'] == 'payment') ? 'selected' : '' ?> value="payment">Payment</option>
                                <option <?= (isset($_GET['payment_type']) && $_GET['payment_type'] == 'refund')  ? 'selected' : '' ?> value="refund">Refund</option>
                            </select>

                            <div class="input-icon d-inline-block">
                                <input id="filter_range" value="<?= isset($_GET['date_range']) ? $_GET['date_range'] : '' ?>" type="text" name="date_range"  class="form-control flatpickr-input calendar-range" placeholder="<?= __('Select a date') ?>" readonly="readonly">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                        <line x1="16" y1="3" x2="16" y2="7"></line>
                                        <line x1="8" y1="3" x2="8" y2="7"></line>
                                        <line x1="4" y1="11" x2="20" y2="11"></line>
                                        <line x1="11" y1="15" x2="12" y2="15"></line>
                                        <line x1="12" y1="15" x2="12" y2="18"></line>
                                    </svg>
                                </span>
                            </div>
                        

                        
                        <div class="input-group-append">
                            <button type="submit" id="search" class="btn btn-primary"><i class="fe fe-search"></i></button>
                            <button id="print" type="button" class="btn btn-outline-secondary">
                                <i class="fe fe-printer"></i>
                                <?= __('Print') ?>
                            </button>
                            <button type="button" class="btn btn-outline-secondary">
                                <i class="fe fe-download"></i>
                                <?= __('Export') ?>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

<div class="col-12">
    <div id="content">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                        <table cellpadding="0" cellspacing="0"
                            class="table table-hover table-outline table-vcenter text-nowrap card-table">
                            <thead>
                                <th><?= __('Order ID') ?> </th>
                                <th><?= __('Customer') ?> </th>
                                <th> <?= __('Payment Method') ?> </th>
                                <th> <?= __('Amount') ?> </th>
                                <th> <?= __('Payment Type') ?></th>
                                <th><?= __('Payment Date') ?> </th>
                            </thead>
                            <tbody>
                            <?php foreach ($payments as $payment) : ?>
                                <tr>
                                    <td> <?= $this->Html->link($payment->order->order_id, ['controller' => 'orders', 'action' => 'view', $payment->orders_id],['class'=>"text-muted "]) ?></td>
                                    <td> <?= $this->Html->link($payment->order->customer->first_name . ' ' . $payment->order->customer->last_name, ['controller' => 'customers', 'action' => 'view', $payment->order->customer->id],['class'=>"text-muted "]) ?></td>
                                    <td><?= $payment->pay_method->name ?></td>
                                    <td><?= number_format($payment->amount, 2) ?></td>
                                    <td> <?= $payment->amount < 0 ? '<span class="badge badge-sm bg-red"> Refund </span>' : '<span class="badge badge-sm bg-green">Payment</span>' ?> </td>
                                    <td><?= $payment->payment_date ?></td>
                                </tr>
                            <?php endforeach; ?>

                                <tr>
                                    <td></td>
                                    <td> <b>Total Payment </b> </td>
                                    <td> <b> <?= number_format($report['total_payment'], 2) ?> </b> </td>
                                    <td> <b>Total Refund </b> </td>
                                    <td> <b> <?= number_format($report['total_refund'], 2) ?> </b> </td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                        <?=$this->TablerPaginator->links()?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    require(['jquery', 'flatpickr'], function ($, selectize) {
        $(document).ready(function () {
            $(".calendar-range").flatpickr({
                mode: "range",
                dateFormat: "d-m-Y",
                defaultDate: null
                // defaultDate: [last_date(15), new Date()]
            })

            function last_date(days) {
                var date = new Date();
                return date.setDate(date.getDate() - days)
            }

            
            $("#print").click(function(){
                //window.print();
                var head = $("head").html();
                var content = $("#content").html();
                var src = "<html> <head>" + head +'</head> <body><div class="row">' + content + '</div></body></html>';
                
                console.log(src)
                var w = window.open()
                w.document.write(src);

                
                setTimeout(() =>{
                    w.window.print();
                    w.window.close();
                },500)

                

            })

        });
    });


</script>

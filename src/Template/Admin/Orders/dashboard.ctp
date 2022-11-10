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

 <!-- c3.js Charts Plugin -->
    <?php echo $this->Html->css('/assets/plugins/charts-c3/plugin.css'); ?>
    <?php echo $this->Html->script('/assets/plugins/charts-c3/plugin.js'); ?>

<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header d-flex justify-content-between">
            <h1 class="page-title">
            <?= __('Dashboard') ?>
            </h1>
            <div>
                <button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle"
                    aria-expanded="false" id="filter-btn-label"><?= __('Today') ?></button>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                    style="position: absolute; transform: translate3d(359px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a data-filter="0" class="dropdown-item filter" href="javascript:void(0)">
                        <?= __('Today') ?>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a data-filter="1" class="dropdown-item filter" href="javascript:void(0)">
                        <?= __('Yesterday') ?>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a data-filter="2" class="dropdown-item filter" href="javascript:void(0)">
                        <?= __('Last 7 Days') ?>
                    </a>

                </div>
            </div>
        </div>
        <div class="row row-cards row-deck">
            <div class="col-md-6 col-lg-12">
                <div class="row">
                        <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3">
                      <i class="fe fe-dollar-sign"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)"><?=$summary['total_sales']?> <small>Sales</small></a></h4>
                      <small class="text-muted">Total <?= $totalSub['processing'] ?> processing orders</small>
                    </div>
                  </div>
                </div>
              </div>

                   <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3">
                      <i class="fe fe-shopping-cart"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)"><?=$summary['total_orders']?> <small>Orders</small></a></h4>
                      <small class="text-muted">Total <?= $totalSub['shipped'] ?> shipped orders</small>
                    </div>
                  </div>
                </div>
              </div>

               <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-red mr-3">
                      <i class="fe fe-credit-card"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)"><?=$summary['total_payments']?> <small>Payments</small></a></h4>
                      <small class="text-muted">Total <?= $totalSub['dues'] ?> due payment</small>
                    </div>
                  </div>
                </div>
              </div>

                <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-yellow mr-3">
                      <i class="fe fe-users"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)"><?=$summary['total_customers']?> <small>Customers</small></a></h4>
                      <small class="text-muted">Total <?= $totalSub['customer'] ?> registered customers</small>
                    </div>
                  </div>
                </div>
              </div>
                </div>
              
            </div>

            <div class="col-md-6 col-lg-4">
                    
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Order Status Report</h3>
                    </div>
                    <div class="card-body">
                    <div id="order_status_report" style="height: 15rem;"></div>
                    </div>
                </div>

            </div>


            <div class="col-md-6 col-lg-4">
                    
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Order Payment Report</h3>
                    </div>
                    <div class="card-body">
                    <div id="order_payment_report" style="height: 15rem;"></div>
                    </div>
                </div>

            </div>

            <div class="col-md-6 col-lg-4">
                    
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">Payment Method Report</h3>
                        </div>
                        <div class="card-body">
                        <div id="order_payment_method_report" style="height: 15rem;"></div>
                        </div>
                    </div>
    
            </div>



            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><?= __("Last 30 Days Sales Summary") ?></h4>
                            </div>


                            <div class="card-body">
                                <div id="chart-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script>
    require(['c3', 'jquery'], function(c3, $) {
        $(document).ready(function() {
            var reports = JSON.parse('<?= $reports ?>');
            // console.log(chart_data);

            var data1 = reports.last30Days.sales.reverse();
            var data2 = reports.last30Days.payments.reverse();
            var labels = reports.last30Days.labels.reverse();
            data1.unshift('data1');
            data2.unshift('data2');

            let routeUrl = "<?php echo $this->Url->build('admin/orders/dashboard', true) ?>"

            $(".filter").click(function() {
                $("#filter-btn-label").text($(this).text().trim());
                loadOrderSummary(routeUrl + "/" + $(this).attr('data-filter'))
            });


            function loadOrderSummary(url) {
                $.get(url, function(response, status) {
                    $("#total_orders").text(response.total_orders);
                    $("#total_sales").text(response.total_sales);
                    $("#total_payments").text(response.total_payments);
                    $("#total_customers").text(response.total_customers);
                });
            }



            // console.log(data1);
            // console.log(data2);
            var chart = c3.generate({
                bindto: '#chart-bar', // id of chart wrapper
                data: {
                    columns: [
                        data1,
                        data2
                        // each columns data
                        // chart.sales,
                        //chart.payments

                    ],
                    type: 'bar', // default type of chart
                    colors: {
                        'data1': tabler.colors["blue"],
                        'data2': '#45aaf2'
                    },
                    names: {
                        // name of each serie
                        'data1': 'Total Sales',
                        'data2': 'Total Payments'
                    }
                },
                axis: {
                    x: {
                        type: 'category',
                        // name of each category
                        categories: labels //daysInThisMonth()
                    },
                },
                bar: {
                    width: 5
                },
                legend: {
                    show: false, //hide legend
                },
                padding: {
                    bottom: 0,
                    top: 0
                },
            });

            //console.log(reports.status_reports)
            status_data = []

            reports.status_reports.forEach((value, index) => {
                status_data[index] = [index, value];

            })
            //console.log(status_data);

            var statusChart = c3.generate({
                bindto: '#order_status_report', // id of chart wrapper
                data: {
                    columns: status_data,

                    type: 'pie', // default type of chart
                    labels: true,

                    colors: {
                        0: '#467fcf',
                        1: '#45aaf2',
                        2: '#f1c40f',
                        3: '#5eba00',
                        4: '#cd201f'
                    },
                    names: {
                        // name of each serie
                        0: 'Pending',
                        1: 'Processing',
                        2: 'Shipped',
                        3: 'Delivered',
                        4: 'Cancelled'
                    },
                    
                },

                axis: {
                },
                legend: {
                        show: true, //hide legend
                },
                padding: {
                    bottom: 0,
                    top: 0
                },
            });

            payment_data = Object.keys(reports.payment_reports).map((key) => [key, reports.payment_reports[key]]);


            var paymentChart = c3.generate({
                bindto: '#order_payment_report', // id of chart wrapper
                data: {
                    type: 'donut', // default type of chart
                    labels: true,

                    columns: payment_data,

                    colors: {
                        'sales' : '#467fcf',
                        'paid'  : '#45aaf2',
                        'dues'  : '#f1c40f',
                        'refund': '#5eba00',  
                    },

                    names: {
                        // name of each serie
                        'sales': 'Sales',
                        'paid': 'Paid',
                        'dues': 'Dues',
                        'refund': 'Refund',
                      
                    }
                    
                },
                
                donut: {
                    title: "Payment"
                },

                axis: {
                },
                legend: {
                        show: true, //hide legend
                },
                padding: {
                    bottom: 0,
                    top: 0
                },
            });
            

            pm_data =  Object.keys(reports.pm_reports.data).map((key) => [key, reports.pm_reports.data[key]])
        


            var paymentChart = c3.generate({
                bindto: '#order_payment_method_report', // id of chart wrapper
                data: {
                    type: 'donut', // default type of chart
                    labels: true,

                    columns: pm_data,

                    colors: reports.pm_reports.color,

                    names: reports.pm_reports.label,
                    
                },
                
                donut: {
                    title: "Payment Method"
                },

                axis: {
                },
                legend: {
                        show: true, //hide legend
                },
                padding: {
                    bottom: 0,
                    top: 0
                },
            });


        });
    });

    </script>
</div>
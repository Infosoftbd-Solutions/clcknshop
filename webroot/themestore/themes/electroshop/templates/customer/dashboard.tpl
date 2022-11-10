<style>
    .table td, .table th{
        padding: 13px !important;
    }
    .table thead tr td{
        font-weight: bold;
        border-top: none !important;
    }
    .table td a{
        text-decoration: none;
        font-weight: bold;
        cursor: pointer;
    }
</style>

<main class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-lg-last dashboard-content">
                <div class="row">
                    <div class="col-md-12 mt-1">
                        <div class="card">
                            <div class="card-header">
                                {{customer->first_name}} {{customer->last_name}}'s Orders
                            </div><!-- End .card-header -->

                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <td>Order ID</td>
                                    <td>Order Date</td>
                                    <td>Order Status</td>
                                    <td>Order total Amount</td>
                                    </thead>

                                    <tr tpleach="customer->orders" set="order">
                                        <td><a target="_blank" href="{{order->link}}">{{ order->order_id }}</a></td>
                                        <td>{{ order->order_date }}</td>
                                        <td><span class="badge {{ Formats.getOrderStatusBadge($order->order_status)}}"> {{Formats.getOrderStatus($order->order_status)}} </span></td>
                                        <td>{{ Formats.moneyFormat($order->order_total) }}</td>
                                    </tr>

                                </table>
                            </div><!-- End .card-body -->
                        </div><!-- End .card -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .col-lg-9 -->

            <aside class="sidebar col-lg-3">
                <div class="widget widget-dashboard pt-3">
                    <ul class="list">
                        <li class="active"><a href="customer">Dashboard</a></li>
                        <li><a href="customer/profile">Profile</a></li>
                        <li><a href="customer/logout">Logout</a></li>
                    </ul>
                </div><!-- End .widget -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- margin -->
</main>




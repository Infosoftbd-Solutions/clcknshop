<div class="my-account-wrapper pt-40 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#dashboad" class="" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                    Dashboard</a>
                                <a href="#orders" data-toggle="tab" class="active"><i class="fa fa-cart-arrow-down"></i> Orders</a>
                                <a href="#account-info" data-toggle="tab" class=""><i class="fa fa-user"></i> Account Details</a>
                                <a href="#change-password" data-toggle="tab" class=""><i class="fa fa-lock"></i> Change Password</a>
                                <a href="customer/logout"><i class="fa fa-sign-out"></i> Logout</a>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->
                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="dashboad" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Dashboard</h3>
                                        <div class="welcome">
                                            <p>Hello, <strong>{{ customer->first_name}} {{ customer->last_name }}</strong> (If Not <strong>{{customer->first_name}} {{customer->last_name}} !</strong><a href="logout" class="logout"> Logout</a>)</p>
                                        </div>

                                        <p class="mb-0">From your account dashboard. you can easily check &amp; view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade active show" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Orders</h3>
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered" tplcheck="customer->orders" tplmsg="You have no orders in your Account.">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr tpleach="customer->orders" set="order">
                                                    <td><a href="{{ order->link }}" target="_blank"> {{ order->order_id }} </a></td>
                                                    <td>{{order->order_date}}</td>
                                                    <td><span class="badge {{ Formats.getOrderStatusBadge($order->order_status)}}"> {{Formats.getOrderStatus($order->order_status)}} </span></td>
                                                    <td>{{ Formats.moneyFormat($order->order_total)}}</td>
                                                    <td><a target="_blank" href="{{ order->link }}" class="check-btn sqr-btn ">View</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Account Details</h3>
                                        <div class="account-details-form">
                                            <form action="#" tplform="customer/edit">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="first-name" class="required">First Name</label>
                                                            <input type="text" id="first-name" name="first_name" placeholder="First Name" value="{{ customer->first_name }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="last-name" class="required">Last Name</label>
                                                            <input type="text" id="last-name" name="last_name" placeholder="Last Name" value="{{ customer->last_name }}" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">Email Address</label>
                                                            <input type="email" id="email" name="email" placeholder="Email Address" required value="{{ customer->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="phone" class="required">Phone Number</label>
                                                            <input type="text" id="phone" name="phone" placeholder="Phone Number" value="{{ customer->phone }}" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="single-input-item">
                                                    <label for="address" class="required">Address</label>
                                                    <textarea name="address" placeholder="Address" id="address">{{ customer->address }}</textarea>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="area" class="required">Area</label>
                                                            <input type="area" id="area" name="area" placeholder="Area" required value="{{ customer->area }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="city" class="required">City/District/State</label>
                                                            <input type="text" id="city" name="city" placeholder="City/District/State" value="{{ customer->city }}" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="post_code" class="required">Post Code</label>
                                                            <input type="text" id="post_code" name="post_code" placeholder="Post Code" required value="{{ customer->post_code }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="country" class="required">Country</label>
                                                            <input type="text" id="country" name="country" placeholder="City/District/State" value="{{ customer->country }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-input-item">
                                                    <button class="check-btn sqr-btn ">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->
                                <div class="tab-pane fade" id="change-password" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Change Password</h3>
                                        <div class="account-details-form">
                                            <form action="#" tplform="customer/change-password">

                                                <div class="single-input-item">
                                                    <label for="current-pwd" class="required">Current Password</label>
                                                    <input type="password" id="current-pwd" name="old_password" required placeholder="Current Password">
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="new-pwd" class="required">New Password</label>
                                                            <input type="password" id="new-pwd" name="new_password" required placeholder="New Password">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="confirm-pwd" class="required">Confirm Password</label>
                                                            <input type="password" id="confirm-pwd" name="confirm_password" placeholder="Confirm Password" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="single-input-item">
                                                    <button class="check-btn sqr-btn ">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->
                            </div>
                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>
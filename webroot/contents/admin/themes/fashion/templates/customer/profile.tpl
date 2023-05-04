<style>
    .customer .form-control{
        height: 0px !important;
        font-size: 14px;
        border-radius: 3px;

    }

    #changePassword input{
        height: auto;
        font-size: 14px;
        padding: 10px 10px;
        border-radius: 3px;
    }
    #changePassword button{
        padding: 10px 20px;
        font-size: 16px;
        font-weight: 450;
        text-transform: capitalize;
        border-radius: 5px;
    }
</style>

<main class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-lg-last dashboard-content">
                <div class="row">
                    <div class="col-md-12 mt-1">
                        <div class="card customer">
                            <div class="card-header">
                                {{customer->first_name}} {{customer->last_name}}'s Information
                            </div><!-- End .card-header -->

                            <div class="card-body">

                                <form action="#" tplform="customer/edit">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group required-field">
                                                <label for="name">First Name</label>
                                                <input type="text" class="form-control" id="name" name="first_name" required="" placeholder="First Name" value="{{ customer->first_name }}">
                                            </div><!-- End .form-group -->
                                        </div><!-- End .col-md-4 -->

                                        <div class="col-md-6">
                                            <div class="form-group required-field">
                                                <label for="lastname">Last Name</label>
                                                <input type="text" class="form-control" id="lastname" name="last_name" required="" placeholder="last Name" value="{{ customer->last_name }}">
                                            </div><!-- End .form-group -->
                                        </div><!-- End .col-md-4 -->
                                    </div><!-- End .row -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group required-field">
                                                <label for="address">Address</label>
                                                <textarea required name="address" id="address" class="form-control" placeholder="Address">{{customer->address}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group required-field">
                                                <label for="area">Area</label>
                                                <input type="text" class="form-control" id="area" name="area" required="" value="{{ customer->area }}">
                                            </div><!-- End .form-group -->
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group required-field">
                                                <label for="city">City/District/State</label>
                                                <input type="text" class="form-control" id="city" name="city" required="" value="{{ customer->city }}">
                                            </div><!-- End .form-group -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group required-field">
                                                <label for="post-code">Post Code</label>
                                                <input type="text" class="form-control" id="post-code" name="post_code" required="" value="{{ customer->post_code }}">
                                            </div><!-- End .form-group -->
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group required-field">
                                                <label for="country">Country</label>
                                                <input type="text" class="form-control" id="country" name="country" required="" value="{{ customer->country }}">
                                            </div><!-- End .form-group -->
                                        </div>
                                    </div>

                                    <div class="form-footer">
                                        <div class="form-footer-right">
                                            <button style="padding: 10px 20px; font-size: 15px; font-weight: bold; border-radius: 5px" type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div><!-- End .form-footer -->
                                </form>


                            </div><!-- End .card-body -->
                        </div><!-- End .card -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .col-lg-9 -->

            <aside class="sidebar col-lg-3">
                <div class="widget widget-dashboard pt-3">
                    <ul class="list">
                        <li><a href="customer">Dashboard</a></li>
                        <li class="active"><a href="customer/profile">Profile</a></li>
                        <li data-toggle="modal" data-target="#changePassword"><a href="javascript::void(0)">Change Password</a></li>
                        <li><a href="customer/logout">Logout</a></li>
                    </ul>
                </div><!-- End .widget -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- margin -->
</main>




<!--Edit customer modal-->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="customer/change-password" tplform="">
                <div class="modal-body">
                    <fieldset class="form-fieldset">
                        <div class="row">
                            <input type="text" name="old_password" class="form-control" placeholder="Old Password" required>
                            <input type="password" name="new_password" class="form-control" placeholder="Password" required>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
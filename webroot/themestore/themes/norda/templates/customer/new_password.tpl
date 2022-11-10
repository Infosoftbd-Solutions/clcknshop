<div class="login-register-area pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> Reset Password </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container" style="border: 1px solid #f2f2f2 !important;">
                                <div class="login-register-form">
                                    <form action="#" method="post" tplform="reset-password">
                                        <input type="hidden" name="token" value="{{token}}">
                                        <input type="password" name="password" required placeholder="Enter New Password">
                                        <input type="password" name="confirm_password" required placeholder="Enter Confirm Password">
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <button type="submit">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
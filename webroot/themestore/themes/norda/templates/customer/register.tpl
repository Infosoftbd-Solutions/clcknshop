<div class="login-register-area pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a data-toggle="tab" href="#lg1">
                            <h4> login </h4>
                        </a>
                        <a class="active" data-toggle="tab" href="#lg2">
                            <h4> register </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane">
                            <div class="login-form-container" style="border: 1px solid #f2f2f2 !important;">
                                <div class="login-register-form">
                                    <form action="#" method="post" tplform="login">
                                        <input required type="text" name="username" placeholder="Username">
                                        <input required type="password" name="password" placeholder="Password">
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <button type="submit">Login</button>
                                                <a href="reset-password">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="lg2" class="tab-pane active">
                            <div class="login-form-container" style="border: 1px solid #f2f2f2 !important;">
                                <div class="login-register-form">
                                    <form action="#" method="post" tplform="register">
                                        <input required  type="text" name="first_name" placeholder="First Name">
                                        <input  required type="text" name="last_name" placeholder="Last Name">
                                        <input  required name="email" placeholder="Email" type="email">
                                        <input  required type="password" name="password" placeholder="Password">
                                        <input  required type="password" name="confirm_password" placeholder="Confirm Password">
                                        <div class="button-box">
                                            <button type="submit">Register</button>
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
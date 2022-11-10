<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <!-- Sign-in -->
                <div class="col-md-6 col-md-offset-3 sign-in" style="padding-top: 20px;padding-bottom: 20px;">
                    <h4 class="">Sign in</h4>
                    <form action="" tplform="login" class="register-form outer-top-xs" role="form">
                        <input type="hidden" value="{{referer}}" name="referer">
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                            <input type="text" name="username" class="form-control unicase-form-control text-input"
                                id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                            <input type="password" name="password" class="form-control unicase-form-control text-input"
                                id="exampleInputPassword1">
                        </div>
                        <div class="radio outer-xs">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Remember
                                me!
                            </label>
                            <a href="#" class="forgot-password pull-right">Forgot your Password?</a>
                        </div>
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                        <a href="/register" class="btn btn-primary">Register</a>
                    </form>
                </div>
                <!-- Sign-in -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.sigin-in-->
    </div>
    <!-- /.container -->
</div>
<!-- /.body-content -->
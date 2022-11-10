<main class="main">
    <div class="container">
        <div class="row">
            <div  class="col-md-7 mx-auto py-5 px-5 mt-3" style="border:1px solid #ececec">
                <div class="heading">
                    <h2 class="title">Login</h2>
                    <p>If you have an account with us, please log in.</p>
                </div><!-- End .heading -->

                <form action="" tplform="login">
                    <input type="hidden" value="{{referer}}" name="referer">
                    <input name="username" type="text" class="form-control" placeholder="Email Address" required>
                    <input name="password" type="password" class="form-control" placeholder="Password" required>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">LOGIN</button>
                        <a href="reset-password" class="forget-pass"> Forgot your password?</a>
                        <div class="form-footer-right">
                            Don't have account yet? <a href="register" tabindex="-1">Sign up</a>
                        </div>

                    </div><!-- End .form-footer -->
                </form>
            </div><!-- End .col-md-6 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- margin -->
</main><!-- End .main -->
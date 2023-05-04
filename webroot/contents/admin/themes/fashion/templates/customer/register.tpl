<main class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-7 mx-auto py-5 px-5 mt-3" style="border:1px solid #ececec">
                <div class="heading">
                    <h2 class="title">Create An Account</h2>
                </div><!-- End .heading -->
                <form action="#" tplform="register">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                        </div>
                    </div>
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox"  name="agree" class="custom-control-input" id="newsletter-signup" required>
                        <label class="custom-control-label" for="newsletter-signup">
                            <span class="form-check-label">Agree the <a href="terms-of-service" tabindex="-1">terms and policy</a>.</span>
                        </label>
                    </div><!-- End .custom-checkbox -->

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">Create Account</button>
                        <div class="form-footer-right">
                            Already have account? <a href="login" tabindex="-1">Sign in</a>
                        </div>
                    </div><!-- End .form-footer -->
                </form>
            </div><!-- End .col-md-6 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- margin -->
</main><!-- End .main -->
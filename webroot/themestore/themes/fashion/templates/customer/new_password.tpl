<main class="main">
    <div class="container">
        <div class="row">
            <div  class="col-md-7 mx-auto py-5 px-5 mt-3" style="border:1px solid #ececec">
                <div class="heading">
                    <h2 class="title">Reset Password</h2>
                </div><!-- End .heading -->

                <form action="" tplform="reset-password">
                    <input type="hidden" name="token" value="{{token}}">
                    <input name="password" type="password" class="form-control" placeholder="New Password" required>
                    <input name="confirm_password" type="password" class="form-control" placeholder="Confirm New Password" required>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                    </div><!-- End .form-footer -->
                </form>
            </div><!-- End .col-md-6 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- margin -->
</main><!-- End .main -->
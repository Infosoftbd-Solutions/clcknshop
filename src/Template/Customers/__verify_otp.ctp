
<div class="row">
    <div class="col col-login mx-auto">
        <div class="text-center">
            <?= $this->Flash->render() ?>
            <h3>Clcknshop</h3>
            <!--                        <img src="assets/images/logo/logo.png" class="h-6" alt="">-->
        </div>
        <div class="card">
            <?= $this->Form->create(null, ['url'=>['controller' => 'Customers', 'action'=> 'verifyOtp'], 'id'=>['login-form']]) ?>
            <div class="card-body p-6">
                <div class="card-title text-center">OTP Verify</div>
                <div class="form-group">
                    <label id="otp_exp" data-exp="<?= $otp['exp'] ?>"  class="form-label">OTP <span class="pull-right" id="exp_timer"></span> </label>
                    <input type="text" name="code" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter OTP">
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Verify OTP</button>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>


<script>
    require(['jquery'], function ($, selectize) {
        $(document).ready(function () {
            setInterval(() => {
                timer();
            }, 1000)


            function timer() {
                let exp = $("#otp_exp").attr('data-exp');
                let d = new Date();
                let timestamp = Math.floor(d.getTime() / 1000);
                let remain = exp - timestamp;
                if (remain > 0){
                    let t = (remain-(remain%=60))/60+(9<remain?':':':0')+remain
                    $("#exp_timer").text(t);
                }
                else{
                    let resend = '<a href="/resend-otp">Re-send Code</a>'
                    $("#exp_timer").html(resend);

                }


            }

        });

    });


</script>

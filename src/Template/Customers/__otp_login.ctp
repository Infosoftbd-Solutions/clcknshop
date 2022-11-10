
<div class="row">
    <div class="col col-login mx-auto">
        <div class="text-center">
            <?= $this->Flash->render() ?>
            <h3>Clcknshop</h3>
            <!--                        <img src="assets/images/logo/logo.png" class="h-6" alt="">-->
        </div>
        <div class="card">
            <?= $this->Form->create(null, ['url'=>['controller' => 'Customers', 'action'=> 'otpLogin'], 'id'=>['login-form']]) ?>
            <div class="card-body p-6">
                <div class="card-title text-center">OTP Login</div>
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your phone number">
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Send OTP</button>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

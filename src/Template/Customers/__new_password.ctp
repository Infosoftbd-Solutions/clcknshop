
<div class="row">
    <div class="col col-login mx-auto">
        <div class="text-center">
            <?= $this->Flash->render() ?>
            <h3>Clcknshop</h3>
            <!--                        <img src="assets/images/logo/logo.png" class="h-6" alt="">-->
        </div>
        <div class="card">
            <?= $this->Form->create(null, ['url'=>['controller' => 'Customers', 'action'=> 'resetPassword'], 'id'=>['login-form']]) ?>
            <div class="card-body p-6">
                <div class="card-title text-center">Reset Password</div>
                <input type="hidden" value="<?= $token ?>" name="token">
                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter New Password">
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Confirm Password">
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

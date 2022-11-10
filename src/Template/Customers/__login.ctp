
<div class="row">
    <div class="col col-login mx-auto">
        <div class="text-center">
            <?= $this->Flash->render() ?>
            <h3>Clcknshop</h3>
            <!--                        <img src="assets/images/logo/logo.png" class="h-6" alt="">-->
        </div>
        <div class="card">
            <?= $this->Form->create(null, ['url'=>['controller' => 'Customers', 'action'=> 'login'], 'id'=>['login-form']]) ?>
            <?= $this->Form->hidden('referer', ['value' => $referer]) ?>
            <div class="card-body p-6">
                <div class="card-title text-center">Login to your account</div>
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="username" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your phone number">
                </div>
                <div class="form-group">
                    <label class="form-label">
                        Password
                        <a href="reset-password" class="float-right small">I forgot password</a>
                    </label>
                    <input type="password" name="password" class="form-control" required id="exampleInputPassword1" placeholder="Enter your password">
                </div>
                <?php //echo $this->TablerForm->control('remember',['type'=>'checkbox','label'=>'Remember me']);  ?>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
        <div class="text-center text-muted">
            Don't have account yet? <a href="<?= $this->Url->build(['action' => 'register']) ?>">Register</a>
        </div>
    </div>
</div>

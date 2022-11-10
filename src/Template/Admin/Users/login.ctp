
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    <div class="text-center">
                        <?= $this->Flash->render() ?>

                     
                    </div>
                    <div class="card">
                        <?= $this->Form->create(null, ['action'=>'login']) ?>
                        <div class="card-body p-6">
                            <div class="card-title text-center"><?= __('Login to your account') ?></div>
                            <div class="form-group">
                                <label class="form-label"><?= __('Email address') ?></label>
                                <input type="email" name="email" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?= __('Enter your email') ?>" >
                            </div>
                            <div class="form-group">
                                <label class="form-label">
                                    <?= __('Password') ?>
                                    <a href="reset-password" class="float-right small"><?= __('I forgot password') ?></a>
                                </label>
                                <input type="password" name="password" class="form-control" required id="exampleInputPassword1" placeholder="<?= __('Enter your password') ?>">
                            </div>
                            <?php //echo $this->TablerForm->control('remember',['type'=>'checkbox','label'=>'Remember me']);  ?>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-block"><?= __('Sign in') ?></button>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                    <!--<div class="text-center text-muted">
                        Don't have account yet? <a href="./register.html">Sign up</a>
                    </div>
                    -->
                </div>
            </div>
        </div>
    

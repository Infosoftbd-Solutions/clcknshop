<?php

use Cake\Core\Configure;

?>
<style>
    .col-register{
        max-width: 35rem;
    }
</style>

<div class="row">
    <div class="col col-register mx-auto">
        <div class="text-center">
            <?= $this->Flash->render() ?>

            <h3><?=Configure::read('App.store_title',"Clcknshop");?></h3>
            <!--                        <img src="assets/images/logo/logo.png" class="h-6" alt="">-->
        </div>
        <div class="card">
            <?= $this->Form->create(null, ['url'=>['controller' => 'Customers', 'action'=> 'register'], 'id'=>['register-form']]) ?>
            <?php //$this->Form->hidden('referer', ['value' => $this->request->referer()]) ?>
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Create new account</h2>
                <div class="row">
                    <?= $this->TablerForm->control('first_name', ['row' => 6, 'required', 'placeholder' => 'First Name']); ?>
                    <?= $this->TablerForm->control('last_name', ['row' => 6, 'required', 'placeholder' => 'Last Name']); ?>
                    <?php //$this->TablerForm->control('username', ['row' => 12, 'required', 'placeholder' => 'Username']); ?>
                    <?php echo $this->TablerForm->control('phone', ['row' => 6, 'required', 'placeholder' => 'Phone Number']); ?>
                    <?= $this->TablerForm->control('email', ['row' => 6, 'required', 'placeholder' => 'you@example.com']); ?>
                    <?= $this->TablerForm->control('password', ['row' => 6, 'required', 'placeholder' => 'Password']); ?>
                    <?= $this->TablerForm->control('confirm_password', ['row' => 6, 'type' => 'password', 'required', 'placeholder' => 'Confirm Password']); ?>

                <div style="width: 100%; padding-left: 15px; padding-right: 15px;">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" required>
                        <span class="form-check-label">Agree the <a href="#" tabindex="-1">terms and policy</a>.</span>
                    </label>

                    <button type="submit" class="btn btn-primary btn-block">Create new account</button>
                </div>

            </div>
            <?= $this->Form->end() ?>
        </div>
        <div class="text-center text-muted" style="padding-bottom: 30px">
            Already have account? <a href="<?= $this->Url->build(['action' => 'login']) ?>">Login</a>
        </div>
    </div>
</div>
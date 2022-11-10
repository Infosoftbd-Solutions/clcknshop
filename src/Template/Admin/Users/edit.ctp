<?php
/**
 * @var AppView $this
 * @var Customer $customer
 */

use App\Model\Entity\Customer;
use App\View\AppView; ?>


<div class="row" id="customer">
    <div class="col-lg-12">


        <div class="categories form large-9 medium-8 columns content">
            <?= $this->Form->create($user, ['class' => 'card']) ?>
            <div class="card-header">
                <h4 class="card-title"><?php echo ucfirst($this->request->action); ?> User</h4>
            </div>
            <div class="card-body">
                <fieldset class="form-fieldset">
                    <h3 class="card-title"><?= __('User Information') ?></h3>
                    <div class="row">
                        <?php
                        echo $this->TablerForm->control('first_name', ['row' => 6, ]);
                        echo $this->TablerForm->control('last_name', ['row' => 6, ]);
                        echo $this->TablerForm->control('email', ['row' => 6, ]);
                        echo $this->TablerForm->control('phone', ['row' => 6, ]);

                        ?>
                    </div>
                </fieldset>

            </div>
            <div class="card-body">
                <fieldset class="form-fieldset">
                    <h3 class="card-title"><?= __('Customer Authentication') ?></h3>
                    <div class="row">
                        <?php
                        echo $this->TablerForm->control('new_password', ['type'=>'password','row' => 6, 'label' => __('New Password'),  'placeholder' => __('Type new password to change old password')]);
                        echo $this->TablerForm->control('con_password', ['type'=>'password','row' => 6, 'label' => __('Confirm Password'), 'placeholder' => __('Type confirm password to change old password')]);
                        echo $this->TablerForm->control('role', ['row' => 6, 'label' => 'User Role', 'options' => [1 => 'Admin', 2 => 'POS']]);
                        echo $this->TablerForm->control('status', ['row' => 6, 'label' => 'Status', 'options' => [1 => __('Active'), 0 => __('Disabled')]]);
                        ?>
                    </div>
                </fieldset>

            </div>

            <div class="card-footer text-right">

                <div class="d-flex">
                    <a href="" class="btn btn-outline-primary"><?= __('Cancel') ?></a>
                    <button type="submit" class="btn btn-primary ml-auto"><?= __('Save User') ?></button>
                </div>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>


<script>

    require(['jquery'], function ($, selectize) {
        $(document).ready(function () {


        });
    });


</script>

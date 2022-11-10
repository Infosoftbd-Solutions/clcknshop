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
            <div class="card-header d-print-none">
                <h3 class="card-title"><?= __('Add New User') ?></h3>
                <div class="card-options">
                    <a href="<?= $this->Url->build(['action' =>  'index']) ?>" class="btn btn-primary" ><?= __('Back') ?></a>
                </div>
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
                    <h3 class="card-title"><?= __('User Authentication') ?></h3>
                    <div class="row">
                        <?php
                        echo $this->TablerForm->control('password', ['row' => 6, 'label' => __('Password')]);
                        echo $this->TablerForm->control('con_password', ['type'=>'password','row' => 6, 'label' => __('Confirm Password')]);
                        echo $this->TablerForm->control('role', ['row' => 6, 'label' => __('User Role'), 'value' => 2, 'options' => [1 => 'Admin', 2 => 'POS']]);
                        echo $this->TablerForm->control('status', ['row' => 6, 'label' => __('Status'), 'value' => 1, 'options' => [1 => __('Active'), 0 => __('Disabled')]]);
                        ?>
                    </div>
                </fieldset>

            </div>

            <div class="card-footer text-right">

                <div class="d-flex">
                    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-primary"><?= __('Cancel') ?></a>
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

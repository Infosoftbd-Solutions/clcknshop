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

        </div>
        <div class="card">
            <?= $this->Form->create(null, ['url'=>['controller' => 'Customers', 'action'=> 'addCustomer'], 'id'=>['register-form']]) ?>
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Create new account</h2>
                <div class="row">
                    <?php
                    echo $this->TablerForm->control('first_name', ['row' => 6, 'required' => true ]);
                    echo $this->TablerForm->control('last_name', ['row' => 6, 'required' => true]);
                    echo $this->TablerForm->control('email', ['row' => 12]);
                    echo $this->TablerForm->control('address', ['row' => 12, 'required' => true]);
                    echo $this->TablerForm->control('area', ['row' => 6, 'required' => true]);
                    echo $this->TablerForm->control('city', ['row' => 6, 'label' => 'City/District/State', 'required' => true]);
                    echo $this->TablerForm->control('post_code', ['row' => 6, 'required' => true ]);
                    echo $this->TablerForm->control('country',['country'=>true, 'row' => 6, 'id' => 'country']);
                    ?>

                    <div style="width: 100%; padding-left: 15px; padding-right: 15px;">
                        <button type="submit" class="btn btn-primary btn-block">Create new account</button>
                    </div>

                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>

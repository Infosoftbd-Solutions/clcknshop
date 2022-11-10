<?php
/**
 * @var AppView $this
 * @var Customer $customer
 */

use App\Model\Entity\Customer;
use App\View\AppView; ?>


<div class="row">
    <div class="col-lg-12">


        <div class="categories form large-9 medium-8 columns content">
            <?= $this->Form->create($customer, ['class' => 'card']) ?>
            <div class="card-header">
                <h4 class="card-title"><?php echo ucfirst($this->request->action); ?> Customer</h4>
            </div>
            <div class="card-body">
                <fieldset class="form-fieldset">
                    <h3 class="card-title">Customer Overview</h3>
                    <div class="row">
                        <?php
                        echo $this->TablerForm->control('first_name', ['row' => 6]);
                        echo $this->TablerForm->control('last_name', ['row' => 6]);
                        echo $this->TablerForm->control('email', ['row' => 6]);
                        echo $this->TablerForm->control('phone', ['row' => 6]);
                        echo $this->TablerForm->control('address', ['row' => 12]);
                        echo $this->TablerForm->control('apartment', ['row' => 6]);
                        //            echo $this->TablerForm->control('city',['row'=>6]);
                        echo $this->TablerForm->control('city', ['bd_district' => true, 'row' => 6, 'label' => 'City/District', 'id' => 'shipping_city', 'required']);
                        echo $this->TablerForm->control('post_code', ['row' => 6]);
                        //            echo $this->TablerForm->control('country',['country'=>true]);
                        echo $this->TablerForm->control('passwd', ['row' => 6]);
                        ?>
                    </div>
                </fieldset>

            </div>


            <div class="card-footer text-right">

                <div class="d-flex">
                    <a href="" class="btn btn-outline-primary">Cancel</a>
                    <button type="submit" class="btn btn-primary ml-auto">Save Customer</button>
                </div>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

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
            <?= $this->Form->create($customer, ['class' => 'card']) ?>
            <div class="card-header">
                <h4 class="card-title"><?php echo ucfirst($this->request->action); ?> <?= __('Customer') ?></h4>
            </div>
            <div class="card-body">
                <fieldset class="form-fieldset">
                    <h3 class="card-title"><?= __('Customer Overview') ?></h3>
                    <div class="row">
                        <?php
                        echo $this->TablerForm->control('first_name', ['row' => 6, ]);
                        echo $this->TablerForm->control('last_name', ['row' => 6, ]);
                        echo $this->TablerForm->control('email', ['row' => 6, ]);
                        echo $this->TablerForm->control('phone', ['row' => 6, ]);
                        echo $this->TablerForm->control('address', ['row' => 12, ]);
                        echo $this->TablerForm->control('area', ['row' => 6]);
                        echo $this->TablerForm->control('city', ['bd_district' => true, 'row' => 6, 'label' => __('City/District/State'), 'id' => 'shipping_city']);
                        echo $this->TablerForm->control('post_code', ['row' => 6, ]);
                        echo $this->TablerForm->control('country',['country'=>true, 'row' => 6, 'id' => 'country']);

                        ?>
                    </div>
                </fieldset>

            </div>
            <div class="card-body">
                <fieldset class="form-fieldset">
                    <h3 class="card-title"><?= __('Customer Authentication') ?></h3>
                    <div class="row">
<?php
      echo $this->TablerForm->control('username', ['row' => 12, 'label' => 'Username']);
      echo $this->TablerForm->control('passwd', ['row' => 12, 'label' => 'Password']);
?>
                    </div>
                </fieldset>

          </div>

            <div class="card-footer text-right">

                <div class="d-flex">
                    <a href="" class="btn btn-outline-primary"><?= __('Cancel') ?></a>
                    <button type="submit" class="btn btn-primary ml-auto"><?= __('Save Customer') ?></button>
                </div>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>


<script>

    require(['jquery'], function ($, selectize) {
        $(document).ready(function () {

            var city        = document.getElementById("shipping_city").outerHTML;
            var inputCity   = '<input type="text" name="city" required="required" class="form-control" maxlength="10" id="shipping_city">';
            console.log(city)



            $("#customer").on('change', '#country', function (e) {
                var country = $(this).val();
                console.log(country)
                if (country == 'BD'){
                    document.getElementById("shipping_city").outerHTML = city;
                }else{
                    document.getElementById("shipping_city").outerHTML = inputCity;
                }

            })
        });
    });


</script>

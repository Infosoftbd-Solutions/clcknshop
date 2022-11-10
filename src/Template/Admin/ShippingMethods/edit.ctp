<div class="row">
    <div class="col-lg-12">

        <div class="categories card form large-9 medium-8 columns content">
            <?= $this->Form->create($shippingMethod) ?>
            <div class="card-header">
                <h4 class="card-title"><?php echo ucfirst($this->request->action);  ?> <?= __('Shipping Method') ?></h4>
            </div>
            <div class="card-body">
                <fieldset class="form-fieldset">
                    <div class="row">
                        <?php
                        echo $this->TablerForm->control('name',['row'=>6,'required','label'=> __('Shipping Method Name')]);
                        echo $this->TablerForm->control('price',['row'=>6,'required']);
                        //echo $this->TablerForm->control('zones',['class'=>'zones','multiple'=>'checkbox','bd_district'=>true,'row'=>12,'label'=>'City/District','id'=>'shipping_city','value'=> explode(',',$shippingMethod->zones)]);

                        echo $this->TablerForm->control('flat_rate', ['type' => 'checkbox', 'row'=>12, 'label' => 'Flat Rate']);
                        echo $this->TablerForm->control('status', ['type' => 'checkbox', 'row'=>12, 'label' => 'Active']);

                        ?>
                    </div>
                </fieldset>

            </div>


            <div class="card-footer text-right">

                <div class="d-flex">
                    <a href="<?php echo $this->Url->build(['action'=>'index']) ?>" class="btn btn-outline-primary"><?= __('Cancel') ?></a>
                    <button type="submit" class="btn btn-primary ml-auto"><?= __('Save Shipping Method') ?></button>
                </div>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script >
  require(['jquery'], function ($, wysibb) {
      $(document).ready(function() {
     //alert("test");
     $('.selectgroup-pills').insertBefore("dfds");
    // $('.zones').prop('checked', true);
   });
  });
</script>

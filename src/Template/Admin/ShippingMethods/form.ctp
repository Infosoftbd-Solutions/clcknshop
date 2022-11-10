<?php echo $this->Form->create($shippingMethod); ?>
    <div class="modal-header">
        <h5 class="modal-title"><?= __('Shipping Method') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <!-- SVG icon code -->
        </button>
    </div>
    <div class="modal-body">
        <fieldset class="form-fieldset">
            <div class="row">
                <?php
                echo $this->TablerForm->control('name',['row'=>12,'required','label'=> __('Shipping Method Name')]);
                echo $this->TablerForm->control('price',['row'=>6,'required']);
                echo $this->TablerForm->control('flat_rate', ['type' => 'checkbox', 'row'=>3, 'label' => __('Flat Rate')]);
                echo $this->TablerForm->control('status', ['type' => 'checkbox', 'row'=>3, 'label' => __('Active')]);
                echo $this->TablerForm->control('zones',['multiple'=>'checkbox','bd_district'=>true,'row'=>12,'label'=> __('City/District'), 'id'=>'shipping_city','value'=> explode(',',$shippingMethod->zones)]);
                
                ?>
            </div>
        </fieldset>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Close') ?></button>
        <button type="submit" class="btn btn-primary" id="billing_save_btn"><?= __('Save') ?></button>
    </div>
<?php echo $this->Form->end(); ?>
<div class="modal fade " id="PaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">
            <?php
            echo $this->Form->create($order->OrderPayments,['url'=>['controller'=>'OrderPayments','action'=>'add'],'id'=>'payment_frm']);
            echo $this->Form->hidden('orders_id',['id'=>'orders_id']);
             ?>

            <div class="modal-header">
              <h5 class="modal-title"><?= __('Process payment for order') ?> # <span id="order_no_span"></span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <!-- SVG icon code -->
              </button>
            </div>
            <div class="modal-body">
              <fieldset class="form-fieldset">
                       <div class="row">

                      <?php

                      echo $this->TablerForm->control('amount',['row'=>6, 'type' => 'number', 'step' => '0.1', 'min' => 1, 'required']);
                      echo $this->TablerForm->control('payment_method',['row'=>6,'required','options'=>$methods]);
                      echo $this->TablerForm->control('payment_date',['row'=>6,'required','value'=>date('Y-m-d h:i:s')]);
                      echo $this->TablerForm->control('Comments',['type'=>'textarea','row'=>12]);
                    ?>
                     </div>
              </fieldset>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Close')?> </button>
                  <button type="submit" class="btn btn-primary" id="customer_form_submit"><?= __('Save changes')?> </button>
            </div>
          <?=$this->Form->end()?>
        </div>
    </div>
</div>
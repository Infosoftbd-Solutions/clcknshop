<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <?= $this->Form->create(null,['action'=>'editField'])?>
            <div class="modal-header">
                <h5 class="modal-title"><?= __('Change Status') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <div class="modal-body">

                <?= $this->TablerForm->control(
                'status',
                ['options'=>$this->Formats->getOrderStatuses(), 'value'=>$order->order_status]
                );
                ?>
                <?= $this->Form->hidden('field',['value'=>'order_status'])?>
                <?= $this->Form->hidden('prev_action',['value'=>$this->getRequest()->action])?>
                <?= $this->Form->hidden('order_id',['value'=>$order->id, 'id'=>'modal_order_id'])?>
                <?= $this->TablerForm->control('notes',['label'=>__('Add Custom Message'),'type' =>'textarea' , 'class'=>['form-control']])?>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-outline-primary"><?= __('Save changes') ?></button>
            </div>

            <?= $this->Form->end()?>
        </div>
    </div>
</div>


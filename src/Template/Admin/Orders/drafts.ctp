<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order[]|\Cake\Collection\CollectionInterface $orders
 */
// backbone with underscore
?>

<?=$this->Html->css('/js/x-editable/bootstrap-editable')?>
<script>
    require.config({
        shim: {
            'xeditable': ['jquery', 'core']
        },
        paths: {
            'xeditable': 'js/x-editable/bootstrap-editable.min'
        }
    });
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<script>

    require.config({
        shim: {
            'flatpickr': ['jquery']
        },
        paths: {
            'flatpickr': 'assets/js/vendors/flatpickr.min'
        }
    });
</script>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-print-none">
                <h3 class="card-title"><?= __('Draft Orders') ?></h3>
                <div class="card-options">
                    <button type="button" class="btn btn-primary"  onclick="document.location='<?=$this->Url->build(['action'=>'add','draft']);?>'"><i class="fe fe-plus mr-2"></i><?= __('Create Draft Order') ?></button>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="DataTables_Table_0_length"><label><?= __('Show') ?> <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> <?= __('entries') ?></label></div>
                        <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<input id="search" type="search" class="" placeholder="" aria-controls="DataTables_Table_0"></label></div>

                        <div id="ajax_response">
                            <?php include_once 'drafts_order_display.ctp' ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

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

                        echo $this->TablerForm->control('amount',['row'=>6,'required']);
                        echo $this->TablerForm->control('payment_method',['row'=>6,'required','options'=>['Cash','Bkash','Bank Transfer']]);
                        echo $this->TablerForm->control('payment_date',['row'=>6,'required','value'=>date('Y-m-d h:i:s')]);
                        echo $this->TablerForm->control('Comments',['type'=>'textarea','row'=>12]);
                        ?>
                    </div>
                </fieldset>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Close') ?></button>
                <button type="submit" class="btn btn-primary" id="customer_form_submit"><?= __('Save changes') ?></button>
            </div>
            <?=$this->Form->end()?>
        </div>
    </div>
</div>



<div class="modal fade " id="RefundModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">
            <?php   echo $this->Form->create($order->OrderPayments,['url'=>['controller'=>'OrderPayments','action'=>'add',"refund"],'id'=>'refund_frm']);
            echo $this->Form->hidden('orders_id',['id'=>'orders_id']);
            ?>

            <div class="modal-header">
                <h5 class="modal-title"><?= __('Process refund for order') ?> # <span id="order_no_span"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- SVG icon code -->
                </button>
            </div>
            <div class="modal-body">
                <fieldset class="form-fieldset">
                    <div class="row">
                        <?php

                        echo $this->TablerForm->control('amount',['row'=>6,'required']);
                        echo $this->TablerForm->control('payment_method',['label'=>__('Refund Method'),'row'=>6,'required','options'=>['Cash','Bkash','Bank Transfer']]);
                        echo $this->TablerForm->control('payment_date',['row'=>6,'required','value'=>date('Y-m-d h:i:s')]);
                        echo $this->TablerForm->control('Comments',['type'=>'textarea','row'=>12]);
                        ?>
                    </div>
                </fieldset>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Close') ?></button>
                <button type="submit" class="btn btn-primary" id="customer_form_submit"><?= __('Save changes') ?></button>
            </div>
            <?=$this->Form->end()?>
        </div>
    </div>
</div>



<script>

    require(['jquery', 'xeditable','flatpickr'], function ($, selectize) {
        $(document).ready(function () {


            $('#search').keyup(function (e) {
                let query = $("#search").val();
                let routeUrl = "<?=$this->Url->build(['action'=>'drafts'])?>/"+query;
                console.log(query.length)
                if(query.length > 2 || query.length ==0) {
                    $.ajax({
                        url: routeUrl,
                        type: 'GET',
                        // dataType: 'json', // added data type
                        success: function (response) {
                            $("#ajax_response").html(response);

                        }
                    });
                }
            });

        });
    });




</script>

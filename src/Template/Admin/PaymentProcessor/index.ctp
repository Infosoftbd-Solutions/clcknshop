
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


<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header d-print-none">
                <h3 class="card-title"><?= __('Payment Processor') ?></h3>
                <div class="card-options">
                    <button data-toggle="modal" data-target="#addPaymentProcessorModal" type="button" class="btn btn-primary"><i class="fe fe-plus mr-2"></i><?= __('Add New Payment Processor') ?></button>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="DataTables_Table_0_length"><label><?= __('Show') ?> <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div id="DataTables_Table_0_filter" class="dataTables_filter"></div>

                        <table cellpadding="0" cellspacing="0" class="table table-hover table-outline table-vcenter text-nowrap card-table">
                            <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('method') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Image') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col" style="text-align: center"><?= __('Action') ?></th>

                            </tr>
                            </thead>
                            <tbody id="ajax_response">
                            <?php foreach ($paymentProcessor as $key => $p_processor): ?>

                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?= $p_processor->name ?>
                                    </td>
                                    <td>
                                        <?= $p_processor->payment_method->name ?>
                                    </td>

                                    <td>
                                        <?= $this->Html->image($p_processor->image, ['height' => '64px']) ?>

                                    </td>

                                    <td>
                                        <?php  echo $this->Html->link($p_processor->staus,"javascript:;;",['class'=>'statuslink','data-value'=>$p_processor->status,'data-pk'=>$p_processor->id]) ?>
                                    </td>
                                    <td class="text-center">
                                        <a class="processor-configure btn icon" data-toggle="modal" data-target="#proccessor_<?= $p_processor->class ?>" href="javascript::void(0)" data-pname="<?= $p_processor->class ?>"  style="cursor: pointer">
                                            <i class="fe fe-settings"></i>
                                        </a>
                                        <a class="processor-edit btn icon" data-pname="<?= $p_processor->class ?>" data-mid="<?= $p_processor->payment_method->id ?>"  data-status="<?= $p_processor->status ?>" style="cursor: pointer"><i class="fe fe-edit"></i></a>

                                        <?= $this->Form->postLink('<i class="fe fe-trash"></i>', ['action' => 'delete', $p_processor->id], ['class'=>"btn btn-sm btn-danger",'escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $p_processor->id)]) ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                        <?=$this->TablerPaginator->links()?>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>


<?php
    foreach ($paymentProcessor as $key => $p_processor):
        $options = array();
        if (isset($p_processor->options) && empty($p_processor->options) == false) {
            $options = json_decode($p_processor->options, true);
            //pr($options);
        }
        $options['instruction_image'] = $p_processor->instruction_image;
?>

<!--Edit customer modal-->
<div class="modal fade" id="proccessor_<?= $p_processor->class ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('Configure {0}', $p_processor->name) ?> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- SVG icon code -->
                </button>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create(null,['url'=> ['controller'=>'paymentProcessor', 'action' => 'configure',$p_processor->id ]])?>
               

                <?php
                    if($this->elementExists("{$p_processor->class}Payment.options"))
                        echo $this->element("{$p_processor->class}Payment.options",['options'=> $options]);
                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Close') ?></button>
                <button type="submit" class="btn btn-primary"><?= __('Save changes') ?></button>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>


<?php endforeach; ?>





<!--Edit customer modal-->
<div class="modal fade" id="addPaymentProcessorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('Add New Payment Processor') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- SVG icon code -->
                </button>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create(null, ['url' => $this->Url->build(['controller'=>'paymentProcessor', 'action' => 'add'])])?>

                <fieldset class="form-fieldset">

                    <div class="form-group px-3">
                        <label for="processor"><?= __('Payment Processor') ?></label>
                        <select name="processor" id="processor" class="form-control">
                            <?php foreach ($processor as $key => $pr): ?><option data-name="<?= $key ?>" value='<?= json_encode($pr) ?>'> <?= $key ?> </option> <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group px-3">
                        <label for="method"><?= __('Payment Method') ?></label>
                        <select name="method" id="method" class="form-control">
                            <?php foreach ($paymentMethods as $method): ?><option value="<?= $method->id ?>"> <?= $method->name ?> </option> <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="form-group px-3">
                        <label for="status"><?= __('Status') ?></label>
                        <select name="status" id="status" class="form-control">
                            <option value="1"><?= __('Active') ?></option>
                            <option value="0"><?= __('Inactive') ?></option>
                        </select>
                    </div>

                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Close') ?></button>
                <button type="submit" class="btn btn-primary"><?= __('Save changes') ?></button>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<script>

    require(['jquery', 'xeditable'], function ($, selectize) {
        $.fn.editable.defaults.ajaxOptions = {type: "GET"};

        $(document).ready(function () {
            $('.statuslink').editable({
                type: 'select',
                url: '<?=$this->Url->build(['action'=>'edit'])?>',
                source: [
                    {value: 0, text: "Inactive"},
                    {value: 1, text: "Active"},
                ]
            });



            $(".processor-edit").click(function(e){
                let pn = $(this).attr('data-pname');
                let mid = $(this).attr('data-mid')
                let status = $(this).attr('data-status')
                $("#method").val(mid);
                $("#status").val(status);


                $("#processor option").filter(function() {
                    return ($(this).attr('data-name') == pn);
                }).prop('selected', true);


                $("#addPaymentProcessorModal").modal();


                console.log()

            });
        });
    });




</script>
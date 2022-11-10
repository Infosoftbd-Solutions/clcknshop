
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
                <h3 class="card-title"><?= __('Payment Method') ?></h3>
                <div class="card-options">
                    <button data-toggle="modal" data-target="#addPaymentMethodModal" type="button" class="btn btn-primary"><i class="fe fe-plus mr-2"></i><?= __('Add New Payment Method') ?></button>
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
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Action') ?></th>
                            </tr>
                            </thead>
                            <tbody id="ajax_response">
                            <?php foreach ($paymentMethods as $key => $method): ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td>
                                        <?= $this->Html->link(empty($method->name)?"Set Payment Method Name" : $method->name,"javascript:;;",['class'=>'namelink','data-pk'=> $method->id]) ?>
                                    </td>
                                    <td>
                                        <?php  echo $this->Html->link($method->staus,"javascript:;;",['class'=>'statuslink','data-value'=>$method->status,'data-pk'=>$method->id]) ?>
                                    </td>

                                    <td>
                                        <?= $this->Form->postLink('<i class="fe fe-trash"></i>', ['action' => 'delete', $method->id], ['class'=>"btn icon",'escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $method->id)]) ?>
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



<!--Edit customer modal-->
<div class="modal fade" id="addPaymentMethodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('Add New Payment Method') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- SVG icon code -->
                </button>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create(null, ['url' => $this->Url->build(['controller'=>'paymentMethods', 'action' => 'add'])])?>
                <fieldset class="form-fieldset">
                        <?= $this->TablerForm->control('name',['row'=>12]) ?>
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
                name: 'status',
                url: '<?=$this->Url->build(['action'=>'edit'])?>',
                source: [
                    {value: 0, text: "Inactive"},
                    {value: 1, text: "Active"},
                ]
            });

            $('.namelink').editable({
                type: 'text',
                name:'name',
                url: '<?=$this->Url->build(['action'=>'edit'])?>',
                title: 'Enter Payment Method Name',
                ajaxOptions: {
                    beforeSend: function(xhr){
                        xhr.setRequestHeader(
                            'X-CSRF-Token',
                            <?= json_encode($this->request->param('_csrfToken')); ?>
                        );
                    }

                }

            });

        });
    });




</script>
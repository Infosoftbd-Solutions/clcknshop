<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header d-print-none">
                <h3 class="card-title"><?= __('Shipping Zone') ?></h3>
                <div class="card-options">
                    <button data-toggle="modal" data-target="#addShippingzoneModal" type="button" class="btn btn-primary"><i class="fe fe-plus mr-2"></i><?= __('Add Shipping Zone') ?></button>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="DataTables_Table_0_length"><label><?= __('Show') ?> <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> <?= __('entries') ?></label></div><div id="DataTables_Table_0_filter" class="dataTables_filter"><label><?= __('Search') ?>:<input type="search" class="" id="search" placeholder="" aria-controls="DataTables_Table_0"></label></div>

                        <table cellpadding="0" cellspacing="0" class="table table-hover table-outline table-vcenter text-nowrap card-table">
                            <thead>
                            <tr>
                                <th width="10%" scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <th  width="40%" scope="col"><?= $this->Paginator->sort('name') ?></th>
                                <th width="40%" scope="col"><?= $this->Paginator->sort('city') ?></th>
                                <th  width="10%" scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                            </thead>
                            <tbody id="ajax_response">
                            <?php include_once 'zone_display.ctp'?>
                            </tbody>
                        </table>

                        <?=$this->TablerPaginator->links()?>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>


<!--Add Shipping zone  modal-->
<div class="modal fade" id="addShippingzoneModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('Shipping Zone') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- SVG icon code -->
                </button>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create(null,['action'=>'add'])?>
                <fieldset class="form-fieldset">
                    <div class="row">
                        <?php
                        echo $this->TablerForm->control('name',['row'=>12]);
                        echo $this->TablerForm->control('city',['bd_district'=>true,'row'=>12,'label'=> __('City/District'),'id'=>'shipping_city','required']);
                        ?>
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

<!--Edit Shipping zone  modal-->
<div class="modal fade" id="editShippingzoneModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('Shipping Zone') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- SVG icon code -->
                </button>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create(null,['action'=>'edit'])?>
                <fieldset class="form-fieldset">
                    <input type="hidden" name="id" value="" id="id">
                    <div class="row">
                        <?php
                        echo $this->TablerForm->control('name',['row'=>12]);
                        echo $this->TablerForm->control('city',['bd_district'=>true,'row'=>12,'label'=> __('City/District'),'id'=>'shipping_city','required']);
                        ?>
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


    require(['jquery'], function ($, selectize) {
        let zones = JSON.parse('<?php echo json_encode($shippingZones); ?>');

        $(document).ready(function () {
            $('.edit').click(function (e) {
                let id = $(this).attr('data-id');
                Array.from(zones).forEach(function (item, index) {
                    if(item.id == id){
                        $("#editShippingzoneModal #id").val(item.id);
                        $("#editShippingzoneModal #name").val(item.name);
                        $("#editShippingzoneModal #shipping_city").val(item.city);
                        $("#editShippingzoneModal").modal();
                    }
                });


                e.preventDefault();
            });


            $('#search').keyup(function (e) {
                let query = $("#search").val();

                let routeUrl = "<?=$this->Url->build(['action'=>'index','search'])?>/"+query;
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

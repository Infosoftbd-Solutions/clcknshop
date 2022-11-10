<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header d-print-none">
                <h3 class="card-title"><?= __('Shipping Method') ?></h3>
                <div class="card-options">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addShippingMethod"><i class="fe fe-plus mr-2"></i><?= __('Add Shipping Method') ?></button>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="DataTables_Table_0_length"><label><?= __('Show') ?> <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div id="DataTables_Table_0_filter" class="dataTables_filter"><label><?= __('Search') ?>:<input type="search" class="" id="search" placeholder="" aria-controls="DataTables_Table_0"></label></div>

                        <table cellpadding="0" cellspacing="0" class="table table-hover table-outline table-vcenter text-nowrap card-table">
                            <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                                <th class="text-center" scope="col"><?= $this->Paginator->sort('flat_rate') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                            </thead>
                            <tbody id="ajax_response">
                            <?php include_once 'shipping_display.ctp'?>
                            </tbody>
                        </table>

                        <?=$this->TablerPaginator->links()?>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>


<div class="modal fade " id="editShippingMethod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">
            <?= $this->Form->create(null,['action'=>'edit']) ?>


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
                            echo $this->Form->hidden('id', ['id' => 'edit-id']);
                            echo $this->TablerForm->control('name',['row'=>12,'required','label'=>'Shipping Method Name', 'id' => 'edit-name']);
                            echo $this->TablerForm->control('price',['row'=>12,'required', 'id' => 'edit-price']);
                            echo $this->TablerForm->control('flat_rate', ['type' => 'checkbox', 'row'=>12, 'label' => 'Flat Rate', 'id' => 'edit-flat-rate']);
                            echo $this->TablerForm->control('status', ['type' => 'checkbox', 'row'=>12, 'label' => 'Active', 'id' => 'edit-status']);
                            ?>
                        </div>
                    </fieldset>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Close') ?></button>
                    <button type="submit" class="btn btn-primary" id="billing_save_btn"><?= __('Save') ?></button>
                </div>
<!--            </form>-->
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>




<div class="modal fade " id="addShippingMethod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">
            <?= $this->Form->create(null,['action'=>'add']) ?>
            <!--            <form id="billing_frm" method="post" action="--><?php //echo $this->Url->build(['action'=> 'add'])?><!--">-->

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
                        echo $this->TablerForm->control('price',['row'=>12,'required']);
                        //echo $this->TablerForm->control('zones',['multiple'=>'checkbox','bd_district'=>true,'row'=>12,'label'=>'City/District','id'=>'shipping_city']);
                        echo $this->TablerForm->control('flat_rate', ['type' => 'checkbox', 'row'=>12, 'label' => __('Flat Rate')]);
                        echo $this->TablerForm->control('status', ['type' => 'checkbox', 'row'=>12, 'label' => __('Active')]);
                        //                            echo $this->TablerForm->control('zones',['row'=>6]);
                        //                            echo $this->TablerForm->control('phone',['row'=>6,'required']);
                        //                            echo $this->TablerForm->control('address',['row'=>6,'required']);
                        //                            echo $this->TablerForm->control('apartment',['row'=>6]);

                        //                            echo $this->TablerForm->control('post_code',['row'=>4]);
                        ?>
                    </div>
                </fieldset>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Close') ?></button>
                <button type="submit" class="btn btn-primary" id="billing_save_btn"><?= __('Save') ?></button>
            </div>
            <!--            </form>-->
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>



<script>


    require(['jquery'], function ($, selectize) {
        $(document).ready(function () {

            $(".btn-edit").click(function (e) {
                e.preventDefault();

                var tr = $(this).closest("tr");

                $("#edit-id").val(tr.attr('data-id'))
                $("#edit-name").val(tr.attr('data-name'))
                $("#edit-price").val(tr.attr('data-price'))

                if (tr.attr('data-flat_rate') == 1){
                    $("#edit-flat-rate").attr("checked", true);
                }

                if (tr.attr('data-status') == 1){
                    $("#edit-status").attr("checked", true);
                }


                $("#editShippingMethod").modal();
                console.log(tr.attr('data-id'));
            })

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

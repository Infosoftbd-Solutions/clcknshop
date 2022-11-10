
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
                    <!--                    <button data-toggle="modal" data-target="#addPaymentMethodModal" type="button" class="btn btn-primary"><i class="fe fe-plus mr-2"></i>Add New Payment Method</button>-->
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">


                        <div class="dataTables_length" id="DataTables_Table_0_length"><label><?= __('Show') ?> <select
                                        name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> <?= __('entries') ?></label>
                        </div>
                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                            <label><?= __('Search') ?>:<input type="search" class="" id="search" placeholder=""
                                                 aria-controls="DataTables_Table_0"></label>
                        </div>

                        <div id="ajax_response">
                            <?php include_once 'ajax.ctp'?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>


<script>

    require(['jquery'], function ($, selectize) {
        $(document).ready(function () {
            $('#search').keyup(function (e) {
                let query = $("#search").val();

                let routeUrl = "<?=$this->Url->build(['action' => 'index', 'search'])?>/" + query;
                console.log(query.length);
                if (query.length > 2 || query.length == 0) {
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

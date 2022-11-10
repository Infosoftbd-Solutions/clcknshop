
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
                <h3 class="card-title"><?= __('Reviews') ?> </h3>
                <div class="card-options">

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
                                </select> <?= __('entries') ?></label></div>
                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                            <label><?= __('Search') ?>:<input type="search" class="" id="search" placeholder=""
                                                 aria-controls="DataTables_Table_0"></label>
                        </div>
                        <div id="ajax_response">
                            <div class="table-responsive-md">
                                <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                                    <thead>
                                    <tr>
                                        <th width="5%" class="text-center w-1"> <i class="fe fe-user"></i></th>
                                        <th width="10"><?= __('Customer') ?></th>
                                        <th width="40%"><?= __('Product') ?></th>
                                        <th width="15%" class="text-center"><?= __('Rating') ?></th>
                                        <th width="10%"><?= __('Review date') ?></th>
                                        <th width="5%" class="text-center"><?= __('Status') ?></th>
                                        <th  width="5%" class="text-center"><?= __('Action') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach($reviews as $review): ?>

                                        <tr>
                                            <td class="text-center">
                                                <span class="avatar avatar-md"><?= substr($review->customer->first_name, 0, 1)?> <?= substr($review->customer->last_name, 0, 1)?></span>
                                            </td>
                                            <td>
                                                <div class="customer-name"><?= $review->customer->first_name . " " .  $review->customer->last_name?></div>
                                                <div class="small text-muted">
                                                    <?= $review->customer->address ?>
                                                </div>
                                            </td>
                                            <td><?= $review->product->title ?></td>
                                            <td>
                                                <div>
                                                    <?php for ($i = 1; $i <= 5; $i++):
                                                        if ($i <= $review->rating): ?>
                                                            <img width="24" src="/assets/images/start-bg.png" alt="">
                                                        <?php else:  ?>
                                                            <img width="24" src="/assets/images/start.png" alt="">
                                                        <?php endif; endfor ?>
                                                </div>
                                            </td>

                                            <td>
                                                <div>
                                                    <?= $review->created ?>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <?php  echo $this->Html->link($review->staus,"javascript:;;",['class'=>'statuslink','data-value'=>$review->status,'data-pk'=>$review->id]) ?>
                                            </td>
                                            <td class="text-center">
                                                <span data-rid="<?= $review->id ?>" data-comment="<?= $review->comment ?>" class="view-comment text-primary btn icon" style="cursor: pointer;"> <i class="fe fe-eye"></i></span>
                                                <?= $this->Form->postLink('<i class="fe fe-trash"></i>', ['action' => 'delete', $review->id], ['class'=>"btn icon",'escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $review->id)]) ?>
                                            </td>
                                        </tr>

                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <?= $this->TablerPaginator->links() ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>















<!--Edit customer modal-->
<div class="modal fade" id="view_review_comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="active_review_customer_name"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- SVG icon code -->
                </button>
            </div>
            <div id="review_modal_content" class="modal-body card-body" style="min-height: 100px">

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
                url: '<?=$this->Url->build(['controller' => 'reviews','action'=>'edit'])?>',
                source: [
                    {value: 0, text: "Inactive"},
                    {value: 1, text: "Active"},
                ]
            });


            $('.view-comment').click(function (e) {
                let customer_name = $(this).closest("tr").find(".customer-name").text();
                let comment = $(this).attr('data-comment');
                console.log(customer_name);

                $("#active_review_customer_name").text(customer_name);
                $("#review_modal_content").text(comment);

                $("#view_review_comment").modal();

            })

        });


    });




</script>

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
                <h3 class="card-title"><?= __('Contacts') ?></h3>
                <div class="card-options">

                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                        <div id="ajax_response">
                            <div class="table-responsive-md">
                                <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                                    <thead>
                                    <tr>
                                        <th style="border-top: none !important;"  width="5%" class="text-center w-1"> <i class="fe fe-user"></i></th>
                                        <th style="border-top: none !important;" width="10"> <?= __('Customer') ?></th>
                                        <th style="border-top: none !important;" width="15%"> <?= __('Phone') ?></th>
                                        <th style="border-top: none !important;" width="15%" > <?= __('Email') ?></th>
                                        <th style="border-top: none !important;" width="40%" > <?= __('Message') ?></th>
                                        <th style="border-top: none !important;" width="10%"> <?= __('Sent At') ?></th>
                                        <!-- <th style="border-top: none !important;" width="5%" class="text-center">Status</th> -->
                                        <th style="border-top: none !important;"  width="5%" class="text-center"><?= __('Action') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach($contacts  as $contact): ?>

                                        <tr>
                                            <td class="text-center">
                                                <span class="avatar avatar-md"><?= substr($contact->name, 0, 1)?></span>
                                            </td>
                                            <td>
                                                <div class="customer-name"><?= $contact->name ?></div>
                                            </td>
                                            <td><?= $contact->phone ?></td>
                                            <td> <?= $contact->email ?></td>
                                            <td> <?= $contact->message ?></td>
                                            <td>
                                                <div>
                                                    <?= $contact->created ?>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span data-rid="<?= $contact->id ?>" data-comment="<?= $contact->message ?>" class="view-comment text-primary btn icon" style="cursor: pointer;"> <i class="fe fe-eye"></i></span>
                                                <?= $this->Form->postLink('<i class="fe fe-trash"></i>', ['action' => 'delete', $contact->id], ['class'=>"btn icon",'escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $contact->id)]) ?>
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
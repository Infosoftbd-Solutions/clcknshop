
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

<div class="card">
    <div class="card-header">
        <div class="card-title">
            <?= $product->title ?>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive-md">
            <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                <thead>
                <tr>
                    <th width="5%" class="text-center w-1"> <i class="fe fe-user"></i></th>
                    <th width="10"><?= __('Customer') ?></th>
                    <th width="15%" class="text-center"><?= __('Rating') ?></th>
                    <th width="40%" class="text-center"><?= __('Comment') ?></th>
                    <th width="10%"><?= __('Review date') ?></th>
                    <th width="5%" class="text-center"><?= __('Status') ?></th>
                    <th  width="5%" class="text-center"><?= __('Action') ?></th>
                </tr>
                </thead>
                <tbody>

                <?php foreach($product->reviews as $review): ?>

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
                            <?php
                            if (strlen($review->comment) <= 64):
                                echo substr($review->comment, 0, 52);
                            else:
                                echo substr($review->comment, 0, 50) ."..";
                            ?>
                                <span data-rid="<?= $review->id ?>" data-comment="<?= $review->comment ?>" class="view-comment text-primary" style="cursor: pointer;"> <?= __('see more') ?></span>
                            <?php endif; ?>
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
                        <?= $this->Form->postLink('<i class="fe fe-trash"></i>', ['controller' => 'reviews', 'action' => 'delete', $review->id], ['class'=>"btn icon",'escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $review->id)]) ?>
                    </td>
                </tr>

                <?php endforeach;?>
                </tbody>
            </table>
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
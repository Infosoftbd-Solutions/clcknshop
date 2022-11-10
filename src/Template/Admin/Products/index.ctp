<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */

?>

<div class="row">
<div class="col-12">

                <div class="card">
                <div class="card-header d-print-none">
              <h3 class="card-title"><?= __('Products') ?></h3>
              <div class="card-options">
               <button type="button" class="btn btn-primary"  onclick="document.location='<?=$this->Url->build(['action'=>'add']);?>'"><i class="fe fe-plus mr-2"></i><?= __('Add Product') ?></button>
              </div>
              </div>


              <div class="card-body">
                  <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                        <div class="dataTables_length" id="DataTables_Table_0_length">
                            <label><?= __('Collection') ?>
                                <select id="filter_by_collection" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="">
                                    <option value="0"><?= __('All') ?></option>
                                    <?php
                                        if (count($collections)):
                                        foreach ($collections as $collection):
                                    ?>
                                            <option value="<?= $collection->id ?>" <?=($collection->id == $c_id)?"selected":""?>><?= $collection->name ?></option>
                                    <?php
                                        endforeach;
                                        endif;
                                    ?>
                                </select>
                            </label>
                        </div>
                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                            <label><?= __('Search') ?>:<input type="search" id="search" class="" placeholder="" aria-controls="DataTables_Table_0"></label>
                        </div>

                        <div id="ajax_response"><?php include_once 'products_display.ctp'?></div>


       </div>

                  </div>
                  </div>
                </div>
</div>
</div>

<div class="modal fade" id="facebookContent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <?= $this->Form->create(null, ['url' => $this->Url->build(['controller' => 'Facebook', 'action' => 'post'])]) ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= __('New Facebook Post') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <textarea rows="12" name="content" class="form-control" id="fbContent"></textarea>
                    </div>
                    <input type="hidden" name="pid" id="pid">
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnPostToFacebook" type="submit" class="btn btn-outline-primary"><?= __("Published") ?></button>
            </div>
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>



<script>

    require(['jquery'], function ($, selectize) {
        $(document).ready(function () {

            $("#filter_by_collection").on('change', function() {
                $("#overlay").fadeIn(300);
                let c_id = $(this).val();
                let url = "<?= $this->Url->build(['controller' => 'products', 'action' => 'index']) ?>/?c_id="+c_id;
                $.ajax({
                    url: url,
                    type: 'GET',
                    // dataType: 'json', // added data type
                    success: function (response) {
                        $("#overlay").fadeOut(300);
                        $("#ajax_response").html(response);
                        console.log(response);
                    }
                });
            });


            $('#search').keyup(function (e) {
                let query = $("#search").val();

                let routeUrl = "<?=$this->Url->build(['action'=>'index'])?>/?q="+query + "&c_id=" + $("#filter_by_collection").val();
                console.log(query.length)
                if(query.length > 2 || query.length ==0) {
                    $("#overlay").fadeIn(300);
                    $.ajax({
                        url: routeUrl,
                        type: 'GET',
                        // dataType: 'json', // added data type
                        success: function (response) {
                            $("#overlay").fadeOut(300);
                            $("#ajax_response").html(response);

                        }
                    });
                }
            });



            $(".postToFacebook").click(function (e) {
                $("#overlay").fadeIn(300);
                let pid = $(this).attr('data-pid');
                let pUrl = '<?= $this->Url->build(['controller'=> 'Products', 'action'=> 'getPostContent']) ?>/'+pid

                $.ajax({
                    url: pUrl,
                    type: 'GET',
                    // dataType: 'json', // added data type
                    success: function (response) {
                        $("#overlay").fadeOut(300);
                        console.log(response);
                        $("#pid").val(pid);
                        $("#fbContent").val(response);
                        $("#facebookContent").modal();

                    }
                });

            });

            $("#btnPostToFacebook").click(function (e) {
                $("#overlay").fadeIn(300);
                $("#facebookContent").modal('hide');
            });

            /*let action  = "<?= $action ? $action : '' ?>";
            if (action.length > 0){
                $("#filter_by_collection").val(action).change();

            }*/

        });
    });




</script>

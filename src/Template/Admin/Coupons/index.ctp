<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $categories
 */
?>

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header d-print-none">
                <h3 class="card-title"><?= __('Coupons') ?></h3>
                <div class="card-options">
                    <button type="button" class="btn btn-primary"  onclick="document.location='<?=$this->Url->build(['action'=>'add']);?>'"><i class="fe fe-plus mr-2"></i><?= __('Add New Coupon') ?></button>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="DataTables_Table_0_length"><label><?=  __('Show') ?> <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> <?= __('entries') ?> </label></div><div id="DataTables_Table_0_filter" class="dataTables_filter"><label><?= __('Search') ?><input type="search" class="" placeholder="" aria-controls="DataTables_Table_0"></label></div>

                        <table cellpadding="0" cellspacing="0" class="table table-hover table-outline table-vcenter text-nowrap card-table">
                            <thead>
                            <tr>

                                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('coupon_code') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('discount') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($coupons as $coupon): ?>
                                <tr>

                                    <td><a href="<?= $this->Url->build(['controller' => 'Coupons', 'action' => 'edit', $coupon->id]) ?>"><?= h($coupon->title) ?></a></td>
                                    <td><a href="<?= $this->Url->build(['controller' => 'Coupons', 'action' => 'edit', $coupon->id]) ?>"><?= h($coupon->coupon_code) ?></a></td>
                                    <td><?= h($coupon->start_date) ?></td>
                                    <td><?= h($coupon->end_date) ?></td>
                                    <td><?= h($coupon->discount_amount) ?> <?php if ($coupon->discount_type) echo "%"?></td>
                                    <td><?= $coupon->status ? "Active" : "Inactive" ?></td>

                                    <td class="actions text-right">
                                        <?=$this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'edit', $coupon->id],['class'=>"btn icon",'escape' => false])?>
                                        <?= $this->Form->postLink('<i class="fe fe-x"></i>', ['action' => 'delete', $coupon->id], ['class'=>"btn icon",'escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $coupon->id)]) ?>
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









<script>

    require(['jquery'], function ($, selectize) {
        $(document).ready(function () {
            formValidate();

            $(".add-product").click(function (e) {
                let c_id = $(this).attr('data-cid');
                let c_name = $(this).attr('data-c_name');
                console.log(c_id);
                $("#c_name").text(c_name);
                $("#collection_id").val(c_id);
                $("#modal_display_product").modal();

            });







            $('#search_product').keyup(function (e) {
                let q = $(this).val();

                let html = '';

                if(q.length >=3) {
                    $.ajax({
                        url: '<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'products']) ?>?q=' + q,
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            let product_list = Array.from(response);
                            product_list.forEach(function (item, index) {
                                html += '<tr class="add_brows_product" data-pid="' + item.id + '" style="cursor: pointer">';
                                html += '<td style="padding:5px  5px !important; width : 40px !important"><img style="width : 32px" src="https://dummyimage.com/30x30/000/fff.png" alt="" class="h-5"></td>';
                                html += '<td>' + item.title + '</td>';
                                html += '</tr>';
                            });
                            $("#ajax_response_products").html(html);
                        }
                    })
                }
            });




            $('#modal_display_product').on('hidden.bs.modal', function(){
                $("#ajax_response_products").html('');
                $("#search_product").val('');
            });

            $(document).on("click", ".add_brows_product", function(event) {
                event.preventDefault();
                let pid = $(this).attr('data-pid');
                let td = (this).querySelectorAll('td');

                if($("#row-"+pid).length == 0){
                    let html = "<tr id='row-"+pid+"'> <input type='hidden' value='"+pid+"' name='products[]'>"+td[0].outerHTML+td[1].outerHTML;
                    html += "<td class='text-right'><a href='javascript:void(0)' data-pid='"+pid+"' class='remove_selected_item'><i class='fe fe-x icon'></i></a></td></tr>";
                    $("#collection_selected_product").append(html);
                    formValidate();
                }
            });

            $(document).on("click", ".remove_selected_item", function(event) {
                event.preventDefault();
                let pid = $(this).attr('data-pid');
                $("#row-"+pid).remove();
                formValidate();
            });


            function formValidate() {
                let row = $("#collection_selected_product tr");
                if (row.length > 0){
                    $("#collection-btn").prop("disabled",false);
                }else{
                    $("#collection-btn").prop("disabled",true);
                }

            }


        });
    });

</script>

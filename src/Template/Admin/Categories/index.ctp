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
              <h3 class="card-title"><?= __('Collections') ?></h3>
              <div class="card-options">
                    <button type="button" class="btn btn-primary"  onclick="document.location='<?=$this->Url->build(['action'=>'add']);?>'"><i class="fe fe-plus mr-2"></i><?= __('Add Collection') ?></button>
              </div>
              </div>
                 
              <div class="card-body">     
               <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div id="DataTables_Table_0_filter" class="dataTables_filter"><label><?= __('Search') ?><input type="search" class="" placeholder="" aria-controls="DataTables_Table_0"></label></div>

                    <table cellpadding="0" cellspacing="0" class="table table-hover table-outline table-vcenter text-nowrap card-table">
        <thead>
            <tr>
               
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
               
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
            <tr>
                <td><a href="<?= $this->Url->build(['controller' => 'products', 'action' => 'index', $category->id]) ?>"><?= h($category->name) ?></a></td>
                <td><?= h($category->slug) ?></td>
                <td><a href="<?= $this->Media->image(COLLECTION_IMAGE_PATH.$category->image, ['path' => true])?>" data-lightbox="collection"><?= $this->Media->image(COLLECTION_IMAGE_PATH.$category->image, ['height' => 40]) ?></a></td>
               
                <td class="actions text-right">
                    <?php if ($category->manual_matching): ?> <a data-cid="<?= $category->id ?>" data-c_name="<?= $category->name ?>" class="icon btn add-product" href="javascript:void(0)"><i class="fe fe-plus-square"></i></a> <?php endif; ?>

                    <?=$this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'edit', $category->id],['class'=>"btn icon",'escape' => false])?>

                    <?= $this->Form->postLink('<i class="fe fe-x"></i>', ['action' => 'delete', $category->id], ['class'=>"btn icon",'escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?>
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




<div class="modal fade " id="modal_display_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document" >
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><?= __('Product List') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="browse_product_form">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" id="search_product" class="form-control" placeholder="<?= __('Search products')?> ">
                            </div>
                        </div>
                        <div class="table-responsive pt-2">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"></div>

                            <table id="product_displa_modal_table" cellpadding="0" cellspacing="0" class="table">

                                <tbody id="ajax_response_products">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-6">
                        <?= $this->Form->create(null, ['controller' => 'categories', 'action' =>'addToCollection' ]) ?>
                        <?= $this->Form->hidden('cid', ['id'=>'collection_id']) ?>
                        <div class="card">
                            <div class="card-header">
                                <h5><?= __('Selected Product for') ?> <span id="c_name"></span> <?= __('collection') ?></h5>
                            </div>
                            <div class="card-body">
                                <table id="product_selected_table" cellpadding="0" cellspacing="0" class="table">
                                    <tbody id="collection_selected_product">

                                    </tbody>
                                </table>

                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" id="collection-btn" class="btn  btn-outline-primary"> <?= __('Save Changes') ?></button>
                            </div>
                        </div>

                        <?= $this->Form->end() ?>
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
                loadPreviousCollectionProducts(c_id);
                products('', 10);
                console.log(c_id);
                $("#c_name").text(c_name);
                $("#collection_id").val(c_id);
                $("#modal_display_product").modal();

            });
            
            
            
            function loadPreviousCollectionProducts(c_id) {
                $("#collection_selected_product").html('');

                var html = '';
                $.ajax({
                    url: '<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'products']) ?>?cid=' + c_id ,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        let product_list = Array.from(response);
                        product_list.forEach(function (item, index) {
                            let html = "<tr id='row-"+item.id+"'> <input type='hidden' value='"+item.id+"' name='products[]'>";
                            html    += '<td><a href="'+ item.image +'" data-lightbox="roadtrip">'
                            html    += '<img style="width : 32px" src="'+ item.thumbnail+'" alt="" class="h-5"></a></td>';
                            html    += '<td>'+item.title+'</td>'
                            html    += "<td class='text-right'><a href='javascript:void(0)' data-pid='"+item.id+"' class='remove_selected_item'><i class='fe fe-x icon'></i></a></td></tr>";
                            $("#collection_selected_product").append(html);
                            formValidate();
                        });
                    }
                })

            }







            $('#search_product').keyup(function (e) {
                let q = $(this).val();
                if(q.length >=3) {
                    products(q);
                }
            });


            function products(q='', limit = 1000) {
                let html = '';
                $.ajax({
                    url: '<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'products']) ?>?q=' + q + '&limit=' + limit,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        let product_list = Array.from(response);
                        product_list.forEach(function (item, index) {
                            html += '<tr class="add_brows_product" data-pid="' + item.id + '" style="cursor: pointer">';
                            html    += '<td><a href="'+ item.image +'" data-lightbox="roadtrip">'
                            html    += '<img style="width : 32px" src="'+ item.thumbnail+'" alt="" class="h-5"></a></td>';
                            html += '<td>' + item.title + '</td>';
                            html += '</tr>';
                        });
                        $("#ajax_response_products").html(html);
                    }
                })
            }



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
                    $("#collection_selected_product").prepend(html);
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

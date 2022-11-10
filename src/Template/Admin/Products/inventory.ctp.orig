<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
?>
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
              <h3 class="card-title">Inventroy</h3>
              <div class="card-options">
               <button type="button" class="btn btn-primary"  onclick="document.location='<?=$this->Url->build(['action'=>'add']);?>'"><i class="fe fe-plus mr-2"></i>Add Product</button>
              </div>
              </div>

              <div class="card-body">
                  <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="DataTables_Table_0"></label></div>

    <table cellpadding="0" cellspacing="0" class="table table-hover table-outline table-vcenter text-nowrap card-table">
        <thead>
            <tr>


                <th></th>
                <th scope="col" class="sorting"><?= $this->Paginator->sort('title',"Product",['style'=>'color:#9aa0ac']) ?></th>

                <th scope="col"><?= $this->Paginator->sort('sku') ?>
                </th>
                <th scope="col"><?= $this->Paginator->sort('sell_w_stock',"When Sold Out") ?></th>

                <th scope="col"><?= $this->Paginator->sort('q_available','Available') ?>
                <th scope="col" class="actions">Edit Quantity Available</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product):
               $has_variant = (count($product->product_variants) > 0)?true:false;
              ?>
            <tr>


                <td style="width:120px"><img src="https://preview.tabler.io/demo/products/apple-macbook-pro.jpg" alt="" class="h-8"></td>

                 <td><?= h($product->title) ?> <br ?> <a class="variant_link" row="row_<?=$product->id?>" href="javascript:;;"><?=sizeof($product->product_variants)?> variatons</a>  </td>
<!--                 <td>--><?php // $sku = $this->Html->link(empty($product->sku)?"Set sku now":$product->sku,"javascript:;;",['class'=>'']);  echo (!$has_variant)?$sku:"";  ?><!--</td>-->
<!--                 <td>--><?php // if(!$has_variant) echo ($product->sell_w_stock==true)?"Don't stop selling":"Stop selling"; ?><!--</td>-->
                <td>
                    <?php if(!$has_variant) echo $this->Html->link(empty($product->sku)?"Set sku now":$product->sku,"javascript:;;",['class'=>'skulink','data-pk'=>"sku_" . $product->id ]) ?>
                </td>
                <td>
                    <?php if(!$has_variant) echo $this->Html->link(($product->sell_w_stock==true)?"Don't stop selling":"Stop selling","javascript:;;",['class'=>'selllink','data-value'=>($product->sell_w_stock)?1:0,'data-pk'=>'sellwstock_'.$product->id]) ?>
                </td>
                 <td class="colavailable"><?=(!$has_variant)?$product->q_available:""?></td>
                 <td class="text-right">
                     <?= $this->Form->create(null,['url'=>['action'=>'updateInventoryQuantity',$product->id]])?>
                     <div class="row">
                     <?php
                        if (!$has_variant){
                            echo $this->TablerForm->control('set',['label'=>false,'options'=>['Add','Set'], 'row'=>3]);
                            echo $this->TablerForm->control('inventory_count',[
                                    'value'=>0,
                                    'row'=>9,
                                    'input-group'=>'<span class="input-group-append"><button type="button" class="btn btn-primary btnsave" class>Save</button></span>',
                                    'label'=>false
                            ]);
                        }
                     ?>
                     </div>

                     <?= $this->Form->end() ?>

                </td>
            </tr>
            <?php  foreach($product->product_variants as $variant):?>

              <tr style="display: none" class="row_<?=$product->id?>">


                  <td ></td>

                   <td><?=implode('/',json_decode($variant->option_values,true)) ?>  </td>
                   <td><?= $this->Html->link(empty($variant->sku)?"Set sku now":$variant->sku,"javascript:;;",['class'=>'skulink','data-pk'=>'sku_'.$product->id. "_" . $variant->id]) ?></td>
                   <td><?=$this->Html->link(($variant->sell_w_stock==true)?"Don't stop selling":"Stop selling","javascript:;;",['class'=>'selllink','data-value'=>($variant->sell_w_stock)?1:0,'data-pk'=>'sellwstock_'.$product->id. "_" . $variant->id ])  ?></td>
                   <td class="colavailable"><?= $variant->q_available ?></td>
                   <td class="text-right">
                    <?=$this->Form->create(null,['url'=>['action'=>'updateInventoryQuantity',$product->id, $variant->id]])?>
                    <div class="row">
                    <div class="col-lg-3">
                        <?=$this->TablerForm->control('set',['label'=>false,'options'=>['Add','Set']])?>
                    </div>
                        <div class="col-lg-9">
                      <?php  echo $this->TablerForm->control('inventory_count',['value'=>0,'input-group'=>'<span class="input-group-append">
                                                <button type="button" class="btn btn-primary btnsave" class>Save</button>
                                                </span>','label'=>false]) ?>
                    </div>
                    </div>
                  <?=$this->Form->end()?>


                  </td>
              </tr>

            <?php endforeach; ?>


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

require(['jquery', 'xeditable'], function ($, selectize) {
            $(document).ready(function () {
                $.fn.editable.defaults.ajaxOptions = {type: "GET"}

              $('.skulink').editable({
                  type: 'text',
<<<<<<< HEAD
                  url: '<?=$this->Url->build(['action'=>'editfield','sku'])?>',
                  title: 'Enter sku',
                  ajaxOptions: {

                    beforeSend: function(xhr){
                        xhr.setRequestHeader(
                            'X-CSRF-Token',
                            <?= json_encode($this->request->param('_csrfToken')); ?>
                        );
                    }


                  }
=======
                  url: '<?=$this->Url->build(['action'=>'updateInventory'])?>',
                  title: 'Enter sku'
>>>>>>> 8f69630b67ad89caae0ab579411347f02134bd67
              });


              $('.selllink').editable({
                  type: 'select',
                  url: '<?=$this->Url->build(['action'=>'updateInventory'])?>',
                  source: [
                        {value: 0, text: "Stop selling"},
                        {value: 1, text: "Don't stop selling"},

                     ]
              });


              $('.variant_link').click(function(){
                 $class = $(this).attr('row');
                 console.log("class name",$class);
                 $('.' + $class).toggle();

              });



               $('.btnsave').click(function(){

                 $this = $(this);
                 $form = $this.closest("form");
                 $td = $this.closest("tr").find(".colavailable");
                 var url = $form.attr('action');
                 console.log("inventory url",url);
                 prev_val = parseInt($td.text());

                 $.ajax({
                        type: "POST",
                        url: url,
                        data: $form.serialize(), // serializes the form's elements.
                        success: function(data)
                        {
                            console.log('Inventroy', data);
                            nval =  prev_val + parseInt($form.find('#inventory-count').val());
                            if($form.find('#set').val() == 1)
                               nval = parseInt($form.find('#inventory-count').val());
                            $td.text(nval);
                            $form.find('#inventory-count').val(0);
                           // alert(data); // show response from the php script.
                        }
                      });


               });

            });

});
</script>

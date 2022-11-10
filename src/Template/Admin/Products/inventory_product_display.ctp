<table cellpadding="0" cellspacing="0" class="table  table-hover table-outline table-vcenter text-nowrap card-table">
    <thead>
        <tr>


            <th></th>
            <th scope="col" class="sorting"><?= $this->Paginator->sort('title',"Product",['style'=>'color:#9aa0ac']) ?>
            </th>

            <th scope="col"><?= $this->Paginator->sort('sku') ?>
            </th>
            <th scope="col"><?= $this->Paginator->sort('sell_w_stock',"When Sold Out") ?></th>

            <th scope="col"><?= $this->Paginator->sort('q_available','Available') ?>
            <th scope="col" class="actions"><?= __('Edit Quantity Available') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product):
        $has_variant = (count($product->product_variants) > 0)?true:false;
        ?>
        <tr>


            <td style="width:120px">
                <?= $this->Media->productImage($product->default_image,$product->id, ['width'=>'42','height'=>'42', 'class'=>'img-thumbnail'])?>
            </td>

            <td><?= $this->Formats->tokenTruncate($product->title, 50) ?> <br ?>
                <?php if(sizeof($product->product_variants) > 0):?><a class="variant_link" row="row_<?=$product->id?>"
                    href="javascript:;;"><?=sizeof($product->product_variants)?> <?= __('variatons') ?></a> <?php endif; ?> </td>
            <td>
                <?php if(!$has_variant) echo $this->Html->link(empty($product->sku)?"Set sku now":$product->sku,"javascript:;;",['class'=>'skulink','data-pk'=>"sku_" . $product->id ]) ?>
            </td>
            <td>
                <?php if(!$has_variant) echo $this->Html->link(($product->sell_w_stock==true)?"Don't stop selling":"Stop selling","javascript:;;",['class'=>'selllink','data-value'=>($product->sell_w_stock)?1:0,'data-pk'=>'sellwstock_'.$product->id]) ?>
            </td>
            <td class="colavailable"><?=(!$has_variant)?$product->q_available:""?></td>
            <td class="text-right">


                <?php  if (!$has_variant): ?>
                <?= $this->Form->create(null,['url'=>['action'=>'updateInventoryQuantity',$product->id]])?>
                <div class="row">
                    <?php
                        echo $this->TablerForm->control('set',['label'=>false, 'options'=>['Add','Set'], 'row'=>['col' => 4, 'class' => 'p-0']]);
                        echo $this->TablerForm->control('inventory_count',[
                            'value'=>0,
                            'row'=>6,
                            'input-group'=>'<span class="input-group-append"><button type="button" class="btn btn-primary btnsave" class>Save</button></span>',
                            'label'=>false
                        ]);
                        ?>
                    <div class="col-lg-1 col-2">
                        <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'inventoryLogs', $product->id]) ?>"
                            class="btn btn-primary mt-2"><?= __('Log') ?></a>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <?php endif; ?>

                <?php if ($has_variant): ?>
                <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'inventoryLogs', $product->id]) ?>"
                    class="btn btn-primary mt-2"><?= __('Log') ?></a>
                <?php endif; ?>
            </td>
        </tr>
        <?php  foreach($product->product_variants as $variant):?>

        <tr style="display: none" class="row_<?=$product->id?>">


            <td></td>

            <td><?=implode('/',json_decode($variant->option_values,true)) ?> </td>
            <td><?= $this->Html->link(empty($variant->sku)?"Set sku now":$variant->sku,"javascript:;;",['class'=>'skulink','data-pk'=>'sku_'.$product->id. "_" . $variant->id]) ?>
            </td>
            <td><?=$this->Html->link(($variant->sell_w_stock==true)?"Don't stop selling":"Stop selling","javascript:;;",['class'=>'selllink','data-value'=>($variant->sell_w_stock)?1:0,'data-pk'=>'sellwstock_'.$product->id. "_" . $variant->id ])  ?>
            </td>
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
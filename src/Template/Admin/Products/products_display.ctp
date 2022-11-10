<table cellpadding="0" cellspacing="0" class="table table-hover table-outline table-vcenter text-nowrap card-table">
    <thead>
    <tr>


        <th width="5%" scope="col" ><?= __('Image') ?></th>
        <th width="50%" scope="col" class="sorting"><?= $this->Paginator->sort('title'," ",['style'=>'color:#9aa0ac']) ?><?= __('TITLE') ?></th>

        <th width="10%" scope="col"><?= $this->Paginator->sort('price') ?></th>
        <th width="15%" scope="col"><?= $this->Paginator->sort('product_type') ?></th>
        <th width="15%" scope="col"><?= $this->Paginator->sort('vendor') ?></th>
        <th width="5%" scope="col" colspan="2" class="text-center"><?= $this->Paginator->sort('Action') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product): ?>
        <tr>

            <td><?= $this->Media->productImage($product->default_image,$product->id, ['width'=>'42','height'=>'42', 'class'=>'img-thumbnail'])?></td>


            <td title="<?=$product->title?>"><a href="<?=$this->Url->build(['action' => 'edit', $product->id])?>"><?= $this->Formats->tokenTruncate($product->title,100) ?>  <?= $product->variant_count ? "( ".$product->variant_count . " variants )" : '' ?> </a></td>
            <td><?= $this->Number->format($product->price) ?></td>
            <td><?= $product->product_type ?>  </td>
            <td><?= $product->vendor ?>  </td>
            <td class="text-right">
                <div class="item-action dropdown">
                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(15px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a href="<?= $this->Url->build(['controller' => 'ProductMedia','action'=>'index',$product->id]) ?>" class="dropdown-item"><i class="dropdown-icon fe fe-image"></i> <?= __('Media/Pictures ') ?></a>
                        <?php if ($product->variants): ?>
                            <a href="<?= $this->Url->build(['controller'=>'products','action'=>'variants',$product->id]) ?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> <?= __('Products variants') ?></a>
                        <?php endif; ?>

                        <?php if ($product->reviews): ?>
                            <a href="<?= $this->Url->build(['controller'=>'products','action'=>'reviews',$product->id]) ?>" class="dropdown-item"><i class="dropdown-icon fa fa-comment-o"></i> <?= __('Products Reviews') ?></a>
                        <?php endif; ?>


                       <!-- <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" data-pid="<?= $product->id?>" class="dropdown-item postToFacebook"><i class="dropdown-icon fe fe-facebook"></i> <?= __('Post To Facebook') ?></a> -->
                    </div>
                </div>
            </td>
            <td class="text-right">
                <?php
                echo $this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'edit', $product->id],['class'=>"icon",'escape' => false]) ?>
                <!--<?php
                // echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)])
                ?> -->


            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?=$this->TablerPaginator->links()?>

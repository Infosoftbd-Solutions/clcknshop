<div class="list-group list-group-transparent mb-0">
           <?=$this->Html->link('<span class="icon mr-3"><i class="fe fe fe-crosshair"></i></span>Product Details',['controller'=>'products','action'=>'edit',$product->id],['class'=>'list-group-item list-group-item-action','escapeTitle' => false])?>
           <?=$this->Html->link('<span class="icon mr-3"><i class="fe fe-image"></i></span>Product Pictures/Media',['controller'=>'ProductMedia','action'=>'index',$product->id,],['class'=>'list-group-item list-group-item-action','escapeTitle' => false])?>
           <?php if ($product->variants > 0): ?>
           <?=$this->Html->link('<span class="icon mr-3"><i class="fe fe-list"></i></span>Product Options/Variants',['controller'=>'products','action'=>'variants',$product->id],['class'=>'list-group-item list-group-item-action','escapeTitle' => false])?>
           <?php endif; ?>
           <?=$this->Html->link('<span class="icon mr-3"><i class="fa fa-houzz"></i></span>Product Inventory Logs',['controller'=>'products','action'=>'inventory-logs',$product->id],['class'=>'list-group-item list-group-item-action','escapeTitle' => false])?>


            <?php if ($product->reviews): ?>
                <?=$this->Html->link('<span class="icon mr-3"><i class="fa fa-comment-o"></i></span>Product Reviews',['controller'=>'products','action'=>'reviews',$product->id],['class'=>'list-group-item list-group-item-action','escapeTitle' => false])?>
            <?php endif; ?>


</div>

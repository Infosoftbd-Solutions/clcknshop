<?php echo $this->Html->css('/js/dropzone/dropzone.min.css'); ?>

<?php echo $this->Html->css('/assets/css/lightbox.min.css'); ?>

<script>
    require.config({
        shim: {
            'dropzonejs': ['jquery']
        },
        paths: {
            'dropzonejs': '/js/dropzone/dropzone.min'
        }
    });
</script>


<script>
    require.config({
        shim: {
            'lightbox': ['jquery']
        },
        paths: {
            'lightbox': 'assets/js/lightbox.min'
        }
    });
</script>
<?php
//pr($product_options);
?>
<div class="row">

<div class="col-lg-3 order-lg-1 mb-4">
<a href="https://github.com/tabler/tabler" class="btn btn-block btn-primary mb-6">
                  <i class="fe fe-list mr-2"></i><?= __('Back to list') ?>
                </a>
<?php echo $this->element('product_sidebar',['product'=>$product]);?>
</div>
<div class="col-lg-3">


<div class="card">
<div class="card-header">
<?=$product->title?> / <?=sizeof($product_variants)?> <?= __('variants') ?>
</div>
<div class="card-body">
<div class="list-group list-group-transparent mb-0">
<?=$this->Html->link('<span class="icon mr-1"><i class="fa fa-plus"></i></span>Add new',['controller'=>'products','action'=>'variants',$product->id,"add"=>1],['class'=>'list-group-item list-group-item-action ' . (isset($_GET['add'])?"active":""),'escape'=>false]); ?>
 <?php  foreach($product_variants as $key=>$variant):   ?>
 <?=$this->Html->link(implode('/',json_decode($variant->option_values,true)),['controller'=>'products','action'=>'variants',$variant->products_id,$variant->id],['class'=>($product_variant->id == $variant->id)?"list-group-item list-group-item-action  active":"list-group-item list-group-item-action " ])?>

<?php endforeach; ?>



</div>

</div>

</div>

</div>


<div class="col-lg-6">
 <?= $this->Form->create($product_variant) ?>
<div class="card">
<div class="card-header">
    <?= __('Options') ?>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-lg-6">

           <?php

           if($product_variant->isNew()){
             $options = [];
           }else{
            $options = json_decode($product_variant->option_values,true);
           }


           foreach($product_options as $key=>$option_values){
                if(isset($this->request->getData()['ProductOPtions'][$key]))
                      $val = $this->request->getData()['ProductOPtions'][$key];
                else if(isset($options[$key]))
                  $val = $options[$key];
                else
                  $val = "";

                $opt = explode(",",$option_values);
                $opt = array_combine($opt,$opt);
                echo $this->TablerForm->input('ProductOPtions.' . $key,['value'=>$val,'options'=>$opt]);
           }

           ?>
        </div>
        <?php if(!isset($_GET['add'])): ?>
        <div class="col-lg-6 justify-content-center d-flex flex-wrap align-items-center " >
            <div class="varient_image"  >
                <span id="variant_image_id">
                <?php
                    $images = array();
                    if(count($variant_images)): foreach ($variant_images as $image):
                        array_push($images, $image->id);
                 ?>
                    <a href="<?=$this->Media->productImage($image->path,$image->product_id,['path'=>true]); //$this->getRequest()->webroot.PRODUCT_IMAGE_PATH.$media->product_id. DS . $media->path ?>" data-lightbox="roadtrip">
                        <?= $this->Media->productImage($image->path,$image->product_id,['height'=>64,'width'=>64, 'class'=>'img-thumbnail','style'=>'max-width:64px; max-height=64px']) ?>
                    </a>
                <?php  endforeach; endif?>
                </span>
                <img class="img-thumbnail " data-vid="<?= $product_variant->id ?>"  data-pid="<?= $product_variant->products_id ?>" id="add_variant_image" src="<?=$this->Url->build('/assets/images/add_image_2.png')?>" width="64px" height="64px" data-toggle="tooltip" data-placement="top" title="<?= __('Click here to add Media') ?>" alt=""  style="cursor: pointer;">
            </div>
            <?=$this->Form->hidden('images_id', ['id'=>'images_id', 'value' => implode(',', $images)])?>
        </div>
      <?php endif; ?>
    </div>



</div>


</div>

<div class="card">
<div class="card-header">
Pricing
</div>
<div class="card-body">
 <div class="row">
         <div class="col-sm-6 col-md-6">
         <?php
            echo $this->TablerForm->control('price',['prepend'=>$this->Formats->moneySymbol(),'placeholder'=>'0.00']);
          ?>

         </div>
          <div class="col-sm-6 col-md-6">

            <?php
               echo $this->TablerForm->control('compare_price',['prepend'=>$this->Formats->moneySymbol(),'placeholder'=>'0.00','help'=>"<p>Use a lower value in price to show reduced price in store.</p><p class='mb-0'><a href='javascript:;;'>Check documentation</a></p>"]);
              ?>
         </div>
          <div class="col-sm-6 col-md-6">
               <?php  echo $this->TablerForm->control('cost',['prepend'=>$this->Formats->moneySymbol(),'placeholder'=>'0.00']);
            ?>
         </div>
          <div class="col-sm-6 col-md-6">

         </div>
         </div>
</div>

</div>

<div class="card">
<div class="card-header">
Inventory
</div>
<div class="card-body">


  <div class="row">
         <div class="col-sm-6 col-md-6">
              <?php
            echo $this->TablerForm->control('sku',['label'=>__('SKU (Stock Keeping Unit)')]);
            ?>
         </div>
           <div class="col-sm-6 col-md-6">
            <?php  echo $this->TablerForm->control('barcode',['label'=>__('Barcode (ISBN, UPC, GTIN, etc.)')]) ?>
         </div>
           <div class="col-sm-6 col-md-6">
            <?php
            echo $this->TablerForm->control('q_available',['label'=>__('Quantity available')]);
            ?>
         </div>
           <div class="col-sm-6 col-md-6">

         </div>


            <div class="col-sm-6 col-md-12">
         <?php
              echo $this->TablerForm->control('track_inventory',['type'=>'checkbox']);
            echo $this->TablerForm->control('sell_w_stock',['type'=>'checkbox','label'=> __('Sell without stock')]);
            ?>
              </div>
            </div>
</div>
</div>


<div class="card">
<div class="card-header">
<?= __('Shipping') ?>
</div>
<div class="card-body">
      <div class="row">
           <div class="col-sm-6 col-md-6">

              <?php

            echo $this->TablerForm->control('is_physical',['type'=>'checkbox','label' => __('This is a physical product') ]);
            echo $this->TablerForm->control('weight',['step'=>'0.01','input-group'=>$this->Form->select('weight_unit',['kg','g','lb','oz'],['class'=>'custom-select']),'help'=>"<p>Used to calculate in shipping.</p><p class='mb-0'><a href='javascript:;;'>Check documentation</a></p>"]);



        ?>


         </div>
          </div>
</div>
</div>


<div class="card">

<div class="card-body text-right">

                  <div class="d-flex">

                    <?php  if(!$product_variant->isNew()) echo $this->Html->link(__('Delete This Option'),['action'=>'delete_variant',$product_variant->products_id,$product_variant->id],['class'=>'btn btn-danger','confirm'=> __('Are you sure you want to delete this variant ? This action is irreversible.')]) ?>
                    <button type="submit" class="btn btn-primary ml-auto">Send data</button>
                  </div>
                </div>

</div>



 <?= $this->Form->end() ?>
</div>


</div>







<!-- Modal -->
<div class="modal fade" id="addVariantImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Choose Variant Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row gutters-sm" id="variant_image_ajax_response">
                    </div>

                    <div id="variant_image_ajax_response_2"></div>
                    <?= $this->Form->create(null,['url'=> ['controller'=>'ProductMedia','action'=>'add'],'type'=>'file', 'id'=>'dzUpload' ,'class'=>['dropzone', 'needsclick', 'dz-clickable']])?>
                    <?= $this->Form->hidden('pid',['value'=>$product_variant->products_id]) ?>
                    <?= $this->Form->hidden('vid',['value'=>$product_variant->id]) ?>
                    <?= $this->Form->end();?>
                </div>
            </div>
            <div class="modal-footer">
                <button id="save_variant_image" data-dismiss="modal" type="button" class="btn btn-outline-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>





<script>


    require(['jquery','lightbox','dropzonejs'], function ($, wysibb) {
        Dropzone.autoDiscover = false;
        var dzUpload = new Dropzone("#dzUpload",{
            headers: {
                "Accept": "*/*"
            }
        });


        dzUpload.on("success",function (file, response) {
            console.log(response);
            $("#variant_image_ajax_response").append(response);


        });



        dzUpload.on("complete", function (file) {
            dzUpload.removeFile(file);
        });

        dzUpload.on("queuecomplete",function (file) {
            // location.reload();
        })



        $("#add_variant_image").click(function (e) {
            let pid = $(this).attr('data-pid');
            let vid = $(this).attr('data-vid');

            let url = '<?= $this->Url->build(['controller'=>'ProductMedia', 'action'=>'getProductMedia'])?>/'+pid+'/'+vid;

            $.ajax({
                url:url,
                type:'GET',
                success:function (response) {
                    $("#variant_image_ajax_response").html(response);
                    $("#addVariantImageModal").modal();
                    console.log(response);
                }
            });
            e.preventDefault();
        });


        $("#save_variant_image").click(function (e) {
            let images_id = '';
            let  image = '';
            $(".imagecheck-input").each(function(){
                if ($(this).prop('checked')==true){
                    images_id += $(this).prop('value')+",";
                    html= $(this)[0].nextElementSibling.innerHTML;
                    image += html.replace('class="imagecheck-image"', 'width="64px" height="64px" class="img-thumbnail"');
                    // console.log($(this)[0].nextElementSibling.innerHTML);
                }
            });
            images_id = images_id.substring(0, images_id.length - 1);
            $("#images_id").val(images_id);

            $("#variant_image_id").html(image);

        });

    });
    </script>

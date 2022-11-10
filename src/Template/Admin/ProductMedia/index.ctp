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


<div class="page-header">
    <h1 class="page-title">
        <?=__("{0} /Gallery", [$product->title]) ?>
    </h1>
    <div class="page-subtitle"><?=__("{0} photos/video", [sizeof($productMedia)]) ?> </div>
    <div class="page-options d-flex">

        <div class="input-icon ml-2">

            <input type="button" data-target="#addYoutubeVideo" data-toggle="modal" class="btn btn-primary" value="Add youtube video" />
        </div>
    </div>
</div>

<div class="row">
  <div class="col-lg-3 order-lg-1 mb-4">
  <a href="<?=$this->Url->build(['controller'=>'products','action'=>'index'])?>" class="btn btn-block btn-primary mb-6">
                    <i class="fe fe-list mr-2"></i><?= __("Back to list") ?>
                  </a>
  <?php echo $this->element('product_sidebar',['product'=>$product]);?>
  </div>
  <div class="col-lg-9">







<?= $this->Form->create(null,['action'=> 'add','type'=>'file', 'id'=>'dzUpload' ,'class'=>['dropzone', 'needsclick', 'dz-clickable']])?>
<?= $this->Form->hidden('pid',['value'=>$pid]) ?>
<?= $this->Form->hidden('vid',['value'=>$vid]) ?>
<?= $this->Form->end();?>




<div class="row row-cards pt-2" id="previewImage">
    <?php foreach ($productMedia as $media):  ?>

    <div class="col-sm-6 col-lg-3">
        <div class="card p-3">
            <?php if ($media->type): ?>
                <label class="custom-control custom-radio" style="position: absolute; left: 20px; top: 15px;">
                    <input type="radio" class="custom-control-input default-image" data-pid="<?= $media->product_id ?>" name="default_image" value="<?= $media->id ?>" <?= $media->default_image ? "checked" : '' ?>>
                    <div class="custom-control-label text-white font-weight-bold"><?= __("Set Default") ?></div>
                </label>
                <a href="<?=$this->Media->productImage($media->path,$media->product_id,['path'=>true]); //$this->getRequest()->webroot.PRODUCT_IMAGE_PATH.$media->product_id. DS . $media->path ?>" data-lightbox="roadtrip">
                    <?= $this->Media->productImage($media->path,$media->product_id,['height'=>250,'width'=>350, 'class'=>'img-round']) ?>
                </a>


            <?php else: echo $this->Media->video($media->path,null,180); endif; ?>

            <div class="d-flex align-items-center pt-3 px-2">
                <div>
                    <div data-mid="<?php echo $media->id?>" class="editable" contenteditable="true"><?php echo $media->caption ? $media->caption : __('Click here to edit caption')?></div>
                </div>
                <div class="ml-auto text-muted">
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $media->id], ['class'=>['icon', 'd-none','d-md-inline-block', 'ml-3'], 'confirm' => __('Are you sure you want to delete # {0}?', $media->id)]) ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <!--
    <div class="col-sm-6 col-lg-4">
        <div class="card p-3">


            <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"width="350" height="245" type="text/html" src="https://www.youtube.com/embed/DBXH9jJRaDk?autoplay=0&fs=0&iv_load_policy=3&showinfo=0&rel=0&cc_load_policy=0&start=0&end=0&origin=https://youtubeembedcode.com">
            </iframe>
            <div class="d-flex align-items-center px-2">

                <div>
                    <div contenteditable="true">Edit image title</div>

                </div>
                <div class="ml-auto text-muted">

                    <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-x mr-1"></i> Delete</a>
                </div>
            </div>
        </div>

    </div>
    -->

</div>

<div class="modal fade " id="addYoutubeVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">
            <?= $this->Form->create(null,['action'=>'add']) ?>
            <!--            <form id="billing_frm" method="post" action="--><?php //echo $this->Url->build(['action'=> 'add'])?><!--">-->

            <div class="modal-header">
                <h5 class="modal-title"><?= __("Add Youtube Video") ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- SVG icon code -->
                </button>
            </div>
            <div class="modal-body">
                <fieldset class="form-fieldset">
                    <?= $this->Form->hidden('pid',['value'=>$pid]) ?>
                    <?= $this->Form->hidden('vid',['value'=>$vid]) ?>
                    <?= $this->Form->hidden('type',['value'=>0]) ?>

                    <div class="row">
                        <?= $this->TablerForm->control('youtube_code', ['type' => 'text', 'row'=>12, 'label' => 'Youtube Video Link']); ?>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __("Close") ?></button>
                <button type="submit" class="btn btn-primary" id="billing_save_btn"><?= __("Save") ?></button>
            </div>
            <!--            </form>-->
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

</div>

</div>



<script>

    require(['jquery','dropzonejs', 'jqtoast'], function ($) {
        Dropzone.autoDiscover = false;
        $(document).ready(function () {
            var dzUpload = new Dropzone("#dzUpload");
            dzUpload.on("success",function (file, response) {

                if (response.status == 'success'){
                    var src = '<?=$this->Url->build(['action'=>'image'])?>/?src='+response.image + '&size=250x180';
                    let html = '<div class="col-sm-6 col-lg-3"><div class="card p-3"><a href="javascript:void(0)" class="mb-3"><img height="180" src="'+ src +'"';
                    html += ' alt="Photo by " class="rounded"></a><div class="d-flex align-items-center px-2"><div><div data-mid="'+response.id+'" class="editable" contenteditable="true">';
                    html += response.caption.length ? response.caption : 'Click here to edit caption';
                    html += '</div></div><div class="ml-auto text-muted"><a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-x mr-1"></i> Delete</a></div></div></div></div>';
                    $("#previewImage").prepend(html);

                    $.toast({
                        heading: 'Success',
                        text: "Product Media uploaded successfully",
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: 'top-right',
                    })


                }else{
                    $.toast({
                        heading: 'error',
                        text: response.errors,
                        showHideTransition: 'slide',
                        icon: 'error',
                        position: 'top-right',
                    })
                }

            });

            dzUpload.on("complete", function (file) {
                dzUpload.removeFile(file);
            });

            dzUpload.on("queuecomplete",function (file) {
                //location.reload();
            });
        });
    });



    require(['jquery','jqtoast','lightbox'], function ($) {
        $(document).ready(function (e) {
            let previous_text = null;
            $('.editable').on('focusin', function() {
                previous_text = $(this)[0].textContent.trim();
            });

            $('.editable').on('focusout', function() {
                // your code here
                let mid = $(this).attr('data-mid');
                let caption = $(this)[0].textContent.trim();
                if(previous_text != caption)
                {
                    let url = '<?php echo $this->Url->build(['action'=>'edit'])?>/'+mid+'/'+caption;
                    $.ajax({
                        type:"GET",
                        url:url,
                        success:function (response) {
                            console.log(response);

                            if(response.status == 'success'){
                                success("Caption updated");
                            }
                        }
                    })
                }

            });

            $(".default-image").change(function (e) {
                let image_id = $(this).val();
                let pid = $(this).attr('data-pid');

                let url = '<?php echo $this->Url->build(['action'=>'setDefault'])?>/'+pid+'/'+image_id;
                $.ajax({
                    type:"GET",
                    url:url,
                    success:function (response) {
                        console.log(response);

                        if(response.status == 'success'){
                            success(response.msg);
                        }else{
                            error(response.msg);
                            console.log(response.data);
                        }
                    }
                })

            });

            function success(msg){
                $.toast({
                    heading: 'Success',
                    text: msg,
                    showHideTransition: 'slide',
                    icon: 'success',
                    position: 'top-right',
                })
            }

            function error(msg){
                $.toast({
                    heading: 'Error',
                    text: msg,
                    showHideTransition: 'slide',
                    icon: 'error',
                    position: 'top-right',
                })
            }
        });
    });

</script>

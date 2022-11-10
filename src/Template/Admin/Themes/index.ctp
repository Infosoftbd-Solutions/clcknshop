<?php echo $this->Html->css('/assets/css/lightbox.min.css'); ?>


<script>
    require.config({
        shim: {
            'jqtoast': ['jquery']
        },
        paths: {
            'jqtoast': 'assets/js/jquery.toast.min'
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
<style type="text/css">

    .fileUpload {
        position: relative;
        overflow: hidden;
        /*margin: 10px;*/
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }

</style>



<div class="row">
    <div class="card">
        <div class="card-header d-print-none">
            <h3 class="card-title"><?= __('All Themes') ?></h3>
            <div class="card-options">
                <div class="install-theme mr-3">
                    <a class="btn btn-primary" href="<?= $this->Url->build(['controller' => 'Themes', 'action' => 'install']) ?>"><i class="fe fe-download-cloud"></i> <?= __('Install Theme') ?></a>
                </div>
                <div class="fileUpload btn btn-primary mb-2">

                    <?= $this->Form->create(null,['type'=>'file', 'url' => ['controller' => 'themes', 'action'=> 'themeUpload']]) ?>
                    <span><i class="fe fe-upload-cloud"></i> <?= __('Add New Theme') ?></span>
                    <input type="file" class="upload" name="file"/>
                    <?= $this->Form->end() ?>

                </div>
            </div>
        </div>
    <div class="card-body">
        <div class="row">
        <?php foreach ($theme_details as $detail):?>
        

            <div class="col-sm-6 col-lg-4">
                <div class="card card-sm">
                    <a data-name="<?= $detail->folder_name ?>" href="#" class="d-block preview_theme"><img src="<?= $this->Url->build($detail->thumbnail) ?>" class="card-img-top"></a>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div><?= $detail->name ?></div>
                                <div class="text-muted"><?= $detail->author ?></div>
                            </div>
                            <div class="ml-auto">
                                <a data-name="<?= $detail->name ?>" target="_blank" href="<?= $detail->preview ?>" class=" btn btn-primary">
                                    <i class="fe fe-eye"></i> <?= __('Preview') ?>
                                </a>
                                <?php if ($detail->folder_name == $theme_name):?>
                                    <a  href="javascript:void(0)" class="ml-3  btn btn-info">
                                        <?= __('Activated') ?>
                                    </a>
                                <?php else: ?>
                                    <a data-name="<?= $detail->folder_name ?>" href="javascript:void(0)" class="active-theme ml-3  btn btn-success">
                                        <i class="fe fe-download"></i> <?= __('Active') ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>

    </div>

</div>



<!-- Modal -->
<div class="modal fade" id="preview_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <a target="_blank" id="preview_image" href="">
                            <img src="" id="thumbnail_image" class="img-thumbnail img-fluid">
                        </a>

                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="20%"><?= __('Name') ?></td>
                                <td id="theme_name"></td>
                            </tr>
                            <tr>
                                <td width="20%"><?= __('Author') ?></td>
                                <td id="theme_author"></td>
                            </tr>
                            <tr>
                                <td width="20%"><?= __('Version') ?></td>
                                <td id="theme_version"></td>
                            </tr>
                            <tr>
                                <td width="20%"><?= __('Description') ?></td>
                                <td id="theme_description"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if ($this->getRequest()->session()->check('theme_errors')){
        pr($this->getRequest()->session()->read('theme_errors'));
        $this->getRequest()->session()->delete('theme_errors');
    }

?>


<?php
//    $thems = json_encode($theme_details);
//    pr($thems);
//
//?>

<script>

    require(['jquery','jqtoast','lightbox'], function ($, selectize) {
        $(document).ready(function () {
            let themes = JSON.parse("<?= addslashes(json_encode($theme_details)) ?>");

            $("input:file").change(function (){
                var fileName = $(this).val();

                if(fileName != ''){
                    var ext = fileName.split('.').pop().toLowerCase();
                    if(jQuery.inArray(ext, ['zip']) == -1)
                    {
                        error("Invalid File Format!");
                        return false;
                    }else{
                        $(this.form).submit();
                    }
                }
            });


            $(".active-theme").click(function (e) {
                $("#overlay").fadeIn(300);
                let name = $(this).attr('data-name');
                let routeUrl = '<?= $this->Url->build(['controller' => 'themes', 'action' => 'activeTheme']) ?>/'+name
                $.ajax({
                    url: routeUrl,
                    type: 'GET',
                    // dataType: 'json', // added data type
                    success: function (response) {
                        if (response.status == 'success'){
                            success("Theme is activated");
                            setTimeout(function (e) {
                                window.location.reload();
                            },2000);
                        }else{
                            error("opps! there was something wrong");
                        }
                    }
                });

            });

            $(".preview_theme").click(function (e) {
                e.preventDefault();
                $("#overlay").fadeIn(300);
                let name = $(this).attr('data-name');
                $.each(themes,function (index, item) {
                    if (item.name.toLowerCase() == name){
                        $("#theme_name, #modal-title").text(item.name);
                        $("#theme_author").text(item.author);
                        $("#theme_version").text(item.version);
                        $("#theme_description").text(item.description);
                        $("#thumbnail_image").attr('src', item.thumbnail);
                        $("#preview_image").attr('href', item.preview);

                        $("#preview_modal").modal();
                        $("#overlay").fadeOut(300);
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

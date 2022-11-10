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



<div class="row">
    <div class="card">
        <div class="card-header d-print-none">
            <h3 class="card-title"><?= __('Choose your favorite theme from our collection') ?></h3>
            <div class="card-options">
            </div>
        </div>
    <div class="card-body">
        <div class="row">
        <?php foreach ($themes as $theme):?>

            <div class="col-sm-6 col-lg-4">
                <div class="card card-sm">
                    <a data-name="<?= $theme['name'] ?>" href="#" class="d-block preview_theme"><img src="<?= $theme['thumbnail'] ?>" class="card-img-top"></a>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div><?= $theme['name'] ?></div>
                                <div class="text-muted"><?= $theme['author'] ?></div>
                            </div>
                            <div class="ml-auto">
                                <?= $this->Form->create(null, ['controller' => 'themes', 'action' => 'install', 'class'=>'form-inline']) ?>
                                <a data-name="<?= $theme['name'] ?>" target="_blank" href="<?= $theme['preview'] ?>" class="btn btn-primary">
                                    <i class="fe fe-eye"></i> <?= __('Preview') ?>
                                </a>
                                <?= $this->Form->hidden('url', ['value'=> $theme['link']]) ?>
                                <?= $this->Form->hidden('name', ['value'=> $theme['name']]) ?>
                                <a data-name="<?= $theme['name'] ?>" href="javascript:void(0)" class="active-theme ml-3  btn btn-success btn-install">
                                    <i class="fe fe-download-cloud"></i> <?= __('Install') ?>
                                </a>
                                <?= $this->Form->end() ?>
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
                        <a id="preview_image" href="" data-lightbox="roadtrip">
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


<script>

    require(['jquery','jqtoast','lightbox'], function ($, selectize) {
        $(document).ready(function () {
            let themes = JSON.parse("<?= addslashes(json_encode($themes)) ?>");


            $(".btn-install").click(function (e) {
                $(this).closest('form').submit();
            });

            $(".preview_theme").click(function (e) {
                $("#overlay").fadeIn(300);
                let name = $(this).attr('data-name');
                $.each(themes,function (index, item) {
                    if (item.name == name){
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

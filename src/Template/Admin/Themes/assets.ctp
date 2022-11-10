<?php echo $this->Html->css("/js/menu-builder/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css") ?>



<script>
    /*require.config({
        shim: {
            'bsbundle': ['jquery']
        },
        paths: {
            'bsbundle': '/js/menu-builder/bootstrap.bundle.min'
        }
    });

    require.config({
        shim: {
            'fontawesome': ['jquery']
        },
        paths: {
            'fontawesome': '/js/menu-builder/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min'
        }
    });

    require.config({
        shim: {
            'iconPicker': ['jquery']
        },
        paths: {
            'iconPicker': '/js/menu-builder/bootstrap-iconpicker/js/bootstrap-iconpicker.min'
        }
    });
    */
    require.config({
        shim: {
            'menueditor': ['jquery','fontawesome','iconPicker','core']
        },
        paths: {
            'menueditor': '/js/menu-builder/jquery-menu-editor',
            'fontawesome': '/js/menu-builder/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min',
            'iconPicker': '/js/menu-builder/bootstrap-iconpicker/js/bootstrap-iconpicker.min'
        }
    });
</script>

<style>
    #images img{
        max-height: 150px !important;
    }
</style>


<div class="page-header justify-content-between">
    <h1 class="page-title">
        Manage Assets
    </h1>
</div>


<?php if (empty($assets) == false && $assets): ?>
<div class="row">
    <div class="col-lg-3">
        <h3 class="card-title"><?= __('Manage Images') ?></h3>
        <p><?= __('Manage your  store images like slider images, flash deal images etc.') ?></p>
    </div>
    <div class="col-lg-9" id="images">
        <div class="card">
            <div class="card-body">
                <?php foreach ($assets->images->image as $image): ?>
                    <?= $this->Form->create(null, ['controller' => 'Themes', 'action' => 'assets','type' => 'file']) ?>
                    <div class="form-group mb-3">
                        <input type="file" name="file" style="display: none">

                        <?= $this->Form->hidden('type', ['value' => 'image']) ?>
                        <?= $this->Form->hidden('key', ['value' => "$image->key"]) ?>
                        <?= $this->Form->hidden('width', ['value' => "$image->width"]) ?>
                        <?= $this->Form->hidden('height', ['value' => "$image->height"]) ?>


                        <label class="form-label"><?= $image->title . " (W-" . $image->width . " * H-" . $image->height . ")" ?></label>
                        <?php if (file_exists($assets_upload . $image->file)) :  ?>
                            <img src="<?= $assets_url . $image->file ?>" alt="" max-height="150">
                        <?php else: ?>
                                <?= $this->Html->image('missing_image.png', ['max-height' => '150']) ?>
                        <?php endif; ?>

                    </div>
                    <?= $this->Form->end(); ?>
                 <?php endforeach; ?>
            </div>

        </div>
    </div>

</div>







<div class="row">
    <div class="col-lg-3">
        <h3 class="card-title"><?= __('Manage Site Menu') ?></h3>
        <p></p>
    </div>

        <div class="col-lg-9">
            <?php foreach ($assets->menus->menu as $menu): ?>
                <div class="card editor" data-editor="editor_<?= $menu->key ?>">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-title"><?= ucfirst($menu->title) ?></div>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" id="addMenuItemBtn_<?= $menu->key ?>" class="btn btn-primary addMenuItemBtn"><?= __('Add Menu Item') ?></button>
                            <button type="button" id="menu-save_<?=$menu->key?>" class="btn btn-primary"><?= __('Save Changes') ?></button>
                        </div>

                    </div>
                    <div class="card-body">
                        <?= $this->Form->create(null,  ['controller' => 'Themes', 'action' => 'assets', 'id' => 'form-menu_'. $menu->key]) ?>
                        <?= $this->Form->hidden('type', ['value' => 'menu']) ?>
                        <?= $this->Form->hidden('key', ['value' => $menu->key]) ?>
                        <?= $this->Form->hidden('items', ['id' => 'menu-items_'.$menu->key]) ?>
                        <?= $this->Form->end() ?>

                        <ul id="menuEditor_<?= $menu->key ?>" class="sortableLists list-group">
                        </ul>
                    </div>
                </div>


            <script>
                require(['jquery',  'menueditor'], function ($, selectize) {
                    $(document).ready(function () {
                        // icon picker options
                        var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
                        // sortable list options
                        var sortableListOptions = {
                            placeholderCss: {'background-color': "#cccccc"}
                        };

                        window["editor_<?= $menu->key ?>"] = new MenuEditor('menuEditor_<?= $menu->key ?>',
                            {
                                listOptions: sortableListOptions,
                                iconPicker: iconPickerOptions,
                                maxLevel: 2 // (Optional) Default is -1 (no level limit)
                                // Valid levels are from [0, 1, 2, 3,...N]
                            });

                        window["editor_<?= $menu->key ?>"].setForm($('#frmEdit'));
                        window["editor_<?= $menu->key ?>"].setUpdateButton($('#btnUpdate'));


                        let arrayjson = JSON.parse('<?= $menu->menujson ?>')
                        window["editor_<?= $menu->key ?>"].setData(arrayjson);

                        $("#menuEditor_<?= $menu->key ?>").on("click", ".btnEdit",function (e) {


                            $("#addMenuItem").attr('data-editor', "editor_<?= $menu->key ?>")
                            $("#addMenuItem").modal();
                            $("#btnAdd").attr('disabled', true);
                        } )


                        $("#menu-save_<?= $menu->key ?>").click(function () {
                            console.log(window["editor_<?= $menu->key ?>"].getString());
                            $("#menu-items_<?= $menu->key ?>").val(window["editor_<?= $menu->key ?>"].getString())
                            $("#form-menu_<?= $menu->key ?>").submit();
                        })

                    });
                });
            </script>

            <?php endforeach; ?>
        </div>
</div>



    <!--Edit customer modal-->
    <div class="modal fade" data-editor="" id="addMenuItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= __('Add Menu Item') ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <!-- SVG icon code -->
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmEdit" class="form-horizontal">
                        <div class="form-group">
                            <label for="text"><?= __('Text') ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control item-menu" name="text" id="text" placeholder="<?= __('Text') ?>">
                                <div class="input-group-append">
                                    <button type="button" id="menuEditor_icon" class="btn btn-outline-secondary"></button>
                                </div>
                            </div>
                            <input type="hidden" name="icon" class="item-menu">
                        </div>
                        <div class="form-group">
                            <label for="href"><?= __('URL') ?></label>
                            <input type="text" class="form-control item-menu" id="href" name="href" placeholder="<?= __('URL') ?>">
                        </div>
                        <div class="form-group">
                            <label for="target"><?= __('Target') ?></label>
                            <select name="target" id="target" class="form-control item-menu">
                                <option value="_self"><?= __('Self') ?></option>
                                <option value="_blank"><?= __('Blank') ?></option>
                                <option value="_top"><?= __('Top') ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title"><?= __('Tooltip') ?></label>
                            <input type="text" name="title" class="form-control item-menu" id="title" placeholder="<?= __('Tooltip') ?>">
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> <?= __('Update') ?></button>
                    <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> <?= __('Add') ?></button>
                </div>
            </div>
        </div>
    </div>



<?php endif; ?>










<script>

    require(['jquery'], function ($) {
        $(document).ready(function () {

            $(".addMenuItemBtn").click(function (e) {
                console.log($(this).closest(".editor").attr('data-editor'));
                $("#btnAdd").attr('disabled', false);
                $("#addMenuItem").attr('data-editor', $(this).closest(".editor").attr('data-editor'))
                $("#addMenuItem").modal();
            });

            //Calling the update method
            $("#btnUpdate").click(function(){
                console.log("update clicked")
                let editor = $("#addMenuItem").attr("data-editor");
                console.log(window[editor]);
                window[editor].update();
                $("#addMenuItem").modal('toggle');
            });
            // Calling the add method
            $('#btnAdd').click(function(){
                console.log("add clicked")

                let editor = $("#addMenuItem").attr("data-editor");
                console.log(window[editor]);
                window[editor].add();
                $("#addMenuItem").modal('toggle');
            });

            $("#images img").click(function(e){
                $(this).closest('.form-group').find('input')[0].click();
            })

            $("#images input[type='file']").change(function(e){
                if (e.target.files.length) {
                    $(this).closest("form").submit();
                }
            })

            $("#addMenuItem").on("hidden.bs.modal", function(){
                console.log('close');

                $("#frmEdit").trigger("reset");
            });

        });
    });



</script>

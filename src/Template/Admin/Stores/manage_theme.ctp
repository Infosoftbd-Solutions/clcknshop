<?php

  function GetDirectorySize($path){
    $bytestotal = 0;
    $path = realpath($path);
    if($path!==false && $path!='' && file_exists($path)){
        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
            $bytestotal += $object->getSize();
        }
    }
    $bytestotal = number_format($bytestotal/1024/1024,2);
    return $bytestotal;
    }

?>
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
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title" style="padding-top: 15px;"><?= __('All Themes') ?></h4>
                    <div class="fileUpload btn btn-primary mb-2">

<?= $this->Form->create(null,['type'=>'file', 'url' => ['action'=> 'themeUpload']]) ?>
<span><i class="fe fe-upload-cloud"></i> <?= __('Add New Theme') ?></span>
<input type="file" class="upload" name="file"/>
<?= $this->Form->end() ?>

</div>

                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th width="" scope="col"><?= __('Name') ?></th>
                            <th scope="col"><?= __('Image') ?></th>
                            <th scope="col"><?= __('Author') ?></th>
                            <th scope="col"><?= __('Version') ?></th>
                            <th scope="col">Size</th>
                            <th scope="col">Status</th>
                            <th><?= __('Action') ?></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($themes as $theme): ?>
                            <tr>
                                <td><?= $theme->name ?>
                                <?php if(!empty($theme->preview)): ?>
                                <a title="Live Preview" href="<?= $theme->preview ?>" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="fe fe-external-link"></i>
                                </a>
                                <?php endif; ?>
                            </td>
                                <td> <img src="<?= (file_exists(THEMES_DIR. $theme->folder_name . '/' .  $theme->thumbnail))? $this->Url->build(THEMES_DIR. $theme->folder_name . '/' .  $theme->thumbnail):'/img/missing_image.png'  ?>" width="150" height="85"> </td>

                                <td><?= $theme->author ?></td>
                                <td><?= $theme->version ?></td>
                                 <td><?= GetDirectorySize(THEMES_DIR . $theme->folder_name) ?> MB</td>
                                <td><span class="badge badge-<?=$theme->active==1?'primary':'danger'?>">
                                    <?= $theme->active==1 ?__('Active'):'Inactive' ?>
                                        
                                    </span></td>

                                <td>
                                   
                                    <a href="<?= $this->Url->build(['controller' => 'stores', 'action' => 'themeEdit', $theme->folder_name]) ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                  
                                   <!-- <?php // $this->Form->postLink('<i class="fa fa-trash"></i>', ['controller' => 'stores', 'action' => 'themeDelete', $theme->folder_name], ['class'=>"btn btn-danger btn-sm",'escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $theme->id)]) ?> -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>

                    

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
 require(['jquery'], function ($) {
   
    $("input:file").change(function (){
              var fileName = $(this).val();

                if(fileName != ''){
                    var ext = fileName.split('.').pop().toLowerCase();
                    if(jQuery.inArray(ext, ['zip']) == -1)
                    {
                        alert("Invalid File Format!");
                        return false;
                    }else{
                        $(this.form).submit();
                    }
                }
            });
 });

</script>

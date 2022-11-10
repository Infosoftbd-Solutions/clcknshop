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

<div class="page-header justify-content-between">
    <h1 class="page-title">
        <?= __('Manage sitemap and Robots.txt') ?>
    </h1>
</div>



<div class="row">
    <div class="col-lg-3">
        <h3 class="card-title"><?= __('Manually upload sitemap and robot.txt file') ?></h3>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">

                <?= $this->Form->create(null, ['controller' => 'SitemapRebot', 'action' => 'upload','type' => 'file']) ?>

                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group mb-3">
                                <label class="form-label"><?= __('Sitemap') ?></label>
                                <input type="file"  accept=".xml"  name="sitemap" class="form-control" style="border: none">
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <?php 
                                $sitemap = (isset($data['sitemap']['name']) && file_exists(UPLOAD. $data['sitemap']['name'])) ? true : false;
                                $robotstxt = (isset($data['robotstxt']['name']) && file_exists(UPLOAD. $data['robotstxt']['name'])) ? true : false;
                            ?>
                            <span class="badge badge-<?= $sitemap ? 'success' : 'danger' ?>"> <?= $sitemap ? 'File Uploaded' : 'File not uploaded' ?> </span>
                            <?php 
                                if($sitemap)
                                    echo $this->Html->link('<i class="fe fe-trash"></i>', ['action' => 'delete', $data['sitemap']['id']], ['class'=>['ml-2 btn btn-sm btn-outline-primary'], 'confirm' => __('Are you sure you want to do this?'),'escape' => false]);
                            ?>
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group mb-3">
                                <label class="form-label"><?= __('Robots.txt') ?></label>
                                <input type="file" name="robotstxt" accept=".txt" class="form-control" style="border: none">
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <span class="badge badge-<?= $robotstxt ? 'success' : 'danger' ?>"> <?= $robotstxt ? 'File Uploaded' : 'File not uploaded' ?> </span>

                            <?php 
                                if($robotstxt)
                                    echo $this->Html->link('<i class="fe fe-trash"></i>', ['action' => 'delete', $data['robotstxt']['id']], ['class'=>['ml-2 btn btn-sm btn-outline-primary'], 'confirm' => __('Are you sure you want to do this?'),'escape' => false]);
                            ?>
                            

                        </div>
                    </div>

                    <div class="form-footer text-right">
                        <button type="submit" class="btn btn-primary"><?=  __('Save Changes') ?></button>
                    </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>




<script>

    require(['jquery'], function ($, selectize) {
        $(document).ready(function () {
            
        });
    });


</script>

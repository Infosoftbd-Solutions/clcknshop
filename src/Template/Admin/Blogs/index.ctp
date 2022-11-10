<?=$this->Html->css('/js/x-editable/bootstrap-editable')?>
<script>
    require.config({
        shim: {
            'xeditable': ['jquery', 'core']
        },
        paths: {
            'xeditable': 'js/x-editable/bootstrap-editable.min'
        }
    });
</script>

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header d-print-none">
                <h3 class="card-title">All Blog Post</h3>
                <div class="card-options">
                    <a href="<?= $this->Url->Build(['controller' => 'Blogs', 'action' => 'add']) ?>" class="btn btn-primary"><i class="fe fe-plus mr-2"></i>Add New Blog</a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                        <div id="ajax_response">
                            <div class="table-responsive-md">
                                <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                                    <thead>
                                        <tr>
                                            <th style="border-top: none !important;" width="15%">Title</th>
                                            <th style="border-top: none !important;" width="15%" >Status</th>
                                            <th style="border-top: none !important;"  width="5%" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($blogs   as $blog): ?>

                                        <tr>
                                            <td><?= $blog->title ?></td>
                                            <td>
                                                <?php if ($blog->published == 1): ?>
                                                    <span class="badge badge-primary">Published</span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger">Draft</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= \Cake\Routing\Router::url('blog/'. $blog->permalink, true) ?>" target="_blank" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                                <a href="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'edit', $blog->id]) ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                                <!--                                <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>-->
                                                <?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $blog->id], ['class'=>"btn btn-danger btn-sm",'escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $blog->id)]) ?>
                                            </td>
                                        </tr>

                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <?= $this->TablerPaginator->links() ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>



<script>

    require(['jquery', 'xeditable'], function ($, selectize) {

        $(document).ready(function () {

        });

    });

</script>

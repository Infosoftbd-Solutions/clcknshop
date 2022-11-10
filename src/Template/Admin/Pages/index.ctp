<?php
/**
 * @var AppView $this
 * @var Customer[]|CollectionInterface $customers
 */

use App\Model\Entity\Customer;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

?>


<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header d-print-none">
                <h3 class="card-title">All Pages</h3>
                <div class="card-options">
                    <button type="button" class="btn btn-primary"
                            onclick="document.location='<?= $this->Url->build(['action' => 'add']); ?>'">
                        <i class="fe fe-plus mr-2"></i>Add A New Page
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                        <div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select
                                        name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries</label></div>
                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                            <label><?= __('Search') ?>:<input type="search" class="" id="search" placeholder=""
                                                 aria-controls="DataTables_Table_0"></label>
                        </div>
                        <div id="ajax_response">
                            <table cellpadding="0" cellspacing="0"
                                   class="table table-hover table-outline table-vcenter text-nowrap card-table">
                                <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($pages as $page): ?>
                                    <tr>
                                        <td width="30%"><?= h($page->name) ?></td>
                                        <td width="30%"><?= h($page->slug) ?></td>
                                        <td class="actions">
                                            <a target="_blank" href="<?= $this->Url->build('/page/'.$page->slug) ?>" class="btn btn-sm btn-outline-primary">view</a>
                                            <?= $this->Html->link(__('edit'), ['action' => 'edit', $page->id], ['class' => 'btn btn-sm btn-outline-info']) ?>
                                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $page->id], ['class' => 'btn btn-sm btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $page->id)]) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>

                            <?= $this->TablerPaginator->links() ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>


<script>

    require(['jquery'], function ($, selectize) {
        $(document).ready(function () {
            $('#search').keyup(function (e) {
                let query = $("#search").val();

                let routeUrl = "<?=$this->Url->build(['action' => 'index', 'search'])?>/" + query;
                console.log(query.length);
                if (query.length > 2 || query.length == 0) {
                    $.ajax({
                        url: routeUrl,
                        type: 'GET',
                        // dataType: 'json', // added data type
                        success: function (response) {
                            $("#ajax_response").html(response);

                        }
                    });
                }
            });
        });
    });

</script>

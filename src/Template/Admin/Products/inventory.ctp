<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
?>
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
              <h3 class="card-title"><?= __('Inventroy') ?></h3>
              <div class="card-options">
               <button type="button" class="btn btn-primary"  onclick="document.location='<?=$this->Url->build(['action'=>'add']);?>'"><i class="fe fe-plus mr-2"></i><?= __('Add Product') ?></button>
              </div>
              </div>

              <div class="card-body">
                  <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> <?= __('entries') ?></label></div><div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<input type="search" id="search" placeholder="" aria-controls="DataTables_Table_0"></label></div>
                        <span id="ajax_response">
                            <?php include_once 'inventory_product_display.ctp'?>
                        </span>

       </div>

                  </div>
                  </div>
                </div>
</div>
</div>

<script>

require(['jquery', 'xeditable'], function ($, selectize) {
            $(document).ready(function () {
                $.fn.editable.defaults.ajaxOptions = {type: "GET"}


                $("#search").keyup(function(e){

                    let keyword = $(this).val();

                    let routeUrl = "<?=$this->Url->build(['action' => 'inventory'])?>/" + keyword;

                    if (keyword.length > 2 || keyword.length == 0) {
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

              $('.skulink').editable({
                  type: 'text',
                  url: '<?=$this->Url->build(['action'=>'editfield','sku'])?>',
                  title: 'Enter sku',
                  ajaxOptions: {
                    beforeSend: function(xhr){
                        xhr.setRequestHeader(
                            'X-CSRF-Token',
                            <?= json_encode($this->request->param('_csrfToken')); ?>
                        );
                    }

                  }

              });


              $('.selllink').editable({
                  type: 'select',
                  url: '<?=$this->Url->build(['action'=>'updateInventory'])?>',
                  source: [
                        {value: 0, text: "Stop selling"},
                        {value: 1, text: "Don't stop selling"},

                     ]
              });


              $('.variant_link').click(function(){
                 $class = $(this).attr('row');
                 console.log("class name",$class);
                 $('.' + $class).toggle();

              });



               $('.btnsave').click(function(){

                 $this = $(this);
                 $form = $this.closest("form");
                 $td = $this.closest("tr").find(".colavailable");
                 var url = $form.attr('action');
                 console.log("inventory url",url);
                 prev_val = parseInt($td.text());

                 $.ajax({
                        type: "POST",
                        url: url,
                        data: $form.serialize(), // serializes the form's elements.
                        success: function(data)
                        {
                            console.log('Inventroy', data);
                            nval =  prev_val + parseInt($form.find('#inventory-count').val());
                            if($form.find('#set').val() == 1)
                               nval = parseInt($form.find('#inventory-count').val());
                            $td.text(nval);
                            $form.find('#inventory-count').val(0);
                           // alert(data); // show response from the php script.
                        }
                      });
               });

            });

});
</script>

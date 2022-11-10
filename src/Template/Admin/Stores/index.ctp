<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title" style="padding-top: 15px;"><?= __('All Stores') ?></h4>
                    <div>

                        <div class="input-group mb-3">
                            <input type="text" id="search" class="form-control" placeholder="<?= __('store name or email') ?>" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">
                                <i class="fe fe-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" id="ajax_response">
                    <?php include_once 'ajax_store.ctp'?>
                </div>
            </div>
        </div>
    </div>
</div>

<button style="display: none" type="button" class="btn btn-primary" id="add_balance_btn_modal" data-bs-toggle="modal" data-bs-target="#add_balance_modal"></button>
<div class="modal fade" id="add_balance_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_balance_modal_title"><?= __('Add SMS Balance') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create(null, ['controller' => 'Stores', 'action' => 'addBalance']) ?>
                    <div class="input-group mb-3">
                        <?= $this->Form->hidden('id', ['id' => 'store_id']) ?>
                        <input type="text" class="form-control float" placeholder="<?= __('Enter Amount') ?>" id="amount" name="amount" required>
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><?= __('Add Balance') ?></button>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>


  <script>
require(['jquery'], function ($, selectize) {
  $(function() {

    $("#search").keyup(function (e) {
        let input = $(this).val().trim();

        if(input.length >= 3){
            $.ajax({
                url: '<?=$this->Url->build(['controller'=>'Stores','action'=>'index', 'garbage'])?>/' + input,
                type: 'get',
                // dataType: 'json',
                success: function(data) {
                    // ... do something with the data...
                    $("#ajax_response").html(data);
                    // console.log(data);
                }
            });
        }

    });

    $('input.float').on('input', function() {
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
    });

    $("#ajax_response").on("click", ".sms-balance", function(){
       
        let store_name = $(this).attr('data-sname');
        let store_id = $(this).attr('data-sid');

        $("#add_balance_modal_title").text(store_name + " - Add SMS Balance");
        $("#store_id").val(store_id);

        $("#add_balance_btn_modal").click();
    });
    });
});
</script>






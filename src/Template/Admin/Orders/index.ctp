<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order[]|\Cake\Collection\CollectionInterface $orders
 */
// backbone with underscore
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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

  require.config({
      shim: {
          'flatpickr': ['jquery']
      },
      paths: {
          'flatpickr': 'assets/js/vendors/flatpickr.min'
      }
  });

</script>


<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-header d-print-none">
            <h3 class="card-title"><?= __('Orders') ?></h3>
            <div class="card-options">
                <button type="button" class="btn btn-primary"  onclick="document.location='<?=$this->Url->build(['action'=>'add']);?>'"><i class="fe fe-plus mr-2"></i><?= __('Create Order') ?></button>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 pb-5">
                   <form method="get" action="<?= $this->Url->build(['action' => 'index']) ?>">
                    <div class="filter-action pr-3">

                        <div class="input-group">
                            <div class="form-group mr-3">
                                <label for="order_status" class="form-label"><?= __('Order Status') ?></label>
                                <?= $this->Form->select('order_status', $this->Formats->getOrderStatuses(), ['class' => 'form-control', 'empty' =>"All"]) ?>

                            </div>

                            <div class="form-group mr-3">
                                <label for="order_id" class="form-label"><?= __('Order ID') ?></label>
                                <input type="text" placeholder="<?= __('Order ID') ?>" class="form-control" name="order_id" id="order_id">
                            </div>

                            <div class="form-group mr-3">
                                <label for="customer_name" class="form-label"><?= __('Customer Name/Phone') ?></label>
                                <input type="text" placeholder="<?= __('Customer name') ?>" class="form-control" name="customer" id="customer_name">
                            </div>

                            <div class="form-group mr-3">
                                <label class="form-label"><?= __('Select Date Range') ?></label>
                                <div class="input-icon d-inline-block">
                                    <input name="date_range" type="text" value="" class="form-control flatpickr-input calendar-range" placeholder="<?= __('Select a date') ?>" readonly="readonly">
                                    <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                        <line x1="16" y1="3" x2="16" y2="7"></line>
                                        <line x1="8" y1="3" x2="8" y2="7"></line>
                                        <line x1="4" y1="11" x2="20" y2="11"></line>
                                        <line x1="11" y1="15" x2="12" y2="15"></line>
                                        <line x1="12" y1="15" x2="12" y2="18"></line>
                                    </svg>
                                </span>
                                </div>
                            </div>

                            <div class="input-group-append">
                                <div class="form-group">
                                    <label class="form-label">	&nbsp;</label>
                                    <button type="submit" id="search" value="order_filter" name="search" class="btn btn-primary"><i class="fe fe-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                   </form>
                </div>
            </div>

            <div class="table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                    <div id="ajax_response">
                        <?php include_once 'order_display.ctp' ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade " id="PaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document" >
  <div class="modal-content">
    <?php
    echo $this->Form->create($order->OrderPayments,['url'=>['controller'=>'OrderPayments','action'=>'add'],'id'=>'payment_frm']);
    echo $this->Form->hidden('orders_id',['id'=>'orders_id']);
     ?>

    <div class="modal-header">
      <h5 class="modal-title"><?= __('Process payment for order') ?> # <span id="order_no_span"></span></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <!-- SVG icon code -->
      </button>
    </div>
    <div class="modal-body">
      <fieldset class="form-fieldset">
               <div class="row">

              <?php

              echo $this->TablerForm->control('amount',['row'=>6, 'type' => 'number', 'step' => '0.1', 'min' => 1, 'required']);
              echo $this->TablerForm->control('payment_method',['row'=>6,'required','options'=>$methods]);
              echo $this->TablerForm->control('payment_date',['row'=>6,'required','value'=>date('Y-m-d h:i:s')]);
              echo $this->TablerForm->control('Comments',['type'=>'textarea','row'=>12]);
            ?>
             </div>
      </fieldset>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Close')?> </button>
          <button type="submit" class="btn btn-primary" id="customer_form_submit"><?= __('Save changes')?> </button>
    </div>
  <?=$this->Form->end()?>
</div>
</div>
</div>


<div class="modal fade " id="PaymentLogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" >
          <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title"><?= __('Payment Log') ?> # <span id="order_payment_log_title"></span></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- SVG icon code -->
                  </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                            <thead>
                                <tr>
                                    <th><?= __('Method') ?></th>
                                    <th><?= __('Amount') ?></th>
                                    <th><?= __('Payment Date') ?></th>
                                </tr>
                            </thead>
                            <tbody id="payment_log_response">

                            </tbody>
                        </table>
                    </div>
                </div>
          </div>
    </div>
</div>



<div class="modal fade " id="RefundModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document" >
  <div class="modal-content">
      <?php   echo $this->Form->create($order->OrderPayments,['url'=>['controller'=>'OrderPayments','action'=>'add',"refund"],'id'=>'refund_frm']);
        echo $this->Form->hidden('orders_id',['id'=>'orders_id']);
       ?>

    <div class="modal-header">
      <h5 class="modal-title"><?= __('Process refund for order') ?> # <span id="order_no_span"></span></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <!-- SVG icon code -->
      </button>
    </div>
    <div class="modal-body">
      <fieldset class="form-fieldset">
               <div class="row">
              <?php

              echo $this->TablerForm->control('amount',['row'=>6, 'type' => 'number', 'step' => '0.1', 'min' => 1, 'required']);
              echo $this->TablerForm->control('payment_method',['label'=>__('Refund Method'),'row'=>6,'required','options'=>$methods]);
              echo $this->TablerForm->control('payment_date',['row'=>6,'required', 'id' => 'refund-date', 'value'=>date('Y-m-d h:i:s')]);
              echo $this->TablerForm->control('Comments',['type'=>'textarea','row'=>12]);
            ?>
             </div>
      </fieldset>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Close') ?></button>
          <button type="submit" class="btn btn-primary" id="customer_form_submit"><?= __('Save changes') ?></button>
    </div>
    <?=$this->Form->end()?>
</div>
</div>
</div>

<?php include_once 'status_modal.ctp'?>


<script>

require(['jquery', 'xeditable','flatpickr'], function ($, selectize) {
            $(document).ready(function () {
                
                $(".calendar-range").flatpickr({
                    mode: "range",
                    // dateFormat: "d-m-Y",
                    // defaultDate: null
                })

                $(".order_payment_log").click(function (e){
                    $("#overlay").fadeIn(300);
                    var id = $(this).attr('data-id');
                    var order_id = $(this).attr('data-order-id');
                    $("#order_payment_log_title").text(order_id);
                    $.ajax({
                        url: "<?= $this->Url->build(['controller' => 'orders', 'action' => 'paymentLog']) ?>/"+id,
                        type: 'GET',
                        // dataType: 'json', // added data type
                        success: function (response) {
                            $("#payment_log_response").html(response);
                            $("#overlay").fadeOut(300);
                            $("#PaymentLogModal").modal();
                        }
                    });



                })

                $('#statusModal').on('hidden.bs.modal', function(){
                    $(this).find('form')[0].reset();
                });
              var order_statuses = JSON.parse('<?=json_encode($this->Formats->getOrderStatuses(true))?>');
              // console.log(order_statuses);

              // $('#ajax_response').editable({
              $('.order_status').click(function (e) {
                    $("#status").val($(this).attr('data-sid'));
                    $("#modal_order_id").val($(this).attr('data-oid'));



                  $("#statusModal").modal();
                  e.preventDefault();
              });



                //$('.statuslink').editable({
                //    type: 'select',
                //    url: '<?//=$this->Url->build(['action'=>'editField','sell_w_stock'])?>//',
                //    source: order_statuses
                //    ajaxOptions: {
                //        beforeSend: function(xhr){
                //            xhr.setRequestHeader(
                //                'X-CSRF-Token',
                //                <?//= json_encode($this->request->param('_csrfToken')); ?>
                //            );
                //        }
                //    }
                //});


              $('#payment-date').flatpickr({
                enableTime: true,
              });

              $('#refund-date').flatpickr();


              $('#PaymentModal').on('show.bs.modal', function (event) {
                  console.log(event.relatedTarget);
                  $('#payment_frm')[0].reset();
                  $('#payment_frm #order_no_span').html($(event.relatedTarget).attr('data-order-id'));
                  $('#payment_frm #orders_id').val($(event.relatedTarget).attr('data-id'));
                  $('#payment_frm #amount').val($(event.relatedTarget).attr('data-due'));

              });

              $('#RefundModal').on('show.bs.modal', function (event) {
                  console.log(event.relatedTarget);
                  $('#refund_frm')[0].reset();
                  $('#refund_frm #order_no_span').html($(event.relatedTarget).attr('data-id'));
                  $('#refund_frm #orders_id').val($(event.relatedTarget).attr('data-id'));
                  $('#refund_frm #amount').val($(event.relatedTarget).attr('data-paid'));

              });

              $('#search').keyup(function (e) {
                let query = $("#search").val();
                let routeUrl = "<?=$this->Url->build(['action'=>'index','search'])?>/"+query;
                  console.log(query.length)
                  if(query.length > 2 || query.length ==0) {
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



              $("#payment_frm").submit(function(e) {

                var frm = this;
                var valid = ($(this).find("input.is-invalid").length === 0);
                if (!valid) {
                   return false;
                }

                  e.preventDefault(); // avoid to execute the actual submit of the form.

                  var form = $(this);
                  var url = form.attr('action');

                  $.ajax({
                         type: "POST",
                         url: url,
                         data: form.serialize(), // serializes the form's elements.
                         success: function(data)
                         {
                            location.reload();

                            // if(data.hasOwnProperty("error")){
                            //     console.log(data.error);
                            //     $.each( data.error, function( key, value ) {
                            //       //alert( key + ": " + value );
                            //       $(frm).find('input[name ="'  + key  +  '"]').addClass("is-invalid");
                            //       $(frm).find('input[name ="'  + key  +  '"]').after('<div style="display: inline-block;" class="invalid-feedback has-error-email">' +  value[Object.keys(value)[0]] + '</div>');

                            //     });

                            // }else{
                            //     var customer = data.data;
                            //     setCustomer(customer,customer,{});
                            //     $("#customerAddressModal").modal('hide');
                            //     location.reload();   

                            // }

                         }
                 });


              });

            



              $("#refund_frm").submit(function(e) {

                var frm = this;
                var valid = ($(this).find("input.is-invalid").length === 0);
                if (!valid) {
                   return false;
                }

                  e.preventDefault(); // avoid to execute the actual submit of the form.

                  var form = $(this);
                  var url = form.attr('action');

                  $.ajax({
                         type: "POST",
                         url: url,
                         data: form.serialize(), // serializes the form's elements.
                         success: function(data)
                         {
                            location.reload();

                            // if(data.hasOwnProperty("error")){
                            //     console.log(data.error);
                            //     $.each( data.error, function( key, value ) {
                            //       //alert( key + ": " + value );
                            //       $(frm).find('input[name ="'  + key  +  '"]').addClass("is-invalid");
                            //       $(frm).find('input[name ="'  + key  +  '"]').after('<div style="display: inline-block;" class="invalid-feedback has-error-email">' +  value[Object.keys(value)[0]] + '</div>');

                            //     });

                            // }else{
                            //     var customer = data.data;
                            //     setCustomer(customer,customer,{});
                            //     $("#customerAddressModal").modal('hide');
                            //     location.reload();

                            // }

                         }
                 });


              });

    });
});




</script>


<script>
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
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="padding-top: 15px;"><?= __('Edit Store') ?></h4>
                
            </div>
            <div class="card-body">
                

                <?= $this->Form->create($store) ?>
                <div class="mb-3">
                    <?php echo $this->Form->control('store_name', ['disabled'=>'disabled','class' => 'form-control']); ?>
                </div>
               
                <div class="mb-3">
                    <?php echo $this->Form->control('domain_name', ['class' => 'form-control']); ?>
                </div>
                
               <div class="mb-3">
                    <?php echo $this->Form->control('customers_id', ['label'=>'Customer','options'=>$customers,'class' => 'form-control']); ?>
                </div>
                <div class="mb-3">
                    <?php echo $this->Form->control('expire_date', ['type'=>'text','class' => 'form-control']); ?>
                </div>
                <div class="mb-3">
                    <?php echo $this->Form->control('disabled', ['label'=>'Status','options'=>['Active','Disabled'],'class' => 'form-control']); ?>
                </div>
             



                <div class="mb-4 mt-3">
                    <input type="submit" value="Save Store" class="btn btn-primary">
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>




  <script>
require(['jquery','flatpickr','selectize'], function ($) {
  $(function() {
  
        $(document).ready(function () {
            $("#expire-date").flatpickr({
                dateFormat: "Y-m-d",
                defaultDate: new Date().fp_incr(30)
            });

       
        });

        $('#domain-name').selectize({
          delimiter: ' ',
          persist: false,
          create: function(input) {
            return {
              value: input,
              text: input
            }
          }
        });
    
 });

 });
</script>


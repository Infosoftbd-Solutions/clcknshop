<div class="row">

<div class="col-lg-3 order-lg-1 mb-4">
<a href="https://github.com/tabler/tabler" class="btn btn-block btn-primary mb-6">
                  <i class="fe fe-list mr-2"></i><?= __('Back to list') ?>
                </a>
<div class="list-group list-group-transparent mb-0">
                  <a href="../docs/alerts.html" class="list-group-item list-group-item-action active"><span class="icon mr-3"><i class="fe fe-alert-triangle"></i></span><?= __('Product Details') ?></a>
                  <a href="../docs/alerts.html" class="list-group-item list-group-item-action"><span class="icon mr-3"><i class="fe fe-alert-triangle"></i></span><?= __('Product Pictures/Media') ?></a>
                  <a href="../docs/avatars.html" class="list-group-item list-group-item-action"><span class="icon mr-3"><i class="fe fe-user"></i></span><?= __('Product Options/Variants') ?></a>
                  <a href="../docs/buttons.html" class="list-group-item list-group-item-action"><span class="icon mr-3"><i class="fe fe-plus-square"></i></span><?= __('Product Variants') ?></a>
                  <a href="../docs/colors.html" class="list-group-item list-group-item-action"><span class="icon mr-3"><i class="fe fe-feather"></i></span><?= __('Product Inventory') ?></a>
</div>
</div>
<div class="col-lg-9">

   <div class="card">
 <div class="card-header">
                  <h4 class="card-title"><?= __('Product Options') ?></h4>
    </div>
    <div class="card-body">
  
    <div class="row" id="optionhtml">
    
    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                        <label class="form-label"><?= __('Option') ?></label>
                    
                        <?php echo $this->Form->select('option1',['Color','Size','Feature'],['empty'=>true,'class'=>'form-control custom-select','placeholder'=> __("Size,Color,Feature etc")]); ?>
                      </div>
    </div>
    <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">&nbsp;</label>
                        <?php echo $this->Form->text('optionvalues1',['class'=>'form-control','placeholder'=>"S,L,XL etc"]); ?>
                      </div>
    </div>
    <div class="col-sm-6 col-md-3">
    </div>
    </div>  
  
    </div>
    <div class="card-footer text-left">
                  <button type="button" class="btn btn-primary" id="addoptionbtn"><?= __('Add another option') ?></button>
                  <button type="submit" class="btn btn-primary" id="addoptionbtn"><?= __('Update option pricing') ?></button>
                </div>
   </div>
</div>
</div> 

 <script>
                require(['jquery', 'selectize'], function ($, selectize) {
                    $(document).ready(function () {
                      
                      optionhtml = $('#optionhtml').clone(true, true);
                        $('#addoptionbtn').click(function(){
                            $('#optionhtml').append(  optionhtml.html().replace("optionvalues1","optionvalues2").replace("option1","option2"));
                            // $('.input-options').not('.selectized').val("test");
                             $('input[name = "optionvalues2"]').selectize({
                            delimiter: ',',
                            persist: false,
                            create: function (input) {
                                return {
                                    value: input,
                                    text: input
                                }
                            }
                            });  
                             $('select[name = "option2"]').selectize({
                            create: true,
                            sortField: 'text'
                        });                         
                        });
                        
                        
                       $('select[name = "option1"]').selectize({
                            create: true,
                            sortField: 'text'
                        });   
                        $('input[name = "optionvalues1"]').selectize({
                            delimiter: ',',
                            persist: false,
                            create: function (input) {
                                return {
                                    value: input,
                                    text: input
                                }
                            }
                        });   
                        
                  });  
                 }); 
</script>                                     
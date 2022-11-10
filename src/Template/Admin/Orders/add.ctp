<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<?php
//    pr($order->order_products);
?>
<script>
require.config({
    shim: {
        'autocomplete': ['jquery', 'bootstrap']
    },
    paths: {
        'autocomplete': 'assets/js/vendors/bootstrap-autocomplete.min'
    }
});

/*require.config({
  shim: {
      'btvalidator': ['jquery', 'bootstrap']
  },
  paths: {
      'btvalidator': 'assets/js/vendors/bootstrap-validate'
  }
});*/
</script>

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

<div class="d-flex">
    <h3>
        <?php
    if(isset($type) && $type =='draft') echo __("Create new Draft Order");
    else if($order->isEmpty('id')) echo __("Create New Order");
    else echo __("Edit order #{0}", [$order->order_id]) ;
    ?>
    </h3>
    <button type="submit" class="btn btn-primary ml-auto" id="btnordersubmit"><?= __('Save Changes') ?></button>
</div>
<br />
<div class="row">

    <div class="col-lg-3 order-lg-1 mb-4">
        <div class="card" id="customersearcharea">
            <div class="card-body">
                <h3 class="card-title"><?= __('Search or create customer') ?></h3>
                <div class="input-group" data-toggle="modal" data-target="#modal_display_customer">
                    <input type="text" name="customersearch" placeholder="<?= __('Search customer') ?>" class="form-control"
                        id="customersearch">
                    <span class="input-group-append">
                        <span>
                            <span class="input-group-append">
                                <button type="button" class="btn btn-primary"><i class="fe fe-search"></i></button>
                            </span>
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <div class="card" id="customerdetailarea" style="display:none">
            <ul class="list-group card-list-group">
                <li class="list-group-item py-5">
                    <div class="media-heading">
                        <small class="float-right text-muted"><a href="javascript:;;" class="icon" id="delcustomer"><i
                                    class="fe fe-trash"></i></a></small>
                        <h3 class="card-title"><?= __('Customer') ?> </h3>

                    </div>
                    <div id="cust_basic_info">
                       
                    </div>
                </li>
                <li class="list-group-item py-5">
                    <div class="media-heading">
                        <small class="float-right text-muted"><a href="javascript:;;" class="icon editshipping"><i
                                    class="fe fe-edit"></i></a></small>
                        <h3 class="card-title"><?= __('Shipping Address') ?></h3>
                    </div>
                    <div id="cust_shipping_info">
                       
                    </div>
                </li>

                <li class="list-group-item py-5">
                    <div class="media-heading">
                        <small class="float-right text-muted"><a href="javascript:;;" class="icon editbilling"><i
                                    class="fe fe-edit"></i></a></small>
                        <h3 class="card-title"><?= __('Billing Address') ?></h3>
                    </div>
                    <div id="cust_billing_info">
                        

                    </div>
                </li>
            </ul>

        </div>




    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= __('Order details') ?></h3>
                <div class="card-options">
                    <?=$this->Html->link(__('Add Custom Product'), ['action'=>'add_manually'],['data-toggle'=>"modal",'data-target'=>"#ManualProductModal"])?>
                </div>

            </div>
            <?=$this->Form->create($order,['id'=>'orderfmr'])?>

            <?php if(isset($type) &&  $type == 'draft') echo '<input type="hidden" name="draft" value="1">'; ?>


            <div class="card-body">

                <?php  echo $this->TablerForm->control('product',['label'=>false,'placeholder'=>__('Search Products'),'input-group'=>'<span class="input-group-append">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modal_display_product" id="browse_product" type="button"> Browse Products </button>
                              </span>']);?>


                <?=$this->Form->hidden('customers_id',['id'=>'customer_id'])?>
                <?=$this->Form->hidden('billing_address',['id'=>'billing_address'])?>
                <?=$this->Form->hidden('shipping_address',['id'=>'shipping_address'])?>
                <?=$this->Form->hidden('shipping_methods_id',['id'=>'shipping_methods_id'])?>
                <?=$this->Form->hidden('shipping_rate',['id'=>'shipping_rate'])?>
                <?=$this->Form->hidden('shipping_rate_flat',['id'=>'shipping_rate_flat'])?>
                <?=$this->Form->hidden('deleted_ids',['id'=>'deleted_ids'])?>


                <table class="table card-table table-striped table-vcenter">
                    <tbody id="productstable">


                    </tbody>

                </table>
                <br />
                <div class="row">
                    <div class="col-lg-6">
                        <?=$this->TablerForm->control('notes',['type'=>'textarea'])?>
                    </div>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <h3 class="card-title"><?= __('Subtotal') ?></h3>
                            </div>
                            <div class="col-lg-4"><?=$this->Formats->moneySymbol()?> <span id="subtotal_span">0</span>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-lg-8"><a href="javascript:;;" id="discountpopuover"
                                    data-value="<?=$order->discount?>" data-container="body" data-placement="top"
                                    title="Add discount">
                                    <h3 class="card-title"><?= __('Add Discount') ?></h3>
                                </a></div>
                            <div class="col-lg-4"><?=$this->Formats->moneySymbol()?><span
                                    id="discount_span"><?= isset($order->discount) ? $order->discount : 0 ?></span>
                            </div>

                        </div>
                        <br />
                        <div class="row">
                            <div class="col-lg-8"><a href="javascript:;;" id="shippingpopuover" data-toggle="modal"
                                    data-target="#ShippingMethodsModal" title="Add shipping">
                                    <h3 class="card-title"><?= __('Add Shipping') ?></h3>
                                </a></div>
                            <div class="col-lg-4"> <?=$this->Formats->moneySymbol()?> <span
                                    id="shipping_span"><?=$order->shipping_fee?></span></div>
                        </div>

                        <br />
                        <div class="row">
                            <div class="col-lg-8"><a href="javascript:;;" id="taxpopuover"
                                    data-value="<?=$order->taxes?>" data-container="body" data-placement="top"
                                    title="Add tax">
                                    <h3 class="card-title"><?= __('Taxes') ?></h3>
                                </a></div>
                            <div class="col-lg-4"> <?=$this->Formats->moneySymbol()?> <span
                                    id="taxes_span"><?= isset($order->taxes) ? $order->taxes : 0 ?></span></div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-lg-8">
                                <h3 class="card-title"><?= __('Total') ?></h3>
                            </div>
                            <div class="col-lg-4"> <?=$this->Formats->moneySymbol()?> <span
                                    id="total_span"><?php echo $order->order_total; ?> </span> </div>
                        </div>

                    </div>

                </div>
            </div>



            <?=$this->Form->hidden('product_total')?>
            <?=$this->Form->hidden('discount')?>
            <?=$this->Form->hidden('sub_total')?>
            <?=$this->Form->hidden('shipping_fee')?>
            <?=$this->Form->hidden('taxes')?>
            <?=$this->Form->hidden('order_total')?>




            <?=$this->Form->end()?>

        </div>


    </div>
</div>


<div class="text-right form-fieldset">
    <div class="d-flex">
        <a href="<?php echo (isset($type) && $type =='draft') ? $this->Url->build(['action'=>'drafts']) : $this->Url->build(['action'=>'index'])  ?>"
            class="btn btn-link"><?= __('Cancel') ?></a>
        <button type="submit" class="btn btn-primary ml-auto" id="btnordersubmit_bottom"><?= __('Save Changes') ?></button>
    </div>
</div>

<div class="modal fade " id="customerAddressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <?php echo $this->Form->create($order->customers, [
    'url' => [
        'controller' => 'Customers',
        'action' => 'add'
    ],
    'id'=>'customer-form'
]);?>
            <div class="modal-header">
                <h5 class="modal-title"><?= __('Add new Customer') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- SVG icon code -->
                </button>
            </div>
            <div class="modal-body">



                <fieldset class="form-fieldset">
                    <h3 class="card-title"><?= __('Customer information') ?></h3>
                    <div class="row">
                        <?php
            echo $this->TablerForm->control('first_name',['row'=>6]);
            echo $this->TablerForm->control('last_name',['row'=>6]);
            echo $this->TablerForm->control('email',['row'=>6, 'required' => "false"]);
            echo $this->TablerForm->control('phone',['row'=>6]);
            echo $this->TablerForm->control('address',['row'=>6, 'required' => "false"]);
            echo $this->TablerForm->control('area',['row'=>6, 'required' => "false"]);
            echo $this->TablerForm->control('city',['bd_district'=>true,'row'=>6,'label'=>'City/District','id'=>'shipping_city']);
            echo $this->TablerForm->control('post_code',['row'=>2, 'required' => "false"]);
            echo $this->TablerForm->control('country',['row'=>4, 'country' => true, 'label' => 'Country']);

        ?>
                    </div>
                </fieldset>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Close') ?></button>
                <button type="submit" class="btn btn-primary" id="customer_form_submit"><?= __('Save changes') ?></button>
            </div>
            <?php echo $this->Form->end()?>
        </div>
    </div>
</div>

<div class="modal fade " id="ManualProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('Add Custom Product') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- SVG icon code -->
                </button>
            </div>
            <div class="modal-body">

                <fieldset class="form-fieldset">

                    <div class="row">
                        <?php
                  echo $this->TablerForm->control('custom_product.product_title',['id'=>'custom_product_title','row'=>12]);
                  echo $this->TablerForm->control('custom_product.product_options',['id'=>'custom_product_options','row'=>12]);
                  echo $this->TablerForm->control('custom_product.sku',['row'=>6]);
                  echo $this->TablerForm->control('custom_product.price',['row'=>6]);
              ?>
                    </div>
                </fieldset>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Close') ?></button>
                <button type="button" class="btn btn-primary" id="add_manual_btn" data-dismiss="modal"><?= __('Add') ?></button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade " id="ShippingAddressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-lg">
            <form id="shipping_frm">


                <div class="modal-header">
                    <h5 class="modal-title"><?= __('Change shipping address') ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <!-- SVG icon code -->
                    </button>
                </div>
                <div class="modal-body">

                    <fieldset class="form-fieldset">

                        <div class="row">
                            <?php
              echo $this->TablerForm->control('first_name',['row'=>6,'required']);
              echo $this->TablerForm->control('last_name',['row'=>6,'required']);
              echo $this->TablerForm->control('email',['row'=>6,'required']);
              echo $this->TablerForm->control('phone',['row'=>6,'required']);
              echo $this->TablerForm->control('address',['row'=>6,'required']);
              echo $this->TablerForm->control('area',['row'=>6]);
              echo $this->TablerForm->control('city',['row'=>4,'label'=>__('City/District/State'),'id'=>'shipping_city','required']);
              echo $this->TablerForm->control('post_code',['row'=>2]);
              echo $this->TablerForm->control('country',['country' => true, 'row'=>6]);
               ?>
                        </div>

                    </fieldset>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Close') ?></button>
                    <button type="button" class="btn btn-primary" id="shiiping_save_btn"
                        data-dismiss="modal"><?= __('Save') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade " id="BillingAddressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="billing_frm">

                <div class="modal-header">
                    <h5 class="modal-title"><?= __('Change billing address') ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <!-- SVG icon code -->
                    </button>
                </div>
                <div class="modal-body">
                    <?php      echo $this->TablerForm->control('same_as_shipping',['type'=>'checkbox','label'=>__('Uncheck if billing address is different')]);  ?>

                    <fieldset class="form-fieldset">
                        <div class="row">
                            <?php
              echo $this->TablerForm->control('first_name',['row'=>6,'required']);
              echo $this->TablerForm->control('last_name',['row'=>6,'required']);
              echo $this->TablerForm->control('email',['row'=>6,'required']);
              echo $this->TablerForm->control('phone',['row'=>6,'required']);
              echo $this->TablerForm->control('address',['row'=>6,'required']);
              echo $this->TablerForm->control('area',['row'=>6]);
              echo $this->TablerForm->control('city',['row'=>4,'label'=>__('City/District/State'),'id'=>'billing_city','required']);
              echo $this->TablerForm->control('post_code',['row'=>2]);
              echo $this->TablerForm->control('country',['country' => true, 'row'=>6, 'id' => 'country']);

               ?>
                        </div>
                    </fieldset>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Close') ?></button>
                    <button type="button" class="btn btn-primary" id="billing_save_btn"
                        data-dismiss="modal"><?= __('Save') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade " id="ShippingMethodsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><?= __('Add shipping method') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- SVG icon code -->
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-label"><?= __('Shipping methods') ?></div>
                    <div class="custom-controls-stacked">
                        <?php $shipping_methods = $shippingMethods->toArray();  foreach($shipping_methods as $key => $shipping): ?>
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="shipping_method"
                                value="<?=$shipping->id?>" checked="" data-rate="<?=$shipping->price?>"
                                data-rate-flat="<?=$shipping->flat_rate?>">
                            <div id="" class="custom-control-label"><?=$shipping->name?>
                                (<?=($shipping->flat_rate)?"Flat rate":"Per unit"?>
                                <?=$this->Formats->moneyFormat($shipping->price) ?>)</div>
                        </label>
                        <?php  endforeach; ?>
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="shipping_method" value="0"
                                checked="checked">
                            <div class="custom-control-label"><?= __('Custom Shipping (Enter price)') ?></div>
                        </label>

                    </div>
                    <?=$this->TablerForm->input('custom_shipping_price',['label'=>__('Enter price')])?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Close') ?></button>
                <button type="button" class="btn btn-primary" id="shiipingmethod_save_btn"
                    data-dismiss="modal"><?= __('Save') ?></button>
            </div>

        </div>
    </div>
</div>



<div class="modal fade " id="modal_display_customer" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><?= __('Customer List') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="browse_customer_form">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                        </div>
                        <input type="text" id="search_customer" class="form-control" placeholder="<?= __('Search Customers') ?>">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary" id="add_new_customer" data-toggle="modal"
                                data-target="#customerAddressModal"><?= __('Add A New Customer') ?></button>
                        </div>

                    </div>
                </div>

                <div class="table-responsive pt-3">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                            <tr>
                                <th class="text-center w-1" width="5%"><i class="icon-people"></i></th>
                                <th width="30%"><?= __('Name') ?></th>
                                <th width="20%"><?= __('Phone') ?></th>
                                <th width="50%"><?= __('Address') ?></th>
                            </tr>
                        </thead>
                        <tbody id="ajax_response_customers">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>




<div class="modal fade " id="modal_display_product" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><?= __('Product List') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="browse_product_form">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                        </div>
                        <input type="text" id="search_product" class="form-control" placeholder="<?= __('Search products') ?>">
                    </div>
                </div>

                <div class="table-responsive pt-3">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                            <tr>
                                <th class="text-center w-1" width="5%"><i class="icon-people"></i><?= __('Icon') ?></th>
                                <th width="5%"></th>
                                <th width="60%"><?= __('Title') ?></th>
                                <th width="15%"><?= __('Stock') ?></th>
                                <th width="15%"><?= __('Unit Price') ?></th>
                            </tr>
                        </thead>
                        <tbody id="ajax_response_products">
                           
                        </tbody>
                    </table>
                </div>



                <div class="table-responsive pt-2">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"></div>

                    <table id="product_display_modal_table" cellpadding="0" cellspacing="0"
                        class="table table-hover table-outline table-vcenter text-nowrap card-table">

                        <tbody id="ajax_response_products2">

                        

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>




<div id="pricepopovercontainer"></div>

<style>
    #product_display_modal_table {

        tr, td {
            padding: 5px;
        }
    }
</style>

<script>
require(['jquery', 'autocomplete', 'xeditable', 'selectize', 'jqtoast'], function($, autocomplete) {
    $(document).ready(function() {

        $("#add_new_customer").click(function(e) {
            $("#modal_display_customer").modal('toggle');
        });


        (function($) {
            $.fn.serializeFormJSON = function() {

                var o = {};
                var a = this.serializeArray();
                $.each(a, function() {
                    if (o[this.name]) {
                        if (!o[this.name].push) {
                            o[this.name] = [o[this.name]];
                        }
                        o[this.name].push(this.value || '');
                    } else {
                        o[this.name] = this.value || '';
                    }
                });
                return o;
            };
        })(jQuery);

        function populate(frm, data) {
            $.each(data, function(key, value) {
                var ctrl = $('[name=' + key + ']', frm);
                switch (ctrl.prop("type")) {
                    case "radio":
                    case "checkbox":
                        ctrl.each(function() {
                            if ($(this).attr('value') == value) $(this).attr("checked",
                                value);
                        });
                        break;
                    default:
                        ctrl.val(value);
                }
            });
        }

        function isFormValid(frm) {
            var a = $(frm).serializeArray();
            $.each(a, function() {
                if ($(this).hasClass('is-invalid')) {
                    // console.log("Field is invalid",this);
                }
            });
        }

        function getFieldVal(selector) {
            val = $(selector).val();
            //console.log(selector,val);
            if (!val) {
                $(selector).val(0);
                return 0;
            } else {
                return parseFloat(val);
            }

        }

        var printAddress = function(custaddress) {
            console.log(custaddress)


            return custaddress.first_name + " " + custaddress.last_name + "<br  />" + custaddress
                .address + "<br  />" + custaddress.area + ", " + custaddress.city +
                "</br> Post Code:" + custaddress.post_code + ", " + custaddress.country +
                "</br> Tel:" + custaddress.phone;
        };

        var calc_shipping = function() {

            total_weight = 0.00;
            $('.product_weight').each(function() {
                total_weight += parseFloat($(this).val());
            });
            s_rate = getFieldVal('input[name ="shipping_rate"]');
            flat_rate = getFieldVal('input[name ="shipping_rate_flat"]');
            console.log("flat rate", flat_rate);
            console.log("shipping rate", s_rate);
            shipping_fee = s_rate;
            if (flat_rate != 1)
                shipping_fee = s_rate * total_weight;


            $('input[name ="shipping_fee"]').val(shipping_fee);

            $('#shipping_span').text(shipping_fee);
        };

        var calc_total = function() {
            sum = 0.00;
            $('.product_total').each(function() {
                sum += Number($(this).val());
            });
            calc_shipping();
            //console.log("ptotal",sum);
            $('input[name ="product_total"]').val(sum);
            // sub_total = sum - getFieldVal('input[name ="discount"]');
            sub_total = sum;

            //console.log("subtotal",sub_total);
            // order_total = getFieldVal('input[name ="shipping_fee"]') + getFieldVal('input[name ="taxes"]') + sub_total;
            order_total = (getFieldVal('input[name ="shipping_fee"]') + getFieldVal(
                'input[name ="taxes"]') + sub_total) - getFieldVal('input[name ="discount"]');
            //console.log("order_total",order_total);
            $('input[name ="sub_total"]').val(sub_total);
            $('input[name ="order_total"]').val(order_total);
            $('#subtotal_span').text(sub_total);
            $('#total_span').text(order_total);



        };


        var setCustomer = function(customer, shipping_address, billing_address) {

            $('#customerdetailarea').toggle();
            $('#customersearcharea').toggle();
            $('#customer_id').val(customer.id);
            $('#shipping_address').val(JSON.stringify(shipping_address));

            $('#cust_basic_info').html(customer.first_name + " " + customer.last_name + " <br  />" +
                customer.email + "<br  />Tel:" + customer.phone);
            $('#cust_shipping_info').html(printAddress(shipping_address));
            if (Object.keys(billing_address).length === 0) {
                $('#cust_billing_info').html("Same as shipping");
                $('#billing_address').val("");
            } else {
                $('#billing_address').val(JSON.stringify(billing_address));
                $('#cust_billing_info').html(printAddress(billing_address));
            }
        };


        $('.editshipping').click(function() {
            $('#ShippingAddressModal').modal();
        });


        $('.editbilling').click(function() {
            $('#BillingAddressModal').modal();
        });

        $('#ShippingAddressModal').on('show.bs.modal', function(event) {

            customer_address = JSON.parse($('#shipping_address').val());
            //console.log("First Name:",customer_address.first_name);
            populate("#shipping_frm", customer_address);
        });

        $('#BillingAddressModal').on('show.bs.modal', function(event) {

            customer_address = JSON.parse($('#shipping_address').val());

            if ($('#billing_address').val() != "") {
                customer_address = JSON.parse($('#billing_address').val());

                $("#billing_frm .form-control").prop("disabled", false);
                $('#same-as-shipping').prop('checked', false).prop("disabled", false);
            } else {

                $("#billing_frm .form-control").prop("disabled", true);
                $('#same-as-shipping').prop('checked', true).prop("disabled", false);
            }
            //console.log("First Name:",customer_address.first_name);
            populate("#billing_frm", customer_address);
        });

        $('#same-as-shipping').click(function() {
            if ($(this).is(":checked")) {
                $("#billing_frm .form-control").prop("disabled", true);
                $('#same-as-shipping').prop('disabled', false);
            } else {
                $("#billing_frm .form-control").prop("disabled", false);
            }

        });

        $('#shiiping_save_btn').click(function() {

            var customer_address = $("#shipping_frm").serializeFormJSON();
            $('#shipping_address').val(JSON.stringify(customer_address));
            $('#cust_shipping_info').html(printAddress(customer_address));


        });

        $('#billing_save_btn').click(function() {
            // console.log("on save billing");
            var customer_address = {};
            if ($('#same-as-shipping').is(":checked") == false) {
                customer_address = $("#billing_frm").serializeFormJSON();
                delete customer_address.same_as_shipping;
                // console.log("address",customer_address);
            }
            if (Object.keys(customer_address).length === 0) {
                $('#billing_address').val("");
                $('#cust_billing_info').html("Same as shipping");
            } else {
                $('#billing_address').val(JSON.stringify(customer_address));
                $('#cust_billing_info').html(printAddress(customer_address));
            }

        });




        /*  $('#customer_form_submit').click(function(){
            //isFormValid('#customer-form');
          //  $("#customer-form").submit();
          });
        */

        // this is the id of the form
        $("#customer-form").submit(function(e) {
            $(this).find(".invalid-feedback").each(function(index, item) {
                $(this).remove();
            });
            $(this).find("input.is-invalid").each(function(index, item) {
                $(this).removeClass('is-invalid');
            });

            var frm = this;
            /*var valid = ($(this).find("input.is-invalid").length === 0);
            if (!valid) {
                console.log("false");
                return false;
            }
            */

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {

                    if (data.hasOwnProperty("error")) {
                        console.log(data.error);
                        $.each(data.error, function(key, value) {
                            //alert( key + ": " + value );
                            $(frm).find('input[name ="' + key + '"]')
                                .addClass("is-invalid");
                            $(frm).find('input[name ="' + key + '"]').after(
                                '<div style="display: inline-block;" class="invalid-feedback has-error-email">' +
                                value[Object.keys(value)[0]] + '</div>');

                        });

                    } else {
                        var customer = data.data;
                        setCustomer(customer, customer, {});
                        $("#customerAddressModal").modal('hide');
                    }

                }
            });


        });




        $('#customersearch').autoComplete({
            resolverSettings: {
                url: '<?=$this->Url->build(['controller'=>'customers','action'=>'customerList.json']);?>'
            }
        });

        let customerList;

        $("#search_customer").keyup(function(e) {
            let q = $(this).val();

            if (q.length >= 3) {
                $.ajax({
                    url: "<?=$this->Url->build(['controller'=>'customers','action'=>'customerList.json']);?>?q=" +
                        q,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        customerList = response;
                        let html = '';
                        $.each(response, function(index, item) {
                            // console.log(index)
                            if (index != 0) {
                                html +=
                                    '<tr class="add_customer" data-index="' +
                                    index + '">'
                                html +=
                                    '<td class="text-center"><span class="avatar avatar-md">' +
                                    item.data.first_name.charAt(0) + item
                                    .data.last_name.charAt(0) +
                                    '</span></td>'
                                html += '<td>' + item.data.first_name +
                                    ' ' + item.data.last_name + '</td>'
                                html += '<td>' + item.data.phone + '</td>'
                                html += '<td>' + item.data.address + '</td>'
                                html += '</tr>'
                            }
                        });
                        $("#ajax_response_customers").html(html);
                    }
                })
            }
        });


        $(document).on("click", ".add_customer", function(event) {
            event.preventDefault();
            index = parseInt($(this).attr('data-index'));
            // console.log(index);
            setCustomer(customerList[index].data, customerList[index].data, {});
            $("#modal_display_customer").modal('toggle');
        });




        $('#customersearch').on('autocomplete.select', function(evt, item) {
            //console.log('select', item.data);
            if (item.value > 0) {

                var customer = item.data;
                var customer_address = customer;

                setCustomer(customer, customer_address, {});

            } else {
                $("#customerAddressModal").modal();

            }
            //$('.basicAutoSelectSelected').html(item?JSON.stringify(item):'null');
            $('#customersearch').val("");
        });


        $('#delcustomer').click(function() {
            $('#customerdetailarea').toggle();
            $('#customersearcharea').toggle();
            $('#customer_id').val("");
            $('#shipping_address').val("");
            $('#billing_address').val("");


        });



        $('#product').autoComplete({
            resolverSettings: {
                url: '<?=$this->Url->build(['controller'=>'products','action'=>'getProductList.json']);?>'
            },
            formatResult: function(item) {
                return {
                    value: item.id,
                    text: "[" + item.id + "] " + item.text,
                    html: [
                        $('<img>').attr('src', item.icon).css("height", 18), ' ',
                        item.title + ' Options:' + item.options + ' Price:' + item.price
                    ]
                };
            }

        });

        var add_product = function(item) {
            console.log("Product... ")
            console.log(item)

            let pvid = item.id + "_" + item.variant_id;
            let pvid_selector = "#" + pvid;
            let product_exist = ($(pvid_selector).length) == 1 ? true : false;
            if (item.id == 0) product_exist = false;


            if (product_exist) {
                let qty_el = $(pvid_selector + " .product_quantity");
                let product_price = parseFloat($("#" + pvid).closest('tr').find('.product_price')
                    .val());
                let qty = parseInt($(qty_el).val()) + 1;
                if (($(qty_el).attr('sell_w_stock') == 'false' || $(qty_el).attr('sell_w_stock') ==
                        0) && qty > parseInt($(qty_el).attr('stock'))) {
                    qty = parseInt($(qty_el).attr('stock'));
                }
                console.log($(qty_el).val());


                // $(qty_el).attr('stock', item.stock)
                $(pvid_selector).closest('tr').find('.product_total').val(product_price * qty);
                qty_el.val(qty)
                calc_total();
                return;
            }




            tCell1 = $('<td>').attr('style', "width:150px").html('<img src="' + item.icon +
                '" alt="" class="h-8">');
            tCell2 = $('<td>').html('<p><b>' + item.title + '</b> <br />' + item.options +
                ' <br />' + item.sku + '</p>');
            tCell3 = $('<td>').attr('style', 'width:100px').html(
                '<a href="javascript:;;" class="pricepopoveritem editable-click" data-type="text" data-container="body" data-placement="top" data-value="' +
                item.price +
                '"   title="Update price"  > <?=$this->Formats->moneySymbol()?> <span class="pricespan">' +
                item.price + '</span>   </a> ');
            tCell4 = $('<td>').attr('class', 'w-1').html('x');
            tCell5 = $('<td>').attr('style', 'width:100px').html(
                '<input type="number" sell_w_stock="' + item.sell_w_stock + '" stock="' + item
                .stock +
                '" name="product_quantity[]" class="form-control product_quantity" id="or_pr_qnty"  value="' +
                item.quantity + '">');
            tCell6 = $('<td>').attr('class', 'w-1').html(
                '<a href="javascript:;;" class="icon delproduct"><i class="fe fe-trash"></i></a>'
            );


            hid0 = $('<input>').attr("type", "hidden").attr("name", "order_product_table_id[]").val(
                item.order_product_table_id);
            hid1 = $('<input>').attr("type", "hidden").attr("name", "product_title[]").val(item
                .title);
            hid2 = $('<input>').attr("type", "hidden").attr("name", "product_weight[]").attr(
                'class', "product_weight").attr('data-is-digital', item.is_digital).val(item
                .weight);
            hid3 = $('<input>').attr("type", "hidden").attr("name", "product_is_digital[]").val(item
                .is_digital);
            hid4 = $('<input>').attr("type", "hidden").attr("name", "product_options[]").val(item
                .options);
            hid5 = $('<input>').attr("type", "hidden").attr("name", "product_sku[]").val(item.sku);
            hid6 = $('<input>').attr("type", "hidden").attr("name", "product_price[]").attr('class',
                "product_price").val(item.price);
            hid7 = $('<input>').attr("type", "hidden").attr("name", "product_total[]").attr('class',
                "product_total").val(item.price * item.quantity);
            hid8 = $('<input>').attr("type", "hidden").attr("name", "products_id[]").val(item.id);
            hid9 = $('<input>').attr("type", "hidden").attr("name", "product_variants_id[]").val(
                item.variant_id);


            tCell6.append(hid0, hid1, hid2, hid3, hid4, hid5, hid6, hid7, hid8, hid9);


            tRow = $('<tr id="' + pvid + '">').attr("class", "producttr").append(tCell1, tCell2,
                tCell3, tCell4, tCell5, tCell6);
            $('#productstable').append(tRow);
            calc_total();

        };

        let product_list = null;

        $("#browse_product").click(function(e) {
            products();
        });


        $('#search_product').keyup(function(e) {
            let q = $(this).val();
            if (q.length >= 3) {
                products(q);
            }
        });



        function products(q = '') {
            let html = '';
            $.ajax({
                url: '<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'getProductList']) ?>?q=' +
                    q,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    product_list = Array.from(response);
                    product_list.forEach(function(item, index) {

                        if (Object.keys(item.variants).length > 0) {
                            let variant_products = Array.from(item.variants);

                            html += '<tr>'
                            html +=
                                '<td class="text-center"><div class="avatar d-block" style="background-image: url(' +
                                item.icon + ')">'
                            html +=
                                '<span class="avatar-status bg-green"></span></div></td>'
                            html += '<td colspan="4">' + item.title + '</td>'
                            //html += '<td>150</td>'
                            //html += '<td>15000</td>'
                            html += '</tr>'



                            // html += '<tr style="cursor: pointer">';
                            // html += '<td style="padding:5px  5px !important; width : 40px !important" ><img style="width:32px" src="'+item.icon+'" alt="" class="h-5"></td>';
                            // html += '<td width="70%">' + item.title + '</td>';
                            // html += '<td width="10%"></td>';
                            // html += '<td width="10%"></td>';
                            // html += '</tr>';

                            variant_products.forEach(function(item, index) {
                                // html += '<tr class="add_brows_product" data-pid="' + item.id + '" data-vid="' + item.variant_id + '" style="cursor: pointer"><td></td>';
                                // html += '<td style="width:100px"><img src="https://preview.tabler.io/demo/products/apple-macbook-pro.jpg" alt="" class="h-5"></td>';
                                // html += '<td style="padding-left: 25px">' + item.options + '</td>';
                                // html += '<td>' + item.stock + ' in stock</td>';
                                // html += '<td class="text-right">Tk ' + item.price + '</td>';
                                // html += '</tr>';
                                if (item.stock == 0 && (item.sell_w_stock ==
                                        false || item.sell_w_stock == 0)) {
                                    html += '<tr>'
                                } else {
                                    html +=
                                        '<tr class="add_brows_product" data-pid="' +
                                        item.id + '" data-vid="' + item
                                        .variant_id +
                                        '" style="cursor: pointer">'
                                }
                                html +=
                                    '<td></td><td class="text-center"><div class="avatar d-block" style="background-image: url(' +
                                    item.icon + ')">'

                                if (item.stock == 0 && (item.sell_w_stock ==
                                        false || item.sell_w_stock == 0))
                                    html +=
                                    '<span class="avatar-status bg-red">'
                                else html +=
                                    '<span class="avatar-status bg-green">'


                                html += '</span></div></td>'
                                //title and option
                                html += '<td><div>' + item.title + '</div>'
                                html += '<div class="small text-muted">'
                                html += item.options
                                html += '</div></td>'

                                if (item.stock == 0 && (item.sell_w_stock ==
                                        false || item.sell_w_stock == 0)) {
                                    html +=
                                        '<td> <span class="badge badge-danger">Out of stock</span></td>'
                                } else if (item.stock <= 0 && (item
                                        .sell_w_stock == true || item
                                        .sell_w_stock == 1)) {
                                    html +=
                                        '<td> <span class="badge badge-success">Sell without stock</span></td>'
                                } else {
                                    html += '<td>' + item.stock + '</td>'
                                }


                                html += '<td>' + item.price + '</td>'
                                html += '</tr>'
                            });


                        } else {
                            // html += '<tr class="add_brows_product" data-pid="' + item.id + '" data-vid="0" style="cursor: pointer">';
                            // html += '<td style="padding:5px  5px !important; width : 40px !important"><img style="width : 32px" src="https://preview.tabler.io/demo/products/apple-macbook-pro.jpg" alt="" class="h-5"></td>';
                            // html += '<td>' + item.title + '</td>';
                            // html += '<td>' + item.stock + ' in stock</td>';
                            // html += '<td class="text-right">Tk ' + item.price + '</td>';
                            // html += '</tr>';

                            // console.log(item);

                            if (item.stock == 0 && (item.sell_w_stock == false ||
                                    item.sell_w_stock == 0)) {
                                html += '<tr>'

                            } else {
                                html += '<tr class="add_brows_product" data-pid="' +
                                    item.id +
                                    '" data-vid="0" style="cursor: pointer">'
                            }
                            html +=
                                '<td class="text-center"><div class="avatar d-block" style="background-image: url(' +
                                item.icon + ')">'

                            if (item.stock == 0 && (item.sell_w_stock == false ||
                                    item.sell_w_stock == 0)) html +=
                                '<span class="avatar-status bg-red">'
                            else html += '<span class="avatar-status bg-green">'

                            html += '</span></div></td>'
                            html += '<td colspan="2">' + item.title + '</td>'

                            if (item.stock == 0 && (item.sell_w_stock == false ||
                                    item.sell_w_stock == 0)) {
                                html +=
                                    '<td> <span class="badge badge-danger">Out of stock</span></td>'
                            } else if (item.stock <= 0 && (item.sell_w_stock ==
                                    true || item.sell_w_stock == 1)) {
                                html +=
                                    '<td> <span class="badge badge-success">Sell without stock</span></td>'
                            } else {
                                html += '<td>' + item.stock + '</td>'
                            }

                            html += '<td>' + item.price + '</td>'
                            html += '</tr>'
                        }
                    });
                    $("#ajax_response_products").html(html);
                }
            })
        }

        $('#modal_display_product').on('hidden.bs.modal', function() {
            $("#ajax_response_products").html('');
            $("#search_product").val('');
        });

        function success(msg) {
           /*  $.toast({
                heading: 'Success',
                text: msg,
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-center',
            }) */
        }

        function error(msg) {
            /* $.toast({
                heading: 'Error',
                text: msg,
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-right',
            }) */
        }

        $(document).on("click", ".add_brows_product", function(event) {
            event.preventDefault();
            let pid = $(this).attr("data-pid");
            let vid = $(this).attr("data-vid");
            let product = null;

            product_list.forEach(function(item, index) {
                if (item.id == pid) {
                    if (vid == 0) {
                        product = item;
                    } else {
                        let varients = Array.from(item.variants);
                        varients.forEach(function(item, index) {
                            if (item.variant_id == vid) {
                                product = item;
                            }
                        })
                    }
                }
            });

            // console.log("added to product from product list modal")
            // console.log(product)
            add_product(product);
            success("Product added to order.");
        });




        $('#product').on('autocomplete.select', function(evt, item) {
            //console.log('select', item);
            $('#product').val("");
            add_product(item);
            // console.log(item)
        });

        $('#add_manual_btn').click(function() {

            var item = {
                id: 0,
                variant_id: 0,
                title: $('#custom_product_title').val(),
                options: $('#custom_product_options').val(),
                sku: $('#custom-product-sku').val(),
                price: $('#custom-product-price').val(),
                quantity: 1,
                weight: "1 kg",
                is_digital: false,
                img: "",
            };
            add_product(item);


        });







        $('#productstable').editable({
            type: 'text',
            selector: '.pricepopoveritem',
            url: '',
            title: 'Enter price',
            display: false,
            success: function(response, newValue) {
                //userModel.set('username', newValue); //update backbone model
                // console.log("New price value",newValue);
                price = parseFloat(newValue);
                var $tr = $(this).closest('tr');

                $tr.find('.product_price').val(price);
                $tr.find('.product_total').val(price * $($tr).find('.product_quantity')
                    .val());
                $($tr).find('.pricespan').text(price);
                // console.log($tr.find('.product_price'));
                calc_total();
                // newValue = "tk " + newValue;
            }
        });







        $('#productstable').on('click', '.delproduct', function() {
            var order_product_table_id = $(this).closest("td").find(
                'input[name="order_product_table_id[]"]').val();
            var val = ($("#deleted_ids").val().trim().length == 0) ? order_product_table_id : $(
                "#deleted_ids").val().trim() + ',' + order_product_table_id;
            $("#deleted_ids").val(val);
            $(this).closest('tr').remove();
            calc_total();
        });
        $('#productstable').on('change', '.product_quantity', function() {
            if ($(this).val() <= 0)
                $(this).val(1);

            // if ($(this).val() > $(this).attr('stock')) $(this).val($(this).attr('stock'));

            // console.log($(this).attr('stock'))
            // console.log($(this).val())


            if ((parseInt($(this).val()) > parseInt($(this).attr('stock'))) && ($(this).attr(
                    'sell_w_stock') == 'false' || $(this).attr('sell_w_stock') == '0')) {
                $(this).val(parseInt($(this).attr('stock')))
            }

            ptotal = $(this).closest('tr').find('.product_price').val() * $(this).val();

            $(this).closest('tr').find('.product_total').val(ptotal);
            calc_total();
        });



        $('#discountpopuover').editable({
            type: 'text',
            url: '',
            title: 'Enter price',
            display: false,
            success: function(response, newValue) {
                //userModel.set('username', newValue); //update backbone model
                //console.log(response + " " + newValue);
                $('#discount_span').text(newValue);
                $('input[name ="discount"]').val(newValue);
                calc_total();
            }
        });


        $('#taxpopuover').editable({
            type: 'text',
            url: '',
            title: 'Enter price',
            placement: 'bottom',
            display: false,
            success: function(response, newValue) {
                //userModel.set('username', newValue); //update backbone model
                //console.log(response + " " + newValue);
                $('#taxes_span').text(newValue);
                $('input[name ="taxes"]').val(newValue);
                calc_total();
            }
        });



        $('#btnordersubmit, #btnordersubmit_bottom').click(function() {
            let is_valid = true;

            if (($("#customer_id").val()).length == 0) {
                error("Customer must not be empty");
                is_valid = false;
            }
            if ($(".producttr").length == 0) {
                error("Product must not be empty");
                is_valid = false;
            }
            if (is_valid) $('#orderfmr').submit();

        });



        $('#shipping_city').selectize({});



        $("input[name=shipping_method]").change(function() {
            if ($(this).val() == 0)
                $('#customs-shipping-price').prop("disabled", false);
            else {
                $('#customs-shipping-price').prop("disabled", true);
            }
            ////console.log("shipping custom here");


        });

        $('#shiipingmethod_save_btn').click(function() {
            // console.log("shipping save click" + $("input[name=shipping_method]:checked").val());
            if ($("input[name=shipping_method]:checked").val() == '0') {
                $('#shipping_methods_id').val(0);
                $('#shipping_rate').val($("input[name=custom_shipping_price]").val());
                $('#shipping_rate_flat').val(1);
            } else {
                $('#shipping_methods_id').val($("input[name=shipping_method]:checked").val());
                $('#shipping_rate').val($("input[name=shipping_method]:checked").attr(
                    "data-rate"));
                $('#shipping_rate_flat').val($("input[name=shipping_method]:checked").attr(
                    "data-rate-flat"));

            }
            calc_total();
        });



        $('#shiipingmethod_save_btn').click();

        <?php
  if(!$order->isEmpty('id')):
  ?>
        $("input[name=shipping_method]").val(['<?=$order->shipping_methods_id?>']);
        setCustomer(JSON.parse('<?=addslashes (json_encode($order->customer))?>'), JSON.parse(
            '<?=addslashes ($order->shipping_address)?>'), JSON.parse(
            '<?=addslashes (empty($order->billing_address)?"[]":$order->billing_address)?>'));
        <?php
  foreach ($order->order_products as $key => $order_product):


    $product = [
        'id'=>$order_product->products_id,
        'variant_id'=>$order_product->product_variants_id,
        'title'=>$order_product->product_title,
        'options'=>$order_product->product_options,
        'icon'=> $order_product->icon,
        'price'=>$order_product->product_price,
        'sku'=>$order_product->product_sku,
        'quantity'=>$order_product->product_quantity,
        'order_product_table_id' => $order_product->id,
        'sell_w_stock' => $order_product->sell_w_stock,
        'stock' => $order_product->stock
    ];
  ?>
        add_product(JSON.parse('<?=addslashes(json_encode($product))?>'));
        <?php endforeach; ?>
        <?php else: ?>

        <?php  endif; ?>




    });
});


require(["<?=$this->Url->build('/assets/js/vendors/bootstrap-validate.js')?>"], function(bootstrapValidate) {
    // Run your dialog here.
    bootstrapValidate('#email', 'email:Enter a valid E-Mail!');
    bootstrapValidate('#phone', 'numeric:Enter a valid Phone!');
    bootstrapValidate('#post-code', 'numeric:Enter a valid post code!');
    bootstrapValidate(['#first-name', '#last-name', '#email', '#phone', '#address', '#shipping_city'],
        'required:Please fill out this field!');
});
</script>

<?php //debug($order); debug($shipping_methods);?>
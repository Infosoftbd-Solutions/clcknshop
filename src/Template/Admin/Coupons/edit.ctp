<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>

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
    <div class="col-lg-12">


        <div class="categories form large-9 medium-8 columns content">
            <?= $this->Form->create($coupon,['action' => 'edit', 'class'=>'card', $coupon->id]) ?>
            <div class="card-header">
                <h4 class="card-title"><?= __('Edit existing Coupon') ?> # <?= $coupon->coupon_code ?></h4>
            </div>
            <div class="card-body">
                <fieldset class="form-fieldset">
                    <div class="row px-3 mb-3">
                        <div class="col-md-9">
                            <label for="title"><?= __('Title') ?></label>
                            <input type="text" name="title" value="<?= $coupon->title ? $coupon->title : '' ?>" class="form-control" placeholder="<?= __('Black Friday') ?>" id="title">
                        </div>
                        <div class="col-md-3">
                            <label for="status" class="form-label"><?= __('Status') ?></label>
                            <select name="status" class="form-control">
                                <option <?= $coupon->status == 1 ? 'selected' : '' ?> value="1"><?= __('Active') ?></option>
                                <option <?= $coupon->status == 0 ? 'selected' : '' ?> value="0"><?= __('Inactive') ?></option>
                            </select>
                        </div>
                    </div>

                </fieldset>


                <fieldset class="form-fieldset">
                    <div class="row px-3 pb-4">
                        <div class="col-md-6">
                            <label for="start_date"><?= __('Start Date') ?></label>
                            <div class="input-icon">
                                <input id="start_date" name="start_date" type="text" value=" <?= $coupon->start_date ? date('Y-m-d H:i:s', strtotime($coupon->start_date)) : '' ?>" class="form-control flatpickr-input datetimepicker" placeholder="<?= __('Select a date') ?>" readonly="readonly">
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

                        <div class="col-md-6">
                            <label for="end_date"><?= __('End Date') ?></label>
                            <div class="input-icon">
                                <input id="end_date" name="end_date" type="text" value="<?= $coupon->end_date ? date('Y-m-d H:i:s', strtotime($coupon->end_date)) : '' ?>" class="form-control flatpickr-input datetimepicker" placeholder="<?= __('Select a date') ?>" readonly="readonly">
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

                    </div>
                </fieldset>

                <fieldset class="form-fieldset">
                    <div class="row px-3 pb-4">
                        <div class="col-md-6 col-lg-3">
                            <label for="discount_type" class="form-label"><?= __('Discount Type') ?></label>
                            <select name="discount_type" class="form-control">
                                <option <?= $coupon->discount_type == 0 ? 'selected' : '' ?> value="0"><?= __('Flat Discount') ?></option>
                                <option <?= $coupon->discount_type == 1 ? 'selected': '' ?> value="1"><?= __('Percentage(%) Discount') ?></option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <label for="discount" class="form-label"><?= __('Discount</label') ?>
                            <input value="<?= $coupon->discount_amount ? $coupon->discount_amount : '' ?>" name="discount_amount" class="form-control" placeholder="100 / 5" required>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <label for="max_amount" class="form-label"><?= __('Maximum Amount') ?> </label>
                            <input name="max_amount" value="<?= $coupon->max_amount ? $coupon->max_amount : '' ?>" class="form-control" placeholder="500">
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <?php echo $this->TablerForm->control('min_purchase_amount', ['placeholder' => __('1000'), 'value' => $coupon->min_purchase_amount ? $coupon->min_purchase_amount : ""]); ?>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-fieldset">
                    <h4>Products Selection</h4>

                    <div class="form-group custom-radio">
                        <label class="custom-control">
                            <input type="radio" <?= $coupon->product_selection_type == 1 ? 'checked':''  ?>  name="product_selection_type" value="1" class="custom-control-input">
                            <span class="custom-control-label"><?= __('All Products') ?></span>
                        </label>

                        <label class="custom-control">
                            <input type="radio" <?= $coupon->product_selection_type == 2 ? 'checked':''  ?> name="product_selection_type" value="2" class="custom-control-input">
                            <span class="custom-control-label"> <?= __('Specific Product') ?>  </span>
                        </label>
                        <div id="specific_product_display" class="card <?= $coupon->product_selection_type != 2 ?  'd-none' : '' ?>">
                            <div class="card-body">
                                <div class="form-group text" id="specific_product_brows_btn">
                                    <label class="form-label" for="<?= __('product') ?>"></label>
                                    <div class="input-group">
                                        <input type="text" placeholder="<?= __('Search Products') ?>" class="form-control" style="cursor: pointer">
                                        <span class="input-group-append">
                                                <span class="input-group-append">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_display_product" id="browse_product" type="button"><?= __('Browse Products') ?></button>
                                                </span>
                                            </span>
                                    </div>
                                </div>
                                <table class="table" id="added_product">
                                    <?php if (count($products)):
//                                        pr($products);
                                        foreach ($products as $product): ?>
                                            <tr id="row_<?= $product->id ?>"> <input type="hidden" name="products[]" value="<?= $product->id ?>">
                                                <td style="padding:5px  5px !important; width : 40px !important">
                                                    <img style="width : 32px" src="https://dummyimage.com/30x30/000/fff.png" alt="" class="h-5">
                                                </td>
                                                <td><?= $product->title ?></td>
                                                <td class="remove-product">
                                                    <a href="javascript:;;" class="icon delproduct"><i class="fe fe-trash"></i></a>
                                                </td>
                                            </tr>
                                    <?php endforeach; endif; ?>

                                </table>

                            </div>
                        </div>



                        <label class="custom-control">
                            <input type="radio" <?= $coupon->product_selection_type == 3 ? 'checked':''  ?> name="product_selection_type" value="3" class="custom-control-input">
                            <span class="custom-control-label"> <?= __('Specific Collection') ?>  </span>
                        </label>

                        <div id="display_specific_collection" class="card <?= $coupon->product_selection_type != 3 ?  'd-none' : '' ?>">
                            <div class="card-body">
                                <?php
                                $selected_collections = [];
                                if ($coupon->product_selection_type == 3) $selected_collections = explode(',', $coupon->products);
//                                pr($selected_collections);

                                foreach ($collections as $collection): ?>
                                    <label class="form-check">
                                        <input  class="form-check-input" <?= in_array($collection->id, $selected_collections) ? 'checked' : '' ?> value="<?= $collection->id ?>" type="checkbox" name="collections[]">
                                        <span class="form-check-label"><?= $collection->name ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </fieldset>



                <fieldset class="form-fieldset">
                    <h4><?= __('Customers Selection') ?></h4>

                    <div class="form-group custom-radio">
                        <label class="custom-control">
                            <input type="radio" <?= $coupon->customer_selection_type == 1 ? 'checked':''  ?> name="customer_selection_type" value="1" class="custom-control-input">
                            <span class="custom-control-label"><?= __('All Customers') ?></span>
                        </label>

                        <label class="custom-control">
                            <input type="radio" <?= $coupon->customer_selection_type == 2 ? 'checked':''  ?> name="customer_selection_type" value="2" class="custom-control-input">
                            <span class="custom-control-label"> <?= __('Specific  Customer') ?>  </span>
                        </label>

                        <div id="specific_customer_display" class="card <?= $coupon->customer_selection_type != 2 ?  'd-none' : '' ?>">
                            <div class="card-body">
                                <div class="form-group text" id="specific_customer_brows_btn">
                                    <label class="form-label" for="product"></label><div class="input-group">
                                        <input type="text" placeholder="<?= __('Search Customers') ?>" class="form-control" style="cursor: pointer">
                                        <span class="input-group-append">
                                    <span><span class="input-group-append">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal_display_product" id="browse_product" type="button"><?= __('Browse Products') ?></button>
                                    </span></span>
                                </span>
                                    </div>
                                </div>

                                <table class="table" id="added_customers">
                                    <?php //pr($customers)
                                        if (count($customers)) :
                                        foreach ($customers as $customer): ?>
                                    <tr id="row_<?= $customer->id ?>">
                                        <input type="hidden" name="customers[]" value="<?= $customer->id ?>">
                                        <td><?= $customer->first_name . ' ' . $customer->last_name ?></td>
                                        <td><?= $customer->address ?></td>
                                        <td class="remove-product"> <a href="javascript:;;" class="icon delproduct"><i class="fe fe-trash"></i></a> </td>
                                    </tr>

                                    <?php endforeach; endif; ?>
                                </table>
                            </div>
                        </div>

                    </div>
                </fieldset>


            </div>

            <div class="card-footer">

                <div class="d-flex justify-content-between">
                    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-outline-primary"><?= __('cancel') ?></a>
                    <button type="submit" class="btn btn-primary ml-auto"><?= __('Save Changes') ?></button>
                </div>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>




<div class="modal fade " id="modal_display_condition" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('Product List') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="browse_product_form">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" id="search_on_modal" class="form-control" placeholder="<?= __('Search products') ?>">
                            </div>
                        </div>
                        <div class="table-responsive pt-2">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"></div>

                            <table id="product_display_modal_table" cellpadding="0" cellspacing="0" class="table table-hover table-outline table-vcenter text-nowrap card-table">

                                <tbody id="ajax_response_result">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade " id="modal_display_customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('Customer List') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="browse_product_form">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" id="customer_search_on_modal" class="form-control" placeholder="<?= __('Search products') ?>">
                            </div>
                        </div>
                        <div class="table-responsive pt-2">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"></div>

                            <table cellpadding="0" cellspacing="0" class="table table-hover table-outline table-vcenter text-nowrap card-table">

                                <tbody id="customer_ajax_response_result">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>


    require(['jquery', 'flatpickr'], function ($, selectize) {
        $(document).ready(function () {
            $(".datetimepicker").flatpickr({
                enableTime: true,
                // dateFormat: "d-m-Y H:i",
                // defaultDate: new Date()
            });

            $('input[type=radio][name=product_selection_type]').change(function() {

                console.log(this.value);

                if (this.value.trim() == 1) {
                    $("#specific_product_display").addClass('d-none');
                    $("#display_specific_collection").addClass('d-none')
                }
                else if (this.value.trim() == 2) {
                    $("#specific_product_display").removeClass('d-none')
                    $("#display_specific_collection").addClass('d-none')
                }
                else if (this.value.trim() == 3) {
                    $("#specific_product_display").addClass('d-none')
                    $("#display_specific_collection").removeClass('d-none')
                }
            });

            $('input[type=radio][name=customer_selection_type]').change(function() {
                console.log(this.value);
                if (this.value.trim() == 1) {
                    $("#specific_customer_display").addClass('d-none');
                }
                else if (this.value.trim() == 2) {
                    $("#specific_customer_display").removeClass('d-none')
                }
            });


            $("#specific_product_brows_btn").click(function (e) {
                $("#modal_display_condition").modal();
            });

            $("#specific_customer_brows_btn").click(function (e) {
                $("#modal_display_customer").modal();
            })

            function load_previous_items(url){
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        let html;
                        let product_list = Array.from(response);
                        product_list.forEach(function (item, index) {
                            html +='<tr id="row-'+item.id+'">'

                            html +='<input type="hidden" class="selected_hidden_field" value="'+item.id+'" name="products[]">'

                            html +='<td style="padding:5px  5px !important; width : 40px !important"><img style="width : 32px" src="https://dummyimage.com/30x30/000/fff.png" alt="" class="h-5"></td>'

                            html += '<td>'+item.title+'</td>'

                            html += '<td class="text-right"><a href="javascript:void(0)" data-pid="'+item.id+'" class="remove_selected_item"><i class="fe fe-x icon"></i></a></td>'
                            html += '</tr>'
                        });

                        $("#ajax_response_show_table").html(html);

                        $("#modal_display_condition").modal();
                    }
                })
            }


            $('#search_on_modal').keyup(function (e) {
                let q = $(this).val();
                console.log(q);

                if(q.length >=3) {
                    let url = '<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'products']) ?>?q=' + q;
                    fetch_and_load(url);
                }
            });

            $('#customer_search_on_modal').keyup(function (e) {
                let q = $(this).val();
                console.log(q);
                if(q.length >=3) {
                    let url = '<?php echo $this->Url->build(['controller' => 'Customers', 'action' => 'customers']) ?>?q=' + q;
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            let html;
                            let product_list = Array.from(response);
                            product_list.forEach(function (item, index) {
                                let customer = JSON.parse(item.data);
                                console.log(customer.id)

                                html += '<tr class="add_brows_customer" data-cid="' + customer.id + '" style="cursor: pointer">';
                                html += '<td>'+customer.first_name+' '+customer.last_name+'</td>';
                                html += '<td>' + customer.address + '</td>';
                                html += '</tr>';
                            });
                            $("#customer_ajax_response_result").html(html);
                        }
                    })
                }
            });

            function fetch_and_load(url){
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        let html;
                        let product_list = Array.from(response);
                        product_list.forEach(function (item, index) {
                            html += '<tr class="add_brows_product" data-pid="' + item.id + '" style="cursor: pointer">';
                            html += '<td style="padding:5px  5px !important; width : 40px !important"><img style="width : 32px" src="https://dummyimage.com/30x30/000/fff.png" alt="" class="h-5"></td>';
                            html += '<td>' + item.title + '</td>';
                            html += '</tr>';
                        });
                        $("#ajax_response_result").html(html);
                    }
                })
            }

            $("#condition_modal_form").submit(function (e) {
                e.preventDefault();
                let value = '';
                let items = $(".selected_hidden_field");
                $.each(items, (index, item) =>{
                    value += $(item).val()+",";
                })
                value = value.substring(0, value.length - 1);
                $("#"+$("#field").val()).val(value);

                $("#modal_display_condition").modal('toggle');
            })


            $('#modal_display_condition').on('hidden.bs.modal', function(){
                $("#ajax_response_result").html('');
                $("#search_on_modal").val('');
            });


            $('#modal_display_customer').on('hidden.bs.modal', function(){
                $("#customer_ajax_response_result").html('');
                $("#customer_search_on_modal").val('');
            });


            $(document).on("click", ".add_brows_product", function(event) {
                event.preventDefault();
                let pid = $(this).attr('data-pid');
                let tds = $(this).html();
                if ($("#row_"+pid).length == 0){
                    let html = '<tr id="row_'+pid+'"> <input type="hidden" name="products[]" value="'+pid+'">';
                    html += tds;
                    html += '<td class="remove-product"> <a href="javascript:;;" class="icon delproduct"><i class="fe fe-trash"></i></a> </td>';
                    html += '</tr>';
                    $("#added_product").append(html);
                }



                /*
                let td = (this).querySelectorAll('td');

                if($("#row-"+pid).length == 0){
                    let html = "<tr id='row-"+pid+"'> <input type='hidden' class='selected_hidden_field' value='"+pid+"' name='products[]'>"+td[0].outerHTML+td[1].outerHTML;
                    html += "<td class='text-right'><a href='javascript:void(0)' data-pid='"+pid+"' class='remove_selected_item'><i class='fe fe-x icon'></i></a></td></tr>";
                    $("#ajax_response_show_table").append(html);
                    // formValidate();
                }
                */
            });

            $(document).on("click", ".add_brows_customer", function(event) {
                event.preventDefault();
                let cid = $(this).attr('data-cid');
                let tds = $(this).html();
                if ($("#row_" + cid).length == 0) {
                    let html = '<tr id="row_' + cid + '"> <input type="hidden" name="customers[]" value="' + cid + '">';
                    html += tds;
                    html += '<td class="remove-product"> <a href="javascript:;;" class="icon delproduct"><i class="fe fe-trash"></i></a> </td>';
                    html += '</tr>';
                    $("#added_customers").append(html);
                }
            });

            $(document).on("click", ".remove-product", function(event) {
                event.preventDefault();
                $(this).closest("tr")[0].remove();
            });

        });

    });

</script>

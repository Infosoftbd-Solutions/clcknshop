<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<?php echo $this->Html->css('/js/dropzone/dropzone.min.css'); ?>


<script>
  require.config({
    shim: {
      'jqueryui': ['jquery', 'bootstrap']
    },
    paths: {
      'jqueryui': '/assets/js/vendors/jquery-ui.min',
    }
  });





  require.config({
    shim: {
      'dropzonejs': ['jquery']
    },
    paths: {
      'dropzonejs': '/js/dropzone/dropzone.min'
    }
  });

  require.config({
    paths: {
      tinyMCE: '/js/tinymce/tinymce.min'
    },
    shim: {
      tinyMCE: {
        exports: 'tinyMCE',
        init: function() {
          this.tinyMCE.DOM.events.domLoaded = true;
          return this.tinyMCE;
        }
      }
    }
  });
</script>
<div class="row">
  <div class="col-lg-3 order-lg-1 mb-4">
    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-block btn-primary mb-6">
      <i class="fe fe-list mr-2">
      </i><?= __("Back to list") ?>
    </a>
    <?php echo $this->element('product_sidebar', ['product' => $product]); ?>
  </div>
  <div class="col-lg-9">
    <?= $this->Form->create($product, ['id' => 'productFrm', 'class' => 'card']) ?>
    <div class="card-header">
      <h4 class="card-title">
        <?php if ($product->isEmpty('id')) echo __("Add Product");
        else echo __("Edit {0}", [$product->title]);  ?>
      </h4>
      <div class="card-options">
        <button type="submit" id="product_form_submit" class="btn btn-primary ml-auto"><?= __("Save and Continue") ?>
        </button>
      </div>
    </div>
    <div class="card-body">
      <fieldset class="form-fieldset">
        <?= $this->TablerForm->control('title', ['required']); ?>
        <?= $this->TablerForm->control('overview', ["style" => "height: 100px"]); ?>
        <?= $this->TablerForm->control('description', ["style" => "height: 300px"]); ?>
        <?= $this->TablerForm->control('slug'); ?>
        <?= $this->TablerForm->control('active', ['type' => 'checkbox', 'label' => __('Show this product in online store')]); ?>
        <?= $this->TablerForm->control('hasVariations', ['type' => 'checkbox', 'label' => __('This product has multiple variatons')]); ?>
      </fieldset>
      <?php

      ?>
      <fieldset class="form-fieldset">
        <div class="row">
          <div class="col-sm-6 col-md-6">
            <?php
            echo $this->TablerForm->control('product_type', ['options' => $product_types, 'empty' => true, 'class' => 'form-control custom-select', 'placeholder' => __("eg. Shirt, Pant etc")]);  ?>
          </div>
          <div class="col-sm-6 col-md-6">
            <?php
            echo $this->TablerForm->control('vendor', ['required']);
            ?>
          </div>
          <div class="col-sm-12 col-md-12">
            <?php echo $this->TablerForm->control('categories._ids', ['options' => $categories, 'multiple' => 'checkbox', 'label' => __('Collections')]);   ?>
            <?php
            echo $this->TablerForm->control('tags', ['placeholder' => __('add comma separated tags eg. sharts,clothes')]);
            ?>
          </div>
        </div>
      </fieldset>
      <fieldset class="form-fieldset" id='pricefields'>
        <div class="row">
          <div class="col-sm-6 col-md-6">
            <?php
            echo $this->TablerForm->control('price', ['prepend' => $this->Formats->moneySymbol(), 'placeholder' => __('0.00')]);
            ?>
          </div>
          <div class="col-sm-6 col-md-6">
            <?php
            echo $this->TablerForm->control('compare_price', ['prepend' => $this->Formats->moneySymbol(), 'placeholder' => __('0.00'), 'help' => "<p>Use a lower value in price to show reduced price in store.</p><p class='mb-0'><a href='javascript:;;'>Check documentation</a></p>"]);
            ?>
          </div>
          <div class="col-sm-6 col-md-6">
            <?php echo $this->TablerForm->control('cost', ['prepend' => $this->Formats->moneySymbol(), 'placeholder' => __('0.00')]);
            ?>
          </div>
          <div class="col-sm-6 col-md-6">
          </div>
        </div>
      </fieldset>
      <fieldset class="form-fieldset" id='skufields'>
        <div class="row">
          <div class="col-sm-6 col-md-6">
            <?php
            echo $this->TablerForm->control('sku', ['label' => __('SKU (Stock Keeping Unit)')]);
            ?>
          </div>
          <div class="col-sm-6 col-md-6">
            <?php echo $this->TablerForm->control('barcode', ['label' => __('Barcode (ISBN, UPC, GTIN, etc.)')]); ?>
          </div>
          <div class="col-sm-6 col-md-6">
            <?php
            echo $this->TablerForm->control('q_available', ['label' => __('Quantity available')]);
            ?>
          </div>
          <div class="col-sm-6 col-md-6">
          </div>
          <div class="col-sm-6 col-md-12">
            <?php
            echo $this->TablerForm->control('track_inventory', ['type' => __('checkbox')]);
            echo $this->TablerForm->control('sell_w_stock', ['type' => 'checkbox', 'label' => __('Sell without stock')]);
            ?>
          </div>
        </div>
      </fieldset>
      <fieldset class="form-fieldset" id='weightfields'>
        <div class="row">
          <div class="col-sm-6 col-md-6">
            <?php
            echo $this->TablerForm->control('is_physical', ['type' => 'checkbox', 'label' => __('This is a physical product')]);
            echo $this->TablerForm->control('weight', ['input-group' => $this->Form->select('weight_unit', ['kg', 'g', 'lb', 'oz'], ['class' => 'custom-select']), 'help' => "<p>Used to calculate in shipping.</p><p class='mb-0'><a href='javascript:;;'>Check documentation</a></p>"]);
            ?>
          </div>
        </div>
      </fieldset>
      <?php if (isset($product->product_options) &&  sizeof($product->product_options) > 0) : ?>
        <fieldset class="form-fieldset" id='variant_fieldset'>
          <div>
            <small class="float-right text-muted">
              <a href="<?= $this->Url->build(['action' => 'variants', $product->id, "add" => 1]) ?>" class="btn btn-sm btn-secondary"> <?= __("Add Variant") ?>
              </a>
              <a href="#" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#OptionsChangeModal"> <?= __("Change options") ?>
              </a>
            </small>
            <h3 class="card-title"> <?= __("Product Variants") ?>
            </h3>
          </div>
          <div class="table-responsive">
            <?= $this->Form->hidden('variant.deleted_variants', ['id' => 'deleted_variants']) ?>
            <?php foreach ($product->product_options as $option) : ?>
              <?= $this->Form->hidden('option.values.' . $option->id, ['id' => 'opt_val_' . $option->id, 'value' => $option->option_values]) ?>
            <?php endforeach; ?>
            <table class="table mb-0">
              <thead>
                <tr>
                  <th>
                    <?= __("Options") ?>
                  </th>
                  <th>
                    <?= __("Price") ?>
                  </th>
                  <th>
                    <?= __("C. Price") ?>
                  </th>
                  <th>
                    <?= __("Inventory") ?>
                  </th>
                  <th>
                    <?= __("Sku") ?>
                  </th>
                  <th>
                    <?= __("Action") ?>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($product->product_variants as $variant) : ?>
                  <tr>
                    <td>
                      <div>
                        <span id="variant_display_img_<?= $variant->id ?>">
                          <?php $image = $variant->media;
                          if ($image) : ?>
                            <?= $this->Media->productImage($image->path, $image->product_id, ['height' => '42', 'width' => '42', 'class' => ['img-thumbnail', 'add_variant_image'], 'style' => 'cursor:pointer', 'data-pid' => $variant->products_id, 'data-vid' => $variant->id]) ?>
                          <?php else : ?>
                            <img class="img-thumbnail add_variant_image" data-vid="<?= $variant->id ?>" data-pid="<?= $variant->products_id ?>" src="<?= $this->Url->build('/assets/images/add_image_2.png') ?>" width="42px" height="42px" data-toggle="tooltip" data-placement="top" title="<?= __('Click here to add Media') ?>" alt="" style="cursor: pointer;">
                          <?php endif; ?>
                        </span>
                        <?= $this->Form->hidden('variant.images[]', ['id' => 'variant_image_' . $variant->id]) ?>
                      </div>
                      <?= $this->Form->hidden('variant.id[]', ['value' => $variant->id]) ?>
                      <?php echo implode('/', json_decode($variant->option_values, true)) ?>
                    </td>
                    <td>
                      <?= $this->Form->text('variant.price[]', ['value' => $variant->price, 'class' => 'form-control', 'size' => 6]) ?>
                    </td>
                    <td>
                      <?= $this->Form->text('variant.compare_price[]', ['value' => $variant->compare_price, 'class' => 'form-control', 'size' => 6]) ?>
                    </td>
                    <td>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <!--                                                    <input type="checkbox" aria-label="Checkbox for following text input">-->
                            <?= $this->Form->checkbox('variant.track_inventory_' . $variant->id, ['checked' => $variant->track_inventory == '1' ? true : false]) ?>
                          </div>
                        </div>
                        <!--                                            <input type="text" class="form-control" aria-label="Text input with checkbox">-->
                        <?= $this->Form->text('variant.q_available[]', ['value' => $variant->q_available, 'class' => 'form-control', 'size' => 4]) ?>
                        <?= $this->Form->hidden('variant.prev_q_available[]', ['value' => $variant->q_available]) ?>
                      </div>
                    </td>
                    <td>
                      <?= $this->Form->text('variant.sku[]', ['value' => $variant->sku, 'class' => 'form-control']) ?>
                    </td>
                    <td>
                      <div class="form-group pt-2">
                        <a href="<?= $this->Url->build(['action' => 'variants', $product->id, $variant->id]) ?>" class="icon">
                          <i class="fe fe-edit">
                          </i>
                        </a>
                        <a href="javascript:void(0)" class="icon del_variant" data-id="<?= $variant->id ?>">
                          <i class="fe fe-x">
                          </i>
                        </a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </fieldset>

        <div class="modal fade " id="OptionsChangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-lg">
              <div class="modal-header">
                <h5 class="modal-title"><?= __('Product Options') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <!-- SVG icon code -->
                </button>
              </div>
              <div class="modal-body">
                <div class="table-responsive">
                  <table class="table mb-0">
                    <thead>
                      <tr>
                        <th>
                          <?= __('Option') ?>
                        </th>
                        <th>
                          <?= __('Option Values') ?>
                        </th>
                        <th>
                          <?= __('Add') ?>
                        </th>
                      </tr>
                    </thead>
                    <tbody id="product_option">
                      <?php foreach ($product->product_options as $key => $prodctOption) : ?>
                        <tr data-id="<?= $prodctOption->id ?>">
                          <td>
                            <?= $prodctOption->option_name ?>
                          </td>
                          <td>
                            <div class="tags grid">
                              <?php $values = explode(",", $prodctOption->option_values);
                              foreach ($values as $val) : ?>
                                <span class="tag">
                                  <?= $val ?>
                                  <a href="#" class="tag-addon remTag">
                                    <i class="fe fe-x"></i>
                                  </a>
                                </span>
                              <?php endforeach; ?>
                            </div>
                          </td>
                          <td>
                            <span class="tag">
                              <?= __('Add New') ?>
                              <a href="#" class="tag-addon addTag">
                                <i class="fe fe-plus">
                                </i>
                              </a>
                            </span>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Cancel') ?>
                </button>
                <button type="button" id="btn_add_new_product_option" class="btn btn-primary"><?= __('Add New Option') ?>
                </button>
                <button type="button" class="btn btn-primary" id="Options_save_btn" data-dismiss="modal"><?= __('Save') ?>
                </button>
              </div>
            </div>
          </div>
        <?php endif;  ?>

        <fieldset class="form-fieldset" id='optionsfields'>
          <h3 class="card-title"><?= __('Product options') ?>
          </h3>
          <div class="row" id="optionhtml">
            <div class="col-sm-6 col-md-3 optclass">
              <div class="form-group">
                <label class="form-label"><?= __('Option') ?>
                </label>
                <?php echo $this->Form->select('ProductOptions.option[]', ['Color' => 'Color', 'Size' => 'Size', 'Feature' => 'Feature'], ['id' => 'option1', 'empty' => true, 'class' => 'form-control custom-select', 'placeholder' => __("Size,Color,Feature etc")]); ?>
              </div>
            </div>
            <div class="col-sm-6 col-md-8 optvalclass">
              <div class="form-group">
                <label class="form-label">&nbsp;
                </label>
                <?php echo $this->Form->text('ProductOptions.optionvalues[]', ['id' => 'optionvalues1', 'class' => 'form-control', 'placeholder' => __("S,L,XL etc")]); ?>
              </div>
            </div>
            <div class="col-sm-6 col-md-1" style="display:none">
              <div class="form-group">
                <label class="form-label">&nbsp;
                </label>
                <a href="javascript:;;" class="icon removehtml">
                  <i class="fe fe-x">
                  </i>
                </a>
              </div>
            </div>
          </div>
          <button type="button" class="btn btn-primary" id="addoptionbtn"><?= __('Add another option') ?>
          </button>
        </fieldset>
        </div>
        <div class="card-footer text-right">
          <div class="d-flex">
            <a href="javascript:void(0)" class="btn btn-link"><?= __('Cancel') ?>
            </a>
            <button type="submit" id="product_form_submit" class="btn btn-primary ml-auto"><?= __('Save and Continue') ?>
            </button>
          </div>
        </div>
        <?= $this->Form->hidden('images_id', ['id' => 'images_id']) ?>
        <?= $this->Form->end() ?>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="addVariantImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><?= __('Choose Variant Image') ?>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row gutters-sm" id="variant_image_ajax_response">
            </div>
            <div id="variant_image_ajax_response_2">
            </div>
            <?= $this->Form->create(null, ['url' => ['controller' => 'ProductMedia', 'action' => 'add'], 'type' => 'file', 'id' => 'dzUpload', 'class' => ['dropzone', 'needsclick', 'dz-clickable']]) ?>
            <?= $this->Form->hidden('pid', ['value' => 0, 'id' => 'dz_pid']) ?>
            <?= $this->Form->hidden('vid', ['value' => 0, 'id' => 'dz_vid']) ?>
            <?= $this->Form->end(); ?>
          </div>
        </div>
        <div class="modal-footer">
          <button id="save_variant_image" data-dismiss="modal" type="button" class="btn btn-outline-primary"><?= __('Save changes') ?>
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="tinymceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-footer">
          <button id="save_product_description" data-dismiss="modal" type="button" class="btn btn-outline-primary"><?= __('Save changes') ?>
          </button>
        </div>
      </div>
    </div>
  </div>

  <script>
    /*     require([
      'jquery', 'tinyMCE'
   ], function ($,tinyMCE) {
    //console.log(tinyMCE);
    $(document).ready(function() {
         console.log('dsfs');
        let options = {
          selector: '#description',
          height: 300,
          menubar: false,
          statusbar: false,
          plugins: 'advlist autolink link image lists charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table emoticons template paste help',
        
          toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | viewfullscreen |' +
            'removeformat',
          content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }'
        }
        if (localStorage.getItem("tablerTheme") === 'dark') {
          options.skin = 'oxide-dark';
          options.content_css = 'dark';
        }
        tinyMCE.init(options);
      });
    // your code here
    }); */
    require(['jquery', 'tinyMCE'], function($, tinyMCE) {
      $(document).ready(function() {

        tinyMCE.init({
          selector: '#description',
          min_height: 450,
          plugins: 'advlist autolink link image lists charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table emoticons template paste help',
          toolbar: "undo redo | formatselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | viewfullscreen",
          statusbar: false,
          menubar: false,
          relative_urls: false,
          remove_script_host: true,
          setup: function(editor) {
            editor.ui.registry.addButton('viewfullscreen', {
              icon: 'fullscreen',
              tooltip: 'View Full Screen',
              onAction: function(_) {
                // var content = editor.getContent();
                // console.log("Normal Screen Editor" +content);
                tinymce.init(config_full_screen);
                // tinymce.get("full_screen_editor").setContent(content);
              },
            });
          },
        });
        var config_full_screen = {
          selector: '#full_screen_editor',
          min_height: 450,
          plugins: 'advlist autolink link image lists charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table emoticons template paste filemanager help',
          toolbar: "undo redo | formatselect | fontselect fontsizeselect | bold italic | forecolor backcolor removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | emoticons image media link |table | preview collapsefullscreen",
          // fullscreen_native: true,
          statusbar: false,
          menubar: false,
          table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
          image_advtab: true,
          //external_filemanager_path: "/tinymce_filemanager_plugin/filemanager/",
          //filemanager_title: "Filemanager",
         // external_plugins: {
         //   "filemanager": "/tinymce_filemanager_plugin/filemanager/plugin.min.js"
         // },
          setup: function(editor) {
            editor.on('init', function(e) {
              editor.execCommand('mceFullScreen');
              var content = tinymce.get("description").getContent();
              editor.setContent(content);
            });
            editor.ui.registry.addButton('collapsefullscreen', {
              icon: 'close',
              tooltip: 'Collape Full Screen',
              onAction: function(_) {
                var content = editor.getContent();
                console.log("Full Screen Editor" + content);
                tinymce.get("description").setContent(content);
                editor.setContent('');
                editor.remove();
              },
            });
          }
        };

        $("#product_form_submit").click(function(e) {
          var content = tinymce.get("description").getContent();
          var text = content.replace(/(<([^>]+)>)/gi, "");
          if (text.length == 0) e.preventDefault();
        });

      });
    });
    require(['jquery', 'dropzonejs'], function($) {
      Dropzone.autoDiscover = false;
      $(document).ready(function() {
        var dzUpload = new Dropzone("#dzUpload", {
          headers: {
            "Accept": "*/*"
          }
        });
        dzUpload.on("success", function(file, response) {
          console.log(response);
          $("#variant_image_ajax_response").append(response);
        });
        dzUpload.on("complete", function(file) {
          dzUpload.removeFile(file);
        });
        dzUpload.on("queuecomplete", function(file) {
          // location.reload();
        });
      });
    });
    require(['jquery', 'jqueryui'], function($) {
      $(document).ready(function() {
        $(".grid").sortable({
          /* tolerance: 'pointer',
                 revert: 'invalid',
                 placeholder: 'span2 well placeholder tile',
                 forceHelperSize: true
                 */
        });
        $(".grid").disableSelection();
      });
    });
    require(['jquery', 'selectize'], function($, selectize) {
      $(document).ready(function() {
        var formChanged = false;



        function convertToSlug(Text) {
          return Text
            .toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');
        }
        $('#productFrm').on('keyup change paste', 'input, select, textarea', function() {
          formChanged = true;
          //console.log("FormChanged",formChanged);
        });
        $(window).bind('beforeunload', function() {
          if (formChanged) return 'Are you sure you want to leave?';
        });
        $('#productFrm').submit(function() {
          // your code here
          formChanged = false;
        });
        if ($("#slug").val() != "") $("#slug").after("<div id='product-url'><a target='_blank' href='<?php echo $this->Url->build("/", true); ?>product/" + $("#slug").val() + "'><?php echo $this->Url->build("/", true); ?>product/" + $("#slug").val() + "</a></div>");
        /*$("#title").keyup(function(){
          $("#slug").val(convertToSlug($(this).val()));
          $("#slug").change();
        });
        $("#slug").change(function(){
          $('#product-url').text("http://clcknshop.com/product/" +  $("#slug").val());
        }); */
        $('#title').blur(function() {
          // do your stuff
          console.log("add code here");
          $.ajax({
            url: '<?= $this->Url->build(['controller' => 'products', 'action' => 'get_slug']) ?>',
            type: 'post',
            dataType: 'json',
            data: $('#productFrm').serialize(),
            success: function(data) {
              // ... do something with the data...
              console.log(data);
              if (data.hasOwnProperty("slug")) {
                $('#slug').val(data.slug);
              }
            }
          });
        });

        $("#product_option").on("click", '.addTag', function() {

          var tag = prompt("Please enter new tag name");
          //console.log("tag",tag);
          if (tag) {
            html = '<span class="tag">' +
              tag +
              '<a href="#" class="tag-addon remTag"><i class="fe fe-x"></i></a>' +
              '</span>';
            $(this).closest("td").prev("td").find("div").append(html);
          }
        });

        $("#btn_add_new_product_option").click((e) => {
          var option = prompt("Please enter new option name");
          if (option) {
            var option_html = '<tr data-option="' + option + '" data-new="1"> <td>' + option + '</td>  <td> <div class="tags grid"> </div> </td>'
            option_html += '<td><span class="tag">Add New<a href="#" class="tag-addon addTag"><i class="fe fe-plus"></i></a></span> </td></tr>'
            $("#product_option").append(option_html);
          }
        });

        $('#OptionsChangeModal').on('click', '.remTag', function() {
          $(this).closest("span").remove();
        });
        $('#Options_save_btn').click(function() {
          $('#OptionsChangeModal').find("table > tbody  > tr").each(function(index, tr) {
            // console.log(index);
            // console.log("option id",$(tr).attr("data-id"));

            var option_id = $(tr).attr("data-id");
            var option_vals = [];
            $(tr).find(".tags > .tag").each(function(i, tag) {
              option_vals.push($(tag).text().trim());
            });
            // console.log("opt vals",option_vals);
            $('#opt_val_' + option_id).val(option_vals.join());


            // console.log(option_vals[0]);
            if (option_id && option_vals[0] === undefined) {
              $('#opt_val_' + option_id).remove();

              $('<input>').attr({
                type: 'hidden',
                name: 'option[deleted][]',
                value: option_id
              }).appendTo('#deleted_variants');
            }

            if ($(tr).attr("data-new") !== undefined) {

              // console.log(typeof(option_vals))
              // console.log(option_vals);
              if (option_vals.length != 0) {
                option = $(tr).attr('data-option');
                $('<input>').attr({
                  type: 'hidden',
                  name: 'option[new][' + option + ']',
                  value: option_vals.join()
                }).appendTo('#deleted_variants');
              }
            }
          });
        });
        $(document).on("click", ".add_variant_image", function(e) {
          let pid = $(this).attr('data-pid');
          let vid = $(this).attr('data-vid');
          let url = '<?= $this->Url->build(['controller' => 'ProductMedia', 'action' => 'getProductMedia']) ?>/' + pid + '/' + vid;
          $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
              $("#variant_image_ajax_response").html(response);
              $("#dz_pid").val(pid)
              $("#dz_vid").val(vid)
              $("#addVariantImageModal").modal();
              console.log(response);
            }
          });
          e.preventDefault();
        });
        $("#save_variant_image").click(function(e) {
          let images_id = '';
          let image = '';
          let pid = $("#dz_pid").val();
          let vid = $("#dz_vid").val();
          $(".imagecheck-input").each(function() {
            if ($(this).prop('checked') == true) {
              images_id += $(this).prop('value') + ",";
              html = $(this)[0].nextElementSibling.innerHTML;
              html = html.replace('class="imagecheck-image"', 'width="42px" height="42px" style="cursor:pointer" class="img-thumbnail add_variant_image" data-pid="' + pid + '" data-vid="' + vid + '"');
              // console.log($(this)[0].nextElementSibling.innerHTML);
            }
          });
          images_id = images_id.substring(0, images_id.length - 1);
          $("#variant_image_" + vid).val(images_id);
          $("#variant_display_img_" + vid).html(html);
          // $("#variant_image_id").html(image);
        });
        var show_variants = function(show) {
          if (show) {
            $('#optionsfields').show();
            $('#pricefields').hide();
            $('#skufields').hide();
            $('#weightfields').hide();
          } else {
            $('#optionsfields').hide();
            $('#pricefields').show();
            $('#skufields').show();
            $('#weightfields').show();
          }
        };
        $('#hasvariations').click(function() {
          if ($(this).is(":checked")) {
            show_variants(true);
          } else {
            show_variants(false);
          }
        });
        $('#product-type').selectize({
          create: true,
          sortField: 'text'
        });
        $('#tags').selectize({
          delimiter: ',',
          persist: false,
          create: function(input) {
            return {
              value: input,
              text: input
            }
          }
        });
        optionhtml = $('#optionhtml').clone(true, true);
        var opcount = 1;
        var delclick = function() {
          $(this).closest('div[class^="col-sm-6"]').prev('.optvalclass').remove();
          $(this).closest('div[class^="col-sm-6"]').prev('.optclass').remove();
          $(this).closest('div[class^="col-sm-6"]').remove();
        };
        var optionsel = {
          create: true,
          sortField: 'text'
        };
        var optvalsel = {
          delimiter: ',',
          persist: false,
          create: function(input) {
            return {
              value: input,
              text: input
            }
          }
        };
        var addOption = function(opdata) {
          opcount++;
          optionid = 'option' + opcount;
          optionvalueid = 'optionvalues' + opcount;
          $('#optionhtml').append(optionhtml.html().replace("optionvalues1", optionvalueid).replace("option1", optionid).replace('style="display:none"', ''));
          //alert(opdata.options);
          if (opdata.options != '') {
            var optionExists = ($('#' + optionid + ' option[value=' + opdata.options + ']').length > 0);
            if (!optionExists) {
              $('#' + optionid).append("<option value='" + opdata.options + "'>" + opdata.options + "</option>");
            }
          }
          $('#' + optionid).val(opdata.options);
          $('#' + optionvalueid).val(opdata.optionvalues);
          $('#' + optionid).selectize(optionsel);
          $('#' + optionvalueid).selectize(optvalsel);
          $('.removehtml').click(delclick);
        };
        $('#addoptionbtn').click(function() {
          addOption({
            id: '',
            options: '',
            optionvalues: ''
          });
        });
        $('.removehtml').click(delclick);
        $('.del_variant').click(function() {
          var r = confirm("Are you sure you want delete this variant ?");
          if (r == true) {
            vl = $(this).attr('data-id');
            $('#deleted_variants').val(function(i, val) {
              return val + (!val ? '' : ',') + vl;
            });
            $(this).closest("tr").remove();
          }
        });
        <?php if (isset($product->product_options) &&  sizeof($product->product_options) > 0) :  ?>
          /*
          <?php foreach ($product->product_options as $key => $prodctOption) : ?>
            <?php if ($key > 0) : ?>
            addOption({
                id:'',
                options:'<?= $prodctOption->option_name ?>',
                optionvalues:'<?= $prodctOption->option_values ?>'
            });
            <?php else : ?>
            var optionExists = ($('#option1 option[value=<?= $prodctOption->option_name ?>]').length > 0);
            if(!optionExists)
            {
                $('#option1').append("<option value='<?= $prodctOption->option_name ?>'><?= $prodctOption->option_name ?></option>");
            }
            $('#option1').val('<?= $prodctOption->option_name ?>');
            $('#optionvalues1').val('<?= $prodctOption->option_values ?>');
            <?php endif; ?>
            <?php endforeach; ?>
*/
          $('#hasvariations').prop('checked', true).attr("disabled", true);
          $('#hasvariations').closest("div").hide();
          show_variants(true);
          $('#optionsfields').hide();
        <?php else : ?>
          show_variants(false);
        <?php endif;
        ?>
        $('#option1').selectize(optionsel);
        $('#optionvalues1').selectize(optvalsel);
      });
    });
  </script>
  <?php //debug($product->product_variants->_getMedias); 
  ?>
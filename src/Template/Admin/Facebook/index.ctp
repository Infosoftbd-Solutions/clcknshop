<?php
    $feedRoot = \Cake\Routing\Router::url('feed/facebook', true);
    $feedUrl = \Cake\Routing\Router::url('feed/facebook/all', true);
?>
<div class="card card-aside">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <h2><?= __('Facebook Shop Feed URL') ?></h2>

                <form id="feed_generate_form" class="border p-5 mr-lg-5" style="padding-top: 40px !important;">
                    <div class="form-group px-3">
                        <div class="row">
                            <div class="col-4">
                                <label for="collection"><?= __('Filter By Collection') ?></label>
                            </div>
                            <div class="col-8">
                                <select name="collection" id="collection" class="form-control">
                                    <option value="all"><?= __('All Collection') ?> </option>
                                    <?php foreach ($categories as $key => $value): ?>
                                        <option value="<?= $key ?>"><?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group px-3">
                        <div class="row">
                            <div class="col-4">
                                <label for="product_type"><?= __('Filter By Product Type') ?></label>
                            </div>
                            <div class="col-8">
                                <select name="product_type" id="product_type" class="form-control">
                                    <option value=""><?= __('All Product') ?></option>

                                    <?php foreach ($product_types as $key => $value): ?>
                                        <option value="<?= $key ?>"><?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group px-3">
                        <div class="row">
                            <div class="col-4">
                                <label for="tag"><?= __('Filter By Product Tag') ?></label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="tag" id="tag" class="form-control" placeholder="<?= __('samsung') ?>">
                            </div>
                        </div>
                    </div>


                    <div class="form-group px-3">
                        <div class="row">
                            <div class="col-4">
                                <label for="keyword"><?= __('Search By Keyword') ?></label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="<?= __('samsung') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group px-3">
                        <div class="row">
                            <div class="col-4">
                                <label for="range"><?= __('Filter By Price Range') ?></label>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                    <input min="1" type="number" class="form-control" id="from" placeholder="100">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">-</span>
                                    </div>
                                    <input min="1" type="number" class="form-control" id="to" placeholder="1000">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="form-group px-3">
                        <div class="row">
                            <div class="col-4">
                                <label for="limit"><?= __('Limit Filter Result') ?></label>
                            </div>
                            <div class="col-8">
                                <input type="number" min="1" max="10000" value="1000" name="limit" id="limit" class="form-control" placeholder="100">
                            </div>
                        </div>
                    </div>


                    <div class="form-group px-3">
                        <input type="submit" value="Generate Feed URL" class="btn btn-block btn-primary">
                    </div>
                </form>

            </div>
            <div class="col-lg-4 pt-5 d-flex align-items-center">
                <div class="form-group">
                    <label class="badge badge-success pull-right" style="cursor: pointer" id="copy_to_clipboard"><?= __('Copy to clipboard') ?></label>
                    <textarea id="feed" cols="40" rows="10" class="form-control"><?= $feedUrl ?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>



<!--<div class="card card-aside">
    <div class="card-body">
        <div class="d-flex align-items-center mt-auto">
            <div>
                <h2>Associate Facebook Account</h2>
                <small class="d-block text-muted"> Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. </small>
            </div>
            <div class="ml-auto text-muted text-center mr-5">
                <?php if (!$facebook): ?>
                    <a href="<?= $loginUrl ?>" class="btn btn-primary"><i class="fa fa-facebook"></i> Linked with
                        Facebook Account</a>
                <?php else: $fb_data = json_decode($facebook->value, true); ?>
                    <div class="avatar avatar-lg mr-3"
                         style="background-image: url(<?= $fb_data['user_pro_pic'] ?>)"></div>
                    <br>
                    <a href="" class="text-default"><?= $fb_data['userName'] ?></a>
                    <small class="d-block text-muted"> <?= $fb_data['userEmail'] ?> </small>
                    <a href="javascript:void(0)" id="disconnect_account" class="btn btn-sm btn-outline-danger">Disconnect
                        Account</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
-->

<?php if (isset($facebook)): ?>

    <div class="card card-aside">
        <div class="card-body">
            <div class="d-flex align-items-center mt-auto">
                <div>
                    <h2><?= __('Associate Business Manager') ?></h2>
                    <small class="d-block text-muted"> <?= __('Lorem Ipsum is simply dummy text of the printing and typesetting industry.') ?> </small>
                </div>
                <div class="ml-auto text-muted text-center mr-5">
                    <?php if (!isset($fb_data['business_id'])): ?>
                        <button id="linkedBusinessAccount" class="btn btn-primary"><i class="fa fa-user"></i> 
                        <?= __('Linked with your business Manager') ?>
                        </button>
                    <?php else: ?>
                        <div class="avatar avatar-lg mr-3"
                             style="background-image: url(<?= $fb_data['user_pro_pic'] ?>)"></div>
                        <br>
                        <a href="javascript:void(0)" class="text-default"><?= $fb_data['business_name'] ?></a>
                        <small class="d-block text-muted"> </small>
                        <button id="linkedBusinessAccount" class="btn btn-sm btn-outline-danger">
                        <?= __('Change Business Manager') ?>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>







<?php if (isset($fb_data['business_id'])) : ?>

    <div class="card card-aside">
        <div class="card-body">
            <div class="d-flex align-items-center mt-auto">
                <div>
                    <h2><?= __('Associate Facebook Page') ?></h2>
                    <small class="d-block text-muted"> <?= __("Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s") ?> </small>
                </div>
                <div class="ml-auto text-muted text-center mr-5">
                    <?php if (!isset($fb_data['page_id'])): ?>
                        <button id="linkedBusinessPage" class="btn btn-primary"><i class="fa fa-facebook"></i> 
                            <?= __('Linked with your business Page') ?>
                        </button>
                    <?php else: ?>
                        <div class="avatar avatar-lg mr-3"
                             style="background-image: url(<?= $fb_data['page_pro_pic'] ?>)"></div>
                        <br>
                        <a href="javascript:void(0)" class="text-default"><?= $fb_data['page_name'] ?></a>
                        <small class="d-block text-muted"> </small>
                        <button id="linkedBusinessPage" class="btn btn-sm btn-outline-danger"> <?= __('Change Business Page') ?>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>


<?php if (isset($facebook) && isset($fb_data['page_id'])): ?>
    <div class="row row-cards">
        <div class="col-sm-6 col-lg-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3">
                      <i class="fa fa-cubes"></i>
                    </span>
                    <div>
                        <?php if (isset($fb_data['cat_id'])): ?>
                            <h4 class="m-0"><a
                                        href="javascript:void(0)"><small><?= $fb_data['cat_name'] ?></small></a><span
                                        style="font-size: 12px !important;" class="text-muted"> (<?= __('Catalog') ?>)</span></h4>
                            <small class="text-muted"><?= $fb_data['cat_id'] ?></small>
                        <?php else: ?>
                            <button id="linkedCatalog" class="btn btn-outline-primary btn-sm edit-addr">
                                <span class="fa fa-edit"></span> <?= __('Connect with Catalog') ?>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3">
                      <i class="fa fa-rss"></i>
                    </span>
                    <div>
                        <?php if (isset($fb_data['feed_id'])): ?>
                            <h4 class="m-0"><a href="javascript:void(0)">
                                    <small><?= $fb_data['feed_name'] ?></small></a></h4>
                            <small class="text-muted"><?= $fb_data['feed_id'] ?></small>
                        <?php else: ?>
                            <button class="btn btn-outline-success btn-sm edit-addr">
                                <span class="fa fa-warning"></span> <?= __('No feed connected your page.') ?>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-red mr-3">
                      <i class="fa fa-rss"></i>
                    </span>

                    <div>
                        <?php if (isset($fb_data['pixel_id'])): ?>
                            <h4 class="m-0 inline"><a href="javascript:void(0)">
                                    <small><?= $fb_data['pixel_name'] ?></small></a> <span
                                        style="font-size: 12px !important;" class="text-muted"></span></h4>
                            <small class="text-muted"><?= $fb_data['pixel_id'] ?></small>
                        <?php else: ?>
                            <button id="linkedPixel" class="btn btn-outline-danger btn-sm edit-addr">
                                <span class="fa fa-edit"></span>  <?= __('Connect with pixel') ?>
                            </button>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>


<?php endif; ?>


<!-- Modal -->
<div class="modal fade" id="changeBusinessManager" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <?= $this->Form->create(null, ['action' => 'businessManager']) ?>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?= __('Select Your Business Manager') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <select required id="business_option_response" name="data" class="custom-select">

                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><?= __('Submit') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>


<!-- Modal -->
<div class="modal fade" id="changeFbPage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <?= $this->Form->create(null, ['action' => 'pages']) ?>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?= __('Select your shop page') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <select required id="page_option_response" name="data" class="custom-select">

                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><?= __('Submit') ?> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>


<!-- Modal -->
<div class="modal fade" id="changePixel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <?= $this->Form->create(null, ['action' => 'pixel']) ?>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?= __('Select Your Pixel') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <select required id="pixel_option_response" name="data" class="custom-select">

                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><?= __('Submit') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>


<!-- Modal -->
<div class="modal fade" id="changeCatalog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <?= $this->Form->create(null, ['action' => 'catalog']) ?>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?= __('Select Your Catalog') ?> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <select required id="catalog_option_response" name="data" class="custom-select">

                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><?= __('Submit') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>


<script>
    require(['jquery'], function ($, selectize) {
        $(document).ready(function () {

            var feed_root = "<?= $feedRoot ?>";

            $("#copy_to_clipboard").click(function(e){
                $("#feed").select();
                document.execCommand("copy");
            });


            $("#feed_generate_form").submit(function(e){
                e.preventDefault();
                var feed_url = feed_root;
                feed_url += "/" + $("#collection").val() +"?";

                var product_type = $("#product_type").val().trim();
                if (product_type.length > 0){
                    feed_url += "product-type=" + product_type + "&";
                }


                var tag = $("#tag").val().trim();
                if (tag.length > 0){
                    feed_url +="tag=" + tag + "&";
                }

                var keyword = $("#keyword").val().trim();
                if (keyword.length > 0){
                    feed_url += "q=" +keyword + "&";
                }

                var from = $("#from").val().trim();
                var to = $("#to").val().trim();
                if (from.length > 0 && to.length > 0){
                    feed_url += "price-range=" +from + "-" + to + "&";
                }

                var limit = $("#limit").val().trim();
                if (limit.length > 0){
                    feed_url += "limit=" +limit + "&";
                }

                if (feed_url.substr(-1, 1) == "?" || feed_url.substr(-1, 1) == "&"){
                    feed_url = feed_url.substring(0, feed_url.length - 1);
                }

                $("#feed").val(feed_url);
                console.log(feed_url);
            })





            $("#changeBusinessManager form").submit(function (e) {
                let v = $('#changeBusinessManager select[name="data"] option:selected').val();
                if (v == 0) e.preventDefault(v);
            });
            $("#changeFbPage form").submit(function (e) {
                let v = $('#changeFbPage select[name="data"] option:selected').val();
                if (v == 0) e.preventDefault(v);
            });

            $("#changeCatalog form").submit(function (e) {
                let v = $('#changeCatalog select[name="data"] option:selected').val();
                if (v == 0) e.preventDefault(v);
            });

            $("#changePixel form").submit(function (e) {
                let v = $('#changePixel select[name="data"] option:selected').val();
                if (v == 0) e.preventDefault(v);
            });

            let catUrl = "<?= $this->Url->build(['action' => 'catalog']) ?>";
            $("#linkedCatalog").click(function (e) {
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: catUrl,
                    type: 'GET',
                    // dataType: 'json', // added data type
                    success: function (response) {
                        $("#catalog_option_response").html(response);
                        $("#changeCatalog").modal();
                        $("#overlay").fadeOut(300);
                    }
                });
                e.preventDefault();
            });


            let pixelUrl = "<?= $this->Url->build(['action' => 'pixel']) ?>";
            $("#linkedPixel").click(function (e) {
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: pixelUrl,
                    type: 'GET',
                    // dataType: 'json', // added data type
                    success: function (response) {
                        $("#pixel_option_response").html(response);
                        $("#changePixel").modal();
                        $("#overlay").fadeOut(300);
                    }
                });
                e.preventDefault();
            });

            let routeUrl = "<?= $this->Url->build(['action' => 'businessManager']) ?>";
            $("#linkedBusinessAccount").click(function (e) {
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: routeUrl,
                    type: 'GET',
                    // dataType: 'json', // added data type
                    success: function (response) {
                        $("#business_option_response").html(response);
                        $("#changeBusinessManager").modal();
                        $("#overlay").fadeOut(300);
                    }
                });
                e.preventDefault();
            });


            let pageRouteUrl = "<?= $this->Url->build(['action' => 'pages']) ?>";
            $("#linkedBusinessPage").click(function (e) {
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: pageRouteUrl,
                    type: 'GET',
                    // dataType: 'json', // added data type
                    success: function (response) {
                        console.log(response);
                        $("#page_option_response").html(response);
                        $("#changeFbPage").modal();
                        $("#overlay").fadeOut(300);
                    }
                });
                e.preventDefault();
            });

            //let catRouteUrl = "<?//= $this->Url->build(['action'=>'catalog']) ?>//";
            //$("#linkedWithCatalog").click(function (e) {
            //    $("#overlay").fadeIn(300);
            //    $.ajax({
            //        url: catRouteUrl,
            //        type: 'GET',
            //        // dataType: 'json', // added data type
            //        success: function (response) {
            //            console.log(response);
            //            $("#catalog_option_response").html(response);
            //            $("#changeCatalog").modal();
            //            $("#overlay").fadeOut(300);
            //        }
            //    });
            //    e.preventDefault();
            //});

            let url = "<?= $this->Url->build(['action' => 'delete']) ?>";
            $("#disconnect_account").click(function (e) {
                $("#overlay").fadeIn(300);
                $.ajax({
                    url: url,
                    type: 'GET',
                    // dataType: 'json', // added data type
                    success: function (response) {
                        console.log(response);
                        if (response.status == 'true') window.location.reload();
                    }
                });
                e.preventDefault();
            });


        });

    })
</script>

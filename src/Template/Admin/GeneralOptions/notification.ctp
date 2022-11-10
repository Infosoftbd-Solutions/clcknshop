<?php
use Cake\Core\Configure;
echo $this->Html->css('/assets/css/lightbox.min.css'); ?>
<?php //pr($mail_notification); ?>
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



<div class="page-header justify-content-between">
    <h1 class="page-title">
        <?=  __('Notification Settings') ?>
    </h1>
</div>


<?= $this->Form->create(null, ['controller' => 'GeneralOptions', 'action' => 'notification']) ?>
<div class="row">
    <div class="col-lg-3">
        <h3 class="card-title"><?=  __('Mail Notifications') ?></h3>
        <p></p>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <input type="hidden" name="key" value="mail_notification">
                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="value[order_placed_from_store_cus_notify]"
                        <?= isset($mail_notification->order_placed_from_store_cus_notify) ? 'checked' : ''?>
                            class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"><?=  __('Customer Notify when order placed from storefront.') ?>
                        </span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="value[order_placed_from_store_admin_notify]" 
                        <?= isset($mail_notification->order_placed_from_store_admin_notify) ? 'checked' : ''?>
                        class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"><?=  __('Admin Notify when order placed from storefront.') ?>
                        </span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="value[order_placed_from_admin_pos_cus_notify]"
                        <?= isset($mail_notification->order_placed_from_admin_pos_cus_notify) ? 'checked' : ''?>
                            class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"><?=  __('Customer Notify when order placed from admin and POS.') ?>
                        </span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="value[order_processing_cus_notify]"
                        <?= isset($mail_notification->order_processing_cus_notify) ? 'checked' : ''?>
                        class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"> <?=  __('Customer Notify when order status processing.') ?> </span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="value[order_shipped_cus_notify]"
                        <?= isset($mail_notification->order_shipped_cus_notify) ? 'checked' : ''?>
                        class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"> <?=  __('Customer Notify when order status shipped.') ?></span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="value[order_delivered_cus_notify]"
                        <?= isset($mail_notification->order_delivered_cus_notify) ? 'checked' : ''?>
                        class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"> <?=  __('Customer Notify when order status delivered.') ?></span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="value[order_cancelled_cus_notify]" 
                        <?= isset($mail_notification->order_cancelled_cus_notify) ? 'checked' : ''?>
                        class="custom-switch-input">

                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"> <?=  __('Customer Notify when order status cancelled.') ?> </span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="value[payment_received_from_store_cus_notify]"
                        <?php isset($mail_notification->payment_received_from_store_cus_notify) ? 'checked' : ''?>
                            class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"> <?=  __('Customer Notify when payment received from storefront.') ?>
                        </span>
                    </label>
                </div>
                <input type="submit" value="Save Mail Settings" class="btn  btn-sm btn-outline-primary">
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>

<?= $this->Form->create(null, ['controller' => 'GeneralOptions', 'action' => 'notification']) ?>
<div class="row">
    <div class="col-lg-3">
        <h3 class="card-title"><?=  __('SMS Notifications') ?></h3>
        <p></p>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <input type="hidden" name="key" value="sms_notification">
                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="value[order_placed_from_store_cus_notify]"
                        <?= isset($sms_notification->order_placed_from_store_cus_notify) ? 'checked' : ''?>
                            class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"><?=  __('Customer Notify when order placed from storefront.') ?>
                        </span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="value[order_placed_from_store_admin_notify]" 
                        <?= isset($sms_notification->order_placed_from_store_admin_notify) ? 'checked' : ''?>
                        class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"><?=  __('Admin Notify when order placed from storefront.') ?>
                        </span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="value[order_placed_from_admin_pos_cus_notify]"
                        <?= isset($sms_notification->order_placed_from_admin_pos_cus_notify) ? 'checked' : ''?>
                            class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"><?=  __('Customer Notify when order placed from admin and POS.') ?>
                        </span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="value[order_processing_cus_notify]"
                        <?= isset($sms_notification->order_processing_cus_notify) ? 'checked' : ''?>
                        class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"> <?=  __('Customer Notify when order status processing.') ?> </span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="value[order_shipped_cus_notify]"
                        <?= isset($sms_notification->order_shipped_cus_notify) ? 'checked' : ''?>
                        class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"> <?=  __('Customer Notify when order status shipped.') ?></span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="value[order_delivered_cus_notify]"
                        <?= isset($sms_notification->order_delivered_cus_notify) ? 'checked' : ''?>
                        class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"> <?=  __('Customer Notify when order status delivered.') ?></span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="value[order_cancelled_cus_notify]" 
                        <?= isset($sms_notification->order_cancelled_cus_notify) ? 'checked' : ''?>
                        class="custom-switch-input">

                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"> <?=  __('Customer Notify when order status cancelled.') ?> </span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="value[payment_received_from_store_cus_notify]"
                        <?= isset($sms_notification->payment_received_from_store_cus_notify) ? 'checked' : ''?>
                            class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"> <?=  __('Customer Notify when payment received from storefront.') ?>
                        </span>
                    </label>
                </div>

                <input type="submit" value="Save SMS Settings" class="btn  btn-sm btn-outline-primary">
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>


<?= $this->Form->create(null, ['controller' => 'GeneralOptions', 'action' => 'smsContent']) ?>
<div class="row">
    <div class="col-lg-3">
        <h3 class="card-title"><?=  __('SMS Content') ?></h3>
        <p></p>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body" id="textarea">
                
                <div class="form-group">
                        <input type="hidden" name="key[]" value="sms_con_order_placed">
                        <label class="form-label"><?=  __('Content for order placed') ?></label>
                        <textarea required name="value[]" class="form-control char-count" rows="5"><?= Configure::read('App.sms_con_order_placed') != null  ? Configure::read('App.sms_con_order_placed') : '' ?></textarea>
                        <div class="content-info pull-right text-right"></div>
                </div>
                <div class="form-group">
                        <input type="hidden" name="key[]" value="sms_con_order_processing">
                        <label class="form-label"><?=  __('Content for order processing') ?></label>
                        <textarea required name="value[]" class="form-control char-count" rows="5"><?= Configure::read('App.sms_con_order_processing') != null  ? Configure::read('App.sms_con_order_processing') : '' ?></textarea>
                        <div class="content-info pull-right text-right"></div>
                </div>
                

                <div class="form-group">
                        <input type="hidden" name="key[]" value="sms_con_order_shipped">
                        <label class="form-label"><?=  __('Content for order shipped') ?></label>
                        <textarea required name="value[]" class="form-control char-count" rows="5"><?= Configure::read('App.sms_con_order_shipped') != null  ? Configure::read('App.sms_con_order_shipped') : '' ?></textarea>
                        <div class="content-info pull-right text-right"></div>
                </div>
                
                <div class="form-group">
                        <input type="hidden" name="key[]" value="sms_con_order_delivered">
                        <label class="form-label"><?=  __('Content for order delivered') ?></label>
                        <textarea required name="value[]" class="form-control char-count" rows="5"><?= Configure::read('App.sms_con_order_delivered') != null  ? Configure::read('App.sms_con_order_delivered') : '' ?></textarea>
                        <div class="content-info pull-right text-right"></div>
                </div>


                <div class="form-group">
                        <input type="hidden" name="key[]" value="sms_con_order_cancelled">
                        <label class="form-label"><?=  __('Content for order cancelled') ?></label>
                        <textarea required name="value[]" class="form-control char-count" rows="5"><?= Configure::read('App.sms_con_order_cancelled') != null  ? Configure::read('App.sms_con_order_cancelled') : '' ?></textarea>
                        <div class="content-info pull-right text-right"></div>
                </div>
                
                <input type="submit" value="Save SMS Content" class="btn  btn-sm btn-outline-primary">
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>



<script>

require(['jquery'], function ($, selectize) {
        $(document).ready(function () {
            
            setTimeout(() => {
                $("#textarea textarea").each(function(item, index){
                    $(this).trigger('keyup')
                });    
            }, 500);
            
            
            //let perSMS = 160;
            $(".char-count").keyup(function(){
                let val = $(this).val();
                let max_limit = isUnicode(val) ? 1005 : 2095;
                if(isUnicode(val) && val.length <= 70){
                    perSMS = 70;
                }

                else if(isUnicode(val) && val.length > 70){
                    perSMS = 67;
                }
               
                else if(val.length > 160){
                    perSMS = 153;
                }
                else{
                    perSMS = 160;
                }


                 
                if(val.length > max_limit){
                    $(this).val(val.substring(0, max_limit));
                    $(this).trigger('keyup');
                } 

                let info = val.length + " Characters | "+ (max_limit - val.length) +" Characters Left | " + Math.ceil(val.length / perSMS ) + " SMS (" + perSMS + " Char./SMS)";

                $(this).next(".content-info").text(info);
                
                // <div style="float: right"> <span class="charleft contacts-count">49 Characters | 956 Characters Left</span><span class="parts-count">| 1 SMS (70 Char./SMS)</span></div>
            });


            function isUnicode(str) {
                for (var i = 0, n = str.length; i < n; i++) {
                    //if (str.charCodeAt( i ) > 255 && str.charCodeAt( i )!== 8364 ) 
                    if (str.charCodeAt(i) > 255
                        || str.charCodeAt(i) == 91
                        || str.charCodeAt(i) == 92
                        || str.charCodeAt(i) == 93
                        || str.charCodeAt(i) == 94
                        || str.charCodeAt(i) == 123
                        || str.charCodeAt(i) == 124
                        || str.charCodeAt(i) == 125
                        || str.charCodeAt(i) == 126
                    ) { return true; }
                }

                return false;
            }
        });

        
});

</script>
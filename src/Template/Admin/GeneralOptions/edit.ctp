
<script>
    require.config({
        shim: {
            'lightbox': ['jquery']
        },
        paths: {
            'lightbox': 'assets/js/lightbox.min'
        }
    });
</script>
<?= $this->Form->create(null, ['controller' => 'GeneralOptions', 'action' => 'edit','type' => 'file']) ?>

<div class="page-header justify-content-between">
    <h1 class="page-title">
        <?= __('General options / Settings') ?>
    </h1>
    <input type="submit" value="Save Changes" class="btn btn-primary" style="float: right">
</div>

<div class="row">
    <div class="col-lg-3">
        <h3 class="card-title"><?= __('Store Information') ?></h3>
        <p><?= __('Enter your basic store information like store title, currency, email, phone etc.') ?></p>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label"><?= __('Store Title') ?></label>
                    <input type="text" name="store[title]" required class="form-control" placeholder="<?= __('Type your store title') ?>" value="<?= isset($store['title']) ? $store['title'] : '' ?>">
                </div>
               


                <div class="form-group mb-3">
                    <label class="form-label"><?= __('Store Currency') ?></label>
                    <input type="text" name="currency"  required class="form-control" placeholder="<?= __('Type your store title') ?>" value="<?= isset($currency) ? $currency : '&#2547;' ?>">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label"><?= __('Phone') ?></label>
                    <input type="text" name="store[phone]" required class="form-control" placeholder="<?= __('Phone number, use comma for multiple') ?>" value="<?= isset($store['phone']) ? $store['phone'] : '' ?>">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label"><?= __('Email') ?></label>
                    <input type="text" name="store[email]" required class="form-control" placeholder="<?= __('Type  email address') ?>" value="<?= isset($store['email']) ? $store['email'] : '' ?>">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label"><?= __('Web') ?></label>
                    <input type="text" name="store[web]" required class="form-control" placeholder="<?= __('Type Website Url') ?>" value="<?= isset($store['web']) ? $store['web'] : '' ?>">
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group mb-3">
                            <label class="form-label"><?= __('Store Logo') ?></label>
                            <input type="file"  name="logo" class="form-control" style="border: none">
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <?php $logo = empty($logo) ? '' : $logo ?>
                        <?= $this->Media->image(LOGO_PATH.$logo, ['height' => '64']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group mb-3">
                            <label class="form-label"><?= __('Store Favicon') ?></label>
                            <input type="file" name="favicon" class="form-control" style="border: none">
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <?php $favicon = empty($favicon) ? '' : $favicon ?>
                        <?= $this->Media->image(LOGO_PATH.$favicon) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <h3 class="card-title"><?= __('Store Address') ?></h3>
        <p><?= __('Enter your Store address information.') ?></p>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label"><?= __('Address') ?></label>
                            <textarea name="store[address]" required class="form-control" placeholder="<?= __('Address') ?>"><?= isset($store['address']) ? $store['address'] : '' ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label"><?= __('Area') ?></label>
                            <input type="text" name="store[area]"  required class="form-control" placeholder="<?= __('Area') ?>" value="<?= isset($store['area']) ? $store['area'] : '' ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-3">
                            <label class="form-label"><?= __('City') ?></label>
                            <input type="text" name="store[city]" required class="form-control" placeholder="<?= __('City') ?>" value="<?= isset($store['city']) ? $store['city'] : '' ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-3">
                            <label class="form-label"><?=  __('Post Code') ?></label>
                            <input type="text" name="store[post_code]" required class="form-control" placeholder="<?= __('Post Code') ?>" value="<?= isset($store['post_code']) ? $store['post_code'] : '' ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-3">
                            <label class="form-label"><?=  __('Country') ?></label>
                            <input type="text" name="store[country]" required class="form-control" placeholder="<?= __('Country') ?>" value="<?= isset($store['country']) ? $store['country'] : '' ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <h3 class="card-title"><?= __('Mail Settings') ?></h3>
        <p><?= __('Enter your mailing server information to send email form your mail server') ?></p>
    </div>

    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" <?= isset($mail['smtp']) ? "checked" : "" ?> value="1"  class="custom-control-input" name="has_smtp" id="smptChackBox">
                        <span class="custom-control-label"><?=  __('Do you have SMTP(Mail Sever) Information') ?> ?</span>
                    </label>
                </div>

                <div id="smtp" class="d-block">
                    <div class="row">

                        <?= $this->Form->hidden('mail[smtp][className]', ['value' => 'Smtp']) ?>
                        <?= $this->TablerForm->control("mail[smtp][host]", ['label' => __('SMTP Host'),  'row'=> 6,'required', 'value' => isset($mail['smtp']['host']) ? $mail['smtp']['host'] : ""]) ?>
                        <?= $this->TablerForm->control("mail[smtp][port]", ['label' => __('SMTP Port'),  'row'=> 3,'required', 'value' => isset($mail['smtp']['port']) ? $mail['smtp']['port'] : ""]) ?>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label><?=  __('SMTP TLS') ?></label>
                                <select class="form-control" name="mail[smtp][tls]">
                                    <option <?= (isset($mail['smtp']['tls']) && $mail['smtp']['tls'] == 1) ? 'selected' : '' ?>  value="1"><?=  __('True') ?></option>
                                    <option <?= (isset($mail['smtp']['tls']) && $mail['smtp']['tls'] == 0)? 'selected' : '' ?>  value="0"><?=  __('False') ?></option>
                                </select>
                            </div>
                        </div>

                        <?= $this->TablerForm->control("mail[smtp][username]", ['label' => __('SMTP Username'),  'row'=> 6, 'required', 'value' => isset($mail['smtp']['username']) ? $mail['smtp']['username'] : ""]) ?>
                        <?= $this->TablerForm->control("mail[smtp][password]", ['label' => __('SMTP Password'),  'row'=> 6, 'required', 'value' => isset($mail['smtp']['password']) ? $mail['smtp']['password'] : ""]) ?>
                    </div>
                </div>

                <div class="row">
                    <?= $this->TablerForm->control("mail[sender_name]", ['label' => __('SMTP Sender Name'), 'row'=> 6, 'value' => isset($mail['sender_name']) ? $mail['sender_name'] : ""]) ?>
                    <?= $this->TablerForm->control("mail[sender_email]", ['label' => __('SMTP Sender Email'), 'row'=> 6,  'value' => isset($mail['sender_email']) ? $mail['sender_email'] : ""]) ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-3">
        <h3 class="card-title"><?=  __('Login and Checkout Settings') ?></h3>
        
    </div>
    <?php  if(!isset($login) )
     $login['allow_anon_ckt'] = 'on'; ?>

    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <?= $this->Form->hidden('login[garbage]', ['value' => 'garbage']) ?>
                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="login[allow_anon_ckt]"
                            <?= isset($login['allow_anon_ckt']) ? "checked" : ""  ?>
                               class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"><?=  __('Allow Anonymous Checkout') ?>
                        </span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox" name="login[one_page_checkout]"
                            <?= isset($login['one_page_checkout']) ? "checked" : ""  ?>
                               class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"><?=  __('One Page Checkout') ?>
                        </span>
                    </label>
                </div>


                <div class="form-group">
                    <label class="custom-switch">
                        <input type="checkbox"  name="login[use_otp_login]"
                               <?= isset($login['use_otp_login']) ? "checked" : ""  ?>
                               class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description"><?= __("Use OTP One Time Password Login system.") ?>
                        </span>
                    </label>
                </div>

                <div class="form-footer text-right">
                    <button type="submit" class="btn btn-primary"><?=  __('Save Changes') ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->Form->end() ?>




<script>

    require(['jquery'], function ($, selectize) {
        $(document).ready(function () {
            if($("#smptChackBox").prop("checked") == false){
                $("#smtp").removeClass('d-block');
                $("#smtp").addClass('d-none');
                $("#smtp input").each(function (index) {
                    $(this).attr('required', false);
                });
            }

            $("#smptChackBox").change(function (e) {
                console.log("Change event call");

                if($(this).prop("checked") == true){
                    $("#smtp").removeClass('d-none');
                    $("#smtp").addClass('d-block');

                    $("#smtp input").each(function (index) {
                        $(this).attr('required', true);
                    });

                }
                else{
                    $("#smtp").removeClass('d-block');
                    $("#smtp").addClass('d-none');
                    $("#smtp input").each(function (index) {
                        $(this).attr('required', false);
                    });

                }

            })
        });
    });




</script>

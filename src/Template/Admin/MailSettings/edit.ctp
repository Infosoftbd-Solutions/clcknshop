<?php echo $this->Html->css('/assets/css/lightbox.min.css'); ?>


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

<div class="row">
    <div class="card">
        <div class="card-header d-print-none">
            <h3 class="card-title"><?= __('General Options') ?></h3>
            <div class="card-options">

            </div>
        </div>

        <?= $this->Form->create(null, ['controller' => 'MailSettings', 'action' => 'edit']) ?>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <table class="table table-borderless">
                        <tbody>
                        <?= $this->Form->hidden('name', ['value' => 'mail']) ?>
                        <tr>
                            <th width="15%"><?= __('SMTP Host') ?></th>
                            <td><?= $this->TablerForm->control("smtp[host]", ['label' => false, 'required', 'value' => isset($smtp['host']) ? $smtp['host'] : ""]) ?></td>

                        </tr>
                        <tr>
                            <th width="10%"><?= __('SMTP Port') ?></th>
                            <td><?= $this->TablerForm->control("smtp[port]", ['label' => false, 'required', 'value' => isset($smtp['port']) ? $smtp['port'] : ""]) ?></td>

                        </tr>

                        <tr>
                            <th width="10%"><?= __('SMTP Username') ?></th>
                            <td><?= $this->TablerForm->control("smtp[username]", ['label' => false, 'required', 'value' => isset($smtp['username']) ? $smtp['username'] : ""]) ?></td>

                        </tr>

                        <tr>
                            <th width="10%"><?= __('SMTP Password') ?></th>
                            <td><?= $this->TablerForm->control("smtp[password]", ['label' => false, 'required', 'value' => isset($smtp['password']) ? $smtp['password'] : ""]) ?></td>

                        </tr>
                        <tr>
                            <th width="10%"><?= __('SMTP TLS') ?></th>
                            <td>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <select class="form-control" name="smtp[tls]">
                                                <option <?= (isset($smtp['tls']) && $smtp['tls'] == 1) ? 'selected' : '' ?>  value="1">True</option>
                                                <option <?= (isset($smtp['tls']) && $smtp['tls'] == 0)? 'selected' : '' ?>  value="0">False</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div  class="text-right">
                                            <input type="submit" class="btn btn-primary" value="Save Changes">
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <?=  $this->Form->end() ?>

    </div>

</div>


<script>

    require(['jquery'], function ($, selectize) {
        $(document).ready(function () {

        });
    });




</script>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="<?=$this->Url->build('/favicon.ico');?>" />
    <!-- Generated: 2019-04-04 16:55:45 +0200 -->
    <title><?= __('Clcknshop admin interface') ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">

    <?php echo $this->Html->script('/assets/js/require.min.js'); ?>

    <script>
        requirejs.config({
            baseUrl: '<?=$this->Url->build('/');?>'
        });


    </script>
    <!-- Dashboard Core -->

    <?php echo $this->Html->css('/assets/css/dashboard.css'); ?>
    <?php echo $this->Html->script('/assets/js/dashboard.js'); ?>

    <?php //echo $this->Html->css('/assets/css/jquery.toast.min.css'); ?>
    <?php //echo $this->Html->script('/assets/js/jquery.toast.min.js'); ?>


    <!-- c3.js Charts Plugin -->
    <?php //echo $this->Html->css('/assets/plugins/charts-c3/plugin.css'); ?>
    <?php //echo $this->Html->script('/assets/plugins/charts-c3/plugin.js'); ?>

    <!-- Google Maps Plugin -->
    <?php //echo $this->Html->css('/assets/plugins/maps-google/plugin.css'); ?>
    <?php //echo $this->Html->script('/assets/plugins/maps-google/plugin.js'); ?>
    <!-- Input Mask Plugin -->
    <?php echo $this->Html->script('/assets/plugins/input-mask/plugin.js'); ?>

    <!-- Datatables Plugin -->
    <?php //echo $this->Html->script('/assets/plugins/datatables/plugin.js'); ?>
    <?php //echo $this->Html->css('custom.css'); ?>
</head>
<body class="">
<div class="page">
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    <div class="text-center">
                        <?= $this->Flash->render() ?>

                        <h3><?= \Cake\Core\Configure::read('App.store_title') ?></h3>
                        <!--                        <img src="assets/images/logo/logo.png" class="h-6" alt="">-->
                    </div>

                    <div class="card">
                        <?= $this->Form->create(null, ['url'=>['controller' => 'Users', 'action'=> 'resetPassword'], 'id'=>['login-form']]) ?>
                        <div class="card-body p-6">
                            <div class="card-title text-center"><?= __('Reset Password') ?></div>
                            <div class="form-group">
                                <label class="form-label"><?= __('Email') ?></label>
                                <input type="text" name="email" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?= __('Enter your phone number') ?>">
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-block"><?= __('Send Me New Password') ?></button>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>

                    <!--<div class="text-center text-muted">
                        Don't have account yet? <a href="./register.html">Sign up</a>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>



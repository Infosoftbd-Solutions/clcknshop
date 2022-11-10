<?php
use Cake\Core\Configure;
?>
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
        <title><?=Configure::read('App.store_title',"Clcknshop")?></title>
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

    <!-- Input Mask Plugin -->
     <?php echo $this->Html->script('/assets/plugins/input-mask/plugin.js'); ?>
  </head>
  <body>
    <div class="page">
      <div class="flex-fill">
        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="<?=$this->Url->build('/');?>">
                <!--<img src="./demo/brand/tabler.svg" class="header-brand-img" alt="tabler logo"> -->
                  <?php
                  $logo = Configure::read('App.logo');
                  if (empty($logo) == false && file_exists(LOGO_PATH.$logo)){
                      echo $this->Html->image(\Cake\Routing\Router::url(LOGO_PATH.$logo, true),['height'=>'36px']);
                  }else{
                      echo Configure::read('App.store_title',"Clcknshop");
                  }

                  ?>


              </a>
              <div class="d-flex order-lg-2 ml-auto">
                  <?php
                        $session = $this->getRequest()->session();
                        if ($session->read('customer_logged_in')):
                   ?>
                  <div class="dropdown">
                      <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                          <span class="avatar" style="background-image: url(https://cdn3.iconfinder.com/data/icons/business-avatar-1/512/3_avatar-512.png)"></span>
                          <span class="ml-2 d-none d-lg-block">
                          <span class="text-default"><?php echo $session->check('customer')? $session->read('customer')->first_name." ".$session->read('customer')->last_name : 'Jhon Doe' ?></span>
                          <small class="text-muted d-block mt-1">Customer</small>
                    </span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="<?= $this->Url->build(['controller'=> 'Customers', 'action' => 'index']) ?>">
                              <i class="dropdown-icon fe fe-user"></i> Dashboard
                          </a>
                          <!--
                              <a class="dropdown-item" href="#">
                                  <span class="float-right"><span class="badge badge-primary">6</span></span>
                                  <i class="dropdown-icon fe fe-mail"></i> Inbox
                              </a>
                           -->

                          <?php if($this->request->params['action'] != "trackOrder"): ?>
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePassword">
                                  <i class="dropdown-icon fe fe-lock"></i> Change Password
                              </a>
                          <?php endif; ?>

                          <a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'Customers', 'action' => 'logout']) ?>">
                              <i class="dropdown-icon fe fe-log-out"></i> Sign out
                          </a>
                      </div>
                  </div>
                  <?php endif; ?>

              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div>

        <div class="my-3 my-md-5">
            <div class="container">
                             <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
      </div>

      <footer class="footer">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
              <div class="row align-items-center">
                <div class="col-auto">

                </div>
                <div class="col-auto">
                <!--  <a href="https://github.com/tabler/tabler" class="btn btn-outline-primary btn-sm">Source code</a> -->
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Copyright &copy; <?=date('Y')?> <?=Configure::read('App.store_title',"Clcknshop")?>. All rights reserved.
            </div>
          </div>
        </div>
      </footer>
    </div>


  </body>
</html>

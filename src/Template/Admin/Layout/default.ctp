<?php
use Cake\Core\Configure;
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="<?=$this->shop->favicon('/favicon.ico');?>" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="<?=$this->shop->favicon('/favicon.ico');?>" />
    <!-- Generated: 2019-04-04 16:55:45 +0200 -->
    <title><?=Configure::read('App.store_title',"Clcknshop");?> <?=  __('admin interface') ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <?php echo $this->Html->script('/assets/js/require.min.js'); ?>

    <script>
    requirejs.config({
        baseUrl: '<?=$this->Url->build('/');?>'
    });
    </script>
    <!-- Dashboard Core -->

    <?php echo $this->Html->css('/assets/css/dashboard.css'); ?>
    <?php echo $this->Html->script('/assets/js/dashboard.js'); ?>

    <?php echo $this->Html->css('/assets/css/jquery.toast.min.css'); ?>
    <?php echo $this->Html->css('/assets/css/flatpickr.min'); ?>
    <?php echo $this->Html->css('/assets/css/placeholder-loading.min.css'); ?>




    <?php //echo $this->Html->css('custom.css'); ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />

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


    
</head>

<body class="">
    <span id="full_screen_editor"></span>
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    <div class="page">
        <div class="flex-fill">
            <div class="header py-4">
                <div class="container">
                    <div class="d-flex">
                        <a class="header-brand" href="<?=$this->Url->build('/admin');?>">                            
                            <?php if(empty(Configure::read('App.logo'))): ?>
                                <?=Configure::read('App.store_title',"Clcknshop");?> 
                            <?php else: ?>
                                 <img class ="header-brand-img" src="<?=$this->Shop->logo()?>" />
                            <?php endif; ?>
                                    
                        </a>
                        <div class="d-flex order-lg-2 ml-auto">
                            <div class="nav-item d-none d-md-flex">
                                <a href="<?=$this->Url->build('/');?>" class="btn btn-sm btn-outline-primary"
                                    target="_blank"><?php echo __('Visit Live Store'); ?></a>
                            </div>
                          
                            <?php
                        $user = $this->request->getsession()->read('user');
                        //pr($user);
                        $name = $user['first_name'] . " " . $user['last_name'];
                        $logo = substr($user['first_name'], 0, 1) . substr($user['last_name'], 0, 1);

                  ?>
                            <div class="dropdown">
                                <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                    <span class="avatar" style="background-image: url()"> <?= $logo ?> </span>
                                    <span class="ml-2 d-none d-lg-block">
                                        <span class="text-default"></span>
                                        <small class="text-muted d-block mt-1"><?= $name ?> </small>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item"
                                        href="<?= $this->Url->build(['controller' => 'users', 'action' => 'profile']) ?>">
                                        <i class="dropdown-icon fe fe-user"></i> <?=  __('Profile') ?>
                                    </a>


                                    <a class="dropdown-item"
                                        href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'index']) ?>">
                                        <i class="dropdown-icon fe fe-send"></i> <?=  __('Message') ?>
                                    </a>



                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="https://www.clcknshop.com/contact">
                                        <i class="dropdown-icon fe fe-help-circle"></i> <?=  __('Need help') ?>?
                                    </a>
                                    <a class="dropdown-item"
                                        href="<?= $this->Url->build(['controller'=>'Users', 'action' => 'logout']) ?>">
                                        <i class="dropdown-icon fe fe-log-out"></i> <?=  __('Sign out') ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse"
                            data-target="#headerMenuCollapse">
                            <span class="header-toggler-icon"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 ml-auto">
                            <form action="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index']) ?>"
                                method="get">
                                <div class="input-icon my-3 my-lg-0">
                                    <input type="search" name="order_id" class="form-control header-search"
                                        placeholder="<?= __('Search Orders') ?>" tabindex="1">
                                    <div class="input-icon-addon">
                                        <i class="fe fe-search"></i>
                                    </div>
                                </div>
                                <input type="hidden" name="search" value="order_show_by_id">
                            </form>
                        </div>
                        <div class="col-lg order-lg-first">
                            <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                                <li class="nav-item">
                                    <a href="<?=$this->Url->build(['controller'=>'orders','action'=>'dashboard']);?>"
                                        class="nav-link"><i class="fe fe-home"></i> <?=  __('Home') ?></a>
                                </li>
                                <?php if($this->request->getSession()->read('user_super_admin')==true):  ?>
                                 <li class="nav-item dropdown">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i
                                            class="fe fe-shopping-cart"></i> <?= __('Stores') ?></a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                        <?=$this->Html->link(__('All Stores'), ['controller'=>'stores','action'=>'index'],['class'=>'dropdown-item'])?>
                                         <?=$this->Html->link(__('Manage Themes'), ['controller'=>'stores','action'=>'manageTheme'],['class'=>'dropdown-item'])?>
                                       

                                    </div>
                                </li>
                                <?php endif; ?>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i
                                            class="fe fe-database"></i> <?=  __('Products') ?></a>
                                    <div class="dropdown-menu dropdown-menu-arrow">

                                        <?=$this->Html->link(__('All Products'), ['controller'=>'products','action'=>'index'],['class'=>'dropdown-item'])?>
                                        <?=$this->Html->link(__('Collections'), ['controller'=>'categories','action'=>'index'],['class'=>'dropdown-item'])?>
                                        <?=$this->Html->link(__('Inventroy'), ['controller'=>'products','action'=>'inventory'],['class'=>'dropdown-item'])?>
                                        <?=$this->Html->link(__('Reviews'), ['controller'=>'reviews','action'=>'index'],['class'=>'dropdown-item'])?>
                                        <?=$this->Html->link(__('Discount/Promotion'), ['controller'=>'Coupons','action'=>'index'],['class'=>'dropdown-item'])?>

                                    </div>

                                </li>
                                <li class="nav-item dropdown">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i
                                            class="fe fe-calendar"></i> <?= __('Orders') ?></a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                        <?=$this->Html->link(__('All orders'), ['controller'=>'orders','action'=>'index'],['class'=>'dropdown-item'])?>
                                         <?=$this->Html->link(__('All Customers'), ['controller'=>'customers','action'=>'index'],['class'=>'dropdown-item'])?>
                                        <?=$this->Html->link(__('Draft Orders'), ['controller'=>'orders','action'=>'drafts'],['class'=>'dropdown-item'])?>
                                        <?=$this->Html->link(__('Order Transactions'), ['controller'=>'Transactions','action'=>'index'],['class'=>'dropdown-item'])?>

                                        <a class="dropdown-item" target="_blank" href="/pos"><?=  __('POS-Point of Sale') ?></a>

                                    </div>
                                </li>


                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i
                                            class="fe fe-file-text"></i> <?=  __('Reports') ?></a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                        <?=$this->Html->link(__('Finance Reports'), ['controller'=>'Reports','action'=>'finance'],['class'=>'dropdown-item'])?>
                                        <?=$this->Html->link(__('Daily Reports'), ['controller'=>'Reports','action'=>'dailyReports'],['class'=>'dropdown-item'])?>
                                        <?=$this->Html->link(__('Customer Reports'), ['controller'=>'Reports','action'=>'customerOrdersReports'],['class'=>'dropdown-item'])?>
                                        <?=$this->Html->link(__('Product Reports'), ['controller'=>'Reports','action'=>'productOrdersReports'],['class'=>'dropdown-item'])?>
                                        <?=$this->Html->link(__('Payment Reports'), ['controller'=>'Reports','action'=>'orderPaymentReports'],['class'=>'dropdown-item'])?>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i
                                            class="fe fe-settings"></i> <?= __('Settings') ?></a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                        <a href="<?php echo $this->Url->build(['controller' => 'GeneralOptions', 'action' => 'index']) ?>"
                                            class="dropdown-item "><?= __('General Options') ?></a>

                                        <a href="<?php echo $this->Url->build(['controller'=>'ShippingMethods', 'action' => 'index']) ?>"
                                            class="dropdown-item "><?= __('Shipping Method') ?></a>
                                        <!--<a href="<?php echo $this->Url->build(['controller'=>'ShippingZones', 'action' => 'index']) ?>" class="dropdown-item ">Shipping Zone</a> -->
                                        <a href="<?php echo $this->Url->build(['controller'=> 'PaymentMethods','action'=>'index']) ?>"
                                            class="dropdown-item "><?= __('Payment Methods') ?></a>
                                        <a href="<?php echo $this->Url->build(['controller'=> 'PaymentProcessor','action'=>'index']) ?>"
                                            class="dropdown-item "><?= __('Payment Processor') ?></a>
                                     
                                        <a href="<?php echo $this->Url->build(['controller' => 'GeneralOptions', 'action' => 'notification']) ?>"
                                            class="dropdown-item "><?= __('Notification Settings') ?></a>

                                 
                                        <a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>"
                                            class="dropdown-item "><?= __('User Management') ?></a>
                                        
                                        
                                    </div>
                                </li>



                                <li class="nav-item dropdown">
                                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i
                                            class="fe fe-command"></i> <?= __('Store Front') ?></a>
                                    <div class="dropdown-menu dropdown-menu-arrow">
                                        <a href="<?php echo $this->Url->build(['controller'=>'Themes', 'action' => 'index']) ?>"
                                            class="dropdown-item "><?= __('Theme') ?></a>
                                        <a href="<?php echo $this->Url->build(['controller'=>'Themes', 'action' => 'editor']) ?>"
                                            class="dropdown-item "><?= __('Theme Editor') ?></a>
                                        <a href="<?php echo $this->Url->build(['controller'=>'Themes', 'action' => 'assets']) ?>"
                                            class="dropdown-item "><?= __('Manage Assets') ?></a>
                                        <a href="<?php echo $this->Url->build(['controller'=>'Facebook', 'action' => 'index']) ?>"
                                            class="dropdown-item "><?= __('Facebook Integration') ?></a>
                                            

                                        <a href="<?php echo $this->Url->build(['controller'=>'WebMaster', 'action' => 'index']) ?>"
                                            class="dropdown-item "><?= __('Webmaster Tools') ?></a>
                

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-3 my-md-5">
                <div class="container">

                    <?= $this->Flash->render() ?>

                    <div id="flash_message" class="d-none"> </div>

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
                  <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item"><a target="_blank" href="//<?=ADMIN_DOMAIN?>/docs"><?= __('Documentation') ?></a></li>
                    <li class="list-inline-item"><a target="_blank" href="//<?=ADMIN_DOMAIN?>/page/faq"><?= __("FAQ") ?></a></li>
                  </ul>
                </div>
                <div class="col-auto">
                <!--  <a href="https://github.com/tabler/tabler" class="btn btn-outline-primary btn-sm">Source code</a> -->
                 </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                        <?= __('Copyright') ?> &copy; 2020 <a target="_blank" href="http://infosoftbd.com">Infosoftbd Solutions</a>.
                        <?= __("All rights reserved.") ?>
                    </div>

                </div>
            </div>
        </footer>
    </div>



</body>

</html>

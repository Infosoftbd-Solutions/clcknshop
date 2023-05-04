<?php

use Cake\Core\Configure;


    $storeJson = Configure::read('App.store');
    $store = json_decode($storeJson);

    $this->Tplparser->setTheme(Configure::read('App.theme'));

    $template_path = $this->Tplparser->compile("invoice/invoice.tpl");
    if($template_path == false) $template_path = "__default/invoice.ctp";

    $footer_path = $this->Tplparser->compile("invoice/invoice_footer.tpl");
    if($footer_path != false) $this->set('invoice_footer',$footer_path);
    
    include_once $template_path;


?>

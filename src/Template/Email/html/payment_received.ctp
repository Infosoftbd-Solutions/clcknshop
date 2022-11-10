<?php

use Cake\Core\Configure;

$this->Tplparser->setTheme(Configure::read('App.theme'));
$shipping_address = json_decode($order->shipping_address);

$template_path = $this->Tplparser->compile("email/payment_received.tpl");
if ($template_path === false) $template_path = "__default/payment_received.ctp";

include_once $template_path;



?>
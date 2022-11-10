<?php

use Cake\Core\Configure;

$this->Tplparser->setTheme(Configure::read('App.theme'));

$template_path = $this->Tplparser->compile("email/registration.tpl");
if ($template_path === false) $template_path =  "__default/registration.ctp";

include_once $template_path;


?>
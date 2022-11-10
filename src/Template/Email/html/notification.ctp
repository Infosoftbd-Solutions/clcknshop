<?php

use Cake\Core\Configure;

$this->Tplparser->setTheme(Configure::read('App.theme'));

$template_path = $this->Tplparser->compile("email/notification.tpl");
if ($template_path === false) $template_path = "__default/notification.ctp";

include_once $template_path;

?>
<?php

use Cake\Core\Configure;

$this->Tplparser->setTheme(Configure::read('App.theme'));

$template_path = $this->Tplparser->compile("email/newsletter.tpl");
if ($template_path === false) $template_path = EMAIL_DEFAULT. "__default/newsletter.ctp";

include_once $template_path;


?>
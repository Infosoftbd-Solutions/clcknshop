<?php

$template = $this->Tplparser->compile("thank_you.tpl");

$referer = $this->request->referer();
$this->assign('title_for_layout',"Thank you to purchase.");
if(!empty($template)){
  include_once $template;
}else{

  $this->assign("layout","checkout");
  include_once "__thank_you.ctp";
}

?>

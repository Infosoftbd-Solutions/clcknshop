<?php

$template = $this->Tplparser->compile("customer/add_customer.tpl");
$referer = $this->request->referer();
$this->assign('title_for_layout',"Customer login");
if(!empty($template)){
    include_once $template;
}else{
    $this->assign("layout","customer");
    include_once "__add_customer.ctp";
}

?>

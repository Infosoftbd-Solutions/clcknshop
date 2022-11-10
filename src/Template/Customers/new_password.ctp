<?php

$template = $this->Tplparser->compile("customer/new_password.tpl");
$this->assign('title_for_layout',"Customer password");
if(!empty($template)){
    include_once $template;
}else{

    $this->assign("layout","customer");
    include_once "__new_password.ctp";
}

?>

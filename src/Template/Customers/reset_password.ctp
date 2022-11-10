<?php

$template = $this->Tplparser->compile("customer/reset_password.tpl");
$this->assign('title_for_layout',"Customer reset password");
if(!empty($template)){
    include_once $template;
}else{

    $this->assign("layout","customer");
    include_once "__reset_password.ctp";
}

?>

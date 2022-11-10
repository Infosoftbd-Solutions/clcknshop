<?php
$template = $this->Tplparser->compile("customer/register.tpl");
$this->assign('title_for_layout',"Customer registration");
if(!empty($template)){
    include_once $template;
}else{
    $this->assign("layout","customer");
    include_once "__register.ctp";
}

?>

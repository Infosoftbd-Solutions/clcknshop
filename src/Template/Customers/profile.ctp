<?php

$template = $this->Tplparser->compile("customer/profile.tpl");
//pr($template);
$this->assign('title_for_layout',"Customer profile");
if(!empty($template)){
    include_once $template;
}else{

    $this->assign("layout","customer");
    include_once "__profile.ctp";
}

?>

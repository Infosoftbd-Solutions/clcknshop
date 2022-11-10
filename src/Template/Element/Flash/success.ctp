<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
$template = null;
if(empty($this->fetch("layout"))){
  $template = $this->Tplparser->compile("flash/success.tpl");
  if(empty($template)) $template = $this->Tplparser->compile("flash/default.tpl");
}
if(!empty($template)){
    $fclass = "success";
    include_once $template;
}else {
    include_once "__success.ctp";
}

?>

<?php
//echo $this->Blade->render("/layout.ctp",['title'=>$this->fetch('title'),'content_for_layout'=>$this->fetch('content')]);
$content_for_layout = $this->fetch('content');
if(!empty($this->fetch("layout")))
   include_once $this->fetch("layout") . ".ctp";
else
  include_once $this->Tplparser->compile("layout.tpl");
?>

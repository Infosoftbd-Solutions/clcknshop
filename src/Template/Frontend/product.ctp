<?php

if ($product){
    foreach($product->product_variants as $option){
      $option->option_values_obj = json_decode($option->option_values);
    }

    $this->assign('title_for_layout',$product->title);
}

if($this->request->is('ajax'))
  include_once $this->Tplparser->compile("product_ajax.tpl");
else
  include_once $this->Tplparser->compile("product.tpl");


?>

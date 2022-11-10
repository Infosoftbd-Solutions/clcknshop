<?php
$cart_total = 0;
foreach($cart_products as $product){
    $product->title = substr($product->title, 0, 40);
    $cart_total += (float) $product->total;
}
$cart_total = number_format($cart_total, 2);
$this->assign('title_for_layout',"Shopping cart");

if($this->request->is('ajax'))
  include_once $this->Tplparser->compile("cart_ajax.tpl");
else
  include_once $this->Tplparser->compile("cart.tpl");
?>

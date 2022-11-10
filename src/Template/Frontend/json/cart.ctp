<?php
$cart_total = 0;
foreach($cart_products as $product){

    $cart_total += (float) $product->total;
}
$cart_total = number_format($cart_total, 2);
$cart_count = sizeof($cart_products);


if($this->request->is('ajax'))
  include_once $this->Tplparser->compile("cart_ajax.tpl");
else
  include_once $this->Tplparser->compile("cart.tpl");
?>

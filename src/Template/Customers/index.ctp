<?php
$badge = [0 => 'badge-primary', 1 => 'badge-info', 2 => 'badge-warning', 3 => 'badge-success', 4 => 'badge-danger', 5 => 'badge-secondary'];
$order_statuses = [0 => 'Pending', 1 => 'Processing', 2 => 'Shipped', 3 => 'Delivered', 4 => 'Cancelled', 5 => 'Payment'];

foreach ($customer->orders as $order){
    $order->link = $this->Url->build(['controller' => 'Checkout', 'action' => 'trackOrder', $order->order_id, $order->order_password]);
}

$template = $this->Tplparser->compile("customer/dashboard.tpl");
if(!empty($template)){
    include_once $template;
}else{
    $this->assign("layout","customer");
    include_once "__dashboard.ctp";
}

?>

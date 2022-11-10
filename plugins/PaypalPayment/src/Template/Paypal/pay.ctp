 <style type="text/css">
.preloader{
display: flex;
align-items: center;
justify-content: center;
position: fixed;
top: 0;
width: 100%;
height: 100%;
background: #f5f7fb; 
z-index: 9999;
  
}
</style>

 <!-- Preloader -->
<div id="preloader"  class="container preloader flex-column align-items-center justify-content-center">
<div class="row">
<div class="spinner-border text-primary" role="status"></div>
</div>
<div class="row">
<strong id="loading_message"><?=__('Please wait while we are redirecting to paypal payment website.')?></strong>
</div>
</div>
<div class="container">       
        <form id="PaypalForm" action="https://www.<?=($options->sandbox == 1)?'sandbox.':''?>paypal.com/cgi-bin/webscr"
            method="post" target="_top">
            <input type='hidden' name='business' value='<?=$options->email?>'> 
            <input type='hidden' name='item_name' value='OrderPayment'> 
            <input type='hidden' name='item_number' value='<?=$order->id?>'>
            <input type='hidden' name='amount' value='<?=$order->order_total?>'>
            <input type='hidden' name='no_shipping' value='1'> 
            <input type='hidden' name='currency_code' value='<?=$options->currency?>'> 
            <input type='hidden' name='notify_url'
                value='<?=$this->Url->build('/paypal-payment/notify/' . $order->id,true)?>'>
            <input type='hidden' name='cancel_return'
                value='<?=$this->Url->build('/paypal-payment/cancel/' . $order->id,true)?>'>
            <input type='hidden' name='return'
                value='<?=$this->Url->build('/paypal-payment/return/' . $order->id,true)?>'>
            <input type="hidden" name="cmd" value="_xclick">
            <input type="submit" name="pay_now" id="pay_now"
                Value="Pay Now" style="display:none">
        </form>
    </div>

    <script>
require(['jquery'], function ($) {
        $(document).ready(function () {
            $( "#PaypalForm" ).submit();
        });
});    

    </script>
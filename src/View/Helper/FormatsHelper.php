<?php
namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;
use Cake\View\View;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\Exceptions\BarcodeException;

/**
 * TablerForm helper
 */
class FormatsHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    protected $_order_statuses = [0=>'Pending',1=>'Processing',2=>'Shipped',3=>'Delivered',4=>'Cancelled'];
    protected  $badge = [0 => 'badge-primary', 1 => 'badge-info', 2 => 'badge-warning', 3 => 'badge-success', 4 => 'badge-danger', 5 => 'badge-secondary'];


    public function getOrderStatuses($list = false){
      $statuses = $this->_order_statuses;
      if($list){
          $statuses = array();
//          if ($all) $statuses[] =['value'=>"",'text'=>"All"];
            foreach($this->_order_statuses as $key=>$status)
                $statuses[] = ['value'=>$key,'text'=>$status];

      }
      return $statuses;
    }
    public function getOrderStatus($status_id){
      if(isset($this->_order_statuses[$status_id]))
       return $this->_order_statuses[$status_id];
       else
       return "";
    }

    public function getOrderStatusBadge($status_id){
        if(isset($this->badge[$status_id]))
            return $this->badge[$status_id];
        else
            return "success";
    }

    public function limit($string, $limit = 50){
        return substr($string, 0, $limit);
    }

    public function numberFormat($number=0, $decimals=2)
    {
        return number_format($number, $decimals);
    }
 
    public function moneyFormat($amount, $skipZero = true,$decimals=2){
      
        if (empty($amount)){
            return $skipZero ? '' : $this->moneySymbol() . 0;
        }else if($decimals > 0 && is_numeric($amount) ){
          $amount = number_format($amount, $decimals);
        }
      return $this->moneySymbol() . $amount;
    }
    public function moneySymbol(){
        return Configure::read('App.currency','TK');
    }



    public function tokenTruncate($string, $your_desired_width) {
    /*  $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
      $parts_count = count($parts);

      $length = 0;
      $last_part = 0;
      for (; $last_part < $parts_count; ++$last_part) {
        $length += strlen($parts[$last_part]);
        if ($length > $your_desired_width) {  break; }
      }

      return (implode(array_slice($parts, 0, $last_part))) . (($last_part < $parts_count)?"...":"");*/

      return mb_strimwidth($string,0,$your_desired_width,'...','utf-8');
    }

    public function split($str,$sep=','){
      return explode($sep,$str);
    }

    public function barcode($data, $height = 70, $widthFactor = 2)
    {
        $barcode = new BarcodeGeneratorPNG();
        try {
            return '<img src="data:image/png;base64,' . base64_encode($barcode->getBarcode($data, $barcode::TYPE_CODE_128, $widthFactor, $height)) . '">';
        } catch (BarcodeException $e) {

        }
        return "";
    }
    public function json_encode($obj,$add_slash = false)
    {
      if($add_slash)
        return addslashes(json_encode($obj));
      else
        return json_encode($obj);
    }

    public function mul()
    {
        $result = 1;
        $args = func_get_args();
        foreach ($args as $arg)
            $result *= (float) $arg;

        return $result;
    }

    function year(){
        return Date('Y');
    }

    public function increment($amount=0, $increment = 1)
    {
        return $amount + $increment;
    }

    public function printProductHiddenFields($product){
      $product_input = '<input type="hidden" name="product_id" id="product_id" value="' . $product->id . '" >';
      if(sizeof($product->product_variants) > 0){
        $product_input .= '<select name="variant_id" id="variant_id"   style="visibility:hidden;position:absolute">';
        $product_input .= '<option value="0" data-opt=\'{}\' option-name="{}">Select an option</option>';
        foreach($product->product_variants as $variant){
          $product_input .= '<option  value=" ' . $variant->id .  ' " data-opt=\'' . $this->json_encode($variant) . '\'  option-name=\'' . $variant->option_values . '\'>' . $variant->option_text . '</option>';
        }
        $product_input .= "</select>";

      }
      return $product_input;
    }

    public function printProductOptions($product){
      $options_input = "";
      foreach($product->product_options as $option){
        $options_input .= '<select class="product_options"  data-name="' . $option->option_name . '" name="option[' . $option->option_name . ']" id="option_' . $option->option_name . '" style="visibility:hidden;position:absolute">';
        foreach($this->split($option->option_values) as $option_value)
          $options_input .= '<option value="' . $option_value . '">' . $option_value . '</option>';
        $options_input .="</select>";
      }
      return $options_input;
    }


}

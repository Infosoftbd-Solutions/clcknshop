<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * ProductVariant Entity
 *
 * @property int $id
 * @property int $products_id
 * @property string $option_values
 * @property float|null $price
 * @property float|null $cost
 * @property float|null $compare_price
 * @property string|null $sku
 * @property string|null $barcode
 * @property bool|null $track_inventory
 * @property bool|null $sell_w_stock
 * @property int|null $q_available
 * @property bool|null $is_physical
 * @property float|null $weight
 * @property string|null $weight_unit
 * @property bool $active
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Product $product
 */
class ProductVariant extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'products_id' => true,
        'option_values' => true,
        'price' => true,
        'cost' => true,
        'compare_price' => true,
        'sku' => true,
        'barcode' => true,
        'track_inventory' => true,
        'sell_w_stock' => true,
        'q_available' => true,
        'is_physical' => true,
        'weight' => true,
        'weight_unit' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'product' => true,
    ];

    protected function _getMedias()
    {
        $variantMedia = TableRegistry::get('ProductMedia');
        return $variantMedia->find()->where(["variant_id"=>$this->id])->all();
    }


    protected function _getMedia()
    {
        $variantMedia = TableRegistry::get('ProductMedia');
        return $variantMedia->find()->where(["variant_id"=>$this->id])->first();
    }

    protected function _getDefaultImage()
    {
        $variantMedia = TableRegistry::get('ProductMedia');
        $default_image =  $variantMedia->find()->where(["variant_id"=>$this->id])->order(["default_image" => "DESC"])->first();
        return ($default_image) ? $default_image->path : "";
    }

    protected function _getImage(){
      return PRODUCT_IMAGE_PATH . $this->products_id . DS . $this->_getDefaultImage();
    }

    protected function _getOptionText(){
       $data = json_decode($this->option_values,true);
       $return  = array();
       foreach ($data as $key => $value) {
         $return[] = "$key : $value";
       }

       return implode(', ',$return);
    }
    protected function _getMaxStock(){
       if($this->sell_w_stock){
         return 0;
       }else{
         if($this->q_available <=0)
          return -1;
         else
            return $this->q_available;
       }
       return 0;
    }


}

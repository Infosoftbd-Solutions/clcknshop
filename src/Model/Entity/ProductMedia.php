<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

/**
 * ProductMedia Entity
 *
 * @property int $id
 * @property int $product_id
 * @property int $variant_id
 * @property string $path
 * @property string $caption
 * @property int $type
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $updated
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Variant $variant
 */
class ProductMedia extends Entity
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
        'product_id' => true,
        'variant_id' => true,
        'path' => true,
        'caption' => true,
        'type' => true,
        'created' => true,
        'updated' => true,
        'product' => true,
        'variant' => true,
    ];

    protected function _getImagepath(){
      return PRODUCT_IMAGE_PATH . $this->product_id . DS . $this->path;
    }
    protected function _getImage(){
      return PRODUCT_IMAGE_PATH . $this->product_id . DS . $this->path;
    }
    protected function _getImageUrl(){
        return Router::url('/' . PRODUCT_IMAGE_PATH . $this->product_id . DS . $this->path);
    }



}

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
/**
 * Product Entity
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $media
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
 * @property string $vendor
 * @property string $product_type
 * @property string $tags
 * @property bool $active
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Category[] $categories
 */
class Product extends Entity
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
        'title' => true,
        'description' => true,
        'overview' => true,
        'slug' => true,
        'media' => true,
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
        'vendor' => true,
        'product_type' => true,
        'tags' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'categories' => true,
    ];

    protected function _getVariantCount()
    {
        $productvariants = TableRegistry::get('ProductVariants');
        return $productvariants->find()->where(["products_id" => $this->id])->count();
    }

    protected function _getDefaultImage()
    {
        $productmedia = TableRegistry::get('ProductMedia');
        $default_image = $productmedia->find()->where(["product_id" => $this->id])->order(["default_image" => "DESC"])->first();

        return ($default_image) ? $default_image->path : "";
    }

    protected function _getRating()
    {
        $productReviews = TableRegistry::get('Reviews');
        $reviews = $productReviews->find()->select([
            'avg_rating' => 'AVG(rating)'
        ])->where(["product_id" => $this->id])->first();
        return $reviews ? (int) ceil($reviews->avg_rating) : 0;
        
    }

    protected function _getRatingTotal()
    {
        $productReviews = TableRegistry::get('Reviews');
        $reviews = $productReviews->find('all')->where(["product_id" => $this->id])->all();
         return count($reviews);
    }

    protected function _getImagepath(){
      return PRODUCT_IMAGE_PATH . $this->id . DS . $this->_getDefaultImage();
    }

    protected function _getImage(){
      return PRODUCT_IMAGE_PATH . $this->id . DS . $this->_getDefaultImage();
    }

    protected function _getLink(){
      return Router::url("/product/" . $this->slug);

    }

    protected function _getCartlink(){
      return Router::url("/add_to_cart") . "?product_id=" . $this->id;
    }
    protected function _getIsNew(){
      return ($this->created->isThisWeek());
/*  echo $time->isYesterday();
echo $time->isThisWeek();
echo $time->isThisMonth();
echo $time->isThisYear();*/

    }

    protected function _getOnSale(){
       return ($this->compare_price > 0);
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

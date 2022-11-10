<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderProduct Entity
 *
 * @property int $id
 * @property int $product_variants_id
 * @property int $products_id
 * @property int $orders_id
 * @property string|null $product_title
 * @property string $product_sku
 * @property string $product_options
 * @property float|null $product_price
 * @property int|null $product_quantity
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\ProductVariant $product_variant
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Order $order
 */
class OrderProduct extends Entity
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
        'product_variants_id' => true,
        'products_id' => true,
        'orders_id' => true,
        'product_title' => true,
        'product_sku' => true,
        'product_options' => true,
        'product_price' => true,
        'product_quantity' => true,
        'product_weight' => true,
        'product_is_digital' => true,
        'created' => true,
        'modified' => true,
        'product_variant' => true,
        'product' => true,
        'order' => true,
        'product_image' => true,
    ];
}

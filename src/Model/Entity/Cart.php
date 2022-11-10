<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cart Entity
 *
 * @property int $id
 * @property int $product_variants_id
 * @property int $products_id
 * @property int|null $quantity
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\ProductVariant $product_variant
 * @property \App\Model\Entity\Product $product
 */
class Cart extends Entity
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
        'customers_id' => true,
        'cart_session' => true,
        'quantity' => true,
        'created' => true,
        'modified' => true,
        /*'product_variant' => true,
        'product' => true,*/
    ];
}

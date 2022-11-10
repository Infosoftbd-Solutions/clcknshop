<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductVariantValue Entity
 *
 * @property int $id
 * @property int $product_options_id
 * @property int $product_variants_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\ProductOption $product_option
 * @property \App\Model\Entity\ProductVariant $product_variant
 */
class ProductVariantValue extends Entity
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
        'product_options_id' => true,
        'product_variants_id' => true,
        'created' => true,
        'modified' => true,
        'product_option' => true,
        'product_variant' => true,
    ];
}

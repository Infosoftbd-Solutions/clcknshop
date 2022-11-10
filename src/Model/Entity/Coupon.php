<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Coupon Entity
 *
 * @property int $id
 * @property string $title
 * @property string $coupon_code
 * @property string $coupon_conditions
 * @property \Cake\I18n\FrozenTime $start_date
 * @property \Cake\I18n\FrozenTime $end_date
 * @property bool $discount_type
 * @property float $discount
 * @property float $max_amount
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Coupon extends Entity
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
        'coupon_code' => true,

        'customer_selection_type' => true,
        'customers' => true,
        'products' => true,
        'product_selection_type' => true,
        'start_date' => true,
        'end_date' => true,
        'discount_type' => true,
        'discount_amount' => true,
        'max_amount' => true,
        'min_purchase_amount' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
    ];
}

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Review Entity
 *
 * @property int $id
 * @property int $product_id
 * @property int $customer_id
 * @property int $rating
 * @property string $comment
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $updated
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Customer $customer
 */
class Review extends Entity
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
        'id' => true,
        'product_id' => true,
        'customer_id' => true,
        'rating' => true,
        'comment' => true,
        'status' => true,
        'created' => true,
        'updated' => true,
        'product' => true,
        'customer' => true,
    ];
}

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InventoryLog Entity
 *
 * @property int $id
 * @property int $product_id
 * @property int $variant_id
 * @property int $prev_inventory
 * @property int $current_inventory
 * @property string $comment
 * @property int $order_id
 * @property int $users_id
 * @property int $created
 * @property int $modified
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Variant $variant
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\User $user
 */
class InventoryLog extends Entity
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
        'prev_inventory' => true,
        'current_inventory' => true,
        'comment' => true,
        'order_id' => true,
        'users_id' => true,
        'created' => true,
        'modified' => true,
        'product' => true,
        'variant' => true,
        'order' => true,
        'user' => true,
    ];
}

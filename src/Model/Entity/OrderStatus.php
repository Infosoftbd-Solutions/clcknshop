<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderStatus Entity
 *
 * @property int $id
 * @property int $orders_id
 * @property string|null $notes
 * @property int|null $status_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $updated
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\Status $status
 */
class OrderStatus extends Entity
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
        'orders_id' => true,
        'notes' => true,
        'status_id' => true,
        'created' => true,
        'updated' => true,
        'order' => true,
        'status' => true,
    ];
}

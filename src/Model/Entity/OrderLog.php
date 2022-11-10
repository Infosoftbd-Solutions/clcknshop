<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderLog Entity
 *
 * @property int $id
 * @property int $orders_id
 * @property string $order_status
 * @property string $notes
 * @property int $added_by
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Order $order
 */
class OrderLog extends Entity
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
        'order_status' => true,
        'notes' => true,
        'added_by' => true,
        'created' => true,
        'order' => true,
    ];
}

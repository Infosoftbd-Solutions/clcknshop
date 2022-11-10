<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transaction Entity
 *
 * @property int $id
 * @property int $order_id
 * @property string $payment_data
 * @property bool $status
 *
 * @property \App\Model\Entity\Order $order
 */
class Transaction extends Entity
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
        'order_id' => true,
        'payment_data' => true,
        'transaction_number' => true,
        'status' => true,
        'order' => true,
        'payment_processor_id' => true,
    ];
}

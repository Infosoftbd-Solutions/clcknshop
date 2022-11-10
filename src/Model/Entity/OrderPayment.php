<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderPayment Entity
 *
 * @property int $id
 * @property int $orders_id
 * @property float $amount
 * @property \Cake\I18n\FrozenTime $payment_date
 * @property int $payment_method
 * @property string|null $comments
 * @property \Cake\I18n\FrozenTime $created_at
 *
 * @property \App\Model\Entity\Order $order
 */
class OrderPayment extends Entity
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
        'amount' => true,
        'payment_date' => true,
        'payment_method' => true,
        'comments' => true,
        'created' => true,
        'order' => true,
    ];
}

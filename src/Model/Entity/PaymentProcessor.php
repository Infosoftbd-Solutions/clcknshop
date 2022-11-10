<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PaymentProcessor Entity
 *
 * @property int $id
 * @property int $payment_method_id
 * @property string $name
 * @property string $image
 * @property string $options
 * @property bool $status
 *
 * @property \App\Model\Entity\PaymentMethod $payment_method
 */
class PaymentProcessor extends Entity
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
        'payment_method_id' => true,
        'name' => true,
        'image' => true,
        'options' => true,
        'status' => true,
        'payment_method' => true,
        'instruction_image' => true,
        'class' => true,
    ];
}

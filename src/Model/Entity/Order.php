<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int $shipping_methods_id
 * @property int $payment_methods_id
 * @property int $customers_id
 * @property string|null $billing_address
 * @property string|null $shipping_address
 * @property float|null $sub_total
 * @property float|null $discount
 * @property float|null $shipping_fee
 * @property float $taxes
 * @property float $order_total
 * @property string|null $notes
 * @property string|null $stuff_notes
 * @property int|null $order_status
 * @property \Cake\I18n\FrozenTime|null $order_date
 * @property int|null $shipping_weight
 * @property string|null $shipping_dimention
 * @property string|null $payment_reference
 * @property string|null $shipping_reference
 *
 * @property \App\Model\Entity\ShippingMethod $shipping_method
 * @property \App\Model\Entity\PaymentMethod $payment_method
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\OrderProduct[] $order_products
 */
class Order extends Entity
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
        'order_password' => true,
        'shipping_methods_id' => true,
        'payment_processor_id' => true,
        'customers_id' => true,
        'billing_address' => true,
        'shipping_address' => true,
        'sub_total' => true,
        'discount' => true,
        'shipping_fee' => true,
        'taxes' => true,
        'order_total' => true,
        'total_paid' => true,
        'notes' => true,
        'stuff_notes' => true,
        'order_status' => true,
        'order_date' => true,
        'shipping_weight' => true,
        'shipping_dimention' => true,
        'payment_reference' => true,
        'shipping_reference' => true,
        'draft' => true,
        'shipping_method' => true,
        'payment_method' => true,
        'customer' => true,
        'order_products' => true,
    ];

  protected function _getDue()
   {
       return (($this->order_total - $this->total_paid) > 0)?$this->order_total - $this->total_paid:0;
   }
}

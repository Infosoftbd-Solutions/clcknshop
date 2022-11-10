<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomerAddress Entity
 *
 * @property int $id
 * @property int $customers_id
 * @property bool $is_primary
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $address
 * @property string|null $apartment
 * @property string|null $city
 * @property string|null $post_code
 * @property string|null $country
 * @property string|null $phone
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Customer $customer
 */
class CustomerAddress extends Entity
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
        'customers_id' => true,
        'is_primary' => true,
        'first_name' => true,
        'last_name' => true,
        'address' => true,
        'apartment' => true,
        'city' => true,
        'post_code' => true,
        'country' => true,
        'phone' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
    ];
}

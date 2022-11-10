<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customer Entity
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $passwd
 * @property string $address
 * @property string $apartment
 * @property string $city
 * @property string $post_code
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\CustomerAddress[] $customer_addresses
 * @property \App\Model\Entity\CustomerAddress $primary_address
 */
class Customer extends Entity
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
        'first_name' => true,
        'last_name' => true,
        'username' => true,
        'email' => true,
        'phone' => true,
        'passwd' => true,
        'address' => true,
        'area' => true,
        'city' => true,
        'post_code' => true,
        'country' => true,
        'created' => true,
        'modified' => true,
        'customer_addresses' => true,
        'primary_address' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'passwd',
    ];
}

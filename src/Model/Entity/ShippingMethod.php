<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ShippingMethod Entity
 *
 * @property int $id
 * @property string|null $name
 * @property float $price
 * @property bool $flat_rate
 * @property string $zone_id
 * @property int $status
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Zone $zone
 */
class ShippingMethod extends Entity
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
        'name' => true,
        'price' => true,
        'flat_rate' => true,
//        'zones' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
//        'zone' => true,
    ];
}

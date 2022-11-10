<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SmsHistory Entity
 *
 * @property int $id
 * @property string $mobile
 * @property string $message
 * @property \Cake\I18n\FrozenTime $sent_time
 * @property int $status
 * @property \Cake\I18n\FrozenTime|null $created
 */
class SmsHistory extends Entity
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
        'submitted_id' => true,
        'mobile' => true,
        'message' => true,
        'sent_time' => true,
        'status' => true,
        'created' => true,
    ];
}

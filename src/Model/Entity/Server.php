<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Server Entity
 *
 * @property int $id
 * @property string $server_ip
 * @property string $domain
 * @property string $api_url
 * @property string $site_token
 * @property string $encrypt_token
 * @property int $total_sites
 * @property int $priority
 * @property bool $disabled
 * @property \Cake\I18n\FrozenTime $created
 */
class Server extends Entity
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
        'server_ip' => true,
        'domain' => true,
        'api_url' => true,
        'site_token' => true,
        'encrypt_token' => true,
        'total_sites' => true,
        'priority' => true,
        'disabled' => true,
        'created' => true,
    ];
}

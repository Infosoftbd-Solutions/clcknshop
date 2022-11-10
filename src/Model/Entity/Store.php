<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
/**
 * Store Entity
 *
 * @property int $id
 * @property string $store_name
 * @property string $domain_name
 * @property int $servers_id
 * @property string $store_url
 * @property string $email
 * @property string $phone
 * @property \Cake\I18n\FrozenDate $expire_date
 * @property float $sms_balance
 * @property bool $disabled
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Server $server
 */
class Store extends Entity
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
        'store_name' => true,
        'domain_name' => true,
        'customers_id' => true,
        'store_url' => true,
        'expire_date' => true,
        'sms_balance' => true,
        'disabled' => true,
        'created' => true,
    ];

     protected function _getCustomer()
    {
        $customers = TableRegistry::get('Customers');
       
        return $customers->find('all')->where(["id" => $this->customers_id])->first();

    }
}

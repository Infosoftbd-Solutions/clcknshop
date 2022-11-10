<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Facebook Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $token
 * @property string $page_name
 * @property int $page_id
 * @property string $page_token
 * @property int $business_id
 * @property int $catalog_id
 * @property int $feed_id
 * @property string $feed_url
 * @property int|null $pixel_id
 * @property string|null $pixel_code
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $updated
 *
 * @property \App\Model\Entity\Page $page
 * @property \App\Model\Entity\Business $business
 * @property \App\Model\Entity\Catalog $catalog
 * @property \App\Model\Entity\Feed $feed
 * @property \App\Model\Entity\Pixel $pixel
 */
class Facebook extends Entity
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
        'email' => true,
        'token' => true,
        'page_name' => true,
        'page_id' => true,
        'page_token' => true,
        'business_id' => true,
        'catalog_id' => true,
        'feed_id' => true,
        'feed_url' => true,
        'pixel_id' => true,
        'pixel_code' => true,
        'created' => true,
        'updated' => true,
        'page' => true,
        'business' => true,
        'catalog' => true,
        'feed' => true,
        'pixel' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
//    protected $_hidden = [
//        'token',
//    ];
}

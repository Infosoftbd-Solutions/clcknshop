<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity
 *
 * @property int $id
 * @property int $categories_id
 * @property string|null $name
 * @property string|null $slug
 * @property string $description
 * @property string|null $match_with
 * @property string $image
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class Category extends Entity
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
        'categories_id' => true,
        'name' => true,
        'slug' => true,
        'description' => true,
        'manual_matching' => true,
        'match_cond' => true,
        'image' => true,
        'created' => true,
        'modified' => true,
    ];
}

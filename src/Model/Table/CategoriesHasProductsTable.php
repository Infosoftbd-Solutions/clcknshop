<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CategoriesHasProducts Model
 *
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\CategoriesHasProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\CategoriesHasProduct newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CategoriesHasProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CategoriesHasProduct|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CategoriesHasProduct saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CategoriesHasProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CategoriesHasProduct[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CategoriesHasProduct findOrCreate($search, callable $callback = null, $options = [])
 */
class CategoriesHasProductsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('categories_has_products');
        $this->setDisplayField('categories_id');
        $this->setPrimaryKey(['categories_id', 'products_id']);

        $this->belongsTo('Categories', [
            'foreignKey' => 'categories_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'products_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['categories_id'], 'Categories'));
        $rules->add($rules->existsIn(['products_id'], 'Products'));

        return $rules;
    }
}

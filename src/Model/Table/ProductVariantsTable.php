<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductVariants Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\ProductVariant get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductVariant newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProductVariant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductVariant|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductVariant saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductVariant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductVariant[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductVariant findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductVariantsTable extends Table
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

        $this->setTable('product_variants');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Products', [
            'foreignKey' => 'products_id',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('ProductMedia',[
            'className' => 'ProductMedia',
        ])->setForeignKey('variant_id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('option_values')
            ->maxLength('option_values', 255)
            ->requirePresence('option_values', 'create')
            ->notEmptyString('option_values');

        $validator
            ->decimal('price')
            ->allowEmptyString('price');

        $validator
            ->decimal('cost')
            ->allowEmptyString('cost');

        $validator
            ->decimal('compare_price')
            ->allowEmptyString('compare_price');

        $validator
            ->scalar('sku')
            ->maxLength('sku', 100)
            ->allowEmptyString('sku');

        $validator
            ->scalar('barcode')
            ->maxLength('barcode', 100)
            ->allowEmptyString('barcode');

        $validator
            ->boolean('track_inventory')
            ->allowEmptyString('track_inventory');

        $validator
            ->boolean('sell_w_stock')
            ->allowEmptyString('sell_w_stock');

        $validator
            ->nonNegativeInteger('q_available')
            ->allowEmptyString('q_available');

        $validator
            ->boolean('is_physical')
            ->allowEmptyString('is_physical');

        $validator
            ->decimal('weight')
            ->allowEmptyString('weight');

        $validator
            ->scalar('weight_unit')
            ->maxLength('weight_unit', 10)
            ->allowEmptyString('weight_unit');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmptyString('active');

        return $validator;
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
        $rules->add($rules->existsIn(['products_id'], 'Products'));

        return $rules;
    }
}

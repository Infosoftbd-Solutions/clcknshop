<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderProducts Model
 *
 * @property \App\Model\Table\ProductVariantsTable&\Cake\ORM\Association\BelongsTo $ProductVariants
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\BelongsTo $Orders
 *
 * @method \App\Model\Entity\OrderProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrderProduct newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrderProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderProduct|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderProduct saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrderProduct[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderProduct findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrderProductsTable extends Table
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

        $this->setTable('order_products');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ProductVariants', [
            'foreignKey' => 'product_variants_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'products_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Orders', [
            'foreignKey' => 'orders_id',
            'joinType' => 'INNER',
        ]);
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
            ->scalar('product_title')
            ->maxLength('product_title', 255)
            ->allowEmptyString('product_title');

        $validator
            ->scalar('product_sku')
            ->maxLength('product_sku', 100)
          //  ->requirePresence('product_sku', 'create')
            ->allowEmptyString('product_sku');

        $validator
            ->scalar('product_options')
            ->maxLength('product_options', 255)
          //  ->requirePresence('product_options', 'create')
            ->allowEmptyString('product_options');
        $validator
            ->scalar('product_image')
            ->maxLength('product_image', 255)
            //  ->requirePresence('product_options', 'create')
            ->allowEmptyString('product_image');

        $validator
            ->decimal('product_price')
            ->allowEmptyString('product_price');

        $validator
            ->nonNegativeInteger('product_quantity')
            ->allowEmptyString('product_quantity');

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
        //$rules->add($rules->existsIn(['product_variants_id'], 'ProductVariants'));
        //$rules->add($rules->existsIn(['products_id'], 'Products'));
        $rules->add($rules->existsIn(['orders_id'], 'Orders'));

        return $rules;
    }
}

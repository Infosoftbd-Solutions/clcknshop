<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Coupons Model
 *
 * @method \App\Model\Entity\Coupon get($primaryKey, $options = [])
 * @method \App\Model\Entity\Coupon newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Coupon[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Coupon|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Coupon saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Coupon patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Coupon[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Coupon findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CouponsTable extends Table
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

        $this->setTable('coupons');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('product_selection_type')
            ->allowEmptyString('product_selection_type', null, 'create');
        $validator
            ->integer('customer_selection_type')
            ->allowEmptyString('customer_selection_type', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');



        $validator
            ->scalar('coupon_code')
            ->maxLength('coupon_code', 20)
            ->requirePresence('coupon_code', 'create')
            ->notEmptyString('coupon_code');



        $validator
            ->dateTime('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmptyDateTime('start_date');

        $validator
            ->dateTime('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmptyDateTime('end_date');

        $validator
            ->boolean('discount_type')
            ->requirePresence('discount_type', 'create')
            ->notEmptyString('discount_type');

        $validator
            ->decimal('discount_amount')
            ->requirePresence('discount_amount', 'create')
            ->notEmptyString('discount_amount');

        $validator
            ->decimal('max_amount')
            ->requirePresence('max_amount', 'create')
            ->allowEmptyString('max_amount');
        $validator
            ->decimal('min_purchase_amount')
            ->requirePresence('min_purchase_amount', 'create')
            ->allowEmptyString('min_purchase_amount');

        $validator
            ->boolean('status')
            ->notEmptyString('status');

        return $validator;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaymentProcessor Model
 *
 * @property \App\Model\Table\PaymentMethodsTable&\Cake\ORM\Association\BelongsTo $PaymentMethods
 *
 * @method \App\Model\Entity\PaymentProcessor get($primaryKey, $options = [])
 * @method \App\Model\Entity\PaymentProcessor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PaymentProcessor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PaymentProcessor|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaymentProcessor saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PaymentProcessor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PaymentProcessor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PaymentProcessor findOrCreate($search, callable $callback = null, $options = [])
 */
class PaymentProcessorTable extends Table
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

        $this->setTable('payment_processor');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('PaymentMethods', [
            'foreignKey' => 'payment_method_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('image')
            ->maxLength('image', 255)
            ->requirePresence('image', 'create')
            ->notEmptyFile('image');

        $validator
            ->scalar('instruction_image')
            ->maxLength('instruction_image', 255);
//            ->requirePresence('image', 'create')
//            ->notEmptyFile('image');

        $validator
            ->scalar('options')
//            ->requirePresence('options', 'create')
            ->allowEmptyString('options');

        $validator
            ->boolean('status')
            ->notEmptyString('status');

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
        $rules->add($rules->existsIn(['payment_method_id'], 'PaymentMethods'));

        return $rules;
    }
}

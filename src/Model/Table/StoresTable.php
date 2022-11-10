<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;

/**
 * Stores Model
 *
 * @method \App\Model\Entity\Store get($primaryKey, $options = [])
 * @method \App\Model\Entity\Store newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Store[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Store|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Store saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Store patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Store[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Store findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StoresTable extends Table
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

        $this->setTable('stores');
        $this->setDisplayField('id');
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
            ->scalar('store_name')
            ->maxLength('store_name', 15,"Store name should contain max 15 characters")
            ->minLength('store_name', 3,"Store name should contain min 3 characters")
            ->requirePresence('store_name', 'create')
            ->notEmptyString('store_name')
            ->alphaNumeric('store_name',"Store name should contain letter and number only")
            ->add('store_name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table' ,'message' => __('Store name allready taken. Please try a different one.')])
            ->add('store_name',  'custom', [
                'rule' => [$this, 'validate_store_name'],
                'message' => 'The storename is not valid'
            ]);

        $validator
            ->scalar('store_url')
            ->maxLength('store_url', 255)
            ->requirePresence('store_url', 'create')
            ->notEmptyString('store_url');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 100)
            ->minLength('password', 6,"password should be minimum 6 digits")
            ->requirePresence('password', 'create')
            ->notEmptyString('password');
      /*  $validator
            ->date('expire_date')
            ->requirePresence('expire_date', 'create')
            ->notEmptyDate('expire_date');

        $validator
            ->boolean('disabled')
            ->requirePresence('disabled', 'create')
            ->notEmptyString('disabled');*/

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
      //  $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['store_name']));

        return $rules;
    }

    public function validate_store_name($check, array $context){
        $restricted = ['admin','dev','www'];
        if(in_array($check,$restricted))
            return false;
        return true;    

    }

   
    


    
   
}

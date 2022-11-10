<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SmsHistories Model
 *
 * @method \App\Model\Entity\SmsHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\SmsHistory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SmsHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SmsHistory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SmsHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SmsHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SmsHistory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SmsHistory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SmsHistoriesTable extends Table
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

        $this->setTable('sms_histories');
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
            ->scalar('submitted_id')
            ->maxLength('submitted_id', 255)
            ->requirePresence('submitted_id', 'create')
            ->notEmptyString('submitted_id');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 20)
            ->requirePresence('mobile', 'create')
            ->notEmptyString('mobile');

        $validator
            ->scalar('message')
            ->maxLength('message', 255)
            ->requirePresence('message', 'create')
            ->notEmptyString('message');

        $validator
            ->dateTime('sent_time')
            ->requirePresence('sent_time', 'create')
            ->notEmptyDateTime('sent_time');

        $validator
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        return $validator;
    }
}

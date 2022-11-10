<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Servers Model
 *
 * @method \App\Model\Entity\Server get($primaryKey, $options = [])
 * @method \App\Model\Entity\Server newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Server[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Server|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Server saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Server patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Server[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Server findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ServersTable extends Table
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

        $this->setTable('servers');
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
            ->scalar('server_ip')
            ->maxLength('server_ip', 100)
            ->requirePresence('server_ip', 'create')
            ->notEmptyString('server_ip');

        $validator
            ->scalar('domain')
            ->maxLength('domain', 100)
            ->requirePresence('domain', 'create')
            ->notEmptyString('domain');

        $validator
            ->scalar('api_url')
            ->maxLength('api_url', 100)
            ->requirePresence('api_url', 'create')
            ->notEmptyString('api_url');

        $validator
            ->scalar('site_token')
            ->maxLength('site_token', 32)
            ->requirePresence('site_token', 'create')
            ->notEmptyString('site_token');

        $validator
            ->scalar('encrypt_token')
            ->maxLength('encrypt_token', 32)
            ->requirePresence('encrypt_token', 'create')
            ->notEmptyString('encrypt_token');

        $validator
            ->integer('total_sites')
            ->requirePresence('total_sites', 'create')
            ->notEmptyString('total_sites');

        $validator
            ->integer('priority')
            ->requirePresence('priority', 'create')
            ->notEmptyString('priority');

        $validator
            ->boolean('disabled')
            ->requirePresence('disabled', 'create')
            ->notEmptyString('disabled');

        return $validator;
    }

    /**
     * Returns the database connection name to use by default.
     *
     * @return string
     */
    public static function defaultConnectionName()
    {
        return 'admin';
    }
}

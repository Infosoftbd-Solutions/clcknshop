<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Themes Model
 *
 * @method \App\Model\Entity\Theme get($primaryKey, $options = [])
 * @method \App\Model\Entity\Theme newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Theme[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Theme|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Theme saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Theme patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Theme[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Theme findOrCreate($search, callable $callback = null, $options = [])
 */
class ThemesTable extends Table
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

        $this->setTable('themes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->scalar('author')
            ->maxLength('author', 255)
            ->requirePresence('author', 'create')
            ->notEmptyString('author');

        $validator
            ->scalar('version')
            ->maxLength('version', 10)
            ->requirePresence('version', 'create')
            ->notEmptyString('version');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('thumbnail')
            ->maxLength('thumbnail', 255)
            ->requirePresence('thumbnail', 'create')
            ->notEmptyString('thumbnail');

        $validator
            ->scalar('preview')
            ->maxLength('preview', 255)
            ->requirePresence('preview', 'create')
            ->notEmptyString('preview');

        $validator
            ->scalar('link')
            ->maxLength('link', 255)
            ->requirePresence('link', 'create')
            ->notEmptyString('link');

        return $validator;
    }

    public static function defaultConnectionName()
    {
        return 'admin';
    }
}

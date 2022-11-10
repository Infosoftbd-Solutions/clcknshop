<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Facebook Model
 *
 * @property \App\Model\Table\PagesTable&\Cake\ORM\Association\BelongsTo $Pages
 * @property \App\Model\Table\BusinessesTable&\Cake\ORM\Association\BelongsTo $Businesses
 * @property \App\Model\Table\CatalogsTable&\Cake\ORM\Association\BelongsTo $Catalogs
 * @property \App\Model\Table\FeedsTable&\Cake\ORM\Association\BelongsTo $Feeds
 * @property \App\Model\Table\PixelsTable&\Cake\ORM\Association\BelongsTo $Pixels
 *
 * @method \App\Model\Entity\Facebook get($primaryKey, $options = [])
 * @method \App\Model\Entity\Facebook newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Facebook[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Facebook|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Facebook saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Facebook patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Facebook[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Facebook findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FacebookTable extends Table
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

        $this->setTable('facebook');
        $this->setDisplayField('name');
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('token')
            ->requirePresence('token', 'create')
            ->notEmptyString('token');

        $validator
            ->scalar('page_name')
            ->maxLength('page_name', 255)
            ->requirePresence('page_name', 'create')
            ->notEmptyString('page_name');

        $validator
            ->scalar('page_token')
            ->requirePresence('page_token', 'create')
            ->notEmptyString('page_token');

        $validator
            ->scalar('feed_url')
            ->maxLength('feed_url', 255)
            ->requirePresence('feed_url', 'create')
            ->notEmptyString('feed_url');

        $validator
            ->scalar('pixel_code')
            ->allowEmptyString('pixel_code');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
//    public function buildRules(RulesChecker $rules)
//    {
//        $rules->add($rules->isUnique(['email']));
//        $rules->add($rules->existsIn(['page_id'], 'Pages'));
//        $rules->add($rules->existsIn(['business_id'], 'Businesses'));
//        $rules->add($rules->existsIn(['catalog_id'], 'Catalogs'));
//        $rules->add($rules->existsIn(['feed_id'], 'Feeds'));
//        $rules->add($rules->existsIn(['pixel_id'], 'Pixels'));
//
//        return $rules;
//    }
}

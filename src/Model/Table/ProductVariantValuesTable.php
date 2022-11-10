<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductVariantValues Model
 *
 * @property \App\Model\Table\ProductOptionsTable&\Cake\ORM\Association\BelongsTo $ProductOptions
 * @property \App\Model\Table\ProductVariantsTable&\Cake\ORM\Association\BelongsTo $ProductVariants
 *
 * @method \App\Model\Entity\ProductVariantValue get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductVariantValue newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProductVariantValue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductVariantValue|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductVariantValue saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductVariantValue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductVariantValue[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductVariantValue findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductVariantValuesTable extends Table
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

        $this->setTable('product_variant_values');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ProductOptions', [
            'foreignKey' => 'product_options_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ProductVariants', [
            'foreignKey' => 'product_variants_id',
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
        $rules->add($rules->existsIn(['product_options_id'], 'ProductOptions'));
        $rules->add($rules->existsIn(['product_variants_id'], 'ProductVariants'));

        return $rules;
    }
}

<?php
namespace App\Model\Table;

use Cake\I18n\FrozenTime;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InventoryLogs Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\VariantsTable&\Cake\ORM\Association\BelongsTo $Variants
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\BelongsTo $Orders
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\InventoryLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\InventoryLog newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InventoryLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InventoryLog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InventoryLog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InventoryLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InventoryLog[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InventoryLog findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InventoryLogsTable extends Table
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

        $this->setTable('inventory_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Variants', [
            'className' => 'ProductVariants',
            'foreignKey' => 'variant_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
            'joinType' => 'LEFT',
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
            ->integer('prev_inventory')
            ->requirePresence('prev_inventory', 'create')
            ->notEmptyString('prev_inventory');

        $validator
            ->integer('current_inventory')
            ->requirePresence('current_inventory', 'create')
            ->notEmptyString('current_inventory');

        $validator
            ->scalar('comment')
            ->requirePresence('comment', 'create')
            ->notEmptyString('comment');

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
        $rules->add($rules->existsIn(['product_id'], 'Products'));
//        $rules->add($rules->existsIn(['variant_id'], 'Variants'));
//        $rules->add($rules->existsIn(['order_id'], 'Orders'));
//        $rules->add($rules->existsIn(['users_id'], 'Users'));

        return $rules;
    }


    public function addInventoryLog($logData = array()){
        $logData['created'] = FrozenTime::now();
        $logData['modified'] = FrozenTime::now();

        $saveQuery = $this->query()->insert(array_keys($logData))->values($logData)->execute();

        if ($saveQuery){
            return [
                'status' => true,
            ];
        }else{
            return [
                'status' => false,
                'errors' => $saveQuery->errorInfo()
            ];
        }

    }


}

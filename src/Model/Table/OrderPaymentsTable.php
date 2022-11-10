<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderPayments Model
 *
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\BelongsTo $Orders
 *
 * @method \App\Model\Entity\OrderPayment get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrderPayment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrderPayment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderPayment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderPayment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderPayment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrderPayment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderPayment findOrCreate($search, callable $callback = null, $options = [])
 */
class OrderPaymentsTable extends Table
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

        $this->setTable('order_payments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Orders', [
            'foreignKey' => 'orders_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PayMethods',[
            'className'=>'PaymentMethods',
            'foreignKey' => 'payment_method',
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
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmptyString('amount');

        $validator
            ->dateTime('payment_date')
            ->requirePresence('payment_date', 'create');
            //->notEmptyDate('payment_date');

        $validator
            ->requirePresence('payment_method', 'create')
            ->notEmptyString('payment_method');

      /*  $validator
            ->scalar('comments')
            ->notEmptyString('comments');*/

      /*  $validator
            ->dateTime('created_at')
            ->requirePresence('created_at', 'create')
            ->notEmptyDateTime('created_at');*/

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
        // $rules->add($rules->existsIn(['orders_id'], 'Orders'));

        return $rules;
    }

    public function payment( $payment_data = array(), $notes = null, $by = 'customer', $log_status = 5){
        
        /*
        $payment = [
            'orders_id' => $orders_id,
            'amount'    => $amount,
            'payment_method' => $payment_method,
            'payment_date' => date('Y-m-d H:i:s'
        ];
        */
        if(!isset($payment_data['payment_date'])) $payment_data['payment_date'] = date('Y-m-d H:i:s');
        $payment = $this->newEntity();
        $payment = $this->patchEntity($payment, $payment_data);

        if($this->save($payment)){

            $query = $this->find()->where("orders_id = " . $payment_data['orders_id']);
            $paid = $query->select(['total_paid' => $query->func()->sum('amount')])->first();
            $this->Orders->query()->update()->set(['total_paid'=>$paid->total_paid])->where(["Orders.id"=>$payment_data['orders_id']])->execute();

            if($notes != null){
                $this->Orders->addOrderLog($payment_data['orders_id'], [
                    'status' => $log_status,
                    'notes'  => $notes,
                    'by'     => $by
                ]); 
            }

            return true;
        }

        return false;
        
    }

}

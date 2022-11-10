<?php
namespace App\Model\Table;

use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Carbon\CarbonInterface;

/**
 * Orders Model
 *
 * @property \App\Model\Table\ShippingMethodsTable&\Cake\ORM\Association\BelongsTo $ShippingMethods
 * @property \App\Model\Table\PaymentMethodsTable&\Cake\ORM\Association\BelongsTo $PaymentMethods
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 *
 * @method \App\Model\Entity\Order get($primaryKey, $options = [])
 * @method \App\Model\Entity\Order newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Order[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order findOrCreate($search, callable $callback = null, $options = [])
 */
class OrdersTable extends Table
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

        $this->setTable('orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('OrderProducts', [
           'className' => 'OrderProducts'
        ])->setForeignKey('orders_id');

        $this->hasMany('OrderPayments', [
          'className' => 'OrderPayments'
        ])->setForeignKey('orders_id');

        $this->hasMany('OrderLogs', [
          'className' => 'OrderLogs'
        ])->setForeignKey('orders_id');

        $this->belongsTo('ShippingMethods', [
            'foreignKey' => 'shipping_methods_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('PaymentProcessor', [
            'foreignKey' => 'payment_processor_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('Customers', [
            'foreignKey' => 'customers_id',
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->nonNegativeInteger('order_id')
            ->requirePresence('order_id','create');

        $validator
            ->scalar('billing_address')
            ->allowEmptyString('billing_address');

        $validator
            ->scalar('shipping_address')
            ->allowEmptyString('shipping_address');

        $validator
            ->decimal('sub_total')
            ->allowEmptyString('sub_total');

        $validator
            ->decimal('discount')
            ->allowEmptyString('discount');

        $validator
            ->decimal('shipping_fee')
            ->allowEmptyString('shipping_fee');

        $validator
            ->decimal('taxes')
          //  ->requirePresence('taxes', 'create')
            ->allowEmptyString('taxes');

        $validator
            ->decimal('order_total')
            ->requirePresence('order_total', 'create')
            ->notEmptyString('order_total');

        $validator
            ->decimal('total_paid')
        //    ->requirePresence('total_paid', 'create')
            ->allowEmptyString('total_paid');
        $validator
            ->scalar('notes')
            ->allowEmptyString('notes');

        $validator
            ->scalar('stuff_notes')
            ->allowEmptyString('stuff_notes');

        $validator
            ->nonNegativeInteger('order_status')
            ->allowEmptyString('order_status');

        $validator
            ->dateTime('order_date')
            ->allowEmptyDateTime('order_date');

        $validator
//            ->nonNegativeInteger('shipping_weight')
            ->allowEmptyString('shipping_weight');

        $validator
            ->scalar('shipping_dimention')
            ->maxLength('shipping_dimention', 100)
            ->allowEmptyString('shipping_dimention');

        $validator
            ->scalar('payment_reference')
            ->maxLength('payment_reference', 255)
            ->allowEmptyString('payment_reference');

        $validator
            ->scalar('shipping_reference')
            ->maxLength('shipping_reference', 255)
            ->allowEmptyString('shipping_reference');

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
    //    $rules->add($rules->existsIn(['shipping_methods_id'], 'ShippingMethods'));
      //  $rules->add($rules->existsIn(['payment_methods_id'], 'PaymentMethods'));
        $rules->add($rules->existsIn(['customers_id'], 'Customers'));

        return $rules;
    }


  /*  public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options) {
       if ($entity->isNew()) {
           $entity->order_id = $this->generateOrderId();
       }
   }*/

   public function addOrderLog($order_id,$log = array()){
       $data = [
            'orders_id' => $order_id,
            'order_status' => null,
         //   'notes' => 'Order marked as '.$log['status'],
            'added_by' => 'Admin',
           'created' =>  Time::now()
        ];

        if(key_exists('status',$log)) $data['order_status'] = $log['status'];
        if(key_exists('notes',$log)) $data['notes'] = $log['notes'];
        if(key_exists('by',$log)) $data['added_by'] = $log['by'];
        // dd($data);
         $ret = $this->OrderLogs->query()->insert(array_keys($data))->values($data)->execute();
         /*$orderLogTable = TableRegistry::getTableLocator()->get('OrderLogs');
         $logEntity = $orderLogTable->newEntity();
         $orderLog = $orderLogTable->patchEntity($logEntity, $data);
*/
         return ($ret) ? true : false;

   }


   public function generateOrderId() {
       $orders = $this->find('all',[
         'fields' => array('order_id' => 'MAX(order_id)'),
      ]);
      $order = $orders->first();
      $orderid = $order->order_id;
      if($orderid == 0) $orderid = 1000;

      return $orderid + 1;

    // Your implementation here.
   }

    public function generateOneTimePassword($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

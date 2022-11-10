<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductsTable extends Table
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

        $this->setTable('products');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Categories', [
            'through' => 'CategoriesHasProducts',
            'foreignKey' =>'products_id',
            'targetForeignKey' =>'categories_id'
        ]);

        $this->hasMany('ProductVariants',[
          'className' => 'ProductVariants'
       ])->setForeignKey('products_id');

       $this->hasMany('ProductOptions',[
         'className' => 'ProductOptions'
       ])->setForeignKey('products_id');

        $this->hasMany('ProductMedia',[
            'className' => 'ProductMedia'
        ])->setForeignKey('product_id');


        $this->hasMany('Reviews', [
            'className' => 'Reviews'
        ])->setForeignKey('product_id');


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
            ->scalar('title')
            ->maxLength('title', 255)
            ->allowEmptyString('title');

        $validator
            ->scalar('slug')
    //        ->maxLength('slug', 150)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table' ,'message' => 'Slug allready exists.']);


        $validator
            ->scalar('description')
            ->allowEmptyString('description');
        $validator
            ->scalar('overview')
            ->allowEmptyString('overview');

        $validator
            ->scalar('media')
            ->maxLength('media', 255)
            ->allowEmptyString('media');

        $validator
            ->decimal('price')
            ->allowEmptyString('price');

        $validator
            ->decimal('cost')
            ->allowEmptyString('cost');

        $validator
            ->decimal('compare_price')
            ->allowEmptyString('compare_price');

        $validator
            ->scalar('sku')
            ->maxLength('sku', 100)
            ->allowEmptyString('sku');

        $validator
            ->scalar('barcode')
            ->maxLength('barcode', 100)
            ->allowEmptyString('barcode');

        $validator
            ->boolean('track_inventory')
            ->allowEmptyString('track_inventory');

        $validator
            ->boolean('sell_w_stock')
            ->allowEmptyString('sell_w_stock');

        $validator
            ->nonNegativeInteger('q_available')
            ->allowEmptyString('q_available');

        $validator
            ->boolean('is_physical')
            ->allowEmptyString('is_physical');

        $validator
            ->decimal('weight')
            ->allowEmptyString('weight');

        $validator
            ->scalar('weight_unit')
            ->maxLength('weight_unit', 10)
            ->allowEmptyString('weight_unit');

        $validator
            ->scalar('vendor')
            ->maxLength('vendor', 255)
            ->requirePresence('vendor', 'create')
            ->notEmptyString('vendor');

        $validator
            ->scalar('product_type')
            ->maxLength('product_type', 255)
            ->requirePresence('product_type', 'create')
            ->notEmptyString('product_type');

        $validator
            ->scalar('tags')
            ->requirePresence('tags', 'create')
            ->notEmptyString('tags');


        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmptyString('active');



        return $validator;
    }


    public function updateQuantity($prouduct_id, $options = array())
    {
        $pid        = $prouduct_id;
        $vid        = key_exists('variant_id', $options) ? $options['variant_id'] : 0;
        $action     = key_exists('action', $options) ? $options['action'] : 'add';
        $quantity   = key_exists('quantity', $options) ? $options['quantity'] : 0;
        $order_id   = key_exists('order_id', $options) ? $options['order_id'] : '';
        $log        = key_exists('log', $options) ? $options['log'] : true;
        $msg        = key_exists('message', $options) ? $options['message'] : "Increased {$quantity} quantity in Inventory";
        $uid        = key_exists('uid', $options) ? $options['uid'] : 0;
        $prev_qnty  = key_exists('prev_quantity', $options) ? $options['prev_quantity'] : 0;
        $cur_qnty   = 0;


        $product = $this->get($pid);
        if ($vid > 0 ){
            $variant = $this->ProductVariants->get($vid);
            if ($prev_qnty == 0) $prev_qnty = $variant->q_available;

            if ($action == 'set') {
                $cur_qnty   =  $quantity;
                $msg        = "Reset Inventory";
            }
            elseif ($action == 'remove') {
                $cur_qnty   = $variant->q_available - $quantity;
                $msg        = "Decreased {$quantity} quantity from Inventory";
            }
            else {
                $cur_qnty = $variant->q_available + $quantity;
            }

            $variant-> q_available = $cur_qnty;
            if (!$this->ProductVariants->save($variant)){
                debug($variant->errors());
                die();
            }

            $max_v_qnty = $this->ProductVariants->query()->select(["max_qnty" => 'MAX(ProductVariants.q_available)'])->where(['products_id', $pid])->first();
            $product->q_available = $max_v_qnty->max_qnty;
            if (!$this->save($product)){
                debug($product->errors());
                die();
            }

        }else{

            if ($prev_qnty == 0) $prev_qnty = $product->q_available;
            if ($action == 'set'){
                $cur_qnty =  $quantity;
                $msg        = "Reset Inventory";
            }
            elseif ($action == 'remove') {
                $cur_qnty = $product->q_available - $quantity;
                $msg        = "Decreased {$quantity} quantity from Inventory";
            }
            else {
                $cur_qnty = $product->q_available + $quantity;
            }

            $product->q_available = $cur_qnty;
            if (!$this->save($product)){
                debug($product->errors());
                die();
            }
        }

        if ($log) {
            $InventoryLogs = $InventoryLogs = TableRegistry::getTableLocator()->get('InventoryLogs');
            $log = $InventoryLogs->addInventoryLog([
                'product_id' => $pid,
                'variant_id' => $vid,
                'order_id' => $order_id,
                'prev_inventory' => $prev_qnty,
                'current_inventory' => $cur_qnty,
                'comment' => $msg,
                'users_id' =>  $uid
            ]);

            if ($log['status'] == false) {
                debug($log['errors']);
                die();
            }

        }

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
        $rules->add($rules->isUnique(['slug']));

        return $rules;
    }
}

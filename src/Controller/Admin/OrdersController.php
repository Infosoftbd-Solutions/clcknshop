<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\View\Helper\MediaHelper;
use App\View\Helper\FormatsHelper;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Utility\Inflector;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\I18n\FrozenTime;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Routing\Route\Route;
use Cake\Routing\Router;
use http\Url;
use phpDocumentor\Reflection\Type;
use phpDocumentor\Reflection\Types\This;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Picqer\Barcode\BarcodeGeneratorPNG;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 *
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function getMethodData($field = null)
    {
        if ($this->request->is('get')){
            $data = $this->request->getQuery();
            if (isset($field) && !empty($field) && key_exists($field, $data))
                return $data[$field];

            unset($data['_method']);
            unset($data['_csrfToken']);
            foreach ($data as $key => $d){
                if (trim($d) === "")
                    unset($data[$key]);
            }

            return $data;
        }
    }

    public function index($aa = null,$query = null)
    {
//         pr($this->SMS->send("8801518307641", "Are you there ?"));
        //  die();
        $PaymentMethods = TableRegistry::getTableLocator()->get('PaymentMethods');
        $methods = $PaymentMethods->find('list',[
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where(['status' => 1])->toArray();

        $this->paginate = [
            'contain' => [ 'Customers'],
        ];
        $orders = $this->Orders->find('all',['order'=>'order_id DESC'])->where(['draft' => 0]);

        if (!empty($this->getMethodData('search') && $this->getMethodData('search') == 'order_show_by_id')){
            $order_id = (int) $this->getMethodData('order_id');
            $order = $this->Orders->find('all')->where(['order_id' => $order_id])->first();
            if (count((array)$order)> 0) return $this->redirect(['controller' => 'Orders', 'action' => 'view', $order->id]);
             {
              $this->Flash->error("Order id " . $this->getMethodData('order_id') . " not found");
              return $this->redirect($this->referer());
             }
        }


        if (!empty($this->getMethodData('search') && $this->getMethodData('search') == 'order_filter')){
            $data = $this->getMethodData();

            $sql_condition = null;
            if (isset($data['order_status'])){
                $sql_condition .= "Orders.order_status =" . $data['order_status']." AND ";
            }
            if (isset($data['order_id'])){
                $sql_condition .= "Orders.order_id LIKE '%" . $data['order_id'] . "%' AND ";
            }

            if (isset($data['date_range'])){
                $range = explode(' to ',$data['date_range']);
                if (count($range) > 0){
                    $sql_condition .= "DATE(Orders.order_date) >= '" . $range[0] . "' AND DATE(Orders.order_date) <= '". (count($range)>1 ? $range[1] : $range[0]) . "' AND ";
                }
            }

            if (isset($data['customer'])){
                $sql_condition .= "(Customers.first_name LIKE '%" . $data['customer'] . "%' OR Customers.last_name LIKE '%" . $data['customer'] . "%' OR Customers.phone LIKE '%" . $data['customer'] . "%') AND ";
            }

            if (strlen($sql_condition) > 0) $sql_condition =  substr($sql_condition, 0, -5);

            $orders = $orders->where($sql_condition);

        }

        $orders = $this->paginate($orders);

            $domain = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain = array_shift($domain);
            
            if(strtolower($subdomain) == 'easyvpn'){
                $OrderProducts = TableRegistry::getTableLocator()->get('OrderProducts');
               foreach($orders as $order){
                    $query = $OrderProducts->find(); 
                    $orderProductsQty = $query
                        ->select(['total_quantity' => $query->func()->sum('OrderProducts.product_quantity')])
                        ->where(['OrderProducts.orders_id' => $order->id])->first();
                        $order->total_quantity = $orderProductsQty->total_quantity;
               }
            }
       
            $this->set(compact('orders','methods', 'subdomain'));
    }

    public function dashboard($filter_keyword = 0){
        $Payments = TableRegistry::getTableLocator()->get('OrderPayments');
        $Customers = TableRegistry::getTableLocator()->get('Customers');
        $PaymentMethods = TableRegistry::getTableLocator()->get('PaymentMethods');

        $reports = array();

        $methods = $PaymentMethods->find('list',[
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where(['status' => 1])->toArray();


        switch ($filter_keyword){
            case 0:
                $condition = " = '{$this->strToDate('now')}'";
                break;
            case 1:
                $condition = " = '{$this->strToDate('yesterday')}'";
                break;
            case 2:
                $condition = " >= '{$this->strToDate('-7 days')}'";
                break;
        }



        $orders = $this->Orders->find()->select([
            'total_orders' => 'count(*)',
            'total_sales' => 'SUM(order_total)'
        ])->where(['DATE(order_date)' . $condition])->first();

//            pr($orders);

        $payments = $Payments->find()->select([
            'total_payments' => 'SUM(amount)'
        ])->where(['Date(payment_date)'. $condition, 'amount > ' => 0])->first();

//            pr($payments);

        $customers = $Customers->find()->select([
            'total_customers' => 'count(*)'
        ])->where(['Date(created)'. $condition])->first();

//            pr($customers);
        $response =[
            'total_orders' => empty($orders['total_orders']) ? 0 : $orders['total_orders'],
            'total_sales'  =>  number_format(empty($orders['total_sales']) ? 0 : $orders['total_sales'],2),
            'total_payments' =>  number_format(empty($payments['total_payments']) ? 0 : $payments['total_payments'],2),
            'total_customers' => empty($customers['total_customers']) ? 0 : $customers['total_customers']
        ];



        if ($this->request->is('ajax')){
            $this->set('response', $response);
            $this->set('_serialize', 'response');
            $this->RequestHandler->renderAs($this, 'json');
            return;
        }



        

        $sales = $this->Orders->find('list',[
            'keyField' => 'date',
            'valueField' => 'sale'
        ])->select([
            'date' => 'Date(order_date)',
            'sale' => 'SUM(order_total)'
        ])->where(['Date(order_date) >= ' => $this->strToDate('-30 days')])->group('Date(order_date)')->toArray();



        $payments =$Payments->find('list',[
            'keyField' => 'date',
            'valueField' => 'payment'
        ])->select([
            'date' => 'Date(payment_date)',
            'payment' => 'SUM(amount)'
        ])->where(['Date(payment_date) >= ' => $this->strToDate('-30 days'), 'amount > ' => 0])->group('Date(payment_date)')->toArray();

        $last30Days = array();
        for($i = 0; $i < 30; $i++){
            $last30Days['labels'][] = date("d.m.Y", strtotime('-'. $i .' days'));
            $d = date("Y-m-d", strtotime('-'. $i .' days'));
            $last30Days['sales'][] = str_replace(",", '', number_format(key_exists($d, $sales) ? $sales[$d] : 0, 2));
            $last30Days['payments'][] = str_replace(",", '',number_format(key_exists($d, $payments) ? $payments[$d] : 0, 2));
        }

        $reports['last30Days']  = $last30Days;
        


    //    GENERATE STATUS REPORT   
        $status_reports = [
            '0' => '0',
            '1' => '0',
            '2' => '0',
            '3' => '0',
            '4' => '0'
        ];

        $sta_reports = $this->Orders->find('list', [
            'keyField' => 'order_status',
            'valueField' => 'total'
        ])->select(['order_status', 'total' => 'count(*)'])->group('order_status')->toArray();

        $status_reports = array_replace_recursive($status_reports, $sta_reports);
        
        $reports['status_reports']  = $status_reports;

        
        
        // GENERATE PAYMENT REPORT
        $payment_reports = array();

        $refund = $Payments->find('all')->select([
            'refund' => 'SUM(ABS(amount))'
        ])->where(['amount < ' => 0])->first();
        $payment_reports['refund'] = $refund->refund;

        $paid = $Payments->find('all')->select([
            'pamount' => 'SUM(amount)'
        ])->where(['amount > ' => 0])->first();
        $payment_reports['paid'] = $paid->pamount;


        $orders = $this->Orders->find('all',['order'=>'order_id DESC'])->where(['draft' => 0])->contain(['Customers'])->limit(10)->all();

        // calculate total pending, processing, due amount and customers
        $totalSub = array();

        $totalSub['processing'] = $this->Orders->find('all')->where(['order_status' => 1])->count();
        $totalSub['shipped']    = $this->Orders->find('all')->where(['order_status' =>  2])->count();
        $totalSub['customer']   = $Customers->find('all')->count();
        
        $payments = $this->Orders->find('all')->select([
            'sales' => 'SUM(order_total)',
            'dues' => 'SUM(order_total - total_paid)'
        ])->first();

        
        $totalSub['dues']  = $payments->dues;

        $payment_reports['sales'] = $payments->sales;
        $payment_reports['dues'] = $payments->dues;
        
        $reports['payment_reports'] = $payment_reports;


        // GENERATE PAYMENT METHOD REPORT
        // pr($methods);
        
        $p_methods = $Payments->find('list', [
            'keyField' => 'payment_method',
            'valueField' => 'total'
        ])->select([
            'payment_method',
            'total' => 'SUM(amount)'
        ])->where(['amount > ' => 0])->group('payment_method')->toArray();

        $temp = array();
        $label = array();
        $colors = array();
        $colorData = [
            '#467fcf',
            '#45aaf2',
            '#f1c40f',
            '#5eba00',
            '#2bcbba',
            '#fd9644',
            '#17a2b8',
            '#f1c40f',
            '#a55eea',
            '#f66d9b'
        ];

        foreach($methods as $key => $m){
            $temp[$m] = key_exists($key, $p_methods) ? $p_methods[$key] : 0; 
            $label[$m] = ucfirst($m);
            $colors[$m] = $colorData[$key];
        }

        $reports['pm_reports']['data'] = $temp;
        $reports['pm_reports']['label'] = $label;
        $reports['pm_reports']['color'] = $colors;

        // pr($reports);
        
        $this->set('totalSub', $totalSub);
        $this->set('summary', $response);
        $this->set('reports', json_encode($reports));
        $this->set('orders', $orders);
        $this->set('methods', $methods);
    }

    private function strToDate($str){
        return Date('Y-m-d', strtotime($str));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $isOrderId = false)
    {
        $PaymentMethods = TableRegistry::getTableLocator()->get('PaymentMethods');
        $methods = $PaymentMethods->find('list',[
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where(['status' => 1])->toArray();

        if($isOrderId){
            $order = $this->Orders->find('all')->where(['order_id' => $id])->contain(
                        ['Customers','OrderProducts', 'OrderPayments', 'PaymentProcessor', 'ShippingMethods',
                            'OrderLogs' => [
                                'sort' => ['OrderLogs.id' => 'DESC']
                            ]
                        ]
                    )->first();
        }
        else{
            $order = $this->Orders->get($id, [
                'contain' => ['Customers','OrderProducts', 'OrderPayments', 'PaymentProcessor', 'ShippingMethods',
                    'OrderLogs' => [
                        'sort' => ['OrderLogs.id' => 'DESC']
                    ]
                ],
            ]);

        }


       // pr($order);
        /*
        $data = [
            'store' => json_decode(Configure::read('App.store')),
            'order' => $order
        ];
        $mail = $this->Mail->send($order->customer->email, 'Your order is placed order #'. $order->order_id, $data, 'invoice');
        if (!empty($mail)) $this->Flash->error($mail);
    */

        $shippingMethods = $this->Orders->ShippingMethods->find('all', ['limit' => 200]);

        $this->set(compact('order', 'shippingMethods', 'methods'));
    }



    public function smsHistories($garbage = null, $query = null)
    {
        $SmsHistories = TableRegistry::getTableLocator()->get('SmsHistories');
        $histories = $SmsHistories->find('all')->orderDesc('id');
        $histories = $this->paginate($histories);

        if($this->request->is('ajax')) {
            $histories = $SmsHistories->find('all')->where(['mobile LIKE' => '%' . $query . '%']);
            $histories = $this->paginate($histories);
            $this->set(compact('histories'));
            $this->layout="ajax";
            $this->render('sms_histories_display');
        }

        $this->set('histories', $histories);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($type = null)
    {
        $order = $this->Orders->newEntity();
        if ($this->request->is('post')) {
//            $InventoryLog = TableRegistry::getTableLocator()->get('InventoryLogs');
//            $Customers = TableRegistry::getTableLocator()->get('Customers');
            $Products = TableRegistry::getTableLocator()->get('Products');
            $ProductVariants = TableRegistry::getTableLocator()->get('ProductVariants');
//            $prev_qnty = 0;
//            $cur_qnty = 0;
            $data = $this->request->getData();
            $default_image  = '';
           // pr($data);
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            $order->order_id = $this->Orders->generateOrderId();
            $order->order_date = FrozenTime::now();
            $order->order_status = 0;
            $order->order_password = $this->Orders->generateOneTimePassword();
            if ($this->Orders->save($order)) {

                $product_count = sizeof($data['products_id']);
                for($i=0;$i<$product_count;$i++){
                    $default_image = null;
                    $order_product = $this->Orders->OrderProducts->newEntity();

                    if($data['products_id'][$i] != 0){
                        if ($data['product_variants_id'][$i] > 0){
                            $variant = $ProductVariants->find('all')->where(['id' => $data['product_variants_id'][$i]])->first();
                            if ($variant)
                                $default_image = PRODUCT_IMAGE_PATH . DS . $data['products_id'][$i] . DS . $variant->defaultImage;
                        }else{
                            $product = $Products->find('all')->where(['id' => $data['products_id'][$i]])->first();
                            if ($product)
                                $default_image = PRODUCT_IMAGE_PATH . DS . $data['products_id'][$i] . DS . $product->defaultImage;
                        }
                    }

                    $product_data = ['products_id'=>$data['products_id'][$i],
                    'product_variants_id'=>$data['product_variants_id'][$i],
                    'product_title'=>$data['product_title'][$i],
                    'product_options'=>$data['product_options'][$i],
                    'product_sku'=>$data['product_sku'][$i],
                    'product_quantity'=>$data['product_quantity'][$i],
                    'product_price'=>$data['product_price'][$i],
                    'product_weight'=>$data['product_weight'][$i],
                    'product_is_digital'=>$data['product_is_digital'][$i],
                     'product_image' => $default_image,

                  ];

                  $order_product = $this->Orders->OrderProducts->patchEntity($order_product,$product_data);
                  $order_product->orders_id = $order->id;
                  if(!$this->Orders->OrderProducts->save($order_product)) {
                      debug($order_product->errors());
                      die();
                  }

                  if(isset($data['draft']) && $data['draft'] ==1) continue;

                    if ($data['products_id'][$i] != 0){
                        $Products->updateQuantity($data['products_id'][$i], [
                            'order_id' => $order->id,
                            'variant_id' => $data['product_variants_id'][$i],
                            'quantity' => $data['product_quantity'][$i],
                            'action' => 'remove',
                            'uid' => $this->request->session()->read('user.id')
                        ]);
                    }

                }

                if(isset($data['draft']) && $data['draft'] ==1) return $this->redirect(['action' => 'drafts']);

                $this->Orders->addOrderLog($order->id,[
                    'status' => 0,
                    'by' => $this->request->session()->read('user.first_name')
                ]);

                //Send Notification 
                $order = $this->Orders->get($order->id, [
                    'contain' => ['Customers','OrderProducts'],
                ]);

                //send message
                $sms_notification = json_decode(Configure::read('App.sms_notification'));
                if(isset($sms_notification->order_placed_from_admin_pos_cus_notify) &&
                 $sms_notification->order_placed_from_admin_pos_cus_notify == "on" &&
                 isset($order->customer->phone) && 
                 empty($order->customer->phone) == false){
                    $sms = Configure::read('App.sms_con_order_placed');
                    $sms = $this->contentProcess($sms, ['order_id' => $order->order_id]);
                    $sms_res = $this->SMS->send($order->customer->phone, $sms);
                }

                // sned mail
                $mail = json_decode(Configure::read('App.mail_notification'));
                if(isset($mail->order_placed_from_admin_pos_cus_notify) && 
                        $mail->order_placed_from_admin_pos_cus_notify == "on" &&
                        isset($order->customer->email) &&
                        empty($order->customer->email) == false){

                    $store = json_decode(Configure::read('App.store'));
                    $mail_res = $this->Mail->send($order->customer->email, __("Your order is placed order #{0}", [$order->order_id]), ['order' => $order, 'store' => $store], 'order_placed');
                }

    
                /*
                $order = $this->Orders->get($order->id, [
                    'contain' => ['Customers','OrderProducts', 'PaymentProcessor',
                        'OrderLogs' => [
                            'sort' => ['OrderLogs.id' => 'DESC']
                        ]
                    ],
                ]);

                $emailData = [
                    'store' => json_decode(Configure::read('App.store')),
                    'order' => $order
                ];
                $mail = $this->Mail->send($order->customer->email, 'Your order is placed order #'. $order->order_id, $emailData, 'order_placed');
                if (!empty($mail)) $this->Flash->error($mail);

*/
             $this->order_email($order); 




                $this->Flash->success(__('The order has been saved.'));
                return $this->redirect(['action' => 'view',$order->id]);
            }else{
              debug($order->errors());
              $this->Flash->error(__('The order could not be saved. Please, try again.'));

            }

            $this->Flash->error(__('The order could not be saved. Please, try again.'));
            debug($order->errors());

        }


        $shippingMethods = $this->Orders->ShippingMethods->find('all', ['limit' => 200]);
      /*  $paymentMethods = $this->Orders->PaymentMethods->find('list', ['limit' => 200]);
        $customers = $this->Orders->Customers->find('list', ['limit' => 200]);*/
        $this->set(compact('order', 'shippingMethods','type'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $type = null)
    {
        $Products = TableRegistry::getTableLocator()->get('Products');

        $order = $this->Orders->get($id, [
            'contain' => ['Customers','OrderProducts' ],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->getData();
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {

                if(isset($data['draft']) && $data['draft'] ==1){
                    $this->Orders->OrderProducts->deleteAll(['orders_id' => $order->id]);

                    $product_count = sizeof($data['products_id']);
                    for($i=0;$i<$product_count;$i++){
                        $order_product = $this->Orders->OrderProducts->newEntity();
                        $product_data = ['products_id'=>$data['products_id'][$i],
                            'product_variants_id'=>$data['product_variants_id'][$i],
                            'product_title'=>$data['product_title'][$i],
                            'product_options'=>$data['product_options'][$i],
                            'product_sku'=>$data['product_sku'][$i],
                            'product_quantity'=>$data['product_quantity'][$i],
                            'product_price'=>$data['product_price'][$i],
                            'product_weight'=>$data['product_weight'][$i],
                            'product_is_digital'=>$data['product_is_digital'][$i],

                        ];

                        $order_product = $this->Orders->OrderProducts->patchEntity($order_product,$product_data);
                        $order_product->orders_id = $order->id;
                        if(!$this->Orders->OrderProducts->save($order_product)){
                            debug($order_product->errors());
                            die();
                        }
                    }
                    $this->Flash->success(__('The order has been saved.'));
                    return $this->redirect(['action'=>'drafts']);
                }


                $deleted_ids =  empty(trim($data['deleted_ids'])) ? [] :  array_filter(explode(',', trim($data['deleted_ids'])));
                foreach ($deleted_ids as $did) {
                    if (empty($did) == false && $did > 0){
                        $deleted_product = $this->Orders->OrderProducts->get((int) $did);

                        if ($deleted_product->products_id != 0){
                            $Products->updateQuantity($deleted_product->products_id, [
                                'order_id' => $order->id,
                                'variant_id' => $deleted_product->product_variants_id,
                                'quantity' => $deleted_product->product_quantity,
                                'action' => 'add',
                                'uid' => $this->request->session()->read('user.id')
                            ]);
                        }

                        $this->Orders->OrderProducts->delete($deleted_product);
                    }
                }

                $product_count = sizeof($data['products_id']);
                for($i=0;$i<$product_count;$i++){
                    if (!empty(trim($data['order_product_table_id'][$i])) && $data['order_product_table_id'][$i] > 0){
//                        var_dump($data['order_product_table_id'][$i]);
                     //   pr($data);
                       // die();
                        $prev_id = (int) $data['order_product_table_id'][$i];
                        $prev_product = $this->Orders->OrderProducts->get($prev_id);

                        $pq = (int) $prev_product->product_quantity;
                        $cq = (int) $data['product_quantity'][$i];

                        if ($pq > $cq) $action = 'add';
                        elseif ($pq < $cq) $action = 'remove';
                        if($pq != $cq) {
                            if ($data['products_id'][$i] !=0){
                                $Products->updateQuantity($prev_product->products_id, [
                                    'order_id' => $order->id,
                                    'variant_id' => $prev_product->product_variants_id,
                                    'quantity' => $pq - $cq,
                                    'action' => $action,
                                    'uid' => $this->request->session()->read('user.id')
                                ]);
                            }

                            $prev_product->product_quantity = $cq;
                            $prev_product->product_price = $data['product_price'][$i];
                            if (!$this->Orders->OrderProducts->save($prev_product)) {
                                debug($prev_product->errors());
                                die();
                            }
                        }
                        continue;

                    }


                    $order_product = $this->Orders->OrderProducts->newEntity();
                    $product_data = ['products_id'=>$data['products_id'][$i],
                        'product_variants_id'=>$data['product_variants_id'][$i],
                        'product_title'=>$data['product_title'][$i],
                        'product_options'=>$data['product_options'][$i],
                        'product_sku'=>$data['product_sku'][$i],
                        'product_quantity'=>$data['product_quantity'][$i],
                        'product_price'=>$data['product_price'][$i],
                        'product_weight'=>$data['product_weight'][$i],
                        'product_is_digital'=>$data['product_is_digital'][$i],

                    ];

                    $order_product = $this->Orders->OrderProducts->patchEntity($order_product,$product_data);
                    $order_product->orders_id = $order->id;
                    if(!$this->Orders->OrderProducts->save($order_product)){
                        debug($order_product->errors());
                        die();
                    }

                    if ($data['products_id'][$i] !=0) {
                        $Products->updateQuantity($data['products_id'][$i], [
                            'order_id' => $order->id,
                            'variant_id' => $data['product_variants_id'][$i],
                            'quantity' => $data['product_quantity'][$i],
                            'action' => 'remove',
                            'uid' => $this->request->session()->read('user.id')
                        ]);
                    }

                }

                $this->Flash->success(__('The order has been saved.'));

                
                $this->order_email($order);
                if($order->draft == 1) return $this->redirect(['action'=>'drafts']);

                return $this->redirect(['action' => 'view',$id]);
            }

            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }

        $mediaH = new MediaHelper(new \Cake\View\View());
        foreach ($order->order_products as $product){
            if ($product->product_variants_id > 0){
                $variant = $Products->ProductVariants->find('all')->where(['id' => $product->product_variants_id])->first();
                if ($variant){
                    $product->sell_w_stock = $variant->sell_w_stock ? true : false;
                    $product->stock = $product->product_quantity + ($variant->q_available ? $variant->q_available : 0);
                    $product->icon = $mediaH->productImage($variant->defaultImage,$product->products_id,['path'=>true,'width'=>100]);
                }

            }else{
                $pd = $Products->find('all')->where(['id' => $product->products_id])->first();
                if($pd){
                    $product->sell_w_stock = $pd->sell_w_stock ? true : false;
                    $product->stock = $product->product_quantity +  ($pd->q_available ? $pd->q_available : 0);
                    $product->icon = $mediaH->productImage($pd->defaultImage,$pd->id,['path'=>true,'width'=>100]);
                }

            }



        }


        $shippingMethods = $this->Orders->ShippingMethods->find('all', ['limit' => 200]);
        $this->set(compact('order', 'shippingMethods','type'));
        $this -> render('add');
    }

    function order_email($order){

        $invoice_cache = CACHE . DS . 'invoices';
        @mkdir($invoice_cache, 0777,true);
        $invoice_file = $invoice_cache . DS . 'invoice_' . $order->order_id . '.pdf';
        file_put_contents($invoice_file, file_get_contents(Router::url(['controller' => 'Orders', 'action' => 'invoice', $order->order_id, $order->order_password,'_ext' => 'pdf','download'=>false],true)));

        $store = json_decode(Configure::read('App.store'));
        $ret = $this->Mail->send($store->email, "admin Order  notfication Order#{$order->order_id}", ['order' => $order, 'store' => $store,'attachments'=>[$invoice_file]], "admin_order_placed");
    }





    public function invoice($order_id = null, $order_password = null, $downloadorprint = null){
        //pr(Configure::read('CakePdf')); die();

        $PaymentMethods = TableRegistry::getTableLocator()->get('PaymentMethods');
        $methods = $PaymentMethods->find('list',[
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where(['status' => 1])->toArray();



        if($order_password){
            $order = $this->Orders->find('all')->where(['order_id' => $order_id, 'order_password' => $order_password])->contain(['OrderProducts', 'OrderPayments', 'PaymentProcessor'])->first();
            if(!$order) return $this->redirect('/admin/orders');

            $customer = json_decode($order->shipping_address);
            //$this->layout = "ajax";
            $this->set(compact('order', 'customer', 'methods'));
            

            if ($downloadorprint == 1){
                $queryString = Router::url(['controller' => 'Orders', 'action' => 'invoice', $order_id, $order_password,'_ext' => 'pdf','download'=>true]);
                $this->redirect($queryString);
              
            }
             if ($this->request->params['_ext'] == 'pdf'){
               
                  //die(Inflector::humanize($this->request->params['action']) . '-' . $order_id);
                    $this->viewBuilder()->options([
                    'pdfConfig' => [
                      //  'orientation' => 'portrait',
                        'filename' => Inflector::humanize($this->request->params['action']) . '-' . $order_id . '.pdf',
                        'download'=>isset($this->request->params['download'])?$this->request->params['download']:true
                    ]
                    ]);  
             }
             else{

                $this->render('pdf/' . Inflector::underscore($this->request->params['action']),'pdf/default');
             }
           
        }else if($this->request->getSession()->read('user_logged_in') == '1'){
            $order = $this->Orders->find('all')->where(['order_id' => $order_id ])->contain(['OrderProducts', 'OrderPayments', 'PaymentProcessor'])->first();
            
            $this->set(compact('order', 'methods'));
        }else
          $this->redirect('/admin/orders');

    }


    public function packingSlip($order_id = null, $order_password = null, $download = null)
    {
        $this->invoice($order_id, $order_password, $download);
    }

    public function drafts($query = null)
    {

        $this->paginate = [
            'contain' => [ 'Customers'],
        ];
        $orders = $this->Orders->find('all')->where(['draft' => 1]);
        if ($this->request->is('ajax')){

            $orders = $orders->where([
                'OR'=>[
                    'Orders.order_id LIKE' . ' \'%'.$query.'%\'',
                    'Customers.first_name LIKE' => '%'.$query.'%',
                    'Customers.last_name LIKE' => '%'.$query.'%',
                    'Customers.phone LIKE' => '%'.$query.'%'
                ]
            ]);
            $orders = $this->paginate($orders);
            $this->set(compact('orders'));
            $this->layout="ajax";
            $this->render('drafts_order_display');
        } else{
            $orders = $this->paginate($orders);
            $this->set(compact('orders'));
        }
    }

    public function editField($order_id = null)
    {
        $data = $this->request->getData();

//        $this->autoRender = false;

        if($data['field'] == 'order_status'){
            $order_statuses = [0=>'Pending',1=>'Processing',2=>'Shipped',3=>'Delivered',4=>'Cancelled'];
            $order_id = $data['order_id'];
            $value = $data['status'];
//            dd($order_statuses[$value_key]);

            /*
            $order = $this->Orders->get($order_id, [
                'contain' => ['Customers','OrderProducts', 'PaymentProcessor',
                    'OrderLogs' => [
                        'sort' => ['OrderLogs.id' => 'DESC']
                    ]
                ],
            ]);
            */
            
            $order = $this->Orders->get($order_id, [
                'contain' => ['Customers','OrderProducts'],
            ]);


            if($value == 4 && $order->total_paid > 0 ){
                $this->Flash->error(__('Sorry, Order could not be cancelled. Already order has been paid'));
                return $data['prev_action'] == 'view'? $this->redirect(['action'=> $data['prev_action'], $order_id]) : $this->redirect(['action'=> $data['prev_action']]);
            }

            $order->order_status = $value;
            if(!$this->Orders->save($order)){
                pr($order->errors());
                die();
            };


/*
            $order = $this->Orders->query()->update()
                ->set(['order_status' => $value])
                ->where(['id' => $order_id])
                ->execute();
*/

    
            if($order){
                $log = $this->Orders->addOrderLog($order_id,[
                    'status' => $value,
                    'notes' =>$data['notes'],
                    'by' => $this->request->session()->read('user.first_name')
                ]);
                $this->Flash->success(__('Order status has been changed.'));

                
                    $sms_notify_keys = [
                        1 => 'order_processing_cus_notify',
                        2 => 'order_shipped_cus_notify',
                        3 => 'order_delivered_cus_notify',
                        4 => 'order_cancelled_cus_notify'
                    ];

                    $sms_content_keys = [
                        1 => 'App.sms_con_order_processing',
                        2 => 'App.sms_con_order_shipped',
                        3 => 'App.sms_con_order_delivered',
                        4 => 'App.sms_con_order_cancelled',
                    ];


                    $sms_notification = json_decode(Configure::read('App.sms_notification'));
          
                    if(isset($sms_notify_keys[$value]) && isset($sms_notification->{$sms_notify_keys[$value]}) && 
                        $sms_notification->{$sms_notify_keys[$value]} == "on" &&
                        isset($order->customer->phone) && empty($order->customer->phone) == false){
                            $sms = Configure::read($sms_content_keys[$value]);
                            $sms = $this->contentProcess($sms, ['order_id' => $order->order_id]);
                            $sms_res = $this->SMS->send($order->customer->phone, $sms);
                    }


                    $mail_notify_keys = [
                        1 => 'order_processing_cus_notify', 
                        2 => 'order_shipped_cus_notify',
                        3 => 'order_delivered_cus_notify',
                        4 => 'order_cancelled_cus_notify'
                    ];

                    $mail_notification = json_decode(Configure::read('App.mail_notification'));
                    if(isset($sms_notify_keys[$value]) && isset($mail_notification->{$mail_notify_keys[$value]}) && 
                        $mail_notification->{$mail_notify_keys[$value]} == "on" &&
                        isset($order->customer->email) && empty($order->customer->email) == false){

                            $subjects = [
                                1 => "Your order has been processed order #{$order->order_id}",
                                2 => "Your parcel has been shipped order #{$order->order_id}",
                                3 => "Your Order has been Delivered order #{$order->order_id}",
                                4 => "Your Order has been Cancelled order #{$order->order_id}",
                            ];
                            $templates = [1 => 'order_processing', 2 => 'order_shipped', 3 => 'order_delivered', 'order_cancelled'];
                            $store = json_decode(Configure::read('App.store'));
                            $this->Mail->send($order->customer->email, $subjects[$value], ['order' => $order, 'store' => $store], $templates[$value]);
                            
                    }
                
            }
            else{
                $this->Flash->error(__('Opps There was something wrong.'));
            }


        }

        return $data['prev_action'] == 'view'? $this->redirect(['action'=> $data['prev_action'], $order_id]) : $this->redirect(['action'=> $data['prev_action']]);
    }


    public function draftToOrder($id = null)
    {
        $InventoryLog = TableRegistry::getTableLocator()->get('InventoryLogs');
        $Products = TableRegistry::getTableLocator()->get('Products');

        $order = $this->Orders->get($id,[
          'contain' => ['OrderProducts']
        ]);
        $order->draft = 0;
        $order->order_status = 0;
        $order->order_date = Time::now();


        if ($this->Orders->save($order)){



            foreach ($order->order_products as $or_product){
                pr($or_product);

                if ($or_product->product_variants_id > 0) {
                    $variant = $Products->ProductVariants->find('all')->where(['id' => $or_product->product_variants_id])->first();
                    $prev_qnty = $variant->q_available;
                    $variant->q_available = (int) $variant->q_available - (int) $or_product->product_quantity;
                    $cur_qnty = $variant->q_available;

                    if (!$Products->ProductVariants->save($variant)){
                        pr($variant->errors());
                        die();
                    }

                }else{
                    $product = $Products->find('all')->where(['id' => $or_product->products_id])->first();
                    $prev_qnty = $product->q_available;
                    $product->q_available = (int) $product->q_available - (int) $or_product->product_quantity;
                    $cur_qnty = $product->q_available;

                    if (!$Products->save($product)){
                        pr($product->errors());
                        die();
                    }
                }
                $log = $InventoryLog->addInventoryLog([
                    'product_id' => $or_product->products_id,
                    'variant_id' => $or_product->product_variants_id,
                    'order_id' => $order->id,
                    'prev_inventory' => $prev_qnty,
                    'current_inventory' => $cur_qnty,
                    'comment' => __("{0} Inventory Decrement for this Order", [$or_product->product_quantity]),
                    'users_id' => $this->request->session()->read('user.id')
                ]);
                if ($log['status'] == false) {
                    debug($log['errors']);
                    die();
                }
            }

            $log = $this->Orders->addOrderLog($id,[
                  'status' => 0,
                //  'notes' =>"Marked order as pending",
                  'by' => $this->request->session()->read('user.first_name')
            ]);

            $this->Flash->success(__('The order has been marked as Pending.'));
        }
        else
           $this->Flash->error(__('There was something wrong.'));

        return $this->redirect(['action' => 'edit',$id]);
    }



    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }
        if($order->draft == 1) return $this->redirect(['action' => 'drafts']);
        return $this->redirect(['action' => 'index']);
    }


    public function paymentLog($id){

        $OrdersPayments = TableRegistry::getTableLocator()->get('OrderPayments');
        $paymentLogs = $OrdersPayments->find('all')->where(['orders_id' => $id])->contain(['PayMethods'])->all();
//        pr($paymentLogs);
//        die();

        $this->set(compact('paymentLogs'));
        $this->layout="ajax";
        $this->render('payment_log_display');

    }

    private function modifyOrderProduct($orderProduct, $oder_id, $quantity , $is_qnty_add = true){

        $Products = TableRegistry::getTableLocator()->get('Products');
        $InventoryLogs = TableRegistry::getTableLocator()->get('InventoryLogs');
        $msg = __("Increased {0} quantity due to  remove from the order.", [$quantity]);
        $cur_qnty = 0;
        $prev_qnty = 0;


        if ($is_qnty_add){
            if ($orderProduct->product_variants_id > 0 ){
                $variant = $Products->ProductVariants->get((int) $orderProduct->product_variants_id);
                $prev_qnty = $variant->q_available;
                $cur_qnty = $variant->q_available + $quantity;
                $variant-> q_available = $cur_qnty;
                if (!$Products->ProductVariants->save($variant)){
                    debug($variant->errors());
                    die();
                }
            }

            else{
                $product = $Products->get($orderProduct->products_id);
                $prev_qnty = $product->q_available;
                $cur_qnty = $product->q_available + $quantity;
                $product->q_available = $cur_qnty;
                if (!$Products->save($product)){
                    debug($product->errors());
                    die();
                }

            }
        }
        else{

            if ($orderProduct->product_variants_id > 0 ){
                $variant = $Products->ProductVariants->get((int) $orderProduct->product_variants_id);
                $prev_qnty = $variant->q_available;
                $cur_qnty = $variant->q_available - $quantity;
                $variant-> q_available = $cur_qnty;
                if (!$Products->ProductVariants->save($variant)){
                    debug($variant->errors());
                    die();
                }
            }

            else{
                $product = $Products->get($orderProduct->products_id);
                $prev_qnty = $product->q_available;
                $cur_qnty = $product->q_available - $quantity;
                $product->q_available = $cur_qnty;
                if (!$Products->save($product)){
                    debug($product->errors());
                    die();
                }
            }

            $msg = __("Decreased {0} quantity due to  Modify the order.", [$quantity]);
        }



        $log = $InventoryLogs->addInventoryLog([
            'product_id' => $orderProduct->products_id,
            'variant_id' => $orderProduct->product_variants_id,
            'order_id' => $oder_id,
            'prev_inventory' => $prev_qnty,
            'current_inventory' => $cur_qnty,
            'comment' => $msg,
            'users_id' => $this->request->session()->read('user.id')
        ]);
    }


    private function base_url($queryString = null){
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        if ($queryString) return $protocol . "://" . $_SERVER['HTTP_HOST']. $queryString;

        return $protocol . "://" . $_SERVER['HTTP_HOST'];
    }

    private function generatePDF_download($url, $order_id, $type = 'invoice'){
        $temFolder =  CACHE . "weasyprint" . DS . uniqid("pdf_");
        $invoiceName = $type . "-" . $order_id . '.pdf';
        $generated_invoice_path = $temFolder . DS .  $invoiceName;


        if (!file_exists($temFolder)) mkdir($temFolder, 0777,true);

        try {
            exec('weasyprint ' . $url . ' '. $generated_invoice_path );
        } catch (\Exception $e){
            return  false;
        }


        header("Content-type:application/pdf");
        // It will be called downloaded.pdf
        header("Content-Disposition:attachment;filename={$invoiceName}");
        // The PDF source is in original.pdf
        readfile($generated_invoice_path);

        if (file_exists($generated_invoice_path)) unlink($generated_invoice_path);
        if (file_exists($temFolder)) rmdir($temFolder);
        return true;
    }

    public function sendMail($order_id = null){
         $store = json_decode(Configure::read('App.store'));
        $order = $this->Orders->get($order_id, [
            'contain' => ['Customers','OrderProducts', 'PaymentProcessor']
        ]);
         pr($store);
        if($order){
           $ret = $this->Mail->send($store->email, "admin Order  notfication Order#{$order->order_id}", ['order' => $order, 'store' => $store], "admin_order_placed");
        } 
       // $ret = $this->Mail->send("masum0009@gmail.com", __("Order Placed For Testing Purpose"), ['test'=>'test'], "test");
       
        die($ret);
    }


    private function contentProcess($content, $data = array()){
        $keywords = [
            '%order_id%'    => array_key_exists("order_id", $data) ? $data['order_id'] : 0000,
            '%store_name%'  => Configure::read('App.store_title'),
            '%amount%'      => array_key_exists("amount", $data) ? $data['amount'] : money_format(0, 2)
        ];

        foreach ($keywords as $key => $value) {
            $content = str_replace($key, $value, $content);
        }

        return $content;
    }
    
    

}
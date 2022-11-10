<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Collection\Collection;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * Reports Controller
 *
 *
 * @method \App\Model\Entity\Report[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReportsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    private $Orders = null;
    private $OrderPayments = null;

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, $eventManager = null, $components = null)
    {
        $this->Orders = TableRegistry::getTableLocator()->get('Orders');
        $this->OrderPayments = TableRegistry::getTableLocator()->get('OrderPayments');
        parent::__construct($request, $response, $name, $eventManager, $components);
    }

    public function index()
    {
       $reports = [];

        $this->set(compact('reports'));
        $this->render('finance');
    }

    public function finance($filter_date_range = null)
    {
        if ($this->request->is('ajax')){
            $filter_date_range = urldecode($filter_date_range);
            $range = explode('to', $filter_date_range);

            if (count($range) == 0) return $this->validationAction('Please select Date range to filter');
            if (!key_exists(1,$range)) $range[] = $range[0];

            $order_condition = [
                'order_status !=' => 4, 
                'date(order_date) >=' => $this->strtodate($range[0]),
                'date(order_date) <=' => $this->strtodate($range[1])
            ];

            $payment_condition = [
              'date(payment_date) >=' => $this->strtodate($range[0]),
              'date(payment_date) <=' => $this->strtodate($range[1]),
            ];

            $orderPayments = $this->OrderPayments->find('all',[
                'contain' => ['PayMethods']
            ])->where($payment_condition);

            $sales = array();
            $payments = array();

            $orders = $this->Orders->find('all')->where(['draft' => 0, $order_condition]);
            $orders_collections = new Collection($orders);
            $sales['order_total'] = $orders_collections->sumOf('sub_total');
            $sales['discounts'] = $orders_collections->sumOf('discount');
            $sales['shipping'] = $orders_collections->sumOf('shipping_fee');
            $sales['taxes'] = $orders_collections->sumOf('taxes');
            $sales['returns'] = 0;
            $sales['net_sales'] = $sales['order_total'] - ($sales['discounts'] + $sales['returns']);
            $sales['total_sales'] = $sales['net_sales'] + $sales['shipping'] + $sales['taxes'];
            $ordersl = $this->Orders->find('list')->where(['draft' => 0, $order_condition]);
            // pr($ordersl->toArray()); 
            
            
            $OrderProducts = TableRegistry::getTableLocator()->get('OrderProducts');
            if($ordersl->count()){
                $query = $OrderProducts->find(); 
                $orderProductsQty = $query
                    ->select(['total_quantity' => $query->func()->sum('OrderProducts.product_quantity')])
                    ->where(['OrderProducts.orders_id IN' => $ordersl->toArray()]);
                    
                // pr($orderProductsQty);
                $sales['total_quantity'] =  $orderProductsQty->first()->total_quantity; 
                // pr($sales);
            }
            else{
                $sales['total_quantity'] = 0;
            }


//        payment
            $payment_collection = new Collection($orderPayments);
            $PaymentMethods = TableRegistry::getTableLocator()->get('PaymentMethods');
            $methods = $PaymentMethods->find('all')->toArray();

            foreach ($methods as $p_method){
                $collection = $payment_collection->filter(function ($payment, $key) use ($p_method){
                    return $payment->payment_method == $p_method->id AND $payment->amount > 0;
                });

                $payments[] = [
                    'name' => $p_method->name,
                    'value' => $collection->sumOf('amount')
                ];
            }

//        total payment
            $total_payments = (new Collection($payments))->sumOf('value');

            $refunds = $payment_collection->filter(function ($payment, $key){
                return $payment->amount < 0;
            });
            $total_refunds = $refunds->sumOf('amount');
//            $total_due = $orders_collections->sumOf('');
            $this->set('sales', $sales);
            $this->set('total_payments', $total_payments);
            $this->set('total_refunds', $total_refunds );
//            $this->set('total_due', $total_due);
            $this->set('payments', $payments);
            $this->render('finance_content');
        }
        else{
            $this->render('finance');
        }
    }


    public function dailyReports($filter_date_range = null, $export = 0 )
    {

        if ($this->request->is('get')){
            $filter_date_range = urldecode($filter_date_range);
            $range = explode('to', $filter_date_range);

            if (count($range) == 0) return $this->validationAction(__('Please select Date range to filter'));
            if (!key_exists(1,$range)) $range[] = $range[0];

            $order_condition = [
                'order_status !=' => 4,
                'date(order_date) >=' => $this->strtodate($range[0]),
                'date(order_date) <=' => $this->strtodate($range[1])
            ];
            $sales = $this->Orders->find()
                ->select([
                    'order_date',
                    'total_order' => 'COUNT(*)',
                    'total_subtotal' => 'SUM(sub_total)',
                    'total_discount' => 'SUM(discount)',
                    'total_shipping_fee' => 'SUM(shipping_fee)',
                    'total_taxes' => 'SUM(taxes)',
                    'order_total_sum'=>'SUM(order_total)'
                ])
                ->where(['draft' => 0, $order_condition])->group('DATE(order_date)')->order(["Orders.order_date" => "DESC"])->toArray();
            
  
            if($export){
               $data = array();

                foreach($sales as $sale){
                    $data[] = [
                        'date'                  => $sale->order_date->format('Y-m-d'),
                        'total order'           => $sale->total_order,
                        'total subtotal'        => $sale->total_subtotal,
                        'total discount'        => $sale->total_discount,
                        'total shipping fee'    => $sale->total_shipping_fee,
                        'total taxes'           => $sale->total_taxes,
                        'total sales'           => $sale->order_total_sum
                    ];
                }
                
                $this->export_csv($data, 'daily-reports');
                return;
            }
            
            
            $this->set('sales', $sales);
            $this->render('daily_content');
        }
        else{
            $this->render('daily');
        }
    }

    public function customerOrdersReports($filter_date_range = null, $export = 0)
    {
        if ($this->request->is('ajax')){

            $filter_date_range = urldecode($filter_date_range);
            $range = explode('to', $filter_date_range);

            if (count($range) == 0) return $this->validationAction(__('Please select Date range to filter'));
            if (!key_exists(1,$range)) $range[] = $range[0];


            $order_condition = [
                'order_status !=' => 4,
                'date(order_date) >=' => $this->strtodate($range[0]),
                'date(order_date) <=' => $this->strtodate($range[1])
            ];

            $customer_orders = $this->Orders->find()
                ->select([
                    'customers_id',
                    'first_name' => $this->Orders->Customers->find('all')->select(['first_name'])->where(['id = customers_id']), // '(SELECT first_name FROM Customers WHERE id = customers_id)',
                    'last_name' =>  $this->Orders->Customers->find('all')->select(['last_name'])->where(['id = customers_id']) ,//'(SELECT last_name FROM Customers WHERE id = customers_id)',
                    'city' => $this->Orders->Customers->find('all')->select(['city'])->where(['id = customers_id']) ,//'(SELECT city FROM Customers WHERE id = customers_id)',
                    'total_order' => 'COUNT(*)',
                    'total_subtotal' => 'SUM(sub_total)',
                    'total_discount' => 'SUM(discount)',
                    'total_shipping_fee' => 'SUM(shipping_fee)',
                    'total_taxes' => 'SUM(taxes)',
                    'order_total_sum'=>'SUM(order_total)'
                ])
                ->where(['draft' => 0, $order_condition])->group('customers_id')->toArray();

                if($export){
                    $data = array();
     
                     foreach($customer_orders as $order){
                         $data[] = [
                             'customer name'         => $order->first_name . ' ' . $order->last_name,
                             'city'                  => $order->city,
                             'total order'           => $order->total_order,
                             'total subtotal'        => $order->total_subtotal,
                             'total discount'        => $order->total_discount,
                             'total shipping fee'    => $order->total_shipping_fee,
                             'total taxes'           => $order->total_taxes,
                             'total sales'           => $order->order_total_sum
                         ];
                     }
                     
                    $this->export_csv($data, 'customer-reports');
                }

            $this->set('customer_orders', $customer_orders);
            $this->render('customer_orders_content');
        }
        else{
            $this->render('customer_orders');
        }
    }

    public function productOrdersReports($filter_date_range = null, $export = 0)
    {
        if ($this->request->is('ajax')){
            $filter_date_range = urldecode($filter_date_range);
            $range = explode('to', $filter_date_range);

            if (count($range) == 0) return $this->validationAction(__('Please select Date range to filter'));
            if (!key_exists(1,$range)) $range[] = $range[0];

            $order_condition = [
                'date(created) >=' => $this->strtodate($range[0]),
                'date(created) <=' => $this->strtodate($range[1])
            ];

            $OrderProducts = TableRegistry::getTableLocator()->get('OrderProducts');

            $product_orders = $OrderProducts->find()
                ->select([
                    'product_title',
                    'product_sku',
                    'product_price',
                    'total_order' => 'COUNT(DISTINCT(orders_id))',
                    'total_quantity' => 'SUM(product_quantity)',
                ])
                ->where($order_condition)->group('products_id')->toArray();

            
            if($export){
                $data = array();
    
                    foreach($product_orders as $order){
                        $data[] = [
                            'product title'         => $order->product_title,
                            'product sku'           => $order->product_sku,
                            'product price'           => $order->product_price,
                            'total order'        => $order->total_order,
                            'total quantity'        => $order->total_quantity
                        ];
                    }
                    
                $this->export_csv($data, 'product-reports');
            }

            $this->set('proudct_orders', $product_orders);
            $this->render('product_orders_content');
        }
        else{
            $this->render('product_orders');
        }
    }

    public function orderPaymentReports($export= 0){

        $OrdersPayments = TableRegistry::getTableLocator()->get('OrderPayments');

        $data = $this->request->query;
        // pr($data);

        $condition = array();


        if(isset($data['order_id']) && $data['order_id'] > 1000){
            $condition['Orders.order_id'] = $data['order_id'];   
        }


        if(isset($data['payment_type']) && in_array($data['payment_type'], ['refund', 'payment'])){
            if($data['payment_type'] == 'refund')
                $condition['OrderPayments.amount <'] = 0;
            else
                $condition['OrderPayments.amount >'] = 0;
        }

        if(isset($data['date_range']) && !empty($data['date_range'])) {
            $filter_date_range = urldecode($data['date_range']);
            $range = explode('to', $filter_date_range);

            if (!key_exists(1,$range)) $range[] = $range[0];

            $cond = [
                'date(payment_date) >=' => $this->strtodate($range[0]),
                'date(payment_date) <=' => $this->strtodate($range[1])
            ];

            $condition = array_merge($condition, $cond);
        }




        if(count($condition)){
            $payments = $OrdersPayments->find('all')->where($condition)->contain([
                'PayMethods', 
                'Orders' => [
                    'Customers'
                ]
    
            ])->orderDesc('OrderPayments.id');
        }

        else{

            $payments = $OrdersPayments->find('all')->contain([
                'PayMethods', 
                'Orders' => [
                    'Customers'
                ]
    
            ])->orderDesc('OrderPayments.id');
        }

        if($export){
            $data = array();

                foreach($product_orders as $order){
                    $data[] = [
                        'product title'         => $order->product_title,
                        'product sku'           => $order->product_sku,
                        'product price'           => $order->product_price,
                        'total order'        => $order->total_order,
                        'total quantity'        => $order->total_quantity
                    ];
                }
                
            $this->export_csv($data, 'product-reports');
        }

        

        // pr($payments);

        // $this->set('payments', $payments);
        $this->set('payments', $this->paginate($payments));
        $this->render('payment_order');
    }

    
    
    /**
     * View method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $report = $this->Reports->get($id, [
            'contain' => [],
        ]);

        $this->set('report', $report);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $report = $this->Reports->newEntity();
        if ($this->request->is('post')) {
            $report = $this->Reports->patchEntity($report, $this->request->getData());
            if ($this->Reports->save($report)) {
                $this->Flash->success(__('The report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The report could not be saved. Please, try again.'));
        }
        $this->set(compact('report'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $report = $this->Reports->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $report = $this->Reports->patchEntity($report, $this->request->getData());
            if ($this->Reports->save($report)) {
                $this->Flash->success(__('The report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The report could not be saved. Please, try again.'));
        }
        
        $this->set(compact('report'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $report = $this->Reports->get($id);
        if ($this->Reports->delete($report)) {
            $this->Flash->success(__('The report has been deleted.'));
        } else {
            $this->Flash->error(__('The report could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    private function strtodate($date, $format = "Y-m-d"){
        return date($format,strtotime($date));
    }



    public function validationAction($errorMessage)
    {
        if ($this->request->is('ajax')){
            $response = [
                'status' => 'fail',
                'message' => $errorMessage
            ];
            $this->layout = "ajax";
            $this->set('data', $response);
            $this->set('_serialize', 'data');
            $this->RequestHandler->renderAs($this, 'json');
            return;
        }
        $this->Flash->error(__($errorMessage));
        return $this->redirect($this->referer());
    }


    public function export_csv($data, $filename) {

        // die("closed");
        if(!file_exists(UPLOAD)) mkdir(UPLOAD, 0777, true);

        $path = UPLOAD. $filename. '.csv';

        $output = fopen($path, "w");
        $header = array_keys($data[0]);

        fputcsv($output, $header); 

        foreach ($data as $line) 
            fputcsv($output, $line);
        
        /*
        $this->viewClass = 'Media';
        
        $params = array(
            'id'        => $filename . '.csv',
            'name'      => 'example',
            'extension' => 'csv',
            'download'  => true,
            'path'      => UPLOAD
        );
        $this->set($params);

        */
        header("Content-Disposition:attachment;filename={$filename}");
        $this->autoRender = false;
        $this->response->type('Content-Type: text/plain');
        $this->response->body(file_get_contents($path));


    }


    

}

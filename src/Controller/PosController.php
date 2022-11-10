<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;
use App\Model\Entity\Product;
use Cake\Core\Configure;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;
use  Cake\Log\Log;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\I18n\FrozenTime;
use Cake\Routing\Router;
use App\View\Helper\MediaHelper;
/**
 * Api Controller
 *
 *
 * @method \App\Model\Entity\Api[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PosController extends AppController
{

    public function beforeFilter(Event $event) {
        if($this->request->action != 'unauthorized'){
            $session = $this->request->session();
            $allow_user_role = [1, 2];
            if(!$session->read("user_logged_in") || in_array($session->read('user_role'), $allow_user_role) === false ){
                //$this->Flash->error(__('Authentication Failed, Please login first.'));
                return $this->redirect(['controller' => 'Pos', 'action' => 'unauthorized']);
                //$this->response = $this->redirect(['controller' => 'Pos', 'action' => 'unauthorized']);
               // $this->response->send();
                
            }
        }
    }



    public $paginate = [
        'page' => 1,
        'limit' => 10,
        'maxLimit' => 100,
    ];
    
    /**
     * @var bool|object
     */
    
    
    
    public function initialize()
    {
        parent::initialize();
        header("Access-Control-Allow-Origin: *");
        $this->loadComponent('Paginator');
        //$this->loadComponent('RequestHandler');
        Configure::write('Session', [ 'defaults' => 'php' ]);
    
        /*$this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'Customers',
                'action' => 'login'
            ],
            'authError' => 'Unauthorized Access',
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'email' => 'email',
                        'passwd' => 'passwd'
                    ],
                    'userModel'=>'Customers'
                ]
            ]
        ]);*/
        
        $this->loadModel('Products');
        $this->loadModel('ProductOptions');
        $this->loadModel('Categories');
        $this->loadModel('Carts');
    }
    


    public function unauthorized(){
        $this->responseJson('unauthorized', ['message' => 'Authentication failed, please login first.']);
    }

   /* public function index(){
        $this->request->session()->write('pos_data', 'pos');
        $this->layout = "ajax";
    }*/



    
    
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    
    // Example http://localhost/clcknshop/api/products/latest.json?category=1&limit=2&offset=1
    public function getProducts($category = NULL)
    {




       // $this->autoRender = false;
        $limit=10;
        $offset=1;
        if(!empty($this->request->params['?']['category']))
            $category=$this->request->params['?']['category'];
        
        if(!empty($this->request->params['?']['limit']))
            $limit=$this->request->params['?']['limit'];
    
        if(!empty($this->request->params['?']['offset']))
            $offset=$this->request->params['?']['offset'];
    
        /*$order=null;
        if(!empty($this->request->params['?']['order']))
            $order=$this->request->params['?']['order'];
        
         $conOrder=array();
        if ($order!=null)
            $conOrder=array('created' => $order);
        
        */
    
        //?category=1&limit=2&offset=1&sortType=title&sortValue=asc custom sort
    
        $sortType=null;
        if(!empty($this->request->params['?']['sortType']))
            $sortType=$this->request->params['?']['sortType'];
    
        $sortValue=null;
        if(!empty($this->request->params['?']['sortValue']))
            $sortValue=$this->request->params['?']['sortValue'];
        
        if ($sortType!=null && $sortValue!=null)
            $conOrder=array($sortType => $sortValue);
        else
            $conOrder=array('created' => 'DESC');
        
       // dd($conOrder);die();
        
        $conCategory=array();
        if ($category!=null)
            $conCategory=array('t.products_id = Products.id AND t.categories_id = '.$category);
    
        $products=$this->Products->find()
            ->order($conOrder)
            ->limit($limit)
            ->page($offset)
            ->join([
                't' => [
                    'table' => 'categories_has_products',
                    'type' => 'INNER',
                    'conditions' => $conCategory,
                ]])
            ->where(['Products.active=1'])
            ->all();
        
        
        // $products =  $this->Products->find('all')->contain('Tags');
        /*$products =  $this->Products->find('all')->contain(['Tags'=> function ($q) {
            return $q->where(['Tags.tag' => "test"]);
        }]);*/
        
        /* $products =  $this->Products->find('all')->join([
          't' => [
              'table' => 'products_has_tags',
              'type' => 'INNER',
              'conditions' => 't.products_id = Products.id AND t.tags_id = 1',
          ]]);*/
        
        //debug($products);
        //foreach ($products as $article) {
        // echo $article->tags[0]->text;
        //}
        //dd($products);die();
        $this->set(compact('products'));
        $this->set('_serialize', 'products');
    }
    
    
    public function homepage(){
    
    }
    
    public function category(...$path)
    {
        $categories=$this->Categories->find()
            ->order(['created' => 'DESC'])
            ->all();
        $this->set(compact('categories'));
        $this->set('_serialize', 'categories');
    }
    
    /*public function categories($categories=null)
    {
        $categories = $this->paginate($this->Categories);
        //dd($categories);die();
        $this->set(compact('categories'));
        $this->set('_serialize', 'categories');
    }*/
    
    /*public function product($slug = null){
        $product_details = $this->Products->findBySlug($slug)->firstOrFail();
    }*/
    
    public function product($id = null){
        $id=$this->request->getParam('id');
        $product_details = $this->Products->findById($id);
        $this->set(compact('product_details'));
        $this->set('_serialize', 'product_details');
    }
    
    public function cart()
    {
        $session = $this->getRequest()->getSession();
        $cart_sess_id = $session->read('Config.cart_session_id');
        $cart = $this->Carts->findByCartSession($cart_sess_id)->all();
        $this->set(compact('cart'));
        $this->set('_serialize', 'cart');
    }
    
//input postdata = array('product_id','product_options as array()');

    function addCart(){
        //$this->layout = false;
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'put']);
        
        $session = $this->getRequest()->getSession();
        $cart_sess_id = $session->read('Config.cart_session_id');
        if ($session->check('Config.cart_session_id') == false) {
            // generate a cart seesion id randomly
            $cart_sess_id   = uniqid();
             $session->write('Config.cart_session_id',$cart_sess_id);
        }
        $data=$this->request->getData();
        $data['cart_session']=$cart_sess_id;
        $cart=$this->Carts->newEntity($data);
        //$cart = $this->Carts->patchEntity($newcart, $cart);
        if ($this->Carts->save($cart)) {
            echo json_encode(array("Message"=>"Cart added successful!"));
        }else
            echo json_encode(array("Message"=>"Cart added failed!"));
    }
    
    
    public function signin()
    {
        //normal login api log in can be change
    
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'put']);
        
        if ($this->request->is('post')) {
            
            $user = $this->request->getData();
            //$user = $this->Auth->identify();
            print_r($user);die();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
                   }
    
    }


public function collection($slug = 'all'){
        $pos = $this->request->session()->read('pos_data');
        //pr($pos);
        //die();

      

        //echo "Collection";
        //$headers =  getallheaders();
        //pr($headers);

        //if($this->request->is('ajax')){

        //  die("ajax");
       // }
        
        $products = array();
        $page =$this->request->getQuery('page',"1");
        $search = $this->request->getQuery('q','');
        $limit =  $this->request->getQuery('limit',"20");
        $sort_by = $this->request->getQuery('sort-by',"");
        $price_range = $this->request->getQuery('price-range',"");  // 40-100
        $options = $this->request->getQuery('options',"");
        $tag = $this->request->getQuery('tag',"");
        $product_type = $this->request->getQuery('product-type',"");

        $pagination =new \stdClass;
        $pagination->total = 0;
        $pagination->count = 0;
        $pagination->cur_page = 0;
        $pagination->per_page = $limit;
        $pagination->total_page = 0;
        $collection  = null;


        $query = $this->Products->find('all')->where(["active"=>1])->contain('ProductVariants');


        if($slug != 'all'){
            $Categories = TableRegistry::getTableLocator()->get('Categories');
            $collection = $Categories->find('all')->where(['slug' => trim($slug)])->first();
            if(!$collection){
                 $query = $query->where(['id' => -10000]);
            }else{
                $query = $this->collection_query($collection,$query);
            }
        }



        if(!empty($options)){

           $opt_query = $this->Products->ProductOptions->find()->select("products_id");
           $options = explode(",",$options);
           foreach($options as $option){
              $opt_query->where(["FIND_IN_SET('$option',option_values) > 0"]);
           }

           $query = $query->where(['id IN' =>$opt_query]);


        }

        if($search)
            $query->where([
                'OR'=>[
                    'Products.title LIKE' => '%'.$search.'%',
                    'Products.vendor LIKE' => '%'.$search.'%'
                ]
            ]);

        if(!empty($price_range)){
          $prices = explode("-",$price_range);
          if(isset($prices[1])){
            $query->where("price between {$prices[0]} AND {$prices[1]} ");
          }
        }

        if(!empty($tag)){
          $query->where(["FIND_IN_SET('$tag',tags) > 0"]);
        }

        if(!empty($product_type)){
          $query->where(["product_type LIKE '%$product_type%'"]);
        }


        switch ($sort_by) {
          case 'title-ascending':
            $query->order(['title' => 'ASC']);
            break;

          case 'title-descending':
            $query->order(['title' => 'DESC']);
            break;

          case 'price-ascending':
            $query->order(['price' => 'ASC']);
            break;


          case 'price-descending':
            $query->order(['price' => 'DESC']);
            break;

          case 'created-ascending':
            $query->order(['created' => 'ASC']);
            break;

          case 'created-descending':
            $query->order(['created' => 'DESC']);
            break;

          default:
            $query->order(['title' => 'ASC']);
            break;
        }


        $total_products = $query->count();
        $products = $query
            ->limit($limit)
            ->page($page)
            ->all();
        $pagination->total = $total_products;
        $pagination->count = sizeof($products);
        $pagination->cur_page = $page;
        $pagination->per_page = $limit;
        $pagination->total_page = floor($pagination->total/$limit);
        if($pagination->total % $limit != 0)
            $pagination->total_page += 1;

        $collection_title = "All Products";

        if($collection)
            $collection_title = $collection->name;
        if($product_type)
            $collection_title = $product_type;

        if($search)
           $collection_title = $search;


        $this->set(compact('pagination','products', 'collection_title'));
        $this->set('slug',$slug);

        if ($this->request->is('json')){




           // $accepts = $this->request->accepts();
           // if($this->request->accepts('application/json')){
                $mediaH = new MediaHelper(new \Cake\View\View());
                foreach($products as $product){
                  $product->virtualProperties(['image','variants']); #Gel Virtual field


                    foreach($product->product_variants as $variant){
                        $variant->option_values = json_decode($variant->option_values);
                        $variant->virtualProperties(['image']);

                    }

                  
                   // $image = $mediaH->productImage($product->image, $product->id, [
                   //   'path' => true,
                   //   'height' => 64,
                   //   'width' => 64
                   // ]);       
                   // pr($image);         

                }

                

                $this->set('products', $products);
                $this->set('_serialize', 'products');
                $this->RequestHandler->renderAs($this, 'json');
            //}
        }
    }

    protected function collection_query($collection,$query){

            $CategoriesHasProducts = TableRegistry::getTableLocator()->get('CategoriesHasProducts');

            if ($collection->manual_matching){
    //                    manual matching
                $query = $query->where(['id IN' => $CategoriesHasProducts->find()->select('products_id')->where(['categories_id' => $collection->id])]);
            }else{
    //                    automatic matching
                $match_con = $collection->match_cond;
                $match_con = json_decode($match_con, true);
                $fields = [
                    'title_match' => 'title',
                    'type_match' => 'product_type',
                    'tag_match' => 'tags',
                ];
                $sql = "";
                foreach ($match_con as $key => $con){
                    if (isset($con) && !empty($con)){
                        $arr = explode(',', trim($con));
                        foreach ($arr as $ar){
                            $sql .= $fields[$key] . " LIKE '%". $ar ."%' OR ";
                        }
                    }
                }

                $sql = substr($sql, 0, -3);
                 $query =  $query->where($sql);
            }

            return $query;
        }




    public function collections(){

        header("Access-Control-Allow-Origin: *");

        $Categories = TableRegistry::get('Categories');


        $collections = $Categories->find('list', [
                'keyField' => 'slug',
                'valueField' => 'name'
            ])->toArray();;

        if ($this->request->is('json')) {

            $this->set('collections', $collections);
            $this->set('_serialize', 'collections');
            $this->RequestHandler->renderAs($this, 'json');
            
        }

    }

    public function productTypes(){
         header("Access-Control-Allow-Origin: *");

        $Products = TableRegistry::get('Products');
        $types = $Products->find('list', [
             'keyField' => 'id',
            'valueField' => 'product_type'
            ])->distinct('product_type')->toArray();;


        if ($this->request->is('json')) {

            $this->set('types', array_values($types));
            $this->set('_serialize', 'types');
            $this->RequestHandler->renderAs($this, 'json');
            
        }

    }


    public function customerList()
    {
      header("Access-Control-Allow-Origin: *");

      $Customers = TableRegistry::get('Customers');

      $q = '';
      if(isset($_GET['q'])) $q = $_GET['q'];
      $query = $Customers->find('all', [
          'conditions' => ['OR'=>['Customers.last_name LIKE' => '%' . $q . '%' ,'Customers.first_name LIKE' => '%' . $q . '%']]

      ]);

      $data = $query->toArray();
      $customerlist = [];
      // $customerlist[] = ['value'=>0,'text'=>'Add new customer','data'=>[]];
      foreach ($data as $key => $customer) {
      //  debug($customer);
        $customerar  = $customer->toArray();
        unset($customerar['token']);
        unset($customerar['username']);
        unset($customerar['passwd']);
        unset($customerar['created']);
        unset($customerar['modified']);

        $customerlist[] = $customerar;

        //$customerlist[] = ['value'=>$customer->id,'text'=>$customer->first_name . " " . $customer->last_name . "," . $customer->address . "," . $customer->city ,'data'=>$customer->toArray()];
      }
      $this->set(compact('customerlist'));
      $this->set('_serialize', 'customerlist');

    }

    public function paymentMethod(){

        header("Access-Control-Allow-Origin: *");
        $PaymentMethod = TableRegistry::get('PaymentMethods');
        
        /*$paymentMethods = $PaymentMethod->find('list',[
            'keyField' => 'id',
            'valueField' => 'name'

        ])->where(['status' => 1])->toArray();

        */
        $methods = array();

        $paymentMethods = $PaymentMethod->find('all')->where(['status' => 1])->all();

        foreach($paymentMethods as $method){
            $methods[] = [
                'id' => $method->id,
                'name' => $method->name
            ];
        }
        
        if ($this->request->is('json')) {

            $this->set('methods', $methods);
            $this->set('_serialize', 'methods');
            $this->RequestHandler->renderAs($this, 'json');
            
        }

    }





    public function orderCreate(){

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT');
        header('Access-Control-Allow-Headers: Content-Type');

        
        if($this->request->is('options')) die();

        

        if ($this->request->is('post')) {
            // $InventoryLog = TableRegistry::getTableLocator()->get('InventoryLogs');
           
            $Orders = TableRegistry::getTableLocator()->get('Orders');
            $Products = TableRegistry::getTableLocator()->get('Products');
            $ProductVariants = TableRegistry::getTableLocator()->get('ProductVariants');
            $Customers = TableRegistry::getTableLocator()->get('Customers');
            $OrderPayments = TableRegistry::getTableLocator()->get('OrderPayments');

            $PaymentMethods = TableRegistry::getTableLocator()->get('PaymentMethods');
            $methods = $PaymentMethods->find('list',[
                'keyField' => 'id',
                'valueField' => 'name'
            ])->where(['status' => 1])->toArray();

            $data = $this->request->getData();

            $validation_status = false;
            $validation_errors = array();

            foreach ($data['cartItems'] as $key => $item) {
                if($item['variant_id'] > 0){
                    $variant = $ProductVariants->find()->select(['q_available'])->where(['id' => $item['variant_id']])->first();
                    
                    if ($variant) {
                        if ($item['quantity'] > $variant->q_available && $variant->sell_w_stock == 1) {
                            $validation_errors[] = [
                                'title' => $item['title'] . " " .str_replace(":", "-", preg_replace( "/\"|{|}/", "", $item['options'] )),
                                'error' => "There are not enough product in stock." 

                            ];
                            $validation_status = true;

                        }

                    }
                    else{
                        $validation_errors[] = [
                            'title' => $item['title'],
                            'error' => "Product Variant does not exist."

                        ];
                        $validation_status = true;
                    }                 
                }

                else{

                    $product = $Products->find()->select(['q_available'])->where(['id' => $item['id']])->first();
                    

                    if ($product) {
                        if ($item['quantity'] > $product->q_available && $product->sell_w_stock == 1) {
                            $validation_errors[] = [
                                'title' => $item['title'],
                                'error' => "There are not enough product in stock."

                            ];
                            $validation_status = true;

                        }

                    }
                    else{
                        $validation_errors[] = [
                            'title' => $item['title'],
                            'error' => "Product does not exist."

                        ];
                        $validation_status = true;
                    } 
                }

            }

            if ($validation_status) {
                
                $this->responseJson('fail', $validation_errors);
                return;

            }

            //pr($data);
            //die();


            $orderData = array();
            $orderData['order_id'] = $Orders->generateOrderId();
            $orderData['order_password'] = $Orders->generateOneTimePassword();



            if (array_key_exists('id', $data['customer']) && $data['customer']['id'] > 0) {
                $orderData['customers_id']  = $data['customer']['id'];
            }

            else{

                $customer = $Customers->newEntity();
                $customer = $Customers->patchEntity($customer, $data['customer']);

                if($Customers->save($customer)){
                    $orderData['customers_id'] = $customer->id;
                }

                else{
                   $this->responseJson('fail', $customer->errors());
                   return;

                }


            }


            $orderData['shipping_address']   = json_encode($data['customer']);
            $orderData['sub_total']         = $data['subtotal'];
            $orderData['discount']          = $data['discount'];
            $orderData['taxes']             = $data['tax'];
            $orderData['order_total']       = $data['total'];
            $orderData['total_paid']        = $data['total_paid'];
            $orderData['order_status']      = 0;
            $orderData['order_date']        = FrozenTime::now();

            $order = $Orders->newEntity();
            $order = $Orders->patchEntity($order, $orderData);
            $default_image  = null;

            if ($Orders->save($order)) {


                
                foreach ($data['cartItems'] as $key => $item) {
                    

                    if (array_key_exists('variant_id', $item) && $item['id'] > 0) {
                        
                        $variant = $ProductVariants->find('all')->where(['id' => $item['variant_id']])->first();
                        if ($variant)
                            $default_image = PRODUCT_IMAGE_PATH . DS . $item['id'] . DS . $variant->defaultImage;
                    }
                    else{

                        $product = $Products->find('all')->where(['id' => $item['id']])->first();
                            if ($product)
                                $default_image = PRODUCT_IMAGE_PATH . DS . $item['id'] . DS . $product->defaultImage;
                    }

                    $productData = array();

                    $productData['orders_id']               = $order->id;
                    $productData['products_id']             = $item['id'];
                    $productData['product_variants_id']     = $item['variant_id'];
                    $productData['product_title']           = $item['title'];
                    $productData['product_options']         = str_replace(":", "-", preg_replace( "/\"|{|}/", "", $item['options'] ));
                    $productData['product_sku']             = $item['sku'];
                    $productData['product_price']           = $item['price'];
                    $productData['product_quantity']        = $item['quantity'];
                    $productData['product_image']           = $item['image'];

                    $order_product = $Orders->OrderProducts->newEntity();
                    $order_product = $Orders->OrderProducts->patchEntity($order_product, $productData);

                    if(!$Orders->OrderProducts->save($order_product)){
                        $this->responseJson('fail', $order_product->errors());
                        return;
                    }



                    if(isset($data['draft']) && $data['draft'] ==1) continue;

                    $Products->updateQuantity($item['id'], [
                            'order_id' => $order->id,
                            'variant_id' => $item['variant_id'],
                            'quantity' => $item['quantity'],
                            'action' => 'remove',
                            'uid' => 1//$this->request->session()->read('user.id')
                        ]);

                }

                 $Orders->addOrderLog($order->id,[
                        'status' => $data['total_due'] > 0 ? 1 : 3,
                        'by' => $this->request->session()->read('user.first_name') // authenticate user
                    ]);


                 //MAKE A PAYMENT
                    if($order->total_paid > 0 ){
                        $payment = [
                            'orders_id' => $order->id,
                            'amount'    => $order->total_paid,
                            'payment_date'   => FrozenTime::now(),
                            'payment_method' => $data['payment_method']

                        ];

                        $orderPayment = $OrderPayments->newEntity();
                        $orderPayment = $OrderPayments->patchEntity($orderPayment, $payment);

                        if (!$OrderPayments->save($orderPayment)) {
                            
                            $this->responseJson('fail', $orderPayment->errors());
                            return;
                            
                        }

                        $Orders->addOrderLog($order->id,[
                            'status' => 5,
                            'notes' => "Tk ". $order->total_paid ." paid by ".$methods[$data['payment_method']],
                            'by' => $this->request->session()->read('user.first_name')
                        ]);
                    }

                //SEND SUCCESS RESPONSE
                 
                 $this->responseJson('success', [
                        'customer' => $data['customer']['first_name'] . " " . $data['customer']['last_name'],
                        'phone'     => $data['customer']['phone'],
                        'invoice_url' => Router::url('admin/orders/invoice/'.$order->order_id."/".$order->order_password, true),
                        'order_id' => $order->order_id,
                        'order_password' => $order->order_password,
                        'order_total'    => $order->order_total,
                        'total_paid'     => $order->total_paid,
                        'total_due'      => ($order->order_total - $order->total_paid),
                        'order_date'     => $order->order_date->format("d-m-Y h:i:s")

                      ]);


            }
            else{
                
                $this->responseJson('fail', $order->errors());
                return;
            }

        }

       // die();
            
    }

    public function responseJson($status, $data = []){
        //echo "Testing.......";
        $response = [
            'status' => $status,
            'data'  => $data
        ];
        //pr($response);


        $this->set('response', $response);
        $this->set('_serialize', 'response');
        $this->RequestHandler->renderAs($this, 'json');

        //die();
    }


}
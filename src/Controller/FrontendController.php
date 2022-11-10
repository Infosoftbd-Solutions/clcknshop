<?php
namespace App\Controller;

use App\Controller\AppController;
use App\View\Helper\MediaHelper;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Core\Configure;
use stdClass;


/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 *
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FrontendController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadModel('Products');
        $this->loadModel('Categories');
        $this->loadModel('Carts');


    }
    public function beforeFilter(\Cake\Event\Event $event){
        $theme = Configure::read("App.theme");
       if(empty($theme) ){
        
        if($this->request->getSession()->read('user_logged_in')== true){
            $this->Flash->error("No theme installed. Please install a theme to configure your frontend.");
            $this->redirect(['controller'=>'themes','action'=>'install','prefix'=>'admin']);
        }else{
           
            $this->redirect('/error');
           
            return; 
        }

       }
       parent::beforeFilter($event);
    }
    
    public function beforeRender(\Cake\Event\Event $event)
    {
   
       $theme = Configure::read("App.theme");
   

       $store_name = Configure::read('App.store_title',"Clcknshop");
       $this->set('theme',$theme);
       $this->set('store_name',$store_name);

       $this->set('theme_root',Router::url('/') . THEMES . $theme . "/assets/");
       $this->set('cdn_root',Configure::read("cdn_server",Router::url('/') . 'themestore/cdn/') . $theme . "/");

       $this->set('uri_root',Router::url('/'));
       $this->set('request_uri',$_SERVER['REQUEST_URI']);


       $cart_count = 0;
       if($this->request->session()->check('carts'))
       foreach ($this->request->session()->read('carts') as $p)
          $cart_count += $p['quantity'];


       $this->set('cart_count',$cart_count);


        if ($this->request->is('ajax')){
            $this->layout="ajax";
        }else{
            $this->viewBuilder()->layout('frontend');
        }
    }
    public function error(){


    }

    public function homepage(){

     // write code here

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function collection($slug = 'all')
    {
      header("Access-Control-Allow-Origin: *");

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


        //$query = $this->Products->find('all')->where(["active"=>1])->contain('ProductVariants');
        $query = $this->Products->find('all')->where(["active"=>1]);


        if($slug != 'all'){
            $Categories = TableRegistry::getTableLocator()->get('Categories');
            $collection = $Categories->find('all')->where(['slug' => trim($slug)])->first();
            if(!$collection){
                // $query = $query->where(['id' => -10000]);
                 $this->Flash->error("Collection $slug not found . Instead showing all products");
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
                $mediaH = new MediaHelper(new \Cake\View\View());
                foreach($products as $product){
                  $product->virtualProperties(['image','variants']); #Gel Virtual field


                    foreach($product->product_variants as $variant){
                        $variant->option_values = json_decode($variant->option_values);
                        $variant->virtualProperties(['image']);

                    }

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

    public function product($slug = null){
        //$slug=$this->request->getParam('slug');
      //  $this->Products->virtualProperties(['max_stock']);
      //  $this->Products->ProductVariants->virtualProperties(['max_stock']);
        $product = $this->Products->find('all')->where(["Products.slug"=>$slug])->contain(['ProductOptions','ProductVariants'=>
            function($q){
            return $q->where(['OR'=>['ProductVariants.sell_w_stock' => 1,'ProductVariants.q_available >' => 0]]);
        },'Reviews'=>
        function($q){
            return $q->where(['Reviews.status' => 1])->contain('Customers');
        }, 'ProductMedia'])->first();




        if ($product) {
            if ($this->request->session()->check('viewed_products')) {
                $recent_products = $this->request->session()->read('viewed_products');
                if (($key = array_search($product->id, $recent_products)) !== false) {
                    unset($recent_products[$key]);
                }
                array_push($recent_products, $product->id);
                $this->request->session()->write('viewed_products', $recent_products);
            } else {
                $this->request->session()->write('viewed_products', [$product->id]);
            }

            if(sizeof($product->product_variants) > 0){
              $variant = $product->product_variants[0];
              $product->price = $variant->price;
              $product->compare_price = $variant->compare_price;
              $product->q_available = $variant->q_available;
              $product->sell_w_stock = $variant->sell_w_stock;
              $product->sku = $variant->sku;
            }
        }else{
            return $this->redirect($this->referer());
        }

       if($this->request->is('post')){
          $options = $this->request->getData()['option'];

          $option_data = json_encode($options);
          foreach($product->product_variants as $variant){
              //echo $variant->option_values;
            if($variant->option_values == $option_data){
              $this->set('data', $variant);
              $this->set('_serialize', 'data');
              $this->RequestHandler->renderAs($this, 'json');
              return;
            }

          }
          $this->set('data', []);
          $this->set('_serialize', 'data');
          $this->RequestHandler->renderAs($this, 'json');
          return;

       }

       $product->virtualProperties(['max_stock']);
       foreach($product->product_variants as $variant)
          $variant->virtualProperties(['max_stock']);



       $this->set(compact('product'));
       if ($this->request->is('ajax')){
           if($this->request->accepts('application/json')){
             $this->set('_serialize', 'product');
             $this->RequestHandler->renderAs($this, 'json');
           }
       }





    }

    public function addToCart()
    {


        $carts = [];
        if ($this->request->session()->check('carts')) $carts = $this->request->session()->read('carts');
        $data = $this->request->getData() ? $this->request->getData() : $_GET;
        $pid = (isset($data['product_id']) && empty(trim($data['product_id'])) == false) ? (int) trim($data['product_id']) : 0;
        $vid = (isset($data['variant_id']) && empty(trim($data['variant_id'])) == false ) ? (int)trim($data['variant_id']) : 0;
        $qnty = (isset($data['quantity']) && empty(trim($data['quantity'])) == false) ? (int)trim($data['quantity']) : 1;


        $product = $this->Products->find('all')->where(['id' => $pid])->contain('ProductVariants')->first();
        if ($product->product_variants && $vid == 0){
            $this->Flash->error('Please choose your favorite variant.');
            return $this->redirect(['action' => 'product', $product->slug]);
        }

        if (key_exists('action', $data) && $data['action'] == 'buy_now'){
            $buyNowCart[] = [
                'product_id' => $pid,
                'variant_id' => $vid,
                'quantity' => $qnty
            ];
            $this->request->session()->write('buyNowCart', $buyNowCart);
            return $this->redirect(['controller' => 'checkout', 'action' => 'index']);
        }



        if (!$product) return $this->validationAction("The Product  does not exist.");
        if ($product->active == false) return $this->validationAction('The product does not allow purchase');

        if ($product->product_variants){
            $product = $this->Products->ProductVariants->find("all")->where(["products_id"=>$pid,"id"=>$vid])->first();
            if (!$product)  return $this->validationAction('Please choose your favorite variant.');
        }

        if($product->price <= 0) $this->validationAction("Product can not be buy for invalid price information");
        if($product->q_available < $qnty && $product->sell_w_stock == false) return $this->validationAction("Product can not be buy due to stock");

        $key = (string) $pid . (string) $vid;
        if (key_exists($key, $carts)) {
            if (($carts[$key]['quantity'] + $qnty) > $product->q_available && $product->sell_w_stock == false) return $this->validationAction("Product can not be buy due to stock");
            $carts[$key]['quantity'] += $qnty;
        }
        else{
            $carts[$key] = [
                'product_id' => $pid,
                'variant_id' => $vid,
                'quantity' => $qnty
            ];
        }

        $this->request->session()->write('carts', $carts);

        if ($this->request->is('ajax')){
            $response = [
                'status' => 'success',
                'message' => 'Item added to cart successfully'
            ];

            $this->layout = "ajax";
            $this->set('data', $response);
            $this->set('_serialize', 'data');
            $this->RequestHandler->renderAs($this, 'json');
            return;
        }

        $this->autoRender = false;
        $this->Flash->success(__('Item added to cart successfully'));
        return $this->redirect(['action' => 'cart']);
    }


        private function cartProducts($carts = array()){
          //  $Products = TableRegistry::getTableLocator()->get('Products');
          //  $product_variants = TableRegistry::getTableLocator()->get('ProductVariants');
            $cart_products = [];
            $order = array();
            $order['subtotal'] = 0;

            foreach ($carts as $cart){
                $item = [];

                if (isset($cart['variant_id']) && $cart['variant_id'] != 0){
                    $variant = $this->Products->ProductVariants->get($cart['variant_id'],[
                        'contain' => 'Products'
                    ]);
                    if ($variant){
                        $item['id'] = $variant->product->id;
                        $item['vid'] = $variant->id;
                        $item['title'] = $variant->product->title;
                        $item['link'] = $variant->product->link;
                        $item['option'] = $variant->option_text;
                        $item['sku'] = $variant->sku;
                        $item['price'] = $variant->price;
                        $item['discount'] = $variant->compare_price > $variant->price ? ($variant->compare_price - $variant->price) : 0;
                        $item['total'] = $variant->price * $cart['quantity'];
                        $item['weight'] = $variant->weight;
                        if($variant->q_available < $cart['quantity'] && $variant->sell_w_stock == false)
                            $item['out_of_stock'] = true;
                        else
                          $item['out_of_stock'] = false;
                        $item['quantity'] = $cart['quantity'];
                        $item['image'] = $variant->product->image;
                        $item['imagepath'] = $variant->product->image;
                    }
                }
                else{
                    $product = $this->Products->get($cart['product_id']);
                    if ($product){
                        $item['id'] = $product->id;
                        $item['vid'] = 0;
                        $item['title'] = $product->title;
                        $item['link'] = $product->link;
                        $item['option'] = "";
                        $item['sku'] = $product->sku;
                        $item['price'] = $product->price;
                        $item['discount'] = ($product->compare_price > $product->price) ? ($product->compare_price - $product->price) : 0;
                        $item['total'] = ($product->price * $cart['quantity']);
                        $item['weight'] = $product->weight;
                        $item['quantity'] = $cart['quantity'];
                        if($product->q_available < $cart['quantity'] && $product->sell_w_stock == false)
                          $item['out_of_stock'] = true;
                        else
                          $item['out_of_stock'] = false;

                        $item['image'] = $product->image;
                        $item['imagepath'] = $product->image;
                    }
                }
                $order['subtotal'] += $item['price'] * $item['quantity'];
                $cart_products[] = $item;
            }

          //  $this->request->session()->write('order', $order);
        //    $this->request->session()->write('cart_products', $cart_products);
            return $cart_products;
        }


    public function getCartItems(){
      if ($this->request->session()->check('carts') && count($this->request->session()->read('carts')) != 0){
          $cart_products = $this->cartProducts($this->request->session()->read('carts'));
      }else{
          $cart_products = [];
      }

     $cart_items = array();

      foreach ($cart_products as $p){

          $object = new stdClass();
          foreach ($p as $key => $value)
          {
              $object->$key = $value;
          }
          $cart_items[] = $object;
      }
     return $cart_items;

    }

    public function cart()
    {
    //  pr($this->request->session()->read('carts'));
        if ($this->request->is('post')){
            $data = $this->request->getData();
            //pr($data);
            //die();
            $carts = [];
            if (count($data) > 0){
                foreach ($data['product_id'] as $key => $pid){
                    $product = $this->Products->find('all')->where(['id' => $data['product_id'][$key]])->first();
                    $is_active_product = $product->active;

                    if ($data['variant_id'][$key] > 0)
                        $product = $this->Products->ProductVariants->find("all")->where(["products_id"=>$data['product_id'][$key],"id"=>$data['variant_id'][$key]])->first();

                    if ($is_active_product == false) return $this->validationAction('The product does not allow purchase');
                    if(!$product) return $this->validationAction("Product or variant does not exist.");
                    if($product->price <= 0) $this->validationAction("Product can not be buy for invalid price information");
                    if($product->q_available < $data['quantity'][$key] && $product->sell_w_stock == false) return $this->validationAction("Product can not be buy due to stock");

                    $carts[] = [
                        'product_id' => $data['product_id'][$key],
                        'variant_id' => $data['variant_id'][$key],
                        'quantity' => $data['quantity'][$key]
                    ];
                }
            }
            $this->request->session()->write('carts',$carts );

        }else{

          $action = $this->request->getQuery('action',"");

          if(!empty($action)){

              if($action == "remove"){

                 $carts = $this->request->session()->read('carts');
                 $p_id =  $this->request->getQuery('p_id',"");
                 $v_id =  $this->request->getQuery('v_id',"");
                 //echo $p_id . " " . $v_id; die();
                 foreach($carts as $key=>$cart)
                   if($cart['product_id'] == $p_id && $cart['variant_id'] == $v_id)
                      unset($carts[$key]);
                  $this->request->session()->write('carts',$carts );
                  return $this->redirect($this->referer());


              }

          }

        }

        $cart_items = $this->getCartItems();


        //$this->set('referer', $this->referer());
        $this->set('cart_products', $cart_items);
        if ($this->request->is('ajax')){
            if($this->request->accepts('application/json')){
              $this->set('_serialize', 'cart_products');
              $this->RequestHandler->renderAs($this, 'json');
            }
        }

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


    public function image(){
         $mediaH = new MediaHelper(new \Cake\View\View());
         $size = $this->request->getQuery('size');
         $path = $this->request->getQuery('src');

         $options = ['path'=>true];
         if(!empty($size)){
             $size = explode('x',$size);
             if(isset($size[0])){
                 $options['width']= $size[0];
             }
             if(isset($size[1])){
                 $options['height']= $size[1];
             }
         }
         $this->redirect($mediaH->image($path,$options));

    }

    public function search(){

        if (!isset($_GET['keyword']) || empty($_GET['keyword']))
            return $this->redirect(['action' => 'homepage']);


        $keyword = $_GET['keyword'];
        $products = array();
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 12;
        $pagination =new \stdClass;
        $pagination->total = 0;
        $pagination->count = 0;
        $pagination->cur_page = 0;
        $pagination->per_page = $limit;
        $pagination->total_page = 0;

        $query = $this->Products->find('all')->where([
            'OR'=>[
                'Products.title LIKE' => '%'.$keyword.'%',
                'Products.vendor LIKE' => '%'.$keyword.'%',
                'Products.tags LIKE' => '%'.$keyword.'%',
                'Products.product_type LIKE' => '%'.$keyword.'%'
            ]
        ]);

        if((is_array($query) && count($query) > 0) || (is_object($query) && $query->count()  > 0)){
            $total_products = is_array($query) ? count($query) : $query->count();
            $products = $query->order(['created' => 'DESC'])
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
        }

        $this->set(compact('pagination','products'));
        $this->set('keyword',$keyword);
    }


    public function newsletter()
    {

        if ($this->request->is('post')){
            $Newsletter = TableRegistry::getTableLocator()->get('Newsletter');
            $email = $this->request->getData('email');

            if(empty($email) == false){
                $newsletter = $Newsletter->newEntity();
                $newsletter = $Newsletter->patchEntity($newsletter, ['email' => $email]);
                if ($Newsletter->save($newsletter)){
                    $this->Flash->success('Your newsletter subscription has been enabled');
                    return $this->redirect(['action' => 'homepage']);
                }
                else{
                    //pr($newsletter->errors());
                    //die();

                    $this->Flash->error('Ops! There was something wrong, please try again');
                    return $this->redirect(['action' => 'homepage']);
                }
            }
        }

        return $this->redirect(['action' => 'homepage']);
    }

    public function applyCoupon()
    {



    }


    public function signin()
    {

    }









    public function review()
    {
        $this->autoRender = false;
        if ($this->request->is('post') && $this->request->session()->read('customer_logged_in') == true) {
            $Reviews = TableRegistry::getTableLocator()->get('Reviews');
            $customer = $this->request->session()->read('customer');
            $data = $this->request->getData();

//            pr($data);
//            die();
            $data['customer_id'] = $customer->id;
            $review = $Reviews->newEntity();
            $review = $Reviews->patchEntity($review, $data);
            if ($Reviews->save($review))
                $this->Flash->success(__('The review has been saved.'));
            else
                $this->Flash->error(__('The review could not be saved. Please, try again.'));

            pr($review->errors());
        }

        return $this->redirect($this->referer());
    }

    public function page($slug = null)
    {
        $this->set('slug', $slug);
    }

    public function contact()
    {
        $Contacts = TableRegistry::getTableLocator()->get('Contacts');
        $contact = $Contacts->newEntity();
        if ($this->request->is('post')) {
            $contact = $Contacts->patchEntity($contact, $this->request->getData());
            if ($Contacts->save($contact))
                $this->Flash->success(__('The contact has been saved.'));
            else{
                $this->Flash->error(__('The contact could not be saved. Please, try again.'));
                pr($contact->getErrors());
                die();
            }
        }

        return $this->redirect($this->referer());
    }

    public function sitemap($type = 'xml'){
       

        $sitemap    = Configure::read('App.sitemap');
        
   
        

        if(file_exists(UPLOAD. $sitemap) && !empty($sitemap)){
           // echo "test";
            $this->autoRender = false;
            $this->response->type('Content-Type: text/xml');
            $content = file_get_contents(UPLOAD.$sitemap);
            $this->response->body($content);

        }
        else{
            
            $Categories = TableRegistry::getTableLocator()->get('Categories');
            $Products = TableRegistry::getTableLocator()->get('Products');
            $urls       = array(); 

            $url = new stdClass();
            $url->URL = router::url('/',true);
            $url->LASTMOD = date(DATE_ATOM,time());
            $urls = [$url];


            $categories = $Categories->find('all')->all();

            foreach($categories as $category){
                
                $url = new stdClass();
                $url->URL = Router::url('/collection/' . $category->slug, true);
                $url->LASTMOD = date(DATE_ATOM,time());
                $urls[] = $url;

            }
            
            $products = $Products->find('all')->where(['active'=>1])->all();

            foreach($products as $product){
                $url = new stdClass();
                $url->URL = Router::url('/product/' . $product->slug, true);
                $url->LASTMOD = date(DATE_ATOM,time());
                $urls[] = $url;
            }
            
            $this->set('urls',$urls);

            if($type == 'xml') {
                $this->response->type('Content-Type: text/xml'); 
                $this->render('sitemap.xml','ajax');
            }else $this->render('sitemap.txt','ajax');
        }

    }

    public function robots(){
        
        $robotstxt =  Configure::read('App.robotstxt');

        $newline = "\r\n";
        $this->autoRender = false;
        $this->response->type('Content-Type: text/plain');

        if($robotstxt && file_exists(UPLOAD. $robotstxt)){
            $content = file_get_contents(UPLOAD.$robotstxt);
            $this->response->body($content);
        }
        else{
            $this->response->body(
                'User-agent: *'  . $newline . 
                'Allow: /' .  $newline. $newline . 
                'User-agent: *'  . $newline .  
                'Disallow: /admin' . $newline . $newline . 
                "Sitemap: " . router::url('/',true). "sitemap.xml"
                );
        }
       

    }

    public function docs(){
        return $this->redirect('/docs/index.html');
    }
    public function pos(){
        return $this->redirect('/pos/index.html');
    }
}

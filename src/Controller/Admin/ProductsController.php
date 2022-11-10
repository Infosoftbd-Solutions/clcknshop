<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Collection\Collection;
use Cake\ORM\TableRegistry;
use Cake\Database\Expression\QueryExpression;
use Cake\Event\Event;
use function GuzzleHttp\Psr7\_parse_request_uri;
use App\View\Helper\MediaHelper;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
/*
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
    }

    public function beforeFilter(Event $event) {
        pr('test');
        if (in_array($this->request->action, ['editfield'])) {
            $this->eventManager()->off($this->Csrf);
        $this->getEventManager()->off($this->Csrf);
        }
    }
*/




public function index($c_id = null)
{

    $products = $this->Products->find('all');
    if(!$c_id)
      $c_id = $this->request->query('c_id');

    if($c_id){
        $products = $this->filterByCollection($c_id);
    }

    $search = $this->request->query('q');
    if(!empty($search)){
      $products = $products->where([
          'OR'=>[
              'Products.title LIKE' => '%'.$search.'%',
              'Products.vendor LIKE' => '%'.$search.'%'
          ]
      ]);

    }

    $products = $this->paginate($products);


    $Collection = TableRegistry::getTableLocator()->get('Categories');
    $collections = $Collection->find('all')->toArray();
    $this->set(compact('products', 'collections','c_id'));

    if ($this->request->is('ajax')){

        $this->layout="ajax";
        $this->render('products_display');
    }


}

    public function image($product_id,$image_name,$size){
        //$this->redirect('/uploads/demo2/products/1/resize/apple-iphone-12-64gb-27-12-2020-1609051530246-42x42.jpg');

        $builder = $this->viewBuilder();

        // configure as needed
        $builder->autoLayout(false);
        $builder->template('Admin/Products/image');
        $builder->helpers(['Media']);
        $path = PRODUCT_IMAGE_PATH.$product_id.DS.$image_name;

        // create a view instance (set variables here which you want to access in view)
        $view = $builder->build(['path' => $path,'size'=>$size]);

        // render to a variable
        $url = $view->render();
        $this->redirect($url);

    }


    function slugify($text)
    {

      $text = preg_replace('/\s+/u', '-',$text );
      $text =preg_replace('/[%()\/&"\';:@$~?=+]/', '', $text );
      return $text;
    }



    public function getSlug()
    {
          $data = $this->request->getData();

          $slug = $this->slugify($data['title']);

          $data = ['slug'=>$slug];
          $this->set(compact('data'));
          $this->set('_serialize', 'data');
          $this->RequestHandler->renderAs($this, 'json');
    }



    public function getProductList()
    {
        if(isset($_GET['q']) && !empty($_GET['q'])){
            $q = $_GET['q'];
            $query = $this->Products->find('all', [
                'conditions' => ['OR'=>['Products.sku'=>$q,'Products.barcode'=>$q,'Products.title LIKE' => '%' . $q . '%','Products.description LIKE' => '%' . $q . '%']]
            ])->contain('ProductVariants');
        }
        else{
            $query = $this->Products->find('all')->contain('ProductVariants')->limit(5);
        }

        $mediaH = new MediaHelper(new \Cake\View\View());

        $data = $query->toArray();
        //debug($data);

        $products = [];
        foreach($data as $product){
            $variants = [];
            if(sizeof($product->product_variants) > 0){
                foreach($product->product_variants as $product_variants){
                    $option = json_decode($product_variants->option_values,true);
                    $options = "";
                    foreach($option as $key=>$value)
                        $options .= $key . "-" . $value . " ";
                    $variants[] = ['id'=>$product->id,'variant_id'=>$product_variants->id,'title'=>$product->title,'options'=>$options,'icon'=>$mediaH->productImage($product_variants->defaultImage,$product->id,['path'=>true,'width'=>100]),'price'=>$product_variants->price,'sku'=>$product_variants->sku,'weight'=>$product_variants->weight . " " . $product_variants->weight_unit,'quantity'=>1, 'sell_w_stock' => $product_variants->sell_w_stock, 'stock'=>$product_variants->q_available];
                }
                $products[] = ['id'=>$product->id,'title'=>$product->title,'icon'=>$mediaH->productImage($product->defaultImage,$product->id,['path'=>true,'width'=>100]), 'variants' => $variants];

            }else {
                $products[] = ['id'=>$product->id,'title'=>$product->title, 'variants' =>$variants,'icon'=>$mediaH->productImage($product->defaultImage,$product->id,['path'=>true,'width'=>100]),'variant_id'=>0,'options'=>'','price'=>$product->price,'sku'=>$product->sku,'weight'=>$product->weight . " " . $product->weight_unit,'quantity'=>1, 'sell_w_stock' => $product->sell_w_stock, 'stock'=>$product->q_available];
            }

        }

        //pr($products);
       // die();
        //debug($products);
        $this->set(compact('products'));
        $this->set('_serialize', 'products');
    }

    public function getPostContent($pid = null){
        $this->autoRender = false;
        if ($this->request->is('ajax')){
            $product = $this->Products->get($pid);
            $content = $product->title."\n";
            $content .= $product->price."\n\n";
            $content .= $this->textFormatter($product->description)."\n";

            $this->layout = "ajax";
            $this->set('content', $content);
            $this->render('fbcontent');

        }

    }

    public function textFormatter($text){
        $text = preg_replace('/<br(\s+)?\/?>/i', "\n", $text);
        $text = strip_tags($text);
        return $text;
    }

    public function filterByCollection($c_id){
            $Collection = TableRegistry::getTableLocator()->get('Categories');
            $CategoriesHasProducts = TableRegistry::getTableLocator()->get('CategoriesHasProducts');
            if ($c_id > 0){
                $c_tion = $Collection->get($c_id);
                $sql = null;

                if ($c_tion->manual_matching){
                    $products = $this->Products->find('all')->where(['id IN' => $CategoriesHasProducts->find()->select('products_id')->where(['categories_id' => $c_id])]);
                }else{
//                    automatic matching
                    $match_con = $c_tion->match_cond;
                    $match_con = json_decode($match_con, true);
                    $fields = [
                        'title_match' => 'title',
                        'type_match' => 'product_type',
                        'tag_match' => 'tags',
                    ];
                    foreach ($match_con as $key => $con){
                        if (isset($con) && !empty($con)){
                            $arr = explode(',', trim($con));
                            foreach ($arr as $ar){
                                $sql .= $fields[$key] . " LIKE '%". $ar ."%' OR ";
                            }
                        }
                    }

                    $sql = substr($sql, 0, -3);
                    $products = $this->Products->find('all')->where($sql);
                }

            }else{
                $products = $this->Products;
            }
            return $products;
    }

    public function search($query){
        $products = $this->Products->find('all')->where([
            'OR'=>[
                'Products.title LIKE' => '%'.$query.'%',
                'Products.vendor LIKE' => '%'.$query.'%'
            ]
        ]);

        return $products;
    }

    public function productList()
    {
        $q = '';
        if(isset($_GET['q']) && !empty($_GET['q'])){
            $q = $_GET['q'];
            $query = $this->Products->find('all', [
                'conditions' => ['OR'=>['Products.barcode' => $q,'Products.sku LIKE' => '%' . $q . '%','Products.title LIKE' => '%' . $q . '%','Products.description LIKE' => '%' . $q . '%']]
            ])->contain('ProductVariants');
        }else{
            $query = $this->Products->find('all')->contain('ProductVariants');
        }


      $data = $query->toArray();
      //debug($data);
      $products = [];
      foreach($data as $product){
         if(sizeof($product->product_variants) > 0){
           foreach($product->product_variants as $product_variants){
               $option = json_decode($product_variants->option_values,true);
               $options = "";
               foreach($option as $key=>$value)
                  $options .= $key . "-" . $value . " ";
               $products[] = ['id'=>$product->id,'variant_id'=>$product_variants->id,'title'=>$product->title,'options'=>$options,'icon'=>'','price'=>$product_variants->price,'sku'=>$product_variants->sku,'weight'=>$product_variants->weight . " " . $product_variants->weight_unit,'quantity'=>1, 'stock'=>$product_variants->q_available];
           }
         }else {
           $products[] = ['id'=>$product->id,'title'=>$product->title,'icon'=>'','variant_id'=>0,'options'=>'','price'=>$product->price,'sku'=>$product->sku,'weight'=>$product->weight . " " . $product->weight_unit,'quantity'=>1, 'stock'=>$product->q_available];
         }

      }
      //debug($products);
      $this->set(compact('products'));
      $this->set('_serialize', 'products');

    }

    public function products()
    {
        $limit = 1000;
        if(isset($_GET['limit']) && !empty($_GET['limit'])){
            $limit = $_GET['limit'];
        }
        $productList = [];
        if(isset($_GET['products']) && !empty($_GET['products'])){
            $products = explode(',', $_GET['products']);
            $products = $this->Products->find('all')->where(['id IN' => $products])->toArray();
        }
        else if(isset($_GET['q']) && !empty($_GET['q'])){
            $q = $_GET['q'];
            $products = $this->Products->find('all', [
                'conditions' => ['OR'=>['Products.title LIKE' => '%' . $q . '%', 'Products.product_type LIKE' => '%' . $q . '%', 'Products.tags LIKE' => '%' . $q . '%',]]
            ])->toArray();
        }else if (isset($_GET['cid']) && !empty($_GET['cid'])){
            $products = $this->filterByCollection($_GET['cid']);
        }
        else{
            $products = $this->Products->find('all')->limit($limit)->toArray();
        }


        $mediaH = new MediaHelper(new \Cake\View\View());

        foreach ($products as $product){
            $productList[] = [
                'id'=>$product->id,
                'title'=>$product->title,
                'thumbnail' => $mediaH->productImage($product->defaultImage,$product->id,['path'=>true,'width'=>48]),
                'image' => $mediaH->productImage($product->defaultImage,$product->id,['path'=>true])
            ];
        }

        $this->set(compact('productList'));
        $this->set('_serialize', 'productList');
    }

    public function inventory($keyword = '')
    {

      $query = $this->Products->find('all',['conditions'=>['track_inventory'=>true]])->contain(
          'ProductVariants', function ( $q) {
        return $q
        ->where(['track_inventory' => true]);
      });

      if ($this->request->is('ajax')){
          $query = $query->where([
              'OR' =>[
                  'product_type LIKE ' =>'%' . $keyword . '%',
                  'title LIKE' => '%' . $keyword . '%',
              ]
          ]);

          $products = $this->paginate($query);
          $this->set(compact('products'));
          $this->layout="ajax";
          $this->render('inventory_product_display');
      }


      $this->set('products', $this->paginate($query));


    }

    public function updateInventory()
    {
        $action = null;
        $product_id = null;
        $variant_id = null;
        $value  = $_GET['value'];


        $formData = $_GET['pk'];
        $formData = explode('_',$formData);
        $size = sizeof($formData);
        if($size >= 1 ) $action = $formData[0];
        if($size >= 2 ) $product_id = $formData[1];
        if($size >= 3 ) $variant_id = $formData[2];


        $product = $this->Products->get($product_id,[
           'contain'=>'ProductVariants'
        ]);


        if ($this->request->is('ajax')) {

            $response = [];

            if($variant_id){
                $variant_product = $this->Products->ProductVariants->find('all')->where(['id'=>$variant_id]);


                if ($action == 'sku'){
                    $query = $this->Products->ProductVariants->query()->update()
                        ->set(["sku"=>$value])
                        ->where(['id'=>$variant_id])
                        ->execute();

                    if ($query){
                        $response =[
                            'status' => 'success',
                            'sku' => $value
                        ];
                    }
                }

                if ($action == 'sellwstock'){
                    $query = $this->Products->ProductVariants->query()->update()
                        ->set(["sell_w_stock"=>$value])
                        ->where(['id'=>$variant_id])
                        ->execute();

                    if ($query){
                        $response =[
                            'status' => 'success',
                            'sku' => $value
                        ];
                    }
                }

            }


            if(!$variant_id){

                if ($action == 'sku'){
                    $product->sku = $value;
                    if ($this->Products->save($product)){
                        $response =[
                            'status' => 'success',
                            'sku' => $value
                        ];
                    }
                }

                if ($action == 'sellwstock'){
                    $product->sell_w_stock = $value;
                    if ($this->Products->save($product)){
                        $response =[
                            'status' => 'success',
                            'sell_w_stock' => $value
                        ];
                    }
                }
            }

            $this->set(compact('response'));
            $this->set('_serialize', 'response');
            $this->RequestHandler->renderAs($this, 'json');


/*
          $expression = new QueryExpression("q_available = IFNULL(q_available, 0) + $quantity");
          if($data['set'] == 1)
            $expression = new QueryExpression("q_available =  $quantity");
          if($variant_id != null)
            $this->Products->ProductVariants->updateAll([$expression], ['id' => $variant_id,'products_id'=>$id]);
          else
           $this->Products->updateAll([$expression], ['id' => $id]);
          $result =  ['updated'=>true,'id'=>$id,'variant_id'=>$variant_id];
          $this->set(compact('result'));
          $this->set('_serialize', 'result');
          $this->RequestHandler->renderAs($this, 'json');
          */

      }

    }

    public function updateInventoryQuantity($product_id = 0, $variant_id = 0){

      if ($this->request->is('post')){
          $data = $this->request->getData();
          $quantity = $data['inventory_count'];
          if (!$data['set'] && $quantity == 0)  {
              $this->autoRender =false;
              return;
          }

          $this->Products->updateQuantity($product_id, [
              'variant_id' => $variant_id,
              'quantity' => $quantity,
              'action' => $data['set'] ? 'set' : 'add',
              'uid' => $this->request->session()->read('user.id')
          ]);

          $response =[
              'status' => 'success',
              'quantity' => $quantity
          ];

          $this->set(compact('response'));
          $this->set('_serialize', 'response');
          $this->RequestHandler->renderAs($this, 'json');
      }

    }


    public function editfield($field = null){
//        dd('work');
          if($field == null) return;
            if ($this->request->is('post')) {


            }

    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Categories'],
        ]);

        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */

    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if(!empty($product->slug)) $product->slug = $this->slugify($product->slug);
            else $product->slug = $this->slugify($product->title);
            if ($this->Products->save($product)) {
                if($data['hasVariations'] == 1){
                        $this->checkOptions($product->id,$data['ProductOptions']);
                }
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'edit',$product->id]);
            }else
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }

        $product_types= $this->Products->find('list',[
                'keyField' => 'product_type',
                'valueField' => 'product_type',
            ])->distinct(['product_type']);

        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories','product_types'));
        $this -> render('edit');
    }




    function combinations($arrays, $i = 0) {
    if (!isset($arrays[$i])) {
        return array();
    }
    if ($i == count($arrays) - 1) {
        return $arrays[$i];
    }

    // get combinations from subsequent arrays
    $tmp = $this->combinations($arrays, $i + 1);

    $result = array();

    // concat each array from tmp with each element from $arrays[$i]
    foreach ($arrays[$i] as $v) {
        foreach ($tmp as $t) {
            $result[] = is_array($t) ?
                array_merge(array($v), $t) :
                array($v, $t);
        }
    }

    return $result;
   }


   function checkOptions($product_id , $optionsdata){

  //  pr($optionsdata);
     foreach($optionsdata['option'] as $key=>$opt){
       $optdata = ['products_id'=>$product_id,'option_name'=>$opt,'option_values'=>$optionsdata['optionvalues'][$key]];
       $this->Products->ProductOptions->query()->insert(array_keys($optdata))->values($optdata)->execute();

     }


      $option_keys =  $optionsdata['option'];
      $option_values = [];
      foreach($optionsdata['optionvalues'] as $opval)
           $option_values[] = explode(',',$opval);


      //pr($option_values);  pr($option_keys); die();
      $gen_comb = $this->combinations($option_values);

      pr($gen_comb);
      if(sizeof($option_values) > 1){
          foreach($gen_comb as $key=>$comb){
              foreach($comb as $k=>$com){
                   $comb[$option_keys[$k]]  = $com;
                   unset($comb[$k]);
              }
              $gen_comb[$key] = $comb;
          }

      }else{
          foreach($gen_comb as $key=>$comb){
              $gen_comb[$key] = [$option_keys[0]=>$comb];
          }

      }


    //pr($gen_comb);

     foreach($gen_comb as $comb){

            $data = ['products_id'=>$product_id,'option_values'=>json_encode($comb),'active'=>1,'track_inventory'=>1,'q_available'=>0,'is_physical'=>1];
            $this->Products->ProductVariants->query()->insert(array_keys($data))->values($data)->execute();
     }

    // $query->execute();


   }



    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function edit($id = null)
    {
        $product = $this->Products->get($id, ['contain'=>['Categories','ProductOptions','ProductVariants','ProductMedia', 'Reviews']]);
       if($this->request->is(['patch','post','put'])){
           $data=$this->request->getData();
        //    pr($data);
        //    die();
           $product_prev_quantity = $product->q_available;

           $is_track_inventory_product = false;
           $product=$this->Products->patchEntity($product,$data);
           if(!empty($product->slug)) $product->slug = $this->slugify($product->slug);
           else $product->slug = $this->slugify($product->title);
          // debug($data);
        //    debug($product);
           if($this->Products->save($product)){

            //   dd($data['option']);
               if($data['hasVariations'] == 1){
                   $this->checkOptions($id,$data['ProductOptions']);
               }

               if(isset($data['option'])){
                 foreach ($data['option']['values'] as $key => $value) {
                       $this->Products->ProductOptions->query()->update()->set(['option_values'=>$value])->where(['id'=>$key])->execute();
                 }

                
                 
                 if(array_key_exists('new', $data['option'])){
                    foreach($data['option']['new'] as $key => $value){
                        $this->Products->ProductOptions->query()
                        ->insert(['products_id', 'option_name', 'option_values'])
                        ->values([
                            'products_id' => $id,
                            'option_name' => $key,
                            'option_values' => $value
                        ])->execute();
                    }
                 }

                if(array_key_exists('deleted', $data['option'])){
                    
                    $this->Products->ProductOptions->deleteAll(['id IN' => $data['option']['deleted']]);
                    /*foreach($data['option']['deleted'] as $key => $value){
                        $this->Products->ProductOptions->query()
                        ->insert(['products_id', 'option_name', 'option_values'])
                        ->values([
                            'products_id' => $id,
                            'option_name' => $key,
                            'option_values' => $value
                        ])->execute();
                    } */

                 }

               }

               if(isset($data['variant'])){
                   $variants = $data['variant'];

                  // pr($variants);

                   foreach($variants['id'] as $key=>$vid){

                       $data = [
                         'price'=>$variants['price'][$key],
                         'compare_price'=>$variants['compare_price'][$key],
                         'track_inventory'=>$variants['track_inventory_' . $vid],
                         'q_available'=>empty($variants['q_available'][$key])?0:$variants['q_available'][$key],
                         'sku'=>$variants['sku'][$key]
                       ];

                       if ($data['track_inventory'] == 1) $is_track_inventory_product = true;


                       $this->Products->ProductVariants->query()->update()->set($data)->where(['id'=>$vid])->execute();
                       if(!empty($variants['images'][$key])){
                           $images = explode(",",$variants['images'][$key]);

                           if(sizeof($images) > 0){
                               $this->Products->ProductMedia->query()->update()->set(['variant_id'=>0])->where(['variant_id'=>$vid])->execute();
                               $this->Products->ProductMedia->query()->update()->set(['variant_id'=>$vid])->where(['id IN'=>$images])->execute();
                           }
                       }

                       if($variants['prev_q_available'][$key] != $variants['q_available'][$key]){
                           $this->Products->updateQuantity($product->id, [
                               'variant_id' => $vid,
                               'quantity' => $variants['q_available'][$key],
                               'prev_quantity' => $variants['prev_q_available'][$key],
                               'action' => 'set',
                               'uid' => $this->request->session()->read('user.id')
                           ]);
                       }


                   }
                   //die();
                   if(!empty($variants['deleted_variants'])){
                       $deleted_ids   = explode(",",$variants['deleted_variants']);
                       $this->Products->ProductVariants->deleteAll(['id IN'=>$deleted_ids]);

                   }

                   $product = $this->Products->get($id);
                   $min_price_variant = $this->Products->ProductVariants->query()->select(["min_price" => 'MIN(ProductVariants.price)'])->where(['products_id'=> $id,'price >'=>0]);
                  // debug($min_price_variant);
                   $min_price = $min_price_variant->first()->min_price;

                   //die($min_price);
                   if ($is_track_inventory_product) $product->track_inventory = 1;
                   $product->price = $min_price;
                   $this->Products->save($product);

               }else{
                    if ($product_prev_quantity != $data['q_available']){
                        $this->Products->updateQuantity($product->id, [
                            'quantity' => $data['q_available'],
                            'prev_quantity' => $product_prev_quantity,
                            'action' => 'set',
                            'uid' => $this->request->session()->read('user.id')
                        ]);
                    }
               }


               $this->Flash->success(__('The product has been saved.'));
               return $this->redirect(['action' => 'edit',$product->id]);
           }else
               $this->Flash->error(__('The product could not be saved. Please, try again.'));
       }
              $product_types= $this->Products->find('list',[
                  'keyField' => 'product_type',
                  'valueField' => 'product_type',
              ])->distinct(['product_type']);

              $categories = $this->Products->Categories->find('list', ['limit' => 200])->where("manual_matching=1");

              $this->set(compact('product', 'categories','product_types'));

    }


    public function options($id = null)
    {

    }

    public function variants($id = null,$v_id= null)
    {

        $product = $this->Products->get($id);

        $media = TableRegistry::getTableLocator()->get('ProductMedia');
        //$productVariants = TableRegistry::getTableLocator()->get('ProductVariants');


        $product_options = $this->Products->ProductOptions->find('list', [
            'keyField' => 'option_name',
            'valueField' => 'option_values'
        ])->where('products_id = ' . $id)->toArray();


        $product_variants = $this->Products->ProductVariants->find()->where('products_id = ' . $id)->all();
        if (!$product_variants->count()) return $this->redirect($this->referer());

        $product_variant = $product_variants->first();


        if($v_id != null){

                foreach($product_variants as $variant)
                   if($variant->id == $v_id){
                          $product_variant = $variant;
                          break;
                   }

        }


        if($this->request->query("add") == 1)
          $product_variant = $this->Products->ProductVariants->newEntity();



        if ($this->request->is(['patch', 'post', 'put'])) {

//            pr($this->request->getData());
//            die();
            $images = explode(',',$this->request->getData('images_id'));

             $product_variant = $this->Products->ProductVariants->patchEntity($product_variant, $this->request->getData());
             $product_variant->products_id = $id;
             $product_variant->option_values = json_encode($this->request->getData()['ProductOPtions']);
             $product_variant->active = 1;
             if ($this->Products->ProductVariants->save($product_variant)){
                    $media->updateAll(
                        ['variant_id' => 0],
                        [
                            'product_id' =>$product_variant->products_id,
                            'variant_id' =>$product_variant->id,
                        ]
                    );


                    foreach ($images as $image){
                        $media->query()->update()->set(['variant_id'=>$product_variant->id])->where(['id'=>$image])->execute();
                    }

                      $this->Flash->success(__('The product variant has been saved.'));
                      if($this->request->query("add") == 1)
                        $this->redirect(['action'=>'variants',$id,$product_variant->id]);
             }else {
               debug($product_variant);
               pr($this->request->getData());
             }
        }




        $variant_images = $media->find()->where([
            'product_id' => $product_variant->products_id,
            'variant_id' => $product_variant->id,
        ])->all();


        $this->set(compact('product','product_options','product_variants','product_variant', 'variant_images'));


        //$this->set('_serialize', ['product_variants', 'product_variants']);
        //$this->RequestHandler->renderAs($this, 'json');


    }

     public function deleteVariant($id = null,$v_id= null){
        //  $productVariants = TableRegistry::getTableLocator()->get('ProductVariants');
          $product_variant = $this->Products->ProductVariants->get($v_id);
          if($this->Products->ProductVariants->delete($product_variant)){
                $this->Flash->success(__('The product variant has been deleted.'));
          }else{
                $this->Flash->error(__('The product variant could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'variants',$id]);


     }




    public function media($id = null)
    {

    }


    public function reviews($id)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Reviews' => ['Customers']]
        ]);

        $this->set(compact('product'));
    }


    public function inventoryLogs($product_id = null)
    {
        if (empty($product_id) || $product_id == null) return $this->redirect(['controller' => 'Products', 'action' => 'inventory']);

        $InventoryLogs = TableRegistry::getTableLocator()->get('InventoryLogs');
        $Products = TableRegistry::getTableLocator()->get('Products');
        $product = $Products->get($product_id);

        $logs = $InventoryLogs->find('all')->where(['product_id' => $product_id])->contain(['Products', 'Variants', 'Users', "Orders"])->order(['InventoryLogs.created' => 'DESC']);
//        pr($logs);
        $this->set(compact('logs', 'product'));
        $this->render('inventory_log');

    }









    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


}

<?php
namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\View\Helper;
use Cake\View\View;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use stdClass;

/**
 * TablerForm helper
 */
class ShopHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    public $helpers = array('Html','Url','Formats','Session');
    /**
     * @var ProductsHelper|Helper|Helper\ProductsHelper|\DebugKit\View\Helper\ProductsHelper|\ProductsHelper|null
     */

    public function collections()
    {
        $Categories = TableRegistry::get('Categories');
        $collections = $Categories->find('all')->orderDesc('id')->all();
        foreach ($collections as $collection){
            $collection->imagepath = COLLECTION_IMAGE_PATH.$collection->image;
        }

        return $collections;
    }


    public function product($string){
        $Products = TableRegistry::get('Products');
        if (is_numeric($string))
            $product = $Products->find('all')->where(['id' => (int)$string])->first();
        else
            $product = $Products->find('all')->where(['slug' => $string])->first();


        if (!$product) $product = $Products->newEntity();



        return $product;

     }

     public function  recent_viewed_products($limit = 10){
         $Products = TableRegistry::get('Products');
         $recent_products_id = $this->Session->check('viewed_products') ? $this->Session->read('viewed_products') : [];
        // $recent_products_id = array_reverse($recent_products_id);
        // array_shift($recent_products_id);
         if (count($recent_products_id) == 0):
             $products = [];
         else:
             $products = $Products->find('all')->where([
                 'id IN'=> $recent_products_id
             ])->limit($limit)->all();
         endif;
         return $products;
     }


     public function related_products($product_type,$limit = 10){
       $Products = TableRegistry::get('Products');
       $products = $Products->find('all')->where([
           'OR'=>[
               'Products.title LIKE' => '%'.$product_type.'%',
               'Products.product_type LIKE' => '%'.$product_type.'%'
           ]
       ])->limit($limit)->all();
       return $products;
     }



     public function products(){
         $args = func_get_args();
         $limit         = 10;
         $collection    = 'all';
//         pr($args);

         $Products = TableRegistry::get('Products');
         $query = $Products->find('all')->where(["active"=>1]);

         if (count($args) > 0 ) $collection = $args[0];
         if($collection != 'all')
             $query = $this->collection_query($collection,$query);

         if (count($args) > 1 ) {
             for ($i = 1; $i < count($args); $i++){
                 $key           = null;
                 $value         = null;

                if (strpos($args[$i], ':')) {
                    $params = explode(':', $args[$i]);
                    $key = strtolower(trim($params[0]));
                    if (count($params) > 1) $value = strtolower(trim($params[1]));
                }
                else $key = strtolower(trim($args[$i]));


                switch ($key){
                    case 'limit':
                        $limit  = $value;
                        break;
                    case 'new_arrival':
                        if ($value !== null){
                            $day =  (int) $value;
                            $date = date("Y-m-d", strtotime("-{$day} day"));
                            $query = $query->where(["DATE(created) >= " => $date]);
                        }
                        $query = $query->order(['created'=>'DESC']);
                        break;

                    case 'discounts':
                        $query = $query->where(['compare_price >'=>0]);
                        break;
                    case 'product_type':
                        $query = $query->where(['Products.product_type LIKE' => '%'.$value.'%']);
                        break;
                    case 'keyword':
                        $query =  $query->where(["OR"=>["title LIKE"=>"%" . $value . "%","tags LIKE"=>"%" . $value . "%"]]);
                        break;
                    case 'tag':
                        $query =  $query->where(["tags LIKE"=>"%" . $value . "%"]);
                        break;
                    default:
                        // default
                }
             }
         }



       return $query->limit($limit)->orderDesc('id')->all();

     }




     protected function collection_query($slug,$query){
         $Categories = TableRegistry::getTableLocator()->get('Categories');
         $CategoriesHasProducts = TableRegistry::getTableLocator()->get('CategoriesHasProducts');
         $Products = TableRegistry::get('Products');
         $collection = $Categories->find('all')->where(['slug' => trim($slug)])->first();
         if(!$collection){
             return $query->where(['id' => -10000]);
         }


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



    public function collection($slug, $limit = 10000)
    {
        $Collection = TableRegistry::getTableLocator()->get('Categories');
        $CategoriesHasProducts = TableRegistry::getTableLocator()->get('CategoriesHasProducts');
        $Products = TableRegistry::getTableLocator()->get('Products');

        $products = array();
        $c_tion = array();
        if (!empty($slug)){
            $c_tion = $Collection->find('all')->where(['slug' => trim($slug)])->first();

            if ($c_tion){
                $c_id  = $c_tion->id;
                $sql = null;

                if ($c_tion->manual_matching){
//                    manual matching
                    $products_id = $CategoriesHasProducts->find()->select('products_id')->where(['categories_id' => $c_id])->extract('products_id')->toList();
                    if (count($products_id) > 0){
                        $products = $Products->find('all')->where(['id IN' => $products_id])->limit($limit)->all();
                    }else{
                        $products = $Products->find('all')->where(['id' => -1])->all();
                    }

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
                    $products = $this->Products->find('all')->where($sql)->limit($limit);

                }


            }

        }
    }

    function prdouct_tags($limit = 100){
        $Products = TableRegistry::get('Products');
        $tags = $Products->find('list', [
            'keyField' => 'id',
            'valueField' => 'tags'
        ])->toArray();

        $tags = array_values($tags);
        $tags = implode(',', $tags);
        $tags = explode(',', $tags);
        $tags  = array_unique($tags);
        return array_slice($tags, 0, $limit);
    }

    function product_vendors($limit = 100){
        $Products = TableRegistry::get('Products');
        $vendors = $Products->find('list', [
            'keyField' => 'id',
            'valueField' => 'vendor'
        ])->distinct('vendor')->toArray();

        return array_values($vendors);
    }

    function product_types($limit = 100){
        $Products = TableRegistry::get('Products');
        $types = $Products->find('list', [
             'keyField' => 'id',
            'valueField' => 'product_type'
        ])->distinct('product_type')->toArray();;

        return array_values($types);
    }


    function productPrice($product){
      $return  = "";
      if($product){
         $return .= $this->Formats->moneyFormat($product->price);
        if($product->compare_price > 0)
          $return .= " <del>" . $this->Formats->moneyFormat($product->compare_price) . "</del>";

      }
      return $return;

    }

    function cart_count(){
      if ($this->Session->check('carts') && count($this->Session->read('carts')) != 0){
          $carts = $this->Session->read('carts');
          $quantity = 0;
          foreach ($carts as $cart){
            $quantity += $cart['quantity'];
          }
          return $quantity;
      }else{
          return 0;
      }

    }

 

   

    

    function logo($defatul_image = null){
        //$this->_View->viewVars['theme']
        return (Configure::read('App.logo') !='' && file_exists(LOGO_PATH. Configure::read('App.logo'))) ?  Router::url("/"). LOGO_PATH. Configure::read('App.logo') : $defatul_image;
    }
    function favicon($defatul_image = null){
        //$this->_View->viewVars['theme']
        return (Configure::read('App.favicon') != '' &&  file_exists(LOGO_PATH. Configure::read('App.favicon'))) ?  Router::url("/"). LOGO_PATH. Configure::read('App.favicon') : $defatul_image;
    }


    function asset_image($key, $default = null){
        $assets_file = THEMES . Configure::read('App.theme')  . DS . 'assets.xml';
        $assets = simplexml_load_file($assets_file);

        foreach ($assets->images->image as $image){

            if ($image->key == $key) return $this->_View->viewVars['theme_root'] . $image->file;
        }

        return $default !== null ? $default : Router::url('/img/missing_image.png');
    }


    function asset_menu($key){
        $assets_file = THEMES . Configure::read('App.theme')  . DS . 'assets.xml';
        $assets = simplexml_load_file($assets_file);
        $data = new stdClass();
        foreach ($assets->menus->menu as $menu){

            if ($menu->key == $key){
                $data =  json_decode($menu->menujson);
            }
        }

        return $data;
    }

    function stock($maxStock){
        return $maxStock < 0 ? "Out of Stock" : "In Stock";
    }

    function hasmenuchild($menu,$bool = true){
      $ret = isset($menu->children);
      if(!$bool) return !$ret;
      return $ret;
    }

    function checkexists($var){
        if(is_array($var))
         return (isset($var) && sizeof($var) > 0);
        else
          return (isset($var) && $var > 0);

    }

    function check_result_set($var, $empty=true ){
        $return = false;

        if(!iterator_count($var)) $return =  true;

            if (!$empty) $return = ($return) ? false : true;

        return $return;
    }

    function check_array($var, $empty=true ){
        $return = false;

        if(!sizeof($var)) $return =  true;

        if (!$empty) $return = ($return) ? false : true;

        return $return;
    }

   

}
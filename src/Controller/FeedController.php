<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Soundasleep\Html2Text;
require_once(ROOT . '/vendor' . DS  . 'soundasleep/html2text' . DS . 'src' . DS . 'Html2Text.php');
/**
 * Feed Controller
 *
 *
 * @method \App\Model\Entity\Feed[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeedController extends AppController
{

    public function facebook($slug = 'all')
    {

        $Products = TableRegistry::getTableLocator()->get('Products');
        $feedList = array();
        $feedList[] = [
            'id'                    => 'id',
            'title'                 =>'title',
            'description'           => 'description',
            'availability'          => 'availability',
            'condition'             => 'condition',
            'price'                 => 'price',
            'link'                  => 'link',
            'image_link'            => 'image_link',
            'brand'                 => 'brand',
            'sale_price'            => 'sale_price',
            'item_group_id'         => 'item_group_id',
            'visibility'            => 'visibility',
            'additional_image_link' => 'additional_image_link',
            'additional_variant_attribute' => 'additional_variant_attribute'
        ];

        $products = array();
        $collection  = null;

        $search = $this->request->getQuery('q','');
        $limit =  $this->request->getQuery('limit',"1000");
        $price_range = $this->request->getQuery('price-range',"");  // 40-100
        $options = $this->request->getQuery('options',"");
        $tag = $this->request->getQuery('tag',"");
        $product_type = $this->request->getQuery('product-type',"");


        $query =$Products->find('all')->contain(['ProductVariants' => ['ProductMedia'], 'ProductMedia']);


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

        if($search) {
            $query->where([
                'OR'=>[
                    'Products.title LIKE' => '%'.$search.'%',
                    'Products.vendor LIKE' => '%'.$search.'%'
                ]
            ]);
        }

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

        if ($query->count() == 0){
            $this->set('feedList', $this->array2csv($feedList));
            $this->layout = "ajax";
            $this->render('feed');
            return ;
        }
        else{
            $products = $query->limit($limit)->all();
        }


        //pr($products);
        //die();


        foreach ($products as $key => $product){
            if (empty($product->defaultImage)) continue;


            if ($product->product_variants){
                foreach ($product->product_variants as $v_key => $variant){
                    $v_image      = $variant->defaultImage ? $variant->defaultImage : $product->defaultImage;
                    $add_img_links = [];
                    $add_attr      = array();

                    foreach (json_decode($variant->option_values, true) as $key=> $attr){
                        $add_attr[] = $key ." : ". $attr;
                    }

                    if ($variant->product_media){
                        foreach ($variant->product_media as $media)
                            $add_img_links[] = Router::url(PRODUCT_IMAGE_PATH . $product->id .DS . $media->path, true);
                    }

                    $feedList[]=[
                        'id'            => $product->id . "_" . $variant->id,
                        'title'         => $product->title,
                        'description'   => substr(str_replace('<br />', "\r\n",nl2br(Html2Text::convert($product->description))), 0, 5000),
                        'availability'  =>  ($variant->q_available == false && $variant->sell_w_stock == false) ? 'out of stock' : 'in stock',
                        'condition'     => 'new',
                        'price'         => $variant->compare_price > 0 ? $variant->compare_price : $variant->price,
                        'link'          => Router::url($product->link, true),
                        'image_link'    => Router::url(PRODUCT_IMAGE_PATH . $product->id .DS . $v_image, true),
                        'brand'         => $product->vendor,
                        'sale_price'    => $variant->compare_price > 0 ? $variant->price  : $variant->compare_price,
                        'item_group_id' => $product->product_type . $product->id,
                        'visibility'    => $product->active == 1 ? 'published' : 'hidden',
                        'additional_image_link' => sizeof($add_img_links) ? implode(',', $add_img_links) : '',
                        'additional_variant_attribute' => sizeof($add_attr) ? implode(',', $add_attr) : ''
                    ];
                }
            }else{

                $add_img_links = [];

                if ($product->product_media){
                    foreach ($product->product_media as $media)
                        $add_img_links[] = Router::url(PRODUCT_IMAGE_PATH . $product->id .DS . $media->path, true);
                }

                $feedList[]=[
                    'id'            => $product->id,
                    'title'         => $product->title,
                    'description'   => substr(str_replace('<br />', "\r\n",nl2br(Html2Text::convert($product->description))), 0, 5000),
                    'availability'  =>  ($product->q_available == false && $product->sell_w_stock == false) ? 'out of stock' : 'in stock',
                    'condition'     => 'new',
                    'price'         => $product->compare_price > 0 ? $product->compare_price : $product->price,
                    'link'          => Router::url($product->link, true),
                    'image_link'    => Router::url(PRODUCT_IMAGE_PATH . $product->id .DS . $product->defaultImage, true),
                    'brand'         => $product->vendor,
                    'sale_price'    => $product->compare_price > 0 ? $product->price  : $product->compare_price,
                    'item_group_id' => $product->product_type . $product->id,
                    'visibility'    => $product->active == 1 ? 'published' : 'hidden',
                    'additional_image_link' => sizeof($add_img_links) ? implode(',', $add_img_links) : '',
                    'additional_variant_attribute' => ''
                ];
            }

        }


        $this->set('feedList', $this->array2csv($feedList));
        $this->layout = "ajax";
        $this->render('feed');
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

    public function textFormatter($text){
        $text = preg_replace('/<br(\s+)?\/?>/i', "\n", $text);
//        $text = strip_tags($text);
        return $text;
    }



    function array2csv($data, $delimiter = ',', $enclosure = '"', $escape_char = "\\")
    {
        $f = fopen('php://memory', 'r+');
        foreach ($data as $item) {
            fputcsv($f, $item, $delimiter, $enclosure, $escape_char);
        }
        rewind($f);

        return stream_get_contents($f);
    }
}

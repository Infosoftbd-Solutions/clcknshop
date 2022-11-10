<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

/**
 * Facebook Controller
 *
 * @property \App\Model\Table\FacebookTable $Facebook
 *
 * @method \App\Model\Entity\Facebook[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FacebookController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    protected $table = null;
    protected $fbEntry = null;
    protected $data = array();


    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, $eventManager = null, $components = null)
    {
        $this->table = TableRegistry::getTableLocator()->get('Settings');
        $this->fbEntry =$this->table->query()->where(['name' => 'facebook'])->first();
        if ($this->fbEntry){
            $this->data = json_decode($this->fbEntry->value, true);
        }
        parent::__construct($request, $response, $name, $eventManager, $components);
    }


    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Fb');
    }


    public function index()
    {
        $Products = TableRegistry::getTableLocator()->get('Products');
        $Categories = TableRegistry::getTableLocator()->get('Categories');
        $product_types= $Products->find('list',[
            'keyField' => 'product_type',
            'valueField' => 'product_type',
        ])->distinct(['product_type'])->toArray();

        $categories = $Categories->find('list', [
            'keyField' => 'slug',
            'valueField' => 'name'
        ])->toArray();


        $facebook = $this->fbEntry;
        if (!$facebook){
            $permission = [
                'email', //email
                'pages_show_list', //show all of page
                'pages_read_engagement', // read content (posts, photos, videos, events)
                'pages_manage_posts',// create, edit and delete your Page posts
                'pages_read_user_content',// to read user generated content on the Page
                'pages_manage_engagement',//create, edit and delete comments posted
                'pages_messaging',// manage and access Page conversations in Messenger
                'business_management',//app to read and write with the Business Manager API
                'catalog_management',//Manage Catalog of your Business Account
                'ads_management'//read and manage the Ads account it owns
            ];
            $loginUrl = $this->Fb->login->getLoginUrl($this->Fb->redirectUrl,$permission);
        }

//        pr(json_decode($facebook->value, true));
//        die();

        $this->set(compact('facebook', 'loginUrl', 'product_types', 'categories'));

    }

    public function callback()
    {
        $this->autoRender = false;
        try {
            $accessToken = $this->Fb->login->getAccessToken($this->Fb->redirectUrl);
            if(!$accessToken->isLongLived()){
                $oAuth2client = $this->Fb->facebook->getOAuth2Client();
                $accessToken = $oAuth2client->getLongLivedAccessToken($accessToken);
            }

            $this->data['token']   = $accessToken->getValue();
            $this->data['expired'] = $accessToken->getExpiresAt()->getTimestamp();

            //get user info (Name, ID)
            $user = $this->Fb->facebook->get('me?fields=id,name,email,picture{url}',$this->data['token'])->getGraphNode()->asArray();

            $this->data['userId'] = $user['id'];
            $this->data['userName'] = $user['name'];
            $this->data['userEmail'] = isset($user['email']) ? $user['email'] : '';
            $this->data['user_pro_pic'] = isset($user['picture']['url'])? $user['picture']['url'] : '';
            $this->add([
               'name' => 'facebook',
               'value' => json_encode($this->data)
            ]);


        } catch(FacebookExceptionsFacebookResponseException $e) {
            echo __("Graph returned an error: {0}", [ $e->getMessage() ]);
            exit;
        } catch(FacebookExceptionsFacebookSDKException $e) {
            echo "Facebook SDK returned an error: {0}", [$e->getMessage()];
            exit;
        } catch (FacebookSDKException $e) {
            echo __("Facebook SDK returned an error: {0}", [$e->getMessage()]);
            exit;
        }

    }


    public function businessManager(){
        $this->autoRender = false;

        if($this->request->is('ajax')){
            try {
                //get Business Information
                $options = array();
                $business_accounts = $this->Fb->facebook->get('me/businesses?fields=id,name,owned_pages', $this->data['token'])->getGraphEdge()->asArray();
                foreach ($business_accounts as $account){
                    $pages =  array();
                    if (count($account['owned_pages'])){
                        foreach ($account['owned_pages'] as $page){
                            $pages[] = $page['name'];
                        }
                    }
                    $options[] = [
                        'id' => $account['id'],
                        'name' => $account['name'],
                        'pages' => implode(" | ", $pages)
                    ];

                }

                $this->layout = "ajax";
                $this->set('options', $options);
                $this->set('action', 'business');
                $this->render('option');


/*

                $notExist = true;

                foreach ($business_accounts as $account){
                    // ClcknShop Business Manager
                    if ($account['name'] == "Abir Ahmed"){
                        $data['business_name'] = $account['name'];;
                        $data['business_id'] = $account['id'];;
                        $notExist = false;
                    }

                }

                //create new business account
                if ($notExist){
                    $business_account = $this->Fb->facebook->post('me/businesses',[
                        'name' => 'ClcknShop Business Manager',
                        'email' => $data['userEmail'],
                        'vertical' => 'ECOMMERCE',
                    ],$data['token']);

                    if ($business_account){
                        $data['business_name'] = 'ClcknShop Business Manager';
                        $data['business_id'] = $business_account['id'];
                    }
                }
*/

            } catch(FacebookExceptionsFacebookResponseException $e) {
                echo __("Graph returned an error: {0}", [$e->getMessage()]);
                exit;
            } catch(FacebookExceptionsFacebookSDKException $e) {
                echo __("Facebook SDK returned an error: {0}", [$e->getMessage()]);
                exit;
            } catch (FacebookSDKException $e) {
                echo $e->getMessage();
            }
        }


        if ($this->request->is('post')){
            $data = $this->request->getData('data');
            $bsArr = explode('|', $data);

            if (isset($this->data['business_id']) && $this->data['business_id'] != $bsArr[0]){
                if (key_exists('page_id',$this->data)) unset($this->data['page_id']);
                if (key_exists('page_name',$this->data)) unset($this->data['page_name']);
                if (key_exists('page_pro_pic',$this->data)) unset($this->data['page_pro_pic']);
            }

            $this->data['business_id'] = $bsArr[0];
            $this->data['business_name'] = $bsArr[1];


            $data = $this->table->query()
                ->update()
                ->set(['value' => json_encode($this->data)])
                ->where(['name' => 'facebook'])
                ->execute();

            if ($data) {
                $this->Flash->success(__('The facebook Business manager has been saved.'));
            }else{
                $this->Flash->error(__('The facebook Business manager could not be saved. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);
        }
    }


    public function catalog(){
        $this->autoRender = false;

        if ($this->request->is('ajax')){
            $catalogs = $this->Fb->facebook->get($this->data['business_id']."/owned_product_catalogs", $this->data['token'])->getGraphEdge()->asArray();
            $this->layout = "ajax";
            $this->set('options', $catalogs);
            $this->set('action', 'catalog');
            $this->render('option');
        }

        if ($this->request->is('post')){
            $data = $this->request->getData('data');
            $catArr = explode('|', $data);

            $this->data['cat_id'] = $catArr[0];
            $this->data['cat_name'] = $catArr[1];
            $this->feed();
            $data = $this->table->query()
                ->update()
                ->set(['value' => json_encode($this->data)])
                ->where(['name' => 'facebook'])
                ->execute();
            if ($data) {
                $this->Flash->success(__('The facebook catalog has been saved.'));
            }else{
                $this->Flash->error(__('The facebook catalog could not be saved. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);

        }



        /*
//          catalog information
        $notExist = true;

        foreach ($catalogs as $catalog){
            if ($catalog['name'] == 'ClcknShop Catalog'){
                $data['cat_name'] = $catalog['name'];
                $data['cat_id'] = $catalog['id'];
                $notExist = false;
            }
        }


        if ($notExist){
//                create new catalog
            $catalog = $this->Fb->facebook->post($this->data['business_id']."/owned_product_catalogs",['name' => 'ClcknShop Catalog'], $this->data['token'])->getGraphNode()->asArray();
            if ($catalog){
                $data['cat_name'] = 'ClcknShop Catalog';
                $data['cat_id'] = $catalog['id'];
            }
        }

        */
    }

    public function feed(){

//          feed information
        $feeds = $this->Fb->facebook->get($this->data['cat_id']."/product_feeds", $this->data['token'])->getGraphEdge()->asArray();
        $notExist = true;
        foreach ($feeds as $feed){
            if ($feed['name'] == 'feed_clcknshop'){
                $this->data['feed_id'] = $feed['id'];
                $this->data['feed_name'] = $feed['name'];
                $notExist = false;
            }
        }



        if ($notExist){
//                create new feed
            $feed = $this->Fb->facebook->post($this->data['cat_id']."/product_feeds",[
                'name'=>'feed_clcknshop',
                'schedule' =>[
                    'interval' => 'DAILY',
                    'url' => Router::url('/products/feed/facebook',true),
                    'hour' => '22'
                ]
            ], $this->data['token'])->getGraphNode()->asArray();

            if ($feed){
                $this->data['feed_id'] = $feed['id'];
                $this->data['feed_name'] = 'feed_clcknshop';
            }
        }

    }

    public function pixel(){

        if ($this->request->is('ajax')){
            $pixels = $this->Fb->facebook->get($this->data['business_id']."/owned_pixels?fields=id,name,code", $this->data['token'])->getGraphEdge()->asArray();
            $this->layout = "ajax";
            $this->set('options', $pixels);
            $this->set('action', 'pixel');
            $this->render('option');
        }

        if ($this->request->is('post')){
            $pixel_id = $this->request->getData('data');
            $pixel = $this->Fb->facebook->get($pixel_id."?fields=id,name,code", $this->data['token'])->getGraphNode()->asArray();
            if ($pixel){
                $this->data['pixel_id'] = $pixel['id'];
                $this->data['pixel_name'] = $pixel['name'];
                $file = WWW_ROOT.DS.'js'.DS.'pixel.php';
                $f = fopen($file,'w');
                fwrite($f,$pixel['code']);
                fclose($f);

                $data = $this->table->query()
                    ->update()
                    ->set(['value' => json_encode($this->data)])
                    ->where(['name' => 'facebook'])
                    ->execute();

                if ($data) {
                    $this->Flash->success(__('The facebook page has been saved.'));
                }else{
                    $this->Flash->error(__('The facebook page could not be saved. Please, try again.'));
                }
            }

            return $this->redirect(['action' => 'index']);
        }


        /*
        $notExist = true;

        foreach ($pixels as $pixel){
            if($pixel['name'] == 'pixel_clcknshop'){
                $notExist = false;
                $this->data['pixel_id'] = $pixel['id'];
                $this->data['pixel_name'] = $pixel['name'];
                $file = WWW_ROOT.DS.'js'.DS.'pixel.php';
                $f = fopen($file,'w');
                fwrite($f,$pixel['code']);
                fclose($f);
            }
        }


//            creating pixel
        if ($notExist){
            $pixel = $this->Fb->facebook->post($this->data['business_id'].'/adspixels',['name'=>'pixel_clcknshop'],$this->data['token'])->getGraphNode()->asArray();
            pr($pixel);
            die();

            $pixel_id = $pixel['id'];
            $pixel = $this->Fb->facebook->get($pixel_id.'/adspixels?fields=id,name,code', $this->data['token'])->getGraphNode()->asArray();
            $data['pixel_id'] = $pixel['id'];
            $data['pixel_name'] = $pixel['name'];
            $file = WWW_ROOT.DS.'js'.DS.'pixel.js';
            $f = fopen($file,'w');
            fwrite($f,$pixel['code']);
            fclose($f);
        }
*/



    }

    public function pages(){
        $this->autoRender = false;

        if ($this->request->is('ajax')){
            $pages = $this->Fb->facebook->get($this->data['business_id'].'/owned_pages?fields=id,name,access_token,picture{url}',$this->data['token'])->getGraphEdge()->asArray();
            $this->layout = "ajax";
            $this->set('options', $pages);
            $this->set('action', 'page');
            $this->render('option');
        }

        if ($this->request->is('post')){
            $data = $this->request->getData('data');
//            $page = $this->Fb->facebook->get($page_id.'?fields=name,picture{url}',$data['token'])->getGraphNode()->asArray();

            $pgArr = explode('|', $data);

            if (isset($this->data['page_id']) && $this->data['page_id'] != $pgArr[0]){
                $keys = ['cat_id', 'cat_name', 'feed_id', 'feed_name', 'pixel_id', 'pixel_name'];
                foreach ($keys as $key){
                    if (key_exists($key,$this->data)) unset($this->data[$key]);
                }
            }


            $this->data['page_id'] = $pgArr[0];
            $this->data['page_name'] = $pgArr[1];
            $this->data['page_token'] = $pgArr[2];
            $this->data['page_pro_pic'] = $pgArr[3];

//                get pages catalog
            $catalogs =  $this->Fb->facebook->get($this->data['page_id']."/product_catalogs",$this->data['token'])->getGraphEdge()->asArray();
            if (count($catalogs)){
                $this->data['cat_id'] = $catalogs[0]['id'];
                $this->data['cat_name'] = $catalogs[0]['name'];
//create or set feed
                $this->feed();
            }



            $data = $this->table->query()
                ->update()
                ->set(['value' => json_encode($this->data)])
                ->where(['name' => 'facebook'])
                ->execute();

            if ($data) {
                $this->Flash->success(__('The facebook page has been saved.'));
            }else{
                $this->Flash->error(__('The facebook page could not be saved. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);

        }

    }


    public function post($pid = null)
    {
        $this->autoRender = false;
        $pid = $this->request->getData('pid');
        $content = htmlentities($this->request->getData('content'));
        $productMedia = TableRegistry::getTableLocator()->get('ProductMedia');
        $productImages = $productMedia->find('all',['limit' => 10])
            ->where(['ProductMedia.product_id' => $pid, 'type' => 1])
            ->toArray();


        $unpublishedImages = array();
        try {

            foreach ($productImages as $image) {
                $params = [
                    'url' => Router::url('/uploads/products/' . $pid . "/" . $image['path'], true),
                    'published' => false,
                ];
                $response = $this->Fb->facebook->post($this->data['page_id'] . '/photos', $params, $this->data['page_token'])->getGraphNode()->asArray();
                $unpublishedImages[] = [
                    'media_fbid' => $response['id']
                ];
            }

            $params = [
                'message' => $content
            ];

            foreach ($unpublishedImages as $image) {
                $params['attached_media'][] = json_encode($image);
            }


            //post content and link
            $post = $this->Fb->facebook->post($this->data['page_id'] . '/feed', $params, $this->data['page_token'])->getGraphNode()->asArray();

            if ($post) {
                $this->Flash->success(__('The product has been posted on facebook.'));
            }else{
                $this->Flash->error(__('The product could not be publish Please, try again.'));
            }

            return $this->redirect(['controller'=>'Products','action' => 'index']);

        } catch(FacebookExceptionsFacebookResponseException $e) {
            echo __("Graph returned an error: {0}", [$e->getMessage()]);
            exit;
        } catch(FacebookExceptionsFacebookSDKException $e) {
            echo __("Facebook SDK returned an error: ", [$e->getMessage()]);
            exit;
        } catch (FacebookSDKException $e) {
            echo __("Facebook SDK returned an error: ", [$e->getMessage()]);
            exit;
        }


//post content and images
//        $post = $this->Fb->facebook->post($this->data['page_id'].'/photos',$params,$this->data['page_token'])->getGraphNode()->asArray();


    }




    /**
     * View method
     *
     * @param string|null $id Facebook id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $facebook = $this->Facebook->get($id);

        $this->set('facebook', $facebook);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($data = array())
    {

        $facebook = $this->table->newEntity();
        $facebook = $this->table->patchEntity($facebook, $data);
        if ($this->table->save($facebook)) {
            $this->Flash->success(__('The facebook has been saved.'));
        }else{
            $this->Flash->error(__('The facebook could not be saved. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Facebook id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $facebook = $this->Facebook->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $facebook = $this->Facebook->patchEntity($facebook, $this->request->getData());
            if ($this->Facebook->save($facebook)) {
                $this->Flash->success(__('The facebook has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The facebook could not be saved. Please, try again.'));
        }
        $pages = $this->Facebook->Pages->find('list', ['limit' => 200]);
        $businesses = $this->Facebook->Businesses->find('list', ['limit' => 200]);
        $catalogs = $this->Facebook->Catalogs->find('list', ['limit' => 200]);
        $feeds = $this->Facebook->Feeds->find('list', ['limit' => 200]);
        $pixels = $this->Facebook->Pixels->find('list', ['limit' => 200]);
        $this->set(compact('facebook', 'pages', 'businesses', 'catalogs', 'feeds', 'pixels'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Facebook id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
//        $this->autoRender = false;

        if ($this->request->is('ajax')) {

            $Settings = TableRegistry::getTableLocator()->get('Settings');
            $facebook = $Settings->query()->where(['name' => 'facebook'])->first();
            $data = json_decode($facebook->value, true);

            $fbEntry = $Settings->query()->delete()->where(['name' => 'facebook'])->execute();
            $response = [];
            $fbEntry ? $response['status'] = 'true' : $response['status'] = 'false';

            $fb = $this->Fb->facebook->delete('me/permissions', [], $this->data['token'])->getGraphNode()->asArray();
            if ($fb['success']) {
                $this->set(compact('response'));
                $this->set('_serialize', 'response');
                $this->RequestHandler->renderAs($this, 'json');
                return;
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}

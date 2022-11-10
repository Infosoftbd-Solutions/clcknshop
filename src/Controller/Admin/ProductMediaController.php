<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\View\Helper\MediaHelper;
use Cake\Http\Session;
use Cake\ORM\TableRegistry;

/**
 * ProductMedia Controller
 *
 * @property \App\Model\Table\ProductMediaTable $ProductMedia
 *
 * @method \App\Model\Entity\ProductMedia[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductMediaController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($pid = 0, $vid = 0)
    {

        $product = $this->ProductMedia->Products->find('all')->where(['id' => $pid])->contain(['ProductMedia'])->first();
//       $product = $this->ProductMedia->Products->get($pid, ['contain'=>['ProductMedia']]);

       if (!$product){
           $this->Flash->error('Product does not exists. please try again');
           return $this->redirect(['controller' => 'Products', 'action' =>  'index']);
       }

      /*  $this->paginate = [
            'contain' => ['Products', 'ProductVariants'],
            'order' => ['id' => 'desc'],
        ];
        $productMedia = $this->ProductMedia->find('all')->where([
           'product_id' => $pid,
//            'variant_id' => $vid
]); */


      //  $productMedia = $this->paginate($productMedia);
        $productMedia = $product->product_media;
        $this->set('pid',$pid);
        $this->set('vid', $vid);
        $this->set(compact('productMedia','product'));
    }

    public function getProductMedia($product_id, $v_id){
        $productMedia = $this->ProductMedia->find('all')->where([
            'product_id' => $product_id,
            'type' => 1,
            'variant_id = 0 OR variant_id ='.$v_id
        ]);

//        dd($productMedia);
        if ($this->request->is('ajax')){
            $this->set('variant_id',$v_id);
            $this->set(compact('productMedia'));
            $this->layout="ajax";
            $this->render('image_check_modal');
        }
    }

    /**
     * View method
     *
     * @param string|null $id Product Media id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productMedia = $this->ProductMedia->get($id, [
            'contain' => ['Products', 'ProductVariants'],
        ]);

        $this->set('productMedia', $productMedia);
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

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = $this->request->getData();


        if($this->request->is('post') && !$this->request->is('ajax') ){
            if(isset($data['type']) && $data['type'] == 0){
                $pid = $data['pid'];
                $vid = $data['vid'];
                $type = $data['type'];
                $youtubeId  = $this->videoId($data['youtube_code']);
                $data =[
                    'product_id' => $pid,
                    'variant_id' => $vid,
                    'path' => $youtubeId,
                    'type' => $type,
                ];
                $productMedia = $this->ProductMedia->newEntity();
                $productMedia = $this->ProductMedia->patchEntity($productMedia, $data);
                if($this->ProductMedia->save($productMedia)){
                    $this->Flash->success(__('The Youtube video has been saved.'));
                }else{
                    $this->Flash->error(__('Ops there was something wrong'));
                }

                return $this->redirect($this->referer());

            }
        }


//        $this->autoRender = false;

        if ($this->request->is('ajax')) {
            $pid = $this->request->getData('pid');
            $vid = $this->request->getData('vid');
            $type = $this->request->getData('type');
            $file = $this->request->getData('file');
            $response = array();

            $products = TableRegistry::getTableLocator()->get('Products');
            $product = $products->get($pid);

            if (!file_exists(PRODUCT_IMAGE_PATH.$pid)) mkdir(PRODUCT_IMAGE_PATH.$pid,0777,true);

            $IMAGE_SUPPORTED_FORMAT = explode(',', IMAGE_SUPPORTED_FORMAT);




            $fileExt = $this->extension($file['name']);
            $filename = $this->fileName($product->title) . "." . $fileExt;
            $dstPath = PRODUCT_IMAGE_PATH.$pid.DS.$filename;

            if(in_array($fileExt, $IMAGE_SUPPORTED_FORMAT)){

                if (move_uploaded_file($file['tmp_name'], $dstPath)) {
                    $data = [
                        'product_id' => $pid,
                        'variant_id' => $vid,
                        'path' => $filename,
                        'caption' => ''
                    ];
    
                    $productMedia = $this->ProductMedia->newEntity();
                    $productMedia = $this->ProductMedia->patchEntity($productMedia, $data);
                    if ($this->ProductMedia->save($productMedia)) {
    
                        if($vid != 0){
                            $this->layout="ajax";
                            $this->set('variant_id',$vid);
                            $this->set('productMedia',[$productMedia]);
                            $this->render('image_check_modal');
                            $this->response->withHeader("Content-Type","text/html; charset=UTF-8");
                            return;
                        }
    
    
                        $response = [
                            'status' => 'success',
                            'mid' => $productMedia->id,
                            'pid' => $productMedia->product_id,
                            'image' => $dstPath,
                            'caption' => $productMedia->caption
                        ];
                    }
                    else{
                        $response = [
                            'status' => 'error',
                            'errors' => $productMedia->errors()
                        ];
                    }
    
                }else{
                    $response = [
                        'status' => 'error',
                        'errors' => 'Media not upload'
                    ];
                }
            }else{
                $response = [
                    'status' => 'error',
                    'errors' => __('Unsupported Image format. Only support jpg png jpeg')
                ];
            }


            $this->layout="ajax";
            $this->set(compact('response'));
            $this->set('_serialize', 'response');
            $this->RequestHandler->renderAs($this, 'json');

        }
        return;
    }

    public function setDefault($pid, $mid)
    {
        if (isset($mid) && !empty($mid) &&isset($pid) && !empty($pid) && $this->request->is('ajax')){
            $this->ProductMedia->query()->update()->set(['default_image' => 0])
                ->where(['product_id' => $pid])->execute();

            $media = $this->ProductMedia->get($mid);
            $media->default_image = 1;
            if ($this->ProductMedia->save($media)){
                $response =[
                    'status' => 'success',
                    'msg' => __("Default Image set successfully"),
                    'data' => ''
                ];
            }else {
                $response = [
                    'status' => 'error',
                    'msg' => __("Default Image Not set"),
                    'data' => $media->errors()
                ];
            }
            $this->set(compact('response'));
            $this->set('_serialize', 'response');
            $this->RequestHandler->renderAs($this, 'json');
        }
    }

    private function clean($string) {
        $string = str_replace(' ', '-', $string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

    private function fileName($str = null){
        $str = $this->clean(strtolower($str));
        $milliseconds = round(microtime(true) * 1000);
        $now = date('d-m-Y')."-".$milliseconds;
        return substr($str,0,20)."-".$now;
    }

    private function path($path){
        $path = str_replace('/',DS,$path);
        $path = substr($path,0,1) == '\\' ? substr($path, 1) : $path;
        return WWW_ROOT.$path;
    }
    private function extension($path){
        return strtolower(pathinfo($path, PATHINFO_EXTENSION));
    }

    private function videoId($url = null){
        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
        return $my_array_of_vars['v'];
    }

    /**
     * Edit method
     *
     * @param string|null $id Product Media id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $caption = null)
    {
        $productMedia = $this->ProductMedia->get($id);
        if($this->request->is('ajax')){
            $productMedia->caption = $caption;
            if($this->ProductMedia->save($productMedia)){
                $response =[
                    'status' => 'success',
                    'caption' => $caption
                ];
            }else{
                $response =[
                    'status' => 'error',
                    'caption' => $productMedia->errors()
                ];
            }
            $this->set(compact('response'));
            $this->set('_serialize', 'response');
            $this->RequestHandler->renderAs($this, 'json');
        }
/*
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productMedia = $this->ProductMedia->patchEntity($productMedia, $this->request->getData());
            if ($this->ProductMedia->save($productMedia)) {
                $this->Flash->success(__('The product media has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product media could not be saved. Please, try again.'));
        }
        $products = $this->ProductMedia->Products->find('list', ['limit' => 200]);
        $variants = $this->ProductMedia->Variants->find('list', ['limit' => 200]);
        $this->set(compact('productMedia', 'products', 'variants'));
*/
    }

    /**
     * Delete method
     *
     * @param string|null $id Product Media id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productMedia = $this->ProductMedia->get($id);
        if(file_exists($this->path($productMedia->path))){
            unlink($this->path($productMedia->path));
        }

        if ($this->ProductMedia->delete($productMedia)) {
            $this->Flash->success(__('The product media has been deleted.'));
        } else {
            $this->Flash->error(__('The product media could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }


}

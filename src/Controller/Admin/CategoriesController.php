<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 *
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $categories = $this->paginate($this->Categories);

        $this->set(compact('categories'));

    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => [],
        ]);

        $this->set('category', $category);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {

            if (!file_exists(COLLECTION_IMAGE_PATH)) mkdir(COLLECTION_IMAGE_PATH,0777,true);

            $data = $this->request->getData();
            if (isset($data['image']['name']) && !empty($data['image']['name'])){
                $fileExt = $this->extension($data['image']['name']);
                if (!$this->isValidExt($fileExt)) {
                    $this->Flash->error(__('Collection Image could not be saved. Invalid file format.'));
                    $this->set(compact('category'));
                    return ;
                }

                $filename = $this->fileName($data['name']) . "." . $fileExt;
                $dstPath = COLLECTION_IMAGE_PATH.$filename;

                if (move_uploaded_file($data['image']['tmp_name'], $dstPath)){
                    $data['image'] = $filename;
                }else{
                    $this->Flash->error(__('Collection Image could not be saved. Please, try again.'));
                    return ;
                }
            }


            $data['match_cond'] = json_encode($this->request->getData()['match']);

            $category = $this->Categories->patchEntity($category, $data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $this->set(compact('category'));
    }


    public function addToCollection(){
        $this->autoRender = false;
        $data = $this->request->getData();
        $CategoriesHasProducts = TableRegistry::getTableLocator()->get('CategoriesHasProducts');

        $errors = false;

        $CategoriesHasProducts->deleteAll(['categories_id' => $data['cid']]);

        foreach ($data['products'] as $product){
            $row = [
                'categories_id' => $data['cid'],
                'products_id' => $product
            ];

            /*$categoriesHasProducts = $CategoriesHasProducts->newEntity();
            $categoriesHasProducts = $CategoriesHasProducts->patchEntity($categoriesHasProducts,$row);
            if (!$CategoriesHasProducts->save($categoriesHasProducts)){
                $errors[] = $categoriesHasProducts->errors();
            }*/
//            Delete previous code
//              $CategoriesHasProducts->query()->delete()->where($row)->execute();
//            insert new
            $insert = $CategoriesHasProducts->query()->insert(array_keys($row))->values($row)->execute();
            if (!$insert){
              $errors = true;
            }
        }

        if ($errors){
            $this->Flash->error(_("There was something wrong."));
        }else{
            $this->Flash->success(_('Product added to collection successfully'));
        }

        return $this->redirect(['action'=>'index']);
    }


    public function collections()
    {
        $collectionList = [];
        if(isset($_GET['collections']) && !empty($_GET['collections'])){
            $collections = explode(',', $_GET['collections']);
            $collections = $this->Categories->find('all')->where(['id IN' => $collections])->toArray();
        }
        else if(isset($_GET['q']) && !empty($_GET['q'])){
            $q = $_GET['q'];
            $collections = $this->Categories->find('all', [
                'conditions' => ['OR'=>['Categories.name LIKE' => '%' . $q . '%','Categories.description LIKE' => '%' . $q . '%']]
            ])->toArray();
        }
        else{
            $collections = $this->Categories->find('all')->toArray();
        }

        foreach ($collections as $collection){
            $collectionList[] = [
                'id'=>$collection->id,
                'title'=>$collection->name,
//                'image' => $collection->DefaultImage
            ];
        }

        $this->set(compact('collectionList'));
        $this->set('_serialize', 'collectionList');
    }



    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->getData();

            if (isset($data['image']['tmp_name']) && !empty($data['image']['tmp_name'])){
                if (empty($category->image) == false){
                    $saved_image_path = COLLECTION_IMAGE_PATH . $category->image;
                    if (file_exists($saved_image_path)) unlink($saved_image_path);
                }

                $fileExt = $this->extension($data['image']['name']);
                $filename = $this->fileName($data['name']) . "." . $fileExt;
                $dstPath = COLLECTION_IMAGE_PATH.$filename;

                if (!$this->isValidExt($fileExt)) {
                    $this->Flash->error(__('Collection Image could not be saved. Invalid file format.'));
                    $this->set(compact('category'));
                    return ;
                }

                if (move_uploaded_file($data['image']['tmp_name'], $dstPath)){
                    $data['image'] = $filename;
                }else{
                    $this->Flash->error(__('Collection Image could not be saved. Please, try again.'));
                    $this->set(compact('category'));
                    return;
                }
            }else{
                $data['image'] = $category->image;
            }


            $data['match_cond'] = json_encode($data['match']);
            $category = $this->Categories->patchEntity($category, $data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            pr($category->errors());
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $this->set(compact('category'));
        $this -> render('add');
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);

        if (empty($category->image) === false){
            $saved_image_path = COLLECTION_IMAGE_PATH . $category->image;
            if (file_exists($saved_image_path)) unlink($saved_image_path);
        }


        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    private function isValidExt($ext){
        $supported_extension = ['jpg', 'jpeg', 'png', 'gif'];
        return in_array($ext, $supported_extension);
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
}

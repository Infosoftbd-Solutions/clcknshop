<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * SitemapRebot Controller
 *
 *
 * @method \App\Model\Entity\SitemapRebot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WebMasterController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $Settings = TableRegistry::getTableLocator()->get('Settings');

        $data = array();

        $settings = $Settings->find('all')->where(['name' => 'robotstxt'])->orWhere(['name' => 'sitemap'])->toArray();
        foreach($settings as $setting ){
            
            $data[$setting->name]['id'] = $setting->id;
            $data[$setting->name]['name'] = $setting->value;

        }
        
        //pr($data);
        
        $this->set(compact('data'));
        
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     
    */

    /*
    public function add()
    {  
        $Settings = TableRegistry::getTableLocator()->get('Settings');
        
        
        if ($this->request->is('post')) {
            $data   = $this->request->getData();
            


            foreach($data as $key => $val){
                
                //$prevSettings = $Settings->find('all')->where(['name' => 'robotstxt'])->orWhere(['name' => 'sitemap'])->toArray();

                // $Settings->deleteAll($prevSettings);


                $setting = $Settings->find('all')->where(['name' => $key])->first();

                if($setting){
                    $setting->value = $val;
                    
                    if(!$Settings->save($setting)) 
                        $this->Flash->error(__("{0} value could not be updated ", [$key]));
                    
                    
                }
                else{

                    $setting = $Settings->newEntity();
                    $setting = $Settings->patchEntity($setting, ['name' => $key, 'value' => $val]);

                    if(!$Settings->save($setting)) 
                        $this->Flash->error(__("{0} value could not be updated ", [$key]));

                }
                
            }

        }
        
        return $this->redirect(['action' => 'index']);
        
    }

    */


    public function upload(){

                
        if ($this->request->is('post')) {
            $data   = $this->request->getData();
            $extension = ['sitemap' => 'xml', 'robotstxt' => 'txt'];

     

            foreach($data as $key => $file){
                
                if(!empty($file['tmp_name'])){

                    if($this->fileUpload($key, $file, $extension[$key]))
                        $this->Flash->success(__('{0} file uploaded successfully', [$key]));
                }

            }
        
        }
        
        return $this->redirect(['action' => 'index']);

    }


    private function fileUpload($name, $file, $extenstion, $uploadPath = UPLOAD){


        if(!file_exists($uploadPath))
            mkdir($uploadPath, 0777, true);

        // upload template  file
        if ($file['error'] > 0 || $file['error'] > 0){
            $this->Flash->error(__('There was something.'));
            return false;
        }

        $filename = $this->clean($file['name']);
        $path = $uploadPath. $filename;

        
        $path_info = pathinfo($file['name']);
        
        if ($path_info['extension'] != $extenstion){
            $this->Flash->error(__('Invalid  file format.'));
            return false;
        }
    
        if(move_uploaded_file($file['tmp_name'], $path)){
            $this->updateSetting($name, $filename);
        }
        else{
            $this->Flash->error(__('File upload failed.'));
            return false;
        }

        return true;

    }

    
    private function clean($string) {
        $string = str_replace(' ', '-', $string);
        return preg_replace('/[^A-Za-z0-9\-.]/', '', $string);
    }

    private function updateSetting($key, $val){

        $Settings = TableRegistry::getTableLocator()->get('Settings');
        $setting = $Settings->find('all')->where(['name' => $key])->first();

        if($setting){
            $setting->value = $val;
            
            if(!$Settings->save($setting))
                $this->Flash->error(__("{0} value could not be updated ", [$key]));
            
        }
        else{

            $setting = $Settings->newEntity();
            $setting = $Settings->patchEntity($setting, ['name' => $key, 'value' => $val]);

            if(!$Settings->save($setting)) 
                $this->Flash->error(__("{0} value could not be updated ", [$key]));

        }
    }


    public function delete($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);
        
        $Settings = TableRegistry::getTableLocator()->get('Settings');

        $setting = $Settings->get($id);

        if(file_exists(UPLOAD. $setting->value))
            unlink(UPLOAD. $setting->value);

        if ($Settings->delete($setting)) {
            $this->Flash->success(__('The file has been deleted.'));
        } else {
            $this->Flash->error(__('The file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


}

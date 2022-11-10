<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Model\Entity\Setting;
use Cake\Core\Configure;
use Cake\ORM\Locator\TableLocator;
use Cake\ORM\TableRegistry;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * GeneralOptions Controller
 *
 *
 * @method \App\Model\Entity\GeneralOption[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GeneralOptionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $Settings = TableRegistry::getTableLocator()->get('Settings');
        $settings = $Settings->find('all')->all();
        foreach ($settings as $setting){
            $this->set($setting->name, $this->isJson($setting->value) ? json_decode($setting->value, true) : $setting->value);
        }
        $this->render('edit');
    }

    public function notification(){
        $Settings = TableRegistry::getTableLocator()->get('Settings');

        if($this->request->is('post')){
            $value = array();
            $data = $this->request->getData();
            if(isset($data['value']) && count($data['value']) > 0) $value = $data['value'];

            $setting = $Settings->find('all')->where(['name' => $data['key']])->first();
            if($setting){
                $setting->value = json_encode($value);
                if(!$Settings->save($setting)){
                    $this->Flash->error(__('The notification settings could not be saved. Please, try again.'));
                }
                else{
                    $this->Flash->success(__('The notification settings has been saved.'));
                }
            }
            else{
                $settings = $Settings->newEntity();
                $settings = $Settings->patchEntity($settings, ['name' => $data['key'], 'value' => json_encode($value)]);
                if(!$Settings->save($settings)){
                    $this->Flash->error(__('The notification settings could not be saved. Please, try again.'));
                }
                else{
                    $this->Flash->success(__('The notification settings has been saved.'));
                }
            }
        }

        foreach (["mail_notification", "sms_notification"] as $key) {
            $setting = $Settings->find('all')->where(['name' => $key])->first();
            if($setting)
                $this->set($key, json_decode($setting->value));
        }
    }


    public function smsContent(){

        if($this->request->is('post')){
            $Settings = TableRegistry::getTableLocator()->get('Settings');
            $data = $this->request->getData();
            $msg = ["Order Placed", "Order Processing", "Order Shipped", "Order Delivered", "Order Cancelled"];

            for($i = 0; $i < count($data['key']); $i++ ){
                    // $unicode = false;
                    $status = true;
                    $value = $data['value'][$i];
                    $key   = $data['key'][$i];

                    // if (strlen($value) != strlen(utf8_decode($value))) $unicode = true;

                    $setting = $Settings->find('all')->where(['name' => $key ])->first();
                    if($setting){
                        $setting->value = $value;

                        if(!$Settings->save($setting)){
                            $status = false;
                            $this->Flash->error(__("The SMS Content ({0}) could not be saved. Please, try again.", [$msg[$id]]));
                        }

                    }
                    else{
                        $settings = $Settings->newEntity();
                        $settings = $Settings->patchEntity($settings, ['name' => $key, 'value' => $value]);
                        if(!$Settings->save($settings)){
                            $status = false;
                            $this->Flash->error(__("The SMS Content ({0}) could not be saved. Please, try again.", [$msg[$id]]));
                        }
                    }
            }

            if($status)
                $this->Flash->success(__('All of messages have been saved.'));

        }

        return  $this->redirect(['action' => 'notification']);
    }



    /**
     * View method
     *
     * @param string|null $id General Option id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $Settings = TableRegistry::getTableLocator()->get('Settings');

        $generalOption = $Settings->newEntity();
        if ($this->request->is('post')) {
            $generalOption = $Settings->patchEntity($generalOption, $this->request->getData());
            if ($Settings->save($generalOption)) {
                $this->Flash->success(__('The general option has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The general option could not be saved. Please, try again.'));
        }
        $this->set(compact('generalOption'));
    }

    /**
     * Edit method
     *
     * @param string|null $id General Option id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */


    public function edit($id = null)
    {
        $Settings = TableRegistry::getTableLocator()->get('Settings');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            foreach ($data as $key => $value){
                $setting = $Settings->find('all')->where(['name' => $key])->first();

                if ($key == "has_smtp") continue;

                if (($key == "mail" && key_exists('has_smtp', $data) == false)){
                   unset($value['smtp']);
                }
                if ($key == "mail"){
                  foreach($value as $k=>$v) if(empty($v)) unset($value[$k]);
                  if(empty($value)) continue;
                  //pr($value); die();
                }

                if ($key == "login" && key_exists('garbage', $value)){
                    unset($value['garbage']);
                }

                if($key == 'logo' || $key == 'favicon'){

                    if (empty($value)) continue;

                    if (isset($value['tmp_name']) && !empty($value['tmp_name'])){
                        $fileExt = $this->extension($value['name']);
                        if ($key == 'logo' && !$this->isValidExt($fileExt)) {
                            $this->Flash->error(__("{0} Image could not be saved. Invalid file format.", [$key]));
                            continue;
                        }else if($key == 'favicon' && $fileExt !='ico'){
                          $this->Flash->error(__("{0} should be in ico format.", [$key]));
                          continue;
                        }

                        $filename = $this->fileName($value['name']) . "." . $fileExt;

                        if (!file_exists(LOGO_PATH)) mkdir(LOGO_PATH, 0777, true);
                        if (move_uploaded_file($value['tmp_name'], LOGO_PATH.$filename)){
                            if($key == 'logo'){
                                $image = Image::make(LOGO_PATH.$filename);
                                $height = 150;
                                $width = 150;
                                if($image->height() > $height){
                                  $image->resize(null, $height, function ($constraint) {
                                      $constraint->aspectRatio();
                                  })->save(LOGO_PATH.$filename);
                                }

                                if($image->width() > $width){
                                  $image->resize($width, null, function ($constraint) {
                                      $constraint->aspectRatio();
                                  })->save(LOGO_PATH.$filename);
                                }
                            }



                            $value= $filename;

                            if ($setting) {
                                if (empty($setting->value) == false){
                                    if (file_exists(LOGO_PATH.$setting->value)){
                                        unlink(LOGO_PATH.$setting->value);
                                    }
                                }

                            }
                        }else{
                            $this->Flash->error(__('Logo Image could not be saved. Please, try again.'));
                            continue;
                        }
                    }else{
                        continue;
                    }

                }

                $value = is_array($value) ? json_encode($value) : $value;
                if ($setting)
                    $setting->value = $value;
                else{
                    $setting = $Settings->newEntity();
                    $setting = $Settings->patchEntity($setting, ['name' => $key, 'value' => $value]);
                }

                if (!$Settings->save($setting)){
                    $this->Flash->error(__('The setting could not be saved. Please, try again.'));
                    return $this->redirect(['action' => 'index']);
                }
            }

            $this->Flash->success(__('The setting has been saved.'));
        }

        return  $this->redirect(['action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id General Option id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $generalOption = $this->GeneralOptions->get($id);
        if ($this->GeneralOptions->delete($generalOption)) {
            $this->Flash->success(__('The general option has been deleted.'));
        } else {
            $this->Flash->error(__('The general option could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    private function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    private function extension($path){
        return strtolower(pathinfo($path, PATHINFO_EXTENSION));
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
}

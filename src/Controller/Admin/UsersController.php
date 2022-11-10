<?php
namespace App\Controller\Admin;
use Cake\Auth\DefaultPasswordHasher;
use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;
use Cake\Utility\Security;
use  Cake\Log\Log;
use mysqli;
use ZipArchive;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function login(){

        $this->layout = 'login';
        $session = $this->request->getSession();

        if ($this->request->is('post')){
            $data = $this->request->getData();
            $email = $data['email'];
            $password = $data['password'];

            $user = $this->Users->find()->where(['email'=>$email, 'password' => md5($password)])->first();

            if($user){
                if($user->status == 1){

                    $session->write([
                        'user_logged_in' => true,
                        'user' => $user,
                        'user_id' => $user->id,
                        'user_role' => $user->role,
                        'user_super_admin'=> ($user->role == 1 && $_SERVER['SERVER_NAME'] == ADMIN_DOMAIN)?true:false 
                    ]);

                    if($user->role == 2 )
                        return $this->redirect("/pos");

                    $this->Flash->success(__('You are successfully logged in.'));
                    return $this->redirect("/admin");
                }else{
                    $this->Flash->error(__('Your account has been disabled.'));
                }
            }else{
                $this->Flash->error(__('username or password wrong.'));
            }


        }

    }

    

    protected function generateNonce()
    {
         $expiryTime = microtime(true) + 300;
         $secret = Configure::read('app_token',"clcknshop");
         $signatureValue = hash_hmac('sha256', $expiryTime . ':' . $secret, $secret);
         $nonceValue = $expiryTime . ':' . $signatureValue;

         return base64_encode($nonceValue);
    }

    /* public function nonce(){
      echo $this->generateNonce();
      die();
    } */

     /**
      * Check the nonce to ensure it is valid and not expired.
      *
      * @param string $nonce The nonce value to check.
      * @return bool
      */
     protected function validNonce($nonce)
     {
         $value = base64_decode($nonce);
         if ($value === false) {
             return false;
         }
         $parts = explode(':', $value);
         if (count($parts) !== 2) {
             return false;
         }
         $expires = $parts[0];
         $checksum = $parts[1];
         //[$expires, $checksum] = $parts;

         if ($expires < microtime(true)) {
             return false;
         }
         $secret = Configure::read('app_token',"clcknshop");
         $check = hash_hmac('sha256', $expires . ':' . $secret, $secret);

         return hash_equals($check, $checksum);
     }

    public function autoLogin($token){
        $Settings = TableRegistry::getTableLocator()->get('Settings');

      if (!$this->request->is('post')) return;
 
        $data = $this->request->getData();
    
        $req        = $data['auth_token'];
        $nonce      = $data['nonce'];
        $username   = $data['username'];
        $storeData      = json_encode($data['store']);

        $password = Configure::read('site_password');
        $subdomain = Configure::read('main_domain',"clcknshop.com");
        if(md5(Configure::read('app_token',"clcknshop")) != "$token"){
            $this->Flash->error(__('token mismatched'));
            return $this->redirect(['controller'=>'Users', 'action'=>'login']);
        }

        if($this->validNonce($nonce) == false){
          $this->Flash->error(__('nonce expired'));
          return $this->redirect(['controller'=>'Users', 'action'=>'login']);
        }

        $session = $this->request->getSession();

     

        $user = $this->Users->find()->where(['email'=>$username])->first();
        if (!$user){
            $this->Flash->error(__('invalid email'));
            return $this->redirect(['controller'=>'Users', 'action'=>'login']);
        }
        if($user){
            if($data['auth_token'] != md5($user->email . ":" . $user->password . ":" . $nonce)){
              $this->Flash->error(__('invalid response token'));
              return $this->redirect(['controller'=>'Users', 'action'=>'login']);
            }
        }


        $session->write([
            'user_logged_in' => true,
            'user' => $user,
            'user_id' => $user->id,
            'user_role' => 1
        ]);
        $this->Flash->success(__('You are successfully logged in.'));

       //Log::write('debug', $storeData);
        if(isset($data['store']['currency'])){
            $setting = $Settings->newEntity();
            $setting = $Settings->patchEntity($setting,[
                'name' => 'currency',
                'value' => $data['store']['currency']
            ]);
            if (!$Settings->save($setting)){
                 Log::write('debug', "Store currency could not write ");
            }
            
        }
        
        //$storeData['web'] =  $_SERVER['SERVER_NAME'];   
    
        $setting = $Settings->newEntity();
        $setting = $Settings->patchEntity($setting,[
            'name' => 'store',
            'value' => $storeData
        ]);
        if (!$Settings->save($setting)){
             Log::write('debug', "Store data could not write ");
        }

       


        return $this->redirect("/admin");

    }

    public function logout(){
        $this->autoRender = false;
        $session = $this->request->getSession();
        $session->delete('user_logged_in');
        $session->delete('user');
        $session->delete('user_role');
        return $this->redirect(['action' => 'login']);
    }

   function json_response($resp){
     header('Access-Control-Allow-Origin: *');
     $this->set(compact('resp'));
     $this->set('_serialize', 'resp');
     $this->RequestHandler->renderAs($this, 'json');
   }
    
    

    

    
    
    
   


    public function profile()
    {
        $id = $this->request->getSession()->read('user_id');

        $user = $this->Users->get($id);

        if ($this->request->is(['post', 'put'])){
            if(Configure::read('App.demo_mode') == 1){
                $this->Flash->error(__('User edit is disabled in demo mode.'));
                return $this->redirect(['action' => 'profile']);
            }
            $data = $this->request->getData();
            if (empty(trim($data['password']))) unset($data['password']);
            else  $data['password'] = md5($data['password']);

            $user = $this->Users->patchEntity($user,$data);

            if (!$this->Users->save($user)){
                pr($user->errors());
                $this->Flash->error(__('User information could not update.'));
            }else{
                $this->Flash->success(__("User Information has been updated"));
            }
        }

        $this->set('user', $user);
    }


    public function resetPassword($token = null)
    {
        $this->layout = 'ajax';
        if ($this->request->session()->read('user_logged_in')) return $this->redirect(['controller' => 'Orders', 'action' => 'index']);

        if (isset($token) && empty($token) == false){
            if($this->validNonce($token) == false){
                $this->Flash->error(__("Reset Password token Invalid or Expired"));
                return $this->redirect($this->referer());
            }

            $user = $this->Users->find('all')->where(['token' => trim($token)])->first();
            if (!$user) {
                $this->Flash->error(__("Invalid Token. Please try to reset again"));
                return $this->redirect($this->referer());
            }

            $this->set('token', $token);
            $this->render('new_password');
            return ;
        }


        if ($this->request->is('post')){
            $data = $this->request->getData();

            if(!empty($data['token'])){
                if (!isset($data['password']) || empty($data['password'])){
                    $this->Flash->error(__("Password field is required"));
                    return $this->redirect($this->referer());
                }elseif (strlen($data['password']) <6 ){
                    $this->Flash->error(__("Password must be at least 6 characters"));
                    return $this->redirect($this->referer());
                }
                else if (!isset($data['confirm_password']) || empty($data['confirm_password'])){
                    $this->Flash->error(__("Confirm Password field is required"));
                    return $this->redirect($this->referer());

                }else if (!isset($data['password']) || ($data['password'] != $data['confirm_password'])){
                    $this->Flash->error(__("Confirm password does not match"));
                    return $this->redirect($this->referer());
                }

                $user = $this->Users->find('all')->where(['token' => $data['token']])->first();

                if (!$user){
                    $this->Flash->error(__("Invalid Token. Please try to reset again"));
                    return $this->redirect($this->referer());
                }

                $user->token = null;
                $user->password = md5($data['password']);

                if ($this->Users->save($user)){
                    $this->Flash->success(__('Your password has been changed.'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'login']);
                }

                $this->Flash->error(__('Ops There was something wrong. please try again later'));
                return $this->redirect($this->referer());

            }



            $email = $this->request->getData('email');
            if (empty($email)){
                $this->Flash->error(__("The email address could not be empty."));
                return $this->redirect($this->referer());
            }

            $user = $this->Users->find('all')->where(['username' => $email])->first();
            if (!$user){
                $this->Flash->error(__("The email address does not exists, Please enter valid email."));
                return $this->redirect($this->referer());
            }

            $token = $this->generateNonce();
            $user->token = $token;

            if (!$this->Users->save($user)){
                $this->Flash->error(__("Ops! there was something wrong. please try again later."));
                return $this->redirect($this->referer());
            }

            $mail = $this->Mail->send($user->email, 'Reset Password Link', ['customer_name' => $user->first_name  . " " . $user->last_name, 'link' => Router::url(['controller' => 'Users', 'action' => 'resetPassword', $token], true)], 'reset_password');

            if ($mail){
                $this->Flash->error(__("Ops! there was something wrong. please try again later."));
            }
            else{
                $this->Flash->success(__('An email has been sent to the email address. please follow the instruction to reset password.'));
            }
        }

    }




    public function index($garbage = null, $query = null)
    {
        $users = $this->Users->find('all', ['order' => 'Users.id DESC']);
        $users = $this->paginate($users);


        if($this->request->is('ajax')) {
            $users = $this->Users->find('all')->where([
                'OR' => [
                    'Users.first_name LIKE' => '%' . $query . '%',
                    'Users.last_name LIKE' => '%' . $query . '%',
                    'Users.phone LIKE' => '%' . $query . '%'
                ]
            ]);
            $users = $this->paginate($users);
            $this->set(compact('users'));
            $this->layout="ajax";
            $this->render('user_display');
        }
        else
            $this->set(compact( 'users'));
    }



    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            // dd($data);
            if($data['password'] != $data['con_password']){
              $this->Flash->error(__('Confirm password does not matched.'));

            }else{

             $exist = $this->Users->find('all')->where(['email' => $data['email']])->count();
             

              if($exist){
                $this->Flash->error(__('The email already exist. please try another'));
              }
              else{
                $data['password'] = md5($data['password']);
                $user = $this->Users->patchEntity($user, $data);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->error(__('The user could not be saved. Please, try again.'));
              }
            }
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if(Configure::read('App.demo_mode') == 1){
                $this->Flash->error(__('User edit is disabled in demo mode.'));
                return $this->redirect(['action' => 'index']);
            }
            $data = $this->request->getData();

            if(key_exists('new_password', $data) && empty($data['new_password']) == false){
                $data['password']  = md5($data['new_password']);
            }

            if((isset($data['password'])) && ($data['new_password'] != $data['con_password'])){
              $this->Flash->error(__('confirm password does not matched.'));

            }else{
                
             $exist = $this->Users->find('all')->where([
                 'email' => $data['email'],
                 'id != ' => $id 
                 ])->count();

                if($exist){
                    $this->Flash->error(__('The email address already exist. please try another'));                
                }
                else{
                    $user = $this->Users->patchEntity($user, $data);
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('The user has been saved.'));

                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
              
            }
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    private function decrypt($ivHashCiphertext, $password) {
        $method = "AES-256-CBC";
        $iv = substr($ivHashCiphertext, 0, 16);
        $hash = substr($ivHashCiphertext, 16, 32);
        $ciphertext = substr($ivHashCiphertext, 48);
        $key = hash('sha256', $password, true);

        if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;

        return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
    }

  /*   public function dbsync(){

        $db =  ConnectionManager::get('default')->config();

        include '/opt/clcknshop/dbsync/class.dbsync.php';
        $dbsync = new \DBSync();

        $dbsync->SetHomeDatabase("clcknshop_main", 'mysql', $db['host'], $db['username'], $db['password']);
        $dbsync->AddSyncDatabase($db['database'], 'mysql', $db['host'], $db['username'], $db['password']);
        if($dbsync->Sync()){
            echo "db is synced";
        }else {
          echo "db not synced";
        }



        exit() ;
    } */


       
}

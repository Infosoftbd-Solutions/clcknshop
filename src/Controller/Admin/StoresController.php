<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Routing\Router;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Core\Configure;
use mysqli;
use ZipArchive;

/**
 * Stores Controller
 *
 * @property \App\Model\Table\StoresTable $Stores
 *
 * @method \App\Model\Entity\Store[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StoresController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function beforeFilter(\Cake\Event\Event $event){
       
        if($_SERVER['SERVER_NAME'] != ADMIN_DOMAIN)
            $this->redirect('/admin');
        
        if($this->request->action != 'create' && $this->request->getSession()->read('user_super_admin')==false){
            $this->redirect('/admin');
        }    
            
        parent::beforeFilter($event);
    }

    public function themes(){
        $thems = preg_grep('~\.(zip)$~', scandir(THEMES_DIR));
       
        $themes = [];
        foreach ($thems as $theme){
            $file = THEMES_DIR.basename($theme,'.zip').DS."theme.xml";
            if (file_exists($file)){
                $xml = simplexml_load_file($file);
                if(!empty($xml->thumbnail))  $xml->thumbnail = Router::url(THEMES_DIR.basename($theme,'.zip').DS.$xml->thumbnail,true);
                $xml->link = Router::url(THEMES_DIR.$theme,true);
                $themes[] = $xml;
            }
              
        }
        //pr($themes);
        $json = json_encode($themes);
        $this->autoRender = false;
        $this->response->type('Content-Type: application/json');
        $this->response->body($json);
    }


    // MANAGE THEME 

    public function manageTheme()
    {
    
        $themes = [];
        $path    = THEMES_DIR;
        //die($path);
        $themesfolder = array_slice(scandir($path), 2);
        
        foreach ($themesfolder as $theme){
            $file = $path.$theme.DS."theme.xml";
            $zip_file = $path. $theme.".zip";
           // echo $zip_file;
            if (file_exists($file)){
                $xml = simplexml_load_file($file);
                $xml->folder_name = $theme;
                if(file_exists($zip_file)) $xml->active = 1;
                else  $xml->active = 0;
                $themes[] = $xml;
            }
        }
        //pr($themes); 
        usort($themes, function($a, $b) {
          
            if((int) $a->active[0] >(int) $b->active[0]) {
               
                return -1;
            }
            elseif((int) $a->active[0] < (int) $b->active[0]) {
               
                return 1;
            }
            else {
                return 0;
            }
        });
        
     
        
        $this->set(compact('themes'));

    }



    private function ThemeZip($theme){

                    // Get real path for our folder
            $rootPath = realpath(THEMES_DIR.$theme);
            //die($rootPath);
            // Initialize archive object
            $zip = new ZipArchive();
            $zip->open(THEMES_DIR . $theme . '.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

            // Create recursive directory iterator
            /** @var SplFileInfo[] $files */
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($rootPath),
                \RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file)
            {
                // Skip directories (they would be added automatically)
                if (!$file->isDir())
                {
                    // Get real and relative path for current file
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($rootPath) + 1);

                    // Add current file to archive
                    $zip->addFile($filePath, $relativePath);
                }
            }

            // Zip archive will be created only after closing object
            $zip->close();
    }

    /**
     * Edit method
     *
     * @param string|null $id Theme id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function ThemeEdit($id = null)
    {
    

        $file = THEMES_DIR.$id.DS."theme.xml";
        if(file_exists($file)){
            $theme = simplexml_load_file($file);
            $theme->folder_name = $id;
            if(file_exists(THEMES_DIR.$id . '.zip')) $theme->active = 1;
            else $theme->active = 0;
        }
        else{
            $this->Flash->error(__('Not a valid theme'));
            return $this->redirect(['action' => 'manageTheme']);
        }    
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
        
            if(!empty($data['thumbnail']['tmp_name'])){

                // upload thumbnail file
                $path_info = pathinfo($data['thumbnail']['name']);
                $filename = $id . '.'. $path_info['extension'];
                $path_info = pathinfo($data['thumbnail']['name']);
                $path = THEMES_DIR.$id.DS.$filename;

                if(!in_array($path_info['extension'], ["png", "jpg", "jpeg"])){
                    $this->Flash->error(__('Invalid Thumbnail file format.'));
                    return;
                }

                move_uploaded_file($data['thumbnail']['tmp_name'], $path);
                
              

                // save file into database
                $data['thumbnail'] = $filename;
            
            }
            else{
                $data['thumbnail'] = $theme->thumbnail;
            }

            $theme->name = $data['name'];
            $theme->author = $data['author'];
            $theme->description = $data['description'];
            $theme->preview = $data['preview'];
            $theme->thumbnail = $data['thumbnail'];
            $theme->asXml($file);
            $zip_file = THEMES_DIR.$id . '.zip';
            @unlink ($zip_file); 
            if($data['active'] == 1){                
              //  exec('zip -r ' . $id . '.zip "' . $id .  '"');               
              $this->ThemeZip($id);
            }

            $this->Flash->success(__('The theme has been saved.'));

            return $this->redirect(['action' => 'manageTheme']);
        }
        $this->set(compact('theme'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Theme id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
   /*  public function themeDelete($id = null)
    {
        $Themes = TableRegistry::getTableLocator()->get('Themes');

        $this->request->allowMethod(['post', 'delete']);
        $theme = $Themes->get($id);
        //$uploadedFolder = WWW_ROOT . 'themes' . DS;

        if(file_exists(THEMES_DIR. $theme->link)) 
            unlink(THEMES_DIR. $theme->link);

        if(file_exists(THEMES_DIR. $theme->thumbnail))
            unlink(THEMES_DIR. $theme->thumbnail);

        if ($Themes->delete($theme)) {
            $this->Flash->success(__('The theme has been deleted.'));
        } else {
            $this->Flash->error(__('The theme could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'manageTheme']);
    } */


   /*  public function upload($data){

        if(!file_exists(THEMES_DIR))
            mkdir(THEMES_DIR, 0777, true);

        // upload template  file
        if ($data['link']['error'] > 0 || $data['thumbnail']['error'] > 0){
            $this->Flash->error(__('There was something.'));
            return false;
        }

        $filename = $this->filename($data['name']);
        $path = THEMES_DIR.$filename. '.zip';

        if(file_exists($path)){
            $this->Flash->error(__('Theme file already exists'));
            return false;
        }

        
        $path_info = pathinfo($data['link']['name']);
        
        if ($path_info['extension'] != 'zip'){
            $this->Flash->error(__('Invalid template file format.'));
            return false;
        }
    
        if(! move_uploaded_file($data['link']['tmp_name'], $path)){
            $this->Flash->error(__('File upload failed.'));
            return false;
        }


        // upload thumbnail file
        $path_info = pathinfo($data['thumbnail']['name']);
        $path = THEMES_DIR.$filename. '.'.$path_info['extension'];

        if(!in_array($path_info['extension'], ["png", "jpg", "jpeg"])){
            $this->Flash->error(__('Invalid Thumbnail file format.'));
            return false;
        }

        move_uploaded_file($data['thumbnail']['tmp_name'], $path);


        // save file into database
        $data['thumbnail'] = $filename. '.' . $path_info['extension'];
        $data['link']      = $filename.'.zip';

        return $data;
    }
 */
    public function themeUpload(){
        $this->autoRender = false;
        if ($this->request->is('post')){
            $file = $this->request->getData('file');
           
            $errors = array();
            if (isset($file) && !empty($file)){
               // $temp_dir = TMP.uniqid();

                if (strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) == "zip")
                {
                
                    $zip = new ZipArchive;
                    $res = $zip->open($file['tmp_name']);
                    if ($res === TRUE) {
                        $fp = $zip->getStream('theme.xml');
                        if(!$fp) {
                            $zip->close();
                            $this->Flash->error(__('Invalid theme file'));
                            $this->redirect($this->request->referer());
                            return;
                        }
                        $contents = '';
                        while (!feof($fp)){
                            $contents .=fread($fp,2);
                        }
                        fclose($fp);

                        $theme_xml  = (array) simplexml_load_string($contents);
                        $errors = [];
                        if (key_exists('name', $theme_xml)){
                            if (empty($theme_xml['name'])) $errors[] = __("Meta data messing: theme name not exists");
                        }else{
                            $errors[] = __("Meta data messing: theme name not exists");
                        }
                        if (key_exists('author', $theme_xml)){
                            if (empty($theme_xml['author'])) $errors[] = __("Meta data messing: theme author not exists");
                        }else{
                            $errors[] = __("Meta data messing: theme author not exists");
                        }
                        if (key_exists('description', $theme_xml)){
                            if (empty($theme_xml['description'])) $errors[] = __("Meta data messing: theme description not exists");
                        }else{
                            $errors[] = __("Meta data messing: theme description not exists");
                        }

                        if (key_exists('thumbnail', $theme_xml)){
                            if (empty($theme_xml['thumbnail'])) $errors[] = __("Meta data messing: theme thumbnail image not exists");
                        }else{
                            $errors[] = __("Meta data messing: theme thumbnail image not exists");
                        }
                        if (key_exists('preview', $theme_xml)){
                            if (empty($theme_xml['preview'])) $errors[] = __("Meta data messing: theme preview image not exists");
                        }else{
                            $errors[] = __("Meta data messing: theme preview image not exists");
                        }

                        if (key_exists('version', $theme_xml)){
                            if (empty($theme_xml['version'])) $errors[] = __("Meta data messing: theme version image not exists");
                        }else{
                            $errors[] = __("Meta data messing: theme version image not exists");
                        }

                        if(sizeof($errors) > 0){
                            $zip->close();
                            $this->Flash->error(__('Invalid theme metadata'));
                            $this->redirect($this->request->referer());
                            return;
                        }
                        $theme_dir =  THEMES_DIR   . substr($file['name'],0,-4) .DS;
                        $theme_zip =  THEMES_DIR   .$file['name'];
                        
                        $this->rrmdir($theme_dir);
                        @unlink(THEMES_DIR.$file['name']);
                        move_uploaded_file($file['tmp_name'], $theme_zip);

                        $extract = $zip->extractTo($theme_dir);
                        $zip->close();
                        $this->Flash->error(__('Theme successfully uploaded'));
                        $this->redirect($this->request->referer());                        
                    
                    } 
                }
            }
        }       

    }

    public function index($garbage = null, $keyword = "")
    {

        $stores = $this->Stores->find('all', ['order' => 'Stores.id DESC']);


        if ($this->request->is('ajax')) {
            $stores = $this->Stores->find('all')->where(["store_name LIKE '%" . $keyword . "%' OR email LIKE '%" . $keyword . "%'"]);

            $stores = $this->paginate($stores);
            $this->set(compact('stores'));
            $this->layout = "ajax";
            $this->render('ajax_store');
        } else {
            $stores = $this->paginate($stores);
            $this->set(compact('stores'));
        }
    }

    function encrypt($plaintext, $password)
    {
        $method = "AES-256-CBC";
        $key = hash('sha256', $password, true);
        $iv = openssl_random_pseudo_bytes(16);

        $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
        $hash = hash_hmac('sha256', $ciphertext . $iv, $key, true);

        return $iv . $hash . $ciphertext;
    }

    function updateCsv()
    {
        $stores  = $this->Stores->find("all")->where(['disabled' => 0])->toArray();
        if (!$stores) return false;
        $domain_conf = '';
        $handle = fopen(SUBDOMAINS_PATH, "w");
        foreach($stores as $store){
            fputcsv($handle, [str_replace('https://', '', $store->store_url),$store->store_name]);
            if(!empty($store->domain_name)){
                $domain_conf .= "\n\t" . $store->domain_name;
                $domains = explode(' ',$store->domain_name);
                foreach($domains as $domain)
                    fputcsv($handle, [$domain,$store->store_name]);                                     
            }
        }
        fclose($handle);      
        if($domain_conf != ''){
            file_put_contents(APACHE_CONF_PATH,'ServerAlias '  . str_replace("\n\t"," ",$domain_conf));
            $domain_conf =  'server_name'  . $domain_conf . ';'; 
            file_put_contents(NGINX_CONF_PATH,$domain_conf);
               
        }
        
    }


    /**
     * Edit method
     *
     * @param string|null $id Store id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

  
    public function edit($id = null)
    {
        $store = $this->Stores->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            unset($data['store_name']);
            unset($data['store_url']);

            //pr($this->request->getData()); die();
            $store = $this->Stores->patchEntity($store, $data);
            if ($this->Stores->save($store)) {
                $this->updateCsv();
                $this->Flash->success(__('The store has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                //pr($store->errors());
                $this->Flash->error(__('The store could not be saved. Please, try again.'));
            }
        }
        $Customer = TableRegistry::getTableLocator()->get('Customers');
        $customers = $Customer->find('list', [
            'valueField' => function ($row) {
                return $row->first_name . ' ' . $row->last_name;
            },
            'limit' => 200
        ]);
        $this->set(compact('store', 'customers'));
    }





    private  function CreateDB($db_name, $email, $password, $themeName, $store)
    {

        $db =  ConnectionManager::get('default')->config();

        #DATABASE INFO
        $db_host = $db['host'];
        $db_user = $db['username'];
        $db_password = $db['password'];;
        $sql_script = DBSQL_PATH;
        //   $db_name = "final_db";

        if (!file_exists($sql_script) || time()-filemtime($sql_script) > 24 * 3600)
            $this->databaseDump($sql_script,['stores']);

        #USER INFO
        $first_name = "";
        $last_name  = "";
        $phone      = ""; //empty($phone) ? "" : $phone;
        $username   = "";
        //  $password = 'password'
        $password   = md5($password);


        #DB CONNECTION
        $con  = new mysqli($db_host, $db_user, $db_password);
        if ($con->connect_errno) die("Fail to connect to mysql! " . $con->connect_errno);

        # SEARCH EXISTING DATABASE

        $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE  SCHEMA_NAME = '{$db_name}'";

        if ($schema = $con->query($sql)) {

            if ($schema->num_rows == 0) {
                #CREATE NEW DATABASE
                $sql = "CREATE DATABASE {$db_name} CHARACTER SET utf8 COLLATE utf8_general_ci";

                if ($database = $con->query($sql)) {
                    #SELECT DATABASE
                    if ($con->select_db($db_name)) {

                        #IMPORT SQL FILE
                        $file = file($sql_script);

                        $sql = '';
                        foreach ($file as $line) {
                            $startWith = substr(trim($line), 0, 2);
                            $endWith = substr(trim($line), -1, 1);

                            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                                continue;
                            }

                            $sql = $sql . $line;

                            if ($endWith == ';') {
                                if ($con->query($sql) == false) die(__("SQL Exicution Failed - {0} ", [$sql]));

                                $sql = '';
                            }
                        }
                    }

                    $con->close();

                    #CONNECTION FOR NEW USER
                    $con  = new mysqli($db_host, $db_user, $db_password, $db_name);
                    if ($con->connect_errno) die(__("Fail to connect to mysql! {0}", [$con->connect_errno]));

                    #INSERT NEW USER
                    $sql = "INSERT INTO users (first_name, last_name, email, phone, username, password, role, status, created, updated) VALUES ('$first_name', '$last_name', '$email', '$phone', '$username', '$password', '1', '1', NOW(), NOW())";

                    if ($user = $con->query($sql) == false) die(__("New User Insertion failed"));

                    #SET THEME NAME
                   // $sql = "INSERT INTO `settings` (`id`, `name`, `value`) VALUES (NULL, 'theme', '{$themeName}');";
                    #SET STORE NAME
                   // if ($user = $con->query($sql) == false) die(__("New Settings Insertion failed"));
                   // $sql = "INSERT INTO `settings` (`id`, `name`, `value`) VALUES (NULL, 'store_name', '{$store}');";

                    //if ($user = $con->query($sql) == false) die(__("New Settings Insertion failed"));

                    $con->close();

                    // print("Database Imported sucessfully");
                }
            }
        }
    }


    function databaseDump($path = null, $skiptables = [])
    {

        $return = '';


        $connection = ConnectionManager::get('default');
        $db =  $connection->config();

        $databaseName = $db['database'];


        // Do a short header
        $return .= '-- Database: `' . $databaseName . '`' . "\n";
        $return .= '-- Generation time: ' . date('D jS M Y H:i:s') . "\n\n\n";


       

        $tables = array();
        $result = $connection
            ->execute('SHOW TABLES')
            ->fetchAll('assoc');
        //$result = $this->{$modelName}->query('SHOW TABLES');

        foreach ($result as $resultKey => $resultValue) {
            if(!in_array(current($resultValue),$skiptables))
                 $tables[] = current($resultValue);
        }
        

        // Run through all the tables
        foreach ($tables as $table) {
            $tableData = $connection
                ->execute('SELECT * FROM ' . $table)
                ->fetchAll('assoc');
            //$tableData = $this->{$modelName}->query('SELECT * FROM ' . $table);

            $return .= 'DROP TABLE IF EXISTS ' . $table . ';';
            $createTableResult = $connection
                ->execute('SHOW CREATE TABLE ' . $table)
                ->fetchAll('assoc');
            //$createTableResult = $this->{$modelName}->query('SHOW CREATE TABLE ' . $table);
            $createTableEntry = current($createTableResult);
            $return .= "\n\n" . $createTableEntry['Create Table'] . ";\n\n";
            if(strpos($createTableEntry['Create Table'],'AUTO_INCREMENT') !== false){
                $return .= "\n\n" . "ALTER TABLE $table AUTO_INCREMENT = 0" . ";\n\n";
            }
            // Output the table data
            /*  foreach($tableData as $tableDataIndex => $tableDataDetails) {
    
                $return .= 'INSERT INTO ' . $table . ' VALUES(';
                //pr($tableDataDetails); die();
                foreach($tableDataDetails as $dataKey => $dataValue) {
    
                    if(is_null($dataValue)){
                        $escapedDataValue = 'NULL';
                    }
                    else {
                        // Convert the encoding
                        $escapedDataValue = mb_convert_encoding( $dataValue, "UTF-8", "ISO-8859-1" );
    
                        // Escape any apostrophes using the datasource of the model.
                        $escapedDataValue = $connection->quote($escapedDataValue);
                    }
    
                    $tableDataDetails[$dataKey] = $escapedDataValue;
                }
                $return .= implode(',', $tableDataDetails);
    
                $return .= ");\n";
                
            } */

            $return .= "\n\n\n";
        }
        if (!$path) {
            // Set the default file name
            $fileName = $databaseName . '-backup-' . date('Y-m-d_H-i-s') . '.sql';

            // Serve the file as a download
            $this->autoRender = false;
            $this->response->type('Content-Type: text/x-sql');
            $this->response->download($fileName);
            $this->response->body($return);
        } else {
            file_put_contents($path, $return);
        }
    }
    /**
     * Delete method
     *
     * @param string|null $id Store id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */


    public function buildStore($data)
    {

        $resp = [];
        $domain = Configure::read('main_domain', "hishabnikash.com");
        $data['store_name'] = $data['store'];
        $data['store'] = strtolower($data['store']);

        if (isset($data['domain']))
            $domain = $data['domain'];

        $subdomain = "{$data['store']}.$domain";



       

        $csv = array_map('str_getcsv', file(SUBDOMAINS_PATH));
        foreach ($csv as $key => $row)
            if (empty($row[0])) unset($csv[$key]);

        $stores = array_combine(array_column($csv, 0), array_column($csv, 1));
        if (isset($stores[$subdomain])) {
            $resp['status'] = -1;
            $resp['message'] = "{$data['store']} already exists";
        } else {
            if (!file_exists(CONTENTS . DS . $data['store'])) mkdir(CONTENTS . DS . $data['store'], 0777, true);
            //if (!file_exists(THEMES)) mkdir(THEMES, 0777, true);
            
          //  if (!file_exists(WWW_ROOT . "uploads/{$data['store']}")) mkdir(WWW_ROOT . "uploads/{$data['store']}", 0777, true);
          /*  if (!file_exists(WWW_ROOT . "themes/{$data['store']}")) mkdir(WWW_ROOT . "themes/{$data['store']}", 0777, true);
            if (file_exists(WWW_ROOT . "themes/__default/"))
                $files = glob(WWW_ROOT . "themes/__default/*.zip");
            $themeName = "default";
            if (isset($files[0])) {
                $zip = new ZipArchive;
                $zip->open($files[0]);
                $zip->extractTo(WWW_ROOT . "themes/{$data['store']}");
                $zip->close();
                $themeName = basename($files[0], '.zip');
                //Log::write('debug', "themename base name is " .  $files[0]);
            }*/
            //Log::write('debug', "creating database " .  "{DB_PREFIX}_" . $data['store']);
            $themeName = '';
            $this->CreateDB(Configure::read('db_prefix', 'clcknshop')  . $data['store'], $data['email'], $data['password'], $themeName, $data['store_name']);
            $handle = fopen(SUBDOMAINS_PATH, "a");
            fputcsv($handle, [$subdomain, $data['store']]);
            fclose($handle);
            $resp['status'] = 0;
            $resp['domain'] = $subdomain;
            $resp['nonce'] = $this->generateNonce();
            $resp['message'] = __("Created successfully");
        }

        return $resp;
    }



    protected function generateNonce()
    {
        $expiryTime = microtime(true) + 300;
        $secret = Configure::read('app_token', "clcknshop");
        $signatureValue = hash_hmac('sha256', $expiryTime . ':' . $secret, $secret);
        $nonceValue = $expiryTime . ':' . $signatureValue;

        return base64_encode($nonceValue);
    }

    public function create()
    {
      
        $this->viewBuilder()->setLayout('login');

        $captcha_verify = (defined('RECAPTCHA_SITE_KEY'))?true:false;

        $this->set('captcha_verify', $captcha_verify);
        $this->set('captcha_site_key', (defined('RECAPTCHA_SITE_KEY'))?RECAPTCHA_SITE_KEY:'');
        
        $data = $this->request->getData();
        $Customers = TableRegistry::getTableLocator()->get('Customers');
        if ($this->request->is('post')) {
           
            //pr($data);
            if(isset($data['customer_id'])){
                $data = $this->request->data;
                $customer_id = $data['customer_id'];
                $Customers = TableRegistry::getTableLocator()->get('Customers');
                   
                $customer = $Customers->get($customer_id, [
                    'contain' => [],
                ]);
               
                $customer =  $Customers->patchEntity($customer,$data['store']);
                $Customers->save($customer);
               // pr($customer);
                $this->register_send_response(['status'=>0]);
                return;

            }  
      
            $captcha = null;

           

            if ($captcha_verify) {
                if (isset($data['g-recaptcha-response'])) {
                    $captcha = $data['g-recaptcha-response'];
                }
                if (!$captcha) {
                    $response = ['status' => -1, 'errors' => __('Invalid captcha.Please check "I am not a robot"')];
                    $this->register_send_response($response);
                    return;
                }
                $secretKey = (defined('RECAPTCHA_SECRET_KEY'))?RECAPTCHA_SECRET_KEY:'';
             
                // post request to server
                $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
                $response = file_get_contents($url);
                $responseKeys = json_decode($response, true);
                //pr($responseKeys);
                // should return JSON with success as true
                if ($responseKeys["success"]) {
                } else {
                    $response = ['status' => -1, 'errors' => __('Invalid captcha response,Please try again')];
                    $this->register_send_response($response);
                    return;
                }
            }

            $data['store_url'] = "hishabnikash.com";
            $store = $this->Stores->newEntity($data);
            $errors = $store->getErrors();
            if ($errors) {
                // Do work to show error messages.
                $response = ['status' => -1, 'errors' => $errors];
                $this->register_send_response($response);
                return;
            }



            $req = ['email' => $data['email'], 'password' => $data['password'], 'store' => $data['store_name']];
            $resp = $this->buildStore($req);
            // dd($resp);

            if ($resp['status'] != 0) {
                $response = ['status' => -1, 'errors' => $resp['message']];
                $this->register_send_response($response);
                return;
            } else {
                
                
                $customer = $Customers->newEntity(['first_name'=>'Unnamed','last_name'=>'unnamed','email'=>$data['email'],'phone'=>'0000000']);
                if($Customers->save($customer))
                    $data['customers_id'] = $customer->id;
                else{

                   // $errors = $customer->getErrors();
                   // pr($errors);

                }    
                $data['store_url'] =  $resp['domain'];               
                $store = $this->Stores->newEntity($data);

                if ($this->Stores->save($store)) {
                    $response = ['status' => 0];
                    
                    $response['store_url'] = '//' . $resp['domain'] . "/";
                    $response['site_token'] = md5(Configure::read('app_token',"clcknshop"));
                    $response['nonce'] = $resp['nonce'];
                    $response['username'] = $data['email'];
                    $response['customer_id'] = $data['customers_id'];
                    $response['auth_token'] = md5($data['email'] . ":" . md5($data['password']) . ":" . $resp['nonce']);
                    $store = json_decode(Configure::read('App.store'));
                    $protocol = $this->request->scheme() . '://';
                    $this->Mail->send($data['email'], __("Welcome to ") . $store->title, ['email' => $data['email'], 'password' => $data['password'], 'store_portal' => $protocol . $resp['domain']], "registration");

                    return $this->register_send_response($response);
                } else {
                    $response = ['status' => -1, 'errors' => $store->getErrors()];
                    return $this->register_send_response($response);
                }
            }
        }
    }

    function register_send_response($data)
    {
        if ($this->request->is('ajax')) {
            $this->set('data', $data);
            $this->set('_serialize', 'data');
            $this->RequestHandler->renderAs($this, 'json');
        } else {
            //$this->Flash->error($message);
        }
    }

    function rrmdir($dir) { 
        if (is_dir($dir)) { 
          $objects = scandir($dir);
          foreach ($objects as $object) { 
            if ($object != "." && $object != "..") { 
              if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
                $this->rrmdir($dir. DIRECTORY_SEPARATOR .$object);
              else
                unlink($dir. DIRECTORY_SEPARATOR .$object); 
            } 
          }
          rmdir($dir); 
        } 
   }

    private function delStore($store_name){
       

        $this->rrmdir(CONTENTS . DS . "$store_name");
        
        $db =  ConnectionManager::get('default');
        try{
        $db->execute ("DROP DATABASE  " . Configure::read("db_prefix",'clcknshop_') . $store_name);
        }
        catch(\Exception $ex){
         //  echo $ex->getMessage();
        }
           
        $this->updateCsv();
         
    }

    
    public function delete($id = null)
    {
         $this->request->allowMethod(['post', 'delete']);
       
        $store = $this->Stores->get($id);
        $storename = $store->store_name;

        if ( $this->Stores->delete($store)) {
            $this->delStore($storename);
            $this->Flash->success(__('The store has been deleted.'));
        } else {
            $this->Flash->error(__('The store could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

/* 
    public function addBalance()
    {

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $store = $this->Stores->find('all')->where(['id' => $data['id']])->first();

            if ($store) {
                $old_bal = (float) $store->sms_balance;
                $new_bal = $old_bal + (float) $data['amount'];
                $store->sms_balance =  $new_bal;
                if ($this->Stores->save($store)) {
                    $this->Flash->success(__("Store new Balance Added successfully"));

                    $SmsBalanceHistory = TableRegistry::getTableLocator()->get('SmsBalanceHistory');
                    $history = [
                        'stores_id'         => $store->id,
                        'balance_to_add'    => (float) $data['amount'],
                        'old_balance'       => $old_bal,
                        'new_balance'       => $new_bal,
                        'date_added'        => FrozenTime::now()
                    ];
                    $smsBalance = $SmsBalanceHistory->newEntity();
                    $smsBalance = $SmsBalanceHistory->patchEntity($smsBalance, $history);

                    if (!$SmsBalanceHistory->save($smsBalance)) {
                        $this->Flash->error(__("SMS Balance added successfully but record could not be saved"));
                    }
                } else {
                    $this->Flash->error(__('Ops! There was something wrong. please try again later'));
                }
            } else {
                $this->Flash->error(__('Store does not exist.'));
            }
        }

        return $this->redirect(['controller' => 'Stores', 'action' => 'index']);
    }

    public function smsHistory($id)
    {
        $History = TableRegistry::getTableLocator()->get('SmsBalanceHistory');
        $store = $this->Stores->get($id);

        $histories = $History->find('all')->where(['stores_id' => $id])->orderDesc('id');
        $histories = $this->paginate($histories);


        $this->set('histories', $histories);
        $this->set('store_name', $store->store_name);
    }

    public function transactionHistory()
    {
        $TransactionHistories = TableRegistry::getTableLocator()->get('TransactionHistory');
        $stores = $TransactionHistories->Stores->find('list', [
            'keyField' => 'id',
            'valueField' => 'store_name'
        ])->toArray();

        $histories = $TransactionHistories->find('all')->contain(['Stores'])->orderDesc('TransactionHistory.id');

        if ($this->request->is('ajax')) {
            $sid    = $this->request->getQuery('sid', 0);
            $range  = $this->request->getQuery('date_range', 0);


            if ($sid) {
                $histories = $histories->where(['stores_id' => $sid]);
            }

            if ($range) {
                $range = str_replace('.', '/', $range);
                $range = str_replace(' ', '', $range);
                $range = explode('-', $range);
                $histories = $histories->where(["DATE(trx_date) >= '$range[0]' AND DATE(trx_date) <= '$range[1]'"]);
            }
            $this->layout = "ajax";
            $this->set('histories', $this->paginate($histories));
            $this->render('trans_his_ajax');

            return;
        }

        $this->set('histories', $this->paginate($histories));
        $this->set('stores', $stores);
    }

    public function withdrawHistory()
    {
        $WithdrawHistory = TableRegistry::getTableLocator()->get('WithdrawHistory');
        $stores = $WithdrawHistory->Stores->find('list', [
            'keyField' => 'id',
            'valueField' => 'store_name'
        ])->toArray();

        $histories = $WithdrawHistory->find('all')->contain(['Stores'])->orderDesc('WithdrawHistory.id');

        if ($this->request->is('ajax')) {
            $sid    = $this->request->getQuery('sid', 0);
            $range  = $this->request->getQuery('date_range', 0);


            if ($sid) {
                $histories = $histories->where(['stores_id' => $sid]);
            }

            if ($range) {
                $range = str_replace('.', '/', $range);
                $range = str_replace(' ', '', $range);
                $range = explode('-', $range);
                $histories = $histories->where(["DATE(trx_date) >= '$range[0]' AND DATE(trx_date) <= '$range[1]'"]);
            }
            $this->layout = "ajax";
            $this->set('histories', $this->paginate($histories));
            $this->render('withdraw_his_ajax');
            return;
        }

        $this->set('histories', $this->paginate($histories));
        $this->set('stores', $stores);
    } */


}

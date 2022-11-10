<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Intervention\Image\ImageManagerStatic as Image;
use ZipArchive;
use Cake\Filesystem\Folder;


/**
 * Themes Controller
 *
 *
 * @method \App\Model\Entity\Theme[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ThemesController extends AppController
{
    protected $theme_name = null;
    protected $theme_dir = null;


  public function beforeFilter(\Cake\Event\Event $event)
    {
       
        $this->theme_name = Configure::read('App.theme');

        if ((empty($this->theme_name) || $this->theme_name === null) && $this->request->action != 'install'){
            //die($this->theme_name . 'dsf');
            $this->Flash->error(__('Please install a  theme first.'));
            return $this->redirect(['action' => 'install']);
        }

        $this->theme_dir = THEMES . $this->theme_name;
        parent::beforeFilter($event);
    }




    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $theme_details = array();
        $themes = array_slice(scandir(THEMES), 2);
        foreach ($themes as $theme){
            $file = THEMES.$theme.DS."theme.xml";
            if (file_exists($file)){
                $xml = simplexml_load_file($file);
                $xml->folder_name = $theme;
                $xml->thumbnail = (empty($xml->thumbnail))?'/img/missing_image.png':DS . THEMES.$theme.DS.$xml->thumbnail;
                $theme_details[] = $xml;
            }
        }
        
        $this->set('theme_name', $this->theme_name);
        $this->set(compact('theme_details'));
    }




    public function install(){
        $themes = [];
        $curl_handle=curl_init();
        curl_setopt($curl_handle,CURLOPT_URL,'https://'. Configure::read('main_domain') .'/themes.json');
        curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
        $data = curl_exec($curl_handle);
        //var_dump($data);
        curl_close($curl_handle);
        if ($data) $themes = json_decode($data, true);

        if ($this->request->is('post')){
            $data = $this->request->getData();
            //pr($data);
            
            $url  = $data['url'];
            $name = $data['name'];
            // die(THEMES. strtolower($name));
            if (file_exists(THEMES. strtolower($name))){
                $this->Flash->error(__("{0} theme Already Installed", [ucfirst($name)]));
                return $this->redirect(['controller' => 'themes', 'action' => 'index']);
            }

            $dst_filepath = THEMES . strtolower($name) . ".zip";
            
           

            if ($this->downloadFromUrl($url, $dst_filepath)){
                $zip = new ZipArchive;
                if($zip->open($dst_filepath) != "true"){
                    $this->Flash->error('Unable to open the Zip File');
                    unlink($dst_filepath);
                }else{
                    $zip->extractTo(THEMES . DS . strtolower($name));
                    $zip->close();
                    unlink($dst_filepath);
                    $this->setActiveTheme(strtolower($name));
                    $this->Flash->success(__("{0} theme installed successfully", [ucfirst($name)]));
                    return $this->redirect(['controller' => 'themes', 'action' => 'index']);
                }
            }
            $this->Flash->error(__("{0} theme doesn't Download. please try again", [ucfirst($name)]));
        }

        $this->set('themes', $themes);
    }


    public function assets(){
        $assets_file = THEMES . Configure::read('App.theme') . DS . 'assets.xml';
        if (file_exists($assets_file) === false) {
            $this->Flash->error(__('Assets.xml file not found in theme root directory'));
            return;
        }

        $assets_upload = THEMES. Configure::read('App.theme'). DS . 'assets' . DS;
        $assets_url = Router::url('/') . THEMES . "/" . Configure::read('App.theme') . "/assets/";
        if (file_exists($assets_upload. "uploads") === false) mkdir($assets_upload . "uploads", 0777, true);
        $assets = simplexml_load_file($assets_file);


        if ($this->request->is('post')){

            $data = $this->request->data();

            if ($data['type'] == 'image'){
                $ext = $this->extension($data['file']['name']);
                if ($this->isValidExt($ext) === false){
                    $this->Flash->error(__('Invalid file extension'));
                }
                else{
                    $width = empty($data['width']) === false ? $data['width'] : 300;
                    $height = empty($data['height']) === false ? $data['height'] : 300;

                    $filename = "uploads/" . $this->fileName($data['file']['name']) . "." . $ext;

                    $rawImage = Image::make($data['file']['tmp_name'])->resize($width, $height);
//                if (move_uploaded_file($data['file']['tmp_name'], $assets_upload . $filename)){
                    if ($rawImage->save($assets_upload . $filename)){
                        foreach ($assets->images->image as $image){
                            if ($image->key == $data['key']){
                                $image->file = $filename;
                            }
                        }
                        file_put_contents($assets_file, $assets->asXML());

                        $this->Flash->success(__('Image Uploaded successfully'));
                    }else{
                        $this->Flash->error(__('Image could not be upload!. please try again'));

                    }
                }
            }


            if ($data['type'] == 'menu'){
                if (strlen($data['items']) > 2){
                    foreach ($assets->menus->menu as $menu){
                        if ($data['key'] == $menu->key){
                            $menu->menujson = $data['items'];
                        }
                    }
                    file_put_contents($assets_file, $assets->asXML());
                    $this->Flash->success(__('Menu Item changes successfully'));
                }
            }

        }


        $this->set('assets', $assets);
        $this->set('assets_upload', $assets_upload);
        $this->set('assets_url', $assets_url);
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



    function downloadFromUrl($url, $dst_filepath){
        if (file_exists($dst_filepath)) unlink($dst_filepath);

        $zipResource = fopen($dst_filepath, "w");
        // Get The Zip File From Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FILE, $zipResource);

        $page = curl_exec($ch);
        curl_close($ch);

        if(!$page) return false;
        return true;
    }

    private function setActiveTheme($theme_name){
         
        $Settings = TableRegistry::getTableLocator()->get('Settings');
        return $Settings->updateSettings('theme',$theme_name);
        
    }


    public function activeTheme($theme_name = 'clcknshop')
    {
        if($this->request->is('post')) $theme_name = $this->request->getData('theme_name');
        if (empty(trim($theme_name))) {
            $this->Flash->error(__('Please select a valid theme from our collection.'));
            return $this->redirect(['action' => 'index']);
        }

        else if (!file_exists(THEMES . $theme_name)){
            $this->Flash->error(__("{0} theme doesn't exist. please choose valid theme.", [ucfirst($theme_name)]));
            return $this->redirect(['action' => 'index']);
        }

        //$Settings = TableRegistry::getTableLocator()->get('Settings');
        //$active = $Settings->query()->update()->set(['value' => $theme_name])->where(['name'=>'theme'])->execute();
        
        $active = $this->setActiveTheme($theme_name);

        if($this->request->is('ajax')){
            $response['status'] = $active ? 'success' : 'fail';
            $this->set(compact('response'));
            $this->set('_serialize', 'response');
            $this->RequestHandler->renderAs($this, 'json');
            return;
        }

        if ($active) $this->Flash->success(__("{0} theme is activated successfully", [ucfirst($theme_name)]));
        else $this->Flash->error(__("Ops! {0} theme is not activated. please try again.", [ucfirst($theme_name)]));

        return $this->redirect(['action' => 'index']);
    }



    public function editor()
    {

        $data = $this->files($this->theme_dir);
        $this->set('THEME_DIR', $this->theme_dir);
        $this->set('data',$data);
        $this->render('editor');
    }

    public function action(){
        if($this->request->is('post')){
            $data = $this->request->getData();

            if (isset($data['action']) && isset($data['path']) && !empty($data['path'])){
                $path = str_replace('/',DS,urldecode($data['path']));
                $image_supported_format = explode(',', IMAGE_SUPPORTED_FORMAT);

                $path_info = pathinfo($path);
                $file_extension = key_exists('extension',$path_info) ? $path_info['extension'] : '';
                if (isset($file_extension) && !empty($file_extension)){
                    $supported_format = explode(',', EDITABLE_FORMATS);
                    if (!in_array(strtolower($file_extension), $supported_format)){
                        $this->set('content', 'danger|INVALID EDITABLE FORMAT');
                        $this->layout="ajax";
                        $this->render('file_render');
                        return;
                    }
                }


                if (strpos($path, '../') === true || strpos($path, '..\'') == true){
                    die('INVALID_FILE_PATH');
                }

                switch ($data['action']){
                    case 'open':
                        if (in_array(strtolower($file_extension), $image_supported_format)){
                            $content = "success|File is selected successfully";
                        }else if(file_exists($this->theme_dir . $path)){
                            $content = file_get_contents($this->theme_dir.$path);
                        }
                        break;

                    case 'save':
                        if (file_exists($this->theme_dir.$path) && isset($data['data']) && !empty($data['data']) && is_writable($this->theme_dir.$path) && in_array(strtolower($file_extension), $image_supported_format) == false){
                            file_put_contents($this->theme_dir.$path, $this->filter($data['data']));
                            $content = "success|File saved successfully";

                        }else if (file_exists($this->theme_dir.$path)  && is_writable($this->theme_dir.$path) === false){
                            $content = 'danger|File is not writable';
                        }else{
                            $content = 'warning|File can not  be saved';
                        }
                        break;

                    case 'make-file':
                        if (file_exists($this->theme_dir.$path)){
                            $content = "danger|File already successfully";
                        }else{
                            file_put_contents($this->theme_dir.$path, $data['data']);
                            $content = "success|File created successfully";
                        }
                        break;

                    case 'make-dir':
                        $dir = $this->theme_dir . $path;

                        if (file_exists($dir) === false) {
                            mkdir($dir, 0777, true);
                            $content = 'success|Directory created successfully';
                        } else {
                            $content = 'warning|Directory already exists';
                        }
                        break;

                    case 'reload':
                        $content = $this->files($this->theme_dir);
                        break;

                    case 'delete':
                        if (file_exists($this->theme_dir . $data['path'])) {
                            $path = $this->theme_dir . $path;

                            if ($data['path'] == '/') {
                                $content =  'danger|Unable to delete main directory';
                            } else if (is_dir($path)) {
                                if (count(scandir($path)) !== 2) {
                                    $content = 'danger|Directory is not empty';
                                } else if (is_writable($path) === false) {
                                    $content = 'danger|Unable to delete directory';
                                } else {
                                    rmdir($path);
                                    $content = 'success|Directory deleted successfully';
                                }
                            } else {

                                if (is_writable($path)) {
//                                    unlink($path);
                                    $this->move_to($path);
                                    $content =  'success|File deleted successfully';
                                } else {
                                    $content =  'danger|Unable to delete file';
                                }
                            }
                        }
                        break;
                    case 'rename':
                        if (file_exists($this->theme_dir . $data['path']) && isset($data['data']) && !empty($data['data'])) {
                            $path = $this->theme_dir . $path;

                            $path_info = pathinfo($data['data']);
                            $file_extension = key_exists('extension',$path_info) ? $path_info['extension'] : '';
                            if (isset($file_extension) && !empty($file_extension)){
                                $supported_format = explode(',', EDITABLE_FORMATS);
                                if (!in_array(strtolower($file_extension), $supported_format)){

                                    $this->set('content', 'danger|INVALID EDITABLE FORMAT');
                                    $this->layout="ajax";
                                    $this->render('file_render');
                                    return;
                                }
                            }

                            $new_path = str_replace(basename($path), '', dirname($path)) . DS . $data['data'];

                            if ($data['path'] == '/') {
                                $content =  'danger|Unable to rename main directory';
                            }else if(file_exists($new_path)){
                                $content =  'danger|File name already exists';
                            }
                            else if (is_dir($path)) {
                                if (is_writable($path) === false) {
                                    $content =  'danger|Unable to rename directory';
                                } else {
                                    rename($path, $new_path);

                                    $content =  'success|Directory renamed successfully';
                                }
                            } else {
                                if (is_writable($path)) {
                                    rename($path, $new_path);

                                    $content = 'success|File renamed successfully';
                                } else {
                                    $content = 'danger|Unable to rename file';
                                }
                            }
                        }
                        break;

                }

            }
            $this->set('content', $content);
            $this->layout="ajax";
            $this->render('file_render');
        }
    }

    public function move_to($path)
    {
        $trash = $this->theme_dir. DS .".trash";
        if (!file_exists($trash)){
            mkdir($trash, 0777, true);
        }
        if (file_exists($path)){
            $new_file_name = Date("d-m-Y")."-".uniqid()."-".basename($path);
            rename($path, $trash. DS . $new_file_name);
        }
    }

    public function upload()
    {
        $this->autoRender = false;
        $data = $this->request->getData();

        if ($data['file']['error'] > 0){
            $this->Flash->error(__('There was something.'));
            return;
        }

        $path = str_replace('/',DS,urldecode($data['path']));
        $path = $this->theme_dir.$path.$data['file']['name'];

        $path_info = pathinfo($path);
        $file_extension = key_exists('extension',$path_info) ? $path_info['extension'] : '';


        if (isset($file_extension) && !empty($file_extension)){
            $supported_format = explode(',', EDITABLE_FORMATS);
            if (!in_array(strtolower($file_extension), $supported_format)){
                $this->Flash->error(__('Invalid file format.'));
                return $this->redirect(['action' => 'editor']);
            }
        }else{
            $this->Flash->error(__('Undetectable file format.'));
            return $this->redirect(['action' => 'editor']);
        }

        if (file_exists($path)){
            $this->Flash->error(__('File already exists.'));
            return $this->redirect(['action' => 'editor']);
        }else{
            if(move_uploaded_file($data['file']['tmp_name'], $path)){
                $this->Flash->error(__('File uploaded successfully.'));
                return $this->redirect(['action' => 'editor']);
            }else{
                $this->Flash->error(__('There was something wrong, file could not be upload'));
                return $this->redirect(['action' => 'editor']);
            }
        }
    }


    public function filter($source_code){
        return trim($source_code);
    }

    public function themeUpload(){
        $this->autoRender = false;
        if ($this->request->is('post')){
            $file = $this->request->getData('file');
            $errors = array();
            if (isset($file) && !empty($file)){
                $temp_dir = TMP.uniqid();

                if (!file_exists($temp_dir))mkdir($temp_dir, 0777, true);
                if ($this->extension($file['name']) == "zip"){
                    
                           

                    //$dst_path = trim($temp_dir.DS.$file['name']);
                        $zip = new ZipArchive;
                        $res = $zip->open($file['tmp_name']);
                        if ($res === TRUE) {
                            $extract = $zip->extractTo($temp_dir);
                            $zip->close();
                            //die($temp_dir);
                            if ($extract){
                                if(file_exists($temp_dir . DS . 'theme.xml'))
                                    $extract_path = $temp_dir;
                                else 
                                    $extract_path = $temp_dir . DS .substr($file['name'],0, -4);
                                //echo $extract_path;
                                if (!file_exists($extract_path . DS . 'assets')) $errors [] = __("Invalid Structure: assets folder not exists");
                                if (!file_exists($extract_path . DS . 'templates')) $errors [] = __("Invalid Structure: templates folder not exists");
                                if (!file_exists($extract_path . DS . 'theme.xml')) $errors [] = __("Invalid Structure: theme xml file not exists");

                                if (file_exists($extract_path . DS . 'theme.xml')){
                                    $xml = simplexml_load_file($extract_path . DS . 'theme.xml');
                                    $theme_xml = (array)$xml;
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

                                }


                                $res = $this->getDirContents($extract_path);
                                foreach ($res as $path){
                                    $errors = $this->validPath(str_replace($extract_path,"",$path),$errors);
                                }

                                if (count($errors) > 0){
                                    $this->request->session()->write('theme_errors', $errors);
                                    $this->rmdir($temp_dir);
                                    rmdir($temp_dir);
                                }else{
                                    $theme_folder = THEMES . DS . substr($file['name'],0, -4);
                                    $folder = new Folder($extract_path);
                                    $ret = $folder->copy($theme_folder);
                                    /*if(file_exists($theme_folder))
                                        $ret = @copy($extract_path,$theme_folder);
                                    else
                                        $ret = @rename($extract_path,$theme_folder);
                                    */
                                    $this->rmdir($temp_dir);
                                    rmdir($temp_dir);
                                    if($ret){
                                        $this->Flash->success(_("Theme is uploaded successfully."));
                                        return $this->redirect(['action' => 'index']);
                                    }else
                                        $this->Flash->error(__("Theme could not uploaded"));
                                    /*
                                    $res = $zip->open($dst_path);
                                    if ($res === TRUE) {
                                        $extract = $zip->extractTo(THEMES);
                                        $zip->close();
                                        if ($extract){
                                            $this->Flash->success(_("Theme is uploaded successfully."));
                                            $this->rmdir($temp_dir);
                                            rmdir($temp_dir);
                                        }
                                    }*/
                                }

                            }else{
                                $this->Flash->error(__("There was something wrong. File could not  be extract"));
                            }

                        } else {
                            $this->Flash->error(__("There was something wrong. File could not  be open"));
                        }
                    

                }else{
                    $this->Flash->error(_("Invalid file format. we only accept zip format"));
                }
            }else{
                $this->Flash->error(_("File could not be selected"));
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    public function getDirContents($dir, &$results = array()) {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                $this->getDirContents($path, $results);
//                $results[] = $path;
            }
        }
        return $results;
    }


    public function validPath($path, &$errors = array()){
        $p_info = pathinfo($path);

        if (isset($p_info['extension']) && !empty($p_info['extension'])){
            $supported_format = explode(',', EDITABLE_FORMATS);
            if (!in_array(strtolower($p_info['extension']), $supported_format)){
               $errors[] = "unsupported file format :".$path;
            }
        }else{
            $errors[] = "Unknown file format :".$path;
        }
        return $errors;
    }

    public  function rmdir($dir) {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                unlink($path);
            } else if ($value != "." && $value != "..") {
                $this->rmdir($path);
                rmdir($path);
            }
        }
    }


    function files($dir, $first = true)
    {
        $data = '';

        if ($first === true) {
            $data .= '<ul><li data-jstree=\'{ "opened" : true }\'><a href="javascript:void(0);" class="open-dir" data-dir="/">' . basename($dir) . '</a>';
        }

        $formats = explode(',', EDITABLE_FORMATS);
        $data .= '<ul class="files">';
        $files = array_slice(scandir($dir), 2);

        asort($files);

        foreach ($files as $key => $file) {
            if ((SHOW_PHP_SELF === false && $dir . DS . $file == __FILE__) || (SHOW_HIDDEN_FILES === false && substr($file, 0, 1) === '.')) {
                continue;
            }

            if (is_dir($dir . DS . $file)) {
                $dir_path = str_replace($this->theme_dir . DS, '', $dir . DS . $file);

                $data .= '<li class="dir"><a href="javascript:void(0);" class="open-dir" data-dir="/' . str_replace(DS,'/',$dir_path) . '/">' . $file . '</a>' . $this->files($dir . DS . $file, false) . '</li>';
            } else {
                $is_editable = strpos($file, '.') === false || in_array(substr($file, strrpos($file, '.') + 1), $formats);

                $data .= '<li class="file ' . ($is_editable ? 'editable' : null) . '" data-jstree=\'{ "icon" : "jstree-file" }\'>';

                if ($is_editable === true) {
                    $file_path = str_replace($this->theme_dir . DS, '', $dir . DS . $file);

                    $data .= '<a href="javascript:void(0);" class="open-file" data-file="/' . str_replace(DS, '/',$file_path) . '">';
                }

                $data .= $file;

                if ($is_editable) {
                    $data .= '</a>';
                }

                $data .= '</li>';
            }
        }

        $data .= '</ul>';

        if ($first === true) {
            $data .= '</li></ul>';
        }

        return $data;
    }



//    public function redirect($address = null)
//    {
//        if (empty($address)) {
//            $address = $_SERVER['PHP_SELF'];
//        }
//
//        header('Location: ' . $address);
//        exit;
//    }

    public function file_to_history($file)
    {
        if (is_numeric(MAX_HISTORY_FILES) && MAX_HISTORY_FILES > 0) {
            $file_dir = dirname($file);
            $file_name = basename($file);
            $file_history_dir = HISTORY_PATH . DS . str_replace($THEME_DIR, '', $file_dir);

            foreach ([HISTORY_PATH, $file_history_dir] as $dir) {
                if (file_exists($dir) === false || is_dir($dir) === false) {
                    mkdir($dir);
                }
            }

            $history_files = scandir($file_history_dir);

            foreach ($history_files as $key => $history_file) {
                if (in_array($history_file, ['.', '..', '.DS_Store'])) {
                    unset($history_files[$key]);
                }
            }

            $history_files = array_values($history_files);

            if (count($history_files) >= MAX_HISTORY_FILES) {
                foreach ($history_files as $key => $history_file) {
                    if ($key < 1) {
                        unlink($file_history_dir . DS . $history_file);
                        unset($history_files[$key]);
                    } else {
                        rename($file_history_dir . DS . $history_file, $file_history_dir . DS . $file_name . '.' . ($key - 1));
                    }
                }
            }

            copy($file, $file_history_dir . DS . $file_name . '.' . count($history_files));
        }
    }

}

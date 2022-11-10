<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use phpDocumentor\Reflection\Types\Parent_;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

       // For CakePHP before 3.1
    //public $theme = 'Divisma';
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
       
        $this->loadSettings();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Mail');
        $this->loadComponent('SMS');
        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    protected function loadSettings(){
      $SettingsTable = TableRegistry::getTableLocator()->get('Settings');
      $settings = $SettingsTable->find()->all();
      foreach($settings as $row){
          Configure::write("App." . $row->name,$row->value);
      }
      $store = json_decode(Configure::read("App.store","{}"),true);

      if(isset($store['title']))
         Configure::write("App.store_title" ,$store['title']);


    }

    public function beforeFilter(Event $event) {
      //  Parent_::beforeFilter();

      
     /* Configure::write('CakePdf', [
            'engine' => [
                'className' => 'CakePdf.WkHtmlToPdf',
                'binary' => '/usr/local/bin/wkhtmltopdf', //LINUX
            
            ]// 'CakePdf.DomPdf',
        //  'pageSize' => 'Letter',
        // 'download' => true
        ]); */

        if (!file_exists(THEMES)) mkdir(THEMES, 0777, true);
        if (!file_exists(UPLOAD)) mkdir(UPLOAD, 0777, true);

        if (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin'){
            $session = $this->request->session();
            $allow = ['Users@login','Stores@create', 'Users@autoLogin','Users@nonce', 'Users@buildStore','Users@delStore','Users@genCsv', 'Users@resetPassword'];
            $special_route =  ['Orders@invoice', 'Orders@packingSlip', 'Users@logout'];
            $current_controller_action = $this->request->controller."@".$this->request->action;
        

            if (in_array($current_controller_action, $special_route));
            else if($this->request->getSession()->read('user_logged_in')== true && $session->read('user_role') == 2)
                return $this->redirect('/pos');
                    
            else if ($this->request->getSession()->read('user_logged_in')==false && !in_array($current_controller_action,$allow)){
                //  $this->Flash->error('You must login first.');
                return $this->redirect(['controller'=> 'Users', 'action' => 'login']);
            }
            else if($this->request->getSession()->read('user_logged_in')==true && in_array($current_controller_action,$allow)){
                /*if($session->read('user_role') == 1)
                    return $this->redirect(['controller'=> 'Orders', 'action' => 'dashboard']);
                else */
                if($session->read('user_role') == 2)
                    return $this->redirect('/pos');
            }
        }

    }

}
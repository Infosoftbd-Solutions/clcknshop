<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Routing\Router;
use Facebook\Facebook;

/**
 * Facebook component
 */


class FbComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    protected $facebook = null;
    protected $login = null;
    protected $redirectUrl = null;


    public function __construct(ComponentRegistry $registry, array $config = [])
    {

        Configure::load('facebook');
        $this->facebook = new Facebook(Configure::read('app'));
//        $this->redirectUrl = Router::url('/admin/facebook/callback',true);
        $this->redirectUrl =  'https://'.getenv('HTTP_HOST').Router::url(['controller'=>'facebook', 'action' => 'callback']);
        $this->login = $this->facebook->getRedirectLoginHelper();
        if (isset($_GET['state'])) {
            $this->login->getPersistentDataHandler()->set('state', $_GET['state']);
        }

        parent::__construct($registry, $config);
    }
}

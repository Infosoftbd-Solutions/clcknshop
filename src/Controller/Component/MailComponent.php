<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Mailer\TransportFactory;
use Cake\ORM\TableRegistry;
use Cake\Cache\Cache;


/**
 * Facebook component
 */


class MailComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    protected $sender_name;
    protected $sender_email;
    protected $mail;
    public $useCache = true;

    public function __construct(ComponentRegistry $registry, array $config = [])
    {
        parent::__construct($registry, $config);
        $this->initConfig();
    }

    public function initConfig(){
        $this->mail = new Email();
        $mailLocalConfig = (array)Configure::read('mail');
        $this->sender_name = $mailLocalConfig['sender_name'];
        $this->sender_email = $mailLocalConfig['sender_email'];
      
        $mailConfig = json_decode(Configure::read('App.mail'),true);
       
        if (isset($mailConfig['sender_name']) && isset($mailConfig['sender_email'])){
            $this->sender_name = $mailConfig['sender_name'];
            $this->sender_email = $mailConfig['sender_email'];
        }
        $smtp =  isset($mailConfig['smtp']) ? $mailConfig['smtp'] :$mailLocalConfig['smtp'];
       // pr($mailConfig);
        TransportFactory::setConfig('smtp',$smtp);
        $this->useCache = Configure::read('mail.mail_queue', true);
    }




    public function send($to, $subject, $data=array(), $template = 'default')
    {
        $sender = [$this->sender_email => $this->sender_name];
        $store = json_decode(Configure::read('App.store'));
        if(!isset($data['store'])) $data['store']= $store;
        if($this->useCache){
          $this->mail->template($template);
          $view =   $this->mail->viewBuilder()->build($data);
          $view->setTemplatePath('Email' . DIRECTORY_SEPARATOR . "html");
          $view->setLayoutPath('Email' . DIRECTORY_SEPARATOR . "html");
          $body = $view->render();
          $jobs = Cache::read('jobs');
          $jobs[] = [
              'task' => 'mail',
              'data' => [ 'to' => $to, 'subject' => $subject,'message'=>$body,'sender'=>$sender,'smtp'=>TransportFactory::getConfig('smtp'),'attachments'=>isset($data['attachments'])?$data['attachments']:[]],
              'store_name' => STORENAME,
          ];
          Cache::write('jobs', $jobs);

        }else{
          //  $this->mail->domain('www.clcknshop.com');
          
            try {
               $email =  $this->mail->reset()
                    ->transport('smtp')
                    ->template($template)
                    ->emailFormat('html')
                    ->from($sender)
                    ->to($to)
                    ->subject($subject)
                    ->setViewVars($data);
              if(isset($data['attachments'])){
                  foreach($data['attachments'] as $attachement){
                    $email->attachments([
                    basename($attachement) => [
                        'file' => $attachement]
                    ]);

                  }

              }
                         
                    $email->send();
            }catch (\Exception $exception){
                
                return $exception->getMessage();
            }
            if(isset($data['attachments'])){
                foreach($data['attachments'] as $attachement){
                 @unlink($attachement);
                }
            } 

            
        }
        return true;
    }
}

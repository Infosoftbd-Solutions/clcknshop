<?php



use Cake\Cache\Engine\FileEngine;

use Cake\Database\Connection;

use Cake\Database\Driver\Mysql;

use Cake\Error\ExceptionRenderer;

use Cake\Log\Engine\FileLog;

use Cake\Mailer\Transport\MailTransport;




return [

 'site_password' => "asdf78kas3452kldjfkla142578",
 'main_domain' => ADMIN_DOMAIN,
 'db_prefix'=>BASE_DB_NAME . '_',
 'debug' => filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN),
 'app_token'=>md5('clcknshop'),

    'Error' => [

      'errorLevel' => E_ALL & ~E_USER_DEPRECATED & ~E_DEPRECATED,

    //  'exceptionRenderer' => ExceptionRenderer::class,

     // 'exceptionRenderer' => 'App\Error\MyExceptionRenderer',

      'skipLog' => [],

      'log' => true,

      'trace' => true,

    ],

  'mail'=>[

        'mail_queue' => false, 

        'sender_email' => 'clcknshop@mail.com',

        'sender_name' => 'Clcknshop',

        'smtp' => [

            'host' => 'smtp.gmail.com',

            'port' => 587,

            'username' => 'clcknshop@infosoftbd.com',

            'password' => 'C1Cknsh0P@2020',

            'className' => 'Smtp',

            'tls' => true

        ]

    ],



    'sms' => [

        'endpoint' => 'http://portal.metrotel.com.bd/smsapi',

        'data' => [

            "api_key" => "C200095660b4d17c52d4d8.97195620", 

            "type" => "text",   # text/unicode

            "senderid" => "8809612441571",

        ],

    ],



    'PaymentProcessor'=>[

        'Cod'=>['name'=>'Cash on delivery', 'className' => 'Cod', 'logo'=>'cod.jpg'],
        'Paypal'=>['name'=>'PayPal', 'className' => 'Paypal', 'logo'=>'paypal.jpg'],
        'Stripe'=>['name'=>'Stripe Payment', 'className' => 'Stripe' , 'logo'=>'stripe.jpg'],
        
       'Bkash'=>['name'=>'Bkash Payment', 'className' => 'Bkash', 'logo'=>'bkash.png'],

        'Rocket'=>['name'=>'Rocket Payment', 'className' => 'Rocket' , 'logo'=>'rocket.png'],

        'Nagad'=>['name'=>'Nagad Payment', 'className' => 'Nagad' , 'logo'=>'nagad.png'],
        

    ],

    'CakePdf'=> [
        'engine' => [
            'className' => 'CakePdf.WkHtmlToPdf',
            'binary' => '/usr/local/bin/wkhtmltopdf', //LINUX
         
        ]// 'CakePdf.DomPdf',
      //  'pageSize' => 'Letter',
       // 'download' => true
        ],

];



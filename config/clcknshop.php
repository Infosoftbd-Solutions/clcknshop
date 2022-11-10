<?php

define('ADMIN_DOMAIN','clckn.shop');
 

if(php_sapi_name() == 'cli' || $_SERVER['SERVER_NAME'] == ADMIN_DOMAIN)
	define('STORENAME', 'admin');
else
	require __DIR__ . '/domainconf.php';		

if(php_sapi_name() != 'cli' &&  $_SERVER['SERVER_NAME'] != ADMIN_DOMAIN){
	if(STORENAME == 'admin') die('only admin domain can use prefix admin');
}

		   	
	
 
define('BASE_DB_NAME','clcknshop');
define('DATABASE_URL', 'mysql://clcknshop:clcknshop@localhost/' . BASE_DB_NAME);
define('RECAPTCHA_SITE_KEY','6Lc5AvYhAAAAAAdBQ2bvhxX_o5gvRubf3ORc8xF8');
define('RECAPTCHA_SECRET_KEY','6Lc5AvYhAAAAALhMaOKlNEJ4b37Y2G8IlL8maDm9');


?>
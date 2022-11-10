<?php



$stores = array();
$paths = [SUBDOMAINS_PATH];
if(!defined('STORENAME')){

    foreach($paths as $path){
        if(file_exists($path)){
            $csv = array_map('str_getcsv', file( $path));
            foreach($csv as $key=>$row)
              if(empty($row[0])) unset($csv[$key]);
            $stores = array_merge(array_combine(array_column($csv, 0),array_column($csv, 1)),$stores); 
        }
    }
  
    if(php_sapi_name() != 'cli' &&  isset($stores[$_SERVER['SERVER_NAME']]))
        define('STORENAME', $stores[$_SERVER['SERVER_NAME']]);
    else
         die('Store not configured yet !!');  
    
}



?>


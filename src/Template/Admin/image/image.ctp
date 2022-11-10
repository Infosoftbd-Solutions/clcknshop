<?php

$options = ['path'=>true];
if(!empty($size)){
    $size = explode('x',$size);
    if(isset($size[0])){
        $options['width']= $size[0];
    }
    if(isset($size[1])){
        $options['height']= $size[1];
    }
}

echo $this->Media->image($path,$options);
?>
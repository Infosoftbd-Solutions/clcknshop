<?php


namespace App\View\Helper;


use Cake\View\Helper;

use Intervention\Image\ImageManagerStatic as Image;

class MediaHelper extends Helper
{
        public $helpers = array('Html','Url');

        public function productImage($image_name,$product_id, $options = [])
        {

            $path = PRODUCT_IMAGE_PATH.$product_id.DS.$image_name;

            return  $this->image($path,$options);
        }

        public function image($path, $options = []){
             $width = 0; $height = 0;



            if (count($options)){
                if(key_exists('width',$options)){
                    $width = $options['width'];
                    unset($options['width']);
                }
                if(key_exists('height',$options)){
                    $height = $options['height'];
                    unset($options['height']);
                }


            }

            if(!file_exists($path) || !is_file($path)){
                $missing_img = 'missing_image.png';
                if($width <= 100) $missing_img = 'missing_image_48x48.png';
              if(isset($options['path']))
                    return $this->Url->build("/img/{$missing_img}");
               return $this->Html->image($missing_img,$options);
            }
          //  /uploads/prodcts/1/image_name.png
            $image_path = $path;



            if($width > 0 || $height > 0){

                $pathinfo = pathinfo($path);
                $rpath = $pathinfo['dirname'] . DS . "resize";
                if(!file_exists($rpath)) mkdir($rpath,0777,true);

                $image_path = $rpath . DS . $pathinfo['filename'] .'-'. $width.'x'.$height.'.'.$pathinfo['extension'];

            }



            if(!file_exists($image_path)){
              try {
                $image = Image::make($path);
                if ($width != 0 && $height != 0)
                    $image->resize($width,$height)->save($image_path);

                if($width != 0 && $height ==0){
                    $image->resize($width, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($image_path);
                }

                if($width == 0 && $height !=0){
                    $image->resize(null, $height, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($image_path);
                }
              }catch(NotReadableException $e) {
                  return $this->Url->build("/img/missing_image.png");
                }

            }


            if(isset($options['path']) && $options['path'] == true)
                return $this->Url->build('/'.str_replace('\\','/',$image_path));

            return $this->Html->image('/'.str_replace('\\','/',$image_path),$options);
        }

        public function video($youtube_video_id, $width = '100%', $height = '100%' ){
            $code = '<iframe frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen';
            $code .= $width ? ' width="'.$width.'" ' : '';
            $code .= $height ? ' height="'.$height.'" ' : '';
            $code .= ' src="https://www.youtube.com/embed/'.$youtube_video_id;
            $code .= '"></iframe>';
            return $code;
        }



}

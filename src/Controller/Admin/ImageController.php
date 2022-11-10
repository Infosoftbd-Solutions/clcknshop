<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Image Controller
 *
 *
 * @method \App\Model\Entity\Image[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ImageController extends AppController
{
    public function productImage($product_id,$image_name,$size){
        //$this->redirect('/uploads/demo2/products/1/resize/apple-iphone-12-64gb-27-12-2020-1609051530246-42x42.jpg');

        $builder = $this->viewBuilder();

        // configure as needed
        $builder->autoLayout(false);
        $builder->template('Admin/Image/image');
        $builder->helpers(['Media']);
        $path = PRODUCT_IMAGE_PATH.$product_id.DS.$image_name;

        // create a view instance (set variables here which you want to access in view)
        $view = $builder->build(['path' => $path,'size'=>$size]);

        // render to a variable
        $url = $view->render();
        $this->redirect($url);

    }
}

<?php
namespace App\Error;

use Cake\Error\ExceptionRenderer;

class MyExceptionRenderer extends ExceptionRenderer
{
    public function missingController($error)
    {
        return $this->controller->redirect("/");
    }
}
?>

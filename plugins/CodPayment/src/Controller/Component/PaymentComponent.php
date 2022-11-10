<?php

namespace CodPayment\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;


/**
 * Facebook component
 */


class PaymentComponent extends Component
{
  public $processor;


  public function validateCheckout($request){
   // call validattion of checkout form and then call actual call of the payment
    return true;
  }



  public function afterCheckout($request,$order){
      // entry of the payment if necessary or redirect to merchant website
      //$controller = $this->_registry->getController();
      //$controller->redirect()

      return true;

  }

  public function configure($request){


  }



}

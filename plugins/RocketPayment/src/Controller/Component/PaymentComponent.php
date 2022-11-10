<?php

namespace RocketPayment\Controller\Component;

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
   // call validation of checkout form then call actual  payment
      $controller = $this->_registry->getController();

      if (empty($request->getData('rocket_transaction_number')) || empty($request->getData('rocket_number'))){
          $controller->Flash->error(__('Field must not be empty !'));
          return false;
      }


    return true;
  }



  public function afterCheckout($request, $order){
      // entry of the payment if necessary or redirect to merchant website
      $controller = $this->_registry->getController();
      //$controller->redirect()



      $Transactions = TableRegistry::getTableLocator()->get('Transactions');

      $data =[
        'order_id' => $order->order_id,
          'transaction_number' => $request->getData('rocket_transaction_number'),
        'payment_data' => json_encode(['rocket_number' => $request->getData('rocket_number'), 'transaction_number' => $request->getData('rocket_transaction_number') ])
      ];
      $transaction = $Transactions->newEntity();
      $transaction = $Transactions->patchEntity($transaction, $data);

      if (!$Transactions->save($transaction)){
          $controller->Flash->error(__('There was something wrong. payment info could not be recorded. please contact our support'));
          return false;
      }

      return true;

  }



  public function configure($request){


  }



}


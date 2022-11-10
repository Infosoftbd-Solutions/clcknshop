<?php
namespace SslCommerzPayment\Controller;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
class PaymentController extends AppController
{

    var $components = array('SMS');
    public function index(){

        die("testing plugin");
    }

    public function success(){
        
        
        //post data
        $data = $this->request->getData();
        $data['status'] = "approved";

        if (!$this->transaction($data)) {
            $this->Flash->error(__('There was something wrong. payment info could not be recorded. please contact our support'));
            return $this->redirect('/cart');
        }

        if (!$this->payment($data)) {
          $this->Flash->error(__('There was something wrong. payment amount could not be recorded. please contact our support'));
            return $this->redirect('/cart');
        }

        return $this->redirect('/cart');
    }



    public function fail(){
        $data = $this->request->getData();

        if (!$this->transaction($data, 0)) {
            $this->Flash->error(__('There was something wrong. payment info could not be recorded. please contact our support'));
            return $this->redirect('/cart');
        }

        $this->request->session()->delete('Flash');
        $this->Flash->error(__('Payment processing failed. please contact our support'));
        return $this->redirect('/cart');
    }



    public function cancel(){
        $data = $this->request->getData();

        if (!$this->transaction($data, 0)) {
          $this->Flash->error(__('There was something wrong. payment info could not be recorded. please contact our support'));
          return $this->redirect('/cart');
        }

      $this->Flash->error(__('Payment processing cancelled.');
      return $this->redirect('/cart');
    }
    
    public function ipn(){
        $Orders = TableRegistry::getTableLocator()->get('Orders');
        $data = $this->request->getData();

        if ($data['status'] == 'valid') {
            //SEND SMS.
            $sms_notification = json_decode(Configure::read('App.sms_notification'));
            if(isset($sms_notification->payment_received_from_store_cus_notify) &&
                $sms_notification->payment_received_from_store_cus_notify == "on" &&
                empty($data['cus_phone']) == false){
                    $sms = "We Received your payment %amount% . Thank you. %store_name%";
                    $sms = $this->contentProcess($sms, ['amount' => $data['total_amount']]);
                    $sms_res = $this->SMS->send($data['cus_phone'], $sms);   
            }

                // sned mail
                $mail = json_decode(Configure::read('App.mail_notification'));

                if(isset($mail->payment_received_from_store_cus_notify) && 
                        $mail->payment_received_from_store_cus_notify == "on" &&
                        isset($data['cus_email']) ){
                            $order_total = Configure::read('App.currency') . (string) $data['total_amount'];
                            $store = Configure::read('App.store');
                            $mail_res = $this->Mail->send($data['cus_email'], "Payment Received {$order_total}", ['customer_name' => $data['cus_name'], 'total_amout' => $data['total_amount'],'store' => $store], 'payment_received');
                }


            $data['status'] = "approved";
            if (!$this->transaction($data)) {
               $Orders->addOrderLog($data['value_a'], [
                  'status' => 0,
                  'by' => "System",
                  'notes' => __("Payment Success but transaction could not be recorded"),
               ]);
            }

            if (!$this->payment($data)) {
              $Orders->addOrderLog($data['value_a'], [
                  'status' => 0,
                  'by' => "System",
                  'notes' => __("Payment Success but payment could not be recorded"),
               ]);
            }
        }else{
            if (!$this->transaction($data, 0)) {
              $Orders->addOrderLog($data['value_a'], [
                  'status' => 0,
                  'by' => "System",
                  'notes' => __("Payment failed but transaction could not be recorded"),
               ]);
            }
        }


        //Log::write('debug', $data);

    }

    private function contentProcess($content, $data = array()){
        $amount = array_key_exists("amount", $data) ? $data['amount'] : 0;
        $amount = Configure::read('App.currency') . (string) number_format($amount, 2);
      
        $keywords = [
            '%order_id%'    => array_key_exists("order_id", $data) ? $data['order_id'] : 0000,
            '%store_name%'  => Configure::read('App.store_title'),
            '%amount%'      => $amount
        ];
       
        
        foreach ($keywords as $key => $value) {
            $content = str_replace($key, $value, $content);
        }

        return $content;
    }



    private function transaction($data, $status = 1){
          $Transactions = TableRegistry::getTableLocator()->get('Transactions');
       
          $insertData =[
              'order_id' => $data['value_a'],
              'transaction_number' => $data['tran_id'],
              'payment_processor_id' => $data['value_b'],
              'payment_data' => json_encode($data),
              'status' => $status
          ];



          $transaction = $Transactions->find('all')->where(['order_id' => $data['value_a'], 'transaction_number' => $data['tran_id']])->first();

          if (!$transaction) {
              $transaction = $Transactions->newEntity();
          }
          
          $transaction = $Transactions->patchEntity($transaction, $insertData);

          return $Transactions->save($transaction) ? true : false;
    }


    private function payment($data){
        $OrderPayments = TableRegistry::getTableLocator()->get('OrderPayments');
        $PaymentProcessor = TableRegistry::getTableLocator()->get('PaymentProcessor');

        $paymentProcessor = $PaymentProcessor->find('all')->where(['id' => $data['value_b']])->first();

        $paymentData = [
            'orders_id' => $data['value_a'],
            'amount' => $data['amount'],
            'payment_date' => date('Y-m-d h:i:s'),
            'payment_method'  => $paymentProcessor->payment_method_id,

        ];
        

        $orderPayment = $OrderPayments->find('all')->where(['orders_id' => $data['value_a'], 'payment_method' => $paymentProcessor->payment_method_id])->first();
        if (!$orderPayment) {
          $orderPayment = $OrderPayments->newEntity();
        }
        
        $orderPayment = $OrderPayments->patchEntity($orderPayment, $paymentData);

        return $OrderPayments->save($orderPayment) ? true : false;
    }



}


?>

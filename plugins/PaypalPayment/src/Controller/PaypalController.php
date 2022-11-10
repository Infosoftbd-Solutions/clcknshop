<?php
namespace PaypalPayment\Controller;

use PaypalPayment\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Core\Configure;
/**
 * Paypal Controller
 *
 *
 * @method \PaypalPayment\Model\Entity\Paypal[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaypalController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function pay($order_id)
    {
        $PaymentProcessors = TableRegistry::getTableLocator()->get('PaymentProcessor');
        $processor = $PaymentProcessors->find()
        ->select(['options'])
        ->where(['class ' => 'Paypal'])->first();
        $options = json_decode($processor->options);
        //pr($options);
        $this->set('options',$options);
        $Orders = TableRegistry::getTableLocator()->get('Orders');
        $order = $Orders->get($order_id);
        $this->set('order',$order);

    }

    public function notify($order_id)
    {
        if ($this->request->is('post')){
            $PaymentProcessors = TableRegistry::getTableLocator()->get('PaymentProcessor');
            $processor = $PaymentProcessors->find()
            ->where(['class ' => 'Paypal'])->first();
            $options = json_decode($processor->options);

            

            $data = $this->request->data;
            $paydata = [
                'item_name' => $data['item_name'],
                'item_number' => $data['item_number'],
                'payment_status' => $data['payment_status'],
                'payment_amount' => $data['mc_gross'],
                'payment_currency' => $data['mc_currency'],
                'txn_id' => $data['txn_id'],
                'receiver_email' => $data['receiver_email'],
                'payer_email' => $data['payer_email'],
                'custom' => $data['custom'],
            ];
            
            $Orders = TableRegistry::getTableLocator()->get('Orders');
            $order = $Orders->get($order_id);

            $status = $this->verifyTransaction($options->sandbox);

            $Transactions = TableRegistry::getTableLocator()->get('Transactions');

            $tdata =[
              'order_id' => $order->order_id,
              'transaction_number' =>$data['txn_id'],
              'amount'=>$data['mc_gross'],
              'payment_data' => json_encode($paydata),
              'status'=>$status,
              'payment_processor_id'=>$processor->id,
            ];
            if($Transactions->add($tdata) == false)
                return;

            if(!$status) return;

            $OrderPayments = TableRegistry::getTableLocator()->get('OrderPayments');
            $data = [
              'orders_id'       => $order->order_id,
              'amount'          => $data['mc_gross'],
              'payment_method'  => $processor->payment_method_id
            ];

            $OrderPayments->payment($data, __("Paid  by paypal ")  . $data['mc_currency'] . ' ' .  $data['mc_gross'] ); 
           

        }
    }

    public function cancel($order_id)
    {
        $this->Flash->error(__('We are sorry. Your payment could not process.'));
        return $this->redirect(['plugin' => null,'controller' => 'checkout', 'action' => 'index']);
    }

    public function return($order_id)
    {
        $Orders = TableRegistry::getTableLocator()->get('Orders');
        $order = $Orders->get($order_id);
        return $this->redirect(['plugin' => null,'controller' => 'checkout', 'action' => 'thankYou', $order->order_id ]);
    }


    function verifyTransaction($sandbox = 1) {

        
        $paypalUrl = ($sandbox == 1)? 'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr' : 'https://ipnpb.paypal.com/cgi-bin/webscr';

        $req = 'cmd=_notify-validate';
        if (function_exists('get_magic_quotes_gpc')) {

          $get_magic_quotes_exists = true;

        }


        $raw_post_data = file_get_contents('php://input');

        $raw_post_array = explode('&', $raw_post_data);

        $data = array();

        foreach ($raw_post_array as $keyval) {

          $keyval = explode ('=', $keyval);

          if (count($keyval) == 2)

            $data[$keyval[0]] = urldecode($keyval[1]);

        }

        foreach ($data as $key => $value) {

          if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {

            $value = urlencode(stripslashes($value));

          } else {

            $value = urlencode($value);

          }

          $req .= "&$key=$value";

        }

       // Log::write('debug', $paypalUrl);
        //Log::write('debug', $req);

        $ch = curl_init($paypalUrl);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        $res = curl_exec($ch);
       // Log::write('debug', $res);
        if (!$res) {
            $errno = curl_errno($ch);
            $errstr = curl_error($ch);
            curl_close($ch);
            throw new Exception("cURL error: [$errno] $errstr");
        }

        $info = curl_getinfo($ch);

        // Check the http response
        $httpCode = $info['http_code'];
        if ($httpCode != 200) {
            throw new Exception("PayPal responded with http code $httpCode");
        }
        curl_close($ch);

        return $res === 'VERIFIED';
    }
    
    


}

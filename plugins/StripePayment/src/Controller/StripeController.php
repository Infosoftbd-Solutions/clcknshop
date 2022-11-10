<?php
namespace StripePayment\Controller;

use PaypalPayment\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Core\Configure;
use Stripe\Customer;
use Stripe\PaymentIntent;

// Stripe API configuration  
define('STRIPE_API_KEY', 'sk_test_nQz8SVUtXB86UvU5xofPD9Rj'); 
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_wm51P01rw8PYTJ8Pjwa3kLwk'); 
define('CURRENCY','USD');

/**
 * Paypal Controller
 *
 *
 * @method \PaypalPayment\Model\Entity\Paypal[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StripeController extends AppController
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
        ->where(['class ' => 'Stripe'])->first();
        $options = json_decode($processor->options);
        //pr($options);
        $this->set('options',$options);
        $Orders = TableRegistry::getTableLocator()->get('Orders');
        $order = $Orders->get($order_id);
        $this->set('order',$order);

    }

    public function intent($order_id){

        $PaymentProcessors = TableRegistry::getTableLocator()->get('PaymentProcessor');
        $processor = $PaymentProcessors->find()
        ->where(['class ' => 'Stripe'])->first();

        // Log::write('debug', $processor);

        $options = json_decode($processor->options);

        $Orders = TableRegistry::getTableLocator()->get('Orders');
        $order = $Orders->get($order_id);

        // Log::write('debug', $order); 

        \Stripe\Stripe::setApiKey($options->api_key); 
        // Retrieve JSON from POST body 
        $jsonStr = file_get_contents('php://input'); 
        $jsonObj = json_decode($jsonStr); 
        $this->autoRender = false;
        $this->response->type('Content-Type: application/json');
        if($jsonObj->request_type == 'create_payment_intent'){ 
             $itemPrice = $order->order_total;
             $itemName = 'order';
            // Define item price and convert to cents 
            $itemPriceCents = round($itemPrice*100); 
             
            // Set content type to JSON 
           // header('Content-Type: application/json'); 
             
            try { 
                // Create PaymentIntent with amount and currency 
                $paymentIntent = \Stripe\PaymentIntent::create([ 
                    'amount' => $itemPriceCents, 
                    'currency' => $options->currency, 
                    'description' => $itemName, 
                    'payment_method_types' => [ 
                        'card' 
                    ] 
                ]); 
             
                $output = [ 
                    'id' => $paymentIntent->id, 
                    'clientSecret' => $paymentIntent->client_secret 
                ]; 
             
                 $this->response->body(json_encode($output)); 
            } catch (Error $e) { 
                http_response_code(500); 
                 $this->response->body(json_encode(['error' => $e->getMessage()])); 
            } 
        }elseif($jsonObj->request_type == 'create_customer'){ 
            $payment_intent_id = !empty($jsonObj->payment_intent_id)?$jsonObj->payment_intent_id:''; 
            $name = !empty($jsonObj->name)?$jsonObj->name:''; 
            $email = !empty($jsonObj->email)?$jsonObj->email:''; 
             
            // Add customer to stripe 
            try {   
                $customer = \Stripe\Customer::create(array(  
                    'name' => $name,  
                    'email' => $email 
                ));  
            }catch(Exception $e) {   
                $api_error = $e->getMessage();   
            } 
             
            if(empty($api_error) && $customer){ 
                try { 
                    // Update PaymentIntent with the customer ID 
                    $paymentIntent = \Stripe\PaymentIntent::update($payment_intent_id, [ 
                        'customer' => $customer->id 
                    ]); 
                } catch (Exception $e) {  
                    // log or do what you want 
                } 
                 
                $output = [ 
                    'id' => $payment_intent_id, 
                    'customer_id' => $customer->id 
                ]; 
                $this->response->body(json_encode($output)); 
            }else{ 
                http_response_code(500); 
                $this->response->body(json_encode(['error' => $api_error])); 
            } 
        }elseif($jsonObj->request_type == 'payment_insert'){ 
            $payment_intent = !empty($jsonObj->payment_intent)?$jsonObj->payment_intent:''; 
            $customer_id = !empty($jsonObj->customer_id)?$jsonObj->customer_id:''; 
             
            // Retrieve customer info 
            try {   
                $customer = \Stripe\Customer::retrieve($customer_id);  
            }catch(Exception $e) {   
                $api_error = $e->getMessage();   
            }

            // Log::write('debug', $payment_intent); 
            // Check whether the charge was successful 
            if(!empty($payment_intent) && $payment_intent->status == 'succeeded'){
                

                $paydata = [
                    'txn_id'                => $payment_intent->id,
                    'amount'                => round($payment_intent->amount/100),
                    'capture_method'        => $payment_intent->capture_method,
                    'confirmation_method'   => $payment_intent->confirmation_method,
                    'created'               => $payment_intent->created,
                    'currency'              => $payment_intent->currency,
                    'description'           => $payment_intent->description,
                    'payment_method_types'  => $payment_intent->payment_method_types[0],
                    'status'                => $payment_intent->status
                ];

                

                
                $Transactions = TableRegistry::getTableLocator()->get('Transactions');
                $OrderPayments = TableRegistry::getTableLocator()->get('OrderPayments');
              
                $tdata =[
                    'order_id' => $order->order_id,
                    'payment_processor_id'=>$processor->id,
                    'transaction_number' =>$paydata['txn_id'],
                    'payment_data' => json_encode($paydata),
                    'amount'=>$paydata['amount'],
                    'status'=> 1
                ];

                // Log::write('debug', $tdata);
                

                if($Transactions->add($tdata) == false) return;

                $data = [
                    'orders_id'       => $order_id,
                    'amount'          => $paydata['amount'],
                    'payment_method'  => $processor->payment_method_id
                  ];

                $notes = Configure::read('App.currency') . " ". $paydata['amount'] ." paid by " . $processor->name;
                $OrderPayments->payment($data, $notes);


                $output = [  'payment_id' => base64_encode($payment_intent->id) ]; 

                $this->response->body(json_encode($output)); 
            }else{ 
                http_response_code(500); 
                $this->response->body(['error' => 'Transaction has been failed!']); 
            }
        }     
    }



}

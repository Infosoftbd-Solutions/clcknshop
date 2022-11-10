<?php

namespace SslCommerzPayment\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use SslCommerzPayment\Utility\SSLCommerz\SslCommerzNotification;


/**
 * Facebook component
 */


class PaymentComponent extends Component
{
  public $processor;

  
  public function validateCheckout($request){
   // call validation of checkout form then call actual  payment
    //  $controller = $this->_registry->getController();




    return true;
  }



  public function afterCheckout($request, $order){
      $shipping = json_decode($order->shipping_address);

      // entry of the payment if necessary or redirect to merchant website
      $controller = $this->_registry->getController();
      //$controller->redirect()

      $post_data = array();
      $post_data['total_amount'] = $order->order_total; # You cant not pay less than 10
      $post_data['currency'] = "BDT";
      $post_data['tran_id'] = uniqid(); // tran_id must be unique

      //$server_name = Router::fullBaseUrl(); // Change this part according to your project directory

      # CUSTOMER INFORMATION
      $post_data['cus_name'] = $order->customer->first_name . " " . $order->customer->last_name;
      $post_data['cus_email'] = $order->customer->email;
      $post_data['cus_add1'] = $order->customer->address;
      $post_data['cus_add2'] = $order->customer->area;
      $post_data['cus_city'] = $order->customer->city;
      $post_data['cus_state'] = $order->customer->city;
      $post_data['cus_postcode'] = $order->customer->post_code;
      $post_data['cus_country'] = $order->customer->country;
      $post_data['cus_phone'] = $order->customer->phone;
      $post_data['cus_fax'] = "";

      # SHIPMENT INFORMATION
      $post_data['ship_name'] = $shipping->first_name . " " . $shipping->last_name;
      $post_data['ship_add1'] = $shipping->address;
      $post_data['ship_add2'] = $shipping->area;
      $post_data['ship_city'] = $shipping->city;
      $post_data['ship_state'] = $shipping->city;
      $post_data['ship_postcode'] = $shipping->post_code;
      $post_data['ship_phone'] = $shipping->phone;
      $post_data['ship_country'] = $shipping->country;
      $post_data['shipping_method'] = $order->shipping_methods_id;
      $post_data['product_name'] = "Various Product";
      $post_data['product_category'] = "various";
      $post_data['product_profile'] = "physical";

      # OPTIONAL PARAMETERS
      $post_data['value_a'] = $order->order_id; //order id
      $post_data['value_b'] = $order->payment_processor_id;
      // $post_data['value_c'] = "ref003";
      // $post_data['value_d'] = "ref004";


      # Upate query start
      # Before  going to initiate the payment order status need to update as Pending and currency=$post_data['currency']. In where clause order_id=$post_data['tran_id']
      # Update query end

      # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
      $sslcz = new SslCommerzNotification();
      $payment_options = $sslcz->makePayment($post_data, 'hosted');

      if (!is_array($payment_options)) {
          print_r($payment_options);
          $payment_options = array();
      }




      return false;

  }



  public function configure($request){
    


  }



}

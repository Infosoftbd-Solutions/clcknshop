<?php
namespace App\Controller\Component;
use Cake\Core\Configure;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
/**
 * SMS component
 */
class SMSComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


    public function send($contact, $message)
    {

        if(empty($contact) || empty($message))
            return false;

           $url = Configure::read('sms_api_endpoint');

            $data = [
                'store_name' => STORENAME,
                'phone' => $this->filterPhone($contact),
                'message' => $message,
                'type'     => $this->type($message),
                'total_sms' => $this->smsCount($message)
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response, true);
            $response['data']['sent_time'] = FrozenTime::now();


            //Save response info sms histories
            $SmsHistories = TableRegistry::getTableLocator()->get('SmsHistories');
            $smsHistory = $SmsHistories->newEntity();
            $smsHistory = $SmsHistories->patchEntity($smsHistory, $response['data']);
            if (!$SmsHistories->save($smsHistory)) {
                pr($smsHistory->errors());
                die();
            }



            return $response['status'] == "success" ? true : false;



        /*
            $smsConfig = (array)Configure::read('sms');
            $url                = $smsConfig['endpoint'];
            $data               = $smsConfig['data'];
            $data['contacts']   = $this->filterPhone($contact);
            $data['msg']        = $message;
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);

            #SMS SUBMITTED: ID - C200095660d1bb66ae6ed



            $submitted_id_array = explode("-", $response);
            $smsData = [
                'submitted_id' => count($submitted_id_array) > 1 ? trim($submitted_id_array[1]) : 0,
                'mobile' => $contact,
                'message' => $message,
                'sent_time' => FrozenTime::now(),
                'status' => 0
            ];
            $smsHistory = $SmsHistories->newEntity();
            $smsHistory = $SmsHistories->patchEntity($smsHistory, $smsData);
            if (!$SmsHistories->save($smsHistory)) {
                $this->Flash->error(__('SMS Data could not be recorded.'));
            }
*/





    }

    private function type($string){
        return (strlen($string) != strlen(utf8_decode(($string)))) ? "unicode" : "text";
    }

    private function smsCount($string){
        $len = strlen($string);
        $per_sms = 160;

        if ($len != strlen(utf8_decode($string)) && $len <= 70 ){
            $per_sms = 70;
        }
        else if($len != strlen(utf8_decode($string)) && $len > 70 ){
            $per_sms = 67;
        }
        else if($len > 160){
            $per_sms = 153;
        }
        else{
            $per_sms = 160;
        }

        return ceil( $len / $per_sms);
    }

    private function filterPhone($number){
        $number = preg_replace('/[^0-9]/', '', $number);
        $first_three_char = substr($number, 0, 3);

        $formats = ['880', '+88'];
        if(in_array($first_three_char, $formats) == false)
            return substr($number,0, 1) == 0 ? '+88' . $number : '+880' . $number;
        
        return $number;
    }

}

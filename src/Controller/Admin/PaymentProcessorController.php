<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

/**
 * PaymentProcessor Controller
 *
 * @property \App\Model\Table\PaymentProcessorTable $PaymentProcessor
 *
 * @method \App\Model\Entity\PaymentProcessor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaymentProcessorController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $PaymentMethods = TableRegistry::getTableLocator()->get('PaymentMethods');

        $paymentProcessor = $this->PaymentProcessor->find('all')->contain(['PaymentMethods'])->orderAsc('PaymentProcessor.id');
        $paymentProcessor = $this->paginate($paymentProcessor);

        $processor =    Configure::read('PaymentProcessor');
        $paymentMethods = $PaymentMethods->find('all')->all();
        $this->set(compact('paymentProcessor', 'paymentMethods', 'processor'));
    }

    /**
     * View method
     *
     * @param string|null $id Payment Processor id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paymentProcessor = $this->PaymentProcessor->get($id, [
            'contain' => ['PaymentMethods'],
        ]);

        $this->set('paymentProcessor', $paymentProcessor);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $processor = json_decode($data['processor'], true);
            $method = $data['method'];
            $status = $data['status'];


            $data = [
                'payment_method_id' => $method,
                'class' => ucfirst($processor['className']),
                'name' => $processor['name'],
                'image' => $processor['logo'],
                'status' => $status
            ];


            $paymentProcessor = $this->PaymentProcessor->find('all')->where(['class' => ucfirst($processor['className'])])->first();
            if (!$paymentProcessor){
                $paymentProcessor = $this->PaymentProcessor->newEntity();
            }

            $paymentProcessor = $this->PaymentProcessor->patchEntity($paymentProcessor, $data);
            if ($this->PaymentProcessor->save($paymentProcessor)) {
                $this->Flash->success(__('The payment processor has been saved.'));
            }else{
                $this->Flash->error(__('The payment processor could not be saved. Please, try again.'));
            }
        }

        return  $this->redirect(['controller' => 'PaymentProcessor', 'action' => 'index']);
    }

    public function configure($id = null){
        if ($this->request->is('post')){
            $data = $this->request->getData();
          //  pr($data);
          //  die();
            $query = $this->PaymentProcessor->query();
            $result = $query->update()
                    ->set(['options' => json_encode($data)])
                    ->where(['id' => $id])
                    ->execute();
            return  $this->redirect(['action' => 'index']);        
        }    

    }

    /**
     * Edit method
     *
     * @param string|null $id Payment Processor id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        if ($this->request->is('post')){
            $data = $this->request->getData();


            if (isset($data['className'])){
                $processor = $this->PaymentProcessor->find('all')->where(['class'  => $data['className']])->first();
                if ($processor){
                    if (isset($data['instruction_image']['tmp_name']) && empty($data['instruction_image']['tmp_name']) == false){
                        $ext = $this->extension($data['instruction_image']['name']);
                        if ($this->isValidExt($ext) === false){
                            $this->Flash->error(__('Invalid file extension'));
                            return;
                        }

                        $filename = $this->fileName($data['instruction_image']['name']) . "." . $ext;
                        $instruction_image = UPLOAD . "instruction_images/";

                        if (!file_exists($instruction_image)){
                            mkdir($instruction_image, 0777, true);
                        }

                        if (empty($processor->instruction_image) == false){
                            if (file_exists($instruction_image . $processor->instruction_image)){
                                unlink($instruction_image .  $processor->instruction_image);
                            }
                        }


                        if (move_uploaded_file($data['instruction_image']['tmp_name'], $instruction_image . $filename)){
                            $processor->instruction_image = $filename;
                        }
                        else{
                            $this->Flash->error(__('Instruction Image Could not be uploaded'));
                            return;
                        }

                    }

                    $processor->options = json_encode($data['options']);
                    if ($this->PaymentProcessor->save($processor)){
                        $this->Flash->success(__('Configuration Changes Successfully'));
                    }
                    else{
                        $this->Flash->error(__('Configuration Could not be Saved'));
                    }
                }
                return  $this->redirect(['action' => 'index']);
            }
        }


        if ($this->request->is('ajax') && $this->request->is('get')) {
            $id = $_GET['pk'];
            $status = $_GET['value'];
            $paymentProcessor = $this->PaymentProcessor->get($id, [
                'contain' => [],
            ]);
            $paymentProcessor->status = $status;
            if ($this->PaymentProcessor->save($paymentProcessor)) {
                $response =[
                    'status' => 'success',
                    'data' => $status
                ];
            }else{
                $response =[
                    'status' => 'error',
                    'data' => $paymentProcessor->errors()
                ];
            }

            $this->set(compact('response'));
            $this->set('_serialize', 'response');
            $this->RequestHandler->renderAs($this, 'json');
            return;
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment Processor id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paymentProcessor = $this->PaymentProcessor->get($id);
        if ($this->PaymentProcessor->delete($paymentProcessor)) {
            $this->Flash->success(__('The payment processor has been deleted.'));
        } else {
            $this->Flash->error(__('The payment processor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    private function extension($path){
        return strtolower(pathinfo($path, PATHINFO_EXTENSION));
    }

    private function isValidExt($ext){
        $supported_extension = ['jpg', 'jpeg', 'png', 'gif'];
        return in_array($ext, $supported_extension);
    }


    private function clean($string) {
        $string = str_replace(' ', '-', $string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

    private function fileName($str = null){
        $str = $this->clean(strtolower($str));
        $milliseconds = round(microtime(true) * 1000);
        $now = date('d-m-Y')."-".$milliseconds;
        return substr($str,0,20)."-".$now;
    }

}

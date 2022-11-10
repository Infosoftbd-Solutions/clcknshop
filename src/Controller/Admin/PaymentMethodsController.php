<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * PaymentMethods Controller
 *
 * @property \App\Model\Table\PaymentMethodsTable $PaymentMethods
 *
 * @method \App\Model\Entity\PaymentMethod[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaymentMethodsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $paymentMethods = $this->PaymentMethods->find('all')->where(['is_deleted' => 0]);
        $paymentMethods = $this->paginate($paymentMethods);

        $this->set(compact('paymentMethods'));
    }

    /**
     * View method
     *
     * @param string|null $id Payment Method id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paymentMethod = $this->PaymentMethods->get($id, [
            'contain' => [],
        ]);

        $this->set('paymentMethod', $paymentMethod);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $paymentMethod = $this->PaymentMethods->newEntity();
        if ($this->request->is('post')) {
            $paymentMethod = $this->PaymentMethods->patchEntity($paymentMethod, $this->request->getData());
            if ($this->PaymentMethods->save($paymentMethod)) {
                $this->Flash->success(__('The payment method has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment method could not be saved. Please, try again.'));
        }
        $this->set(compact('paymentMethod'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment Method id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        if ($this->request->is('ajax')) {

            if ($this->request->is('get')){
                $id = $_GET['pk'];
                $status = $_GET['value'];
                $paymentMethod = $this->PaymentMethods->get($id, [
                    'contain' => [],
                ]);
                $paymentMethod->status = $status;
                if ($this->PaymentMethods->save($paymentMethod)) {
                    $response =[
                        'status' => 'success',
                        'data' => $status
                    ];
                }else{
                    $response =[
                        'status' => 'error',
                        'data' => []
                    ];
                }
            }

            if ($this->request->is('post')){
                $data = $this->request->getData();
                $paymentMethod = $this->PaymentMethods->get($data['pk'], [
                    'contain' => [],
                ]);
                $paymentMethod->name = $data['value'];
                if ($this->PaymentMethods->save($paymentMethod)) {
                    $response =[
                        'status' => 'success',
                        'data' => $data['value']
                    ];
                }else{
                    $response =[
                        'status' => 'error',
                        'data' => $paymentMethod->errors()
                    ];
                }
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
     * @param string|null $id Payment Method id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $paymentMethod = $this->PaymentMethods->get($id);
        $paymentMethod->is_deleted = 1;
        if ($this->PaymentMethods->save($paymentMethod)) {
            $this->Flash->success(__('The payment method has been deleted.'));
        } else {
            $this->Flash->error(__('The payment method could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

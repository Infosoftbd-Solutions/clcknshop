<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

/**
 * OrderPayments Controller
 *
 * @property \App\Model\Table\OrderPaymentsTable $OrderPayments
 *
 * @method \App\Model\Entity\OrderPayment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrderPaymentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Orders'],
        ];
        $orderPayments = $this->paginate($this->OrderPayments);

        $this->set(compact('orderPayments'));
    }

    /**
     * View method
     *
     * @param string|null $id Order Payment id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderPayment = $this->OrderPayments->get($id, [
            'contain' => ['Orders'],
        ]);

        $this->set('orderPayment', $orderPayment);
    }

/*

class UsersController extends Controller {
   function add() {
     $user = $this->User->newEntity();
        if ($this->request->is('post')) {
            $user = $this->User->patchEntity($user, $this->request->data);
            $this->User->connection()->query('BEGIN');
            if ($this->User->save($user, ['atomic'=>false])) {
                $this->Flash->success(__('user saved.'));

                 // Some other things to save

                $this->User->connection()->query('COMMIT');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->User->connection()->query('ROLLBACK');
                $this->Flash->error(__('error.'));
            }
        }
        $this->set(compact('user'));
   }
}

*/

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($refund = null)
    {
      
        
        // $orderPayment = $this->OrderPayments->newEntity();
        if ($this->request->is('post')) {
            $response = [];
            $PaymentMethods = TableRegistry::getTableLocator()->get('PaymentMethods');
            
            $methods = $PaymentMethods->find('list',[
                'keyField' => 'id',
                'valueField' => 'name'
            ])->where(['status' => 1])->toArray();


            $data       = $this->request->getData();
            $notes      = Configure::read('App.currency') . " ".$data['amount']." paid by ".$methods[$data['payment_method']];
            $by         = $this->request->session()->read('user.first_name');
            $log_status = 5;

            if($refund){
                $data['amount'] = - $data['amount'];
                $notes  = Configure::read('App.currency') . " ".$data['amount']." refund by ".$methods[$data['payment_method']];
                $log_status = 6;
            }

            
            
        
            $payment = $this->OrderPayments->payment($data, $notes, $by, $log_status);
           
            if($payment){
                $store = json_decode(Configure::read('App.store'));

                $order = $this->OrderPayments->Orders->get($data['orders_id'], [
                'contain' => ['Customers','OrderProducts', 'PaymentProcessor']
                ]);
          
                $ret = $this->Mail->send($store->email, "admin Payment  notfication Order#{$order->order_id}", ['order' => $order,'payment'=>$payment,'notes'=>$notes, 'store' => $store], "admin_order_payment");
            }
            
            $this->Flash->success(__('The order payment saved seccessfully.'));


            if($this->request->is('ajax')){
                $response['data'] = $data;
                $this->set(compact('response'));
                $this->set('_serialize', 'response');
                $this->RequestHandler->renderAs($this, 'json');
                return;
            }
            
        }
      
        // $this->set(compact('orderPayment', 'orders'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Payment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     
    public function edit($id = null)
    {

        $orderPayment = $this->OrderPayments->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderPayment = $this->OrderPayments->patchEntity($orderPayment, $this->request->getData());
            if ($this->OrderPayments->save($orderPayment)) {
                $this->Flash->success(__('The order payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order payment could not be saved. Please, try again.'));
        }
        $orders = $this->OrderPayments->Orders->find('list', ['limit' => 200]);
        $this->set(compact('orderPayment', 'orders'));
    }
*/
    /**
     * Delete method
     *
     * @param string|null $id Order Payment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderPayment = $this->OrderPayments->get($id);
        if ($this->OrderPayments->delete($orderPayment)) {
            $this->Flash->success(__('The order payment has been deleted.'));
        } else {
            $this->Flash->error(__('The order payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    */
}

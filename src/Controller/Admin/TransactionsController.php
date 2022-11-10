<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use phpDocumentor\Reflection\Types\Array_;

/**
 * Transactions Controller
 *
 * @property \App\Model\Table\TransactionsTable $Transactions
 *
 * @method \App\Model\Entity\Transaction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TransactionsController extends AppController
{
    /**
     * Index method
     *
     * @param string $q
     * @return \Cake\Http\Response|null
     */
    public function index($garbage = null, $query = null)
    {
        $this->paginate = [
            'contain' => ['Orders' => ['PaymentProcessor']],
            'order' => ['Transactions.id' => 'desc']
        ];
        $transactions = $this->Transactions->find('all',['order' => 'Transactions.id DESC']);

        if ($this->request->is('ajax')){
            if( $query !== null ){
                $transactions = $this->Transactions->find('all')->where([
                    'OR' => [
                        "Transactions.order_id LIKE  '%". $query . "%'",
                        'Transactions.transaction_number LIKE' => '%' . $query . '%'
                    ]
                ])->contain(['Orders' => ['PaymentProcessor']]);
            }

            $transactions = $this->paginate($transactions);
            $this->set(compact('transactions'));
            $this->layout="ajax";
            $this->render('ajax');
        }
        $transactions = $this->paginate();
        $this->set(compact('transactions'));
    }

    public function approved($id = null)
    {


        if ($this->request->is(['patch', 'post', 'put'])) {
            $transaction = $this->Transactions->find('all')->where(['Transactions.id' => $id])->contain(['Orders' => ['PaymentProcessor' => ['PaymentMethods']]])->first();

            if (!$transaction){
                $this->Flash->error(__('The transaction record could not found. Please, try again.'));
                return $this->redirect($this->referer());
            }


            $data = [
                'orders_id' => $transaction->order->id,
                'amount' => $transaction->order->order_total,
                'payment_date' => FrozenTime::now(),
                'payment_method' => $transaction->order->payment_processor->payment_method->id
            ];


            $OrderPayments = TableRegistry::getTableLocator()->get('OrderPayments');

            if (!$OrderPayments->payment($data)){
                $this->Flash->error(__('Order Amount can not be transferred. please Contact our support Center'));
                return $this->redirect($this->referer());
            }
            

            $transaction->status = 1;
            if (!$this->Transactions->save($transaction)) {
                $this->Flash->error(__('Order Amount Already transferred but transaction could not be updated. please contact our support center'));
                return $this->redirect($this->referer());
            }

            $this->Flash->success(__('The Transaction is updated and Order Amount transferred'));
        }

        return $this->redirect($this->referer());

    }



    /**
     * View method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $transaction = $this->Transactions->get($id, [
            'contain' => ['Orders'],
        ]);

        $this->set('transaction', $transaction);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $transaction = $this->Transactions->newEntity();
        if ($this->request->is('post')) {
            $transaction = $this->Transactions->patchEntity($transaction, $this->request->getData());
            if ($this->Transactions->save($transaction)) {
                $this->Flash->success(__('The transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
        }
        $orders = $this->Transactions->Orders->find('list', ['limit' => 200]);
        $this->set(compact('transaction', 'orders'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $transaction = $this->Transactions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transaction = $this->Transactions->patchEntity($transaction, $this->request->getData());
            if ($this->Transactions->save($transaction)) {
                $this->Flash->success(__('The transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
        }
        $orders = $this->Transactions->Orders->find('list', ['limit' => 200]);
        $this->set(compact('transaction', 'orders'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $transaction = $this->Transactions->get($id);
        if ($this->Transactions->delete($transaction)) {
            $this->Flash->success(__('The transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The transaction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

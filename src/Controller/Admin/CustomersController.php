<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 *
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($garbage = null, $query = null)
    {
        $customers = $this->Customers->find('all', ['order' => 'Customers.id DESC']);
        $customers = $this->paginate($customers);

        if($this->request->is('ajax')) {
            $customers = $this->Customers->find('all')->where([
                'OR' => [
                    'Customers.first_name LIKE' => '%' . $query . '%',
                    'Customers.last_name LIKE' => '%' . $query . '%',
                    'Customers.phone LIKE' => '%' . $query . '%'
                ]
            ]);
            $customers = $this->paginate($customers);
            $this->set(compact('customers'));
            $this->layout="ajax";
            $this->render('customer_display');
        }else{
//            pr($customers);
            $this->set(compact('customers'));
//            $this->set('_serialize', 'customers');
        }
    }

    public function customers()
    {
        $customerList = [];
        if(isset($_GET['customers']) && !empty($_GET['customers'])){
            $customers = explode(',', $_GET['customers']);
            $customers = $this->Customers->find('all')->where(['id IN' => $customers])->toArray();
        }
        else if(isset($_GET['q']) && !empty($_GET['q'])){
            $q = $_GET['q'];
            $customers = $this->Customers->find('all', [
                'conditions' => ['OR'=>['Customers.first_name LIKE' => '%' . $q . '%','Customers.last_name LIKE' => '%' . $q . '%', 'Customers.phone LIKE' => '%' . $q . '%']]
            ])->toArray();
        }
        else{
            $customers = $this->Customers->find('all')->toArray();
        }

        foreach ($customers as $customer){
            $customerList[] = [
                'id'=>$customer->id,
                'data'=>json_encode($customer)
//                'image' => $customer->DefaultImage
            ];
        }

        $this->set(compact('customerList'));
        $this->set('_serialize', 'customerList');
    }



    public function customerList()
    {
      header("Access-Control-Allow-Origin: *");

      
      $q = '';
      if(isset($_GET['q'])) $q = $_GET['q'];
      $query = $this->Customers->find('all', [
          'conditions' => ['OR'=>['Customers.last_name LIKE' => '%' . $q . '%' ,'Customers.first_name LIKE' => '%' . $q . '%']]

      ]);

      $data = $query->toArray();
      $customerlist = [];
      $customerlist[] = ['value'=>0,'text'=>'Add new customer','data'=>[]];
      foreach ($data as $key => $customer) {
      //  debug($customer);
        $customerar  = $customer->toArray();
        unset($customerar['passwd']);
        unset($customerar['created']);
        unset($customerar['modified']);

        $customerlist[] = ['value'=>$customer->id,'text'=>$customer->first_name . " " . $customer->last_name . "," . $customer->address . "," . $customer->city ,'data'=>$customer->toArray()];
      }
      $this->set(compact('customerlist'));
      $this->set('_serialize', 'customerlist');

    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => [
                'Orders' => [
                    'sort' => 'Orders.id DESC'
                ]
            ]
            
        ]);
        $this->set('customer', $customer);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //$CustomerAddresses = TableRegistry::getTableLocator()->get('CustomerAddresses');
      //  $customer_address =  $this->Customers->CustomerAddresses->newEntity();


        $customer = $this->Customers->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $data['passwd'] = isset($data['passwd']) ? md5($data['passwd']) : '';
          //  $data['username'] = isset($data['username']) ? $data['username'] : $data['phone'];
//            pr($data);
//            die();
            $customer = $this->Customers->patchEntity($customer, $data);

            $response = [];
            if ($this->Customers->save($customer)) {
                if($this->request->is('ajax')){
                    $response['data'] = $customer;
                }else{
                    $this->Flash->success(__('The customer has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            }else {
              $response['error'] = $customer->errors();
            }

            if($this->request->is('ajax')){
              $this->set(compact('response'));
              $this->set('_serialize', 'response');
              $this->RequestHandler->renderAs($this, 'json');
              return;
            }else
              $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }


        $this->set(compact('customer'));


    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $customer = $this->Customers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['passwd'] = isset($data['passwd']) ? md5($data['passwd']) : '';
            $customer = $this->Customers->patchEntity($customer, $data);

            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));
                return $this->redirect(['action' => 'view',$id]);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $customer = $this->Customers->get($id, [
                'contain' => ['Orders'],
        ]);

        $this->request->allowMethod(['post', 'delete']);
//        $customer = $this->Customers->get($id);
        if (count($customer->orders)==0) {
            if($this->Customers->delete($customer))
                $this->Flash->success(__('The customer has been deleted.'));
            else
                $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        } else {
            $this->Flash->error(__('The customer has existing order.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

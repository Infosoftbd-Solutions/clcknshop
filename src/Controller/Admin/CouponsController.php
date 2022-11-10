<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Coupons Controller
 *
 *
 * @method \App\Model\Entity\Coupon[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CouponsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $coupons = $this->paginate($this->Coupons);

        $this->set(compact('coupons'));
    }

    /**
     * View method
     *
     * @param string|null $id Coupon id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        return $this->redirect(['action' => 'edit', $id]);

        $Collections = TableRegistry::getTableLocator()->get('Categories');
        $Products = TableRegistry::getTableLocator()->get('Products');
        $Customers = TableRegistry::getTableLocator()->get('Customers');
        $coupon = $this->Coupons->get($id, [
            'contain' => [],
        ]);

        $conditions = json_decode($coupon->coupon_conditions, true);
        $coupon->min_shopping = $conditions['min_shopping'];

        //collections

        $collections = $Collections->find('all')->where(['id IN' => explode(',', $conditions['collections'])])->all();

        $products = $Products->find('all')->where(['id IN' => explode(',', $conditions['products'])])->all();
        $customers = $Customers->find('all')->where(['id IN' => explode(',', $conditions['users'])])->all();

        $this->set(compact('coupon', 'collections', 'products', 'customers'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $Collections = TableRegistry::getTableLocator()->get('Categories');
        $collections = $Collections->find('all')->all();

        $coupon = $this->Coupons->newEntity();
        if ($this->request->is('post')) {
//            pr($this->request->getData());

            $data = $this->request->getData();
            $data['coupon_code'] = $this->generateRandomString();

            if ($data['product_selection_type'] == 2) $data['products'] = implode(',',$data['products']);
            if ($data['product_selection_type'] == 3) $data['products'] = implode(',',$data['collections']);
            if ($data['customer_selection_type'] == 2) $data['customers'] = implode(',', $data['customers']);

            $coupon = $this->Coupons->patchEntity($coupon, $data);
            if ($this->Coupons->save($coupon)) {
                $this->Flash->success(__('The coupon has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
//            pr($coupon->errors());


            $this->Flash->error(__('The coupon could not be saved. Please, try again.'));


        }

        $this->set(compact('coupon', 'collections'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Coupon id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $Collections = TableRegistry::getTableLocator()->get('Categories');
        $Products = TableRegistry::getTableLocator()->get('Products');
        $Customers = TableRegistry::getTableLocator()->get('Customers');
        $collections = $Collections->find('all')->all();
        $products = [];
        $customers = [];

        $coupon = $this->Coupons->get($id, [
            'contain' => [],
        ]);
        if ($coupon->product_selection_type == 2)
            $products = $Products->find('all')->where(['id IN' => explode(',',$coupon->products)])->all();

        if ($coupon->customer_selection_type == 2)
            $customers = $Customers->find('all')->where(['id IN' => explode(',',$coupon->customers)])->all();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if ($data['product_selection_type'] == 2) $data['products'] = implode(',',$data['products']);
            if ($data['product_selection_type'] == 3) $data['products'] = implode(',',$data['collections']);
            if ($data['customer_selection_type'] == 2) $data['customers'] = implode(',', $data['customers']);

            $coupon = $this->Coupons->patchEntity($coupon, $data);
            if ($this->Coupons->save($coupon)) {
                $this->Flash->success(__('The coupon has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
//            pr($coupon->errors());
//            die();
            $this->Flash->error(__('The coupon could not be saved. Please, try again.'));
        }
        $this->set(compact('coupon','collections', 'products', 'customers'));

    }

    /**
     * Delete method
     *
     * @param string|null $id Coupon id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coupon = $this->Coupons->get($id);
        if ($this->Coupons->delete($coupon)) {
            $this->Flash->success(__('The coupon has been deleted.'));
        } else {
            $this->Flash->error(__('The coupon could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    private function generateRandomString($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

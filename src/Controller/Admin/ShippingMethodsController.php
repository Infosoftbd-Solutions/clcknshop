<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * ShippingMethods Controller
 *
 * @property \App\Model\Table\ShippingMethodsTable $ShippingMethods
 *
 * @method \App\Model\Entity\ShippingMethod[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ShippingMethodsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $shippingMethods = $this->paginate($this->ShippingMethods);
        $this->set(compact('shippingMethods'));
    }


    /**
     * View method
     *
     * @param string|null $id Shipping Method id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $shippingMethod = $this->ShippingMethods->get($id);

        $this->set('shippingMethod', $shippingMethod);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $shippingMethod = $this->ShippingMethods->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $shippingMethod = $this->ShippingMethods->patchEntity($shippingMethod, $data);
            if ($this->ShippingMethods->save($shippingMethod)) {
                $this->Flash->success(__('The shipping method has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shipping method could not be saved. Please, try again.'));
        }
      //  $zones = $this->ShippingMethods->Zones->find('list', ['limit' => 200]);
        $this->set(compact('shippingMethod'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Shipping Method id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if ($this->request->is('get')) return $this->redirect($this->referer());



        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $shippingMethod = $this->ShippingMethods->get($data['id']);

            $shippingMethod = $this->ShippingMethods->patchEntity($shippingMethod,$data);
            if ($this->ShippingMethods->save($shippingMethod)) {
                $this->Flash->success(__('The shipping method has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shipping method could not be saved. Please, try again.'));
        }
        $this->set(compact('shippingMethod'));
//        if($this->request->is('ajax')){
//
//            $this->layout="ajax";
//            $this->render('form');
//            return ;
//        }
//        $this->render('form');
       // $zones = $this->ShippingMethods->Zones->find('list', ['limit' => 200]);
        $this->set(compact('shippingMethod'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Shipping Method id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $shippingMethod = $this->ShippingMethods->get($id);
        if ($this->ShippingMethods->delete($shippingMethod)) {
            $this->Flash->success(__('The shipping method has been deleted.'));
        } else {
            $this->Flash->error(__('The shipping method could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

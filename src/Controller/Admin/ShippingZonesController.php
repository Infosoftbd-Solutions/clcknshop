<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * ShippingZones Controller
 *
 * @property \App\Model\Table\ShippingZonesTable $ShippingZones
 *
 * @method \App\Model\Entity\ShippingZone[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ShippingZonesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($garbage = null, $query = null)
    {
        $shippingZones = $this->paginate($this->ShippingZones);

        if($this->request->is('ajax')) {
            $shippingZones = $this->ShippingZones->find('all')->where([
                'OR' => [
                    'name LIKE' => '%' . $query . '%',
                    'city LIKE' => '%' . $query . '%',
                ]
            ]);
            $shippingZones = $this->paginate($shippingZones);
            $this->set(compact('shippingZones'));
            $this->layout="ajax";
            $this->render('zone_display');
            return;
        }

        $this->set(compact('shippingZones'));
    }

    /**
     * View method
     *
     * @param string|null $id Shipping Zone id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $shippingZone = $this->ShippingZones->get($id, [
            'contain' => [],
        ]);

        $this->set('shippingZone', $shippingZone);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $shippingZone = $this->ShippingZones->newEntity();
        if ($this->request->is('post')) {
            $shippingZone = $this->ShippingZones->patchEntity($shippingZone, $this->request->getData());
            if ($this->ShippingZones->save($shippingZone)) {
                $this->Flash->success(__('The shipping zone has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shipping zone could not be saved. Please, try again.'));
        }
        $this->set(compact('shippingZone'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Shipping Zone id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $id = $this->request->getData()['id'];
        $shippingZone = $this->ShippingZones->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $shippingZone = $this->ShippingZones->patchEntity($shippingZone, $this->request->getData());
            if ($this->ShippingZones->save($shippingZone)) {
                $this->Flash->success(__('The shipping zone has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shipping zone could not be saved. Please, try again.'));
        }
        $this->set(compact('shippingZone'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Shipping Zone id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $shippingZone = $this->ShippingZones->get($id);
        if ($this->ShippingZones->delete($shippingZone)) {
            $this->Flash->success(__('The shipping zone has been deleted.'));
        } else {
            $this->Flash->error(__('The shipping zone could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

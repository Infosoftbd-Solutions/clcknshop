<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Reviews Controller
 *
 * @property \App\Model\Table\ReviewsTable $Reviews
 *
 * @method \App\Model\Entity\Review[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReviewsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Products', 'Customers'],
            // 'order'=> 'Reviews.id DESC'
        ];
        
        $reviews = $this->paginate($this->Reviews->find('all')->order('Reviews.id DESC'));

        $this->set(compact('reviews'));
    }

    /**
     * View method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $review = $this->Reviews->get($id, [
            'contain' => ['Products', 'Customers'],
        ]);

        $this->set('review', $review);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $review = $this->Reviews->newEntity();
        if ($this->request->is('post')) {
            $review = $this->Reviews->patchEntity($review, $this->request->getData());
            if ($this->Reviews->save($review)) {
                $this->Flash->success(__('The review has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The review could not be saved. Please, try again.'));
        }
        $products = $this->Reviews->Products->find('list', ['limit' => 200]);
        $customers = $this->Reviews->Customers->find('list', ['limit' => 200]);
        $this->set(compact('review', 'products', 'customers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
//        $this->autoRender = false;
        $id = isset($_GET['pk']) ? $_GET['pk'] : $id;

        $review = $this->Reviews->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is('ajax')) {

            $value = $_GET['value'];
            $action = $_GET['name'];

            if ($action == 'status'){
                $review->status = $value;
                if ($this->Reviews->save($review)) {
                    $response =[
                        'status' => 'success',
                        'data' => $review->status
                    ];
                }else{
                    $response =[
                        'status' => 'error',
                        'data' => []
                    ];
                }

                $this->set(compact('response'));
                $this->set('_serialize', 'response');
                $this->RequestHandler->renderAs($this, 'json');
                return;

            }
        }
/*
        if ($this->request->is(['patch', 'post', 'put'])) {
            $review = $this->Reviews->patchEntity($review, $this->request->getData());
            if ($this->Reviews->save($review)) {
                $this->Flash->success(__('The review has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The review could not be saved. Please, try again.'));
        }
        $products = $this->Reviews->Products->find('list', ['limit' => 200]);
        $customers = $this->Reviews->Customers->find('list', ['limit' => 200]);
        $this->set(compact('review', 'products', 'customers'));
*/


        return $this->redirect($this->referer());

    }

    /**
     * Delete method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $review = $this->Reviews->get($id);
        if ($this->Reviews->delete($review)) {
            $this->Flash->success(__('The review has been deleted.'));
        } else {
            $this->Flash->error(__('The review could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * MailSettings Controller
 *
 *
 * @method \App\Model\Entity\MailSetting[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MailSettingsController extends AppController
{
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $mailSettings = $this->paginate($this->MailSettings);

        $this->set(compact('mailSettings'));
    }

    /**
     * View method
     *
     * @param string|null $id Mail Setting id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mailSetting = $this->MailSettings->get($id, [
            'contain' => [],
        ]);

        $this->set('mailSetting', $mailSetting);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $Settings = TableRegistry::getTableLocator()->get('Settings');

        $mailSetting = $Settings->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $mailSetting = $Settings->patchEntity($mailSetting,$data);
            if ($Settings->save($mailSetting)) {
                $this->Flash->success(__('The mail setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mail setting could not be saved. Please, try again.'));
        }
        $this->set(compact('mailSetting'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mail Setting id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $Settings = TableRegistry::getTableLocator()->get('Settings');
        $mailSetting = $Settings->find('all')->where(['name' => 'mail'])->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['value'] = json_encode($data['smtp']);
            if (!$mailSetting) $mailSetting = $Settings->newEntity();
            $mailSetting = $Settings->patchEntity($mailSetting, $data);
            if ($Settings->save($mailSetting)) {
                $this->Flash->success(__('The mail setting has been saved.'));
            }else{
                $this->Flash->error(__('The mail setting could not be saved. Please, try again.'));
            }
        }
        if ($mailSetting) $smtp = json_decode($mailSetting->value, true);
        $this->set(compact('smtp'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Mail Setting id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mailSetting = $this->MailSettings->get($id);
        if ($this->MailSettings->delete($mailSetting)) {
            $this->Flash->success(__('The mail setting has been deleted.'));
        } else {
            $this->Flash->error(__('The mail setting could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

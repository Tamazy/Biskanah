<?php
App::uses('AppController', 'Controller');
/**
 * Invits Controller
 *
 * @property Invit $Invit
 * @property PaginatorComponent $Paginator
 */
class InvitsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 * Permet de voir les invitations reçues ou envoyées
 *
 * @param int $_SESSION['user_id']
 * @param int $_SESSION['team_id']
 * @return void
 */
	public function index() {

	}

/**
 * invit method
 * Créer une invitation
 *
 * @param int $_SESSION['user_id']
 * @param int $_SESSION['team_id']
 * @param int $_POST['to_user_id']
 * @return void
 */
	public function invit() {

	}

/**
 * accept method
 * Accepter une invitation
 *
 * @param int $_POST['invit_id']
 * @return void
 */
	public function accept() {

	}
/**
 * accept method
 * Refuser une invitation
 *
 * @param int $_POST['invit_id']
 * @return void
 */
	public function refuse() {

	}
/**
 * cancel method
 * Annuler une invitation
 *
 * @param int $_POST['invit_id']
 * @return void
 */
	public function cancel() {

	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Invit->recursive = 0;
		$this->set('invits', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Invit->exists($id)) {
			throw new NotFoundException(__('Invalid invit'));
		}

        $this->Invit->updateAll(array('read'=>"NOW()" ),array('Invit.id'=>$id));
        $this->loadModel('User');
        $this->User->DowngradeUnreadMsg($this->Invit->getGuest($id));
		$options = array('conditions' => array('Invit.' . $this->Invit->primaryKey => $id));
		$this->set('invit', $this->Invit->find('first', $options));
	}


/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
            debug($this->request->data);

            $tmp = $this->request->data['Invit'];
			$d['Invit']['user_id'] = $tmp['user_id'];
            $d['Invit']['from_user'] = $tmp['from_user'];
            $d['Invit']['team_id'] = $tmp['team_id'];
            $d['Invit']['read'] = NULL;

            $this->Invit->create();
			if ($this->Invit->generate($d)) {
                $this->loadModel('User');
                $this->User->UpdateUnreadMsg($d['Invit']['user_id']);
                $this->Session->setFlash(__('The invit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The invit could not be saved. Please, try again.'));
			}
		}
		$users = $this->Invit->User->find('list');
		$teams = $this->Invit->Team->find('list');
		$this->set(compact('users', 'teams'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Invit->exists($id)) {
			throw new NotFoundException(__('Invalid invit'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Invit->save($this->request->data)) {
				$this->Session->setFlash(__('The invit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The invit could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Invit.' . $this->Invit->primaryKey => $id));
			$this->request->data = $this->Invit->find('first', $options);
		}
		$users = $this->Invit->User->find('list');
		$teams = $this->Invit->Team->find('list');
		$this->set(compact('users', 'teams'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Invit->id = $id;
		if (!$this->Invit->exists()) {
			throw new NotFoundException(__('Invalid invit'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Invit->delete()) {
			$this->Session->setFlash(__('The invit has been deleted.'));
		} else {
			$this->Session->setFlash(__('The invit could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

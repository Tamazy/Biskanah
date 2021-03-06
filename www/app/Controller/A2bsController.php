<?php
App::uses('AppController', 'Controller');
/**
 * A2bs Controller
 *
 * @property A2b $A2b
 * @property PaginatorComponent $Paginator
 */
class A2bsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * Affiche les unités en déplacement depuis ou vers le camp
 * View: index
 *
 * @param int $_SESSION['camp_id']
 * @return void
 */
	public function index() {

	}

/**
 * send method
 *
 * Envoye des unités vers un camp
 * View: send
 *
 * @param int $_POST['to_camp']
 * @param mixed[] $_POST['units']
 * @param mixed[] $_POST['res'] ressources
 * @param int $_POST['type'] type de déplacement
 * @param int $_SESSION['camp_id'] from_camp
 * @return void
 */
	public function send() {

	}

/**
 * cancel method
 *
 * Fait revenir un groupe d'unités en déplacement
 *
 * @param int $_POST['a2b_id']
 * @return void
 */
	public function cancel() {

	}


/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->A2b->recursive = 0;
		$this->set('a2bs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->A2b->exists($id)) {
			throw new NotFoundException(__('Invalid a2b'));
		}
		$options = array('conditions' => array('A2b.' . $this->A2b->primaryKey => $id));
		$this->set('a2b', $this->A2b->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->A2b->create();
			if ($this->A2b->save($this->request->data)) {
				$this->Session->setFlash(__('The a2b has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The a2b could not be saved. Please, try again.'));
			}
		}
		$resources = $this->A2b->Resource->find('list');
		$this->set(compact('resources'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->A2b->exists($id)) {
			throw new NotFoundException(__('Invalid a2b'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->A2b->save($this->request->data)) {
				$this->Session->setFlash(__('The a2b has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The a2b could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('A2b.' . $this->A2b->primaryKey => $id));
			$this->request->data = $this->A2b->find('first', $options);
		}
		$resources = $this->A2b->Resource->find('list');
		$this->set(compact('resources'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->A2b->id = $id;
		if (!$this->A2b->exists()) {
			throw new NotFoundException(__('Invalid a2b'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->A2b->delete()) {
			$this->Session->setFlash(__('The a2b has been deleted.'));
		} else {
			$this->Session->setFlash(__('The a2b could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

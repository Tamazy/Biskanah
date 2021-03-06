<?php
App::uses('AppController', 'Controller');
/**
 * Dataunits Controller
 *
 * @property Dataunit $Dataunit
 * @property PaginatorComponent $Paginator
 */
class DataunitsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Dataunit->recursive = 0;
		$this->set('dataunits', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Dataunit->exists($id)) {
			throw new NotFoundException(__('Invalid dataunit'));
		}
		$options = array('conditions' => array('Dataunit.' . $this->Dataunit->primaryKey => $id));
		$this->set('dataunit', $this->Dataunit->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Dataunit->create();
			if ($this->Dataunit->save($this->request->data)) {
				$this->Session->setFlash(__('The dataunit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dataunit could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Dataunit->exists($id)) {
			throw new NotFoundException(__('Invalid dataunit'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Dataunit->save($this->request->data)) {
				$this->Session->setFlash(__('The dataunit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dataunit could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Dataunit.' . $this->Dataunit->primaryKey => $id));
			$this->request->data = $this->Dataunit->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Dataunit->id = $id;
		if (!$this->Dataunit->exists()) {
			throw new NotFoundException(__('Invalid dataunit'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Dataunit->delete()) {
			$this->Session->setFlash(__('The dataunit has been deleted.'));
		} else {
			$this->Session->setFlash(__('The dataunit could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

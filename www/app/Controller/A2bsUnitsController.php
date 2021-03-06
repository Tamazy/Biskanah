<?php
App::uses('AppController', 'Controller');
/**
 * A2bsUnits Controller
 *
 * @property A2bsUnit $A2bsUnit
 * @property PaginatorComponent $Paginator
 */
class A2bsUnitsController extends AppController {

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
		$this->A2bsUnit->recursive = 0;
		$this->set('a2bsUnits', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->A2bsUnit->exists($id)) {
			throw new NotFoundException(__('Invalid a2bs unit'));
		}
		$options = array('conditions' => array('A2bsUnit.' . $this->A2bsUnit->primaryKey => $id));
		$this->set('a2bsUnit', $this->A2bsUnit->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->A2bsUnit->create();
			if ($this->A2bsUnit->save($this->request->data)) {
				$this->Session->setFlash(__('The a2bs unit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The a2bs unit could not be saved. Please, try again.'));
			}
		}
		$a2bs = $this->A2bsUnit->A2b->find('list');
		$units = $this->A2bsUnit->Unit->find('list');
		$this->set(compact('a2bs', 'units'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->A2bsUnit->exists($id)) {
			throw new NotFoundException(__('Invalid a2bs unit'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->A2bsUnit->save($this->request->data)) {
				$this->Session->setFlash(__('The a2bs unit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The a2bs unit could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('A2bsUnit.' . $this->A2bsUnit->primaryKey => $id));
			$this->request->data = $this->A2bsUnit->find('first', $options);
		}
		$a2bs = $this->A2bsUnit->A2b->find('list');
		$units = $this->A2bsUnit->Unit->find('list');
		$this->set(compact('a2bs', 'units'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->A2bsUnit->id = $id;
		if (!$this->A2bsUnit->exists()) {
			throw new NotFoundException(__('Invalid a2bs unit'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->A2bsUnit->delete()) {
			$this->Session->setFlash(__('The a2bs unit has been deleted.'));
		} else {
			$this->Session->setFlash(__('The a2bs unit could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

<?php
App::uses('AppController', 'Controller');
/**
 * AssistsUnits Controller
 *
 * @property AssistsUnit $AssistsUnit
 * @property PaginatorComponent $Paginator
 */
class AssistsUnitsController extends AppController {

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
		$this->AssistsUnit->recursive = 0;
		$this->set('assistsUnits', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AssistsUnit->exists($id)) {
			throw new NotFoundException(__('Invalid assists unit'));
		}
		$options = array('conditions' => array('AssistsUnit.' . $this->AssistsUnit->primaryKey => $id));
		$this->set('assistsUnit', $this->AssistsUnit->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AssistsUnit->create();
			if ($this->AssistsUnit->save($this->request->data)) {
				$this->Session->setFlash(__('The assists unit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assists unit could not be saved. Please, try again.'));
			}
		}
		$assists = $this->AssistsUnit->Assist->find('list');
		$units = $this->AssistsUnit->Unit->find('list');
		$this->set(compact('assists', 'units'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AssistsUnit->exists($id)) {
			throw new NotFoundException(__('Invalid assists unit'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AssistsUnit->save($this->request->data)) {
				$this->Session->setFlash(__('The assists unit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assists unit could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AssistsUnit.' . $this->AssistsUnit->primaryKey => $id));
			$this->request->data = $this->AssistsUnit->find('first', $options);
		}
		$assists = $this->AssistsUnit->Assist->find('list');
		$units = $this->AssistsUnit->Unit->find('list');
		$this->set(compact('assists', 'units'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AssistsUnit->id = $id;
		if (!$this->AssistsUnit->exists()) {
			throw new NotFoundException(__('Invalid assists unit'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AssistsUnit->delete()) {
			$this->Session->setFlash(__('The assists unit has been deleted.'));
		} else {
			$this->Session->setFlash(__('The assists unit could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

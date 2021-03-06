<?php
App::uses('AppController', 'Controller');
/**
 * Dttechnos Controller
 *
 * @property Dttechno $Dttechno
 * @property PaginatorComponent $Paginator
 */
class DttechnosController extends AppController {

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
		$this->Dttechno->recursive = 0;
		$this->set('dttechnos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Dttechno->exists($id)) {
			throw new NotFoundException(__('Invalid dttechno'));
		}
		$options = array('conditions' => array('Dttechno.' . $this->Dttechno->primaryKey => $id));
		$this->set('dttechno', $this->Dttechno->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Dttechno->create();
			if ($this->Dttechno->save($this->request->data)) {
				$this->Session->setFlash(__('The dttechno has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dttechno could not be saved. Please, try again.'));
			}
		}
		$technos = $this->Dttechno->Techno->find('list');
		$buildings = $this->Dttechno->Building->find('list');
		$this->set(compact('technos', 'buildings'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Dttechno->exists($id)) {
			throw new NotFoundException(__('Invalid dttechno'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Dttechno->save($this->request->data)) {
				$this->Session->setFlash(__('The dttechno has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dttechno could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Dttechno.' . $this->Dttechno->primaryKey => $id));
			$this->request->data = $this->Dttechno->find('first', $options);
		}
		$technos = $this->Dttechno->Techno->find('list');
		$buildings = $this->Dttechno->Building->find('list');
		$this->set(compact('technos', 'buildings'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Dttechno->id = $id;
		if (!$this->Dttechno->exists()) {
			throw new NotFoundException(__('Invalid dttechno'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Dttechno->delete()) {
			$this->Session->setFlash(__('The dttechno has been deleted.'));
		} else {
			$this->Session->setFlash(__('The dttechno could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

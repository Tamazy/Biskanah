<?php
App::uses('AppController', 'Controller');
/**
 * Datatechnos Controller
 *
 * @property Datatechno $Datatechno
 * @property PaginatorComponent $Paginator
 */
class DatatechnosController extends AppController {

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
		$this->Datatechno->recursive = 0;
		$this->set('datatechnos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Datatechno->exists($id)) {
			throw new NotFoundException(__('Invalid datatechno'));
		}
		$options = array('conditions' => array('Datatechno.' . $this->Datatechno->primaryKey => $id));
		$this->set('datatechno', $this->Datatechno->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Datatechno->create();
			if ($this->Datatechno->save($this->request->data)) {
				$this->Session->setFlash(__('The datatechno has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The datatechno could not be saved. Please, try again.'));
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
		if (!$this->Datatechno->exists($id)) {
			throw new NotFoundException(__('Invalid datatechno'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Datatechno->save($this->request->data)) {
				$this->Session->setFlash(__('The datatechno has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The datatechno could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Datatechno.' . $this->Datatechno->primaryKey => $id));
			$this->request->data = $this->Datatechno->find('first', $options);
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
		$this->Datatechno->id = $id;
		if (!$this->Datatechno->exists()) {
			throw new NotFoundException(__('Invalid datatechno'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Datatechno->delete()) {
			$this->Session->setFlash(__('The datatechno has been deleted.'));
		} else {
			$this->Session->setFlash(__('The datatechno could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

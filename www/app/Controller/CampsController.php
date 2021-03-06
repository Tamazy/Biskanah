<?php
App::uses('GameController', 'Controller');
/**
 * Camps Controller
 *
 * @property Camp $Camp
 * @property PaginatorComponent $Paginator
 */
class CampsController extends GameController {

    public $uses = array('Camp', 'World');
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


/**
*	view method
* Vue privée du camp avec les multiples bâtiments
* 
* @param int id s:camp_id
* @return void
*/
	public function actual()
    {
        $this->Data = $this->Components->load('Data');

        $data['Camp'] = $this->Data->read('Camp');
        $data['Buildings'] = $this->Data->read('Buildings');
        $data['Technos'] = $this->Data->read('Technos');
        $data['Dtbuildings'] = $this->Data->read('Dtbuildings');

        $this->loadModel('Databuilding');
        $data['Databuildings'] = $this->Databuilding->findByBuildings($data['Buildings'],$data['Technos'],1);

        $data['Technos'] = $this->Data->read('Technos');
        $data['Dttechnos'] = $this->Data->read('Dttechnos');

        $this->set('data',$data);
    }

    /**
     * @param null $id
     *
     * @throws NotFoundException
     */
    public function change($id = null)
    {
        if ($id === null)
        {
            throw new Exception('id invalide : '.$id);
        }

        $user_id = $this->Session->read('User.id');
        $camp_ids = $this->Camp->recoverCamps($user_id);

        if(!$this->_isInCamps($id,$camp_ids))
        {
            throw new Exception('cet id n\'est pas le votre : '.$id);
        }

        $this->Session->write('Camp.current',$id);
        return $this->redirect(array('controller'=>'camps','action' => 'actual'));
    }

    /**
     * @param $id
     * @param $data
     *
     * @return bool
     */
    private function _isInCamps($id,$data)
    {
        foreach($data as $camp)
        {
            if($camp['Camp']['id'] == $id)
                return true;
        }
        return false;
    }

/**
*	edit method
* Editer le nom du camp
* 
* @param int id s:camp_id
* @param string camp_name p:camp_name
* @return void
*/
	public function edit()
    {
        if($this->request->is('post'))
        {
            if(!isset($this->request->data['Camp']['name']))
            {
                throw new NotImplementedException('Bad arguments in POST');
            }

            $query['Camp'] = array('name' => $this->request->data['Camp']['name']);
            $query['Camp']['id'] = $this->Session->read('Camp.current');

            $data = $this->Camp->recoverCamps($this->Session->read('User.id'));
            $id = $query['Camp']['id'];

            if (!$this->_isInCamps($id,$data)) {
                throw new NotFoundException(__('This camp_id isn\'t yours'));
            }

            $this->Camp->id = $query['Camp']['id'];
            $this->Camp->save($query);

            return $this->redirect(array('controller'=>'camps','action' => 'actual'));
        }
	}


/**
*	delete method
* Supprimer un camp 
* 
* @param int id s:camp_id
* @return void
*/
	public function delete($id = null){
		
	}
	


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Camp->recursive = 0;
		$this->set('camps', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Camp->exists($id)) {
			throw new NotFoundException(__('Invalid camp'));
		}
		$options = array('conditions' => array('Camp.' . $this->Camp->primaryKey => $id));
		$this->set('camp', $this->Camp->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Camp->create();
			if ($this->Camp->save($this->request->data)) {
				$this->Session->setFlash(__('The camp has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The camp could not be saved. Please, try again.'));
			}
		}
		$worlds = $this->Camp->World->find('list');
		$users = $this->Camp->User->find('list');
		$resources = $this->Camp->Resource->find('list');
		$this->set(compact('worlds', 'users', 'resources'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Camp->exists($id)) {
			throw new NotFoundException(__('Invalid camp'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Camp->save($this->request->data)) {
				$this->Session->setFlash(__('The camp has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The camp could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Camp.' . $this->Camp->primaryKey => $id));
			$this->request->data = $this->Camp->find('first', $options);
		}
		$worlds = $this->Camp->World->find('list');
		$users = $this->Camp->User->find('list');
		$resources = $this->Camp->Resource->find('list');
		$this->set(compact('worlds', 'users', 'resources'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Camp->id = $id;
		if (!$this->Camp->exists()) {
			throw new NotFoundException(__('Invalid camp'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Camp->delete()) {
			$this->Session->setFlash(__('The camp has been deleted.'));
		} else {
			$this->Session->setFlash(__('The camp could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

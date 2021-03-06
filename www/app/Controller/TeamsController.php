<?php
App::uses('AppController', 'Controller');
/**
 * Teams Controller
 *
 * @property Team $Team
 * @property PaginatorComponent $Paginator
 */
class TeamsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Session');


/**
 * index method
 *	Page d'aceuil de l'équipe
 *
 * @param int $team_id
 * @param int $_SESSION['team_id']
 * @return void
 */
	public function index($team_id = null) {
	
	}


/**
 * editUsers method
 * Edition des membres de l'équipe par un admin
 *
 * @param int $team_id
 * @param int $_SESSION['user_id']
 * @return void
 */
	public function editUsers($team_id = null) {
	
	}

/**
 * edit method
 *	Editer l'équipe
 *
 * @param int $team_id
 * @return void
 */
	public function edit($team_id = null) {
		
	}



/**
 * delete method
 *	Supprimer l'équipe (par un admin )
 *
 * @param int $team_id
 * @return void
 */



/**
 * editUser method
 *	Editer le rôle de l'utilisateur dans l'équipe
 *
 * @param int $user_id
 * @param int $_SESSION['team_id']
 * @return void
 */
	public function editUser($user_id = null) {
		
	}

/**
 * deleteUser method
 *	Supprime un utilisateur de l'équipe
 *
 * @param int $user_id
 * @param int $_SESSION['team_id']
 * @return void
 */
	public function deleteUser($user_id = null) {
		
	}

/**
 * invitUser method
 *	Inviter un utilisateur a rejoindre l'équipe
 *
 * @param int $_SESSION['team_id']
 * @param int $_POST['user_id']
 * @return void
 */
	public function invitUser() {
		
	}


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Team->recursive = 0;
		$this->set('teams', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Team->exists($id)) {
			throw new NotFoundException(__('Invalid team'));
		}
		$options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
		$this->set('team', $this->Team->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {

            $this->Session->write('User.id','2');
            debug($this->Session->read('User.id'));
            debug($this->request->data);
             $tmp =   $this->request->data['Team'];
            $d['Team']['name'] = $tmp['name'];
            $d['Team']['description'] = $tmp['desc'];
            $d['Team']['tag'] = $tmp['tag'];
            $d['Team']['rank_pts'] = $d['Team']['rank_units'] = $d['Team']['rank_biskanah'] = 0;

            $this->Team->create();
			if ($this->Team->generate($this->Session->read('User.id'),$d)) {
                $this->loadModel('User');

                $this->User->UpdateTeam($this->Session->read('User.id'),$this->Team->id);
				$this->Session->setFlash(__('The team has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Team->exists($id)) {
			throw new NotFoundException(__('Invalid team'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Team->save($this->request->data)) {
				$this->Session->setFlash(__('The team has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
			$this->request->data = $this->Team->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Team->id = $id;
		if (!$this->Team->exists()) {
			throw new NotFoundException(__('Invalid team'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Team->delete()) {
			$this->Session->setFlash(__('The team has been deleted.'));
		} else {
			$this->Session->setFlash(__('The team could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

<?php
App::uses('AppController', 'Controller');
/**
 * Buildings Controller
 *
 * @property Building $Building
 * @property PaginatorComponent $Paginator
 */
class BuildingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
* index method
* Affiche un bâtiment
*
* @param int $_POST['building_id']
* @param int $_SESSION['camp_id']
* @return void
*/
	public function index() {

	}

/**
* create method
* Créer un bâtiment de niveau 0 dans Building
*
* @param int $_POST['camp_id']
* @param int $_POST['type']
* @param int $_POST['field']
* @param int $_POST['level']
* @return void
*/
	public function create() {
        if($this->request->is('post')){

            //$query tableau de request

            $query['Building'] = array(
                'databuilding_id' => $this->request->data['Building']['databuilding_id'],
                'field' => $this->request->data['Building']['field']
            );
            if(isset($this->request->data['Building']['camp_id'])){
                $query['Building']['camp_id'] = $this->request->data['Building']['camp_id'];
            }else{
                $query['Building']['camp_id'] = $this->Session->read('Camp.current');
            }

            //récupère dans $data['Camp'] les infos du camp courant

            $this->loadModel('Camp');

            $data = $this->Camp->find('first', array(
                'conditions' => array('Camp.id' => $query['Building']['camp_id'])
            ));

            foreach($data['Building'] as $building){
                if($building['field'] == $query['Building']['field']){
                    throw new NotImplementedException('Il existe déjà un batiment construit sur le field');
                }
            }

            //récupère dans $data['Databuilding'] les infos du batiment à construire

            $this->loadModel('Databuilding');

            $tmp = $this->Databuilding->find('first', array(
                'conditions' => array('id' => $query['Building']['databuilding_id'])
            ));
            $data['Databuilding'] = $tmp['Databuilding'];
            unset($tmp);

            if($data['Databuilding']['lvl'] != 1){
                throw new NotImplementedException('Le batiment demandé est de niveau !=1');
            }
            //debug($data);die();
            if(!$this->enoughResources($data['Resource'],$data['Databuilding'])){
                throw new NotImplementedException('Pas assez de ressources dispo');
            }else{

                $this->loadModel('Building');
                $this->Building->save(array(
                    'camp_id' => $data['Camp']['id'],
                    'field' => $query['Building']['field'],
                    'databuilding_id' => $query['Building']['databuilding_id']-1 // id_building level(0) = (id_building level(1) - 1)
                ));


                $this->loadModel('Dtbuilding');
                $this->Dtbuilding->save(array(
                    'building_id' => $this->Building->id,
                    'begin' => time(),
                    'finish' => (time()+ $data['Databuilding']['time'])
                ));


                $this->loadModel('Resource');
                $this->Resource->updateAll(
                    array(
                        'res1' => $data['Resource']['res1'],
                        'res2' => $data['Resource']['res2'],
                        'res3' => $data['Resource']['res3']
                    ),
                    array('id' => $data['Resource']['id'])
                );
            }

            debug($data);die();

            /* verif :
                si assez d'argent on tax'
            crée DTBuilding
            save Building*/

        }
	}

    private function enoughResources(&$Resource, &$Data){
        if( ($new['res1'] = $Resource['res1'] - $Data['res1']) >= 0)
            if( ($new['res2'] = $Resource['res2'] - $Data['res2']) >= 0)
                if( ($new['res3'] = $Resource['res3'] - $Data['res3']) >= 0){
                  $Resource['res1'] = $new['res1'];
                  $Resource['res2'] = $new['res2'];
                  $Resource['res3'] = $new['res3'];
                  return true;
                }
        return false;
    }

/**
* upgrade method
* Améliorer le niveau d'un bâtiment
*
* @param int $_POST['building_id']
* @param int $_SESSION['camp_id']
* @return void
*/
	public function upgrade() {

	}

/**
* destroy method
* Detruire un bâtiment
*
* @param int $_POST['building_id']
* @return void
*/
	public function destroy() {

	}

/**
* destroy method
* Annule la construction d'un bâtiment
*
* @param int $_POST['building_id']
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
		$this->Building->recursive = 0;
		$this->set('buildings', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Building->exists($id)) {
			throw new NotFoundException(__('Invalid building'));
		}
		$options = array('conditions' => array('Building.' . $this->Building->primaryKey => $id));
		$this->set('building', $this->Building->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Building->create();
			if ($this->Building->save($this->request->data)) {
				$this->Session->setFlash(__('The building has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The building could not be saved. Please, try again.'));
			}
		}
		$camps = $this->Building->Camp->find('list');
		$this->set(compact('camps'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Building->exists($id)) {
			throw new NotFoundException(__('Invalid building'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Building->save($this->request->data)) {
				$this->Session->setFlash(__('The building has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The building could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Building.' . $this->Building->primaryKey => $id));
			$this->request->data = $this->Building->find('first', $options);
		}
		$camps = $this->Building->Camp->find('list');
		$this->set(compact('camps'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Building->id = $id;
		if (!$this->Building->exists()) {
			throw new NotFoundException(__('Invalid building'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Building->delete()) {
			$this->Session->setFlash(__('The building has been deleted.'));
		} else {
			$this->Session->setFlash(__('The building could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}

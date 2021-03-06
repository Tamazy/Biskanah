<?php
App::uses('AppModel', 'Model');
/**
 * Resource Model
 *
 * @property A2b $A2b
 * @property Assist $Assist
 * @property Camp $Camp
 */
class Resource extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'res1' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'res2' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'res3' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'A2b' => array(
			'className' => 'A2b',
			'foreignKey' => 'resource_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Assist' => array(
			'className' => 'Assist',
			'foreignKey' => 'resource_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Camp' => array(
			'className' => 'Camp',
			'foreignKey' => 'resource_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

    public function generateFirst(){
        return $this->generate(500,300,50);
    }

    public function generate($res1,$res2,$res3){
        $d['Resource']['res1'] = $res1;
        $d['Resource']['res2'] = $res2;
        $d['Resource']['res3'] = $res3;
        $this->save($d['Resource']);
        return $this->id;
    }

}

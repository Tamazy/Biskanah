<?php
App::uses('AppModel', 'Model');
/**
 * A2bsUnit Model
 *
 * @property A2b $A2b
 * @property Unit $Unit
 */
class A2bsUnit extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'a2b_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'unit_id' => array(
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'A2b' => array(
			'className' => 'A2b',
			'foreignKey' => 'a2b_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Unit' => array(
			'className' => 'Unit',
			'foreignKey' => 'unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

<?php
App::uses('AppModel', 'Model');
/**
 * Building Model
 *
 * @property Camp $Camp
 * @property Dtbuilding $Dtbuilding
 * @property Dttechno $Dttechno
 * @property Dtunit $Dtunit
 */
class Building extends AppModel {

    public $actsAs = array('Data');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'camp_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'type' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lvl' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'field' => array(
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
		'Camp' => array(
			'className' => 'Camp',
			'foreignKey' => 'camp_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Dtbuilding' => array(
			'className' => 'Dtbuilding',
			'foreignKey' => 'building_id',
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
		'Dttechno' => array(
			'className' => 'Dttechno',
			'foreignKey' => 'building_id',
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
		'Dtunit' => array(
			'className' => 'Dtunit',
			'foreignKey' => 'building_id',
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


    /**
     * Retourne la liste des buildings indexés par type
     *
     * @param $camp_id
     *
     * @return mixed
     */
    public function findByCampId($camp_id)
    {
        $tmp = $this->find('all',array(
            'recursive' => -1,
            'conditions' => array(
                'Building.camp_id' => $camp_id
            )
        ));

        if (empty($tmp))
            return $tmp;

        foreach ($tmp as $k=>$v)
        {
            $v = $v['Building'];
            $type = $v['databuilding_id'];
            $rslt[$type]['Building'] = $v;
        }

        return $rslt;

    }

    public function findById($id)
    {
        $tmp = $this->find('first',array(
            'recursive' => -1,
            'conditions' => array(
                'Building.id' => $id
            )
        ));

        if(empty($tmp))
            return $tmp;

        return $tmp['Building'];
    }

}

<?php
App::uses('AppModel', 'Model');
/**
 * Techno Model
 *
 * @property User $User
 * @property Dttechno $Dttechno
 */
class Techno extends AppModel {

    public $actsAs = array('Data');
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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
		'Dttechno' => array(
			'className' => 'Dttechno',
			'foreignKey' => 'techno_id',
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
     * Renvoie une liste de technologies indexés par type
     *
     * @param $user_id
     *
     * @return mixed
     */
    public function findByUserId($user_id,$databuilding_id=null)
    {
        $condition = '1 = 1';

        if ($databuilding_id != null)
        {
            $condition = 'Techno.datatechno_id ';
            $condition .= ($databuilding_id == 11 ? '<= 11' : '> 11');
        }

        $tmp = $this->find('all',array(
            'recursive' => -1,
            'conditions' => array(
                'Techno.user_id' => $user_id,
                $condition
            )
        ));

        if (empty($tmp))
            return $tmp;

        foreach ($tmp as $k=>$v)
        {
            $v = current($v);
            $type = $v['datatechno_id'];
            $rslt[$type]['Techno'] = $v;
        }

        return $rslt;
    }

    public function findById($id){
        $tmp = $this->find('first',array(
            'recursive' => -1,
            'conditions' => array(
                'Techno.id' => $id
            )
        ));
        if(empty($tmp))
            return $tmp;
        return $tmp['Techno'];
    }

}

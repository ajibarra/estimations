<?php
App::uses('AppModel', 'Model');
/**
 * Project Model
 *
 * @property Client $Client
 * @property Estimation $Estimation
 */
class Project extends AppModel {

	const CREATED = 'CREATED';
	const OPEN = 'OPEN';
	const ESTIMATION_SENT = 'ESTIMATION_SENT';
	const DELIVERED = 'DELIVERED';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'client_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'client_id',
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
		'Estimation' => array(
			'className' => 'Estimation',
			'foreignKey' => 'project_id',
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

	public function getFinalEstimations($id) {
		$estimations = $this->Estimation->find('all', array(
			'conditions' => array(
				'project_id' => $id
			)
		));
		$teamEstimations = array();
		foreach ($estimations as $estimation) {
			//=ROUNDUP(((1 * C2) + (4 * D2) + (1 * E2)) / 6)
			$teamEstimations[] = round((( 1 * $estimation['Estimation']['optimistic']) + (4 * $estimation['Estimation']['likely']) + (1 * $estimation['Estimation']['pessimistic'])) / 6);
		}
		$finalEstimations['optimistic'] =  min($teamEstimations);
		rsort($teamEstimations); //Sorting to calculate median
		$mid = (count($teamEstimations) / 2);//Median index 
		$median = ($mid % 2 != 0) ? $teamEstimations[$mid-1] : (($teamEstimations[$mid-1]) + $teamEstimations[$mid]) / 2;
		$finalEstimations['most_likely'] = ($median + max($teamEstimations)) / 2;
		$finalEstimations['pessimistic'] = max($teamEstimations);
		$finalEstimations['final_estimation'] = round((( 1 * $finalEstimations['optimistic']) + (4 * $finalEstimations['most_likely']) + (1 * $finalEstimations['pessimistic'])) / 6);
		return $finalEstimations;
		
	}
}

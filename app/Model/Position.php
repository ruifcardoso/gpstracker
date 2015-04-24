<?php
App::uses('AppModel', 'Model');
App::uses('Sanitize', 'Utility'); // <---
App::uses('JsBaseEngineHelper', 'View/Helper'); // <---
/**
 * Position Model
 *
 * @property Element $Element
 */
class Position extends AppModel {

	public $components = array('Paginator');
	public function getPositions(){
		$listPositions = $this->find("all", array(
				'fields'=>array('id','lat','long','time','tElement.description','speed'),
				'joins' => array(
							array('table' => 'elements',
									'alias' => 'tElement',
									'type' => 'INNER',
									'conditions' => array('tElement.id = Position.element_id')
							)),
				'order' => array('time' => 'desc'),
				'limit' => 10
		));
		/*echo "<pre>";
		print_r($listPositions);
		echo "</pre>";*/
				
		//var_dump($test);
		
		return $listPositions;
		
	}
	
	public function searchElement(){
		$input = NULL;
		$data = array();
		
		$this->recursive = 0;
		
		$options = array(
				'fields' => array('id','time','lat','long','speed','address','created','modified','element_id','Element.description'),
				'order' => array('time' => 'DESC'),
				'conditions' => array('Element.description LIKE' => '%'.Sanitize::clean($_GET["name"]).'%'),
		);
		
		$this->Paginator->settings = $options;
		
		$result = $this->Paginator->paginate ('Position');
		
		//$input = $_GET["name"];
		//$jquerycallback = $_GET["callback"];
		
		$data['teste'] = array("ola"=>'adeus');
		
		echo json_encode(Sanitize::clean($_GET["name"]));
		
	}
	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'element_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'time' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lat' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'long' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'speed' => array(
				'numeric' => array(
						'rule' => array('numeric'),
						//'message' => 'Your custom message here',
						//'allowEmpty' => false,
						//'required' => false,
						//'last' => false, // Stop validation after this rule
						//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
		),
		'address' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
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
		'Element' => array(
			'className' => 'Element',
			'foreignKey' => 'element_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

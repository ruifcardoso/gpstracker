<?php
App::uses ( 'AppModel', 'Model', 'AuthComponent', 'Controller/Component');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * User Model
 *
 * @property Group $Group
 */
class User extends AppModel {
	public $actsAs = array (
			'Acl' => array (
					'type' => 'requester',
					'enabled' => false 
			) 
	);
	public function bindNode($user) {
		return array (
				'model' => 'Group',
				'foreign_key' => $user ['User'] ['group_id'] 
		);
	}
	public function parentNode() {
		if (! $this->id && empty ( $this->data )) {
			return null;
		}
		if (isset ( $this->data ['User'] ['group_id'] )) {
			$groupId = $this->data ['User'] ['group_id'];
		} else {
			$groupId = $this->field ( 'group_id' );
		}
		if (! $groupId) {
			return null;
		}
		return array (
				'Group' => array (
						'id' => $groupId 
				) 
		);
	}
	public function beforeSave($options = array()) {
		if (isset ( $this->data [$this->alias] ['password'] )) {
			$this->data [$this->alias] ['password'] = Security::hash($this->data [$this->alias] ['password'], 'md5');
				
			//$this->data [$this->alias] ['password'] = Security::hash($this->data [$this->alias] ['password'], 'blowfish');
			//$passwordHasher = new BlowfishPasswordHasher ();
			//$this->data [$this->alias] ['password'] = $passwordHasher->hash ( $this->data [$this->alias] ['password'] );
		}
		return true;
	}
	
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array (
			'username' => array (
					'notEmpty' => array (
							'rule' => array (
									'notEmpty' 
							) 
					// 'message' => 'Your custom message here',
					// 'allowEmpty' => false,
					// 'required' => false,
					// 'last' => false, // Stop validation after this rule
					// 'on' => 'create', // Limit validation to 'create' or 'update' operations
										) 
			),
			'password' => array (
					'notEmpty' => array (
							'rule' => array (
									'notEmpty' 
							) 
					// 'message' => 'Your custom message here',
					// 'allowEmpty' => false,
					// 'required' => false,
					// 'last' => false, // Stop validation after this rule
					// 'on' => 'create', // Limit validation to 'create' or 'update' operations
										) 
			),
			'group_id' => array (
					'numeric' => array (
							'rule' => array (
									'numeric' 
							) 
					// 'message' => 'Your custom message here',
					// 'allowEmpty' => false,
					// 'required' => false,
					// 'last' => false, // Stop validation after this rule
					// 'on' => 'create', // Limit validation to 'create' or 'update' operations
										) 
			) 
	);
	
	// The Associations below have been created with all possible keys, those that are not needed can be removed
	
	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array (
			'Group' => array (
					'className' => 'Group',
					'foreignKey' => 'group_id',
					'conditions' => '',
					'fields' => '',
					'order' => '' 
			) 
	);
}

<?php
App::uses ( 'AppController', 'Controller' );
App::uses ( 'AuthComponent', 'Controller/Component' );

/**
 * Elements Controller
 *
 * @property Element $Element
 * @property PaginatorComponent $Paginator
 */
class ElementsController extends AppController {
	
	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array (
			'Paginator' 
	);
	
	/**
	 * index method
	 *
	 * @return void
	 */
	public function api_index() {
		if ($this->viewVars ['api_allowed']) {
			return $this->index();
		}
	}
	public function index() {
		$this->Element->recursive = 0;
		$this->set ( 'elements', $this->Paginator->paginate () );
		$this->set ( '_serialize', 'elements' );
	}
	public function beforeFilter() {
		parent::beforeFilter ();
		
		// For CakePHP 2.1 and up
		if(isset($this->viewVars['api_allowed']) && $this->viewVars['api_allowed'] == true ){
			$this->Auth->allow ();
		}
		/*
		 * if (isset ( $this->request->params ['ext'] ) && $this->request->params ['ext'] == 'json') { $this->Auth->authenticate = array (	'Basic'	); $json = $this->request->input ( 'json_decode', true) ; if($json && isset($json['User']['token']) && isset($json['User']['username'])){ $user_exists = $this->User->find ( 'count', array ( 'conditions' => array ( 'User.username' => $json['User']['username'], 'User.api_token' => $json['User']['token'] ) ) ); if ($user_exists == true) { // should check ACL permissions $this->set('allowed', true); $this->Auth->allow ('api_view'); } else { $this->response->statusCode ( 200 ); $this->set ( array ( 'message' => array ( 'text' => __ ( 'Wrong authentification.' ), 'type' => 'error' ), '_serialize' => array ( 'message' ) ) ); $this->set('allowed', false); return; } } else { if ($this->params ['controllers'] != 'users') { $this->response->statusCode ( 200 ); $this->set ( array ( 'message' => array ( 'text' => __ ( 'Wrong authentification.' ), 'type' => 'error' ), '_serialize' => array ( 'message' ) ) ); } $this->set('allowed', false); return; } }
		 */
	}
	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id        	
	 * @return void
	 */
	
	public function view($id = null) {
		if (! $this->Element->exists ( $id )) {
			throw new NotFoundException ( __ ( 'Invalid element id' ) );
		}
		$options = array (
				'conditions' => array (
						'Element.' . $this->Element->primaryKey => $id 
				),
				'recursive' => 0 
		);
		$this->set ( array (
				'element' => $this->Element->find ( 'first', $options ),
				'_serialize' => array (
						'element' 
				) 
		) );
	}
	
	public function api_view() {
		if ($this->viewVars ['api_allowed'] && isset ( $this->viewVars ['api_json'] )) {
			if (isset ( $this->viewVars ['api_json'] ['Data'] ['Element'] ['id'] )) {
				$id = $this->viewVars ['api_json'] ['Data'] ['Element'] ['id'];
				return $this->view ( $id );
			} else {
				return $this->view ( null );
			}
		}
		// caso chegue até aqui, significa que ocorreu inicialmente algum erro;
	}
	
	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is ( 'post' )) {
			$this->Element->create ();
			if ($this->Element->save ( $this->request->data )) {
				var_dump ( $this->request->data );
				$this->Session->setFlash ( __ ( 'The element has been saved.' ) );
				/*
				 * return $this->redirect ( array ( 'action' => 'index' ) );
				 */
			} else {
				$this->Session->setFlash ( __ ( 'The element could not be saved. Please, try again.' ) );
			}
		}
	}
	public function api_add() {
		if ($this->viewVars ['api_allowed'] && isset ( $this->viewVars ['api_json'] )) {
			$newelement = $this->viewVars ['api_json'] ['Data'] ['Element'];
			$this->Element->create ();
			foreach ( $this->Element->_schema as $fieldname => $details ) {
				$this->request->data [$fieldname] = isset ( $newelement [$fieldname] ) ? $newelement [$fieldname] : '';
			}
			unset ( $this->request->data ['created'] );
			unset ( $this->request->data ['modified'] );
			if ($this->Element->save ( $this->request->data )) {
				$newelement ['id'] = $this->Element->getLastInsertID ();
				$this->response->statusCode ( 200 );
				$this->set ( array (
						'Message' => array (
								'text' => __ ( 'New element saved with id ' . $this->Element->getLastInsertID () ),
								'type' => 'success' 
						),
						'Element' => $newelement,
						'_serialize' => array (
								'Message',
								'Element' 
						) 
				) );
			} else {
				$this->response->statusCode ( 200 );
				$this->set ( array (
						'Message' => array (
								'text' => __ ( 'Error occurred while saving new element.' ),
								'type' => 'error' 
						),
						'_serialize' => array (
								'Message' 
						) 
				) );
			}
		}
	}
	
	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id        	
	 * @return void
	 */
	public function api_edit() {
		if ($this->viewVars ['api_allowed'] && isset ( $this->viewVars ['api_json'] )) {
			$newelement = $this->viewVars ['api_json'] ['Data'] ['Element'];
			$this->Element->create ();
			if ($this->Element->exists ( $newelement ['id'] )) {
				foreach ( $this->Element->_schema as $fieldname => $details ) {
					if (isset ( $newelement [$fieldname] )) {
						$this->request->data [$fieldname] = $newelement [$fieldname];
					}
				}
				unset ( $this->request->data ['created'] );
				unset ( $this->request->data ['modified'] );
				if ($this->Element->save ( $this->request->data )) {
					$newelement ['id'] = $this->Element->id;
					$this->response->statusCode ( 200 );
					$this->set ( array (
							'Message' => array (
									'text' => __ ( 'Element ' . $this->Element->id . ' successfully edited' ),
									'type' => 'success' 
							),
							'Element' => $newelement,
							'_serialize' => array (
									'Message',
									'Element' 
							) 
					) );
				} else {
					$this->response->statusCode ( 200 );
					$this->set ( array (
							'Message' => array (
									'text' => __ ( 'Error occurred while editing element.' ),
									'type' => 'error' 
							),
							'_serialize' => array (
									'Message' 
							) 
					) );
				}
			}
		}
	}
	
	public function edit($id = null) {
		if (! $this->Element->exists ( $id )) {
			throw new NotFoundException ( __ ( 'Invalid element' ) );
		}
		if ($this->request->is ( array (
				'post',
				'put' 
		) )) {
			if ($this->Element->save ( $this->request->data )) {
				$this->Session->setFlash ( __ ( 'The element has been saved.' ) );
				return $this->redirect ( array (
						'action' => 'index' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'The element could not be saved. Please, try again.' ) );
			}
		} else {
			$options = array (
					'conditions' => array (
							'Element.' . $this->Element->primaryKey => $id 
					) 
			);
			$this->request->data = $this->Element->find ( 'first', $options );
		}
	}
	
	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id        	
	 * @return void
	 */
	public function api_delete() {
		if ($this->viewVars ['api_allowed'] && isset ( $this->viewVars ['api_json'] )) {
			if (isset ( $this->viewVars ['api_json'] ['Data'] ['Element'] ['id'] )) {
				$id = $this->viewVars ['api_json'] ['Data'] ['Element'] ['id'];
				$this->Element->id = $id;
				if ($this->Element->delete ()) {
					$this->response->statusCode ( 200 );
					$this->set ( array (
							'Message' => array (
									'text' => __ ( 'Element ' . $id . ' successfully deleted.' ),
									'type' => 'success' 
							),
							'_serialize' => array (
									'Message' 
							) 
					) );
				} else {
					$this->response->statusCode ( 200 );
					$this->set ( array (
							'Message' => array (
									'text' => __ ( 'Element ' . $id . ' couldn\'t be deleted.' ),
									'type' => 'error' 
							),
							'_serialize' => array (
									'Message' 
							) 
					) );
				}
			} else {
				$this->response->statusCode ( 200 );
				$this->set ( array (
						'Message' => array (
								'text' => __ ( 'Invalid element id.' ),
								'type' => 'error' 
						),
						'_serialize' => array (
								'Message' 
						) 
				) );
			}
		}
	}
	
	public function delete($id = null) {
		$this->Element->id = $id;
		if (! $this->Element->exists ()) {
			throw new NotFoundException ( __ ( 'Invalid element' ) );
		}
		if ($this->Element->delete ()) {
			$this->Session->setFlash ( __ ( 'The element has been deleted.' ) );
		} else {
			$this->Session->setFlash ( __ ( 'The element could not be deleted. Please, try again.' ) );
		}
		return $this->redirect ( array (
				'action' => 'index' 
		) );
	}
}

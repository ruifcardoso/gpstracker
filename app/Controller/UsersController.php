<?php
App::uses ( 'AppController', 'Controller' );
App::uses ( 'BlowfishPasswordHasher', 'Controller/Component/Auth' );

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {
	
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
	public function index() {
		$this->User->recursive = 0;
		$this->set ( 'users', $this->Paginator->paginate () );
		var_dump ( AuthComponent::user ( 'id' ) );
	}
	public function beforeFilter() {
		parent::beforeFilter ();
		
		$this->Auth->allow ('login', 'add');
		if (isset ( $this->request->params ['ext'] ) && $this->request->params ['ext'] == 'json') {
			$this->Auth->allow ('api_login', 'api_add');
		}
		//$this->initDB();
		//$this->Auth->allow('initDB');	
	}
	/*public function initDB() {
		$group = $this->User->Group;
		
		// Allow admins to everything
		$group->id = 1;
		$this->Acl->allow ( $group, 'controllers' );
		
		// allow managers to posts and widgets
		$group->id = 2;
		$this->Acl->deny ( $group, 'controllers' );
		$this->Acl->allow ( $group, 'controllers/Elements' );
		$this->Acl->allow ( $group, 'controllers/Positions' );
		$this->Acl->allow ( $group, 'controllers/Users' );
		$this->Acl->allow ( $group, 'controllers/Homepages' );
		
		
		// allow users to only add and edit on posts and widgets
		$group->id = 3;
		$this->Acl->deny ( $group, 'controllers' );
		$this->Acl->allow ( $group, 'controllers/Elements/add' );
		$this->Acl->allow ( $group, 'controllers/Elements/edit' );
		$this->Acl->allow ( $group, 'controllers/Positions/add' );
		$this->Acl->allow ( $group, 'controllers/Positions/edit' );
		$this->Acl->allow ( $group, 'controllers/Homepages' );
		
		// allow basic users to log out
		$this->Acl->allow ( $group, 'controllers/users/logout' );
		
		// we add an exit to avoid an ugly "missing views" error message
		echo "all done";
		die("morreu");
		
		exit ();
	}*/
	
	public function api_login() {
		if (isset ( $this->request->params ['ext'] ) && $this->request->params ['ext'] == 'json') {
			$this->Auth->authenticate = array (
					'Basic'
			);
			if($this->viewVars['api_allowed']){
				$json = $this->viewVars['api_json'];
				$username = $json['Data']['User']['username'];
				$token = $json['Data']['User']['token'];
				
				$this->response->statusCode ( 200 );
				$this->set ( array (
						'Message' => array (
								'text' => __ ( 'Welcome ' . $username . '. You are now logged in.' ),
								'type' => 'success'
						),
						'User' => array (
								'username' => $username,
								'token' =>  $token
						),
						'_serialize' => array (
								'Message',
								'User'
						)
				) );
			}else{
				if(!$this->viewVars['api_badauth']){
					//nao tem token nem tentou fazer login
					if (! isset ( $_SERVER ['PHP_AUTH_USER'] )) {
						header ( 'WWW-Authenticate: Basic realm="My Realm"' );
						header ( 'HTTP/1.0 401 Unauthorized' );
						echo 'Text to send if user hits Cancel button';
						exit ();
					} else {
						$username = $_SERVER ['PHP_AUTH_USER'];
						$password = Security::hash ( $_SERVER ['PHP_AUTH_PW'] );
						$user = $this->User->findByUsernameAndPassword ( $username, $password );
						if ($user) {
							unset ( $user ['User'] ['password'] );
							$this->Auth->login($user['User']);
							$this->User->id = $user ['User'] ['id'];
							CakeSession::renew ();
							$sessionid = CakeSession::id ();
							$this->User->saveField('api_token', $sessionid );
								
							$this->response->statusCode ( 200 );
							$this->set ( array (
									'Message' => array (
										'text' => __ ( 'Welcome ' . $username . '. You are now logged in.' ),
										'type' => 'success' 
									),
									'User' => array (
										'username' => $username,
										'token' => $sessionid
									),
									'_serialize' => array (
											'Message',
											'User'
									)
							) );
							return;
						} else {
							$this->response->statusCode ( 200 );
							$this->set ( array (
									'Message' => array (
											'text' => __ ( 'Invalid login details' ),
											'type' => 'error'
									),
									'_serialize' => array (
											'Message'
									)
							) );
							return;
						}
					}
				}
			}
		}
	}
	

	public function login() {
		Security::setHash('md5');
		
		if ($this->Session->read ( 'Auth.User' )) {
			$this->Session->setFlash ( 'You are logged in!' );
			return $this->redirect ( $this->Auth->redirectUrl () );
		}
		if ($this->request->is ( 'post' )) {
			if ($this->Auth->login ()) {
				$this->Session->setFlash ( "You are now logged in" );
				return $this->redirect ( $this->Auth->redirectUrl () );
			} else {
				$this->Session->setFlash ( __ ( 'Your username or password was incorrect.' ) );
			}
		}
	}
	
	/*
	 * Logout method
	 * 
	 */
	
	public function api_logout() {
		$this->Session->destroy();
		if($this->Cookie){
			$this->Cookie->destroy();
		}
		$this->response->statusCode ( 200 );
		$this->set ( array (
				'Message' => array (
						'text' => __ ( 'Your session has been destroyed' ),
						'type' => 'success'
				),
				'_serialize' => array (
						'Message'
				)
		) );
		return;
	}
	
	public function logout() {
		$this->Session->setFlash ( 'Session terminated' );
		$this->redirect ( $this->Auth->logout () );
	}
	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id        	
	 * @return void
	 */
	public function view($id = null) {
		if (! $this->User->exists ( $id )) {
			throw new NotFoundException ( __ ( 'Invalid user' ) );
		}
		$options = array (
				'conditions' => array (
						'User.' . $this->User->primaryKey => $id 
				) 
		);
		$this->set ( 'user', $this->User->find ( 'first', $options ) );
	}
	
	/**
	 * add method
	 *
	 * @return void
	 */
	
	public function api_add() {
		$this->User->create ();
		$json = $this->request->input ( 'json_decode', true);
		if(isset($json['Data']['User']['username']) && isset($json['Data']['User']['password'])){
			$this->request->data ['username'] = $json['Data']['User']['username'];
			$this->request->data ['password'] = $json['Data']['User']['password'];
			if(isset($json['Data']['User']['group_id'])){
				$this->request->data ['group_id'] = $json['Data']['User']['group_id'];
			}
			if ($this->User->save ( $this->request->data )) {
				$this->response->statusCode ( 200 );
				$this->set ( array (
						'Message' => array (
								'text' => __ ( 'New user successfully created.' ),
								'type' => 'success'
						),
						'_serialize' => array (
								'Message'
						)
				) );
			}else{
				$this->response->statusCode ( 200 );
				$this->set ( array (
						'Message' => array (
								'text' => __ ( 'Error occurred while creating a new user.' ),
								'type' => 'error'
						),
						'_serialize' => array (
								'Message'
						)
				) );
			}
		}else{
			$this->response->statusCode ( 200 );
			$this->set ( array (
					'Message' => array (
							'text' => __ ( 'Invalid user information passed.' ),
							'type' => 'error'
					),
					'_serialize' => array (
							'Message'
					)
			) );
		}

	}
	public function add() {
		if ($this->request->is ( 'post' )) {
			$this->User->create ();
			if ($this->User->save ( $this->request->data )) {
				$this->Session->setFlash ( __ ( 'The user has been saved.' ) );
				return $this->redirect ( array (
						'action' => 'login' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'The user could not be saved. Please, try again.' ) );
			}
		}
		$groups = $this->User->Group->find ( 'list' );
		$this->set ( compact ( 'groups' ) );
	}
	
	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id        	
	 * @return void
	 */
	public function edit($id = null) {
		if (! $this->User->exists ( $id )) {
			throw new NotFoundException ( __ ( 'Invalid user' ) );
		}
		if ($this->request->is ( array (
				'post',
				'put' 
		) )) {
			if ($this->User->save ( $this->request->data )) {
				$this->Session->setFlash ( __ ( 'The user has been saved.' ) );
				return $this->redirect ( array (
						'action' => 'index' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'The user could not be saved. Please, try again.' ) );
			}
		} else {
			$options = array (
					'conditions' => array (
							'User.' . $this->User->primaryKey => $id 
					) 
			);
			$this->request->data = $this->User->find ( 'first', $options );
		}
		$groups = $this->User->Group->find ( 'list' );
		$this->set ( compact ( 'groups' ) );
	}
	
	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id        	
	 * @return void
	 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (! $this->User->exists ()) {
			throw new NotFoundException ( __ ( 'Invalid user' ) );
		}
		$this->request->allowMethod ( 'post', 'delete' );
		if ($this->User->delete ()) {
			$this->Session->setFlash ( __ ( 'The user has been deleted.' ) );
		} else {
			$this->Session->setFlash ( __ ( 'The user could not be deleted. Please, try again.' ) );
		}
		return $this->redirect ( array (
				'action' => 'index' 
		) );
	}
}

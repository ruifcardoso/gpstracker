<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('AuthComponent', 'Controller/Component');


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array( 'RequestHandler',
		'Acl',
        'Auth' => array(
        	'loginRedirect' => array('controller' => 'homepages', 'action' => 'index'),
        	'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            ),
        	'authenticate' => array(
        			'Form' => array(
        					'passwordHasher' => array(
			                    'className' => 'Simple',
			                    'hashType' => 'md5'
			                )
        			)
        	)
        ),
        'Session'
    );
	
	public $helpers = array('Html', 'Form', 'Session');

	public function beforeFilter() {
			parent::beforeFilter();
			
   			Security::setHash('md5');
			$this->Auth->autoRedirect = false;

			if (isset ( $this->request->params ['ext'] ) && $this->request->params ['ext'] == 'json') {
				$this->Auth->authenticate = array (	'Basic'	);
				$json = $this->request->input ( 'json_decode', true);
				if($json && isset($json['Data']['User']['token']) && isset($json['Data']['User']['username'])){
					$this->loadModel('User');
					$user_exists = $this->User->find ( 'count', array (
							'conditions' => array (
									'User.username' => $json['Data']['User']['username'],
									'User.api_token' => $json['Data']['User']['token']
							)
					) );
					if ($user_exists == true) {
						$this->set('api_allowed', true);
						$this->set('api_json', $json);
						$this->Auth->allow ();
					} else {
						$this->response->statusCode ( 200 );
						$this->set ( array (
								'Message' => array (
										'text' => __ ( 'Wrong authentification.' ),
										'type' => 'error'
								),
								'_serialize' => array (
										'Message'
								)
						) );
						$this->set('api_allowed', false);
						$this->set('api_badauth', true);
					}
				} else {
					if ($this->params ['controllers'] != 'users') {
						$this->response->statusCode ( 200 );
						$this->set ( array (
								'Message' => array (
										'text' => __ ( 'Missing information.' ),
										'type' => 'error'
								),
								'_serialize' => array (
										'Message'
								)
						) );
					}
					$this->set('api_allowed', false);
					$this->set('api_badauth', false);					
				}
			}
		/*if (isset($this->request->params['ext']) && $this->request->params['ext'] == 'json') {
			//var_dump($this->request);
			$this->Auth->authenticate = array('Basic');
			
			/*if($this->Auth->login()){
				$this->loadModel('User');
				$user_exists = $this->User->find('first', array(
						'conditions' => array('User.id' => $this->Auth->user ( 'id' ), 'User.api_token' => CakeSession::id ())
				));
				if($user_exists){
					$this->Auth->allow();
				}else{
					$this->response->statusCode ( 200 );
					$this->set ( array (
							'message' => array (
									'text' => __ ( 'Wrong authentification.' ),
									'type' => 'error'
							),
							'_serialize' => array (
									'message'
							)
					) );
					return;
				}
			}else{
				if(isset($this->params['named']['token'])){
					$this->loadModel('User');
					$user_exists = $this->User->find('first', array(
							'conditions' => array('User.id' => $this->Auth->user ( 'id' ), 'User.api_token' => $this->params['named']['token'])
					));
					if($user_exists){
						$this->Auth->allow();
					}else{
						$this->response->statusCode ( 200 );
						$this->set ( array (
								'message' => array (
										'text' => __ ( 'Wrong authentification.' ),
										'type' => 'error'
								),
								'_serialize' => array (
										'message'
								)
						) );
						return;
					}
				}else{
					if($this->params['controllers'] != 'users'){						
						$this->response->statusCode ( 200 );
						$this->set ( array (
								'message' => array (
										'text' => __ ( 'Wrong authentification.' ),
										'type' => 'error'
								),
								'_serialize' => array (
										'message'
								)
						) );
						$this->render('view');
					}
				}
				
			}*/
			//AuthComponent::$sessionKey = false;
			//if(!$this->Auth->login()){
				/*if (!isset($_SERVER['PHP_AUTH_USER'])) {
					header('WWW-Authenticate: Basic realm="My Realm"');
					header('HTTP/1.0 401 Unauthorized');
					echo 'Text to send if user hits Cancel button';
					exit;
				} else {
					echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
					echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
				}*/
			//}
				
			//var_dump($this->request);
			/*if (!$this->Auth->login()) {
				$data = array (
						'status' => 400,
						'message' => $this->Auth->authError,
				);
				$this->set('Data', $data);
				$this->set('_serialize', 'Data');
			
				$this->viewClass = 'Json';
				$this->render();
			}*/
		//}
		//Configure AuthComponent
		$this->Auth->loginAction = array(
				'controller' => 'users',
				'action' => 'login'
		);
		$this->Auth->logoutRedirect = array(
				'controller' => 'users',
				'action' => 'login'
		);
		$this->Auth->loginRedirect = array(
				'controller' => 'homepages',
				'action' => 'index'
		);		
	}
	
}

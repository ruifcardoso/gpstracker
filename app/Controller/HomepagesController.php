<?php
App::uses('AppController', 'Controller');
/**
 * Homepages Controller
 *
 * @property Homepage $Homepage
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class HomepagesController extends AppController {
	function index () {
		$this->set('listPositions', ClassRegistry::init('Position')->getPositions());
	}
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter() {
		parent::beforeFilter();
		// For CakePHP 2.1 and up
		//$this->Auth->allow('index');
		//var_dump($this->Session->read('Auth.User'));
		
	}
	
	
	public function api_index() {
	if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Text to send if user hits Cancel button';
    exit;
} else {
    echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
    echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
}
	}
}

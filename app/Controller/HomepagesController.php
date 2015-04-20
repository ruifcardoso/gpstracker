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

}

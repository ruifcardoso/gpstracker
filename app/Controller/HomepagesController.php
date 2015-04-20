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
	
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Session->setFlash(__('Your username or password was incorrect.'));
		}
	}
	
	public function logout() {
		//Leave empty for now.
	}
	

}

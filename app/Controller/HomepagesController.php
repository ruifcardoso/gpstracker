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

	

}

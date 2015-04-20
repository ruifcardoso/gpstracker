<?php
App::uses('AppController', 'Controller');
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
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Element->recursive = 0;
		$this->set('elements', $this->Paginator->paginate());
		$this->set('_serialize','elements');
	}

	
	public function beforeFilter() {
		parent::beforeFilter();
	
		// For CakePHP 2.1 and up
    	//$this->Auth->allow('index', 'view');
		}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Element->exists($id)) {
			throw new NotFoundException(__('Invalid element'));
		}
		$options = array('conditions' => array('Element.' . $this->Element->primaryKey => $id));
		$this->set(array('element' => $this->Element->find('first', $options), '_serialize' => array('element')));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Element->create();
			if ($this->Element->save($this->request->data)) {
				$this->Session->setFlash(__('The element has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The element could not be saved. Please, try again.'));
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
	public function edit($id = null) {
		if (!$this->Element->exists($id)) {
			throw new NotFoundException(__('Invalid element'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Element->save($this->request->data)) {
				$this->Session->setFlash(__('The element has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The element could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Element.' . $this->Element->primaryKey => $id));
			$this->request->data = $this->Element->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Element->id = $id;
		if (!$this->Element->exists()) {
			throw new NotFoundException(__('Invalid element'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Element->delete()) {
			$this->Session->setFlash(__('The element has been deleted.'));
		} else {
			$this->Session->setFlash(__('The element could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}

<?php
App::uses('AppController', 'Controller');
/**
 * Positions Controller
 *
 * @property Position $Position
 * @property PaginatorComponent $Paginator
 */
class PositionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler');
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Position->recursive = 0;
		$positions = $this->Position->find('all', array(
				'fields' => array ('id','element_id','time','lat','long','address','created','modified')));
		$this->set('elements', $this->Paginator->paginate());
		
		
		$this->set(array(
				'positions' => $positions,
				'_serialize' => array('positions')
		));
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {	
		if (!$this->Position->exists($id)) {
			throw new NotFoundException(__('Invalid position'));
		}
		$options = array('conditions' => array('Position.' . $this->Position->primaryKey => $id));
		$position = $this->Position->find('first', $options);
		$this->set(array(
				'position' => $position,
				 '_serialize' => 'position'));				
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Position->create();
			if ($this->Position->save($this->request->data)) {
				$this->Session->setFlash(__('The position has been saved.'));				
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The position could not be saved. Please, try again.'));
			}
		}
		$elements = $this->Position->Element->find('list');
		$this->set(array(
				'elements' => $elements,
				 '_serialize' => 'elements'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Position->exists($id)) {
			throw new NotFoundException(__('Invalid position'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Position->save($this->request->data)) {
				$this->Session->setFlash(__('The position has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The position could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Position.' . $this->Position->primaryKey => $id));
			$this->request->data = $this->Position->find('first', $options);
		}
		$elements = $this->Position->Element->find('list');
		$this->set(array(
				'elements' => $elements,
				 '_serialize' => 'elements'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Position->id = $id;
		if (!$this->Position->exists()) {
			throw new NotFoundException(__('Invalid position'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Position->delete()) {
			$this->Session->setFlash(__('The position has been deleted.'));
		} else {
			$this->Session->setFlash(__('The position could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}

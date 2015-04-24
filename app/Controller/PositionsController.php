<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility'); // <---
App::uses('JsBaseEngineHelper', 'View/Helper'); // <---
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
	
	public function searchElement(){
		
		$layout = 'ajax'; //<-- No LAYOUT VERY IMPORTANT!!!!!
		$this->autoRender = false;  // <-- NO RENDER THIS METHOD HAS NO VIEW VERY IMPORTANT!!!!!
		
		$this->Position->recursive = 0;
		
		$options = array(
				'fields' => array('id','time','lat','long','speed','address','created','modified','element_id','Element.description'),
				'order' => array('time' => 'DESC'),
				'conditions' => array('Element.description LIKE' => '%'.Sanitize::clean($_GET["name"]).'%'),
		);
		
		$this->Paginator->settings = $options;
		
		$result = $this->Paginator->paginate ('Position');
		
		//$input = $_GET["name"];
		/*$jquerycallback = $_GET["callback"];
		
		$data['teste'] = array("ola"=>'adeus');
		
		//echo $this->JsBaseEngineHelper->object($result,array('prefix' => $jquerycallback.'({"totalResultsCount": 2,"ajt":','postfix' => '});'));
		$this->set(compact('data'));
		$this->set('_serialize', $data); // Let the JsonView class know what variable to use
		*/
		echo json_encode($result);
	}
	
/**
 * index method
 *
 * @return void
 */
	public function api_index(){
		if ($this->viewVars ['api_allowed']) {
			return $this->index();
		}
	}
	
	public function index() {
		$this->Position->recursive = 0;
		$this->Paginator->settings = array(
				'fields' => array('id','time','lat','long','speed','address','created','modified','element_id','Element.description'),
				'order' => array('time' => 'DESC')
		);
		$this->set ( 'positions', $this->Paginator->paginate () );
		$this->set ( '_serialize', 'positions' );
		
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->Allow('searchElement');
		
		// For CakePHP 2.1 and up
		if(isset($this->viewVars['api_allowed']) && $this->viewVars['api_allowed'] == true ){
			$this->Auth->allow ();
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function api_view() {
		if ($this->viewVars ['api_allowed'] && isset ( $this->viewVars ['api_json'] )) {
			if (isset ( $this->viewVars ['api_json'] ['Data'] ['Position'] ['id'] )) {
				$id = $this->viewVars ['api_json'] ['Data'] ['Position'] ['id'];
			}
			if (!$this->Position->exists($id)) {
				throw new NotFoundException(__('Invalid position'));
			}
			$options = array('conditions' => array('Position.' . $this->Position->primaryKey => $id), 'recursive' => -1);
			$position = $this->Position->find('first', $options);
			$this->set(array(
					'position' => $position,
					'_serialize' => 'position'));
		}
		// caso chegue até aqui, significa que ocorreu inicialmente algum erro;
	}
	
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
	
	public function api_add() {
		if ($this->viewVars ['api_allowed'] && isset ( $this->viewVars ['api_json'] )) {
			$newposition = $this->viewVars ['api_json'] ['Data'] ['Position'];
			$this->Position->create ();
			foreach ( $this->Position->_schema as $fieldname => $details ) {
				$this->request->data [$fieldname] = isset ( $newposition [$fieldname] ) ? $newposition [$fieldname] : '';
			}
			unset ( $this->request->data ['created'] );
			unset ( $this->request->data ['modified'] );
			if ($this->Position->save ( $this->request->data )) {
				$newposition ['id'] = $this->Position->getLastInsertID ();
				$this->response->statusCode ( 200 );
				$this->set ( array (
						'Message' => array (
								'text' => __ ( 'New position saved with id ' . $this->Position->getLastInsertID () ),
								'type' => 'success'
						),
						'Position' => $newposition,
						'_serialize' => array (
								'Message',
								'Position'
						)
				) );
			} else {
				$this->response->statusCode ( 200 );
				$this->set ( array (
						'Message' => array (
								'text' => __ ( 'Error occurred while saving new position.' ),
								'type' => 'error'
						),
						'_serialize' => array (
								'Message'
						)
				) );
			}
		}
	}
	
	public function add() {
		if ($this->request->is('post')) {
			$this->Position->create();
			var_dump($this->request->data);
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
	public function api_edit() {
		if ($this->viewVars ['api_allowed'] && isset ( $this->viewVars ['api_json'] )) {
			$newposition = $this->viewVars ['api_json'] ['Data'] ['Position'];
			$this->Position->create ();
			if ($this->Position->exists ( $newposition ['id'] )) {
				foreach ( $this->Position->_schema as $fieldname => $details ) {
					if (isset ( $newposition [$fieldname] )) {
						$this->request->data [$fieldname] = $newposition [$fieldname];
					}
				}
				unset ( $this->request->data ['created'] );
				unset ( $this->request->data ['modified'] );
				if ($this->Position->save ( $this->request->data )) {
					$newposition ['id'] = $this->Position->id;
					$this->response->statusCode ( 200 );
					$this->set ( array (
							'Message' => array (
									'text' => __ ( 'Position ' . $this->Position->id . ' successfully edited' ),
									'type' => 'success' 
							),
							'Position' => $newposition,
							'_serialize' => array (
									'Message',
									'Position' 
							) 
					) );
				} else {
					$this->response->statusCode ( 200 );
					$this->set ( array (
							'Message' => array (
									'text' => __ ( 'Error occurred while editing position.' ),
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
	public function api_delete() {
		if ($this->viewVars ['api_allowed'] && isset ( $this->viewVars ['api_json'] )) {
			if (isset ( $this->viewVars ['api_json'] ['Data'] ['Position'] ['id'] )) {
				$id = $this->viewVars ['api_json'] ['Data'] ['Position'] ['id'];
				$this->Position->id = $id;
				if ($this->Position->delete ()) {
					$this->response->statusCode ( 200 );
					$this->set ( array (
							'Message' => array (
									'text' => __ ( 'Position ' . $id . ' successfully deleted.' ),
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
									'text' => __ ( 'Position ' . $id . ' couldn\'t be deleted.' ),
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
								'text' => __ ( 'Invalid position id.' ),
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

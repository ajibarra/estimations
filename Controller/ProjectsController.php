<?php
App::uses('AppController', 'Controller');
/**
 * Projects Controller
 *
 * @property Project $Project
 */
class ProjectsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Project->recursive = 0;
		$this->set('projects', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		$this->set('project', $this->Project->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Project->create();
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		}
		$clients = $this->Project->Client->find('list');
		$this->set(compact('clients'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Project->read(null, $id);
		}
		$clients = $this->Project->Client->find('list');
		$this->set(compact('clients'));
	}
	
	public function open($id = null) {
		$project = $this->Project->find('first', array('conditions' => array(
			'Project.id' => $id)));
		$project['Project']['status'] = Project::OPEN;
		if ($this->Project->save($project)) {
			$this->Session->setFlash(__('The project has been opened for estimations'));
		} else {
			$this->Session->setFlash(__('The project could not be opened. Please, try again.'));
		}
		$this->redirect(array('action' => 'view', $id));
	}

/**
 *
 * Change project status to sent and stores final estimation for this project
 * @param unknown_type $id
 */	
	public function send($id = null) {
		$project = $this->Project->find('first', array('conditions' => array(
			'Project.id' => $id)));
		if ($this->request->is('post')) {
			$this->request->data['Project']['id'] = $id;
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been marked as sent'));
			} else {
				$this->Session->setFlash(__('The project could not be marked as sent. Please, try again.'));
			}
			$this->redirect(array('action' => 'view', $id));
		} 
		
	}
	
	/**
	 * 
	 * Change project status to delivered and stores spent time on this project
	 * @param unknown_type $id
	 */
	public function deliver($id = null) {
		$project = $this->Project->find('first', array('conditions' => array(
			'Project.id' => $id)));
		if ($this->request->is('post')) {
			$this->request->data['Project']['id'] = $id;
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been marked as delivered'));
			} else {
				$this->Session->setFlash(__('The project could not be marked as delivered. Please, try again.'));
			}
			$this->redirect(array('action' => 'view', $id));
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		if ($this->Project->delete()) {
			$this->Session->setFlash(__('Project deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Project was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

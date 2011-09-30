<?php
/**
 * Projects Controller
 *
 * For the management of projects
 *
 * PHP Version 5
 *
 * Estimation Application
 *
 * Copyright (c) 2007-2011
 * Cake Development Corporation
 * 1785 E. Sahara Avenue, Suite 490-423
 * Las Vegas, Nevada 89104
 *
 * You may obtain a copy of the License at:
 * License page: http://projects.cakedc.com/licenses/TBD  TBD
 * Copyright page: http://cakedc.com/copyright/
 *
 * @copyright       	Copyright 2007-2011, Cake Development Corporation
 * @link            	http://cakedc.com/ Cake Development Corporation
 * @link            	http://ugrant.it/ Ugrant.it
 * @package			app
 * @subpackage		app.controllers
 * @since			estimation app v0.1
 * @license			http://projects.cakedc.com/licenses/TBD  TBD
 */

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
		$project = $this->Project->find('first', array(
			'contain' => array(
				'Estimation.User',
				'Client'
			),
			'conditions' => array(
				'Project.id' => $id
			)
		));
		if (in_array($project['Project']['status'], array(Project::ESTIMATION_SENT,Project::DELIVERED)) || $this->Auth->user('is_admin')) {
			$this->set('project', $project);
		} else {
			$this->Session->setFlash(__('The project stills open for estimation'));
			$this->redirect('/dashboard');
		}
		
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
			if ($this->request->data['Project']['confirm']) {
				$finalEstimations = $this->Project->getFinalEstimations($id);
				$this->request->data['Project']['optimistic'] = $finalEstimations['optimistic'] ;
				$this->request->data['Project']['most_likely'] = $finalEstimations['most_likely'] ;
				$this->request->data['Project']['pessimistic'] = $finalEstimations['pessimistic'];
				$this->request->data['Project']['final_estimation'] = $finalEstimations['final_estimation'];
				if ($this->Project->save($this->request->data)) {
					$this->Session->setFlash(__('The project has been marked as sent'));
				} else {
					$this->Session->setFlash(__('The project could not be marked as sent. Please, try again.'));
				}
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('You need to mark the checkbox. Please, try again.'));
			}
			
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

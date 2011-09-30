<?php
/**
* Estimations Controller
*
* For the management of estimations
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
App::uses('Project', 'Model');
/**
 * Estimations Controller
 *
 * @property Estimation $Estimation
 */
class EstimationsController extends AppController {

	
	/**
	* Components
	*
	* @var array
	*/
	public $components = array('Auth', 'Session', 'Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Estimation->recursive = 0;
		$this->Paginator->settings = array(
			'contain' => array('User',
				'Project' => array('conditions' => array('Project.status' => array(Project::ESTIMATION_SENT,Project::DELIVERED)))	
			)
		);
		$this->set('estimations', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Estimation->id = $id;
		if (!$this->Estimation->exists()) {
			throw new NotFoundException(__('Invalid estimation'));
		}
		$this->set('estimation', $this->Estimation->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($projectId) {
		$userId = $this->Auth->user('id');
		$project = $this->Estimation->Project->find('first', array('conditions' => array(
			'Project.id' => $projectId)));
		if (!empty($project) && $project['Project']['status'] != Project::OPEN) {
			$this->Session->setFlash(__('The project must be OPEN to estimate it'));
			$this->redirect('index');
		}
		$estimation = $this->Estimation->find('first', array('conditions' => array(
			'Estimation.user_id' => $userId,
			'Estimation.project_id' => $projectId)));
		if (!empty($estimation)) {
			$this->Session->setFlash(__('You already did a estimation for this project'));
			$this->redirect('index');
		}
		if ($this->request->is('post')) {
			$this->Estimation->create();
			if ($this->Estimation->save($this->request->data)) {
				$this->Session->setFlash(__('The estimation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The estimation could not be saved. Please, try again.'));
			}
		}
		$this->set(compact('userId', 'project'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Estimation->id = $id;
		if (!$this->Estimation->exists()) {
			throw new NotFoundException(__('Invalid estimation'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Estimation->save($this->request->data)) {
				$this->Session->setFlash(__('The estimation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The estimation could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Estimation->read(null, $id);
		}
		$users = $this->Estimation->User->find('list');
		$projects = $this->Estimation->Project->find('list');
		$this->set(compact('users', 'projects'));
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
		$this->Estimation->id = $id;
		if (!$this->Estimation->exists()) {
			throw new NotFoundException(__('Invalid estimation'));
		}
		if ($this->Estimation->delete()) {
			$this->Session->setFlash(__('Estimation deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Estimation was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

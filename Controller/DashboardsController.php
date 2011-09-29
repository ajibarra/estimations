<?php
App::uses('AppController', 'Controller');
/**
 * Clients Controller
 *
 * @property Client $Client
 */
class DashboardsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$projects = ClassRegistry::init('Project')->find('all', array(
						'conditions' => array(
							'Project.status' => array(Project::OPEN))));
		if ($this->Auth->user('is_admin')) {
			//TODO Dashboard info for admins
		} else {
			//TODO Dashboard info for users
		}	
		$this->set('projects', $projects);
		
	}

}

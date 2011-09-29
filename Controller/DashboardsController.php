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
		if ($this->Auth->user('is_admin')) {
			
		} else {
			$projects = ClassRegistry::init('Project')->find('all', array(
				'conditions' => array(
					'Project.status' => array(Project::OPEN))));
		}	
		
	}

}

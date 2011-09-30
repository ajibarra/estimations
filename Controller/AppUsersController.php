<?php
/**
* Users Controller
*
* For the management of users
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
App::import('Controller', 'Users.Users');

	
class AppUsersController extends UsersController {
/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Users';

/**
* Constructor
*
* @return void
*/
	public function __construct($request, $response) {
		$this->uses[] = 'Profile';
		$this->modelClass = 'User';
		$this->User = ClassRegistry::init('AppUser');
		parent::__construct($request, $response);
	}
	
/**
 * Approves users to login
 *
 * @return mixed
 */
	public function approve() {
		if ($this->request->is('post')) {
			if (!empty($this->request->data['User'])) {
				foreach($this->request->data['User'] as $user ) {
					$this->User->save($user, array('validate' => false));
				}
				$this->Session->setFlash(__('Users approved successfuly'));
			}else {
				$this->Session->setFlash(__('You must select a user to approve'));
			}
			
		}
		$this->paginate =  array(
			'conditions' => array(
				'User.active' => 0
			),
			'order' => array('User.created desc')
		);
		$this->set('users', $this->paginate());
	}
	
/**
 * Adds a new user
 *
 * @return mixed
 */
	public function add() {
		if ($this->Auth->user()) {
			$this->Session->setFlash(__d('users', 'You are already registered and logged in!'));
			$this->redirect('/');
		}
		
		if (!empty($this->request->data)) {
			$user = $this->User->register($this->request->data);
			if ($user !== false) {
				$this->set('user', $user);
				$this->Session->setFlash(__d('users', 'Your account has been created. Once validated you will be able to login.'));
				$this->redirect('/login');
			} else {
				unset($this->request->data[$this->modelClass]['password']);
				unset($this->request->data[$this->modelClass]['temppassword']);
				$this->Session->setFlash(__d('users', 'Your account could not be created. Please, try again.'), 'default', array('class' => 'message warning'));
			}
		}
		$this->layout = 'plain';
	}
	
/**
 * Common login action
 *
 * @return void
 */
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login() &&$this->Auth->user()) {
				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('last_login', date('Y-m-d H:i:s'));
		
				if ($this->here == $this->Auth->loginRedirect) {
					$this->Auth->loginRedirect = '/';
				}
				$profile = $this->Profile->find('first', array('conditions' => array(
					'Profile.user_id' => $this->Auth->user('id')	
				)));
				$this->Session->setFlash(sprintf(__d('users', '%s you have successfully logged in'), $profile['Profile']['name']));
				if (!empty($this->request->data)) {
					$data = $this->request->data[$this->modelClass];
					$this->_setCookie();
				}
		
				if (empty($data['return_to'])) {
					$data['return_to'] = null;
				}
				$this->redirect($this->Auth->redirect($data['return_to']));
			} else {
				$this->Session->setFlash(__d('users', 'Invalid e-mail / password combination.  Please try again', true), 'default', null);
			}
		}
		if (isset($this->request->params['named']['return_to'])) {
			$this->set('return_to', urldecode($this->request->params['named']['return_to']));
		} else {
			$this->set('return_to', false);
		}
		
		$this->layout = 'plain';
	}
	
	/**
	 * Dashboard action
	 * @see UsersController::index()
	 */
	public function dashboard() {
		$openProjects = ClassRegistry::init('Project')->find('all', array(
			'conditions' => array(
				'Project.status' => array(Project::OPEN))));
		foreach($openProjects as $i => $project) {
			$openProjects[$i]['Project']['estimated'] = false;
			foreach ($project['Estimation'] as $j => $estimation) {
				if ($estimation['user_id'] == $this->Auth->user('id')) {
					$openProjects[$i]['Project']['estimated'] = true;
					break;
				}
			}
				
		}
		
		$sentProjects = ClassRegistry::init('Project')->find('all', array(
			'conditions' => array(
				'Project.status' => array(Project::ESTIMATION_SENT))));
		$deliveredProjects = ClassRegistry::init('Project')->find('all', array(
			'conditions' => array(
				'Project.status' => array(Project::DELIVERED))));
		if ($this->Auth->user('is_admin')) {
			//TODO Dashboard info for admins
		} else {
			//TODO Dashboard info for users
		}
		$this->set('openProjects', $openProjects);
		$this->set('sentProjects', $sentProjects);
		$this->set('deliveredProjects', $deliveredProjects);
	}	
}

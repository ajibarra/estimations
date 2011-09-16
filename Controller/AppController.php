<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       Cake.Console.Templates.skel.Controller
 */
class AppController extends Controller {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Form', 'Session', 'Html', 'Js');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Auth', 'Session');

/**
 * beforeFilter callback
 *
 * @return void
 */
	public function beforeFilter() {
		$this->_setupAuthentication();
		$this->set('controller', Inflector::underscore($this->name));
	}
	
/**
 * Setup Authentication
 *
 * @return void
 */
	protected function _setupAuthentication() {
		$this->Auth->authenticate = array(
        	'Form' => array(
        		'fields' => array('username' => 'email', 'password' => 'password'), 
				'userModel' => 'AppUser', 
				'scope' => array('AppUser.active' => 1)
        	),
		);
		$this->Auth->loginRedirect = array('controller' => 'projects', 'action' => 'index');
		$this->Auth->loginAction = array('controller' => 'app_users', 'action' => 'login');
		$this->Auth->authError = __("Sorry, you can't access the page requested", true);
		
	}
}

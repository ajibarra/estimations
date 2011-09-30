<?php
/**
* User Model
*
* Represents user content
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

App::import('Model', 'Users.User');
class AppUser extends User {
	
	public $name = 'AppUser';
	
/**
 * Table to use with this model
 *	
 * @var string
 */
	public $useTable = 'users';
	
/**
 * Model alias
 *
 * @var string
 */
	//public $alias = 'User';
	
	public $hasOne = array(
		'Profile' => array(
			'className' => 'Profile',
		)
	);

/**
 * Constructor
 *
 * - Unset inherited rules from the parent that we don't need in this app
 * - Adding roles
 *
 * @param string $id ID
 * @param string $table Table
 * @param string $ds Datasource
 */
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		unset($this->validate['username']);
	}
	
/**
 * Registers a new user
 *
 * @param array $postData Post data from controller
 * @return mixed
 */
	public function register($postData = array()) {
		$postData = $this->_beforeRegistration($postData, false);
		$this->_removeExpiredRegistrations();
		$this->set($postData);
		$this->Profile->set($postData);
		if ($this->validates() && $this->Profile->validates()) {
			$postData[$this->alias]['password'] = AuthComponent::password($postData[$this->alias]['password']);
			$postData[$this->alias]['active'] = 0; //Another user must activate
			$postData[$this->alias]['tos'] = 1; //Automatic acceptance of TOS
			$this->create();
			$this->save($postData, false);
		
			$postData[$this->alias]['id'] = $this->id;
			$postData['Profile']['user_id'] = $this->id;
		
			$result = $this->Profile->save($postData, array(
						'validates' => false));
		
			$result['Profile']['id'] = $this->Profile->id;
		
			return $result;
		}
		
		$this->Profile->invalidFields();
		return false;
	}
}
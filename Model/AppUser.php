<?php
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
<?php
/**
* Estimation Authorize Object
*
* Object to manage authorize in estimation app
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

App::uses('BaseAuthorize', 'Controller/Component/Auth');
Configure::load('permissions', 'estimation_permission');

class EstimationAuthorize extends BaseAuthorize {

	/**
	 * Returns whether a user is authorized to access an action
	 *
	 * @param array $user
	 * @param CakeRequest $request
	 * @return boolean
	 */
	public function authorize($user, CakeRequest $request) {
		if ($user['is_admin']) {
			return true;
		}
		$role = Configure::read('Permissions.' . $this->action($request));
		if (!$role) {
			return false;
		}
		if ($role === '*') {
			return true;
		}
		$models = explode(',', Inflector::camelize($role));
		foreach ($models as $model) {
			//$exists = ClassRegistry::init($model)->find('count', array(
			//	'conditions' => array()
			//));
			if ($exists) {
				return true;
			}
		}
		return false;
	}
}


<?php
/* Project Test cases generated on: 2011-09-16 15:14:20 : 1316178860*/
App::uses('Project', 'Model');

/**
 * Project Test Case
 *
 */
class ProjectTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.project', 'app.client', 'app.estimation', 'app.user');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Project = ClassRegistry::init('Project');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Project);
		ClassRegistry::flush();

		parent::tearDown();
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {

	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {

	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {

	}

/**
 * testValidateAndDelete method
 *
 * @return void
 */
	public function testValidateAndDelete() {

	}

}

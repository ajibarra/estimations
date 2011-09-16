<?php
/* Client Test cases generated on: 2011-09-16 15:13:37 : 1316178817*/
App::uses('Client', 'Model');

/**
 * Client Test Case
 *
 */
class ClientTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.client', 'app.project', 'app.estimation', 'app.user');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Client = ClassRegistry::init('Client');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Client);
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

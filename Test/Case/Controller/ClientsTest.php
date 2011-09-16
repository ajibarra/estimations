<?php
/* Clients Test cases generated on: 2011-09-16 15:13:51 : 1316178831*/
App::uses('Clients', 'Controller');

/**
 * TestClients 
 *
 */
class TestClients extends Clients {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * Clients Test Case
 *
 */
class ClientsTestCase extends CakeTestCase {
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

		$this->Clients = new TestClients();
		$this->Clie->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Clients);
		ClassRegistry::flush();

		parent::tearDown();
	}

}

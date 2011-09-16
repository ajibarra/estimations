<?php
/* Clients Test cases generated on: 2011-09-16 13:09:52 : 1316173012*/
App::import('Controller', 'Clients');

App::import('Lib', 'Templates.AppControllerTestCase');
class ClientsControllerTestCase extends AppControllerTestCase {
/**
 * Autoload entrypoint for fixtures dependecy solver
 *
 * @var string
 * @access public
 */
	public $plugin = 'app';

/**
 * Test to run for the test case (e.g array('testFind', 'testView'))
 * If this attribute is not empty only the tests from the list will be executed
 *
 * @var array
 * @access protected
 */
	protected $_testsToRun = array();

/**
 * Start Test callback
 *
 * @param string $method
 * @return void
 * @access public
 */
	public function startTest($method) {
		parent::startTest($method);
		$this->Clients = $this->generate(
			'Clients', array(
			  'methods' => array(
				'redirect'),
			  'components' => array(
				'Session')));
		$this->Clients->constructClasses();
		$this->Clients->params = array(
			'named' => array(),
			'pass' => array(),
			'url' => array());
		$fixture = new ClientFixture();
		$this->record = array('Client' => $fixture->records[0]);
	}

/**
 * End Test callback
 *
 * @param string $method
 * @return void
 * @access public
 */
	public function endTest($method) {
		parent::endTest($method);
		unset($this->Clients);
		ClassRegistry::flush();
	}

/**
 * Convenience method to assert Flash messages
 *
 * @return void
 * @access public
 */
	// public function assertFlash($message) {
		// $flash = $this->Clients->Session->read('Message.flash');
		// $this->assertEqual($flash['message'], $message);
		// $this->Clients->Session->delete('Message.flash');
	// }

/**
 * Test object instances
 *
 * @return void
 * @access public
 */
	public function testInstance() {
		$this->assertInstanceOf('ClientsController', $this->Clients);
	}


/**
 * testIndex
 *
 * @return void
 * @access public
 */
	public function testIndex() {
		$this->Clients->index();
		$this->assertTrue(!empty($this->Clients->viewVars['clients']));
	}

/**
 * testAdd
 *
 * @return void
 * @access public
 */
	public function testAdd() {
		$this->Clients->data = $this->record;
		unset($this->Clients->request->data['Client']['id']);
		$this->expectRedirect($this->Clients, array('action' => 'index'));
		$this->assertFlash($this->Clients, 'The client has been saved');
		$this->Clients->add();
		//$this->Clients->expectExactRedirectCount();
	}

/**
 * testEdit
 *
 * @return void
 * @access public
 */
	public function testEdit() {
		$this->Clients->edit('client-1');
		$this->assertEqual($this->Clients->data['Client'], $this->record['Client']);

		$this->Clients->data = $this->record;
		$this->expectRedirect($this->Clients, array('action' => 'view', 'client-1'));
		$this->assertFlash($this->Clients, 'Client saved');
		$this->Clients->edit('client-1');
		//$this->Clients->expectExactRedirectCount();
	}

/**
 * testView
 *
 * @return void
 * @access public
 */
	public function testView() {
		$this->Clients->view('client-1');
		$this->assertTrue(!empty($this->Clients->viewVars['client']));

		$this->_resetExpectation();
		$this->expectRedirect($this->Clients, array('action' => 'index'));
		$this->assertFlash($this->Clients, 'Invalid Client');
		$this->Clients->view('WRONG-ID');
		//$this->Clients->expectExactRedirectCount();
	}

/**
 * testDelete
 *
 * @return void
 * @access public
 */
	public function testDelete() {
		$this->expectRedirect($this->Clients, array('action' => 'index'));
		$this->assertFlash($this->Clients, 'Invalid Client');
		$this->Clients->delete('WRONG-ID');

		$this->Clients->delete('client-1');
		$this->assertTrue(!empty($this->Clients->viewVars['client']));

		$this->_resetExpectation();
		$this->Clients->data = array('Client' => array('confirmed' => 1));
		$this->expectRedirect($this->Clients, array('action' => 'index'));
		$this->assertFlash($this->Clients, 'Client deleted');
		$this->Clients->delete('client-1');
		//$this->Clients->expectExactRedirectCount();
	}



	
}
?>
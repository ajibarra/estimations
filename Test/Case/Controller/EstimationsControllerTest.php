<?php
/* Estimations Test cases generated on: 2011-09-16 13:09:27 : 1316173107*/
App::import('Controller', 'Estimations');

App::import('Lib', 'Templates.AppControllerTestCase');
class EstimationsControllerTestCase extends AppControllerTestCase {
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
		$this->Estimations = $this->generate(
			'Estimations', array(
			  'methods' => array(
				'redirect'),
			  'components' => array(
				'Session')));
		$this->Estimations->constructClasses();
		$this->Estimations->params = array(
			'named' => array(),
			'pass' => array(),
			'url' => array());
		$fixture = new EstimationFixture();
		$this->record = array('Estimation' => $fixture->records[0]);
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
		unset($this->Estimations);
		ClassRegistry::flush();
	}

/**
 * Convenience method to assert Flash messages
 *
 * @return void
 * @access public
 */
	// public function assertFlash($message) {
		// $flash = $this->Estimations->Session->read('Message.flash');
		// $this->assertEqual($flash['message'], $message);
		// $this->Estimations->Session->delete('Message.flash');
	// }

/**
 * Test object instances
 *
 * @return void
 * @access public
 */
	public function testInstance() {
		$this->assertInstanceOf('EstimationsController', $this->Estimations);
	}


/**
 * testIndex
 *
 * @return void
 * @access public
 */
	public function testIndex() {
		$this->Estimations->index();
		$this->assertTrue(!empty($this->Estimations->viewVars['estimations']));
	}

/**
 * testAdd
 *
 * @return void
 * @access public
 */
	public function testAdd() {
		$this->Estimations->data = $this->record;
		unset($this->Estimations->request->data['Estimation']['id']);
		$this->expectRedirect($this->Estimations, array('action' => 'index'));
		$this->assertFlash($this->Estimations, 'The estimation has been saved');
		$this->Estimations->add();
		//$this->Estimations->expectExactRedirectCount();
	}

/**
 * testEdit
 *
 * @return void
 * @access public
 */
	public function testEdit() {
		$this->Estimations->edit('estimation-1');
		$this->assertEqual($this->Estimations->data['Estimation'], $this->record['Estimation']);

		$this->Estimations->data = $this->record;
		$this->expectRedirect($this->Estimations, array('action' => 'view', 'estimation-1'));
		$this->assertFlash($this->Estimations, 'Estimation saved');
		$this->Estimations->edit('estimation-1');
		//$this->Estimations->expectExactRedirectCount();
	}

/**
 * testView
 *
 * @return void
 * @access public
 */
	public function testView() {
		$this->Estimations->view('estimation-1');
		$this->assertTrue(!empty($this->Estimations->viewVars['estimation']));

		$this->_resetExpectation();
		$this->expectRedirect($this->Estimations, array('action' => 'index'));
		$this->assertFlash($this->Estimations, 'Invalid Estimation');
		$this->Estimations->view('WRONG-ID');
		//$this->Estimations->expectExactRedirectCount();
	}

/**
 * testDelete
 *
 * @return void
 * @access public
 */
	public function testDelete() {
		$this->expectRedirect($this->Estimations, array('action' => 'index'));
		$this->assertFlash($this->Estimations, 'Invalid Estimation');
		$this->Estimations->delete('WRONG-ID');

		$this->Estimations->delete('estimation-1');
		$this->assertTrue(!empty($this->Estimations->viewVars['estimation']));

		$this->_resetExpectation();
		$this->Estimations->data = array('Estimation' => array('confirmed' => 1));
		$this->expectRedirect($this->Estimations, array('action' => 'index'));
		$this->assertFlash($this->Estimations, 'Estimation deleted');
		$this->Estimations->delete('estimation-1');
		//$this->Estimations->expectExactRedirectCount();
	}



	
}
?>
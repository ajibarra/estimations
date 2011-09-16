<?php
/* Estimations Test cases generated on: 2011-09-16 15:09:42 : 1316178582*/
App::import('Controller', 'Estimations');

App::import('Lib', 'Templates.AppControllerTestCase');
class EstimationsTestCase extends AppControllerTestCase {
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
			'E', array(
			  'methods' => array(
				'redirect'),
			  'components' => array(
				'Session')));
		$this->E->constructClasses();
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
		$this->assertInstanceOf('Estimations', $this->Estimations);
	}



	
}
?>
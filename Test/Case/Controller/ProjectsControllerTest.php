<?php
/* Projects Test cases generated on: 2011-09-16 13:09:46 : 1316173066*/
App::import('Controller', 'Projects');

App::import('Lib', 'Templates.AppControllerTestCase');
class ProjectsControllerTestCase extends AppControllerTestCase {
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
		$this->Projects = $this->generate(
			'Projects', array(
			  'methods' => array(
				'redirect'),
			  'components' => array(
				'Session')));
		$this->Projects->constructClasses();
		$this->Projects->params = array(
			'named' => array(),
			'pass' => array(),
			'url' => array());
		$fixture = new ProjectFixture();
		$this->record = array('Project' => $fixture->records[0]);
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
		unset($this->Projects);
		ClassRegistry::flush();
	}

/**
 * Convenience method to assert Flash messages
 *
 * @return void
 * @access public
 */
	// public function assertFlash($message) {
		// $flash = $this->Projects->Session->read('Message.flash');
		// $this->assertEqual($flash['message'], $message);
		// $this->Projects->Session->delete('Message.flash');
	// }

/**
 * Test object instances
 *
 * @return void
 * @access public
 */
	public function testInstance() {
		$this->assertInstanceOf('ProjectsController', $this->Projects);
	}


/**
 * testIndex
 *
 * @return void
 * @access public
 */
	public function testIndex() {
		$this->Projects->index();
		$this->assertTrue(!empty($this->Projects->viewVars['projects']));
	}

/**
 * testAdd
 *
 * @return void
 * @access public
 */
	public function testAdd() {
		$this->Projects->data = $this->record;
		unset($this->Projects->request->data['Project']['id']);
		$this->expectRedirect($this->Projects, array('action' => 'index'));
		$this->assertFlash($this->Projects, 'The project has been saved');
		$this->Projects->add();
		//$this->Projects->expectExactRedirectCount();
	}

/**
 * testEdit
 *
 * @return void
 * @access public
 */
	public function testEdit() {
		$this->Projects->edit('project-1');
		$this->assertEqual($this->Projects->data['Project'], $this->record['Project']);

		$this->Projects->data = $this->record;
		$this->expectRedirect($this->Projects, array('action' => 'view', 'project-1'));
		$this->assertFlash($this->Projects, 'Project saved');
		$this->Projects->edit('project-1');
		//$this->Projects->expectExactRedirectCount();
	}

/**
 * testView
 *
 * @return void
 * @access public
 */
	public function testView() {
		$this->Projects->view('project-1');
		$this->assertTrue(!empty($this->Projects->viewVars['project']));

		$this->_resetExpectation();
		$this->expectRedirect($this->Projects, array('action' => 'index'));
		$this->assertFlash($this->Projects, 'Invalid Project');
		$this->Projects->view('WRONG-ID');
		//$this->Projects->expectExactRedirectCount();
	}

/**
 * testDelete
 *
 * @return void
 * @access public
 */
	public function testDelete() {
		$this->expectRedirect($this->Projects, array('action' => 'index'));
		$this->assertFlash($this->Projects, 'Invalid Project');
		$this->Projects->delete('WRONG-ID');

		$this->Projects->delete('project-1');
		$this->assertTrue(!empty($this->Projects->viewVars['project']));

		$this->_resetExpectation();
		$this->Projects->data = array('Project' => array('confirmed' => 1));
		$this->expectRedirect($this->Projects, array('action' => 'index'));
		$this->assertFlash($this->Projects, 'Project deleted');
		$this->Projects->delete('project-1');
		//$this->Projects->expectExactRedirectCount();
	}



	
}
?>
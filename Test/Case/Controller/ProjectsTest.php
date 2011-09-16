<?php
/* Projects Test cases generated on: 2011-09-16 15:14:33 : 1316178873*/
App::uses('Projects', 'Controller');

/**
 * TestProjects 
 *
 */
class TestProjects extends Projects {
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
 * Projects Test Case
 *
 */
class ProjectsTestCase extends CakeTestCase {
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

		$this->Projects = new TestProjects();
		$this->Projec->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Projects);
		ClassRegistry::flush();

		parent::tearDown();
	}

}

<?php
/* Estimation Test cases generated on: 2011-09-16 15:09:46 : 1316178286*/
App::import('Model', 'Estimation');

App::import('Lib', 'Templates.AppControllerTestCase');
class EstimationTestCase extends AppControllerTestCase {
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
		$this->Estimation = ClassRegistry::init('Estimation');
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
		unset($this->Estimation);
		ClassRegistry::flush();
	}

/**
 * Test validation rules
 *
 * @return void
 * @access public
 */
	public function testValidation() {
		$this->assertValid($this->Estimation, $this->record);

		// Test mandatory fields
		$data = array('Estimation' => array('id' => 'new-id'));
		$expectedErrors = array(); // TODO Update me with mandatory fields
		$this->assertValidationErrors($this->Estimation, $data, $expectedErrors);

		// TODO Add your specific tests below
		$data = $this->record;
		//$data[Estimation]['title'] = str_pad('too long', 1000);
		//$expectedErrors = array('title');
		$this->assertValidationErrors($this->Estimation, $data, $expectedErrors);
	}

/**
 * Test adding a Estimation 
 *
 * @return void
 * @access public
 */
	public function testAdd() {
		$data = $this->record;
		unset($data['Estimation']['id']);
		$result = $this->Estimation->add($data);
		$this->assertTrue($result);
		
		try {
			$data = $this->record;
			unset($data['Estimation']['id']);
			//unset($data['Estimation']['title']);
			$result = $this->Estimation->add($data);
			$this->fail('No exception');
		} catch (OutOfBoundsException $e) {
			$this->pass('Correct exception thrown');
		}
		
	}

/**
 * Test editing a Estimation 
 *
 * @return void
 * @access public
 */
	public function testEdit() {
		$result = $this->Estimation->edit('estimation-1', null);

		$expected = $this->Estimation->read(null, 'estimation-1');
		$this->assertEqual($result['Estimation'], $expected['Estimation']);

		// put invalidated data here
		$data = $this->record;
		//$data['Estimation']['title'] = null;

		$result = $this->Estimation->edit('estimation-1', $data);
		$this->assertEqual($result, $data);

		$data = $this->record;

		$result = $this->Estimation->edit('estimation-1', $data);
		$this->assertTrue($result);

		$result = $this->Estimation->read(null, 'estimation-1');

		// put record specific asserts here for example
		// $this->assertEqual($result['Estimation']['title'], $data['Estimation']['title']);

		try {
			$this->Estimation->edit('wrong_id', $data);
			$this->fail('No exception');
		} catch (OutOfBoundsException $e) {
			$this->pass('Correct exception thrown');
		}
	}

/**
 * Test viewing a single Estimation 
 *
 * @return void
 * @access public
 */
	public function testView() {
		$result = $this->Estimation->view('estimation-1');
		$this->assertTrue(isset($result['Estimation']));
		$this->assertEqual($result['Estimation']['id'], 'estimation-1');

		try {
			$result = $this->Estimation->view('wrong_id');
			$this->fail('No exception on wrong id');
		} catch (OutOfBoundsException $e) {
			$this->pass('Correct exception thrown');
		}
	}

/**
 * Test ValidateAndDelete method for a Estimation 
 *
 * @return void
 * @access public
 */
	public function testValidateAndDelete() {
		try {
			$postData = array();
			$this->Estimation->validateAndDelete('invalidEstimationId', $postData);
		} catch (OutOfBoundsException $e) {
			$this->assertEqual($e->getMessage(), 'Invalid Estimation');
		}
		try {
			$postData = array(
				'Estimation' => array(
					'confirm' => 0));
			$result = $this->Estimation->validateAndDelete('estimation-1', $postData);
		} catch (Exception $e) {
			$this->assertEqual($e->getMessage(), 'You need to confirm to delete this Estimation');
		}

		$postData = array(
			'Estimation' => array(
				'confirm' => 1));
		$result = $this->Estimation->validateAndDelete('estimation-1', $postData);
		$this->assertTrue($result);
	}
	
}
?>
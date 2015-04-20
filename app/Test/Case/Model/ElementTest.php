<?php
App::uses('Element', 'Model');

/**
 * Element Test Case
 *
 */
class ElementTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.element',
		'app.position'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Element = ClassRegistry::init('Element');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Element);

		parent::tearDown();
	}

}

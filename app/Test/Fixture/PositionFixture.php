<?php
/**
 * PositionFixture
 *
 */
class PositionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'element_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'time' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'lat' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,6', 'unsigned' => false),
		'long' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,6', 'unsigned' => false),
		'address' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 80, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'element_id' => 1,
			'time' => '2015-04-17 09:21:51',
			'lat' => 1,
			'long' => 1,
			'address' => 1,
			'created' => '2015-04-17 09:21:51',
			'modified' => '2015-04-17 09:21:51'
		),
	);

}

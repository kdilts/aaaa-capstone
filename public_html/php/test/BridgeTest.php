<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{Bridge};

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");

/**
 * Full PHPUnit test for the Bridge class
 *
 * This is a complete PHPUnit test of the Bridge class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Bridge
 *
 **/
class BridgeTest extends AaaaTest {
	/**
	 * content of the Bridge
	 * @var string $VALID_BRIDGESTAFFID
	 **/
	protected $VALID_BRIDGESTAFFID = 0;

	protected $VALID_BRIDGENAME = 1;

	protected $VALID_BRIDGEUSERNAME = 2;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();
	}
	/**
	 * test inserting a valid Bridge and verify that the actual mySQL data matches
	 **/
	public function testInsertValidBridge() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("bridge");

		// create a new Bridge and insert to into mySQL
		$bridge = new Bridge(null, $this->VALID_BRIDGENAME, $this->VALID_BRIDGEUSERNAME);
		$bridge->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoBridge = Bridge::getBridgeByBridgeStaffId($this->getPDO(), $bridge->getBridgeStaffId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("bridge"));
		//$this->assertEquals($pdoBridge->getBridgeStaffId(), $this->VALID_BRIDGESTAFFID);
		$this->assertEquals($pdoBridge->getBridgeName(), $this->VALID_BRIDGENAME);
		$this->assertEquals($pdoBridge->getBridgeUserName(), $this->VALID_BRIDGEUSERNAME);
	}
	/**
	 * test inserting a Bridge that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidBridge() {
		// create a Bridge with a non null bridge id and watch it fail
		$bridge = new Bridge(AaaaTest::INVALID_KEY, $this->VALID_BRIDGENAME, $this->VALID_BRIDGEUSERNAME);
		$bridge->insert($this->getPDO());
	}

}
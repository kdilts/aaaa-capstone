<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{
	Bridge
};

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
		$bridge = new Bridge(AaaaTest::INVALID_KEY, $this->bridge->get->BridgeStaffId(), $this->VALID_BRIDGENAME);
		$bridge->insert($this->getPDO());
	}

	/**
	 * test inserting a Bridge, editing it, and then updating it
	 **/
	public function testUpdateValidBridge() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("bridge");

		// create a new Bridge and insert to into mySQL
		$bridge = new Bridge(null, $this->bridge->getBridgeStaffId(), $this->VALID_BRIDGENAME);
		$bridge->insert($this->getPDO());

		// edit the Bridge and update it in mySQL
		$bridge->setBridgeName($this->VALID_BRIDGENAME);
		$bridge->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoBridge = Bridge::getBridgeByBridgeStaffId($this->getPDO(), $bridge->getBridgeStaffId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("bridge"));
		$this->assertEquals($pdoBridge->getBridgeStaffId(), $this->profile->getBridgeStaffId());
		$this->assertEquals($pdoBridge->getBridgeName(), $this->VALID_BRIDGENAME2);
		$this->assertEquals($pdoBridge->getBridgeUserName(), $this->VALID_BRIDGEUSERNAME);
	}

	/**
	 * test updating a Bridge that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidBridge() {
		// create a Bridge, try to update it without actually updating it and watch it fail
		$bridge = new Bridge(null, $this->bridge>getBridgeUserName(), $this->VALID_BRIDGESTAFFID);
		$bridge>update($this->getPDO());
	}


	/**
	 * test grabbing a Bridge by bridge content
	 **/
	public function testGetValidBridgeByBridgeStaffId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("bridge");

		// create a new Bridge and insert to into mySQL
		$bridge = new Bridge(null, $this->bridge->getBridgeUserName(), $this->VALID_BRIDGESTAFFID, $this->VALID_BRIDGENAME);
		$bridge->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Bridge::getBridgeByBridgeStaffId($this->getPDO(), $bridge->getBridgeStaffId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("bridge"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Dmcdonald21\\DataDesign\\Bridge", $results);

		// grab the result from the array and validate it
		$pdoBridge = $results[0];
		$this->assertEquals($pdoBridge->getBridgeStaffId(), $this->bridge->getBridgeStaffId());
		$this->assertEquals($pdoBridge->getBridgeName(), $this->VALID_BRIDGENAME);
		$this->assertEquals($pdoBridge->getBridgeUserName(), $this->VALID_BRIDGEUSERNAME);
	}

	/**
	 * test grabbing aBridge by content that does not exist
	 **/
	public function testGetInvalidTweetByBridgeStaffId() {
		// grab a bridge by searching for content that does not exist
		$bridge = Bridge::getBridgeByBridgeStaffId($this->getPDO(), "you will find nothing");
		$this->assertCount(0, $bridge);
	}

	/**
	 * test grabbing all Bridges
	 **/
	public function testGetAllValidBridges() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("bridge");

		// create a new Bridge and insert to into mySQL
		$bridge = new Bridge(null, $this->profile->getBridgeStaffId(), $this->VALID_BRIDGENAME, $this->VALID_BRIDGEUSERNAME);
		BBridge->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Bridge::getAllBridges($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("bridge"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Dmcdonald21\\DataDesign\\Bridge", $results);

		// grab the result from the array and validate it
		$pdoTweet = $results[0];
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_TWEETCONTENT);
		$this->assertEquals($pdoTweet->getTweetDate(), $this->VALID_TWEETDATE);
	}
}
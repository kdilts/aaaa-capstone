<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{
	Swipe, StatusType
};

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");

/**
 * Full PHPUnit test for the Swipe class
 *
 * This is a complete PHPUnit test of the Swipe class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Swipe
 * @author Kevin Dilts <kdilts@cnm.edu>
 **/
class SwipeTest extends AaaaTest {
	protected $swipeStatus = null;
	protected $VALID_SWIPEID = 0;

	protected $VALID_SWIPESTATUS = 1;

	protected $VALID_SWIPENUMBER = 2;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();
		$this->swipeStatus = new StatusType(null, 2);
		$this->swipeStatus->insert($this->getPDO());
	}
	/**
	 * test inserting a valid Swipe and verify that the actual mySQL data matches
	 **/
	public function testInsertValidSwipe() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("swipe");

		// create a new Swipe and insert to into mySQL
		$swipe = new Swipe(null, $this->swipeStatus->getStatusTypeId(), $this->VALID_SWIPENUMBER );
		$swipe->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSwipe = Swipe::getSwipeBySwipeId($this->getPDO(), $swipe->getSwipeId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("swipe"));
		//$this->assertEquals($pdoSwipe->getSwipeId(), $this->VALID_SWIPEID);
		$this->assertEquals($pdoSwipe->getSwipeStatus(), $this->VALID_SWIPESTATUS);
		$this->assertEquals($pdoSwipe->getSwipeNumber(), $this->VALID_SWIPENUMBER);
	}

	/**
	 * test inserting a Swipe that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidSwipe() {
		// create a Swipe with a non null Swipe id and watch it fail
		$swipe = new Swipe(AaaaTest::INVALID_KEY, $this->VALID_SWIPESTATUS, $this->VALID_SWIPENUMBER);
		$swipe->insert($this->getPDO());
	}

	/**
	 * test inserting a swipe, editing it, and then updating it
	 **/
	public function testUpdateValidApplication() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("swipe");

		// create a new Swipe status and insert into mySQL
		$swipe = new Swipe(null, $this->VALID_SWIPESTATUS, $this->VALID_SWIPENUMBER);
		$swipe->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$result = Swipe::getSwipeBySwipeId($this->getPDO(), $swipe->getSwipeId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("swipe"));
		$this->assertNotNull($result);
		$this->assertInstanceOf("Edu\\Cnm\\DdcAaaa\\Swipe", $result);
		// grab the result from the array and validate it
		$this->assertEquals($result->getSwipeStatus(), $this->VALID_SWIPESTATUS);
		$this->assertEquals($result->getSwipeNumber(), $this->VALID_SWIPENUMBER);
	}

	/**
	 * test grabbing a Swipe by id that does not exist
	 **/
	public function testGetInvalidSwipeBySwipeId() {
		// grab a swipe by searching for id that does not exist
		$swipe = Swipe::getSwipeBySwipeId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertNull($swipe);
	}
	/**
	 * test grabbing Swipe by Swipe status id
	 **/
	public function testGetValidSwipeBySwipeStatus() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("swipe");
		// create a new Swipe and insert to into mySQL
		$swipe = new Swipe(null, $this->VALID_SWIPENUMBER, $this->VALID_SWIPESTATUS);
		$swipe->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = Swipe::getSwipeBySwipeStatus($this->getPDO(), $swipe->getSwipeStatus());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("swipe"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\Swipe", $results);
		// grab the result from the array and validate it
		$pdoSwipe = $results[0];
		$this->assertEquals($pdoSwipe->getSwipeStatus(), $this->VALID_SWIPESTATUS);
		$this->assertEquals($pdoSwipe->getSwipeNumber(), $this->VALID_SWIPENUMBER);
	}
	/**
	 * test grabbing Swipes by status that does not exist
	 **/
	public function testGetInvalidSwipesBySwipeStatus() {
		// grab swipes by searching for status that does not exist
		$swipes = Swipe::getSwipesBySwipeStatus($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertCount(0, $swipes);
	}
	/**
	 * test grabbing a Swipe by swipe number
	 **/
	public function testGetValidSwipeBySwipeNumber() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("swipe");
		// create a new Swipe and insert to into mySQL
		$swipe = new Swipe(null, $this->VALID_SWIPENUMBER, $this->VALID_SWIPESTATUS);
		$swipe->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$result = Swipe::getSwipeBySwipeNumber($this->getPDO(), $swipe->getSwipeNumber());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("swipe"));
		$this->assertNotNull($result);
		$this->assertInstanceOf("Edu\\Cnm\\DdcAaaa\\Swipe", $result);
		// grab the result from the array and validate it
		$this->assertEquals($result->getSwipeStatus(), $this->VALID_SWIPESTATUS);
		$this->assertEquals($result->getSwipeNumber(), $this->VALID_SWIPENUMBER);
	}
	/**
	 * test grabbing a Swipe by a swipe number that does not exist
	 **/
	public function testGetInvalidSwipeBySwipeNumber() {
		// grab a Swipe by searching for swipe number that does not exist
		$swipe = Swipe::getSwipeBySwipeNumber($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertNull($swipe);
	}
	/**
	 * test grabbing all Swipes
	 **/
	public function testGetAllValidSwipes() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("swipe");
		// create a new Swipe and insert to into mySQL
		$swipe = new Swipe(null, $this->VALID_SWIPENUMBER, $this->VALID_SWIPESTATUS);
		$swipe->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = Swipe::getAllSwipes($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("swipe"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\Swipe", $results);
		// grab the result from the array and validate it
		$pdoSwipe = $results[0];
		$this->assertEquals($pdoSwipe->getSwipeStatus(), $this->VALID_SWIPESTATUS);
		$this->assertEquals($pdoSwipe->getSwipeNumber(), $this->VALID_SWIPENUMBER);
	}

}










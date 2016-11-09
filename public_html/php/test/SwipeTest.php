<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{Swipe};

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

	protected $VALID_SWIPEID = 0;

	protected $VALID_SWIPESTATUS = 1;

	protected $VALID_SWIPENUMBER = 2;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();
	}

	/**
	 * test inserting a valid Swipe and verify that the actual mySQL data matches
	 **/
	public function testInsertValidSwipe() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("swipe");

		// create a new Swipe and insert to into mySQL
		$swipe = new Swipe(null, $this->VALID_SWIPESTATUS, $this->VALID_SWIPENUMBER);
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

}
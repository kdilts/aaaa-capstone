<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{Placard};

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");

/**
 * Full PHPUnit test for the Placard class
 *
 * This is a complete PHPUnit test of the Placard class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Placard
 * @author Kevin Dilts <kdilts@cnm.edu>
 **/
class PlacardTest extends AaaaTest {

	protected $VALID_PLACARDID = 1;

	protected $VALID_PLACARDSTATUSID = 1;

	protected $VALID_PLACARDNUMBER = 2;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();
	}

	/**
	 * test inserting a valid Placard and verify that the actual mySQL data matches
	 **/
	public function testInsertValidPlacard() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("placard");

		// create a new Placard and insert to into mySQL
		$placard = new Placard(null, $this->VALID_PLACARDSTATUSID, $this->VALID_PLACARDNUMBER);
		$placard->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlacard = Placard::getPlacardByPlacardId($this->getPDO(), $placard->getPlacardId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("placard"));
		//$this->assertEquals($pdoPlacard->getPlacardId(), $this->VALID_PLACARDID);
		$this->assertEquals($pdoPlacard->getPlacardStatusId(), $this->VALID_PLACARDSTATUSID);
		$this->assertEquals($pdoPlacard->getPlacardNumber(), $this->VALID_PLACARDNUMBER);
	}

	/**
	 * test inserting a Placard that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidPlacard() {
		// create a Placard with a non null placard id and watch it fail
		$placard = new Placard(AaaaTest::INVALID_KEY, $this->VALID_PLACARDSTATUSID, $this->VALID_PLACARDNUMBER);
		$placard->insert($this->getPDO());
	}

	/**
	 * test grabbing a Placard by placard id
	 **/
	/*public function testGetValidPlacardByPlacardId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("placard");

		// create a new Placard and insert to into mySQL
		$placard = new Placard(null, $this->VALID_PLACARDSTATUSID, $this->VALID_PLACARDNUMBER);
		$placard->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Placard::getPlacardByPlacardId($this->getPDO(), $placard->getPlacardId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("placard"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\Placard", $results);

		// grab the result from the array and validate it
		$pdoPlacard = $results[0];
		$this->assertEquals($pdoPlacard->getPlacardStatusId(), $this->VALID_PLACARDSTATUSID);
		$this->assertEquals($pdoPlacard->getPlacardNumber(), $this->VALID_PLACARDNUMBER);
	}*/

	/**
	 * test grabbing a Placard by id that does not exist
	 **/
	public function testGetInvalidPlacardByPlacardId() {
		// grab a placard by searching for id that does not exist
		$placard = Placard::getPlacardByPlacardId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertCount(0, $placard);
	}


	/**
	 * test grabbing all Placards
	 **/
	public function testGetAllValidPlacards() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("placard");

		// create a new Placard and insert to into mySQL
		$placard = new Placard(null, $this->VALID_PLACARDSTATUSID, $this->VALID_PLACARDNUMBER);
		$placard->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Placard::getAllPlacards($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("placard"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\Placard", $results);

		// grab the result from the array and validate it
		$pdoPlacard = $results[0];
		$this->assertEquals($pdoPlacard->getPlacardStatusId(), $this->VALID_PLACARDSTATUSID);
		$this->assertEquals($pdoPlacard->getPlacardNumber(), $this->VALID_PLACARDNUMBER);
	}

}
<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{Placard, StatusType};

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

	protected $status = null;

	protected $VALID_PLACARDNUMBER = 1;
	protected $VALID_PLACARDNUMBER2 = 2;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// create a statusType for this placard
		$this->status = new StatusType(null, 1);
		$this->status->insert($this->getPDO());
	}

	/**
	 * test inserting a valid Placard and verify that the actual mySQL data matches
	 **/
	public function testInsertValidPlacard() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("placard");

		// create a new Placard and insert to into mySQL
		$placard = new Placard(null, $this->status->getStatusTypeId(), $this->VALID_PLACARDNUMBER);
		$placard->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlacard = Placard::getPlacardByPlacardId($this->getPDO(), $placard->getPlacardId());


		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("placard"));
		$this->assertEquals($pdoPlacard->getPlacardStatusTypeId(), $this->status->getStatusTypeId());
		$this->assertEquals($pdoPlacard->getPlacardNumber(), $this->VALID_PLACARDNUMBER);
	}

	/**
	 * test inserting a Placard that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidPlacard() {
		// create a Placard with a non null placard id and watch it fail
		$placard = new Placard(AaaaTest::INVALID_KEY, $this->status->getStatusTypeId(), $this->VALID_PLACARDNUMBER);
		$placard->insert($this->getPDO());
	}

	/**
	 * test inserting a Placard, editing it, and then updating it
	 **/
	public function testUpdateValidPlacard() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("placard");

		// create a new Placard and insert to into mySQL
		$placard = new Placard(null, $this->status->getStatusTypeId(), $this->VALID_PLACARDNUMBER);
		$placard->insert($this->getPDO());

		// edit the Tweet and update it in mySQL
		$placard->setPlacardNumber($this->VALID_PLACARDNUMBER2);
		$placard->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlacard = Placard::getPlacardByPlacardId($this->getPDO(), $placard->getPlacardId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("placard"));
		$this->assertEquals($pdoPlacard->getPlacardStatusTypeId(), $this->status->getStatusTypeId());
		$this->assertEquals($pdoPlacard->getPlacardNumber(), $this->VALID_PLACARDNUMBER2);
	}


	/**
	 * test updating a Placard that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidPlacard() {
		// create a Placard, try to update it without actually updating it and watch it fail
		$placard = new Placard(null, $this->status->getStatusTypeId(), $this->VALID_PLACARDNUMBER);
		$placard->update($this->getPDO());
	}

	/**
	 * test grabbing a Placard by placard id
	 **/
	public function testGetValidPlacardByPlacardId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("placard");

		// create a new Placard and insert to into mySQL
		$placard = new Placard(null, $this->status->getStatusTypeId(), $this->VALID_PLACARDNUMBER);
		$placard->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$result = Placard::getPlacardByPlacardId($this->getPDO(), $placard->getPlacardId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("placard"));
		$this->assertNotNull($result);
		$this->assertInstanceOf("Edu\\Cnm\\DdcAaaa\\Placard", $result);

		$this->assertEquals($result->getPlacardStatusTypeId(), $this->status->getStatusTypeId());
		$this->assertEquals($result->getPlacardNumber(), $this->VALID_PLACARDNUMBER);
	}

	/**
	 * test grabbing a Placard by id that does not exist
	 **/
	public function testGetInvalidPlacardByPlacardId() {
		// grab a placard by searching for id that does not exist
		$placard = Placard::getPlacardByPlacardId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertNull($placard);
	}

	/**
	 * test grabbing Placards by placard status id
	 **/
	public function testGetValidPlacardsByPlacardStatusId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("placard");

		// create a new Placard and insert to into mySQL
		$placard = new Placard(null, $this->status->getStatusTypeId(), $this->VALID_PLACARDNUMBER);
		$placard->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Placard::getPlacardsByPlacardStatusTypeId($this->getPDO(), $placard->getPlacardStatusTypeId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("placard"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\Placard", $results);

		// grab the result from the array and validate it
		$pdoPlacard = $results[0];
		$this->assertEquals($pdoPlacard->getPlacardStatusTypeId(), $this->status->getStatusTypeId());
		$this->assertEquals($pdoPlacard->getPlacardNumber(), $this->VALID_PLACARDNUMBER);
	}

	/**
	 * test grabbing Placards by status that does not exist
	 **/
	public function testGetInvalidPlacardsByPlacardStatusId() {
		// grab placards by searching for status that does not exist
		$placards = Placard::getPlacardsByPlacardStatusTypeId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertCount(0, $placards);
	}

	/**
	 * test grabbing a Placard by placard number
	 **/
	public function testGetValidPlacardByPlacardNumber() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("placard");

		// create a new Placard and insert to into mySQL
		$placard = new Placard(null, $this->status->getStatusTypeId(), $this->VALID_PLACARDNUMBER);
		$placard->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$result = Placard::getPlacardByPlacardNumber($this->getPDO(), $placard->getPlacardNumber());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("placard"));
		$this->assertNotNull($result);
		$this->assertInstanceOf("Edu\\Cnm\\DdcAaaa\\Placard", $result);

		// grab the result from the array and validate it
		$this->assertEquals($result->getPlacardStatusTypeId(), $this->status->getStatusTypeId());
		$this->assertEquals($result->getPlacardNumber(), $this->VALID_PLACARDNUMBER);
	}

	/**
	 * test grabbing a Placard by a placard number that does not exist
	 **/
	public function testGetInvalidPlacardByPlacardNumber() {
		// grab a placard by searching for placard number that does not exist
		$placards = Placard::getPlacardByPlacardNumber($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertNull($placards);
	}

	/**
	 * test grabbing all Placards
	 **/
	public function testGetAllValidPlacards() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("placard");

		// create a new Placard and insert to into mySQL
		$placard = new Placard(null, $this->status->getStatusTypeId(), $this->VALID_PLACARDNUMBER);
		$placard->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Placard::getAllPlacards($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("placard"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\Placard", $results);

		// grab the result from the array and validate it
		$pdoPlacard = $results[0];
		$this->assertEquals($pdoPlacard->getPlacardStatusTypeId(), $this->status->getStatusTypeId());
		$this->assertEquals($pdoPlacard->getPlacardNumber(), $this->VALID_PLACARDNUMBER);
	}

}
<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\StatusType;

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");

/**
 * Full PHPUnit test for the Status class
 *
 * This is a complete PHPUnit test of the StatusTest class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see statusType
 *
 **/
class StatusTypeTest extends AaaaTest {
	/**
	 * content of the Status Type
	 * @var int $VALID_STATUSTYPENAME
	 **/
	protected $VALID_STATUSTYPENAME = 1;
	protected $VALID_STATUSTYPENAME2 = 2;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

	}// create and insert a Status Type

	/**
	 * test inserting a valid Status and verify that the actual mySQL data matches
	 */
	public function testInsertValidStatusType() {

		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("statusType");

		// create a new Status and insert to into mySQL
		$status = new StatusType(null, $this->VALID_STATUSTYPENAME);
		$status->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoStatus = StatusType::getStatusTypeByStatusTypeId($this->getPDO(), $status->getStatusTypeId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("statusType"));
		$this->assertEquals($pdoStatus->getStatusTypeName(), $this->VALID_STATUSTYPENAME);
	}

	/**
	 * test inserting a Status that already exists
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidStatusType() {
		// create a Status with a non null status id and watch it fail
		$status = new StatusType(AaaaTest::INVALID_KEY, $this->VALID_STATUSTYPENAME);
		$status->insert($this->getPDO());
	}

	/**
	 * test inserting a Status, editing it, and then updating it
	 **/
	public function testUpdateValidStatusType() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("statusType");

		// create a new Status and insert to into mySQL
		$status = new StatusType(null, $this->VALID_STATUSTYPENAME);
		$status->insert($this->getPDO());

		//edit the Status and update it in mySQL
		$status->setStatusTypeName($this->VALID_STATUSTYPENAME2);
		$status->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our
		$pdoStatus = StatusType::getStatusTypeByStatusTypeId($this->getPDO(), $status->getStatusTypeId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("statusType"));
		$this->assertEquals($pdoStatus->getStatusTypeName(), $this->VALID_STATUSTYPENAME2);
	}

	/**
	 * test updating a StatusType that does not exist
	 *
	 * @expectedException \PDOException
	 **/
	public function testUpdateInvalidStatusType() {
		// create a StatusType, try to update it without actually updating it and watch it fail
		$status = new StatusType(null, $this->VALID_STATUSTYPENAME);
		$status->update($this->getPDO());
	}

	// TODO test valid / invalid getById

	//TODO VVVVVVVVVVVVVVVVVVVVVVVVVVVVVV
	/**
	 * test grabbing a StatusType by statusType content
	 **/
	public function testGetValidStatusTypeByStatusTypeName() {

		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("statusType");

		// create a new StatusType and insert to into mySQL
		$statusType = new StatusType($this->VALID_BRIDGESTAFFID, $this->VALID_BRIDGENAME, $this->VALID_BRIDGEUSERNAME);
		$statusType->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = StatusType::getStatusTypeByStatusTypeStaffId($this->getPDO(), $statusType->getStatusTypeStaffId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("statusType"));
		$this->assertNotNull($results);
		$this->assertInstanceOf("Edu\\Cnm\\DdcAaaa\\StatusType", $results);

		// grab the result from the array and validate it

		$this->assertEquals($results->getStatusTypeStaffId(), $this->VALID_BRIDGESTAFFID);
		$this->assertEquals($results->getStatusTypeName(), $this->VALID_BRIDGENAME);
		$this->assertEquals($results->getStatusTypeUserName(), $this->VALID_BRIDGEUSERNAME);
	}
	/**
	 * test grabbing a StatusType by content that does not exist
	 **/
	public function testGetInvalidStatusTypeByStatusTypeStaffId() {
		// grab a statusType by searching for content that does not exist
		$statusType = StatusType::getStatusTypeByStatusTypeStaffId($this->getPDO(), "not a valid key");
		$this->assertNull($statusType);
	}
//TODO ^^^^^^^^^^^^^^^^^^^^^^
	
	/**
	 * test grabbing all StatusTypes
	 **/
	public function testGetAllValidStatusTypes() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("statusType");

		// create a new StatusType and insert to into mySQL
		$status = new StatusType(null, $this->VALID_STATUSTYPENAME);
		$status->insert($this->getPDO());

		//var_dump($status);

		// grab the data from mySQL and enforce the fields match our expectations
		$results = StatusType::getAllStatusTypes($this->getPDO());

		//var_dump($results);
		//var_dump($results[0]);

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("statusType"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\StatusType", $results);

		// grab the result from the array and validate it
		$pdoStatusType = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("statusType"));
		$this->assertEquals($pdoStatusType->getStatusTypeId(), $status->getStatusTypeId());
		$this->assertEquals($pdoStatusType->getStatusTypeName(), $status->getStatusTypeName());
	}

}





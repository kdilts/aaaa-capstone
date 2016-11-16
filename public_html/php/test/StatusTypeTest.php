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
 * @see status
 **/
class StatusTypeTest extends AaaaTest {
	/**
	 * content of the Status
	 * @var string $VALID_ST
	 **/
	protected $VALID_STATUSTYPENAME = 1;
	protected $VALID_STATUSTYPENAME2 = 2;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();
	}
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

}
<?php
namespace Edu\Cnm\DdcAaa\Test;

use Edu\Cnm\DdcAaaa\{Status};

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
class StatusTest extends AaaaTest {
	/**
	 * content of the Status
	 * @var string $VALID_ST
	 **/
	protected $VALID_STATUSTYPEID = 0;

	protected $VALID_STATUSTYPENAME = 1;

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
	public function testInsertValidStatus() {

		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("status");

		// create a new Status and insert to into mySQL
		$status = new Status(null, $this->VALID_STATUSTYPEID, $this->VALID_STATUSTYPENAME);
		$status->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoStatus = Status::getStatusByStatusTypeId($this->getPDO(), $status->getStatusTypeId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("status"));
		//$this->assertEquals(%pdoStatus->getStatusTypeId(), $this->VALID_STATUSTYPEID);
		$this->assertEquals($pdoStatus->getStatusTypeName(), $this->VALID_STATUSTYPENAME);
	}

	/**
	 * test inserting a Status that already exists
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidStatus() {
		// create a Status with a non null status id and watch it fail
		$status = new Status(AaaaTest::INVALID_KEY, $this->VALID_STATUSTYPEID, $this->VALID_STATUSTYPENAME);
		$status->insert($this->gerPDO());
	}

	/**
	 * test inserting a Status, editing it, and then updating it
	 **/
	public function testUpdateValidStatus() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("status");

		// create a new Status and insert to into mySQL
		$status = new Status(null, $this->VALID_STATUSTYPEID, $this->VALID_STATUSTYPENAME);
		$status->insert($this->getPDO());

		//edit the Status and update it in mySQL
		$status->setStatusTypeId($this->VALID_STATUSTYPEID2);
		$status->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our
		$pdoStatus = Status::getStatusByStatusTypeId($this->getPDO(), $status->getStatusTypeId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("status"));
		$this->assertEquals($pdoStatus->getStatusTypeId(), $this->VALID_STATUSTYPEID2);
		$this->assertEquals($pdoStatus->getStatusTypeName(), $this->VALID_STATUSTYPENAME);

	}

}
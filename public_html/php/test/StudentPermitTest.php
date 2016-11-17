<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{
	StudentPermit
};

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");


class StudentPermitTest extends AaaaTest {

	protected $VALID_STUDENTPERMITAPPLICATIONID = 0;

	protected $VALID_STUDENTPERMITPLACARDID = 1;

	protected $VALID_STUDENTPERMITSWIPEID= 2;

	protected $STUDENTPERMITCHECKOUTDATE = null;

	protected $STUDENTPERMITCHECKINTDATE = null;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();
	}

	/**
	 * test inserting a valid Student and verify that the actual mySQL data matches
	 **/
	public function testInsertValidStudentPermit() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a Student Permit and insert into mySQL
		$studentPermit = new StudentPermit(null, $this->VALID_STUDENTPERMITPLACARDID, $this->VALID_STUDENTPERMITSWIPEID);
		$studentPermit->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoStudentPermit = StudentPermit::getBystudentPermit($this->getPDO(), $studentPermit->getStudentPermit());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		//$this->assertEquals($pdo->getStudentPermit(), $this->VALID_STUDENTPERMIT);
		$this->assertEquals($pdoStudentPermit->getStudentPermitApplicationId(), $this->VALID_STUDENTPERMITAPPLICATIONID);
		$this->assertEquals($pdoStudentPermit->getStudentPermit(), $this->VALID_STUDENTPERMITPLACARDID);
		$this->assertEquals($pdoStudentPermit->getStudentPermit(), $this->VALID_STUDENTPERMITSWIPEID);
	}

	/**
	 * test inserting a StudentPermit that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidStudentPermit() {
		// create a StudentPermit with a non null studentPermit Application Id and watch it fail
		$studentPermit = new StudentPermit(AaaaTest::INVALID_KEY, $this->studentPermit->getStudentPemitApplicationId(),
			$this->VALID_STUDENTPERMITPLACARDID, $this->VALID_STUDENTPERMITSWIPEID);
		$studentPermit->insert($this->getPDO());
	}

	/**
	 * test inserting a StudentPermit, editing it, and then updating it
	 **/
	public function testUpdateValidStudentPermi() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a new StudentPermit and insert to into mySQL
		$studentPermit = new StudentPermit(null, $this->STUDENTPERMITAPPLICATIONID->getStudentPermitPlacardId(), $this->VALID_STUDENTPERMITSWIPEID);
		$studentPermit->insert($this->getPDO());

		// edit the StudentPermit and update it in mySQL
		$studentPermit->setStudentPermitApplicationId($this->VALID_STUDENTPERMITPLACARDID);
		$studentPermit->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSstudentPermit = StudentPermit::getStudentPermitByStudentPermitApplicationId($this->getPDO(),
			$studentPermit->getStudentPermitApplicationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		$this->assertEquals($pdoStudentPermit->getStudentPermitApplicationId(), $this->studentPermit->getStudentPermitApplicationId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitPlacardId(), $this->VALID_STUDENTPERMITPLACARDID);
		$this->assertEquals($pdoStudentPermit->getStudentPermitSwipeId(), $this->VALID_STUDENTPERMITSWIPEID);
	}

	/**
	 * test grabbing all StudentPermits
	 **/
	public function testGetAllValidStudentPermits() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a new Student Permit and insert to into mySQL
		$studentPermit = new StudentPermit(null, $this->studentPermit->getStudentPermitApplicationId(), $this->VALID_STUDENTPERMITPLACARDID);
		$studentPermit->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = StudentPermit::getAllStudentPermits($this->getPDO(), $studentPermit->getStudentPermitApplicationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\Test\\StudentPermit", $results);

		// grab the result from the array and validate it
		$pdoStudentPermit = $results[0];
		$this->assertEquals($pdoStudentPermit->getStudentPermitApplicationId(), $this->VALID_STUDENTPERMITSWIPEID);
		$this->assertEquals($pdoStudentPermit->getStudentPermitCheckInDate);
		$this->assertEquals($pdoStudentPermit->getStudentPermitPlacardId(), $this->VALID_STUDENTPERMITSWIPEID);
	}
}
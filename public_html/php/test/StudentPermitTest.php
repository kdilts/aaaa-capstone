<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{StudentPermit};

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");

/**
 * Full PHPUnit test for the StudentPermit class
 *
 * This is a complete PHPUnit test of the Student Permit class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see StudentPermit
 **/
class StudentPermitTest extends AaaaTest {
	/**
	 * @var string $VALID_StudentPermitApplicationId
	 **/
	protected $VALID_STUDENTPERMITAPPLICATIONID = 0;
	/**
	 * @var int_StudentPermitPlacardId
	 **/
	protected $VALID_STUDENTPERMITPLACARDID = 1;
	/**
	 * @var int StudentPermitSwipeId
	 **/
	protected $VALID_STUDENTPERMITSWIPEID= 2;
	/**
	 * @var DateTime $studentPermitCheckOutDate
	 **/
	protected $STUDENTPERMITCHECKOUTDATE = null;
	/**
	 * @var DateTime $studentPermitCheckInDate
	 */
	protected $STUDENTPERMITCHECINTDATE = null;

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
	$studentPermit = new StudentPermit(null, $this->VALID_STUDENTPERMITPLACARDID, $this->VALID_STUDENTPERMITSWIPEID,
		$this->VALID_STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
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
		$student = new StudentPermit(AaaaTest::INVALID_KEY, $this->studentPermit->getStudentPemitApplicationId(),
			$this->VALID_STUDENTPERMITPLACARDID, $this->VALID_STUDENTPERMITSWIPEID; $this->VALID_STUDENTPERMITCHECKOUTDATE,
		$this->STUDENTPERMITCHECKINDATE);
		$student->insert($this->getPDO());
	}

	/**
	 * test inserting a StudentPermit, editing it, and then updating it
	 **/
	public function testUpdateValidStudentPermi() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a new StudentPermit and insert to into mySQL
		$studentPermitt = new StudentPermit(null, $this->VALID_STUDENTPERMITAPPLICATIONID->get(),
			$this->VALID_STUDENTPERMITPLACARDID, $this->VALID_STUDENTPERMITSWIPEID);
		$studentPermitt->insert($this->getPDO());

		// edit the StudentPermit and update it in mySQL
		$studentPermitt->setStudentPermitApplicationId($this->VALID_STUDENTPERMITPLACARDID);
		$studentPermitt->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSstudentPermit = StudentPermit::getStudentPermitByStudentPermitApplicationId($this->getPDO(),
			$studentPermit->getStudentPermitApplicationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		$this->assertEquals($pdoSstudentPermit->getStudentPermitApplicationId(),
			$this->studentPermit->getStudentPermitApplicationId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitApplicationId(), $this->VALID_STUDENTPERMITPLACARDID);
		$this->assertEquals($pdoSstudentPermit->getStudentPermit(), $this->VALID_STUDENTPERMITSWIPEID);
	}

	/**
	 * test grabbing all StudentPermits
	 **/
	public function testGetAllValidStudentPermits() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a new Student Permit and insert to into mySQL
		$studentPermit = new StudentPermit(null, $this->studentPermit->getStudentPermitApplicationId(),
			$this->VALID_STUDENTPERMITAPPLICATIONID, $this->VALID_STUDENTPERMITSWIPEID);
		$studentPermit->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = StudentPermit::getAllStudentPermits($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\Cnm\DdcAaaa\Test\StudentPermit", $results);

		// grab the result from the array and validate it
		$pdoStudentPermit = $results[0];
		$this->assertEquals($pdoStudentPermit->getStudentPermitApplicationId(), $this->studentPermit->getStudentPlacardId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitCheckInDate(), $this->VALID_STUDENTPERMITCHECOUTTDATE);
		$this->assertEquals($pdoStudentPermit->getStudentPermitPlacardId(), $this->VALID_STUDENTPERMITSWIPEID);
	}
}
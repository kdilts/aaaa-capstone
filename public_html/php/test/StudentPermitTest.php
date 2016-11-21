<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{ StudentPermit, Placard, Swipe, Application, StatusType };

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");


class StudentPermitTest extends AaaaTest {

	protected $application = null;

	protected $placard = null;

	protected $swipe = null;

	protected $statusType = null;

	protected $STUDENTPERMITCHECKOUTDATE = null;

	protected $STUDENTPERMITCHECKINDATE = null;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		$this->application = new Application(null, "john", "doe", "em@ail.com", "555-555-5555", "source", "about you", "hope", "exp", new \DateTime(), "utmC","utmM", "utmS");
		$this->application->insert($this->getPDO());

		$this->statusType = new StatusType(null, 1);
		$this->statusType->insert($this->getPDO());

		$this->placard = new Placard(null, $this->statusType->getStatusTypeId(),1);
		$this->placard->insert($this->getPDO());

		$this->swipe = new Swipe(null, $this->statusType->getStatusTypeId(),1);
		$this->swipe->insert($this->getPDO());

		$this->STUDENTPERMITCHECKOUTDATE = new \DateTime();
		$this->STUDENTPERMITCHECKINDATE = new \DateTime();
	}

	/**
	 * test inserting a valid Student and verify that the actual mySQL data matches
	 **/
	public function testInsertValidStudentPermit() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a Student Permit and insert into mySQL
		$studentPermit = new StudentPermit(null, $this->application->getApplicationId(), $this->placard->getplacardId(), $this->swipe->getswipeId(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$studentPermit->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoStudentPermit = StudentPermit::getStudentPermitBystudentPermitId($this->getPDO(), $studentPermit->getStudentPermitId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		$this->assertEquals($pdoStudentPermit->getStudentPermitApplicationId(), $this->application->getApplicationId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitPlacardId(), $this->placard->getplacardId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitSwipeId(), $this->swipe->getswipeId());
	}

	/**
	 * test inserting a StudentPermit that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidStudentPermit() {
		// create a StudentPermit with a non null studentPermit Application Id and watch it fail
		$studentPermit = new StudentPermit(null, $this->application->getApplicationId(), $this->placard->getplacardId(), $this->swipe->getswipeId(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$studentPermit->insert($this->getPDO());
	}

	/**
	 * test inserting a StudentPermit, editing it, and then updating it
	 **/
	public function testUpdateValidStudentPermit() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a new StudentPermit and insert to into mySQL
		$studentPermit = new StudentPermit(null, $this->application->getApplicationId(), $this->placard->getplacardId(), $this->swipe->getswipeId(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$studentPermit->insert($this->getPDO());

		// edit the StudentPermit and update it in mySQL
		$studentPermit->setStudentPermitApplicationId($this->placard->getplacardId());
		$studentPermit->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoStudentPermit = StudentPermit::getStudentPermitByStudentPermitApplicationId($this->getPDO(), $studentPermit->getStudentPermitApplicationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		$this->assertEquals($pdoStudentPermit->getStudentPermitApplicationId(), $pdoStudentPermit->getStudentPermitApplicationId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitplacardId(), $this->placard->getplacardId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitswipeId(), $this->swipe->getswipeId());
	}

	/**
	 * test grabbing all StudentPermits
	 **/
	public function testGetAllValidStudentPermits() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a new Student Permit and insert to into mySQL
		$studentPermit = new StudentPermit(null, $this->application->getApplicationId(), $this->placard->getplacardId(), $this->swipe->getswipeId(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$studentPermit->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = StudentPermit::getAllStudentPermits($this->getPDO(), $studentPermit->getStudentPermitApplicationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\Test\\StudentPermit", $results);

		// grab the result from the array and validate it
		$pdoStudentPermit = $results[0];
		$this->assertEquals($pdoStudentPermit->getStudentPermitApplicationId(), $this->swipe->getswipeId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitCheckInDate());
		$this->assertEquals($pdoStudentPermit->getStudentPermitplacardId(), $this->swipe->getswipeId());
	}
}
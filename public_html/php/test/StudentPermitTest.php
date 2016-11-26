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
	protected $placard2 = null;

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

		$this->placard2 = new Placard(null, $this->statusType->getStatusTypeId(),2);
		$this->placard2->insert($this->getPDO());

		$this->swipe = new Swipe(null, $this->statusType->getStatusTypeId(),1);
		$this->swipe->insert($this->getPDO());

		$this->STUDENTPERMITCHECKOUTDATE = \DateTime::createFromFormat("Y-m-d","2015-1-1");
		$this->STUDENTPERMITCHECKINDATE = \DateTime::createFromFormat("Y-m-d","2015-10-1");
	}

	/**
	 * test inserting a valid Student and verify that the actual mySQL data matches
	 **/
	public function testInsertValidStudentPermit() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a Student Permit and insert into mySQL
		$studentPermit = new StudentPermit(null, $this->application->getApplicationId(), $this->placard->getPlacardId(), $this->swipe->getSwipeId(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$studentPermit->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoStudentPermit = StudentPermit::getStudentPermitBystudentPermitId($this->getPDO(), $studentPermit->getStudentPermitId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		$this->assertEquals($pdoStudentPermit->getStudentPermitId(), $studentPermit->getStudentPermitId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitApplicationId(), $this->application->getApplicationId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitPlacardId(), $this->placard->getPlacardId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitSwipeId(), $this->swipe->getSwipeId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitCheckOutDate(), $this->STUDENTPERMITCHECKOUTDATE);
		$this->assertEquals($pdoStudentPermit->getStudentPermitCheckInDate(), $this->STUDENTPERMITCHECKINDATE);
	}

	/**
	 * test inserting a StudentPermit that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidStudentPermit() {
		// create a StudentPermit with a non null studentPermit Application Id and watch it fail
		$studentPermit = new StudentPermit(AaaaTest::INVALID_KEY, $this->application->getApplicationId(), $this->placard->getPlacardId(), $this->swipe->getSwipeId(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$studentPermit->insert($this->getPDO());
	}

	/**
	 * test inserting a StudentPermit, editing it, and then updating it
	 **/
	public function testUpdateValidStudentPermit() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a new StudentPermit and insert to into mySQL
		$studentPermit = new StudentPermit(null, $this->application->getApplicationId(), $this->placard->getPlacardId(), $this->swipe->getSwipeId(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$studentPermit->insert($this->getPDO());

		// edit the StudentPermit and update it in mySQL
		$studentPermit->setStudentPermitPlacardId($this->placard2->getPlacardId());
		$studentPermit->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoStudentPermit = StudentPermit::getStudentPermitByStudentPermitPlacardId($this->getPDO(), $studentPermit->getStudentPermitPlacardId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		$this->assertEquals($pdoStudentPermit->getStudentPermitId(), $studentPermit->getStudentPermitId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitApplicationId(), $pdoStudentPermit->getStudentPermitApplicationId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitPlacardId(), $this->placard2->getPlacardId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitSwipeId(), $this->swipe->getSwipeId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitCheckOutDate(), $this->STUDENTPERMITCHECKOUTDATE);
		$this->assertEquals($pdoStudentPermit->getStudentPermitCheckInDate(), $this->STUDENTPERMITCHECKINDATE);
	}

	/**
	 * test grabbing a StudentPermit by studentPermit id
	 **/
	public function testGetValidStudentPermitByStudentPermitId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a new StudentPermit and insert to into mySQL
		$studentPermit = new StudentPermit(null, $this->application->getApplicationId(), $this->placard->getPlacardId(), $this->swipe->getSwipeId(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$studentPermit->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$result = StudentPermit::getStudentPermitByStudentPermitId($this->getPDO(), $studentPermit->getStudentPermitId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		$this->assertEquals($result->getStudentPermitId(), $studentPermit->getStudentPermitId());
		$this->assertEquals($result->getStudentPermitApplicationId(), $result->getStudentPermitApplicationId());
		$this->assertEquals($result->getStudentPermitPlacardId(), $this->placard->getPlacardId());
		$this->assertEquals($result->getStudentPermitSwipeId(), $this->swipe->getSwipeId());
		$this->assertEquals($result->getStudentPermitCheckOutDate(), $this->STUDENTPERMITCHECKOUTDATE);
		$this->assertEquals($result->getStudentPermitCheckInDate(), $this->STUDENTPERMITCHECKINDATE);
	}

	/**
	 * test grabbing a StudentPermit by id that does not exist
	 **/
	public function testGetInvalidStudentPermitByStudentPermitId() {
		// grab a studentPermit by searching for id that does not exist
		$studentPermit = StudentPermit::getStudentPermitByStudentPermitId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertNull($studentPermit);
	}

	/**
	 * test grabbing a StudentPermit by studentPermit id
	 **/
	public function testGetValidStudentPermitByStudentPermitApplicationId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a new StudentPermit and insert to into mySQL
		$studentPermit = new StudentPermit(null, $this->application->getApplicationId(), $this->placard->getPlacardId(), $this->swipe->getSwipeId(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$studentPermit->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$result = StudentPermit::getStudentPermitByStudentPermitApplicationId($this->getPDO(), $studentPermit->getStudentPermitApplicationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		$this->assertEquals($result->getStudentPermitId(), $studentPermit->getStudentPermitId());
		$this->assertEquals($result->getStudentPermitApplicationId(), $result->getStudentPermitApplicationId());
		$this->assertEquals($result->getStudentPermitPlacardId(), $this->placard->getPlacardId());
		$this->assertEquals($result->getStudentPermitSwipeId(), $this->swipe->getSwipeId());
		$this->assertEquals($result->getStudentPermitCheckOutDate(), $this->STUDENTPERMITCHECKOUTDATE);
		$this->assertEquals($result->getStudentPermitCheckInDate(), $this->STUDENTPERMITCHECKINDATE);
	}

	/**
	 * test grabbing a StudentPermit by id that does not exist
	 **/
	public function testGetInvalidStudentPermitByStudentPermitApplicationId() {
		// grab a studentPermit by searching for id that does not exist
		$studentPermit = StudentPermit::getStudentPermitByStudentPermitApplicationId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertNull($studentPermit);
	}

	/**
	 * test grabbing a StudentPermit by studentPermit swipe id
	 **/
	public function testGetValidStudentPermitByStudentPermitSwipeId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a new StudentPermit and insert to into mySQL
		$studentPermit = new StudentPermit(null, $this->application->getApplicationId(), $this->placard->getPlacardId(), $this->swipe->getSwipeId(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$studentPermit->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$result = StudentPermit::getStudentPermitByStudentPermitSwipeId($this->getPDO(), $studentPermit->getStudentPermitSwipeId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		$this->assertEquals($result->getStudentPermitId(), $studentPermit->getStudentPermitId());
		$this->assertEquals($result->getStudentPermitApplicationId(), $result->getStudentPermitApplicationId());
		$this->assertEquals($result->getStudentPermitPlacardId(), $this->placard->getPlacardId());
		$this->assertEquals($result->getStudentPermitSwipeId(), $this->swipe->getSwipeId());
		$this->assertEquals($result->getStudentPermitCheckOutDate(), $this->STUDENTPERMITCHECKOUTDATE);
		$this->assertEquals($result->getStudentPermitCheckInDate(), $this->STUDENTPERMITCHECKINDATE);
	}

	/**
	 * test grabbing a StudentPermit by swipe id that does not exist
	 **/
	public function testGetInvalidStudentPermitByStudentPermitSwipeId() {
		// grab a studentPermit by searching for id that does not exist
		$studentPermit = StudentPermit::getStudentPermitByStudentPermitSwipeId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertNull($studentPermit);
	}

	/**
	 * test grabbing a StudentPermit by studentPermit placard id
	 **/
	public function testGetValidStudentPermitByStudentPermitPlacardId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a new StudentPermit and insert to into mySQL
		$studentPermit = new StudentPermit(null, $this->application->getApplicationId(), $this->placard->getPlacardId(), $this->swipe->getSwipeId(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$studentPermit->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$result = StudentPermit::getStudentPermitByStudentPermitPlacardId($this->getPDO(), $studentPermit->getStudentPermitPlacardId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		$this->assertEquals($result->getStudentPermitId(), $studentPermit->getStudentPermitId());
		$this->assertEquals($result->getStudentPermitApplicationId(), $result->getStudentPermitApplicationId());
		$this->assertEquals($result->getStudentPermitPlacardId(), $this->placard->getPlacardId());
		$this->assertEquals($result->getStudentPermitSwipeId(), $this->swipe->getSwipeId());
		$this->assertEquals($result->getStudentPermitCheckOutDate(), $this->STUDENTPERMITCHECKOUTDATE);
		$this->assertEquals($result->getStudentPermitCheckInDate(), $this->STUDENTPERMITCHECKINDATE);
	}

	/**
	 * test grabbing a StudentPermit by placard id that does not exist
	 **/
	public function testGetInvalidStudentPermitByStudentPermitPlacardId() {
		// grab a studentPermit by searching for id that does not exist
		$studentPermit = StudentPermit::getStudentPermitByStudentPermitPlacardId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertNull($studentPermit);
	}

	/**
	 * test grabbing a StudentPermit by studentPermit check out date range
	 **/
	public function testGetValidStudentPermitByStudentPermitCheckOutDateRange() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a new StudentPermit and insert to into mySQL
		$studentPermit = new StudentPermit(null, $this->application->getApplicationId(), $this->placard->getPlacardId(), $this->swipe->getSwipeId(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$studentPermit->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = StudentPermit::getStudentPermitsByStudentPermitCheckOutDateRange($this->getPDO(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$pdoStudentPermit = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		$this->assertEquals($pdoStudentPermit->getStudentPermitId(), $studentPermit->getStudentPermitId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitApplicationId(), $pdoStudentPermit->getStudentPermitApplicationId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitPlacardId(), $this->placard->getPlacardId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitSwipeId(), $this->swipe->getSwipeId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitCheckOutDate(), $this->STUDENTPERMITCHECKOUTDATE);
		$this->assertEquals($pdoStudentPermit->getStudentPermitCheckInDate(), $this->STUDENTPERMITCHECKINDATE);
	}

	/**
	 * test grabbing a StudentPermit by studentPermit date range that doesn't exist
	 **/
	public function testGetInalidStudentPermitByStudentPermitCheckOutDateRange() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a new StudentPermit and insert to into mySQL
		$studentPermit = new StudentPermit(null, $this->application->getApplicationId(), $this->placard->getPlacardId(), $this->swipe->getSwipeId(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$studentPermit->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = StudentPermit::getStudentPermitsByStudentPermitCheckOutDateRange($this->getPDO(), new \DateTime(), new \DateTime());
		$this->assertEmpty($results);
	}

	/**
	 * test grabbing a StudentPermit by studentPermit check out date range
	 **/
	public function testGetValidStudentPermitByStudentPermitCheckInDateRange() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a new StudentPermit and insert to into mySQL
		$studentPermit = new StudentPermit(null, $this->application->getApplicationId(), $this->placard->getPlacardId(), $this->swipe->getSwipeId(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$studentPermit->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = StudentPermit::getStudentPermitsByStudentPermitCheckInDateRange($this->getPDO(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$pdoStudentPermit = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		$this->assertEquals($pdoStudentPermit->getStudentPermitId(), $studentPermit->getStudentPermitId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitApplicationId(), $pdoStudentPermit->getStudentPermitApplicationId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitPlacardId(), $this->placard->getPlacardId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitSwipeId(), $this->swipe->getSwipeId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitCheckOutDate(), $this->STUDENTPERMITCHECKOUTDATE);
		$this->assertEquals($pdoStudentPermit->getStudentPermitCheckInDate(), $this->STUDENTPERMITCHECKINDATE);
	}

	/**
	 * test grabbing a StudentPermit by studentPermit date range that doesn't exist
	 **/
	public function testGetInalidStudentPermitByStudentPermitCheckInDateRange() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a new StudentPermit and insert to into mySQL
		$studentPermit = new StudentPermit(null, $this->application->getApplicationId(), $this->placard->getPlacardId(), $this->swipe->getSwipeId(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$studentPermit->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = StudentPermit::getStudentPermitsByStudentPermitCheckInDateRange($this->getPDO(), new \DateTime(), new \DateTime());
		$this->assertEmpty($results);
	}
	
	/**
	 * test grabbing all StudentPermits
	 **/
	public function testGetAllValidStudentPermits() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("studentPermit");

		// create a new Student Permit and insert to into mySQL
		$studentPermit = new StudentPermit(null, $this->application->getApplicationId(), $this->placard->getPlacardId(), $this->swipe->getSwipeId(), $this->STUDENTPERMITCHECKOUTDATE, $this->STUDENTPERMITCHECKINDATE);
		$studentPermit->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = StudentPermit::getAllStudentPermits($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("studentPermit"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\StudentPermit", $results);

		// grab the result from the array and validate it
		$pdoStudentPermit = $results[0];
		$this->assertEquals($pdoStudentPermit->getStudentPermitId(), $studentPermit->getStudentPermitId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitApplicationId(), $this->application->getApplicationId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitPlacardId(), $this->placard->getPlacardId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitSwipeId(), $this->swipe->getSwipeId());
		$this->assertEquals($pdoStudentPermit->getStudentPermitCheckOutDate(), $this->STUDENTPERMITCHECKOUTDATE);
		$this->assertEquals($pdoStudentPermit->getStudentPermitCheckInDate(), $this->STUDENTPERMITCHECKINDATE);
	}
}
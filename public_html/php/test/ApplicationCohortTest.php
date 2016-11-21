<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{ApplicationCohort, Application, Cohort};

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");

/**
 * Full PHPUnit test for the Application class
 *
 * This is a complete PHPUnit test of the Application class.
 *
 * @see Application
 * @author Kevin Dilts <kdilts@cnm.edu>
 **/
class ApplicationCohortTest extends AaaaTest {

	private $cohort = null;
	private $application = null;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// create date
		$date = new \DateTime();

		// create cohort
		$this->cohort = new Cohort(null, 1);
		$this->cohort->insert($this->getPDO());

		// create an application
		$this->application = new Application(null, "john", "doe", "em@ail.com", "555-555-5555", "source", "about you", "hope", "exp", $date, "utmC","utmM", "utmS");
		$this->application->insert($this->getPDO());
	}

	/**
	 * test inserting a valid ApplicationCohort and verify that the actual mySQL data matches
	 **/
	public function testInsertValidApplicationCohort() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("applicationCohort");

		// create a new ApplicationCohort and insert to into mySQL
		$applicationCohort = new ApplicationCohort(null, $this->application->getApplicationId(), $this->cohort->getCohortId());
		$applicationCohort->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoApplicationCohort = ApplicationCohort::getApplicationCohortByApplicationCohortId($this->getPDO(), $applicationCohort->getApplicationCohortId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("applicationCohort"));
		$this->assertEquals($pdoApplicationCohort->getApplicationCohortApplicationId(), $this->application->getApplicationId());
		$this->assertEquals($pdoApplicationCohort->getApplicationCohortCohortId(), $this->cohort->getCohortId());
	}

	/**
	 * test inserting a ApplicationCohort that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidApplicationCohort() {
		// create a Placard with a non null placard id and watch it fail
		$placard = new ApplicationCohort(AaaaTest::INVALID_KEY, $this->application->getApplicationId(), $this->cohort->getCohortId());
		$placard->insert($this->getPDO());
	}

	public function testGetValidApplicationCohortByApplicationCohortId(){

	}

	public function testGetInvalidApplicationCohortByApplicationCohortId(){

	}

	public function testGetValidApplicationCohortByCohortId(){

	}

	public function testGetInvalidApplicationCohortByCohortId(){

	}

	public function testGetValidApplicationCohortByApplicationId(){

	}

	public function testGetInvalidApplicationCohortByApplicationId(){

	}

	public function testGetAllValidApplicationCohorts(){

	}

}
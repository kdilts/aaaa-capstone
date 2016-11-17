<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{ApplicationCohort, Application, Cohort};

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
class ApplicationCohortTest extends AaaaTest {

	private $cohort = null;
	private $application = null;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

//		int $newApplicationId = null, string $newApplicationFirstName, string $newApplicationLastName, string $newApplicationEmail, string $newApplicationPhoneNumber, string $newApplicationSource, int $newApplicationCohortId, string $newApplicationAboutYou, string $newApplicationHopeToAccomplish, string $newApplicationExperience, string $newApplicationDateTime, string $newApplicationUtmCampaign, string $newApplicationUtmMedium, string $newApplicationUtmSource

		// create date
		$date = new \DateTime();
		//$date = $date->format("Y-m-d H:i:s");

		// create cohort
		$this->cohort = new Cohort(null, 1);
		$this->cohort->insert($this->getPDO());

		// create an application
		$this->application = new Application(null, "john", "doe", "em@ail.com", "555-555-5555", "source", $this->cohort->getCohortId(), "about you", "hope", "exp", $date, "utmC","utmM", "utmS");
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
}
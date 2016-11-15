<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{ApplicationCohort, Application};

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

	private $VALID_APPLICATIONCOHORTAPPLICATIONID = 1;
	private $VALID_APPLICATIONCOHORTCOHORTID = 2;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();
	}

	/**
	 * test inserting a valid ApplicationCohort and verify that the actual mySQL data matches
	 **/
	public function testInsertValidApplicationCohort() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("applicationCohort");

		// create a new Placard and insert to into mySQL
		$applicationCohort = new ApplicationCohort(null, $this->VALID_APPLICATIONCOHORTAPPLICATIONID, $this->VALID_APPLICATIONCOHORTCOHORTID);
		$applicationCohort->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoApplicationCohort = applicationCohort::getApplicationCohortByApplicationCohortId($this->getPDO(), $applicationCohort->getApplicationCohortId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("applicationCohort"));
		$this->assertEquals($pdoApplicationCohort->getApplicationCohortApplicationId(), $this->VALID_APPLICATIONCOHORTAPPLICATIONID);
		$this->assertEquals($pdoApplicationCohort->getApplicationCohortCohortId(), $this->VALID_APPLICATIONCOHORTCOHORTID);
	}

	/**
	 * test inserting a ApplicationCohort that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidApplicationCohort() {
		// create a Placard with a non null placard id and watch it fail
		$placard = new ApplicationCohort(AaaaTest::INVALID_KEY, $this->VALID_APPLICATIONCOHORTAPPLICATIONID, $this->VALID_APPLICATIONCOHORTCOHORTID);
		$placard->insert($this->getPDO());
	}
}
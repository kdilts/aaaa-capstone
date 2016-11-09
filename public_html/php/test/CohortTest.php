<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{Cohort};

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");

/**
 * Full PHPUnit test for the Cohort class
 *
 * This is a complete PHPUnit test of the Cohort class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Cohort
 * @author Kevin Dilts <kdilts@cnm.edu>
 **/
class CohortTest extends AaaaTest {

	protected $VALID_COHORTAPPLICATIONID = 1;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();
	}

	/**
	 * test inserting a valid Cohort and verify that the actual mySQL data matches
	 **/
	public function testInsertValidCohort() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("cohort");

		// create a new Cohort and insert to into mySQL
		$cohort = new Cohort(null, $this->VALID_COHORTAPPLICATIONID);
		$cohort->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoCohort = Cohort::getCohortByCohortId($this->getPDO(), $cohort->getCohortId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("cohort"));
		$this->assertEquals($pdoCohort->getCohortApplicationId(), $this->VALID_COHORTAPPLICATIONID);
	}

	/**
	 * test inserting a Cohort that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidCohort() {
		// create a Cohort with a non null cohort id and watch it fail
		$cohort = new Cohort(AaaaTest::INVALID_KEY, $this->VALID_COHORTAPPLICATIONID);
		$cohort->insert($this->getPDO());
	}
	
}
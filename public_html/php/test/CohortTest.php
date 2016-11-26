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
		$this->assertEquals($pdoCohort->getCohortId(), $cohort->getCohortId());
		$this->assertEquals($pdoCohort->getCohortApplicationId(), $this->VALID_COHORTAPPLICATIONID);
	}

	/**
	 * test inserting a Cohort that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidCohort() {
		// create a Cohort with a non null cohort id and watch it fail
		$cohort = new Cohort(AaaaTest::INVALID_KEY, $this->VALID_COHORTAPPLICATIONID);
		$cohort->insert($this->getPDO());
	}

	/**
	 * test grabbing valid cohort by the cohort Id
	 **/
	public function testGetValidCohortByCohortId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("cohort");

		// create a new Cohort and insert to into mySQL
		$cohort = new Cohort(null, $this->VALID_COHORTAPPLICATIONID);
		$cohort->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$result = Cohort::getCohortByCohortId($this->getPDO(), $cohort->getCohortId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("cohort"));
		$this->assertNotNull($result);
		$this->assertInstanceOF("Edu\\Cnm\\DdcAaaa\\Cohort", $result);

		// grab the result from the array and validate it
		$this->assertEquals($result->getCohortApplicationId(), $cohort->getCohortApplicationId());
		$this->assertEquals($result->getCohortId(), $cohort->getCohortId());
	}

	/**
	 * test grabbing a Cohort by id that does not exist
	 **/
	public function testGetInvalidCohortByCohortId() {
		// grab a cohort by searching for id that does not exist
		$cohort = Cohort::getCohortByCohortId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertNull($cohort);
	}


	/**
	 * test grabbing valid Cohort by the valid Cohort Application Id
	 */
	public function testGetValidCohortByCohortApplicationId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("cohort");

		//create a new Cohort and insert to into mySQL
		$cohort = new Cohort(null, $this->VALID_COHORTAPPLICATIONID);
		$cohort->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$result = Cohort::getCohortByCohortApplicationId($this->getPDO(), $cohort->getCohortApplicationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("cohort"));
		$this->assertNotNull($result);
		$this->assertInstanceOf("Edu\\Cnm\\DdcAaaa\\Cohort", $result);

		//grab the result from the array and validate it
		$this->assertEquals($result->getCohortApplicationId(), $cohort->getCohortApplicationId());
		$this->assertEquals($result->getCohortId(), $cohort->getCohortId());
	}
	/**
	 * test grabbing a Cohort by Application Id that does not exist
	 */
	public function testGetInvalidCohortByCohortApplicationId(){
		//grab a cohort by searching for application id that does not exist
		$cohort = Cohort::getCohortByCohortApplicationId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertNull($cohort);
	}
	/**
	 * test grabbing all Cohorts
	 **/
	public function testGetAllValidCohorts() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("cohort");

		// create a new Cohort and insert to into mySQL
		$cohort = new Cohort(null, $this->VALID_COHORTAPPLICATIONID);
		$cohort->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Cohort::getAllCohorts($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("cohort"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\Cohort", $results);

		// grab the result from the array and validate it
		$pdoCohort = $results[0];
		$this->assertEquals($pdoCohort->getCohortApplicationId(), $this->VALID_COHORTAPPLICATIONID);
		$this->assertEquals($pdoCohort->getCohortId(), $cohort->getCohortId());
	}
}
<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{ProspectCohort, Prospect, Cohort};

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");

/**
 * Full PHPUnit test for the Prospect class
 *
 * This is a complete PHPUnit test of the Prospect class.
 *
 * @see Prospect
 * @author Kevin Dilts <kdilts@cnm.edu>
 **/
class ProspectCohortTest extends AaaaTest {

	private $cohort = null;
	private $prospect = null;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// create cohort
		$this->cohort = new Cohort(null, 1);
		$this->cohort->insert($this->getPDO());

		// create an prospect
		$this->prospect = new Prospect(null, $this->cohort->getCohortId(), "555-555-5555", "em@ail.com", "john", "doe");
		$this->prospect->insert($this->getPDO());
	}

	/**
	 * test inserting a valid ProspectCohort and verify that the actual mySQL data matches
	 **/
	public function testInsertValidProspectCohort() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("prospectCohort");

		// create a new ProspectCohort and insert to into mySQL
		$prospectCohort = new ProspectCohort(null, $this->prospect->getProspectId(), $this->cohort->getCohortId());
		$prospectCohort->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProspectCohort = ProspectCohort::getProspectCohortByProspectCohortId($this->getPDO(), $prospectCohort->getProspectCohortId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("prospectCohort"));
		$this->assertEquals($pdoProspectCohort->getProspectCohortId(), $prospectCohort->getProspectCohortId());
		$this->assertEquals($pdoProspectCohort->getProspectCohortProspectId(), $this->prospect->getProspectId());
		$this->assertEquals($pdoProspectCohort->getProspectCohortCohortId(), $this->cohort->getCohortId());
	}

	/**
	 * test inserting a ProspectCohort that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidProspectCohort() {
		// create a Placard with a non null prospectCohort id and watch it fail
		$placard = new ProspectCohort(AaaaTest::INVALID_KEY, $this->prospect->getProspectId(), $this->cohort->getCohortId());
		$placard->insert($this->getPDO());
	}

	/**
	 *  test grabbing an ProspectCohort by ProspectCohortId
	 */
	public function testGetValidProspectCohortByProspectCohortId(){
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("prospectCohort");

		// create a new ProspectCohort and insert to into mySQL
		$prospectCohort = new ProspectCohort(null, $this->prospect->getProspectId(), $this->cohort->getCohortId());
		$prospectCohort->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProspectCohort = ProspectCohort::getProspectCohortByProspectCohortId($this->getPDO(), $prospectCohort->getProspectCohortId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("prospectCohort"));
		$this->assertEquals($pdoProspectCohort->getProspectCohortId(), $prospectCohort->getProspectCohortId());
		$this->assertEquals($pdoProspectCohort->getProspectCohortProspectId(), $this->prospect->getProspectId());
		$this->assertEquals($pdoProspectCohort->getProspectCohortCohortId(), $this->cohort->getCohortId());
	}

	/**
	 *  test grabbing an ProspectCohort by ProspectCohortId that does not exist
	 */
	public function testGetInvalidProspectCohortByProspectCohortId(){
		// grab a prospectCohort by searching for id that does not exist
		$prospectCohort = ProspectCohort::getProspectCohortByProspectCohortId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertNull($prospectCohort);
	}

	/**
	 *  test grabbing ProspectCohorts by ProspectCohortCohortId
	 */
	public function testGetValidProspectCohortByCohortId(){
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("prospectCohort");

		// create a new ProspectCohort and insert to into mySQL
		$prospectCohort = new ProspectCohort(null, $this->prospect->getProspectId(), $this->cohort->getCohortId());
		$prospectCohort->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = ProspectCohort::getProspectCohortsByCohortId($this->getPDO(), $prospectCohort->getProspectCohortCohortId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("prospectCohort"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\ProspectCohort", $results);

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProspectCohort = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("prospectCohort"));
		$this->assertEquals($pdoProspectCohort->getProspectCohortId(), $prospectCohort->getProspectCohortId());
		$this->assertEquals($pdoProspectCohort->getProspectCohortProspectId(), $this->prospect->getProspectId());
		$this->assertEquals($pdoProspectCohort->getProspectCohortCohortId(), $this->cohort->getCohortId());
	}

	/**
	 *  test grabbing ProspectCohorts by ProspectCohortCohortId that does not exit
	 */
	public function testGetInvalidProspectCohortByCohortId(){
		// grab a prospectCohort by searching for id that does not exist
		$prospectCohort = ProspectCohort::getProspectCohortsByCohortId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertCount(0, $prospectCohort);
	}

	/**
	 *  test grabbing an ProspectCohort by ProspectCohortProspectId
	 */
	public function testGetValidProspectCohortByProspectId(){
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("prospectCohort");

		// create a new ProspectCohort and insert to into mySQL
		$prospectCohort = new ProspectCohort(null, $this->prospect->getProspectId(), $this->cohort->getCohortId());
		$prospectCohort->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = ProspectCohort::getProspectCohortsByProspectId($this->getPDO(), $prospectCohort->getProspectCohortProspectId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("prospectCohort"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\ProspectCohort", $results);

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProspectCohort = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("prospectCohort"));
		$this->assertEquals($pdoProspectCohort->getProspectCohortId(), $prospectCohort->getProspectCohortId());
		$this->assertEquals($pdoProspectCohort->getProspectCohortProspectId(), $this->prospect->getProspectId());
		$this->assertEquals($pdoProspectCohort->getProspectCohortCohortId(), $this->cohort->getCohortId());
	}

	/**
	 *  test grabbing an ProspectCohort by ProspectCohortProspectId
	 */
	public function testGetInvalidProspectCohortByProspectId(){
		// grab a prospectCohort by searching for id that does not exist
		$prospectCohort = ProspectCohort::getProspectCohortsByProspectId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertEmpty($prospectCohort);
	}

	/**
	 *  test grabbing all ProspectCohorts
	 */
	public function testGetAllValidProspectCohorts(){
// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("prospectCohort");

		// create a new ProspectCohort and insert to into mySQL
		$prospectCohort = new ProspectCohort(null, $this->prospect->getProspectId(), $this->cohort->getCohortId());
		$prospectCohort->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = ProspectCohort::getAllProspectCohorts($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("prospectCohort"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\ProspectCohort", $results);

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProspectCohort = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("prospectCohort"));
		$this->assertEquals($pdoProspectCohort->getProspectCohortId(), $prospectCohort->getProspectCohortId());
		$this->assertEquals($pdoProspectCohort->getProspectCohortProspectId(), $this->prospect->getProspectId());
		$this->assertEquals($pdoProspectCohort->getProspectCohortCohortId(), $this->cohort->getCohortId());
	}

}
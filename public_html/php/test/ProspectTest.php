<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{Prospect};

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");

/**
 * Full PHPUnit test for the Prospect class
 *
 * This is a complete PHPUnit test of the Prospect class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Prospect
 * @author Kevin Dilts <kdilts@cnm.edu>
 **/
class ProspectTest extends AaaaTest {

	protected $VALID_PROSPECTCOHORTID = 1;
	protected $VALID_PROSPECTPHONENUMBER = "555-555-5555";
	protected $VALID_PROSPECTEMAIL = "validemail@gmail.com";
	protected $VALID_PROSPECTFIRSTNAME = "John";
	protected $VALID_PROSPECTLASTNAME = "Doe";

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();
	}

	/**
	 * test inserting a valid Prospect and verify that the actual mySQL data matches
	 **/
	public function testInsertValidProspect() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("prospect");

		// create a new Prospect and insert to into mySQL
		$prospect = new Prospect(null, $this->VALID_PROSPECTPHONENUMBER, $this->VALID_PROSPECTEMAIL, $this->VALID_PROSPECTFIRSTNAME, $this->VALID_PROSPECTLASTNAME);
		$prospect->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProspect = Prospect::getProspectByProspectId($this->getPDO(), $prospect->getProspectId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("prospect"));
		$this->assertEquals($pdoProspect->getProspectPhoneNumber(), $this->VALID_PROSPECTPHONENUMBER);
		$this->assertEquals($pdoProspect->getProspectEmail(), $this->VALID_PROSPECTEMAIL);
		$this->assertEquals($pdoProspect->getProspectFirstName(), $this->VALID_PROSPECTFIRSTNAME);
		$this->assertEquals($pdoProspect->getProspectLastName(), $this->VALID_PROSPECTLASTNAME);
	}

	/**
	 * test inserting a Prospect that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidProspect() {
		// create a Prospect with a non null prospect id and watch it fail
		$prospect = new Prospect(AaaaTest::INVALID_KEY, $this->VALID_PROSPECTPHONENUMBER, $this->VALID_PROSPECTEMAIL, $this->VALID_PROSPECTFIRSTNAME, $this->VALID_PROSPECTLASTNAME);
		$prospect->insert($this->getPDO());
	}

	/**
	 * test grabbing a Prospect by prospect content
	 **/
	public function testGetValidProspectByProspectName() {

		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("prospect");

		// create a new Prospect and insert to into mySQL
		$prospect = new Prospect(null, $this->VALID_PROSPECTPHONENUMBER, $this->VALID_PROSPECTEMAIL, $this->VALID_PROSPECTFIRSTNAME, $this->VALID_PROSPECTLASTNAME);
		$prospect->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Prospect::getProspectsByProspectName($this->getPDO(), $prospect->getProspectFirstName());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("prospect"));
		$this->assertNotNull($results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\Prospect", $results);

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProspect = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("prospect"));
		$this->assertEquals($pdoProspect->getProspectPhoneNumber(), $this->VALID_PROSPECTPHONENUMBER);
		$this->assertEquals($pdoProspect->getProspectEmail(), $this->VALID_PROSPECTEMAIL);
		$this->assertEquals($pdoProspect->getProspectFirstName(), $this->VALID_PROSPECTFIRSTNAME);
		$this->assertEquals($pdoProspect->getProspectLastName(), $this->VALID_PROSPECTLASTNAME);
	}
	
	/**
	 * test grabbing a Prospect by content that does not exist
	 *
	 * @expectedException \PDOException
	 **/
	public function testGetInvalidProspectByProspectStaffId() {
		// grab a prospect by searching for content that does not exist
		$prospect = new Prospect(AaaaTest::INVALID_KEY, $this->VALID_PROSPECTPHONENUMBER, $this->VALID_PROSPECTEMAIL, $this->VALID_PROSPECTFIRSTNAME, $this->VALID_PROSPECTLASTNAME);
		$prospect->insert($this->getPDO());
	}
	
	
	/**
	 * test grabbing all Prospects
	 **/
	public function testGetAllValidProspects() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("prospect");

		// create a new Prospect and insert to into mySQL
		$prospect = new Prospect(null, $this->VALID_PROSPECTPHONENUMBER, $this->VALID_PROSPECTEMAIL, $this->VALID_PROSPECTFIRSTNAME, $this->VALID_PROSPECTLASTNAME);
		$prospect->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Prospect::getAllProspects($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("prospect"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\Prospect", $results);

		// grab the result from the array and validate it
		$pdoProspect = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("prospect"));
		$this->assertEquals($pdoProspect->getProspectPhoneNumber(), $this->VALID_PROSPECTPHONENUMBER);
		$this->assertEquals($pdoProspect->getProspectEmail(), $this->VALID_PROSPECTEMAIL);
		$this->assertEquals($pdoProspect->getProspectFirstName(), $this->VALID_PROSPECTFIRSTNAME);
		$this->assertEquals($pdoProspect->getProspectLastName(), $this->VALID_PROSPECTLASTNAME);
	}
	
}
<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{
	Application
};

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");


class ApplicationTest extends AaaaTest {

	protected $VALID_APPLICATIONID = 0;

	protected $VALID_APPLICATIONFIRSTNAME = 'Joe';

	protected $VALID_APPLICATIONLASTNAME = 'Shmoe';

	protected $VALID_APPLICATIONEMAIL = "foo@bar.com";

	protected $VALID_APPLICATIONPHONENUMBER = "+12125551212";

	protected $VALID_APPLICATIONSOURCE = 'test';

	protected $VALID_APPLICATIONABOUTYOU = 'test2';

	protected $VALID_APPLICATIONHOPETOACCOMPLISH = 'test3';

	protected $VALID_APPLICATIONEXPERIENCE = 'test4';

	protected $VALID_APPLICATIONDATETIME = null;

	protected $VALID_APPLICATIONUTMCAMPAIGN = 'test5';

	protected $VALID_APPLICATIONUTMMEDIUM = 'test6';

	protected $VALID_APPLICATIONUTMSOURCE = 'test7';





	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();


		// calculate the date (just use the time the unit test was setup...)
		$this->VALID_APPLICATIONDATETIME = new \DateTime();
	}

	/**
	 * test inserting a valid Application and verify that the actual mySQL data matches
	 **/
	public function testInsertValidApplication() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("application");

		// create a new Application and insert to into mySQL
		$application = new Application(null, $this->VALID_APPLICATIONFIRSTNAME, $this->VALID_APPLICATIONLASTNAME, $this->VALID_APPLICATIONEMAIL,
			$this->VALID_APPLICATIONPHONENUMBER, $this->VALID_APPLICATIONSOURCE, $this->VALID_APPLICATIONABOUTYOU, $this->VALID_APPLICATIONHOPETOACCOMPLISH, $this->VALID_APPLICATIONEXPERIENCE, $this->VALID_APPLICATIONDATETIME, $this->VALID_APPLICATIONUTMCAMPAIGN, $this->VALID_APPLICATIONUTMMEDIUM, $this->VALID_APPLICATIONUTMSOURCE);
		$application->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoApplication = Application::getApplicationByApplicationId($this->getPDO(), $application->getApplicationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("application"));
		//$this->assertEquals($pdoApplication->getApplicationId(), $this->VALID_APPLICATIONID);
		$this->assertEquals($pdoApplication->getApplicationDateTime(), $this->VALID_APPLICATIONDATETIME);
	}

	/**
	 * test inserting a Application that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidApplication() {
		// create a Application with a non null application id and watch it fail
		$application = new Application(AaaaTest::INVALID_KEY, $this->VALID_APPLICATIONID, $this->VALID_APPLICATIONCOHORTID,
			$this->VALID_APPLICATIONDATETIME);
		$application->insert($this->getPDO());
	}

	/**
	 * test inserting an Application , editing it, and then updating it
	 **/
	public function testUpdateValidApplication() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("application");

		// create a new Application and insert to into mySQL
		$application = new Application(null, $this->APPLICATIONID->getApplicationCohortId(), $this->VALID_APPLICATIONEMAIL,
			$this->VALID_APPLICATIONPHONENUMBER, $this->VALID_APPLICATIONDATETIME);
		$application->insert($this->getPDO());

		// edit the Application and update it in mySQL
		$application->setApplicationId($this->VALID_APPLICATIONEMAIL);
		$application->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoApplication = Application::getApplicationByApplicationId($this->getPDO(), $application->getApplicationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("application"));
		//$this->assertEquals($pdoApplication->getApplicationId(), $this->VALID_APPLICATIONID);
		$this->assertEquals($pdoApplication->getApplicationCohortId(), $this->VALID_APPLICATIONCOHORTID);
		$this->assertEquals($pdoApplication->getApplicationDateTime(), $this->VALID_APPLICATIONDATETIME);
	}

	/**
	 * test updating Application that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidApplication() {
		// create a Application, try to update it without actually updating it and watch it fail
		$application = new Application(null, $this->applicationId->getApplicationCohortId(),
			$this->VALID_APPLICATIONPHONENUMBER, $this->VALID_APPLICATIONEMAIL);
		$application->update($this->getPDO());
	}



	/**
	 * test grabbing a Application by Application content
	 **/
	public function testGetValidApplicationByApplicationApplicationCohortId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("application");

		// create a new Application and insert to into mySQL
		$application = new Application(null, $this->VALID_APPLICATIONPHONENUMBER, $this->VALID_APPLICATIONLASTNAME);
		$application->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Application::getApplicationByApplicationId($this->getPDO(), $application->getApplicationtCohortId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("application"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf(results, "Edu\\Cnm\\DdcAaaa\\Test\\StudentPermit");

		// grab the result from the array and validate it
		$pdoApplication = $results[0];
		$this->assertEquals($pdoApplication->getApplicationId(), $this->VALID_APPLICATIONCOHORTID);
		$this->assertEquals($pdoApplication->getApplicationFirstName(), $this->VALID_APPLICATIONLASTNAME);
		$this->assertEquals($pdoApplication->getApplicationDateTime(), $this->VALID_APPLICATIONLASTNAME);
	}

	/**
	 * test grabbing a Application by content that does not exist
	 **/
	public function testGetInvalidApplicationtByApplicationId() {
		// grab a Application by searching for content that does not exist
		$Application = Application::getApplicationId($this->getPDO(), "you will find nothing");
		$this->assertCount(0, $Application);
	}

	/**
	 * test grabbing all ApplicationId
	 **/
	public function testGetAllValidApplications() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("application");

		// create a new ApplicationId and insert to into mySQL
		$Application = new ApplicationId(null, $this->VALID_APPLICATIONID);
		$Application->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Application::getAllApplications($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Application"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\Test\\Application", $results);

		// grab the result from the array and validate it
		$pdoApplication = $results[0];
		$this->assertEquals($pdoApplication->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoApplication->getApplicationFirstName(), $this->VALID_APPLICATIONIDLASTNAME);
		$this->assertEquals($pdoApplication->getApplicationDateTime(), $this->VALID_APPLICATIONLASTNAME);
	}
}
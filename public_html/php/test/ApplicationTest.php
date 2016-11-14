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

	protected $VALID_APPLICATIONFIRSTNAME = 1;

	protected $VALID_APPLICATIONLASTNAME = 1;

	protected $VALID_APPLICATIONEMAIL = "foo@bar.com";

	protected $VALID_APPLICATIONPHONENUMBER = "+12125551212";

	protected $VALID_APPLICATIONCOHORTID = null;

	protected $VALID_APPLICATIONDATETIME = null;


	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// create and insert a Profile to own the test Application
		$this->VALID_APPLICATIONID = mrosado2("+12125551212");
		$this->profile->insert($this->getPDO());

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
		$application = new Application(null, $this->VALID_APPLICATIONID, $this->VALID_APPLICATIONCOHORTID,
			$this->VALID_APPLICATIONDATETIME);
		$application->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTweet = Application::getApplicationByApplicationId($this->getPDO(), $application->getApplicationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("application"));
		//$this->assertEquals($pdoApplication->getApplicationId(), $this->VALID_APPLICATIONID);
		$this->assertEquals($pdoApplication->getApplicationCohortId(), $this->VALID_APPLICATIONCOHORTID);
		$this->assertEquals($pdoApplication->getApplicationDateTime(), $this->VALID_APPLICATIONDATETIME);
	}

	/**
	 * test inserting a Tweet that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidTweet() {
		// create a Tweet with a non null tweet id and watch it fail
		$tweet = new Tweet(DataDesignTest::INVALID_KEY, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());
	}

	/**
	 * test inserting a Tweet, editing it, and then updating it
	 **/
	public function testUpdateValidTweet() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tweet");

		// create a new Tweet and insert to into mySQL
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());

		// edit the Tweet and update it in mySQL
		$tweet->setTweetContent($this->VALID_TWEETCONTENT2);
		$tweet->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTweet = Tweet::getTweetByTweetId($this->getPDO(), $tweet->getTweetId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_TWEETCONTENT2);
		$this->assertEquals($pdoTweet->getTweetDate(), $this->VALID_TWEETDATE);
	}

	/**
	 * test updating a Tweet that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidTweet() {
		// create a Tweet, try to update it without actually updating it and watch it fail
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->update($this->getPDO());
	}



	/**
	 * test grabbing a Tweet by tweet content
	 **/
	public function testGetValidTweetByTweetContent() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tweet");

		// create a new Tweet and insert to into mySQL
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Tweet::getTweetByTweetContent($this->getPDO(), $tweet->getTweetContent());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Dmcdonald21\\DataDesign\\Tweet", $results);

		// grab the result from the array and validate it
		$pdoTweet = $results[0];
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_TWEETCONTENT);
		$this->assertEquals($pdoTweet->getTweetDate(), $this->VALID_TWEETDATE);
	}

	/**
	 * test grabbing a Application by content that does not exist
	 **/
	public function testGetInvalidTweetByTweetContent() {
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
		$pdoTweet = $results[0];
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_TWEETCONTENT);
		$this->assertEquals($pdoTweet->getTweetDate(), $this->VALID_TWEETDATE);
	}
}
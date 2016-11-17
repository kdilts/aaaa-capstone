<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{
	Bridge
};

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");

/**
 * Full PHPUnit test for the Bridge class
 *
 * This is a complete PHPUnit test of the Bridge class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Bridge
 *
 **/
class BridgeTest extends AaaaTest {
	/**
	 * content of the Bridge
	 * @var string $VALID_BRIDGESTAFFID
	 **/
	protected $VALID_BRIDGESTAFFID = 0;

	protected $VALID_BRIDGENAME = 1;

	protected $VALID_BRIDGEUSERNAME = 2;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();
	}
	/**
	 * test inserting a valid Bridge and verify that the actual mySQL data matches
	 **/
	public function testInsertValidBridge() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("bridge");

		// create a new Bridge and insert to into mySQL
		$bridge = new Bridge(null, $this->VALID_BRIDGENAME, $this->VALID_BRIDGEUSERNAME);
		$bridge->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoBridge = Bridge::getBridgeByBridgeStaffId($this->getPDO(), $bridge->getBridgeStaffId());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("bridge"));
		//$this->assertEquals($pdoBridge->getBridgeStaffId(), $this->VALID_BRIDGESTAFFID);
		$this->assertEquals($pdoBridge->getBridgeName(), $this->VALID_BRIDGENAME);
		$this->assertEquals($pdoBridge->getBridgeUserName(), $this->VALID_BRIDGEUSERNAME);
	}

	/**
	 * test inserting a Bridge that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidBridge() {
		// create a Bridge with a non null bridge id and watch it fail
		$bridge = new Bridge(AaaaTest::INVALID_KEY, $this->bridge->get->BridgeStaffId(), $this->VALID_BRIDGENAME);
		$bridge->insert($this->getPDO());
	}

	/**
	 * test inserting a Bridge, editing it, and then updating it
	 **/
	public function testUpdateValidBridge() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("bridge");

		// create a new Bridge and insert to into mySQL
		$bridge = new Bridge(null, $this->bridge->getBridgeStaffId(), $this->VALID_BRIDGENAME);
		$bridge->insert($this->getPDO());

		// edit the Bridge and update it in mySQL
		$bridge->setBridgeName($this->VALID_BRIDGENAME2);
		$bridge->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoBridge = Bridge::getTweetByTweetId($this->getPDO(), $tweet->getTweetId());
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
	 * test creating a Tweet and then deleting it
	 **/
	public function testDeleteValidTweet() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tweet");

		// create a new Tweet and insert to into mySQL
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());

		// delete the Tweet from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$tweet->delete($this->getPDO());

		// grab the data from mySQL and enforce the Tweet does not exist
		$pdoTweet = Tweet::getTweetByTweetId($this->getPDO(), $tweet->getTweetId());
		$this->assertNull($pdoTweet);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("tweet"));
	}

	/**
	 * test deleting a Tweet that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidTweet() {
		// create a Tweet and try to delete it without actually inserting it
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->delete($this->getPDO());
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
	 * test grabbing a Tweet by content that does not exist
	 **/
	public function testGetInvalidTweetByTweetContent() {
		// grab a tweet by searching for content that does not exist
		$tweet = Tweet::getTweetByTweetContent($this->getPDO(), "you will find nothing");
		$this->assertCount(0, $tweet);
	}

	/**
	 * test grabbing all Tweets
	 **/
	public function testGetAllValidTweets() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tweet");

		// create a new Tweet and insert to into mySQL
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Tweet::getAllTweets($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Dmcdonald21\\DataDesign\\Tweet", $results);

		// grab the result from the array and validate it
		$pdoTweet = $results[0];
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_TWEETCONTENT);
		$this->assertEquals($pdoTweet->getTweetDate(), $this->VALID_TWEETDATE);
	}
}
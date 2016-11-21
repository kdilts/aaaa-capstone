<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{Note};

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");

/**
 * Full PHPUnit test for the Note class
 *
 * This is a complete PHPUnit test of the Note class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Note
 * @author Jeremiah Z. Wood jwood47@cnm.edu
 **/
class NoteTest extends AaaaTest {
	/**
	 * content of the Note
	 * @var string $VALID_NOTECONTENT
	 **/
	protected $VALID_NOTECONTENT = "PHPUnit test passing";
	/**
	 * content of the updated Note
	 * @var string $VALID_NOTECONTENT2
	 **/
	protected $VALID_NOTECONTENT2 = "PHPUnit test still passing";
	/**
	 * timestamp of the Note; this starts as null and is assigned later
	 * @var DateTime $VALID_NOTEDATE
	 **/
	protected $VALID_NOTEDATE = null;
	/**
	 * Profile that created the Note; this is for foreign key relations
	 * @var Profile profile
	 **/
	protected $profile = null;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// create and insert a Profile to own the test Tweet
		$this->profile = new Profile(null, "@phpunit", "test@phpunit.de", "+12125551212");
		$this->profile->insert($this->getPDO());

		// calculate the date (just use the time the unit test was setup...)
		$this->VALID_NOTEDATE = new \DateTime();
	}

	/**
	 * test inserting a valid Note and verify that the actual mySQL data matches
	 **/
	public function testInsertValidNote() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("note");

		// create a new Note and insert to into mySQL
		$note = new Note(null, $this->profile->getProfileId(), $this->VALID_NOTECONTENT, $this->VALID_NOTEDATE);
		$note->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoNote = Note::getNoteByNoteId($this->getPDO(), $note->getNoteId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("note"));
		$this->assertEquals($pdoNote->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoNote->getNoteContent(), $this->VALID_NOTECONTENT);
		$this->assertEquals($pdoNote->getNoteDate(), $this->VALID_NOTEDATE);
	}

	/**
	 * test inserting a Note that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidNote() {
		// create a Note with a non null note id and watch it fail
		$note = new Note(DataDesignTest::INVALID_KEY, $this->profile->getProfileId(), $this->VALID_NOTECONTENT, $this->VALID_NOTEDATE);
		$note->insert($this->getPDO());
	}

	//TODO function getValidNoteByNoteId

	//TODO function getInvalidNoteByNoteId

	//TODO getValidNoteByNoteApplicationId

	//TODO getInvalidNoteByNoteApplicationId

	//TODO getValidNoteByNoteProspectId

	//TODO getInvalidNoteByNoteProspectId

	//TODO getValidNoteByNoteNoteTypeId

	//TODO getInvalidNoteByNoteNoteTypeId

	/**
	 * test grabbing all Notes
	 **/
	public function testGetAllValidNotes() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("note");

		// create a new Note and insert to into mySQL
		$note = new Note(null, $this->profile->getProfileId(), $this->VALID_NOTECONTENT, $this->VALID_NOTEDATE);
		$note->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Note::getAllNotes($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("note"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\Note", $results);

		// grab the result from the array and validate it
		$pdoNote = $results[0];
		$this->assertEquals($pdoNote->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoNote->getNoteContent(), $this->VALID_NOTECONTENT2);
		$this->assertEquals($pdoNote->getNoteDate(), $this->VALID_NOTEDATE);
	}
}
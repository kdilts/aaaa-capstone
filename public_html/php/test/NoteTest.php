<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{Note,Prospect,NoteType,Application};

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
	 * Prospect that created the Note; this is for foreign key relations
	 * @var Prospect profile
	 **/
	protected $prospect = null;
	/**
	 * prospect that created the Note;
	 * @var null
	 */
	protected $noteType = null;
	/**
	 *
	 */
	protected $application = null;
	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// create and insert a Prospect to own the test note
		$this->prospect = new Prospect(null, "@phpunit", "test@phpunit.de", "+12125551212","first name","last name");
		$this->prospect->insert($this->getPDO());

		$this->noteType = new NoteType(null,"string");
		$this->noteType->insert($this->getPDO());

		$this->application = new Application(null, "john", "doe", "em@ail.com", "555-555-5555", "source", "about you", "hope", "exp",new \DateTime(), "utmC","utmM", "utmS");
		$this->application->insert($this->getPDO());
	}
	/**
	 * int $newNoteId = null, string $newNoteContent, int $newNoteNoteTypeId, int $newNoteApplicationId, int $newNoteProspectId
	 */

	/**
	 * test inserting a valid Note and verify that the actual mySQL data matches
	 **/
	public function testInsertValidNote() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("note");

		// create a new Note and insert it to into mySQL
		$note = new Note(null,$this->VALID_NOTECONTENT, $this->noteType->getNoteTypeId(),$this->application->getApplicationId(), $this->prospect->getProspectId());
		$note->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoNote = Note::getNoteByNoteId($this->getPDO(), $note->getNoteId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("note"));
		$this->assertEquals($pdoNote->getNoteProspectId(), $this->prospect->getProspectId());
		$this->assertEquals($pdoNote->getNoteContent(), $this->VALID_NOTECONTENT);
	}

	/**
	 * test inserting a Note that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidNote() {
		// create a Note with a non null note id and watch it fail
		$note = new Note(AaaaTest::INVALID_KEY,$this->VALID_NOTECONTENT, $this->noteType->getNoteTypeId(), $this->application->getApplicationId(),$this->prospect->getProspectId());
		$note->insert($this->getPDO());
	}

	/**
	 * test inserting a valid Note and verify that the actual mySQL data matches
	 */
	public function testGetValidNoteByNoteId (){
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("note");

		//create a new Note and insert it to into mySQL
		$note = new Note(null, $this->VALID_NOTECONTENT, $this->noteType->getNoteTypeId(),$this->application->getApplicationId(), $this->prospect->getProspectId());
		$note->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoNote = Note::getNoteByNoteId($this->getPDO(), $note->getNoteId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("note"));
		$this->assertEquals($pdoNote->getNoteProspectId(),$this->prospect->getProspectId());
		$this->assertEquals($pdoNote->getNoteContent(), $this->VALID_NOTECONTENT);
		$this->assertInstanceOf("Edu\\Cnm\\DdcAaaa\\Note",$pdoNote);
	}
	/**
	 * Test inserting a Note that already exists
	 */
	public function testInsertInvalidNoteByNoteId() {
		//create a Note with a non null note id and watch it fail
		$note = Note::getNoteByNoteId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertNull($note);
	}

	/**
	 * test inserting a valid Note and verify that the actual mySQL data matches
	 */
	public function testGetValidNoteByNoteApplicationId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("note");

		//create a new Note and insert it to into mySQL
		$note = new Note(null, $this->VALID_NOTECONTENT, $this->noteType->getNoteTypeId(),$this->application->getApplicationId(),$this->prospect->getProspectId());
		$note->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Note::getNoteByNoteApplicationId($this->getPDO(), $note->getNoteId());
		$pdoNote = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("note"));
		$this->assertEquals($pdoNote->getNoteProspectId(), $this->prospect->getProspectId());
		$this->assertEquals($pdoNote->getNoteContent(), $this->VALID_NOTECONTENT);
		$this->assertInstanceOf("Edu\\Cnm\\DdcAaaa\\Note",$pdoNote);
	}

	/**
	 * Test inserting a Note that already exists
	 */
	public function testInsertInvalidNoteByNoteApplicationId() {
		//create a note with a non null note id  and watch it fail
		$note = Note::getNoteByNoteApplicationId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertEmpty($note);
	}

	/**
	 * test inserting a valid Note and verify that the actual mySQL data matches
	 */
	public function testGetValidNoteByNoteProspectId(){
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("note");

		//create a new Note and insert it to into mySQL
		$note = new Note(null, $this->VALID_NOTECONTENT, $this->noteType->getNoteTypeId(),$this->application->getApplicationId(),$this->prospect->getProspectId());
		$note->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoNote = Note::getNoteByNoteProspectId($this->getPDO(), $note->getNoteId());
		$this->assertEquals($numRows = 1, $this->getConnection()->getRowCount("note"));
		$this->assertEquals($pdoNote->getNoteProspectId(), $this->prospect->getProspectId());
		$this->assertEquals($pdoNote->getNoteContent(), $this->VALID_NOTECONTENT);
		$this->assertInstanceOf("Edu\\Cnm\\DdcAaaa\\Note",$pdoNote);
	}

	/**
	 * test inserting a note that already exists
	 */
	public function testInsertInvalidNoteByNoteProspectId(){
		//creat a note with a none null note id and watch it fail
		$note = Note::getNoteByNoteProspectId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertEmpty($note);
	}
	/**
	 * test inserting a valid Note and verify that the actual mySQL data matches
	 */
	public function testGetValidNoteByNoteNoteTypeId(){
		//count the number of rows and save it for later
		$numRows = $this->getConneciton()->getRowCount("note");

		//create a new Note and insert it to mySQL
		$note = new Note(null, $this->VALID_NOTECONTENT, $this->noteType->getNoteTypeId(),$this->application->getApplicationId(),$this->prospect->getProspectId());
		$note->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoNote = Note::getNoteByNoteNoteTypeId($this->getPDO(), $note->getNoteId());
		$this->assertEquals($numRows = 1, $this->getConnection()->getRowCount("note"));
		$this->assertEquals($pdoNote->getNoteProspectId(), $this->prospect->getProspectId());
		$this->assertEquals($pdoNote->getNoteContent(), $this->VALID_NOTECONTENT);
		$this->assertInstanceOf("Edu\\Cnm\\DdcAaaa\\Note",$pdoNote);
	}

	/**
	 * test inserting a note that already exists
	 */
	public function testInsertInvalidNoteByNoteNoteTypeId(){
		//create a note with a none null note id and watch it fail
		$note = Note::getNoteByNoteNoteTypeId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertEmpty($note);
	}
	/**
	 * test grabbing all Notes
	 **/
	public function testGetAllValidNotes() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("note");

		// create a new Note and insert to into mySQL
		$note = new Note(null, $this->VALID_NOTECONTENT, $this->noteType->getNoteTypeId(),$this->application->getApplicationId(),$this->prospect->getProspectId());
		$note->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Note::getAllNotes($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("note"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\Note", $results);

		// grab the result from the array and validate it
		$pdoNote = $results[0];
		$this->assertEquals($numRows = 1, $this->getConnection()->getRowCount("note"));
		$this->assertEquals($pdoNote->getNoteProspectId(), $this->prospect->getProspectId());
		$this->assertEquals($pdoNote->getNoteContent(), $this->VALID_NOTECONTENT);
		$this->assertInstanceOf("Edu\\Cnm\\DdcAaaa\\Note",$pdoNote);
	}
}
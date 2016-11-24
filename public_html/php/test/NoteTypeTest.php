<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{
	NoteType
};

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");


class NoteTypeTest extends AaaaTest {
	/**
	 * content of the NoteType
	 * @var string $VALID_NOTETYPENAME
	 **/
	protected $VALID_NOTETYPENAME = 'foo';
	/**
	 * @var int $VALID_NOTETYPEID
	 */
	protected $VALID_NOTETYPEID = '5';


	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();
		$this->noteType = new NoteType(null, 2);
		$this->noteType->insert($this->getPDO());
	}

	/**
	 * test inserting a valid NoteType and verify that the actual mySQL data matches
	 **/
	public function testInsertValidNoteType() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("noteType"); //What does this do? -Trevor

		// create a new NoteType and insert to into mySQL
		$noteType = new NoteType(null, $this->VALID_NOTETYPENAME, $this->VALID_NOTETYPEID);
		$noteType->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoNoteType = NoteType::getNoteTypeByNoteTypeName($this->getPDO(), $noteType->getNoteTypeName());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("noteType"));
		//$this->assertEquals($pdoNoteType->getNoteTypeName(), $this->VALID_NOTETYPENAME;
		$this->assertEquals($pdoNoteType->getNoteTypeId(), $this->VALID_NOTETYPEID);
	}

	/**
	 * test inserting a NoteType that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidNoteType() {
		// create a NoteType with a non null NoteTypeName and watch it fail
		$noteType = new NoteType(AaaaTest::INVALID_KEY, $this->VALID_NOTETYPENAME);
		$noteType->insert($this->getPDO());
	}

	/**
	 * test inserting a NoteType, editing it, and then updating it
	 **/
	public function testUpdateValidNoteType() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("noteType");

		// create a new NoteType and insert to into mySQL
		$noteType = new NoteType(null, $this->noteType->getNoteTypeName(), $this->VALID_NOTETYPENAME);
		$noteType->insert($this->getPDO());

		// edit the NoteType and update it in mySQL
		$noteType->setNoteTypeName($this->VALID_NOTETYPENAME);
		$noteType->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoNoteType = NoteType::getNoteTypeByNoteTypeName($this->getPDO(), $noteType->getNoteTypeName());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("noteType"));
		$this->assertEquals($pdoNoteType->getNoteTypeName(), $this->noteType->getNoteTypeName());
		$this->assertEquals($pdoNoteType->getNoteTypeName(), $this->VALID_NOTETYPENAME);
		$this->assertEquals($pdoNoteType->getNoteTypeId(), $this->VALID_NOTETYPEID);
	}

	/**
	 * test grabbing all NoteType
	 **/
	public function testGetAllValidNoteType() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("noteType");

		// create a new NoteType and insert to into mySQL
		$noteType = new NoteType(null, $this->VALID_NOTETYPENAME);
		$noteType->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = NoteType::getAllNoteTypes($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("noteType"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\NoteType", $results);

		// grab the result from the array and validate it
		$pdoNoteType = $results[0];
		$this->assertEquals($pdoNoteType->getNoteTypeName(), $this->VALID_NOTETYPENAME);
		$this->assertEquals($pdoNoteType->getNoteTypeId(), $this->VALID_NOTETYPEID);
	}
}
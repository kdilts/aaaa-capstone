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
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();
	}

	/**
	 * test inserting a valid NoteType and verify that the actual mySQL data matches
	 **/
	public function testInsertValidNoteType() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("noteType"); //What does this do? -Trevor

		// create a new NoteType and insert to into mySQL
		$noteType = new NoteType(null, $this->VALID_NOTETYPENAME);
		$noteType->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoNoteType = NoteType::getNoteTypeByNoteTypeId($this->getPDO(), $noteType->getNoteTypeId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("noteType"));
		$this->assertEquals($pdoNoteType->getNoteTypeId(),$noteType->getNoteTypeId());
		$this->assertEquals($pdoNoteType->getNoteTypeName(), $noteType->getNoteTypeName());
	}

	/**
	 * test inserting a NoteType that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidNoteType() {
		// create a NoteType with a non null NoteTypeName and watch it fail
		$noteType = new NoteType(AaaaTest::INVALID_KEY, $this->VALID_NOTETYPENAME);
		$noteType->insert($this->getPDO());
	}

	/**
	 * test grabbing a NoteType by noteType id
	 **/
	public function testGetValidNoteTypeByNoteTypeId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("noteType");

		// create a new NoteType and insert to into mySQL
		$noteType = new NoteType(null, $this->VALID_NOTETYPENAME);
		$noteType->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$result = NoteType::getNoteTypeByNoteTypeId($this->getPDO(), $noteType->getNoteTypeId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("noteType"));
		$this->assertNotNull($result);
		$this->assertInstanceOf("Edu\\Cnm\\DdcAaaa\\NoteType", $result);

		$this->assertEquals($result->getNoteTypeId(),$noteType->getNoteTypeId());
		$this->assertEquals($result->getNoteTypeName(), $noteType->getNoteTypeName());
	}

	/**
	 * test grabbing a NoteType by id that does not exist
	 **/
	public function testGetInvalidNoteTypeByNoteTypeId() {
		// grab a noteType by searching for id that does not exist
		$noteType = NoteType::getNoteTypeByNoteTypeId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertNull($noteType);
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
		$this->assertEquals($pdoNoteType->getNoteTypeId(), $noteType->getNoteTypeId());
		$this->assertEquals($pdoNoteType->getNoteTypeName(), $this->VALID_NOTETYPENAME);
	}
}
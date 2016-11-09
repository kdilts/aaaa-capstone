<?php
namespace Edu\Cnm\DdcAaaa;

class Note {
	/**
	 * @var string $noteContent
	 */
	private $noteContent;

	/**
	 * @var int noteNoteTypeId
	 */
	private $noteNoteTypeId;
	/**
	 * @var int $noteStudentId
	 */
	private $noteStudentId;
	/**
	 * @var int $noteId
	 */
	private $noteId;

	/***
	 * Note constructor.
	 * @param int|null $newNoteId
	 * @param string $newNoteContent
	 * @param int $newNoteNoteTypeId
	 * @param int $newNoteStudentId
	 * @throws \InvalidArgumentException
	 * @throws \RangeException
	 * @throws \TypeError
	 * @throws \Exception
	 */
	public function __construct(int $newNoteId, string $newNoteContent, int $newNoteNoteTypeId, int $newNoteStudentId) {
		try {
			$this->setNoteId($newNoteId);
			$this->setNoteContent($newNoteContent);
			$this->setNoteNoteTypeId($newNoteNoteTypeId);
			$this->setNoteStudentId($newNoteStudentId);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * @return int|null value of note id
	 */
	public function getNoteId() {
		return($this->noteId);
	}

	/**
	 * @return string value of note content
	 */
	public function getNoteContent() {
		return($this->noteContent);
	}

	/**
	 * @return int|null of note note type id
	 */
	public function getNoteNoteTypeId() {
		return($this->noteNoteTypeId);
	}

	/**
	 * @return int|null of note student id
	 */
	public function getNoteStudentId() {
		return($this->noteStudentId);
	}

	/**
	 * @param int $newNoteId
	 * @throws \RangeException
	 * @throws \TypeError if new note id is not an integer
	 */
	public function setNoteId(int $newNoteId = null) {
		if ($newNoteId === null) {
			$this->noteId = null;
			return;
		}

		if($newNoteId <= 0) {
			throw(new \RangeException("Note Id is not positive."));
		}
		$this->noteId = $newNoteId;
	}

	/**
	 * @param string $newNoteContent
	 * @throws \InvalidArgumentException if $newNoteContent is not a string or insecure
	 * @throws \RangeException
	 * @throws \TypeError if $newNoteContent is not a string
	 **/
	public function setNoteContent(string $newNoteContent) {
		$newNoteContent = trim($newNoteContent);
		$newNoteContent = filter_var($newNoteContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newNoteContent) === true) {
			throw (new \InvalidArgumentException("Note content is either empty or insecure."));
		}
		$this->noteContent = $newNoteContent;
	}

	/**
	 * @param int|null $newNoteNoteTypeId
	 * @throws \RangeException
	 * @throws \TypeError if $newNoteNoteId is not an integer
	 */
	public function setNoteNoteTypeId(int $newNoteNoteTypeId) {
		if($newNoteNoteTypeId < 0) {
			throw(new \RangeException("Note Note Type Id can't be negative."));
		}

		$this->noteNoteTypeId = $newNoteNoteTypeId;
	}

	/**
	 * @param int $newNoteStudentId
	 * @throws \RangeException
	 */
	public function setNoteStudentId(int $newNoteStudentId) {
		if($newNoteStudentId < 0) {
			throw(new \RangeException("Note Note Student Id can't be negative."));

		}
		$this->noteStudentId = $newNoteStudentId;
	}

	/**
	 * @param \PDO $pdo
	 * @throws \PDOException
	 */
	public function insert(\PDO $pdo) {
		// enforce the noteId is null (i.e., don't insert a noteId that already exists)
		if($this->noteId !== null) { //
			throw(new \PDOException("not a new noteId"));
		}
		// create query template
		$query = "INSERT INTO note(noteId, noteStudentId, noteNoteTypeId, noteContent) VALUES(:noteId, :noteStudentId, 
		noteNoteTypeId, :noteContent)";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$parameters = ["noteId" => $this->noteId, "noteStudentId" => $this->noteStudentId, "noteContent" => $this->noteContent];
		$statement->execute($parameters);
		// update the null noteId with what mySQL just gave us
		$this->noteId = intval($pdo->lastInsertId());
	}
	/**
	 * @param \PDO $pdo
	 * @throws \PDOException
	 */
	public function delete(\PDO $pdo) {
		// enforce the noteId is not null (i.e., don't delete a note that hasn't been inserted)
		if($this->noteId === null) {
			throw(new \PDOException("unable to delete a note that does not exist"));
		}
		// create query template
		$query = "DELETE FROM note WHERE noteId = :noteId";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holder in the template
		$parameters = ["notedId" => $this->noteId];
		$statement->execute($parameters);
	}
	/**
	 * @param \PDO $pdo
	 * @throws \PDOException
	 */
	public function update(\PDO $pdo) {
		// enforce the notedId is not null (i.e., don't update a note that hasn't been inserted)
		if($this->noteId === null) {
			throw(new \PDOException("unable to update a note that does not exist"));
		}
		// create query template
		$query = "UPDATE note SET noteId = :noteId, noteStudentId = :noteStudentId, noteNoteTypeId = noteNoteTypeId, 
		noteContent = :noteContent WHERE noteId = :noteId";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$parameters = ["noteId" => $this->noteId, "noteStudentId" => $this->noteStudentId, "noteNoteTypeId" =>
			$this->noteNoteTypeId, "noteContent" => $this->noteContent];
		$statement->execute($parameters);
	}
}
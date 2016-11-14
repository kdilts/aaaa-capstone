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
	 * @var int $noteApplicationId
	 */
	private $noteApplicationId;
	/**
	 * @var int $noteId
	 */
	private $noteId;

	/***
	 * Note constructor.
	 * @param int|null $newNoteId
	 * @param string $newNoteContent
	 * @param int $newNoteNoteTypeId
	 * @param int $newNoteApplicationId
	 * @throws \InvalidArgumentException
	 * @throws \RangeException
	 * @throws \TypeError
	 * @throws \Exception
	 */
	public function __construct(int $newNoteId, string $newNoteContent, int $newNoteNoteTypeId, int $newNoteApplicationId) {
		try {
			$this->setNoteId($newNoteId);
			$this->setNoteContent($newNoteContent);
			$this->setNoteNoteTypeId($newNoteNoteTypeId);
			$this->setNoteApplicationId($newNoteApplicationId);
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
	public function getNoteApplicationId() {
		return($this->noteApplicationId);
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
	 * @param int $newNoteApplicationId
	 * @throws \RangeException
	 */
	public function setNoteApplicationId(int $newNoteApplicationId) {
		if($newNoteApplicationId < 0) {
			throw(new \RangeException("Note Note Student Id can't be negative."));

		}
		$this->noteApplicationId = $newNoteApplicationId;
	}

	/**
	 * @param \PDO $pdo
	 * @return \SplFixedArray
	 * @throws \PDOException
	 */
	public function insert(\PDO $pdo) {
		// enforce the noteId is null (i.e., don't insert a noteId that already exists)
		if($this->noteId !== null) { //
			throw(new \PDOException("not a new noteId"));
		}
		// create query template
		$query = "INSERT INTO note(noteId, noteApplicationId, noteNoteTypeId, noteContent) VALUES(:noteId, :noteApplicationId, 
		noteNoteTypeId, :noteContent)";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$parameters = ["noteId" => $this->noteId, "noteApplicationId" => $this->noteApplicationId, "noteContent" => $this->noteContent];
		$statement->execute($parameters);
		// update the null noteId with what mySQL just gave us
		$this->noteId = intval($pdo->lastInsertId());
		// bind the member variables to the place holders in the template
		$parameters = ["noteId" => $this->noteId, "noteApplicationId" => $this->noteApplicationId, "noteNoteTypeId" =>
			$this->noteNoteTypeId, "noteContent" => $this->noteContent];
		$statement->execute($parameters);
	}

	/**
	 * @return array
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}
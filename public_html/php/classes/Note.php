<?php
namespace Edu\Cnm\DdcAaaa;

class Note {
	/**
	 * actual content of the note
	 * @var string $noteContent
	 */
	private $noteContent;

	/**
	 * Id of the note that was sent by the user.
	 * @var int noteNoteTypeId
	 */
	private $noteNoteTypeId;
	/**
	 * Id of the applicant that sent the note
	 * @var int $noteApplicationId
	 */
	private $noteApplicationId;
	/**
	 * Id of the potential prospective student
	 * @var int $noteProspectId
	 */
	private $noteProspectId;
	/**
	 * Id of the note
	 * @var int $noteId
	 */
	private $noteId;

	/***
	 * Note constructor for this function.
	 * @param int|null $newNoteId
	 * @param string $newNoteContent
	 * @param int $newNoteNoteTypeId
	 * @param int $newNoteApplicationId
	 * @param int $newNoteProspectId
	 * @throws \InvalidArgumentException
	 * @throws \RangeException
	 * @throws \TypeError
	 * @throws \Exception
	 */
	public function __construct(int $newNoteId, string $newNoteContent, int $newNoteNoteTypeId, int $newNoteApplicationId, int $newNoteProspectId) {
		try {
			$this->setNoteId($newNoteId);
			$this->setNoteContent($newNoteContent);
			$this->setNoteNoteTypeId($newNoteNoteTypeId);
			$this->setNoteApplicationId($newNoteApplicationId);
			$this->setNoteProspectId($newNoteProspectId);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			//rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			//rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for note Id
	 *
	 * @return int|null value of note id
	 */
	public function getNoteId() {
		return($this->noteId);
	}

	/**
	 * accessor method for note content
	 *
	 * @return string value of note content
	 */
	public function getNoteContent() {
		return($this->noteContent);
	}

	/**
	 * accessor method for Id of the note
	 *
	 * @return int|null of note note type id
	 */
	public function getNoteNoteTypeId() {
		return($this->noteNoteTypeId);
	}

	/**
	 * accessor method for Id of the application
	 *
	 * @return int|null of note student id
	 */
	public function getNoteApplicationId() {
		return($this->noteApplicationId);
	}

	/**
	 * accessor method for Id of prospect note
	 *
	 * @return mixed
	 */
	public function getNoteProspectId() {
		return($this->noteProspectId);
	}

	/**
	 * mutator method for note Id
	 *
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
			//store the Note Id
		}
		$this->noteId = $newNoteId;
	}

	/**
	 * mutator method for the Content of the Note
	 *
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
			//store content of the note
		}
		$this->noteContent = $newNoteContent;
	}

	/**
	 * mutator method for note of the note Id
	 *
	 * @param int|null $newNoteNoteTypeId
	 * @throws \RangeException
	 * @throws \TypeError if $newNoteNoteId is not an integer
	 */
	public function setNoteNoteTypeId(int $newNoteNoteTypeId) {
		if($newNoteNoteTypeId < 0) {
			throw(new \RangeException("Note Note Type Id can't be negative."));
		}
//store id for the Note type
		$this->noteNoteTypeId = $newNoteNoteTypeId;
	}

	/**
	 * mutator method for application of the note
	 *
	 * @param int $newNoteApplicationId
	 * @throws \RangeException
	 */
	public function setNoteApplicationId(int $newNoteApplicationId) {
		if($newNoteApplicationId < 0) {
			throw(new \RangeException("Note Application Id can't be negative."));
//set application Id
		}
		$this->noteApplicationId = $newNoteApplicationId;
	}

	/**
	 * mutator method for note of the prospect Id
	 *
	 * @param int $newNoteProspectId
	 */
	public function setNoteProspectId(int $newNoteProspectId) {
		if($newNoteProspectId < 0) {
			throw(new \RangeException("Note Prospect Id can't be negative."));
//store prospect Id
		}
		$this->noteProspectId = $newNoteProspectId;
	}

	/**
	 * inserts note Id into mySQL
	 * @param \PDO $pdo
	 * @throws \PDOException
	 *
	 */
	public function insert(\PDO $pdo) {
		// enforce the noteId is null (i.e., don't insert a noteId that already exists)
		if($this->noteId !== null) { //
			throw(new \PDOException("not a new noteId"));
		}
		// create query template
		$query = "INSERT INTO note(noteId, noteApplicationId, noteProspectId, noteNoteTypeId, noteContent) VALUES(:noteId, :noteApplicationId, :noteProspectId, :noteNoteTypeId, :noteContent)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = [
			"noteId" => $this->noteId,
			"noteApplicationId" => $this->noteApplicationId,
			"noteProspectId" => $this->noteProspectId,
			"noteNoteTypeId" => $this->noteNoteTypeId,
			"noteContent" => $this->noteContent
		];
		$statement->execute($parameters);

		// update the null noteId with what mySQL just gave us
		$this->noteId = intval($pdo->lastInsertId());
	}

	/**
	 * insert note, by the note Id into the mySQL
	 * @param \PDO $pdo
	 * @param int $noteId
	 * @return \SplFixedArray
	 */
	public static function getNoteByNoteId(\PDO $pdo, int $noteId) {
		// sanitize the noteId before searching
		if($noteId <= 0) {
			throw(new \PDOException("noteId not positive"));
		}

		// create query template
		$query = "SELECT noteId, noteApplicationId, noteProspectId, noteNoteTypeId, noteContent FROM note WHERE noteId = :noteId";
		$statement = $pdo->prepare($query);

		// bind the note id to the place holder in template
		$parameters = ["noteId" => $noteId];
		$statement->execute($parameters);

		// build an array of notes
		$notes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$note = new Note($row["noteId"], $row["noteApplicationId"], $row["noteProspectId"], $row["noteNoteTypeId"], $row["noteContent"]);
				$notes[$notes->key()] = $note;
				$notes->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $notes;
	}

	/**
	 * get note by the noteApplicationId
	 * @param \PDO $pdo
	 * @param int $noteApplicationId
	 * @return \SplFixedArray
	 */
	public static function getNoteByNoteApplicationId(\PDO $pdo, int $noteApplicationId) {
		// sanitize the noteApplicationId before searching
		if($noteApplicationId <= 0) {
			throw(new \PDOException("noteApplicationId not positive"));
		}

		// create query template
		$query = "SELECT noteId, noteApplicationId, noteProspectId, noteNoteTypeId, noteContent FROM note WHERE noteId = :noteApplicationId";
		$statement = $pdo->prepare($query);

		// bind the noteApplication id to the place holder in template
		$parameters = ["noteApplicationId" => $noteApplicationId];
		$statement->execute($parameters);

		// build an array of notes
		$notes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$note = new Note($row["noteId"], $row["noteApplicationId"], $row["noteProspectId"], $row["noteNoteTypeId"], $row["noteContent"]);
				$notes[$notes->key()] = $note;
				$notes->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $notes;
	}

	/**
	 * @param \PDO $pdo
	 * @param int $noteProspectId
	 * @return \SplFixedArray
	 */
	public static function getNoteByNoteProspectId(\PDO $pdo, int $noteProspectId) {
		// sanitize the noteProspectId before searching
		if($noteProspectId <= 0) {
			throw(new \PDOException("noteProspectId not positive"));
		}

		// create query template
		$query = "SELECT noteId, noteApplicationId, noteProspectId, noteNoteTypeId, noteContent FROM note WHERE noteId = :noteProspectId";
		$statement = $pdo->prepare($query);

		// bind the noteProspect id to the place holder in template
		$parameters = ["noteProspectId" => $noteProspectId];
		$statement->execute($parameters);

		// build an array of notes
		$notes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$note = new Note($row["noteId"], $row["noteApplicationId"], $row["noteProspectId"], $row["noteNoteTypeId"], $row["noteContent"]);
				$notes[$notes->key()] = $note;
				$notes->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $notes;
	}

	/**
	 * @param \PDO $pdo
	 * @param int $noteNoteTypeId
	 * @return \SplFixedArray
	 */
	public static function getNoteByNoteNoteTypeId(\PDO $pdo, int $noteNoteTypeId) {
		// sanitize the noteNoteTypeId before searching
		if($noteNoteTypeId <= 0) {
			throw(new \PDOException("noteNoteTypeId not positive"));
		}

		// create query template
		$query = "SELECT noteId, noteApplicationId, noteProspectId, noteNoteTypeId, noteContent FROM note WHERE noteId = :noteNoteTypeId";
		$statement = $pdo->prepare($query);

		// bind the noteNoteType id to the place holder in template
		$parameters = ["noteNoteTypeId" => $noteNoteTypeId];
		$statement->execute($parameters);

		// build an array of notes
		$notes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$note = new Note($row["noteId"], $row["noteApplicationId"], $row["noteProspectId"], $row["noteNoteTypeId"], $row["noteContent"]);
				$notes[$notes->key()] = $note;
				$notes->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $notes;
	}
	public static function getAllNotes(\PDO $pdo){
		//create query template
	$query = "SELECT noteId, noteApplicationId, noteProspectId, noteNoteTypeId, noteContent FROM note";
		$statement = $pdo->prepare($query);
		$statement->execute();

		//build an array of placards
		$notes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false){
			try{
				$notes = new Note($row["noteId"], $row["noteApplicationId"], $row["noteProspectId"], $row["noteNoteTypeId"], $row["noteContent"]);
				$notes[$notes->key()] = $notes;
				$notes->next();
			} catch (\Exception $exception){
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $notes;

}

	/**
	 * @return array
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}

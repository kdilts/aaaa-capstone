<?php
namespace Edu\Cnm\DdcAaaa;

class Note  implements \JsonSerializable {
	use ValidateDate;
	/**
	 * Id of the note
	 * @var int $noteId
	 */
	private $noteId;
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
	 * @var \DateTime $noteDateTime
	 */
	private $noteDateTime;
	/**
	 * @var string $noteBridgeStaffId
	 */
	private $noteBridgeStaffId;
	/**
	 * Note constructor for this function.
	 * @param int|null $newNoteId id for this Note or null if a new Note
	 * @param string $newNoteContent string containing actual note data
	 * @param int $newNoteNoteTypeId id of the Type of this Note
	 * @param int $newNoteApplicationId Id of the Application associated with this Note
	 * @param int $newNoteProspectId id of the Prospect associated with this Note
	 * @param \DateTime $newNoteDateTime date and time this Note was created or null if set to current date and time
	 * @param string $newNoteBridgeStaffId id for the Bridge Staff commenting on this note
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data is not within limits
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exceptions occur
	 */
	public function __construct(int $newNoteId = null, string $newNoteContent, int $newNoteNoteTypeId, int $newNoteApplicationId, int $newNoteProspectId, \DateTime $newNoteDateTime, string $newNoteBridgeStaffId) {
		try {
			$this->setNoteId($newNoteId);
			$this->setNoteContent($newNoteContent);
			$this->setNoteNoteTypeId($newNoteNoteTypeId);
			$this->setNoteApplicationId($newNoteApplicationId);
			$this->setNoteProspectId($newNoteProspectId);
			$this->setNoteDateTime($newNoteDateTime);
			$this->setNoteBridgeStaffId($newNoteBridgeStaffId);
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
	 * accessor method for note date time
	 *
	 * @return \DateTime
	 */
	public function getNoteDateTime() {
		return($this->noteDateTime);
	}

	/**
	 * accessor method for Id of note bridge staff
	 *
	 * @return mixed
	 */
	public function getNoteBridgeStaffId() {
		return($this->noteBridgeStaffId);
	}

	/**
	 * mutator method for note Id
	 *
	 * @param int $newNoteId new value of note id
	 * @throws \RangeException if $newNoteId is not positive
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
	 * @param string $newNoteContent new value of tweet content
	 * @throws \InvalidArgumentException if $newNoteContent is not a string or insecure
	 * @throws \RangeException if $newNoteContent is not within limits
	 * @throws \TypeError if $newNoteContent is not a string
	 **/
	public function setNoteContent(string $newNoteContent) {
		$newNoteContent = trim($newNoteContent);
		$newNoteContent = filter_var($newNoteContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newNoteContent) === true) {
			throw (new \InvalidArgumentException("Note content is either empty or insecure."));
			//store content of the note
		}
		if(strlen($newNoteContent) > 2000) {
			throw(new \RangeException("note content too large"));
		}
		$this->noteContent = $newNoteContent;
	}

	/**
	 * mutator method for note of the note Id
	 *
	 * @param int|null $newNoteNoteTypeId new value of note note type id
	 * @throws \RangeException if $newNoteTypeId is not positive
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
	 * @param int $newNoteApplicationId new value of note application id
	 * @throws \RangeException if $newNoteApplicationId is not positive
	 * @throws \TypeError if $newNoteApplicationId is not an integer
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
	 * @param int $newNoteProspectId new value of note prospect id
	 * @throws \RangeException if $newNoteProspectId is not positive
	 * @throws \TypeError if $newNoteProspectId is not an integer
	 */
	public function setNoteProspectId(int $newNoteProspectId) {
		if($newNoteProspectId < 0) {
			throw(new \RangeException("Note Prospect Id can't be negative."));
//store prospect Id
		}
		$this->noteProspectId = $newNoteProspectId;
	}
	/**
	 * mutator method for noteDateTime
	 * @param \DateTime|null $newNoteDateTime note date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newNoteDateTime is not a valid object or string
	 * @throws \RangeException if $newNoteDateTime is a date that does not exist
	 */
	public function setNoteDateTime(\DateTime $newNoteDateTime) {
		try {
			$newNoteDateTime = self::validateDateTime($newNoteDateTime);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->noteDateTime = $newNoteDateTime;
	}
	/**
	 * mutator method for note bridge staff Id
	 *
	 * @param string $newNoteBridgeStaffId new value of Note bridge staff id
	 * @throws \RangeException if not valid
	 * @throws \InvalidArgumentException if $newNoteBridgeStaffId is not a valid object or string
	 */
	public function setNoteBridgeStaffId(string $newNoteBridgeStaffId) {
		$newNoteBridgeStaffId = trim ($newNoteBridgeStaffId);
		$newNoteBridgeStaffId = filter_var($newNoteBridgeStaffId, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newNoteBridgeStaffId) === true) {
			throw (new \InvalidArgumentException("newNoteBridgeStaffId is either empty or insecure."));
		}
		if(strlen($newNoteBridgeStaffId) > 9) {
			throw(new \RangeException("Bridge Staff Id too large"));
		}

		//store the note bridge staff Id
		$this->noteBridgeStaffId = $newNoteBridgeStaffId;
	}
	/**
	 * inserts note Id into mySQL
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL related error occur
	 *
	 */
	public function insert(\PDO $pdo) {
		// enforce the noteId is null (i.e., don't insert a noteId that already exists)
		if($this->noteId !== null) { //
			throw(new \PDOException("not a new noteId"));
		}
		// create query template
		$query = "INSERT INTO note(noteContent, noteNoteTypeId, noteApplicationId, noteProspectId, noteDateTime, noteBridgeStaffId) VALUES(:noteContent, :noteNoteTypeId, :noteApplicationId, :noteProspectId, :noteDateTime, :noteBridgeStaffId)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$this->noteDateTime = $this->noteDateTime->format("Y-m-d H:i:s");
		$parameters = [
			"noteApplicationId" => $this->noteApplicationId,
			"noteProspectId" => $this->noteProspectId,
			"noteNoteTypeId" => $this->noteNoteTypeId,
			"noteContent" => $this->noteContent,
			"noteDateTime" => $this->noteDateTime,
			"noteBridgeStaffId" => $this->noteBridgeStaffId
		];
		$statement->execute($parameters);

		// update the null noteId with what mySQL just gave us
		$this->noteId = intval($pdo->lastInsertId());
	}

	/**
	 * insert note, by the note Id into the mySQL
	 * @param \PDO $pdo connection object
	 * @param int $noteId note id to search for
	 * @return Note|NULL note found by note id or null if not found
	 * @throws \PDOException when mySQL related error occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public static function getNoteByNoteId(\PDO $pdo, int $noteId) {
		// sanitize the noteId before searching
		if($noteId <= 0) {
			throw(new \PDOException("noteId not positive"));
		}

		// create query template
		$query = "SELECT noteId, noteContent, noteNoteTypeId, noteApplicationId, noteProspectId, noteDateTime, noteBridgeStaffId FROM note WHERE noteId = :noteId";
		$statement = $pdo->prepare($query);

		// bind the note id to the place holder in template
		$parameters = ["noteId" => $noteId];
		$statement->execute($parameters);

		try {
			$note = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$note = new Note(
					$row["noteId"],
					$row["noteContent"],
					$row["noteNoteTypeId"],
					$row["noteApplicationId"],
					$row["noteProspectId"],
					\DateTime::createFromFormat("Y-m-d H:i:s", $row["noteDateTime"]),
					$row["noteBridgeStaffId"]
				);
			}
		} catch(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($note);
	}

	/**
	 * get note by the noteApplicationId
	 * @param \PDO $pdo connection object
	 * @param int $noteApplicationId note id to search for
	 * @return \SplFixedArray SplFixedArray of Notes found
	 * @throws \PDOException when note application id is not positive
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getNotesByNoteApplicationId(\PDO $pdo, int $noteApplicationId) {
		// sanitize the noteApplicationId before searching
		if($noteApplicationId <= 0) {
			throw(new \PDOException("noteApplicationId not positive"));
		}

		// create query template
		$query = "SELECT noteId, noteContent, noteNoteTypeId, noteApplicationId, noteProspectId, noteDateTime, noteBridgeStaffId FROM note WHERE noteApplicationId = :noteApplicationId";
		$statement = $pdo->prepare($query);

		// bind the noteApplication id to the place holder in template
		$parameters = ["noteApplicationId" => $noteApplicationId];
		$statement->execute($parameters);

		// build an array of notes
		$notes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$note = new Note(
					$row["noteId"],
					$row["noteContent"],
					$row["noteNoteTypeId"],
					$row["noteApplicationId"],
					$row["noteProspectId"],
					\DateTime::createFromFormat("Y-m-d H:i:s", $row["noteDateTime"]),
					$row["noteBridgeStaffId"]
				);
				$notes[$notes->key()] = $note;
				$notes->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $notes;
	}

	/**
	 * gets the note by the prospect Id
	 * @param \PDO $pdo connection object
	 * @param int $noteProspectId id to search for
	 * @return \SplFixedArray SplFixedArray of Notes found
	 * @throws \PDOException when data id is not positive
	 * @throws \TypeError when variables are not the correct data
	 */
	public static function getNotesByNoteProspectId(\PDO $pdo, int $noteProspectId) {
		// sanitize the noteApplicationId before searching
		if($noteProspectId <= 0) {
			throw(new \PDOException("noteProspectId not positive"));
		}

		// create query template
		$query = "SELECT noteId, noteContent, noteNoteTypeId, noteApplicationId, noteProspectId, noteDateTime, noteBridgeStaffId FROM note WHERE noteProspectId = :noteProspectId";
		$statement = $pdo->prepare($query);

		// bind the noteApplication id to the place holder in template
		$parameters = ["noteProspectId" => $noteProspectId];
		$statement->execute($parameters);

		// build an array of notes
		$notes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$note = new Note(
					$row["noteId"],
					$row["noteContent"],
					$row["noteNoteTypeId"],
					$row["noteApplicationId"],
					$row["noteProspectId"],
					\DateTime::createFromFormat("Y-m-d H:i:s", $row["noteDateTime"]),
					$row["noteBridgeStaffId"]
				);
				$notes[$notes->key()] = $note;
				$notes->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $notes;
	}

	/**
	 * get notes by note type id
	 * @param \PDO $pdo connection object
	 * @param int $noteNoteTypeId id to search for
	 * @return \SplFixedArray SplFixedArray of Notes found
	 * @throws \PDOException if id is not positive
	 * @throws \TypeError when variables are not the correct data
	 */
	public static function getNotesByNoteNoteTypeId(\PDO $pdo, int $noteNoteTypeId) {
		// sanitize the noteNoteTypeId before searching
		if($noteNoteTypeId <= 0) {
			throw(new \PDOException("noteNoteTypeId not positive"));
		}

		// create query template
		$query = "SELECT noteId, noteContent, noteNoteTypeId, noteApplicationId, noteProspectId, noteDateTime, noteBridgeStaffId FROM note WHERE noteNoteTypeId = :noteNoteTypeId";
		$statement = $pdo->prepare($query);

		// bind the noteNoteType id to the place holder in template
		$parameters = ["noteNoteTypeId" => $noteNoteTypeId];
		$statement->execute($parameters);

		// build an array of notes
		$notes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$note = new Note(
					$row["noteId"],
					$row["noteContent"],
					$row["noteNoteTypeId"],
					$row["noteApplicationId"],
					$row["noteProspectId"],
					\DateTime::createFromFormat("Y-m-d H:i:s", $row["noteDateTime"]),
					$row["noteBridgeStaffId"]
				);
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
	 * get notes by bridge staff id
	 * @param \PDO $pdo connection object
	 * @param int $noteBridgeStaffId bridge staff id to search for
	 * @return \SplFixedArray SplFixedArray of Notes found
	 * @throws \PDOException if id is not positive
	 * @throws \TypeError when variables are not the correct data
	 */
	public static function getNotesByBridgeStaffId(\PDO $pdo, int $noteBridgeStaffId) {
		// sanitize the bridge staff id before searching
		if($noteBridgeStaffId <= 0) {
			throw(new \PDOException("noteBridgeStaffId not positive"));
		}

		// create query template
		$query = "SELECT noteId, noteContent, noteNoteTypeId, noteApplicationId, noteProspectId, noteDateTime, noteBridgeStaffId FROM note WHERE noteBridgeStaffId = :noteBridgeStaffId";
		$statement = $pdo->prepare($query);

		// bind the bridge staff id to the place holder in template
		$parameters = ["noteBridgeStaffId" => $noteBridgeStaffId];
		$statement->execute($parameters);

		// build an array of notes
		$notes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$note = new Note(
					$row["noteId"],
					$row["noteContent"],
					$row["noteNoteTypeId"],
					$row["noteApplicationId"],
					$row["noteProspectId"],
					\DateTime::createFromFormat("Y-m-d H:i:s", $row["noteDateTime"]),
					$row["noteBridgeStaffId"]
				);
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
	 * @param \PDO $pdo connection object
	 * @param \DateTime $startDate beginning of date range
	 * @param \DateTime $endDate end of date range
	 * @return \SplFixedArray SplFixedArray of Notes found
	 * @throws \PDOException if id is not positive
	 * @throws \TypeError when variables are not the correct data
	 */
	public static function getNotesByDateRange(\PDO $pdo, \DateTime $startDate, \DateTime $endDate) {
		// sanitize the dates before searching
		try {
			$startDate = self::validateDateTime($startDate);
			$endDate = self::validateDateTime($endDate);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}

		// format dates
		$startDate = $startDate->format("Y-m-d H:i:s");
		$endDate = $endDate->format("Y-m-d H:i:s");

		// create query template
		$query = "SELECT noteId, noteContent, noteNoteTypeId, noteApplicationId, noteProspectId, noteDateTime, noteBridgeStaffId FROM note WHERE noteDateTime >= :startDate AND noteDateTime <= :endDate";
		$statement = $pdo->prepare($query);

		// bind the dates to the place holder in template
		$parameters = [
			"startDate" => $startDate,
			"endDate" => $endDate
		];
		$statement->execute($parameters);

		// build an array of notes
		$notes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$note = new Note(
					$row["noteId"],
					$row["noteContent"],
					$row["noteNoteTypeId"],
					$row["noteApplicationId"],
					$row["noteProspectId"],
					\DateTime::createFromFormat("Y-m-d H:i:s", $row["noteDateTime"]),
					$row["noteBridgeStaffId"]
				);
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
	 * gets all notes
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of notes found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getAllNotes(\PDO $pdo){
		//create query template
		$query = "SELECT noteId, noteContent, noteNoteTypeId, noteApplicationId, noteProspectId, noteDateTime, noteBridgeStaffId FROM note";
		$statement = $pdo->prepare($query);
		$statement->execute();

		//build an array of placards
		$notes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false){
			try{
				$note = new Note(
					$row["noteId"],
					$row["noteContent"],
					$row["noteNoteTypeId"],
					$row["noteApplicationId"],
					$row["noteProspectId"],
					\DateTime::createFromFormat("Y-m-d H:i:s", $row["noteDateTime"]),
					$row["noteBridgeStaffId"]
				);
				$notes[$notes->key()] = $note;
				$notes->next();
			} catch (\Exception $exception){
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $notes;

	}

	/**
	 * formats the state variables for JSON serialization
	 * @return array resulting state variables to serialize
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}

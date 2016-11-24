<?php
namespace Edu\Cnm\DdcAaaa;

/**
 * Class NoteType
 * enumerator class that describes each note's type
 * @package Edu\Cnm\DdcAaaa
 */
class NoteType implements \JsonSerializable {

	/**
	 * Id number for noteType
	 * @var int $noteTypeId
	 */
	private $noteTypeId;

	/**
	 * Name for NoteType
	 * @var string $noteTypeName
	 */
	private $noteTypeName;

	/**
	 * constructor for NoteType.
	 * @param int|null $newNoteTypeId id of this noteType, or null if new noteType
	 * @param string $newNoteTypeName string containing the name of this noteType
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs.
	 */
	public function __construct(int $newNoteTypeId = null, string $newNoteTypeName) {
		try {
			$this->setNoteTypeId($newNoteTypeId);
			$this->setNoteTypeName($newNoteTypeName);
		} catch (\InvalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw (new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch (\RangeException $range){
			// rethrow the exception to the caller
			throw (new \RangeException($range->getMessage(), 0, $range));
		} catch (\TypeError $typeError){
			// rethrow the exception to the caller
			throw (new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch (\Exception $exception){
			// rethrow the exception to the caller
			throw (new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for note type id
	 *
	 * @return int|null value for Note Type Id
	 */
	public function getNoteTypeId() {
		return ($this->noteTypeId);
	}

	/**
	 * mutator method for NoteType id
	 * @param int|null $newNoteTypeId new value for noteType id
	 * @throws \RangeException if $newNoteTypeId is not possitive
	 * @throws \TypeError if $newNoteTypeId is not an integer
	 */
	public function setNoteTypeId(int $newNoteTypeId = null) {
		// base case: if the note type id is null, this a new note type without a mySQL assigned id (yet)
		if($newNoteTypeId === null) {
			$this->noteTypeId = null;
			return;
		}
		if($newNoteTypeId <= 0) {
			throw(new \RangeException("noteTypeId must be positive"));
		}

		// convert and store the tweet id
		$this->noteTypeId = $newNoteTypeId;
	}

	/**
	 * accessor method for NoteTypeName
	 * @return string value of note type name
	 */
	public function getNoteTypeName() {
		return ($this->noteTypeName);
	}

	/**
	 * mutator method for NoteTypeName
	 *
	 * @param string $newNoteTypeName new value for NoteTypeName
	 * @throws \InvalidArgumentException if $newNoteTypeName is not a string or insecure
	 * @throws \RangeException if $newNoteTypeName is >300 characters
	 * @throws \TypeError if $newNoteTypeName is not a string
	 */
	public function setNoteTypeName(string $newNoteTypeName) {
		// verify the noteTypeName is not a string or insecure
		$newNoteTypeName = trim($newNoteTypeName);
		$newNoteTypeName = filter_var($newNoteTypeName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newNoteTypeName) === true){
			throw(new \InvalidArgumentException("NoteTypeName is empty or insecure."));
		}

		// verify the note type name will fit in the database
		if(strlen($newNoteTypeName) > 300) {
			throw(new \InvalidArgumentException("note content is empty or insecure"));
		}

		//verify the note type will fit in database
		if(strlen($newNoteTypeName) > 140) {
			throw (new \RangeException("noteType name too large"));
		}
		// store the note type name
		$this->noteTypeName = $newNoteTypeName;
	}


	/**
	 * insert this noteType into mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL errors occur.
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) {
		// enforce the noteTypeId is null (i.e., don't insert a note type that already exists)
		if($this->noteTypeId !== null) {
			throw(new \PDOException("not a new noteType"));
		}
		//create query tmplate
		$query = "INSERT INTO noteType(noteTypeId, noteTypeName) VALUES(:noteTypeId, :noteTypeName)";
		$statement = $pdo->prepare($query);

		//bind member variables to the place holders in template
		$parameters = ["noteTypeId" => $this->noteTypeId, "noteTypeName" => $this->noteTypeName];
		$statement->execute($parameters);

		// update the null noteTypeId with what mySQL just gave us

		$this->noteTypeId = intval($pdo->lastInsertId());
	}
	/**
	 * gets noteType by noteTypeId
	 * @param \PDO $pdo PDO connection object
	 * @param int $noteTypeId Note Id to search for
	 * @return NoteType|null noteType found, or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getNoteTypeByNoteTypeId(\PDO $pdo, int $noteTypeId){
		// sanitize the noteTypeId before searching
		if($noteTypeId <= 0){
			throw(new\PDOException("noteType id not positive"));
		}
// create query template
		$query = "SELECT noteTypeId, noteTypeName FROM noteType WHERE noteTypeId = :noteTypeId";
		$statement = $pdo->prepare($query);

		// bind the noteType id to the place holder in the template
		$parameters = ["noteTypeId" => $noteTypeId];
		$statement->execute($parameters);

// grab note from mySQL
		try {
			$noteType = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$noteType = new NoteType($row["noteTypeId"], $row["noteTypeName"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($noteType);
	}
	/** gets the NoteType by NoteType name
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $noteTypeName noteType name to search by
	 * @return \SplFixedArray SplFixedArray of NoteTypes found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $applicationName is not a string
	 **/
	public static function getNoteTypeByNoteTypeName(\PDO $pdo, string $noteTypeName){
		// sanitize the noteTypeName before searching
		if($noteTypeName <= null)
		$noteTypeName = trim($noteTypeName);
		$noteTypeName = filter_var($noteTypeName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($noteTypeName) === true){
			throw(new\PDOException("noteType name can not be empty or may be insecure."));
		}
		$noteTypeName ="%noteTypeName%";
// create query template
		$query = "SELECT noteTypeName, noteTypeId FROM noteType WHERE noteTypeName = :noteTypeName";
		$statement = $pdo->prepare($query);
		$statement->execute();
// grab note from SQL
		try {
			$noteType = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$noteType = new NoteType ($row["noteTypeName"], $row["noteTypeId"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($noteType);
	}

	/**
	 * get all noteTypes
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of noteTypes found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getAllNoteTypes(\PDO $pdo){
		//create query template
		$query = "SELECT noteTypeName, noteTypeId FROM noteType";
		$statement = $pdo->prepare($query);
		$statement->execute();

		//build an array of placards
		$noteTypes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false){
			try {
				$noteType = new NoteType($row["noteTypeId"], $row["noteTypeName"]);
				$noteTypes[$noteTypes->key()] = $noteType;
				$noteTypes->next();
			} catch(\Exception $exception){
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $noteTypes;
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}

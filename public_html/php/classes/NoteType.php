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
	 * NoteType constructor.
	 * @param int|null $newNoteTypeId id of this noteType, or null if new noteType
	 * @param string $newNoteTypeName name of this noteType
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data is not out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs.
	 */
	public function __construct(int $newNoteTypeId = null, string $newNoteTypeName) {
		try {
			$this->setNoteTypeId($newNoteTypeId);
			$this->setNoteTypeName($newNoteTypeName);
		} catch (\InvalidArgumentException $invalidArgumentException) {
			throw (new \InvalidArgumentException($invalidArgumentException->getMessage(), 0, $invalidArgumentException));
		} catch (\RangeException $rangeException){
			throw (new \RangeException($rangeException->getMessage(), 0, $rangeException));
		} catch (\TypeError $typeError){
			throw (new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch (\Exception $exception){
			throw (new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for NoteTypeId
	 * @return int NoteTypeId
	 */
	public function getNoteTypeId() {
		return $this->noteTypeId;
	}

	/**
	 * accessor method for NoteTypeName
	 * @return string value of NoteTypeName
	 */
	public function getNoteTypeName() {
		return $this->noteTypeName;
	}

	/**
	 * mutator method for NoteTypeId
	 * @param int $newNoteTypeId new value for NoteTypeId
	 */
	public function setNoteTypeId(int $newNoteTypeId) {
		if($newNoteTypeId <= 0){
			throw(new \RangeException("NoteTypeId must be positive"));
		}
		$this->noteTypeId = $newNoteTypeId;
	}

	/**
	 * mutator method for NoteTypeName
	 * @param string $newNoteTypeName new value for NoteTypeName
	 */
	public function setNoteTypeName(string $newNoteTypeName) {
		$newNoteTypeName = trim($newNoteTypeName);
		$newNoteTypeName = filter_var($newNoteTypeName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newNoteTypeName === true)){
			throw(new \InvalidArgumentException("NoteTypeName is empty or insecure."));
		}
		$this->noteTypeName = $newNoteTypeName;
	}

	/**
	 * insert this noteType into mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL errors occur.
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) {
		if($this->noteTypeId !== null) {
			throw(new \PDOException("not a new noteType"));
		}
		//create query
		$query = "INSERT INTO noteType(noteTypeId, noteTypeName) VALUES(:noteTypeId, :noteTypeName)";
		$statement = $pdo->prepare($query);

		//bind member variables to the place holders in template
		$parameters = ["noteTypeId" => $this->noteTypeId, "noteTypeName" => $this->noteTypeName];
		$statement->execute($parameters);

		// update the null noteTypeId with what mySQL just gave us

		$this->noteTypeId = intval($pdo->lastInsertId());
	}
	/**
	 * gets noteType by noteType id
	 * @param \PDO $pdo PDO connection object
	 * @param int $noteTypeId Note Id in database
	 * @return NoteType|null noteType if found, or null if not
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getNoteTypeByNoteTypeId(\PDO $pdo, int $noteTypeId){
		// sanitize the placardId before searching
		if($noteTypeId <= 0){
			throw(new\PDOException("noteType id not positive"));
		}
// create query template
		$query = "SELECT noteTypeName, noteTypeId FROM noteType WHERE noteTypeId = :noteTypeId";
		$statement = $pdo->prepare($query);
		$statement->execute();
// grab note from SQL
		try {
			$noteType = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$noteType = new NoteType ($row["noteTypeName"], $row["noteTypeIdId"]);
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

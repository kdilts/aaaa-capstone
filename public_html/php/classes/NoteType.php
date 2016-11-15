<?php
namespace Edu\Cnm\DdcAaaa;

class NoteType{
	private $noteTypeName;
	private $noteTypeId;

	public function __construct(string $newNoteTypeName, int $newNoteTypeId) {
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
	 * @return mixed
	 */
	public function getNoteTypeId() {
		return $this->noteTypeId;
	}

	/**
	 * @return mixed
	 */
	public function getNoteTypeName() {
		return $this->noteTypeName;
	}

	/**
	 * @param int $newNoteTypeId
	 */
	public function setNoteTypeId(int $newNoteTypeId) {
		if($newNoteTypeId <= 0){
			throw(new \RangeException("NoteTypeId can't be less than or equal to 0"));
		}
		$this->noteTypeId = $newNoteTypeId;
	}

	/**
	 * @param string $newNoteTypeName
	 */
	public function setNoteTypeName(string $newNoteTypeName) {
		$newNoteTypeName = trim($newNoteTypeName);
		$newNoteTypeName = filter_var($newNoteTypeName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newNoteTypeName === true)){
			throw(new \InvalidArgumentException("NoteTypeName is empty or insecure."));
		}
		$this->noteTypeName = $newNoteTypeName;
	}
//ATTN: Is this the type of error needed here?
	public function insert(\PDO $pdo) {
		if($this->noteTypeId !== null) {
			throw(new \PDOException("Need a note type."));
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
	 * @param \PDO $pdo PDO connection object
	 * @param int $noteTypeId Note ID in database
	 * @return Note|null
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getNoteTypeByNoteTypeId(\PDO $pdo, int $noteTypeId){
		// sanitize the placardId before searching
		if($noteTypeId <= 0){
			throw(new\PDOException("notetype not positive"));
		}
// create query template
		$query = "SELECT noteTypeName, noteTypeId FROM noteType WHERE noteTypeId = :noteTypeId";
		$statement = $pdo->prepare($query);
		$statement->execute();
// grab note from SQL
		try {
			$note = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$noteType = new NoteType ($row["noteTypeName"], $row["noteTypeIdId"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($note);
	}

public static function getAllNotes(\PDO $pdo){
	//create query template
	$query = "SELECT noteTypeName, noteTypeId FROM noteType";
	$statement = $pdo->prepare($query);
	$statement->execute();

	//build an array of placards
	$note = new \SplFixedArray($statement->rowCount());
	$statement->setFetchMode(\PDO::FETCH_ASSOC);
	while(($row = $statement->fetch()) !== false){
		try {
			$note = new Note($row["noteTypeName"], $row["noteTypeId"]);
			$note [$note->key()] = $note;
			$note->next();
		} catch(\Exception $exception){
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
	}
return $note;
}
	/**
	 * @return array
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}

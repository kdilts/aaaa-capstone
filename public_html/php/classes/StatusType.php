<?php

namespace Edu\Cnm\DdcAaaa;

/**
 * Class StatusType
 * Enumerator class for placard and swipe statuses.
 * @package Edu\Cnm\DdcAaaa
 */
class StatusType implements \JsonSerializable {

	/**
	 * id for this status type
	 * @var int|null $statusTypeId
	 */
	private $statusTypeId;

	/**
	 * name that describes what the status is checked in, checked out, lost, etc
	 * @var int $statusTypeName
	 */
	private $statusTypeName;

	/**
	 * StatusType constructor.
	 * @param int|null $newStatusTypeId id of this statusType, or null if a new statusType
	 * @param int $newStatusTypeName name of this statusType
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bound
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function __construct(int $newStatusTypeId = null, int $newStatusTypeName) {
		try {
			$this->setStatusTypeId($newStatusTypeId);
			$this->setStatusTypeName($newStatusTypeName);
		} catch(\InvalidArgumentException $invalidArgumentException){
			throw(new \InvalidArgumentException($invalidArgumentException->getMessage(), 0, $invalidArgumentException));
		} catch(\RangeException $rangeException){
			throw(new \RangeException($rangeException->getMessage(), 0, $rangeException));
		} catch(\TypeError $typeError){
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception){
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}

	}
	/**
	 * accessor method for statusType id
	 * @return int value of statusType id
	 */
	public function getStatusTypeId(){
		return $this->statusTypeId;
	}

	/**
	 * accessor method for statusType name
	 * @return int value of statusType name
	 */
	public function getStatusTypeName(){
		return $this->statusTypeName;
	}
	/**
	 * mutator method for statusType id
	 * @param int|null $statusTypeId  new value of statusType id
	 * @throws \RangeException throws if $newStatusTypeId is not positive
	 * @throws \TypeError throws if $newStatusTypedId is not an integer
	 */
	public function setStatusTypeId(int $newStatusTypeId = null) {
		if($newStatusTypeId === null){
			$this->statusTypeId = null;
			return;
		}

		if($newStatusTypeId <= 0) {
			throw(new \RangeException("typeId can't be 0 or less."));
		}
		$this->statusTypeId = $newStatusTypeId;
	}
	/**
	 * mutator method for statusType name
	 * @param int $statusTypeName  new value of statusType name
	 * @throws \RangeException throws if $newStatusTypeName is not positive
	 * @throws \TypeError throws if $newStatusTypedName is not an integer
	 *
	 */
	public function setStatusTypeName(string $newStatusTypeName) {
		if($newStatusTypeName <= 0){
			throw (new \RangeException("Status type name must be positive"));
		}
		$this->statusTypeName = $newStatusTypeName;
	}

	/**
	 * inserts this statusType into mySQL
	 * @param \PDO $pdo pdo connection object
	 * @throws \PDOException throws when mySQL errors occur
	 * @throws \TypeError throws if $pdo is not a connection object
	 */
	public function insert(\PDO $pdo) {
		if($this->statusTypeId !== null) {
			throw(new \PDOException("cannot insert a statusType that already exists."));
		}
		$query = "INSERT INTO statusType(statusTypeId, statusTypeName) VALUES(:statusTypeId, :statusTypeName)";
		$statement = $pdo->prepare($query);


		$parameters = ["statusTypeId" => $this->statusTypeId, "statusTypeName" => $this->statusTypeName];
		$statement->execute($parameters);


		$this->statusTypeId = intval($pdo->lastInsertId());

	}

	/**
	 * updates this statusType in mySQL
	 * @param \PDO $pdo pdo connection object
	 * @throws \PDOException throws when mySQL errors occur
	 * @throws \TypeError throws if $pdo is not a connection object
	 */
	public function update(\PDO $pdo){
		// enforce the statusTypeId is not null (i.e., don't update a statusType that hasn't been inserted)
		if($this->statusTypeId === null) {
			throw(new \PDOException("unable to update a statusType that does not exist"));
		}

		// create query template
		$query = "UPDATE statusType SET statusTypeId = :statusTypeId, statusTypeName = :statusTypeName;";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = [
			"statusTypeId" => $this->statusTypeId,
			"statusTypeName" => $this->statusTypeName
		];
		$statement->execute($parameters);
	}

	/**
	 * gets statusType by statusType id
	 * @param \PDO $pdo pdo connection object
	 * @param $statusTypeId statusType id to search for
	 * @throws \PDOException throws when mySQL errors occur
	 * @throws \TypeError throws if $pdo is not a connection object
	 */
	public static function getStatusTypeByStatusTypeId(\PDO $pdo, int $statusTypeId) {
		// sanitize the swipeId before searching
		if($statusTypeId <= 0) {
			throw(new \PDOException("statusTypeId not positive"));
		}
		// create query template
		$query = "SELECT statusTypeName, statusTypeId FROM statusType WHERE statusTypeId = :statusTypeId";
		$statement = $pdo->prepare($query);

		// bind the status type id to the place holder in template
		$parameters = ["statusTypeId" => $statusTypeId];
		$statement->execute($parameters);

		// grab statusType from SQL
		try {
			$statusType = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$statusType = new StatusType($row["statusTypeId"], $row["statusTypeName"]);
			}
		} catch(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($statusType);
	}

	/**
	 * gets statusType by statusType name
	 * @param \PDO $pdo pdo connection object
	 * @param $statusTypeName statusType name to search for
	 * @throws \PDOException throws when mySQL errors occur
	 * @throws \TypeError throws if $pdo is not a connection object
	 */
	public static function getStatusTypeByStatusTypeName(\PDO $pdo, string $statusTypeName) {
		// sanitize the statusTypeId before searching
		if($statusTypeName <= 0) {
			throw(new \PDOException("statusTypeName not positive"));
		}

		// create query template
		$query = "SELECT statusTypeName, statusTypeId FROM statusType WHERE statusTypeName = :statusTypeName";
		$statement = $pdo->prepare($query);

		// bind the swipe id to the place holder in template
		$parameters = ["statusTypeName" => $statusTypeName];
		$statement->execute($parameters);

		// build an array of statusType
		$statusTypes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$statusType = new StatusType($row["statusTypeName"], $row["statusTypeId"]);
				$statusTypes[$statusTypes->key()] = $statusType;
				$statusTypes->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $statusTypes;
	}

	/**
	 * gets all statusTypes
	 * @param \PDO $pdo pdo connection object
	 * @return \SplFixedArray array of statusTypes found
	 * @throws \PDOException throws when mySQL errors occur
	 * @throws \TypeError throws if $pdo is not a connection object
	 */
	public static function getAllStatusTypes(\PDO $pdo) {
		// create query template
		$query = "SELECT statusTypeName, statusTypeID FROM statusType";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of application cohorts
		$statusTypes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$statusType = new StatusType($row["statusTypeName"], $row["statusTypeId"]);
				$statusTypes[$statusTypes->key()] = $statusType;
				$statusTypes->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $statusTypes;
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

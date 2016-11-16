<?php

namespace Edu\Cnm\DdcAaaa;

/**
 * Class Placard - representation of a placard
 * @package Edu\Cnm\DdcAaaa
 */
class Placard implements \JsonSerializable {

	/**
	 * Id number for parking placard
	 * @var int $placardId
	 */
	private $placardId;

	/**
	 * current status of placard
	 * @var int $placardStatus
	 */
	private $placardStatusTypeId;

	/**
	 * number on the placard
	 * @var int $placardNumber
	 */
	private $placardNumber;

	/**
	 * Placard constructor.
	 * @param int|null $newPlacardId ID of this placard or null if empty
	 * @param int $newPlacardStatusTypeId status of placard, int because it will be an enumerator
	 * @param int $newPlacardNumber number on the physical placard
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data is not out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs.
	 */
	public function __construct(int $newPlacardId = null, int $newPlacardStatusTypeId, int $newPlacardNumber) {
		try {
			$this->setPlacardId($newPlacardId);
			$this->setPlacardStatusTypeId($newPlacardStatusTypeId);
			$this->setPlacardNumber($newPlacardNumber);
			}catch(\InvalidArgumentException $invalidArgument) {
				throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
			}catch(\RangeException $range) {
				throw(new \RangeException($range->getMessage(), 0, $range));
			}catch(\TypeError $typeError) {
				throw(new \TypeError($typeError->getMessage(), 0, $typeError));
			}catch(\Exception $exception) {
				throw(new \Exception($exception->getMessage(), 0, $exception));
		}

	}

	/**
	 * accessor for placardId
	 * @return int|null value of placardId
	 */
	public function getPlacardId() {
		return $this->placardId;
	}

	/**
	 * accessor for placard number
	 * @return int value of placardNumber
	 */
	public function getPlacardNumber() {
		return $this->placardNumber;
	}

	/**
	 * accessor for placard status
	 * @return int value of placardStatus
	 */
	public function getPlacardStatusTypeId() {
		return $this->placardStatusTypeId;
	}

	/**
	 * mutator for placard ID
	 * @param int|null $newPlacardId new value for placard ID
	 * @throws \RangeException throws this if number is negative, or 0.
	 * @throws \TypeError throws this if $newPlacardId is not an integer.
	 */
	public function setPlacardId(int $newPlacardId = null) {
		// base case: if the placard id is null, this a new placard without a mySQL assigned id (yet)
		if($newPlacardId === null) {
			$this->placardId = null;
			return;
		}

		//checks if PlacardId is negative
		if ($newPlacardId <= 0) {
			throw(new \RangeException("Placard ID cannot be negative."));
		}
		$this->placardId = $newPlacardId;
	}

	/**
	 * mutator for placard number
	 * @param int $newPlacardNumber new placard number
	 * @throws \RangeException throws if number is negative or 0
	 * @throws \TypeError throws this if $newPlacardNumber is not an integer.
	 */
	public function setPlacardNumber(int $newPlacardNumber) {
		if ($newPlacardNumber <= 0) {
			throw(new \RangeException("Placard Number cannot be negative."));
		}
		$this->placardNumber = $newPlacardNumber;
	}

	/**
	 * mutator for placard status
	 * @param int $newPlacardStatusTypeId new placard status
	 * @throws \RangeException throws if status is less than 0
	 * @throws \TypeError throws this if $newPlacardStatusTypeId is not an integer.
	 */
	public function setPlacardStatusTypeId(int $newPlacardStatusTypeId) {
		if ($newPlacardStatusTypeId < 0) {
			throw(new \RangeException("Placard status invalid."));
		}
		$this->placardStatusTypeId = $newPlacardStatusTypeId;
	}

	/**
	 * insert this placard into mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL errors occur.
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) {
		// enforce the placardId is null (i.e., don't insert a placard that already exists)
		if($this->placardId !== null) {
			throw(new \PDOException("not a new placard"));
		}

		// create query template
		$query = "INSERT INTO placard(placardStatusTypeId, placardNumber) VALUES(:placardStatusTypeId, :placardNumber)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["placardStatusTypeId" => $this->placardStatusTypeId, "placardNumber" => $this->placardNumber];
		$statement->execute($parameters);

		// update the null placardId with what mySQL just gave us
		$this->placardId = intval($pdo->lastInsertId());
	}

	/**
	 * updates this placard in mySQL
	 * @param \PDO $pdo PDO connection object.
	 * @throws \PDOException when mySQL errors occur.
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function update(\PDO $pdo) {
		// enforce the placardId is not null (i.e., don't update a placard that hasn't been inserted)
		if($this->placardId === null) {
			throw(new \PDOException("unable to update a placard that does not exist"));
		}

		// create query template
		$query = "UPDATE placard SET placardId = :placardId, placardStatusTypeId = :placardStatus, placardNumber = :placardNumber WHERE placardId = :placardId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["placardId" => $this->placardId, "placardStatus" => $this->placardStatusTypeId, "placardNumber" => $this->placardNumber];
		$statement->execute($parameters);
	}

	/**
	 * gets placard by placard id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $placardId Placard Id in database
	 * @return Placard|null placard if placard if found, otherwise null
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getPlacardByPlacardId(\PDO $pdo, int $placardId){
		// sanitize the placardId before searching
		if($placardId <= 0){
			throw(new \PDOException("placardId not positive"));
		}

		// create query template
		$query = "SELECT placardId, placardStatusTypeId, placardNumber From placard WHERE placardId = :placardId";
		$statement = $pdo->prepare($query);

		// bind the placard id to the place holder in template
		$parameters = ["placardId" => $placardId];
		$statement->execute($parameters);

		// grab placard from SQL
		try {
			$placard = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$placard = new Placard($row["placardId"], $row["placardStatusTypeId"], $row["placardNumber"]);
			}
		} catch(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($placard);
	}

	/**
	 * gets placards by placard status id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $placardStatusTypeId current placard status.
	 * @return \SplFixedArray of placards found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getPlacardsByPlacardStatusTypeId(\PDO $pdo, int $placardStatusTypeId){
		// sanitize the placardId before searching
		if($placardStatusTypeId <= 0){
			throw(new \PDOException("placardStatusTypeId not positive"));
		}

		// create query template
		$query = "SELECT placardId, placardStatusTypeId, placardNumber From placard WHERE placardStatusTypeId = :placardStatusTypeId";
		$statement = $pdo->prepare($query);

		// bind the placard id to the place holder in template
		$parameters = ["placardStatusTypeId" => $placardStatusTypeId];
		$statement->execute($parameters);

		// build an array of placards
		$placards = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false){
			try {
				$placard = new Placard($row["placardId"], $row["placardStatusTypeId"], $row["placardNumber"]);
				$placards[$placards->key()] = $placard;
				$placards->next();
			} catch(\Exception $exception){
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $placards;
	}

	/**
	 * gets placard by placard number
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $placardNumber search for placard by placard number
	 * @return Placard|null placard found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getPlacardByPlacardNumber(\PDO $pdo, int $placardNumber){
		// sanitize the placardId before searching
		if($placardNumber <= 0){
			throw(new \PDOException("placardNumber not positive"));
		}

		// create query template
		$query = "SELECT placardId, placardStatusTypeId, placardNumber From placard WHERE placardNumber = :placardNumber";
		$statement = $pdo->prepare($query);

		// bind the placard id to the place holder in template
		$parameters = ["placardNumber" => $placardNumber];
		$statement->execute($parameters);

		// grab placard from SQL
		try {
			$placard = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$placard = new Placard($row["placardId"], $row["placardStatusTypeId"], $row["placardNumber"]);
			}
		} catch(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($placard);
	}

	/**
	 * get all placards
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of placards found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getAllPlacards(\PDO $pdo){
		// create query template
		$query = "SELECT placardId, placardStatusTypeId, placardNumber From placard";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of placards
		$placards = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false){
			try {
				$placard = new Placard($row["placardId"], $row["placardStatusTypeId"], $row["placardNumber"]);
				$placards[$placards->key()] = $placard;
				$placards->next();
			} catch(\Exception $exception){
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $placards;
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

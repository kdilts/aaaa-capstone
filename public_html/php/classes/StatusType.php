<?php

namespace Edu\Cnm\DdcAaaa;

class StatusType {

	/**
	 * @var int|null $statusTypeId
	 */
	private $statusTypeId;

	/**
	 * @var int $statusTypeName
	 */
	private $statusTypeName;

	/**
	 * StatusType constructor.
	 * @param int|null $newStatusTypeId
	 * @param int $newStatusTypeName
	 * @throws \Exception
	 * @throws \TypeError
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
	 * @return int
	 */
	public function getStatusTypeId(){
		return $this->statusTypeId;
	}
	/**
	 * @return string
	 */
	public function getStatusTypeName(){
		return $this->statusTypeName;
	}
	/**
	 * @param int $statusTypeId
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
	 * @param string $newStatusTypeName
	 * @throws \RangeException
	 */
	public function setStatusTypeName(string $newStatusTypeName) {
		if($newStatusTypeName <= 0){
			throw (new \RangeException("Status type name must be positive"));
		}
		$this->statusTypeName = $newStatusTypeName;
	}

	/**
	 * @param \PDO $pdo
	 */
	public function insert(\PDO $pdo) {
		if($this->statusTypeId !== null) {
			throw(new \PDOException("cannont insert a statusType that already exists."));
		}
		$query = "INSERT INTO statusType(statusTypeId, statusTypeName) VALUES(:statusTypeId, :statusTypeName)";
		$statement = $pdo->prepare($query);


		$parameters = ["statusTypeId" => $this->statusTypeId, "statusTypeName" => $this->statusTypeName];
		$statement->execute($parameters);


		$this->statusTypeId = intval($pdo->lastInsertId());

	}

	/**
	 * @param \PDO $pdo
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
	 * @param \PDO $pdo
	 * @param int $statusTypeId
	 * @return StatusType|null
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
	 * @param \PDO $pdo
	 * @param string $statusTypeName
	 * @return \SplFixedArray
	 */
	public static function getStatusTypeByStatusTypeName(\PDO $pdo, string $statusTypeName) {
		// sanitize the swipeId before searching
		if($statusTypeName <= 0) {
			throw(new \PDOException("statusTypeName not positive"));
		}

		// create query template
		$query = "SELECT statusTypeName, statusTypeId FROM statusType WHERE statusTypeName = :statusTypeName";
		$statement = $pdo->prepare($query);

		// bind the swipe id to the place holder in template
		$parameters = ["statusTypeName" => $statusTypeName];
		$statement->execute($parameters);

		// build an array of swipes
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
	 * @param \PDO $pdo
	 * @return \SplFixedArray
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
	 * @return array
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}

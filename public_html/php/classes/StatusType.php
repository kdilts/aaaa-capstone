<?php

namespace Edu\Cnm\DdcAaaa;

class StatusType {
	/**
	 * @var string $statusTypeName
	 */
	private $statusTypeName;
	/**
	 * @var int $statusTypeId
	 */
	private $statusTypeId;

	public function __construct(string $newStatusTypeName, int $newStatusTypeId) {
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
	public function setStatusTypeId(int $statusTypeId) {
		if($statusTypeId <= 0) {
			throw(new \RangeException("typeId can't be 0 or less."));
		}
		$this->statusTypeId = $statusTypeId;
	}
	/**
	 * @param string $newStatusTypeName
	 */
	public function setStatusTypeName(string $newStatusTypeName) {
		$newStatusTypeName = trim($newStatusTypeName);
		$newStatusTypeName = filter_var($newStatusTypeName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newStatusTypeName) === true) {
			throw (new \InvalidArgumentException("Status type name is either empty or insecure."));
		}
		$this->statusTypeName = $newStatusTypeName;
	}

	/**
	 * @param \PDO $pdo
	 */
	public function insert(\PDO $pdo) {
		if($this->statusTypeId === null) {
			throw(new \PDOException("Need a status type."));
		}
		$query = "INSERT INTO statusType(statusTypeId, statusTypeName) VALUES(:statusTypeId, :statusTypeName)";
		$statement = $pdo->prepare($query);


		$parameters = ["statusTypeId" => $this->statusTypeId, "statusTypeName" => $this->statusTypeName];
		$statement->execute($parameters);


		$this->statusTypeId = intval($pdo->lastInsertId());

	}
	public static function getStatusByStatusTypeName(\PDO $pdo, string $statusTypeName) {
		// sanitize the swipeId before searching
		$statusTypeName = trim($statusTypeName);
		$statusTypeName = filter_var($statusTypeName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($statusTypeName) === null) {
			throw(new \PDOException("statusTypeName is empty or insecure"));
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
	public static function getStatusByStatusTypeId(\PDO $pdo, int $statusTypeId) {
		// sanitize the swipeId before searching
		if($statusTypeId <= 0) {
			throw(new \PDOException("statusTypeId not positive"));
		}

		// create query template
		$query = "SELECT statusTypeName, statusTypeId FROM statusType WHERE statusTypeId = :statusTypeId";
		$statement = $pdo->prepare($query);

		// bind the swipe id to the place holder in template
		$parameters = ["statusTypeId" => $statusTypeId];
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

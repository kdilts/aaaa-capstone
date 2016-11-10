<?php

namespace Edu\Cnm\DdcAaaa;

class Swipe {

	/**
	 * @var int $swipeId Id for parking swipe card
	 */
	private $swipeId;

	/**
	 * @var int $swipeNumber
	 */
	private $swipeNumber;

	/**
	 * @var int $swipeStatus current status of swipe card
	 */
	private $swipeStatus;

	/**
	 * Swipe constructor.
	 * @param int|null $newSwipeId if id for this swipe is null or new
	 * @param int $newSwipeNumber swipe card to search for
	 * @param int $newSwipeStatus if swipe card has new status or invalid
	 * @throws \Exception if some other exception ocurrs
	 * @throws \TypeError if data types violate type hints
	 */
	 	public function __construct(int $newSwipeId = null, int $newSwipeNumber, int $newSwipeStatus) {
		try {
			$this->setSwipeId($newSwipeId);
			$this->setSwipeNumber($newSwipeNumber);
			$this->setSwipeStatus($newSwipeStatus);
		} catch(\InvalidArgumentException $invalidArgumentException) {
			// rethrow exception to the caller
			throw(new \InvalidArgumentException($invalidArgumentException->getMessage(), 0, $invalidArgumentException));
		} catch(\RangeException $rangeException) {
			// rethrow exception to the caller
			throw(new \RangeException($rangeException->getMessage(), 0, $rangeException));
		} catch(\TypeError $typeError) {
			// rethrow exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			// rethrow exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for swipeId
	 * @return int
	 */
	public function getSwipeId() {
		return ($this->swipeId);
	}

	/**
	 * accessor method for swipe number
	 * @return int
	 */
	public function getSwipeNumber() {
		return ($this->swipeNumber);
	}

	/**
	 * accessor method for swipe status.
	 * @return int
	 */
	public function getSwipeStatus() {
		return ($this->swipeStatus);
	}

	/**
	 * mutator method for swipeId
	 * @param int|null $newSwipeId id of this swipe is null or new
	 * @throws \RangeException if $new value of swipe is out of bounds
	 */
	public function setSwipeId(int $newSwipeId = null) {
		// base case: if the placard id is null, this a new placard without a mySQL assigned id (yet)
		if($newSwipeId === null) {
			$this->swipeId = null;
			return;
		}
		// verify that newSwipeId is positive
		if($newSwipeId <= 0) {
			throw(new \RangeException("swipe id is not positive"));
		}

		$this->swipeId = $newSwipeId;
	}

	/**
	 * mutator method for swipeId
	 * @param int $newSwipeNumber new value for swipe card number null or new
	 * @throws \RangeException if $new swipe number is out of bounds
	 */
	public function setSwipeNumber(int $newSwipeNumber) {
		// verify that newSwipeNumber is positive
		if($newSwipeNumber <= 0) {
			throw(new \RangeException("swipe number is not positive"));
		}
		$this->swipeNumber = $newSwipeNumber;
	}

	/**
	 * mutator method for swipeStatus
	 * @param int $newSwipeStatus for new status for swipe card
	 * @throws \RangeException if swipe card status is not valid
	 */
	public function setSwipeStatus(int $newSwipeStatus) {
		// verify that newSwipeStatus is positive
		if($newSwipeStatus <= 0) {
			throw(new \RangeException("swipe status is not positive"));
		}
		$this->swipeStatus = $newSwipeStatus;
	}

	/**
	 * inserts swipe into SQL database
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when swipe is not valid or out of bounds
	 */
	public function insert(\PDO $pdo) {
		// enforce the swipeId is null (i.e., don't insert a swipe that already exists)
		if($this->swipeId !== null) {
			throw(new \PDOException("not a new swipe"));
		}

		// create query template
		$query = "INSERT INTO swipe(swipeId, swipeStatus, swipeNumber) VALUES(:swipeId, :swipeStatus, :swipeNumber)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["swipeId" => $this->swipeId, "swipeStatus" => $this->swipeStatus, "swipeNumber" => $this->swipeNumber];
		$statement->execute($parameters);

		// update the null swipeId with what mySQL just gave us
		$this->swipeId = intval($pdo->lastInsertId());
	}

	/**
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when id is not valid
	 */
	public function update(\PDO $pdo) {
		// enforce the swipeId is not null (i.e., don't update a swipe that hasn't been inserted)
		if($this->swipeId === null) {
			throw(new \PDOException("unable to update a swipe that does not exist"));
		}

		// create query template
		$query = "UPDATE swipe SET swipeId = :swipeId, swipeStatus = :swipeStatus, swipeNumber = :swipeNumber WHERE swipeId = :swipeId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["swipeId" => $this->swipeId, "swipeStatus" => $this->swipeStatus, "swipeNumber" => $this->swipeNumber];
		$statement->execute($parameters);
	}

	/**
	 * @param \PDO $pdo
	 * @param int $swipeId
	 * @return Swipe|null
	 */
	public static function getSwipeBySwipeId(\PDO $pdo, int $swipeId) {
		// sanitize the swipeId before searching
		if($swipeId <= 0) {
			throw(new \PDOException("swipeId not positive"));
		}

		// create query template
		$query = "SELECT swipeId, swipeStatus, swipeNumber FROM swipe WHERE swipeId = :swipeId";
		$statement = $pdo->prepare($query);

		// bind the swipe id to the place holder in template
		$parameters = ["swipeId" => $swipeId];
		$statement->execute($parameters);

		// grab swipe from SQL
		try {
			$swipe = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$swipe = new swipe($row["swipeId"], $row["swipeStatus"], $row["swipeNumber"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($swipe);
	}

	/**
	 * @param \PDO $pdo PDO connection object
	 * @param int $swipeStatus new value for swipe status
	 * @return \SplFixedArray SplFixedArray of swipe
	 * @throws \PDOException when swipe id is not valid
	 * @throws \TypeError when swipe id is not an integer
	 */
	public static function getSwipeBySwipeStatus(\PDO $pdo, int $swipeStatus) {
		// sanitize the swipeId before searching
		if($swipeStatus <= 0) {
			throw(new \PDOException("swipeStatus not positive"));
		}

		// create query template
		$query = "SELECT swipeId, swipeStatus, swipeNumber FROM swipe WHERE swipeStatus = :swipeStatus";
		$statement = $pdo->prepare($query);

		// bind the swipe id to the place holder in template
		$parameters = ["swipeStatus" => $swipeStatus];
		$statement->execute($parameters);

		// build an array of swipes
		$swipes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$swipe = new Swipe($row["swipeId"], $row["swipeStatus"], $row["swipeNumber"]);
				$swipes[$swipes->key()] = $swipe;
				$swipes->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $swipes;
	}

	/**
	 * @param \PDO $pdo connection object
	 * @param int $swipeNumber new value
	 * @return \SplFixedArray SplFixedArray of swipe
	 * @throws \PDOException when mySQL related error occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getSwipeBySwipeNumber(\PDO $pdo, int $swipeNumber) {
		// sanitize the swipeId before searching
		if($swipeNumber <= 0) {
			throw(new \PDOException("swipeNumber not positive"));
		}

		// create query template
		$query = "SELECT swipeId, swipeStatus, swipeNumber FROM swipe WHERE swipeStatus = :swipeStatus";
		$statement = $pdo->prepare($query);

		// bind the swipe id to the place holder in template
		$parameters = ["swipeNumber" => $swipeNumber];
		$statement->execute($parameters);

		// build an array of swipes
		$swipes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$swipe = new Swipe($row["swipeId"], $row["swipeStatus"], $row["swipeNumber"]);
				$swipes[$swipes->key()] = $swipe;
				$swipes->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $swipes;
	}

	/**
	 * @param \PDO $pdo connection objects
	 * @return \SplFixedArray SplFi
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getAllSwipes(\PDO $pdo) {
		// create query template
		$query = "SELECT swipeId, swipeStatus, swipeNumber FROM swipe";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of swipes
		$swipes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$swipe = new Swipe($row["swipeId"], $row["swipeStatus"], $row["swipeNumber"]);
				$swipes[$swipes->key()] = $swipe;
				$swipes->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $swipes;
	}

	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return ($fields);
	}
}


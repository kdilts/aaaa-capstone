<?php

namespace Edu\Cnm\DdcAaaa;

class Placard {

	/**
	 * @var int $placardId
	 */
	private $placardId;

	/**
	 * @var int $placardStatus
	 */
	private $placardStatus;

	/**
	 * @var int $placardNumber
	 */
	private $placardNumber;

	/**
	 * Placard constructor.
	 * @param int|null $newPlacardId
	 * @param int $newPlacardStatus
	 * @param int $newPlacardNumber
	 * @throws \InvalidArgumentException
	 * @throws \RangeException
	 * @throws \TypeError
	 * @throws \Exception
	 */
	public function __construct(int $newPlacardId = null, int $newPlacardStatus, int $newPlacardNumber) {
		try {
			$this->setPlacardId($newPlacardId);
			$this->setPlacardNumber($newPlacardNumber);
			$this->setPlacardStatus($newPlacardStatus);
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
	 * @return int placardId
	 */
	public function getPlacardId() {
		return $this->placardId;
	}

	/**
	 * @return int placardNumber
	 */
	public function getPlacardNumber() {
		return $this->placardNumber;
	}

	/**
	 * @return int placardStatus
	 */
	public function getPlacardStatus() {
		return $this->placardStatus;
	}

	/**
	 * @param int $newPlacardId
	 * @throws \RangeException
	 */
	public function setPlacardId(int $newPlacardId) {
		//checks if PlacardId is negative
		if ($newPlacardId <= 0) {
			throw(new \RangeException("Placard ID cannot be negative."));
		}
		$this->placardId = $newPlacardId;
	}

	/**
	 * @param int $newPlacardNumber
	 * @throws \RangeException
	 */
	public function setPlacardNumber(int $newPlacardNumber) {
		if ($newPlacardNumber <= 0) {
			throw(new \RangeException("Placard Number cannot be negative."));
		}
		$this->placardNumber = $newPlacardNumber;
	}

	/**
	 * @param int $newPlacardStatus
	 * @throws \RangeException
	 */
	public function setPlacardStatus(int $newPlacardStatus) {
		if ($newPlacardStatus < 0) {
			throw(new \RangeException("Placard status invalid."));
		}
		$this->placardStatus = $newPlacardStatus;
	}

	/**
	 * @param \PDO $pdo
	 * @throws \PDOException
	 */
	public function insert(\PDO $pdo) {
		// enforce the placardId is null (i.e., don't insert a placard that already exists)
		if($this->placardId !== null) {
			throw(new \PDOException("not a new placard"));
		}

		// create query template
		$query = "INSERT INTO placard(placardId, placardStatus, placardNumber) VALUES(:placardId, :placardStatus, :placardNumber)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["placardId" => $this->placardId, "placardStatus" => $this->placardStatus, "placardNumber" => $this->placardNumber];
		$statement->execute($parameters);

		// update the null placardId with what mySQL just gave us
		$this->placardId = intval($pdo->lastInsertId());
	}

	/**
	 * @param \PDO $pdo
	 * @throws \PDOException
	 */
	public function update(\PDO $pdo) {
		// enforce the placardId is not null (i.e., don't update a placard that hasn't been inserted)
		if($this->placardId === null) {
			throw(new \PDOException("unable to update a placard that does not exist"));
		}

		// create query template
		$query = "UPDATE placard SET placardId = :placardId, placardStatus = :placardStatus, placardNumber = :placardNumber WHERE placardId = :placardId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["placardId" => $this->placardId, "placardStatus" => $this->placardStatus, "placardNumber" => $this->placardNumber];
		$statement->execute($parameters);
	}


}

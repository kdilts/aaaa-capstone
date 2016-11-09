<?php
namespace Edu\Cnm\DdcAaaa;

class StudentPermit implements \JsonSerializable {
	use ValidateDate;

	/**
	 * @var int $studentPermitStudentId
	 */
	private $studentPermitStudentId;

	/**
	 * @var int $studentPermitPlacardId
	 */
	private $studentPermitPlacardId;

	/**
	 * @var int $studentPermitSwipeId
	 */
	private $studentPermitSwipeId;

	/**
	 * @var \DateTime $studentPermitCheckOutDate
	 */
	private $studentPermitCheckOutDate;

	/**
	 * @var \DateTime $studentPermitCheckInDate
	 */
	private $studentPermitCheckInDate;

	/**
	 * StudentPermit constructor.
	 * @param int|null $newStudentPermitStudentId
	 * @param int $newStudentPermitPlacardId
	 * @param int $newStudentPermitSwipeId
	 * @param \DateTime $newStudentPermitCheckOutDate
	 * @param \DateTime $newStudentPermitCheckInDate
	 * @throws \InvalidArgumentException
	 * @throws \RangeException
	 * @throws \TypeError
	 * @throws \Exception
	 */
	public function __construct(int $newStudentPermitStudentId = null, int $newStudentPermitPlacardId, int $newStudentPermitSwipeId, \DateTime $newStudentPermitCheckOutDate, \DateTime $newStudentPermitCheckInDate){
		try{
			$this->setStudentPermitStudentId($newStudentPermitStudentId);
			$this->setStudentPermitPlacardId($newStudentPermitPlacardId);
			$this->setStudentPermitSwipeId($newStudentPermitSwipeId);
			$this->setStudentPermitCheckInDate($newStudentPermitCheckInDate);
			$this->setStudentPermitCheckOutDate($newStudentPermitCheckOutDate);
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
	 * @return int
	 */
	public function getStudentPermitStudentId(){
		return($this->studentPermitStudentId);
	}

	/**
	 * @return int
	 */
	public function getStudentPermitPlacardId(){
		return($this->studentPermitPlacardId);
	}

	/**
	 * @return int
	 */
	public function getStudentPermitSwipeId(){
		return($this->studentPermitSwipeId);
	}

	/**
	 * @return \DateTime
	 */
	public function getStudentPermitCheckOutDate(){
		return($this->studentPermitCheckOutDate);
	}

	/**
	 * @return \DateTime
	 */
	public function getStudentPermitCheckInDate(){
		return($this->studentPermitCheckInDate);
	}

	/**
	 * @param int $newStudentPermitStudentId
	 * @throws \RangeException
	 */
	public function setStudentPermitStudentId(int $newStudentPermitStudentId){
		if ($newStudentPermitStudentId <= 0) {
			throw(new \RangeException("Student Id cannot be negative."));
		}
		$this->studentPermitStudentId = $newStudentPermitStudentId;
	}

	/**
	 * @param int $newStudentPermitPlacardId
	 * @throws \RangeException
	 */
	public function setStudentPermitPlacardId(int $newStudentPermitPlacardId){
		if ($newStudentPermitPlacardId <= 0) {
			throw(new \RangeException("Placard Id cannot be negative."));
		}
		$this->studentPermitPlacardId = $newStudentPermitPlacardId;
	}

	/**
	 * @param int $newStudentPermitSwipeId
	 * @throws \RangeException
	 */
	public function setStudentPermitSwipeId(int $newStudentPermitSwipeId){
		if ($newStudentPermitSwipeId <= 0) {
			throw(new \RangeException("Swipe Id cannot be negative."));
		}
		$this->studentPermitSwipeId = $newStudentPermitSwipeId;
	}

	/**
	 * @param \DateTime $newStudentPermitCheckOutDate
	 * @throws \InvalidArgumentException
	 * @throws \RangeException
	 */
	public function setStudentPermitCheckOutDate(\DateTime $newStudentPermitCheckOutDate){
		try {
			$newStudentPermitCheckOutDate = self::validateDateTime($newStudentPermitCheckOutDate);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}

		$this->studentPermitCheckOutDate = $newStudentPermitCheckOutDate;
	}

	/**
	 * @param \DateTime $newStudentPermitCheckInDate
	 * @throws \InvalidArgumentException
	 * @throws \RangeException
	 */
	public function setStudentPermitCheckInDate(\DateTime $newStudentPermitCheckInDate){
		try {
			$newStudentPermitCheckInDate = self::validateDateTime($newStudentPermitCheckInDate);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->studentPermitCheckInDate = $newStudentPermitCheckInDate;
	}

	/**
	 * @param \PDO $pdo
	 * @throws \PDOException
	 */
	public function insert(\PDO $pdo) {
		// enforce the placardId is null (i.e., don't insert a studentPermit that already exists)
		if($this->studentPermitStudentId !== null) {
			throw(new \PDOException("not a new studentPermit"));
		}

		//$studentPermitStudentId $studentPermitPlacardId $studentPermitSwipeId $studentPermitCheckOutDate $studentPermitCheckInDate
		
		// create query template
		$query = "INSERT INTO studentpermit(studentPermitStudentId, studentPermitPlacardId, studentPermitSwipeId, studentPermitCheckOutDate, studentPermitCheckInDate) VALUES(:studentPermitStudentId, :studentPermitPlacardId, :studentPermitSwipeId, :studentPermitCheckOutDate, :studentPermitCheckInDate)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = [
			"studentPermitStudentId" => $this->studentPermitStudentId,
			"studentPermitPlacardId" => $this->studentPermitPlacardId,
			"studentPermitSwipeId" => $this->studentPermitSwipeId,
			"studentPermitCheckOutDate" => $this->studentPermitCheckOutDate,
			"studentPermitCheckInDate" => $this->studentPermitCheckInDate
		];
		$statement->execute($parameters);

		// update the null studentPermitStudentId with what mySQL just gave us
		$this->studentPermitStudentId = intval($pdo->lastInsertId());
	}

	/**
	 * @param \PDO $pdo
	 * @throws \PDOException
	 */
	public function update(\PDO $pdo) {
		// enforce the studentPermitStudentId is not null (i.e., don't update a studentPermit that hasn't been inserted)
		if($this->studentPermitStudentId === null) {
			throw(new \PDOException("unable to update a studentPermit that does not exist"));
		}

		// create query template
		$query = "UPDATE studentpermit SET studentPermitStudentId = :studentPermitStudentId, studentPermitPlacardId = :studentPermitPlacardId, studentPermitSwipeId = :studentPermitSwipeId, studentPermitCheckOutDate = :studentPermitCheckOutDate, studentPermitCheckInDate = :studentPermitCheckInDate WHERE studentPermitStudentId = :studentPermitStudentId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = [
			"studentPermitStudentId" => $this->studentPermitStudentId,
			"studentPermitPlacardId" => $this->studentPermitPlacardId,
			"studentPermitSwipeId" => $this->studentPermitSwipeId,
			"studentPermitCheckOutDate" => $this->studentPermitCheckOutDate,
			"studentPermitCheckInDate" => $this->studentPermitCheckInDate
		];
		$statement->execute($parameters);
	}

	/**
	 * @param \PDO $pdo
	 * @return \SplFixedArray
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getAllStudentPermits(\PDO $pdo){
		// create query template
		$query = "SELECT studentPermitStudentId, studentPermitPlacardId, studentPermitSwipeId, studentPermitCheckOutDate, studentPermitCheckInDate FROM studentpermit";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of studentPermits
		$studentPermits = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$studentPermit = new studentPermit(
					$row["studentPermitStudentId"],
					$row["studentPermitPlacardId"],
					$row["studentPermitSwipeId"],
					$row["studentPermitCheckOutDate"],
					$row["studentPermitCheckInDate"]
				);
				$studentPermits[$studentPermits->key()] = $studentPermit;
				$studentPermits->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($studentPermits);
	}

	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}
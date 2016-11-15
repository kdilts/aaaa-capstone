<?php
namespace Edu\Cnm\DdcAaaa;

/**
 * Class StudentPermit
 * keeps track of placard / swipe pairs for each student permit
 * @package Edu\Cnm\DdcAaaa
 */
class StudentPermit implements \JsonSerializable {
	use ValidateDate;

	/**
	 * id for this student permit - this is the primary key
	 * @var $studentPermitId
	 */
	private $studentPermitId;

	/**
	 * application id for this student permit
	 * @var int $studentPermitApplicationId
	 */
	private $studentPermitApplicationId;

	/**
	 * placard id for this student permit
	 * @var int $studentPermitPlacardId
	 */
	private $studentPermitPlacardId;

	/**
	 * swipe id for this student permit
	 * @var int $studentPermitSwipeId
	 */
	private $studentPermitSwipeId;

	/**
	 * date that this student permit was give to a student
	 * @var \DateTime $studentPermitCheckOutDate
	 */
	private $studentPermitCheckOutDate;

	/**
	 * dat that this student permit was returned
	 * @var \DateTime $studentPermitCheckInDate
	 */
	private $studentPermitCheckInDate;

	/**
	 * StudentPermit constructor.
	 * @param int $newStudentPermitId for new value for new student permit id
	 * @param int $newStudentPermitApplicationId for new value for new student permit application id
	 * @param int $newStudentPermitPlacardId for new value for student permit placard id
	 * @param int $newStudentPermitSwipeId for new value for student permit swipe id
	 * @param \DateTime $newStudentPermitCheckOutDate as a DateTime object null to load the current time
	 * @param \DateTime $newStudentPermitCheckInDate as a Datetime object null to load the current time
	 * @throws \InvalidArgumentException if the new student permit is not valid
	 * @throws \RangeException if new permit id is out of range
	 * @throws \TypeError if student id is not valid
	 * @throws \Exception if the student permit student id is out of range
	 */
	public function __construct(int $newStudentPermitId = null, int $newStudentPermitApplicationId, int $newStudentPermitPlacardId, int $newStudentPermitSwipeId, \DateTime $newStudentPermitCheckOutDate, \DateTime $newStudentPermitCheckInDate){
		try{
			$this->setStudentPermitId($newStudentPermitId);
			$this->setStudentPermitApplicationId($newStudentPermitApplicationId);
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
	 * accessor method for studentPermit id
	 * @return int
	 */
	public function getStudentPermitId(){
		return($this->studentPermitId);
	}

	/**
	 * accessor method for studentPermit application id
	 * @return int
	 */
	public function getStudentPermitApplicationId(){
		return($this->studentPermitApplicationId);
	}

	/**
	 * accessor method for studentPermit placard id
	 * @return int
	 */
	public function getStudentPermitPlacardId(){
		return($this->studentPermitPlacardId);
	}

	/**
	 * accessor method for studentPermit swipe id
	 * @return int
	 */
	public function getStudentPermitSwipeId(){
		return($this->studentPermitSwipeId);
	}

	/**
	 * accessor method for studentPermit check out date
	 * @return \DateTime
	 */
	public function getStudentPermitCheckOutDate(){
		return($this->studentPermitCheckOutDate);
	}

	/**
	 * accessor method for studentPermit check in date
	 * @return \DateTime
	 */
	public function getStudentPermitCheckInDate(){
		return($this->studentPermitCheckInDate);
	}

	/**
	 * mutator method for this studentPermit id
	 * @param int $newStudentPermitId
	 * @throws \RangeException if new value of student permit id is out of range
	 * @throws \TypeError if $newStudentPermitId is not an integer
	 */
	public function setStudentPermitId(int $newStudentPermitId){
		if ($newStudentPermitId <= 0) {
			throw(new \RangeException("StudentPermit Id must be positive."));
		}
		$this->studentPermitId = $newStudentPermitId;
	}

	/**
	 * mutator method for this studentPermit application id
	 * @param int $newStudentPermitApplicationId
	 * @throws \RangeException if new value of student permit placard id is out of range
	 * @throws \TypeError if $newStudentPermitApplicationId is not an integer
	 */
	public function setStudentPermitApplicationId(int $newStudentPermitApplicationId){
		if ($newStudentPermitApplicationId <= 0) {
			throw(new \RangeException("StudentPermit application Id must be positive."));
		}
		$this->studentPermitApplicationId = $newStudentPermitApplicationId;
	}

	/**
	 * mutator method for this studentPermit placard id
	 * @param int $newStudentPermitPlacardId new value for student permit placard id
	 * @throws \RangeException if new value of student permit placard id is out of range
	 * @throws \TypeError if $newStudentPermitPlacardId is not an integer
	 */
	public function setStudentPermitPlacardId(int $newStudentPermitPlacardId){
		if ($newStudentPermitPlacardId <= 0) {
			throw(new \RangeException("studentPermit placard id must be positive."));
		}
		$this->studentPermitPlacardId = $newStudentPermitPlacardId;
	}

	/**
	 * mutator method for this studentPermit swipe id
	 * @param int $newStudentPermitSwipeId new value for student permit swipe id
	 * @throws \RangeException new value of student permit swipe id is out of range
	 * @throws \TypeError if $newStudentPermitSwipeId is not an integer
	 */
	public function setStudentPermitSwipeId(int $newStudentPermitSwipeId){
		if ($newStudentPermitSwipeId <= 0) {
			throw(new \RangeException("Swipe Id must be positive."));
		}
		$this->studentPermitSwipeId = $newStudentPermitSwipeId;
	}

	/**
	 * mutator method for this studentPermit check out date
	 * @param \DateTime $newStudentPermitCheckOutDate as a DateTime object null to load the current time
	 * @throws \InvalidArgumentException is not a valid student permit or valid date
	 * @throws \RangeException is a date that does not exist
	 * @throws \TypeError if $newStudentPermitCheckOutDate is not a DateTime
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
	 * mutator method for this studentPermit check in date
	 * @param \DateTime $newStudentPermitCheckInDate object null to load the current time
	 * @throws \InvalidArgumentException if student permit is not valid
	 * @throws \RangeException is a date that does not exist
	 * @throws \TypeError if $newStudentPermitCheckInDate is not a DateTime
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
	 * insert this studentPermit into mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL errors occur.
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) {
		// enforce the placardId is null (i.e., don't insert a studentPermit that already exists)
		if($this->studentPermitId !== null) {
			throw(new \PDOException("not a new studentPermit"));
		}
		
		// create query template
		$query = "INSERT INTO studentPermit(studentPermitId, studentPermitApplicationId, studentPermitPlacardId, studentPermitSwipeId, studentPermitCheckOutDate, studentPermitCheckInDate) VALUES(:studentPermitId, :studentPermitStudentId, :studentPermitPlacardId, :studentPermitSwipeId, :studentPermitCheckOutDate, :studentPermitCheckInDate)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedCheckOutDate = $this->getStudentPermitCheckOutDate()->format("Y-m-d H:i:s");
		$formattedCheckInDate = $this->getStudentPermitCheckInDate()->format("Y-m-d H:i:s");

		$parameters = [
			"studentPermitId" => $this->studentPermitId,
			"studentPermitApplicationId" => $this->studentPermitApplicationId,
			"studentPermitPlacardId" => $this->studentPermitPlacardId,
			"studentPermitSwipeId" => $this->studentPermitSwipeId,
			"studentPermitCheckOutDate" => $formattedCheckOutDate,
			"studentPermitCheckInDate" => $formattedCheckInDate
		];
		$statement->execute($parameters);

		// update the null studentPermitStudentId with what mySQL just gave us
		$this->studentPermitId = intval($pdo->lastInsertId());
	}

	/**
	 * @param \PDO $pdo connection object
	 * @throws \PDOException if unable to update a student permit that does not exist
	 */
	public function update(\PDO $pdo) {
		// enforce the studentPermitId is not null (i.e., don't update a studentPermit that hasn't been inserted)
		if($this->studentPermitId === null) {
			throw(new \PDOException("unable to update a studentPermit that does not exist"));
		}

		// create query template
		$query = "UPDATE studentpermit SET studentPermitId = :studentPermitId, studentPermitApplicationId = :studentPermitApplicationId, studentPermitPlacardId = :studentPermitPlacardId, studentPermitSwipeId = :studentPermitSwipeId, studentPermitCheckOutDate = :studentPermitCheckOutDate, studentPermitCheckInDate = :studentPermitCheckInDate WHERE studentPermitApplicationId = :studentPermitApplicationId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedCheckOutDate = $this->getStudentPermitCheckOutDate()->format("Y-m-d H:i:s");
		$formattedCheckInDate = $this->getStudentPermitCheckInDate()->format("Y-m-d H:i:s");

		$parameters = [
			"studentPermitId" => $this->studentPermitId,
			"studentPermitApplicationId" => $this->studentPermitApplicationId,
			"studentPermitPlacardId" => $this->studentPermitPlacardId,
			"studentPermitSwipeId" => $this->studentPermitSwipeId,
			"studentPermitCheckOutDate" => $formattedCheckOutDate,
			"studentPermitCheckInDate" => $formattedCheckInDate
		];
		$statement->execute($parameters);
	}

	/**
	 * @param \PDO $pdo
	 * @param $studentPermitId
	 * @return StudentPermit|null
	 * @throws \PDOException
	 */
	public static function getStudentPermitByStudentPermitId(\PDO $pdo, $studentPermitId){
		// sanitize the studentPermitId before searching
		if($studentPermitId <= 0){
			throw(new \PDOException("studentPermitId not positive"));
		}

		// create query template
		$query = "SELECT studentPermitId, studentPermitApplicationId, studentPermitPlacardId, studentPermitSwipeId, studentPermitCheckOutDate, studentPermitCheckInDate From studentPermit WHERE studentPermitId = :studentPermitId";
		$statement = $pdo->prepare($query);

		// bind the placard id to the place holder in template
		$parameters = ["studentPermitId" => $studentPermitId];
		$statement->execute($parameters);

		// grab placard from SQL
		try {
			$studentPermit = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){

				$studentPermit = new StudentPermit(
					$row["studentPermitId"],
					$row["studentPermitApplicationId"],
					$row["studentPermitPlacardId"],
					$row["studentPermitSwipeId"],
					$row["studentPermitCheckOutDate"],
					$row["studentPermitCheckInDate"]
				);
			}
		} catch(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($studentPermit);
	}

	/**
	 * @param \PDO $pdo
	 * @param $studentPermitApplicationId
	 * @return StudentPermit|null
	 * @throws \PDOException
	 */
	public static function getStudentPermitByStudentPermitApplicationId(\PDO $pdo, $studentPermitApplicationId){
		// sanitize the studentPermitId before searching
		if($studentPermitApplicationId <= 0){
			throw(new \PDOException("studentPermitApplicationId not positive"));
		}

		// create query template
		$query = "SELECT studentPermitId, studentPermitApplicationId, studentPermitPlacardId, studentPermitSwipeId, studentPermitCheckOutDate, studentPermitCheckInDate From studentPermit WHERE studentPermitApplicationId = :studentPermitApplicationId";
		$statement = $pdo->prepare($query);

		// bind the placard id to the place holder in template
		$parameters = ["$studentPermitApplicationId" => $studentPermitApplicationId];
		$statement->execute($parameters);

		// grab placard from SQL
		try {
			$studentPermit = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){

				$studentPermit = new StudentPermit(
					$row["studentPermitId"],
					$row["studentPermitApplicationId"],
					$row["studentPermitPlacardId"],
					$row["studentPermitSwipeId"],
					$row["studentPermitCheckOutDate"],
					$row["studentPermitCheckInDate"]
				);
			}
		} catch(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($studentPermit);
	}

	/**
	 * @param \PDO $pdo
	 * @param $studentPermitSwipeId
	 * @return StudentPermit|null
	 * @throws \PDOException
	 */
	public static function getStudentPermitByStudentPermitSwipeId(\PDO $pdo, $studentPermitSwipeId){
		// sanitize the studentPermitId before searching
		if($studentPermitSwipeId <= 0){
			throw(new \PDOException("studentPermitSwipeId not positive"));
		}

		// create query template
		$query = "SELECT studentPermitId, studentPermitApplicationId, studentPermitPlacardId, studentPermitSwipeId, studentPermitCheckOutDate, studentPermitCheckInDate From studentPermit WHERE studentPermitSwipeId = :studentPermitSwipeId";
		$statement = $pdo->prepare($query);

		// bind the placard id to the place holder in template
		$parameters = ["$studentPermitSwipeId" => $studentPermitSwipeId];
		$statement->execute($parameters);

		// grab placard from SQL
		try {
			$studentPermit = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){

				$studentPermit = new StudentPermit(
					$row["studentPermitId"],
					$row["studentPermitApplicationId"],
					$row["studentPermitPlacardId"],
					$row["studentPermitSwipeId"],
					$row["studentPermitCheckOutDate"],
					$row["studentPermitCheckInDate"]
				);
			}
		} catch(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($studentPermit);
	}

	/**
	 * @param \PDO $pdo
	 * @param $studentPermitPlacardId
	 * @return StudentPermit|null
	 * @throws \PDOException
	 */
	public static function getStudentPermitByStudentPermitPlacardId(\PDO $pdo, $studentPermitPlacardId){
		// sanitize the studentPermitId before searching
		if($studentPermitPlacardId <= 0){
			throw(new \PDOException("studentPermitPlacardId not positive"));
		}

		// create query template
		$query = "SELECT studentPermitId, studentPermitApplicationId, studentPermitPlacardId, studentPermitSwipeId, studentPermitCheckOutDate, studentPermitCheckInDate From studentPermit WHERE studentPermitPlacardId = :studentPermitPlacardId";
		$statement = $pdo->prepare($query);

		// bind the placard id to the place holder in template
		$parameters = ["$studentPermitPlacardId" => $studentPermitPlacardId];
		$statement->execute($parameters);

		// grab placard from SQL
		try {
			$studentPermit = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){

				$studentPermit = new StudentPermit(
					$row["studentPermitId"],
					$row["studentPermitApplicationId"],
					$row["studentPermitPlacardId"],
					$row["studentPermitSwipeId"],
					$row["studentPermitCheckOutDate"],
					$row["studentPermitCheckInDate"]
				);
			}
		} catch(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($studentPermit);
	}

	// TODO add getStudentPermitByCheckInDateRange

	/**
	 * gets studentPermit by studentPermit check out date range
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param \DateTime $startDate start date of search
	 * @param \DateTime $endDate end date of search
	 * @return \SplFixedArray studentPermits found, or null if none are found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getStudentPermitsByStudentPermitCheckOutDateRange(\PDO $pdo, \DateTime $startDate, \DateTime $endDate){
		// validate dates
		try {
			$startDate = self::validateDateTime($startDate);
			$endDate = self::validateDateTime($endDate);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}

		// format dates
		$startDate = $startDate->format("Y-m-d H:i:s");
		$endDate = $endDate->format("Y-m-d H:i:s");

		// create query template
		$query = "SELECT studentPermitId, studentPermitApplicationId, studentPermitPlacardId, studentPermitSwipeId, studentPermitCheckOutDate, studentPermitCheckInDate FROM studentPermit WHERE studentPermitCheckOutDate >= :startDate AND  studentPermitCheckOutDate <= :endDate";
		$statement = $pdo->prepare($query);

		// bind the parameters
		$parameters = ["$startDate" => $startDate, "$endDate" => $endDate];
		$statement->execute($parameters);

		// build an array of studentPermits
		$studentPermits = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$studentPermit = new studentPermit(
					$row["studentPermitId"],
					$row["studentPermitApplicationId"],
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

	/**
	 * get all student permits
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of studentPermits found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getAllStudentPermits(\PDO $pdo){
		// create query template
		$query = "SELECT studentPermitId, studentPermitApplicationId, studentPermitPlacardId, studentPermitSwipeId, studentPermitCheckOutDate, studentPermitCheckInDate FROM studentPermit";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of studentPermits
		$studentPermits = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$studentPermit = new studentPermit(
					$row["studentPermitId"],
					$row["studentPermitApplicationId"],
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
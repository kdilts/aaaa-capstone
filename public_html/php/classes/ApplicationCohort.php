<?php

namespace Edu\Cnm\DdcAaaa;

/**
 * class applicationCohort for aaaa
 *
 * @version 1.0.0
 **/
class applicationCohort implements \JsonSerializable {

	/**
	 * @var $applicationCohortId
	 */
	private $applicationCohortId;

	/**
	 * @var $applicationCohortApplicationIdId
	 */
	private $applicationCohortApplicationId;

	/**
	 * @var $applicationCohortCohortId
	 */
	private $applicationCohortCohortId;

	/**
	 * applicationCohort constructor.
	 * @param int|null $newApplicationCohortId
	 * @param int $newApplicationCohortApplicationId
	 * @param int $newApplicationCohortCohortId
	 * @throws \InvalidArgumentException
	 * @throws \RangeException
	 * @throws \TypeError
	 * @throws \Exception
	 */
	public function __construct(int $newApplicationCohortId = null, int $newApplicationCohortApplicationId, int $newApplicationCohortCohortId) {
		try {
			$this->setApplicationCohortId($newApplicationCohortId);
			$this->setApplicationCohortApplicationId($newApplicationCohortApplicationId);
			$this->setApplicationCohortCohortId($newApplicationCohortCohortId);
		} catch(\InvalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0,$invalidArgument));
		} catch(\RangeException $range) {
			// rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			// rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			// rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * @return int
	 */
	public function getApplicationCohortId() {
		return($this->applicationCohortId);
	}

	/**
	 * @return int
	 */
	public function getApplicationCohortApplicationId() {
		return($this->applicationCohortApplicationId);
	}

	/**
	 * @return int
	 */
	public function getApplicationCohortCohortId() {
		return($this->applicationCohortCohortId);
	}
	
	/**
	 * @param $newApplicationCohortId
	 * @throws \RangeException
	 */
	public function setApplicationCohortId($newApplicationCohortId) {
		// base case: if the applicatoinCohortId is null
		if($newApplicationCohortId === null)	{
			$this->applicationCohortId = null;
			return;
		}

		// input validation
		if($newApplicationCohortId <= 0){
			throw(new \RangeException("applicationCohortId is not positive"));
		}
		$this->applicationCohortId = $newApplicationCohortId;
	}

	/**
	 * @param $newApplicationCohortApplicationId
	 * @throws \RangeException
	 */
	public function setApplicationCohortApplicationId($newApplicationCohortApplicationId) {
		// input validation
		if($newApplicationCohortApplicationId <= 0){
			throw(new \RangeException("applicationCohortApplicationId is not positive"));
		}
		$this->applicationCohortApplicationId = $newApplicationCohortApplicationId;
	}

	/**
	 * @param $newApplicationCohortCohortId
	 * @throws \RangeException
	 */
	public function setApplicationCohortCohortId($newApplicationCohortCohortId) {
		// input validation
		if($newApplicationCohortCohortId <= 0){
			throw(new \RangeException("applicationCohortCohortId is not positive"));
		}
		$this->applicationCohortCohortId = $newApplicationCohortCohortId;
	}

	/**
	 * @param \PDO $pdo
	 * @throws \PDOException
	 */
	public function insert(\PDO $pdo) {
		// enforce the applicationsCohortId is null (i.e., don't insert an applicationCohort that already exists)
		if($this->applicationCohortId !== null) {
			throw(new \PDOException("not a new applicationCohort"));
		}
		// create query template
		$query = "INSERT INTO applicationCohort(applicationCohortId, applicationCohortApplicationId, applicationCohortCohortId) VALUES(:applicationCohortId, :applicationCohortApplicationId, :applicationCohortCohortId)";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$parameters = [
			"applicationCohortId" => $this->applicationCohortId,
			"applicationCohortApplicationId" => $this->applicationCohortApplicationId,
			"applicationCohortCohortId" => $this->applicationCohortCohortId
		];
		$statement->execute($parameters);
		// update the null cohortId with what mySQL just gave us
		$this->applicationCohortId = intval($pdo->lastInsertId());
	}

	public static function getApplicationCohortByApplicationCohortId(\PDO $pdo, int $applicationCohortId){
		// sanitize the applicationCohortId before searching
		if($applicationCohortId <= 0){
			throw(new \PDOException("applicationCohortId not positive"));
		}

		// create query template
		$query = "SELECT applicationCohortId, applicationCohortApplicationId, applicationCohortCohortId From applicationCohort WHERE applicationCohortId = :applicationCohortId";
		$statement = $pdo->prepare($query);

		// bind the applicationCohortId to the place holder in template
		$parameters = ["applicationCohortId" => $applicationCohortId];
		$statement->execute($parameters);

		// grab placard from SQL
		try {
			$applicationCohort = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$applicationCohort = new applicationCohort($row["applicationCohortId"], $row["applicationCohortApplicationId"], $row["applicationCohortCohortId"]);
			}
		} catch(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($applicationCohort);
	}

	public function getApplicationCohortByApplicationId (\PDO $pdo, int $applicationCohortId){
		//sanitize the applicationCohortId before searching
		if ($applicationCohortId <=0) {
			throw(new \PDOException("applicationCohortId not positive"));
		}

		//create query template
		$query = "SELECT applicationCohortId, applicationCohortApplicationId, applicationCohortCohortId From applicationCoort WHERE applicationCohortId = : applicationCohortId";
		$statement = $pdo->prepare($query);

		//grab placard from SQL
		try {
			applicationCohort=null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$applicationCohort = new applicaitonCohort ($row["applicationCohortId"], $row["applicationCohortApplicationId"], $row["applicationCohortCohortId"]);
			}
		} catch(\Exception $exception){
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($applicationCohort);
	}
	/**
	 * @return array
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}
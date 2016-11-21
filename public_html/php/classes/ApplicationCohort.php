<?php

namespace Edu\Cnm\DdcAaaa;

/**
 * cross section of the Application Cohort assignments
 *
 * This example of the assignations and uses within the app that cnm will use to automatize the application
 * process
 *
 * class applicationCohort for aaaa
 *
 * @version 1.0.0
 **/
class ApplicationCohort implements \JsonSerializable {

	/**
	 * id for this applicationCohort; this is the primary key
	 * @var $applicationCohortId
	 */
	private $applicationCohortId;

	/**
	 * id for the application cohort; this is a foreign key
	 * @var $applicationCohortApplicationId
	 */
	private $applicationCohortApplicationId;

	/**
	 * id for the application assigned according to applicable cohort
	 * @var $applicationCohortCohortId
	 */
	private $applicationCohortCohortId;

	/**
	 * applicationCohort constructor.
	 * @param int|null $newApplicationCohortId id of this application or null if a new application
	 * @param int $newApplicationCohortApplicationId id of the application assigned to a cohort
	 * @param int $newApplicationCohortCohortId id of the cohort
	 * @throws \InvalidArgumentException if data is not valid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
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
	 * accessor method for the cohort id
	 * @return int|null value for the cohort id
	 */
	public function getApplicationCohortId() {
		return($this->applicationCohortId);
	}

	/**
	 * accessor method for the cohort application id
	 * @return int value for the cohort application id
	 */
	public function getApplicationCohortApplicationId() {
		return($this->applicationCohortApplicationId);
	}

	/**
	 * accessor method for the application cohort cohort id
	 * @return int value of the application cohort cohort id
	 */
	public function getApplicationCohortCohortId() {
		return($this->applicationCohortCohortId);
	}

	/**
	 * mutator method for the application cohort id
	 * @param int $newApplicationCohortId new value of applicationCohort id
	 * @throws \RangeException if $newApplicationCohortId is not positive
	 */
	public function setApplicationCohortId($newApplicationCohortId) {
		// base case: if the applicationCohortId is null, this is a new applicationCohortId without a mySQL assigned id (yet)
		if($newApplicationCohortId === null)	{
			$this->applicationCohortId = null;
			return;
		}

		// verify the application cohort id is positive
		if($newApplicationCohortId <= 0){
			throw(new \RangeException("applicationCohortId is not positive"));
		}

		// convert and store the application cohort id
		$this->applicationCohortId = $newApplicationCohortId;
	}

	/**
	 * mutator method for applicationCohort profile id
	 *
	 * @param int $newApplicationCohortApplicationId new value of application cohort application id
	 * @throws \RangeException if new application cohort application id is not positive
	 */
	public function setApplicationCohortApplicationId($newApplicationCohortApplicationId) {
		// verify the application cohort application id is positive
		if($newApplicationCohortApplicationId <= 0){
			throw(new \RangeException("applicationCohortApplicationId is not positive"));
		}

		// convert and store the profile id
		$this->applicationCohortApplicationId = $newApplicationCohortApplicationId;
	}

	/**
	 * mutator method for application cohort cohort id
	 *
	 * @param int $newApplicationCohortCohortId new value of application cohort cohort id
	 * @throws \RangeException if $newApplicationCohortCohortId is not positive
	 */
	public function setApplicationCohortCohortId($newApplicationCohortCohortId) {
		// verify the application cohort cohort id is positive
		if($newApplicationCohortCohortId <= 0){
			throw(new \RangeException("applicationCohortCohortId is not positive"));
		}

		// store the application cohort cohort id
		$this->applicationCohortCohortId = $newApplicationCohortCohortId;
	}

	/**
	 * insert this Application Cohort into mySQL
	 * @param \PDO $pdo connection object
	 * @throws \PDOException if application cohort is not positive
	 */
	public function insert(\PDO $pdo) {
		// enforce the applicationsCohortId is null (i.e., don't insert an applicationCohort that already exists)
		if($this->applicationCohortId !== null) {
			throw(new \PDOException("not a new applicationCohort"));
		}
		// create query template
		$query = "INSERT INTO applicationCohort(applicationCohortId, applicationCohortApplicationId, applicationCohortCohortId) VALUES(:applicationCohortId, :applicationCohortApplicationId, :applicationCohortCohortId)";
		$statement = $pdo->prepare($query);
		// bind the application variables to the place holders in the template
		$parameters = [
			"applicationCohortId" => $this->applicationCohortId,
			"applicationCohortApplicationId" => $this->applicationCohortApplicationId,
			"applicationCohortCohortId" => $this->applicationCohortCohortId
		];
		$statement->execute($parameters);
		// update the null applicationCohortId with what mySQL just gave us
		$this->applicationCohortId = intval($pdo->lastInsertId());
	}

	/**
	 * gets the application Cohort by application cohort id
	 *
	 * @param \PDO $pdo connection to the object
	 * @param int $applicationCohortId new value of application cohort id
	 * @return ApplicationCohort|null applicationCohort if found or null if not found
	 * @throws \PDOException if application cohort id is not positive

*/
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

	/**
	 * gets the Application Cohort by application id
	 * @param \PDO $pdo connection object
	 * @param int $applicationCohortId application cohort id to search for
	 * @return ApplicationCohort|null applicationCohort if found or null if not found
	 * @throws \PDOException if application cohort application id is not positive
	 */

	public static function getApplicationCohortByApplicationId (\PDO $pdo, int $applicationCohortId){
		//sanitize the applicationCohortId before searching
		if ($applicationCohortId <=0) {
			throw(new \PDOException("applicationCohortId not positive"));
		}

		//create query template
		$query = "SELECT applicationCohortId, applicationCohortApplicationId, applicationCohortCohortId From applicationCohort WHERE applicationCohortId = : applicationCohortId";
		$statement = $pdo->prepare($query);

		//grab placard from SQL
		try {
			$applicationCohort = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$applicationCohort = new applicationCohort ($row["applicationCohortId"], $row["applicationCohortApplicationId"], $row["applicationCohortCohortId"]);
			}
		} catch(\Exception $exception){
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($applicationCohort);
	}

	/**
	 * gets the Application Cohort Id
	 * @param \PDO $pdo connection object
	 * @param int $applicationCohortId application cohort id to search for
	 * @return ApplicationCohort|null applicationCohort if found or null if not found
	 * @throws \PDOException if application cohort cohort id is not positive
	 */
	public static function getApplicationCohortByCohortId (\PDO $pdo, int $applicationCohortId){
		//sanitize the applicationCohortId before searching
		if ($applicationCohortId <=0){
			throw(new \PDOException("applicationCohortId not positive"));
		}
		//create query template
		$query = "SELECT applicationCohortId, applicationCohortApplicationId, applicationCohortCohortId FROM applicationCohort WHERE applicationCohortId = : applicaitonCohortId";
		$statement = $pdo->prepare($query);

		//grab placard from SQL
		try {
			$applicationCohort = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if ($row !==false){
				$applicationCohort = new applicationCohort ($row["applicationCohortId"], $row["applicationCohortApplicationId"], $row["applicationCohortCohortId"]);
			}
		} catch(\Exception $exception){
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($applicationCohort);
	}

	/**
	 * @param \PDO $pdo connection objects
	 * @return \SplFixedArray SplFi
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getAllApplicationCohorts(\PDO $pdo) {
		// create query template
		$query = "SELECT applicationCohortId, applicationCohortApplicationId, applicationCohortCohortId FROM applicationCohort";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of application cohorts
		$applicationCohorts = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$applicationCohort = new ApplicationCohort($row["applicationCohortId"], $row["applicationCohortApplicationId"], $row["applicationCohortCohortId"]);
				$applicationCohorts[$applicationCohorts->key()] = $applicationCohort;
				$applicationCohorts->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $applicationCohorts;
	}
	/**
	 * @return array
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}
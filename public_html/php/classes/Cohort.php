<?php

// trevor

namespace Edu\Cnm\DdcAaaa;

/**
 * class Cohort for aaaa
 *
 * @version 1.0.0
 **/
class Cohort implements \JsonSerializable {

	/**
	 * id for the cohort is the primary key
	 * @var int $cohortId
	 **/
	private $cohortId;

	/**
	 * @var string $cohortName
	 **/
	private $cohortName;
	/**
	 * cohort constructor
	 *
	 * @param int|null $newCohortId
	 * @param string $newCohortName
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data is not correct or is not positive
	 * @throws \TypeError when variable are not the correct data type
	 * @throws \Exception when any other exceptions occur
	 **/

	public function __construct(int $newCohortId = null, string $newCohortName) {
		try {
			$this->setCohortId($newCohortId);
			$this->setCohortName($newCohortName);
		} catch(\InvalidArgumentException $invalidArgument){
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
	 * accessor method for cohort id
	 *
	 * @return int|null value of the cohort id
	 **/
	public function getCohortId() {
		return ($this->cohortId);
	}
	
	/**
	 * @param int|null $newCohortId
	 * @throws \RangeException if data is not positive
	 * @throws \TypeError if id is not an integer
	 */
	public function setCohortId(int $newCohortId = null) {
		// base case: if the cohort id is null
		if($newCohortId === null)	{
			$this->cohortId = null;
			return;
		}
		// verify the cohort id is positive
		if($newCohortId <= 0) {
			throw(new \RangeException("cohort id is not positive"));
		}
		// convert and store the cohort id
		$this->cohortId = $newCohortId;

	}
	/**
	 * accessor method for the cohort name
	 *
	 * @return string value of cohort name
	 */
	public function getCohortName() {
		return($this->cohortName);
	}

	/**
	 * mutator method for cohort name
	 * @param string $newCohortName
	 * @throws \RangeException if $newCohortName is not positive
	 * @throws \TypeError if $newCohortName is not an integer
	 **/
	public function setCohortName(string $newCohortName) {
		$newCohortName = trim ($newCohortName);
		$newCohortName = filter_var($newCohortName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newCohortName) === true) {
			throw (new \InvalidArgumentException("Bridge name is either empty or insecure."));
		}
		if(strlen($newCohortName) > 30) {
			throw(new \RangeException("Cohort name too large"));
		}
		// convert and store the cohort name
		$this->cohortName = $newCohortName;
	}

	/**
	 * inserts this Cohort into database
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when SQL errors occur
	 * @throws \TypeError if $pdo is not a pdo connection object
	 */
	public function insert(\PDO $pdo) {
		// enforce the cohortId is null (i.e., don't insert a cohort that already exists)
		if($this->cohortId !== null) {
			throw(new \PDOException("not a new cohort"));
		}
		// create query template
		$query = "INSERT INTO cohort(cohortId, cohortName) VALUES(:cohortId, :cohortName)";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$parameters = ["cohortId" => $this->cohortId, "cohortName" => $this->cohortName];
		$statement->execute($parameters);
		// update the null cohortId with what mySQL just gave us
		$this->cohortId = intval($pdo->lastInsertId());
	}

	/**
	 * gets cohorts by cohortId
	 * @param \PDO $pdo connection object
	 * @param int $cohortId to search for
	 * @return Cohort|null gets value of cohort
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	 public static function getCohortByCohortId(\PDO $pdo, int $cohortId){
		// sanitize the cohortId before searching
		if($cohortId <= 0){
			throw(new \PDOException("cohortId not positive"));
		}

		// create query template
		$query = "SELECT cohortId, cohortName From cohort WHERE cohortId = :cohortId";
		$statement = $pdo->prepare($query);

		// bind the cohort id to the place holder in template
		$parameters = ["cohortId" => $cohortId];
		$statement->execute($parameters);

		// grab cohort from SQL
		try {
			$cohort = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$cohort = new Cohort($row["cohortId"], $row["cohortName"]);
			}
		} catch(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($cohort);
	}

	/**
	 * searches cohorts by Name
	 * @param \PDO $pdo connection object
	 * @param string $cohortName searching cohort by Name
	 * @return Cohort|null id for the application to search for
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */

	public static function getCohortByCohortName(\PDO $pdo, string $cohortName){
		// sanitize the cohortId before searching
		if($cohortName <= 0){
			throw(new \PDOException("cohortName not positive"));
		}

		// create query template
		$query = "SELECT cohortId, cohortName From cohort WHERE cohortName = :cohortName";
		$statement = $pdo->prepare($query);

		// bind the cohort id to the place holder in template
		$parameters = ["cohortName" => $cohortName];
		$statement->execute($parameters);

		// grab cohort from SQL
		try {
			$cohort = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$cohort = new Cohort($row["cohortId"], $row["cohortName"]);
			}
		} catch(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($cohort);
	}
	/**
	 * gets all cohorts
	 * @param \PDO $pdo connection object
	 * @return \SplFixedArray of cohorts found, or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getAllCohorts(\PDO $pdo){
		// create query template
		$query = "SELECT cohortId, cohortName From cohort";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of cohorts
		$cohorts = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false){
			try {
				$cohort = new Cohort($row["cohortId"], $row["cohortName"]);
				$cohorts[$cohorts->key()] = $cohort;
				$cohorts->next();
			} catch(\Exception $exception){
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $cohorts;
	}

	/**
	 * @return array
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
	
}
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
	 * @var int $cohortApplicationId
	 **/
	private $cohortApplicationId;
	/**
	 * cohort constructor
	 *
	 * @param int|null $newCohortId
	 * @param int $newCohortApplicationId
	 * @throws \InvalidArgumentException
	 * @throws \RangeException
	 * @throws \TypeError
	 * @throws \Exception
	 **/

	public function __construct(int $newCohortId = null, int $newCohortApplicationId) {
		try {
			$this->setCohortId($newCohortId);
			$this->setCohortApplicationId($newCohortApplicationId);
		} catch(\InvalidArgumentException $invalidArgument)
		{
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
	 * @return int|null
	 **/
	public function getCohortId() {
		return ($this->cohortId);
	}



	/**
	 * @param int|null $newCohortId
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
	 * accessor method for the cohort application id
	 *
	 * @return int value of cohort application id
	 */
	public function getCohortApplicationId () {
		return($this->cohortApplicationId);
	}

	/**
	 * mutator method for cohort application id
	 * @param int $newCohortApplicationId
	 * @throws \RangeException if $newCohortApplicationId is not positive
	 * @throws \TypeError if $newCohortApplicationId is not an integer
	 **/
	public function setCohortApplicationId(int $newCohortApplicationId) {
		if($newCohortApplicationId <= 0) {
			throw(new \RangeException("cohort application id is not positive"));
		}
		// convert and store the cohort application id
		$this->cohortApplicationId = $newCohortApplicationId;
	}

	/**
	 * @param \PDO $pdo
	 * @throws \PDOException
	 */
	public function insert(\PDO $pdo) {
		// enforce the cohortId is null (i.e., don't insert a cohort that already exists)
		if($this->cohortId !== null) {
			throw(new \PDOException("not a new cohort"));
		}
		// create query template
		$query = "INSERT INTO cohort(cohortId, cohortApplicationId) VALUES(:cohortId, :cohortApplicationId)";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$parameters = ["cohortId" => $this->cohortId, "cohortApplicationId" => $this->cohortApplicationId];
		$statement->execute($parameters);
		// update the null cohortId with what mySQL just gave us
		$this->cohortId = intval($pdo->lastInsertId());
	}
	/**
	 * @param \PDO $pdo
	 * @throws \PDOException
	 */
	public function delete(\PDO $pdo) {
		// enforce the cohortId is not null (i.e., don't delete a cohort that hasn't been inserted)
		if($this->cohortId === null) {
			throw(new \PDOException("unable to delete a cohort that does not exist"));
		}
		// create query template
		$query = "DELETE FROM cohort WHERE cohortId = :cohortId";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holder in the template
		$parameters = ["cohortId" => $this->cohortId];
		$statement->execute($parameters);
	}
	/**
	 * @param \PDO $pdo
	 * @throws \PDOException
	 */
	public function update(\PDO $pdo) {
		// enforce the cohortId is not null (i.e., don't update a cohort that hasn't been inserted)
		if($this->cohortId === null) {
			throw(new \PDOException("unable to update a cohort that does not exist"));
		}
		// create query template
		$query = "UPDATE cohort SET cohortId = :cohortId, cohortApplicationId = :cohortApplicationId WHERE cohortId = :cohortdId";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$parameters = ["cohortId" => $this->cohortId, "cohortApplicationId" => $this->cohortApplicationId];
		$statement->execute($parameters);
	}

	public static function getCohortByCohortId(\PDO $pdo, int $cohortId){
		// sanitize the cohortId before searching
		if($cohortId <= 0){
			throw(new \PDOException("cohortId not positive"));
		}

		// create query template
		$query = "SELECT cohortId, cohortApplicationId From cohort WHERE cohortId = :cohortId";
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
				$cohort = new Cohort($row["cohortId"], $row["cohortApplicationId"]);
			}
		} catch(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($cohort);
	}

	/**
	 * @param \PDO $pdo
	 * @return \SplFixedArray
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getAllCohorts(\PDO $pdo){
		// create query template
		$query = "SELECT cohortId, cohortApplicationId From cohort";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of cohorts
		$cohorts = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false){
			try {
				$cohort = new Cohort($row["cohortId"], $row["cohortApplicationId"]);
				$cohorts[$cohorts->key()] = $cohort;
				$cohorts->next();
			} catch(\Exception $exception){
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $cohorts;
	}

	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
	
}
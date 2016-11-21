<?php

namespace Edu\Cnm\DdcAaaa;

/**
 * cross section of the Prospect Cohort assignments
 *
 * This example of the assignations and uses within the app that cnm will use to automatize the prospect
 * process
 *
 * class prospectCohort for aaaa
 *
 * @version 1.0.0
 **/
class ProspectCohort implements \JsonSerializable {

	/**
	 * id for this prospectCohort; this is the primary key
	 * @var $prospectCohortId
	 */
	private $prospectCohortId;

	/**
	 * id for the prospect cohort; this is a foreign key
	 * @var $prospectCohortProspectId
	 */
	private $prospectCohortProspectId;

	/**
	 * id for the prospect assigned according to applicable cohort
	 * @var $prospectCohortCohortId
	 */
	private $prospectCohortCohortId;

	/**
	 * prospectCohort constructor.
	 * @param int|null $newProspectCohortId id of this prospect or null if a new prospect
	 * @param int $newProspectCohortProspectId id of the prospect assigned to a cohort
	 * @param int $newProspectCohortCohortId id of the cohort
	 * @throws \InvalidArgumentException if data is not valid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function __construct(int $newProspectCohortId = null, int $newProspectCohortProspectId, int $newProspectCohortCohortId) {
		try {
			$this->setProspectCohortId($newProspectCohortId);
			$this->setProspectCohortProspectId($newProspectCohortProspectId);
			$this->setProspectCohortCohortId($newProspectCohortCohortId);
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
	public function getProspectCohortId() {
		return($this->prospectCohortId);
	}

	/**
	 * accessor method for the cohort prospect id
	 * @return int value for the cohort prospect id
	 */
	public function getProspectCohortProspectId() {
		return($this->prospectCohortProspectId);
	}

	/**
	 * accessor method for the prospect cohort cohort id
	 * @return int value of the prospect cohort cohort id
	 */
	public function getProspectCohortCohortId() {
		return($this->prospectCohortCohortId);
	}

	/**
	 * mutator method for the prospect cohort id
	 * @param int $newProspectCohortId new value of tweet id
	 * @throws \RangeException if $newProspectCohortId is not positive
	 */
	public function setProspectCohortId($newProspectCohortId) {
		// base case: if the prospectCohortId is null, this is a new prospectCohortId without a mySQL assigned id (yet)
		if($newProspectCohortId === null)	{
			$this->prospectCohortId = null;
			return;
		}

		// verify the prospect cohort id is positive
		if($newProspectCohortId <= 0){
			throw(new \RangeException("prospectCohortId is not positive"));
		}

		// convert and store the prospect cohort id
		$this->prospectCohortId = $newProspectCohortId;
	}

	/**
	 * mutator method for tweet profile id
	 *
	 * @param int $newProspectCohortProspectId new value of prospect cohort prospect id
	 * @throws \RangeException if new prospect cohort prospect id is not positive
	 */
	public function setProspectCohortProspectId($newProspectCohortProspectId) {
		// verify the prospect cohort prospect id is positive
		if($newProspectCohortProspectId <= 0){
			throw(new \RangeException("prospectCohortProspectId is not positive"));
		}

		// convert and store the profile id
		$this->prospectCohortProspectId = $newProspectCohortProspectId;
	}

	/**
	 * mutator method for prospect cohort cohort id
	 *
	 * @param int $newProspectCohortCohortId new value of prospect cohort cohort id
	 * @throws \RangeException if $newProspectCohortCohortId is not positive
	 */
	public function setProspectCohortCohortId($newProspectCohortCohortId) {
		// verify the prospect cohort cohort id is positive
		if($newProspectCohortCohortId <= 0){
			throw(new \RangeException("prospectCohortCohortId is not positive"));
		}

		// store the prospect cohort cohort id
		$this->prospectCohortCohortId = $newProspectCohortCohortId;
	}

	/**
	 * insert this Prospect Cohort into mySQL
	 * @param \PDO $pdo connection object
	 * @throws \PDOException if prospect cohort is not positive
	 */
	public function insert(\PDO $pdo) {
		// enforce the prospectsCohortId is null (i.e., don't insert an prospectCohort that already exists)
		if($this->prospectCohortId !== null) {
			throw(new \PDOException("not a new prospectCohort"));
		}
		// create query template
		$query = "INSERT INTO prospectCohort(prospectCohortId, prospectCohortProspectId, prospectCohortCohortId) VALUES(:prospectCohortId, :prospectCohortProspectId, :prospectCohortCohortId)";
		$statement = $pdo->prepare($query);
		// bind the prospect variables to the place holders in the template
		$parameters = [
			"prospectCohortId" => $this->prospectCohortId,
			"prospectCohortProspectId" => $this->prospectCohortProspectId,
			"prospectCohortCohortId" => $this->prospectCohortCohortId
		];
		$statement->execute($parameters);
		// update the null prospectCohortId with what mySQL just gave us
		$this->prospectCohortId = intval($pdo->lastInsertId());
	}

	/**
	 * gets the prospect Cohort by prospect cohort id
	 *
	 * @param \PDO $pdo connection to the object
	 * @param int $prospectCohortCohortId new value of prospect cohort id
	 * @return \SplFixedArray SplFixedArray of Prospects Cohort found
	 * @return prospectCohort|null Prospect Cohort found or null if not found
	 * @throws \PDOException if prospect cohort id is not positive

*/
	public static function getProspectCohortByProspectCohortId(\PDO $pdo, int $prospectCohortCohortId){
		// sanitize the prospectCohortId before searching
		if($prospectCohortCohortId <= 0){
			throw(new \PDOException("prospectCohortId not positive"));
		}

		// create query template
		$query = "SELECT prospectCohortId, prospectCohortProspectId, prospectCohortCohortId From prospectCohort WHERE prospectCohortCohortId = :prospectCohortCohortId";
		$statement = $pdo->prepare($query);

		// bind the prospectCohortId to the place holder in template
		$parameters = ["prospectCohortCohortId" => $prospectCohortCohortId];
		$statement->execute($parameters);

		// build an array of prospect cohorts
		$prospectCohorts = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$prospectCohort = new ProspectCohort($row["prospectCohortId"], $row["prospectCohortProspectId"], $row["prospectCohortCohortId"]);
				$prospectCohorts[$prospectCohorts->key()] = $prospectCohort;
				$prospectCohorts->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $prospectCohorts;
	}

	/**
	 * gets the Prospect Cohort by prospect id
	 * @param \PDO $pdo connection object
	 * @param int $prospectCohortId prospect cohort id to search for
	 * @return prospectCohort|null when prospect cohort found or null if not found
	 * @throws \PDOException if prospect cohort prospect id is not positive
	 */

	public static function getProspectCohortByProspectId (\PDO $pdo, int $prospectCohortId){
		//sanitize the prospectCohortId before searching
		if ($prospectCohortId <=0) {
			throw(new \PDOException("prospectCohortId not positive"));
		}

		//create query template
		$query = "SELECT prospectCohortId, prospectCohortProspectId, prospectCohortCohortId From prospectCohort WHERE prospectCohortId = : prospectCohortId";
		$statement = $pdo->prepare($query);

		//grab placard from SQL
		try {
			$prospectCohort = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$prospectCohort = new prospectCohort ($row["prospectCohortId"], $row["prospectCohortProspectId"], $row["prospectCohortCohortId"]);
			}
		} catch(\Exception $exception){
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($prospectCohort);
	}

	/**
	 * gets the Prospect Cohort Id
	 * @param \PDO $pdo connection object
	 * @param int $prospectCohortId prospect cohort id to search for
	 * @return ProspectCohort|null found or not found
	 * @throws \PDOException if prospect cohort cohort id is not positive
	 */
	public static function getProspectCohortByCohortId (\PDO $pdo, int $prospectCohortId){
		//sanitize the prospectCohortId before searching
		if ($prospectCohortId <=0){
			throw(new \PDOException("prospectCohortId not positive"));
		}
		//create query template
		$query = "SELECT prospectCohortId, prospectCohortProspectId, prospectCohortCohortId FROM prospectCohort WHERE prospectCohortId = : applicaitonCohortId";
		$statement = $pdo->prepare($query);

		//grab prospectCohort from SQL
		try {
			$prospectCohort = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if ($row !==false){
				$prospectCohort = new prospectCohort ($row["prospectCohortId"], $row["prospectCohortProspectId"], $row["prospectCohortCohortId"]);
			}
		} catch(\Exception $exception){
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($prospectCohort);
	}

	/**
	 * @param \PDO $pdo connection objects
	 * @return \SplFixedArray SplFi
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getAllProspectCohorts(\PDO $pdo) {
		// create query template
		$query = "SELECT prospectCohortId, prospectCohortProspectId, prospectCohortCohortId FROM prospectCohort";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of prospect cohorts
		$prospectCohorts = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$prospectCohort = new ProspectCohort($row["prospectCohortId"], $row["prospectCohortProspectId"], $row["prospectCohortCohortId"]);
				$prospectCohorts[$prospectCohorts->key()] = $prospectCohort;
				$prospectCohorts->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $prospectCohorts;
	}
	/**
	 * @return array
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}
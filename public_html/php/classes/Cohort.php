<?php

namespace Edu\Cnm\DdcAaaa;

/**
 * class Cohort for aaaa
 *
 * @version 1.0.0
 **/
class Cohort {
	// TODO clean up indentation - ctrl a then ctrl i to do a fix indent

	/**
	 * id for the cohort is the primary key
	 * @var int $cohortId
	 **/
	private $cohortId;
	// TODO doc block for __construct is in the wrong place
	// TODO both @param variable names are misspelled
	/**
	 * cohort constructor
	 *
	 * @param int|null $newcohortId
	 * @param int $newcohortApplicationId
	 * @throws \InvalidArgumentException
	 * @throws \RangeException
	 * @throws \TypeError
	 * @throws \Exception
	 **/
	/**
	 * @var int $cohortApplicationId
	 **/
	private $cohortApplicationId;

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
// TODO missing doc block
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
		// TODO does this if statement match your comment above? !== vs ===
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
		// TODO does this if statement match your comment above? !== vs ===
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
		// TODO does this if statement match your comment above? !== vs ===
		if($this->cohortId === null) {
			throw(new \PDOException("unable to update a cohort that does not exist"));
		}
		// create query template
		// TODO syntax error in $query can you find it?
		$query = "UPDATE cohort SET cohortId = :cohortId, cohortApplicationId = :cohortApplicationId, WHERE cohortId = :cohortdId";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$parameters = ["cohortId" => $this->cohortId, "cohortApplicationId" => $this->cohortApplicationId];
		$statement->execute($parameters);
	}

}
<?php

namespace Edu\Cnm\DdcAaaa;

/**
 * class Cohort for aaaa
 *
 * @version 1.0.0
 **/
class Cohort {

	/**
	 * id for the cohort is the primary key
	 * @var int $cohortId
	 **/
	private $cohortId;
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
	public function getcohortApplicationId () {
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
}
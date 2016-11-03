<?php

namespace Edu\Cnm\aaaa;

/**
 * class Cohort for aaaa
 *
 * @author Maria Rosado (mrosado2@cnm.edu)
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
	 * @var int $cohortApplicaionId
	 **/
	 private $cohortApplicationId;
	/**
	 * cohort constructor
	 *
	 * @param int $newcohortId
	 * @param int $newcohortApplicationId
	 * @throws \InvalidArgumentException
	 * @throws \RangeException
	 * @throws \Exception
	 * @throws \TypeError
	 **/
	public function__construct(int @newCohortId = null, int $newCohortApplicationId) {
		 try {
			$this->setCohortId($newCohortId);
			$this->setCohortAppplicationId($newCohortApplicationId);
		} catch(\InvalidArgumentException $invalidArgumentException) {
		// rethrow the exception to the caller
		throw(new \InvalidArgumentException($invalidArgumentException->getmessage(), 0, $invalidArgument));
		} catch(\RangeException $rangeException) {
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
	 * @return int|null value of cohort id
	 **/
	public function getCohortId(){
		return($this->cohortId);

}
  }



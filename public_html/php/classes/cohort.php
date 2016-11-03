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
	public function__construct(int @newCohortId, int $newCohortApplicationId) {
		 try {
			$this->setCohortId($newCohortId);
			$this->setCohortAppplicationId($newCohortApplicationId);
		} catch(\InvalidArgumentException $invalidArgumentException) {
		// rethrow the exception to the caller
		throw(new \InvalidArgumentException($invalidArgumentException->getmessage(), 0,$invalidArgumentException));
		} catch(\RangeException $rangeException) {
	// rethrow the exception to the caller
		throw(new \RangeException($rangeException->getMessage(), 0, $rangeException));
		} catch(\TypeError $typeError) {
		// rethrow the exception to the caller
		throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
		// rethrow the exception to the caller
		throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 *
	 * @return int
	 **/
	public function getCohortId(){
		return($this->cohortId);

	/**
	 * @return int
	 */
	public function getcohortApplicationId () {
		return($this->cohortApplicationId);
	}
	/**
	 * @param int $newCohortId
	 */
	public function setCohortId(int $newCohortId) {
		//verify that newCohortId is positive
		if($newCohortId <= 0) {
			throw new \RangeException("cohort id is not positive");
		}
		$this->cohortId = $newCohortId;
	}
	/**
	 * @param
	 * int $newCohortApplicationId
	 */
	public function setCohortApplicarionId(int $newCohortApplicationId) {
		// verify that newCohortApplicationId is positive
		if ($newCohortApplicationId <= 0) {
			throw $new \RangeException("cohort application id is not positive");
		}
		@this->cohortApplicationId = $newCohortApplicationId;
	}




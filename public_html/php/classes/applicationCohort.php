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
	private function getApplicationCohortId() {
		return($this->applicationCohortId);
	}

	/**
	 * @return int
	 */
	private function getApplicationCohortApplicationId() {
		return($this->applicationCohortApplicationId);
	}

	/**
	 * @return int
	 */
	private function getApplicationCohortCohortId() {
		return($this->applicationCohortCohortId);
	}
	
	/**
	 * @param $newApplicationCohortId
	 * @throws \RangeException
	 */
	private function setApplicationCohortId($newApplicationCohortId) {
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
	private function setApplicationCohortApplicationId($newApplicationCohortApplicationId) {
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
	private function setApplicationCohortCohortId($newApplicationCohortCohortId) {
		// input validation
		if($newApplicationCohortCohortId <= 0){
			throw(new \RangeException("applicationCohortCohortId is not positive"));
		}
		$this->applicationCohortCohortId = $newApplicationCohortCohortId;
	}

	/**
	 * @return array
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}
<?php

namespace Edu\Cnm\DdcAaaa;

/**
 * class applicationCohort for aaaa
 *
 * @version 1.0.0
 **/
class applicationCohort implements \JsonSerializable {



	/**
	 * applicationCohort constructor
	 *
	 * @throws \InvalidArgumentException
	 * @throws \RangeException
	 * @throws \TypeError
	 * @throws \Exception
	 **/
	public function __construct() {
		try {

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

	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}

}
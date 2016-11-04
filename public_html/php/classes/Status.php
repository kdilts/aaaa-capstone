<?php

namespace Edu\Cnm\DdcAaaa;

class Status {
	/**
	 * @var string $statusTypeName
	 */
	private $statusTypeName;
	/**
	 * @var int $statusTypeId
	 */
	private $statusTypeId;

	public function __construct(string $newStatusTypeName, int $newStatusTypeId) {
	try {
		$this->setStatusTypeId($newStatusTypeId);
		$this->statusTypeName($newStatusTypeName);
	} catch(\InvalidArgumentException $invalidArgumentException){
		throw(new \InvalidArgumentException($invalidArgumentException->getMessage(), 0, $invalidArgumentException));
	} catch(\RangeException $rangeException){
		throw(new \RangeException($rangeException->getMessage(), 0, $rangeException));
	} catch(\TypeError $typeError){
		throw(new \TypeError($typeError->getMessage(), 0, $typeError));
	} catch(\Exception $exception){
		throw(new \Exception($exception->getMessage(), 0, $exception));
	}

	}
	/**
	 * @return int
	 */
	public function getStatusTypeId(){
		return $this->statusTypeId;
	}
	/**
	 * @return string
	 */
	public function getStatusTypeName(){
	return $this->statusTypeName;
	}
	/**
 	* @param int $statusTypeId
 	*/
	public function setStatusTypeId(int $statusTypeId) {
		if($statusTypeId <= 0) {
			throw(new \RangeException("typeId can't be 0 or less."));
		}
	$this->statusTypeId = $statusTypeId;
	}
	/**
 	* @param int $statusTypeName
 	*/
	public function setStatusTypeName(string $statusTypeName) {
	$this->statusTypeName = $statusTypeName;
}
}

<?php

namespace Edu\Cnm\DdcAaaa;

class Swipe {

	/**
	 * @var int $swipeId
	 */
	private $swipeId;

	/**
	 * @var int $swipeNumber
	 */
	private $swipeNumber;

	/**
	 * @var int $swipeStatus
	 */
	private $swipeStatus;

	/**
	 * Swipe constructor.
	 * @param int $newSwipeId
	 * @param int $newSwipeNumber
	 * @param int $newSwipeStatus
	 * @throws \Exception
	 * @throws \TypeError
	 */
	public function __construct(int $newSwipeId, int $newSwipeNumber, int $newSwipeStatus){
		try {
			$this->setSwipeId($newSwipeId);
			$this->setSwipeNumber($newSwipeNumber);
			$this->setSwipeStatus($newSwipeStatus);
		}catch(\InvalidArgumentException $invalidArgumentException){
			// rethrow exception to the caller
			throw(new \InvalidArgumentException($invalidArgumentException->getMessage(),0,$invalidArgumentException));
		} catch(\RangeException $rangeException){
			// rethrow exception to the caller
			throw(new \RangeException($rangeException->getMessage(),0,$rangeException));
		} catch(\TypeError $typeError){
			// rethrow exception to the caller
			throw(new \TypeError($typeError->getMessage(),0,$typeError));
		} catch(\Exception $exception){
			// rethrow exception to the caller
			throw(new \Exception($exception->getMessage(),0,$exception));
		}
	}

	/**
	 * @return int
	 */
	public function getSwipeId(){
		return($this->swipeId);
	}

	/**
	 * @return int
	 */
	public function getSwipeNumber(){
		return($this->swipeNumber);
	}

	/**
	 * @return int
	 */
	public function getSwipeStatus(){
		return($this->swipeStatus);
	}

	/**
	 * @param int $newSwipeId
	 */
	public function setSwipeId(int $newSwipeId){
		// verify that newSwipeId is positive
		if($newSwipeId <= 0){
			throw(new \RangeException("swipe id is not positive"));
		}
		$this->swipeId = $newSwipeId;
	}

	/**
	 * @param int $newSwipeNumber
	 */
	public function setSwipeNumber(int $newSwipeNumber){
		// verify that newSwipeNumber is positive
		if($newSwipeNumber <= 0){
			throw(new \RangeException("swipe number is not positive"));
		}
		$this->swipeNumber = $newSwipeNumber;
	}

	/**
	 * @param int $newSwipeStatus
	 */
	public function setSwipeStatus(int $newSwipeStatus){
		// verify that newSwipeStatus is positive
		if($newSwipeStatus <= 0){
			throw(new \RangeException("swipe status is not positive"));
		}
		$this->swipeStatus = $newSwipeStatus;
	}
}
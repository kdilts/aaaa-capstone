<?php

namespace Edu\Cnm\aaaa\DataDesign;

class Swipe {

	private $swipeId;
	private $swipeNumber;
	private $swipeStatus;

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

	public function getSwipeId(){
		return($this->swipeId);
	}

	public function getSwipeNumber(){
		return($this->swipeNumber);
	}

	public function getSwipeStatus(){
		return($this->swipeStatus);
	}

	public function setSwipeId(int $newSwipeId){
		// verify that newSwipeId is positive
		if($newSwipeId <= 0){
			throw new \RangeException("swipe id is not positive");
		}
		$this->swipeId = $newSwipeId;
	}

	public function setSwipeNumber(int $newSwipeNumber){
		// verify that newSwipeNumber is positive
		if($newSwipeNumber <= 0){
			throw new \RangeException("swipe number is not positive");
		}
		$this->swipeNumber = $newSwipeNumber;
	}

	public function setSwipeStatus(int $newSwipeStatus){
		// verify that newSwipeStatus is positive
		if($newSwipeStatus <= 0){
			throw new \RangeException("swipe status is not positive");
		}
		$this->swipeStatus = $newSwipeStatus;
	}
}
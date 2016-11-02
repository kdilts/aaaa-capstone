<?php

namespace Edu\Cnm\aaaa\DataDesign;

class Swipe {

	private $swipeId;
	private $swipeNumber;
	private $swipeStatus;

	public function __construct(int $newSwipeId, int $newSwipeNumber, int $newSwipeStatus){
		$this->setSwipeId($newSwipeId);
		$this->setSwipeNumber($newSwipeNumber);
		$this->setSwipeStatus($newSwipeStatus);
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
		$this->swipeId = $newSwipeId;
	}

	public function setSwipeNumber(int $newSwipeNumber){
		$this->swipeNumber = $newSwipeNumber;
	}

	public function setSwipeStatus(int $newSwipeStatus){
		$this->swipeStatus = $newSwipeStatus;
	}
}
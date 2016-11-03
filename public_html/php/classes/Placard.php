<?php

class Placard {

	/**
	 * @var int $placardId
	 */
	private $placardId;

	/**
	 * @var int $placardStatus
	 */
	private $placardStatus;

	/**
	 * @var int $placardNumber
	 */
	private $placardNumber;

	/**
	 * Placard constructor.
	 * @param int $newPlacardId
	 * @param int $newPlacardStatus
	 * @param int $newPlacardNumber
	 * @throws Exception
	 * @throws TypeError
	 */
	public function __construct(int $newPlacardId, int $newPlacardStatus, int $newPlacardNumber) {
		try {
			$this->setPlacardId($newPlacardId);
			$this->setPlacardNumber($newPlacardNumber);
			$this->setPlacardStatus($newPlacardStatus);
			}catch(InvalidArgumentException $invalidArgument) {
				throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
			}catch(\RangeException $range) {
				throw(new \RangeException($range->getMessage(), 0, $range));
			}catch(\TypeError $typeError) {
				throw(new \TypeError($typeError->getMessage(), 0, $typeError));
			}catch(\Exception $exception) {
				throw(new \Exception($exception->getMessage(), 0, $exception));
		}

	}

	/**
	 * @return mixed
	 */
	public function getPlacardId() {
		return $this->placardId;
	}

	/**
	 * @return mixed
	 */
	public function getPlacardNumber() {
		return $this->placardNumber;
	}

	/**
	 * @return mixed
	 */
	public function getPlacardStatus() {
		return $this->placardStatus;
	}

	/**
	 * @param int $newPlacardId
	 */
	public function setPlacardId(int $newPlacardId) {
		//checks if PlacardId is negative
		if ($newPlacardId <= 0) {
			throw(new \RangeException("Placard ID cannot be negative."));
		}
		$this->placardId = $newPlacardId;
	}

	/**
	 * @param int $newPlacardNumber
	 */
	public function setPlacardNumber(int $newPlacardNumber) {
		if ($newPlacardNumber <= 0) {
			throw(new \RangeException("Placard Number cannot be negative."));
		}
		$this->placardNumber = $newPlacardNumber;
	}

	/**
	 * @param int $newPlacardStatus
	 */
	public function setPlacardStatus(int $newPlacardStatus) {
		if ($newPlacardStatus < 0) {
			throw(new \RangeException("Placard status invalid."));
		}
		$this->placardStatus = $newPlacardStatus;
	}
}

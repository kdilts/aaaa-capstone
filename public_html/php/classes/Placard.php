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
	 */

	public function __construct(int $newPlacardId, int $newPlacardStatus, int $newPlacardNumber) {
		try {
			$this->setPlacardId($newPlacardId);
			$this->setPlacardNumber($newPlacardNumber);
			$this->setPlacardStatus($newPlacardStatus);
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
	 * @param mixed $placardId
	 */
	public function setPlacardId(int $newPlacardId) {
		//checks if PlacardId is negative
		if (newPlacardId <= 0) {
			throw(new \RangeException("Placard ID cannot be negative."));
		}
		$this->placardId = $placardId;
	}

	/**
	 * @param mixed $placardNumber
	 */
	public function setPlacardNumber(int $newPlacardNumber) {
		if (newPlacardNumber <= 0) {
			throw(\RangeException("Placard Number cannot be negative."));
		}
		$this->placardNumber = $placardNumber;
	}

	/**
	 * @param mixed $placardStatus
	 */
	public function setPlacardStatus(int $newPlacardStatus) {
		if (newPlaca)
		$this->placardStatus = $placardStatus;
	}
}

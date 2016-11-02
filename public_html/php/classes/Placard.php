<?php

class Placard {
	private $placardId;
	private $placardStatus;
	private $placardNumber;


	public function __construct(int $placardId, int $placardStatus, int $placardNumber) {


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
	public function setPlacardId($placardId) {
		$this->placardId = $placardId;
	}

	/**
	 * @param mixed $placardNumber
	 */
	public function setPlacardNumber($placardNumber) {
		$this->placardNumber = $placardNumber;
	}

	/**
	 * @param mixed $placardStatus
	 */
	public function setPlacardStatus($placardStatus) {
		$this->placardStatus = $placardStatus;
	}
}

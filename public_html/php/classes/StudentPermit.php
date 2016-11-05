<?php
namespace Edu\Cnm\DdcAaaa;

class StudentPermit {
	use ValidateDate;

	/**
	 * @var int $studentPermitStudentId
	 */
	private $studentPermitStudentId;

	/**
	 * @var int $studentPermitPlacardId
	 */
	private $studentPermitPlacardId;

	/**
	 * @var int $studentPermitSwipeId
	 */
	private $studentPermitSwipeId;

	/**
	 * @var \DateTime $studentPermitCheckOutDate
	 */
	private $studentPermitCheckOutDate;

	/**
	 * @var \DateTime $studentPermitCheckInDate
	 */
	private $studentPermitCheckInDate;

	/**
	 * StudentPermit constructor.
	 * @param int $newStudentPermitStudentId
	 * @param int $newStudentPermitPlacardId
	 * @param int $newStudentPermitSwipeId
	 * @param \DateTime $newStudentPermitCheckOutDate
	 * @param \DateTime $newStudentPermitCheckInDate
	 * @throws \InvalidArgumentException
	 * @throws \RangeException
	 * @throws \TypeError
	 * @throws \Exception
	 */
	public function __construct(int $newStudentPermitStudentId, int $newStudentPermitPlacardId, int $newStudentPermitSwipeId, \DateTime $newStudentPermitCheckOutDate, \DateTime $newStudentPermitCheckInDate){
		try{
			$this->setStudentPermitStudentId($newStudentPermitStudentId);
			$this->setStudentPermitPlacardId($newStudentPermitPlacardId);
			$this->setStudentPermitSwipeId($newStudentPermitSwipeId);
			$this->setStudentPermitCheckInDate($newStudentPermitCheckInDate);
			$this->setStudentPermitCheckOutDate($newStudentPermitCheckOutDate);
		}catch(\InvalidArgumentException $invalidArgument) {
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
	 * @return int
	 */
	public function getStudentPermitStudentId(){
		return($this->studentPermitStudentId);
	}

	/**
	 * @return int
	 */
	public function getStudentPermitPlacardId(){
		return($this->studentPermitPlacardId);
	}

	/**
	 * @return int
	 */
	public function getStudentPermitSwipeId(){
		return($this->studentPermitSwipeId);
	}

	/**
	 * @return \DateTime
	 */
	public function getStudentPermitCheckOutDate(){
		return($this->studentPermitCheckOutDate);
	}

	/**
	 * @return \DateTime
	 */
	public function getStudentPermitCheckInDate(){
		return($this->studentPermitCheckInDate);
	}

	/**
	 * @param int $newStudentPermitStudentId
	 * @throws \RangeException
	 */
	public function setStudentPermitStudentId(int $newStudentPermitStudentId){
		if ($newStudentPermitStudentId <= 0) {
			throw(new \RangeException("Student Id cannot be negative."));
		}
		$this->studentPermitStudentId = $newStudentPermitStudentId;
	}

	/**
	 * @param int $newStudentPermitPlacardId
	 * @throws \RangeException
	 */
	public function setStudentPermitPlacardId(int $newStudentPermitPlacardId){
		if ($newStudentPermitPlacardId <= 0) {
			throw(new \RangeException("Placard Id cannot be negative."));
		}
		$this->studentPermitPlacardId = $newStudentPermitPlacardId;
	}

	/**
	 * @param int $newStudentPermitSwipeId
	 * @throws \RangeException
	 */
	public function setStudentPermitSwipeId(int $newStudentPermitSwipeId){
		if ($newStudentPermitSwipeId <= 0) {
			throw(new \RangeException("Swipe Id cannot be negative."));
		}
		$this->studentPermitSwipeId = $newStudentPermitSwipeId;
	}

	/**
	 * @param \DateTime $newStudentPermitCheckOutDate
	 * @throws \InvalidArgumentException
	 * @throws \RangeException
	 */
	public function setStudentPermitCheckOutDate(\DateTime $newStudentPermitCheckOutDate){
		try {
			$newStudentPermitCheckOutDate = self::validateDateTime($newStudentPermitCheckOutDate);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}

		$this->studentPermitCheckOutDate = $newStudentPermitCheckOutDate;
	}

	/**
	 * @param \DateTime $newStudentPermitCheckInDate
	 * @throws \InvalidArgumentException
	 * @throws \RangeException
	 */
	public function setStudentPermitCheckInDate(\DateTime $newStudentPermitCheckInDate){
		try {
			$newStudentPermitCheckInDate = self::validateDateTime($newStudentPermitCheckInDate);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->studentPermitCheckInDate = $newStudentPermitCheckInDate;
	}
}
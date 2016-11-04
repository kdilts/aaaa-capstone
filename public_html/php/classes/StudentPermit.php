<?php
namespace Edu\Cnm\DdcAaaa;

class StudentPermit {
	private $studentPermitStudentId;
	private $studentPermitPlacardId;
	private $studentPermitSwipeId;
	private $studentPermitCheckOutDate;
	private $studentPermitCheckInDate;

	public function __construct(int $newStudentPermitStudentId, int $newStudentPermitPlacardId, int $newStudentPermitSwipeId, \DateTime $newStudentPermitCheckOutDate, \DateTime $newStudentPermitCheckInDate){}

	public function getStudentPermitStudentId(){}
	public function getStudentPermitPlacardId(){}
	public function getStudentPermitSwipeId(){}
	public function getStudentPermitCheckOutDate(){}
	public function getStudentPermitCheckInDate(){}

	public function setStudentPermitStudentId(int $newStudentPermitStudentId){}
	public function setStudentPermitPlacardId(int $newStudentPermitPlacardId){}
	public function setStudentPermitSwipeId(int $newStudentPermitSwipeId){}
	public function setStudentPermitCheckOutDate(\DateTime $newStudentPermitCheckOutDate){}
	public function setStudentPermitCheckInDate(\DateTime $newStudentPermitCheckInDate){}
}
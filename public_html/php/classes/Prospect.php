<?php
namespace Edu\Cnm\DdcAaaa;

class Prospect {

	private $prospectId;
	private $prospectCohortId;
	private $prospectPhoneNumber;
	private $prospectEmail;
	private $prospectFirstName;
	private $prospectLastName;

	public function __construct(int $newProspectId, int $newProspectCohortId, string $newProspectPhoneNumber, string $newProspectEmail, string $newProspectFirstName, string $newProspectLastName){
		$this->setProspectId($newProspectId);
		$this->setProspectCohortId($newProspectCohortId);
		$this->setProspectPhoneNumber($newProspectPhoneNumber);
		$this->setProspectEmail($newProspectEmail);
		$this->setProspectFirstName($newProspectFirstName);
		$this->setProspectLastName($newProspectLastName);
	}

	public function getProspectId(){
		return($this->getProspectId());
	}

	public function getProspectCohortId(){
		return($this->getProspectCohortId());
	}

	public function getProspectPhoneNumber(){
		return($this->getProspectPhoneNumber());
	}

	public function getProspectEmail(){
		return($this->getProspectEmail());
	}

	public function getProspectFirstName(){
		return($this->getProspectFirstName());
	}

	public function getProspectLastName(){
		return($this->getProspectLastName());
	}

	public function setProspectId($newProspectId){
		$this->prospectId=$newProspectId;
	}

	public function setProspectCohortId($newProspectCohortId){
		$this->prospectCohortId=$newProspectCohortId;
	}

	public function setProspectPhoneNumber($newProspectPhoneNumber){
		$this->prospectPhoneNumber=$newProspectPhoneNumber;
	}

	public function setProspectEmail($newProspectEmail){
		$this->prospectEmail=$newProspectEmail;
	}

	public function setProspectFirstName($newProspectFirstName){
		$this->prospectFirstName=$newProspectFirstName;
	}

	public function setProspectLastName($newProspectLastName){
		$this->prospectLastName=$newProspectLastName;
	}
}
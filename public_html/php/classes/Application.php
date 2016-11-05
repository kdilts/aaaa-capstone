<?php
namespace Edu\Cnm\jwood47\aaaacapstone;

require_once ("autoload.php");

/**
 * class Application for aaaa
 *
 * @version 1.0.0
 **/

class application {
	/**
	 * @var int $applicationId
	 */
	private $applicationId;
	/**
	 * @var int $applicationFirstName
	 */
	private $applicationFirstName;
	/**
	 * @var int $applicationLastName
	 */
	private $applicationLastName;
	/**
	 * @var int $applicationEmail
	 */
	private $applicationEmail;
	/**
	 * @var int $applicationPhoneNumber
	 */
	private $applicationPhoneNumber;
	/**
	 * @var string $applicationSource
	 */
	private $applicationSource;
	/**
	 * @var string $applicationCohortId
	 */
	private $applicationCohortId;
	/**
	 * @var string $applicationAboutYou
	 */
	private $applicationAboutYou;
	/**
	 * @var string $applicationHopeToAccomplish
	 */
	private $applicationHopeToAccomplish;
	/**
	 * @var string $applicationExperience
	 */
	private $applicationExperience;
	/**
	 * @var string $applicationDateTime
	 */
	private $applicationDateTime;
	/**
	 * @var string $applicationUtmCampaign
	 */
	private $applicationUtmCampaign;
	/**
	 * @var string $applicationUtmMedium
	 */
	private $applicationUtmMedium;
	/**
	 * @var string $applicationUtmSource
	 */
	private $applicationUtmSource;

	/**
	 * @return int| null value of applicationId
	 */
	public function getApplicationId() {
		return $this->applicationId;
	}

	/**
	 * @return int
	 */
	public function getApplicationFirstName() {
		return $this->applicationFirstName;
	}

	/**
	 * @return int
	 */
	public function getApplicationLastName() {
		return $this->applicationLastName;
	}

	/**
	 * @return int
	 */
	public function getApplicationEmail() {
		return $this->applicationEmail;
	}

	/**
	 * @return int
	 */
	public function getApplicationPhoneNumber() {
		return $this->applicationPhoneNumber;
	}

	/**
	 * @return string
	 */
	public function getApplicationSource() {
		return $this->applicationSource;
	}

	/**
	 * @return string
	 */
	public function getApplicationCohortId() {
		return $this->applicationCohortId;
	}

	/**
	 * @return string
	 */
	public function getApplicationAboutYou() {
		return $this->applicationAboutYou;
	}

	/**
	 * @return string
	 */
	public function getApplicationHopeToAccomplish() {
		return $this->applicationHopeToAccomplish;
	}

	/**
	 * @return string
	 */
	public function getApplicationExperience() {
		return $this->applicationExperience;
	}

	/**
	 * @return string
	 */
	public function getApplicationDateTime() {
		return $this->applicationDateTime;
	}
	/**
	 * @param int $newApplicationId
	 * @throws \RangeException
	 **/
	public function setApplicationId(int $applicationId) {
		$this->applicationId = $applicationId;
		//check if applicationId is negitive
		if($newApplicationId <= 0) {
			throw(new \RangeException("Application Id cannot be negative."));
			$this->applicationId = $newApplicationId;
		}
	}
	/**
	 * @param int $newApplicatonFirstName
	 * @throws \RangeException
	 **/
	public function setApplicationFirstName($applicationFirstName){
		$this->applicationFirstName = $applicationFirstName;
		if ($newApplicationFirstName)

		}
}



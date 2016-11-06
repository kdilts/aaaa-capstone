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
	 * @var string $applicationFirstName
	 */
	private $applicationFirstName;
	/**
	 * @var string $applicationLastName
	 */
	private $applicationLastName;
	/**
	 * @var string $applicationEmail
	 */
	private $applicationEmail;
	/**
	 * @var string $applicationPhoneNumber
	 */
	private $applicationPhoneNumber;
	/**
	 * @var string $applicationSource
	 */
	private $applicationSource;
	/**
	 * @var int $applicationCohortId
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
	 * @var \DateTime $applicationDateTime
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
	 * @return string
	 */
	public function getApplicationFirstName() {
		return $this->applicationFirstName;
	}

	/**
	 * @return string
	 */
	public function getApplicationLastName() {
		return $this->applicationLastName;
	}

	/**
	 * @return string
	 */
	public function getApplicationEmail() {
		return $this->applicationEmail;
	}

	/**
	 * @return string
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
	 * @return int
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
	public function setApplicationId(int $newApplicationId) {
		$this->applicationId = $newApplicationId;
		//check if applicationId is negative
		$newApplicationId = trim ($newApplicationId);
		$newApplicationId = filter_var($newApplicationId, FILTER_FLAG_NO_ENCODE_QUOTES, FILTER_FLAG_NO_ENCODE_QUOTES);
		if($newApplicationId <= 0) {
			throw(new \RangeException("Application Id cannot be negative."));
		}
		$this->applicationId = $newApplicationId;
	}
	/**
	 * @param string $newApplicationFirstName
	 * @throws \RangeException
	 **/
	public function setApplicationFirstName($newApplicationFirstName) {
		$this->applicationFirstName = $newApplicationFirstName;
		// verify first name is secure
		$newApplicationFirstName = trim($newApplicationFirstName);
		$newApplicationFirstName = filter_var($newApplicationFirstName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newApplicationFirstName) === true) {
			throw(new \InvalidArgumentException("Application first name is empty or insecure"));
		}
		$this->applicationFirstName = $newApplicationFirstName;
	}

	/**
	 * @param string $newApplicationLastName
	 */
	public function setApplicationLastName(string $newApplicationLastName) {
		$this->applicationLastName = $newApplicationLastName;
		//verify last name is secure
		$newApplicationLastName = trim($newApplicationLastName);
		$newApplicationLastName = filter_var($newApplicationLastName, FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty ($newApplicationLastName) === true){
			throw(new \InvalidArgumentException("Application first name is empty or insecure");
		}
		$this->applicationLastName = $newApplicationLastName;
	}
	/**
	 * @param string $newApplicationEmail
	 * @throws \RangeException
	 */
	public function setApplicationEmail(string $newApplicationEmail) {
		$this->applicationEmail = $newApplicationEmail;
		$newApplicationEmail = trim($newApplicationEmail);
		$newApplicationEmail = filter_var($newApplicationEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty ($newApplicationEmail) === true){
			throw (new \InvalidArgumentException("Application email is empty or secure"));
		}
		//verify email will fit in the database
		if(strlen($newApplicationEmail) > 30) {
			throw(new \RangeException("application Email is to large"));
		}
		//store email
		$this->applicationEmail=$newApplicationEmail;
	}

	/**
	 * @param string $newApplicationPhoneNumber
	 */
	public function setApplicationPhoneNumber(string $newApplicationPhoneNumber) {
		$this->applicationPhoneNumber = $newApplicationPhoneNumber;
		$newApplicationPhoneNumber = trim($newApplicationPhoneNumber);
		$newApplicationPhoneNumber = filter_var($newApplicationPhoneNumber, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty ($newApplicationPhoneNumber) === true){
			throw (new \InvalidArgumentException("Application phone number is empty or secure"));
		}
		//verify phone number will fit in the database
		if(strlen($newApplicationPhoneNumber) >100);
		throw (new \RangeException("application phone number is to large"));
	}
	//store phone number
$this->applicationPhoneNumber=$newApplicationPhoneNumber;
}

/**
 * @param string $newApplicationSource
 */
public function setApplicationSource (string $newApplicationSource){
	$this->applicationSource = $newApplicationSource;
	$newApplicationSource = trime($newApplicationSource);
	$newApplicationSource = filter_var($newApplicationSource, FILTER_SANITIZE_STRING,
FILTER_FLAG_NO_ENCODE_QUOTES);
	if(empty ($newApplicationSource) === true){
		throw (new \InvalidArgumentException("Application Source is empty or secure"));
	}
	//verify source will fit in the database
	if(strlen($newApplicationSource) >1000);
	throw (new \RangeException("Application source is to large"));
}
//store the source
$this->applicationSource=$newApplicationSource;
}


/**
 * @param string $newApplicationCohortId
 */
public function setApplicationCohortId (string $newApplicationCohortId){
	$this->applicationCohortId = $newApplicationCohortId;
	$this->applicationCohortId = trim ($newApplicationCohortId);
	$this->applicationCohortId = filter_var($newApplicationCohortId, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if (empty ($newApplicationCohortId) === true){
		throw (new \InvalidArgumentException("Application Cohort Id is empty or secure"));
	}
	//verify source will fit in the database
	if (strlen ($newApplicationCohortId) >20);
	throw (new \RangeException("Application Cohort Id is to large"));
//store the Application Cohort Id
$this->applicationCohortId=$newApplicationCohortId;
}

public function setApplicationAboutYou (string $newApplicationAboutYou){
	$this->applicationAboutYou = $newApplicationAboutYou;
	$this->applicationAboutYou = trim ($newApplicationAboutYou);
	$this->applicationAboutYou = filter($newApplicationAboutYou, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if (empty ($newApplicationAboutYou)=== true){
		throw (new \InvalidArgumentException("application About You is empty or secure"));
	}
	//verify source will fit in the database
	if (strlen($newApplicationAboutYou) >1000);
	throw (new \RangeException("application About You is to large"));
//store the Application About You te
	$this->applicationAboutYou=$newApplicationAboutYou;
}
<?php
namespace Edu\Cnm\aaaacapstone;

use Edu\Cnm\DdcAaaa\ValidateDate;

require_once ("autoload.php");

/**
 * class  Application for aaaa
 *
 * @version 1.0.0
 **/

class application {
	use ValidateDate;
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
	 *
	 * application constructor.
	 * @param int|null $newApplicationId
	 * @param string $newApplicationFirstName
	 * @param string $newApplicationLastName
	 * @param string $newApplicationEmail
	 * @param string $newApplicationPhoneNumber
	 * @param string $newApplicationSource
	 * @param int $newApplicationCohortId
	 * @param string $newApplicationAboutYou
	 * @param string $newApplicationHopeToAccomplish
	 * @param string $newApplicationExperience
	 * @param string $newApplicationDateTime
	 * @param string $newApplicationUtmCampaign
	 * @param string $newApplicationUtmMedium
	 * @param string $newApplicationUtmSource
	 * @throws \Exception
	 * @throws \TypeError
	 */
	public function __construct(int $newApplicationId = null, string $newApplicationFirstName, string $newApplicationLastName, string $newApplicationEmail, string $newApplicationPhoneNumber, string $newApplicationSource, int $newApplicationCohortId, string $newApplicationAboutYou, string $newApplicationHopeToAccomplish, string $newApplicationExperience, string $newApplicationDateTime, string $newApplicationUtmCampaign, string $newApplicationUtmMedium, string $newApplicationUtmSource){
		try {
			$this->setApplicationId($newApplicationId);
			$this->setApplicationFirstName($newApplicationFirstName);
			$this->setApplicationLastName($newApplicationLastName);
			$this->setApplicationEmail($newApplicationEmail);
			$this->setApplicationPhoneNumber($newApplicationPhoneNumber);
			$this->setApplicationSource($newApplicationSource);
			$this->setApplicationCohortId($newApplicationCohortId);
			$this->setApplicationAboutYou($newApplicationAboutYou);
			$this->setApplicationHopeToAccomplish($newApplicationHopeToAccomplish);
			$this->setApplicationExperience($newApplicationExperience);
			$this->setApplicationDateTime($newApplicationDateTime);
			$this->setApplicationUtmCampaign($newApplicationUtmCampaign);
			$this->setApplicationUtmMedium($newApplicationUtmMedium);
			$this->setApplicationUtmSource($newApplicationUtmSource);
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
	 * @return string
	 */
	public function getApplicationUtmCampaign(): string {
		return $this->applicationUtmCampaign;
	}

	/**
	 * @return string
	 */
	public function getApplicationUtmMedium(): string {
		return $this->applicationUtmMedium;
	}

	/**
	 * @return string
	 */
	public function getApplicationUtmSource(): string {
		return $this->applicationUtmSource;
	}
	/**
	 * @param int $newApplicationId
	 * @throws \RangeException
	 **/
	public function setApplicationId(int $newApplicationId) {
		//check if applicationId is negative
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
		//verify last name is secure
		$newApplicationLastName = trim($newApplicationLastName);
		$newApplicationLastName = filter_var($newApplicationLastName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty ($newApplicationLastName) === true) {
			throw(new \InvalidArgumentException("Application last name is empty or insecure"));
		}
		$this->applicationLastName = $newApplicationLastName;
	}

	/**
	 * @param string $newApplicationEmail
	 * @throws \RangeException
	 */
	public function setApplicationEmail(string $newApplicationEmail) {
		$newApplicationEmail = trim($newApplicationEmail);
		$newApplicationEmail = filter_var($newApplicationEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty ($newApplicationEmail) === true) {
			throw (new \InvalidArgumentException("Application email is empty or secure"));
		}
		//verify email will fit in the database
		if(strlen($newApplicationEmail) > 30) {
			throw(new \RangeException("application Email is to large"));
		}
		//store email
		$this->applicationEmail = $newApplicationEmail;
	}

	/**
	 * @param string $newApplicationPhoneNumber
	 */
	public function setApplicationPhoneNumber(string $newApplicationPhoneNumber) {
		$newApplicationPhoneNumber = trim($newApplicationPhoneNumber);
		$newApplicationPhoneNumber = filter_var($newApplicationPhoneNumber, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty ($newApplicationPhoneNumber) === true) {
			throw (new \InvalidArgumentException("Application phone number is empty or secure"));
		}
		//verify phone number will fit in the database
		if(strlen($newApplicationPhoneNumber) > 100) {
			throw (new \RangeException("application phone number is to large"));
		}
		//store phone number
		$this->applicationPhoneNumber = $newApplicationPhoneNumber;
	}

	/**
	 * @param string $newApplicationSource
	 */
	public function setApplicationSource(string $newApplicationSource) {
		$newApplicationSource = trim ($newApplicationSource);
		$newApplicationSource = filter_var($newApplicationSource, FILTER_SANITIZE_STRING,
			FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty ($newApplicationSource) === true) {
			throw (new \InvalidArgumentException("Application Source is empty or secure"));
		}
		//verify source will fit in the database
		if(strlen($newApplicationSource) > 1000) {
			throw (new \RangeException("Application source is to large"));
		}
//store the source
		$this->applicationSource = $newApplicationSource;
	}

	/**
	 * @param string $newApplicationCohortId
	 */
	public function setApplicationCohortId(string $newApplicationCohortId) {
		$this->applicationCohortId = trim($newApplicationCohortId);
		$this->applicationCohortId = filter_var($newApplicationCohortId, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty ($newApplicationCohortId) === true) {
			throw (new \InvalidArgumentException("Application Cohort Id is empty or secure"));
		}
		//verify source will fit in the database
		if(strlen($newApplicationCohortId) > 20) {
			throw (new \RangeException("Application Cohort Id is to large"));
		}
		//store the Application Cohort Id
		$this->applicationCohortId = $newApplicationCohortId;
	}

	public function setApplicationAboutYou(string $newApplicationAboutYou) {
		//$this->applicationAboutYou = trim ($newApplicationAboutYou);
		$this->applicationAboutYou = filter_var($newApplicationAboutYou, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty ($newApplicationAboutYou) === true) {
			throw (new \InvalidArgumentException("application About You is empty or secure"));
		}
		//verify source will fit in the database
		if(strlen($newApplicationAboutYou) > 1000){
			throw (new \RangeException("application About You is to large"));
		}
//store the Application About You
		$this->applicationAboutYou = $newApplicationAboutYou;
	}

	/**
	 * @param string $newApplicationHopeToAccomplish
	 */
	public function setApplicationHopeToAccomplish(string $newApplicationHopeToAccomplish) {
		$this->applicationHopeToAccomplish = trim($newApplicationHopeToAccomplish);
		$this->applicationHopeToAccomplish = filter_var($newApplicationHopeToAccomplish, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty ($newApplicationHopeToAccomplish) === true) {
			throw (new\InvalidArgumentException("application Hope to Accomplish is empty or secure"));
		}
//verify source will fit in the datanase
		if(strlen($newApplicationHopeToAccomplish) > 2000) {
			throw (new \RangeException("application Hope to Accomplish is to large"));
		}
//store the Application Hope To Accomplish
		$this->applicationHopeToAccomplish = $newApplicationHopeToAccomplish;
	}

	/**
	 * @param string $ApplicationExperience
	 */
	public function setApplicationExperience(string $newApplicationExperience) {
		$this->applicationExperience = trim($newApplicationExperience);
		$this->applicationExperience = filter_var($newApplicationExperience, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty ($newApplicationExperience) === true) {
			throw (new\InvalidArgumentException("application Experience is empty or secure"));
		}
//verify applcation experience will fir in the database
		if(strlen($newApplicationExperience) > 2000) {
			throw (new \RangeException("application experience is to large"));
		}
// store the Application Experience
		$this->applicationExperience = $newApplicationExperience;
	}

	/**
	 * @param string $newApplicationDateTime
	 * @throws \InvalidArgumentException if $newApplicationDateTime is not a valid object or string
	 * @throws \RangeException if $newApplicationDateTime is a date that does not exist
	 */
	public function setApplicationDateTime(\DateTime $newApplicationDateTime) {
		try {
			$newApplicationDateTime = self::validateDateTime($newApplicationDateTime);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}

		$this->applicationDateTime = $newApplicationDateTime;

	}

	/**
	 * @param string $newApplicationUtmCampaign
	 */
	public function setApplicationUtmCampaign(string $newApplicationUtmCampaign) {
		$this->applicationUtmCampaign = trim($newApplicationUtmCampaign);
		$this->applicationUtmCampaign = filter_var($newApplicationUtmCampaign, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if (empty($newApplicationUtmCampaign)=== true) {
			throw (new\InvalidArgumentException("application UTM Campaign is an empty or secure"));
		}
		//verify application experience will fit in the database
		if (strlen($newApplicationUtmCampaign)>200){
			throw (new\RangeException("application UTM Campaign is to large"));
		}
		//store the application UTM Campaign
		$this->applicationUtmCampaign = $newApplicationUtmCampaign;
	}
	/**
	 * @param string $newApplicationUtmMedium
	 */
	public function setApplicationUtmMedium(string $newApplicationUtmMedium) {
		$this->applicationUtmMedium = trim($newApplicationUtmMedium);
		$this->applicationUtmMedium = filter_var($newApplicationUtmMedium, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if (empty($newApplicationUtmMedium)=== true){
			throw (new\InvalidArgumentException("application UTM Medium is an empty or secure"));
		}
		//verify application UTM Medium will fit in the database
		if (strlen($newApplicationUtmMedium)>200){
			throw (new\RangeException("application UTM Medium is to large"));
		}
		//store the application UTM Medium
		$this->applicationUtmMedium = $newApplicationUtmMedium;
	}

	/**
	 * @param string $applicationUtmSource
	 */
	public function setApplicationUtmSource(string $newApplicationUtmSource) {
		$this->applicationUtmSource = trim($newApplicationUtmSource);
		$this->applicationUtmSource = filter_var($newApplicationUtmSource, FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
		if (empty($newApplicationSource)=== true){
			throw (new\InvalidArgumentException("application UTM Source is an empty or secure"));
		}
		//verify application UTM Source
		if (strlen($newApplicationUtmSource)>200){
			throw (new\RangeException("application UTM Source is to large"));
		}
		$this->applicationUtmSource = $newApplicationUtmSource;

	}

	/**
	 * @param \PDO $pdo
	 * @throws \PDOException
	 */
	public function update(\PDO $pdo) {
		// enforce the application ID is not null (i.e., don't update a application ID that hasn't been inserted)
		if($this->applicationId === null) {
			throw(new \PDOException("unable to update a applicationID that does not exist"));
		}

		//create query template
		$query= "UPDATE application SET applicationId = :applicationId, applicationFirstName = :applicationFirstName, applicationLastName = :applicationLastName, applicationEmail = :applicationEmail, applicationPhoneNumber = :applicationPhoneNumber, applicationSource = :applicationSource, applicationCohortId = :applicationCohortId, applicationAboutYou = :applicationAboutYou, applicationHopeToAccomplish = :applicationHopeToAccomplish, applicationExperience = :applicationExperience, applicationDateTime = :applicationDateTime, applicationUtmCampaign = :applicationUtmCampaign, applicationUtmMedium = :applicationUtmMedium, applicationUtmSource = :applicationUtmSource WHERE applicationId =:applicationId";
		$statement = $pdo->prepare($query);

		//bind the members variable to the place holder in the template
		$parameters = [
			"applicationId" => $this->applicationId,
			"applicationFirstName" => $this->applicationFirstName,
			"applicationLastName" => $this->applicationLastName,
			"applicationEmail" => $this->applicationEmail,
			"applicationPhoneNumber" => $this->applicationPhoneNumber,
			"applicationSource" => $this->applicationSource,
			"applicationCohortId" => $this->applicationCohortId,
			"applicationAboutYou" => $this->applicationAboutYou,
			"applicationHopeToAccomplish" => $this->applicationHopeToAccomplish,
			"applicationExperience" => $this->applicationExperience,
			"applicationDateTime" => $this->applicationDateTime,
			"applicationUtmCampaign" => $this->applicationUtmCampaign,
			"applicationUtmMedium" => $this->applicationUtmMedium,
			"applicaitonUtmSource" => $this->applicationUtmSource,
		];
		$statement->execute($parameters);
	}
	/**
	 * @param \PDO $pdo
	 * @throws \PDOException
	 */
	public function insert(\PDO $pdo) {
		// enforce the application ID is not null (i.e., don't update a application ID that hasn't been inserted)
		if($this->applicationId === null) {
			throw(new \PDOException("unable to update a applicationID that does not exist"));
		}
		//create query template
		$query="INSERT INTO application (applicationId, applicationFirstName, applicationLastName, applicationEmail, applicationPhoneNumber, applicationSource, applicationCohortId, applicationAboutYou, applicationHopeToAccomplish, applicationExperience, applicationDateTime, applicationUtmCampaign, applicationUtmMedium, applicationUtmSource) VALUE(:applicationId, :applicationFirstName, :applicationLastName, :applicationEmail, :applicationPhoneNumber, :applicationSource, :applicationCohortId, :applicationAboutYou, :applicationHopeToAccomplish, :applicationExperience, :applicationDateTime, :applicationUtmCompaign, :applicationUtmMedium, :applicationUtmSource)";
		$statement = $pdo->prepare($query);

		//bind the members variable to the place holder in the template
		$parameters = [
			"applicationId" => $this->applicationId,
			"applicationFirstName" => $this->applicationFirstName,
			"applicationLastName" => $this->applicationLastName,
			"applicationEmail" => $this->applicationEmail,
			"applicationPhoneNumber" => $this->applicationPhoneNumber,
			"applicationSource" => $this->applicationSource,
			"applicationCohortId" => $this->applicationCohortId,
			"applicationAboutYou" => $this->applicationAboutYou,
			"applicationHopeToAccomplish" => $this->applicationHopeToAccomplish,
			"applicationExperience" => $this->applicationExperience,
			"applicationDateTime" => $this->applicationDateTime,
			"applicationUtmCampaign" => $this->applicationUtmCampaign,
			"applicationUtmMedium" => $this->applicationUtmMedium,
			"applicaitonUtmSource" => $this->applicationUtmSource,
		];
		$statement->execute($parameters);

		// update the null applicationId with what mySQL just gave us
		$this->applicationId = intval($pdo->lastInsertId());
	}
}


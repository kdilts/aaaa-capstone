<?php
namespace Edu\Cnm\DdcAaaa;

use Edu\Cnm\DdcAaaa\ValidateDate;

require_once ("autoload.php");

/**
 * class  Application for aaaa
 *
 * @version 1.0.0
 **/

class Application {
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
	 * @param \DateTime $newApplicationDateTime
	 * @param string $newApplicationUtmCampaign
	 * @param string $newApplicationUtmMedium
	 * @param string $newApplicationUtmSource
	 * @throws \Exception
	 * @throws \TypeError
	 */
	public function __construct(int $newApplicationId = null, string $newApplicationFirstName, string $newApplicationLastName, string $newApplicationEmail, string $newApplicationPhoneNumber, string $newApplicationSource, int $newApplicationCohortId, string $newApplicationAboutYou, string $newApplicationHopeToAccomplish, string $newApplicationExperience, \DateTime $newApplicationDateTime, string $newApplicationUtmCampaign, string $newApplicationUtmMedium, string $newApplicationUtmSource){
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
	 * accessor method for Id
	 * @return int| null value of applicationId
	 */
	public function getApplicationId() {
		return $this->applicationId;
	}

	/**
	 * accessor method for FirstName
	 * @return string
	 */
	public function getApplicationFirstName() {
		return $this->applicationFirstName;
	}

	/**
	 * accessor method for LastName
	 * @return string
	 */
	public function getApplicationLastName() {
		return $this->applicationLastName;
	}

	/**
	 * accessor method for Email
	 * @return string
	 */
	public function getApplicationEmail() {
		return $this->applicationEmail;
	}

	/**
	 * accessor method for PhoneNumber
	 * @return string
	 */
	public function getApplicationPhoneNumber() {
		return $this->applicationPhoneNumber;
	}

	/**
	 * accessor method for Source
	 * @return string
	 */
	public function getApplicationSource() {
		return $this->applicationSource;
	}

	/**
	 * accessor method for CohortId
	 * @return int
	 */
	public function getApplicationCohortId() {
		return $this->applicationCohortId;
	}

	/**
	 * accessor method for AboutYou
	 * @return string
	 */
	public function getApplicationAboutYou() {
		return $this->applicationAboutYou;
	}

	/**
	 * accessor method for HopeToAccomplish
	 * @return string
	 */
	public function getApplicationHopeToAccomplish() {
		return $this->applicationHopeToAccomplish;
	}

	/**
	 * accessor method for Experience
	 * @return string
	 */
	public function getApplicationExperience() {
		return $this->applicationExperience;
	}

	/**
	 * accessor method for DateTime
	 * @return string
	 */
	public function getApplicationDateTime() {
		return $this->applicationDateTime;
	}
	/**
	 * accessor method for UtmCampaign
	 * @return string
	 */
	public function getApplicationUtmCampaign(){
		return $this->applicationUtmCampaign;
	}

	/**
	 * accessor method for UtmMedium
	 * @return string
	 */
	public function getApplicationUtmMedium(){
		return $this->applicationUtmMedium;
	}

	/**
	 * accessor method for UtmSource
	 * @return string
	 */
	public function getApplicationUtmSource() {
		return $this->applicationUtmSource;
	}
	/**
	 * mutator method for applicationId
	 * @param int $newApplicationId
	 * @throws \RangeException
	 **/
	public function setApplicationId(int $newApplicationId = null) {
		if($newApplicationId === null){
			$this->applicationId = null;
			return;
		}

		//check if applicationId is negative
		if($newApplicationId <= 0) {
			throw(new \RangeException("Application Id cannot be negative."));
		}
		$this->applicationId = $newApplicationId;
	}

	/**
	 * mutator method for applicationFirstName
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
	 * mutator method for applicationLastName
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
	 * mutator method for applicationEmail
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
	 * mutator method for applicationPhoneNumber
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
	 * mutator method for applicationSource
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
	 * mutator method for applicationCohortId
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

	/**
	 * mutator method for applicationAboutYou
	 * @param string $newApplicationAboutYou
	 */
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
	 * mutator method for applicationHopeToAccomplish
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
	 * mutator method for applicationExperience
	 *
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
	 * mutator method for applicationDateTime
	 * @param \DateTime $newApplicationDateTime
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
	 * mutator method for ApplicationUtmCampaign
	 * @param string $newApplicationUtmCampaign
	 */
	public function setApplicationUtmCampaign(string $newApplicationUtmCampaign) {
		$this->applicationUtmCampaign = trim($newApplicationUtmCampaign);
		$this->applicationUtmCampaign = filter_var($newApplicationUtmCampaign, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if (empty($newApplicationUtmCampaign)=== true) {
			throw (new\InvalidArgumentException("application UTM Campaign is an empty or secure"));
		}
		//verify application experience will fit in the database
		if (strlen($newApplicationUtmCampaign)>500){
			throw (new\RangeException("application UTM Campaign is to large"));
		}
		//store the application UTM Campaign
		$this->applicationUtmCampaign = $newApplicationUtmCampaign;
	}
	/**
	 * mutator method for ApplicationUtmMedium
	 *
	 * @param string $newApplicationUtmMedium
	 */
	public function setApplicationUtmMedium(string $newApplicationUtmMedium) {
		$this->applicationUtmMedium = trim($newApplicationUtmMedium);
		$this->applicationUtmMedium = filter_var($newApplicationUtmMedium, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if (empty($newApplicationUtmMedium)=== true){
			throw (new\InvalidArgumentException("application UTM Medium is an empty or secure"));
		}
		//verify application UTM Medium will fit in the database
		if (strlen($newApplicationUtmMedium)>500){
			throw (new\RangeException("application UTM Medium is to large"));
		}
		//store the application UTM Medium
		$this->applicationUtmMedium = $newApplicationUtmMedium;
	}


	/**
	 * mutator method for applicationUtmSource
	 *
	 * @param string $applicationUtmSource
	 */
	public function setApplicationUtmSource(string $newApplicationUtmSource) {
		$this->applicationUtmSource = trim($newApplicationUtmSource);
		$this->applicationUtmSource = filter_var($newApplicationUtmSource, FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
		if (empty($newApplicationSource)=== true){
			throw (new\InvalidArgumentException("application UTM Source is an empty or secure"));
		}
		//verify application UTM Source
		if (strlen($newApplicationUtmSource)>500){
			throw (new\RangeException("application UTM Source is to large"));
		}
		$this->applicationUtmSource = $newApplicationUtmSource;

	}
	/**
	 * inserts application into SQL database
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
		$this->applicationDateTime = $this->applicationDateTime->format("Y-m-d H:i:s");
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

	/**
	 * searches applications by applicationDateTime
	 * @param \PDO $pdo
	 * @param $startDate
	 * @return \SplFixedArray
	 */
	public static function getApplicationsByApplicationDateTime(\PDO $pdo, $startDate){
		// validate dates
		try {
			$startDate = self::validateDateTime($startDate);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		// format dates
		$startDate = $startDate->format("Y-m-d H:i:s");

		// create query template
		$query = "SELECT applicationId, applicationFirstName, applicationLastName, applicationEmail, applicationPhoneNumber, applicationSource, applicationCohortId, applicationAboutYou, applicationHopeToAccomplish, applicationExperience, applicationDateTime, applicationUtmCampaign, applicationUtmMedium, applicationUtmSource FROM application WHERE applicationDateTime = :startDate";
		$statement = $pdo->prepare($query);

		// bind the placard id to the place holder in template
		$parameters = ["$startDate" => $startDate];
		$statement->execute($parameters);

		// build an array of applications
		$applications = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$application = new application(
					$row["applicationId"],
					$row["applicationFirstName"],
					$row["applicationLastName"],
					$row["applicationEmail"],
					$row["applicationPhoneNumber"],
					$row["applicationSource"],
					$row["applicationCohortId"],
					$row["applicationAboutYou"],
					$row["applicationHopeToAccomplish"],
					$row["applicationExperience"],
					$row["applicationDateTime"],
					$row["applicationUtmCampaign"],
					$row["applicationUtmMedium"],
					$row["applicationUtmSource"]
				);
				$applications[$applications->key()] = $application;
				$applications->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($applications);
	}

	/**
	 * searches applications by applicationEmail
	 * @param \PDO $pdo
	 * @param string $applicationEmail
	 * @return Application|null
	 */
	public function getApplicationByApplicationEmail (\PDO $pdo, string $applicationEmail){
		//sanitize the applicationCohortId before searching
		$applicationEmail = trim($applicationEmail);
		$applicationEmail = filter_var($applicationEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($applicationEmail) === null) {
			throw(new \PDOException("application email empty or insecure"));
		}

		//create query template
		$query = "SELECT applicationId, applicationFirstName, applicationLastName, applicationEmail, applicationPhoneNumber, applicationSource, applicationCohortId, applicationAboutYou, applicationHopeToAccomplish, applicationExperience, applicationDateTime, applicationUtmCampaign, applicationUtmMedium, applicationUtmSource FROM application WHERE applicationEmail = :applicationEmail";
		$statement = $pdo->prepare($query);

		//grab placard from SQL
		try {
			$application = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$application = new Application(
					$row["applicationId"],
					$row["applicationFirstName"],
					$row["applicationLastName"],
					$row["applicationEmail"],
					$row["applicationPhoneNumber"],
					$row["applicationSource"],
					$row["applicationCohortId"],
					$row["applicationAboutYou"],
					$row["applicationHopeToAccomplish"],
					$row["applicationExperience"],
					$row["applicationDateTime"],
					$row["applicationUtmCampaign"],
					$row["applicationUtmMedium"],
					$row["applicationUtmSource"]);
			}
		} catch(\Exception $exception){
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($application);
	}

	/**
	 * searches applications by applicationId
	 * @param \PDO $pdo
	 * @param int $applicationID
	 * @return Application
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public function getApplicationByApplicationId (\PDO $pdo, int $applicationId){
		//sanitize the applicationId before searching
		if ($applicationId <=0){
			throw(new \PDOException("applicationId not positive"));
		}
		//create query template
		$query = "SELECT applicationId, applicationFirstName, applicationLastName, applicationEmail, applicationPhoneNumber, applicationSource, applicationCohortId, applicationAboutYou, applicationHopeToAccomplish, applicationExperience, applicationDateTime, applicationUtmCampaign, applicationUtmMedium, applicationUtmSource FROM application WHERE applicationId = :applicationId";
		$statement = $pdo->prepare($query);

		//grab placard from SQL
		try {
			$application = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$application = new Application(
					$row["applicationId"],
					$row["applicationFirstName"],
					$row["applicationLastName"],
					$row["applicationEmail"],
					$row["applicationPhoneNumber"],
					$row["applicationSource"],
					$row["applicationCohortId"],
					$row["applicationAboutYou"],
					$row["applicationHopeToAccomplish"],
					$row["applicationExperience"],
					$row["applicationDateTime"],
					$row["applicationUtmCampaign"],
					$row["applicationUtmMedium"],
					$row["applicationUtmSource"]
				);
			}

		} catch(\Exception $exception){
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($application);
	}

	/**
	 * get applications by fuzzy name search - takes a string and matches against both first and last names
	 * @param \PDO $pdo pdo object
	 * @param string $applicationName string to search for
	 * @return \SplFixedArray array of applications found
	 * @throws \PDOException if there is an sql error
	 * @throws \TypeError if $applicationName is not a string
	 */
	public function getApplicationsByApplicationName (\PDO $pdo, string $applicationName){
		// sanitize the prospectEmail before searching
		$applicationName = trim($applicationName);
		$applicationName = filter_var($applicationName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($applicationName) === true) {
			throw(new \PDOException("Application Name is empty or insecure"));
		}
		$applicationName = "%$applicationName%";

		// create query template
		$query = "SELECT applicationId, applicationFirstName, applicationLastName, applicationEmail, applicationPhoneNumber, applicationSource, applicationCohortId, applicationAboutYou, applicationHopeToAccomplish, applicationExperience, applicationDateTime, applicationUtmCampaign, applicationUtmMedium, applicationUtmSource From application WHERE applicationFirstName LIKE :applicationName OR applicationLastName LIKE :applicationName";
		$statement = $pdo->prepare($query);

		// bind the application name to the place holder in template
		$parameters = ["applicationName" => $applicationName];
		$statement->execute($parameters);

		// build an array of applications
		$applications = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$application = new application(
					$row["applicationId"],
					$row["applicationFirstName"],
					$row["applicationLastName"],
					$row["applicationEmail"],
					$row["applicationPhoneNumber"],
					$row["applicationSource"],
					$row["applicationCohortId"],
					$row["applicationAboutYou"],
					$row["applicationHopeToAccomplish"],
					$row["applicationExperience"],
					$row["applicationDateTime"],
					$row["applicationUtmCampaign"],
					$row["applicationUtmMedium"],
					$row["applicationUtmSource"]
				);
				$applications[$applications->key()] = $application;
				$applications->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($applications);
	}

	/**
	 * @return array
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}


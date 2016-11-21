<?php
namespace Edu\Cnm\DdcAaaa;

/**
 * Class Prospect
 * contains information about prospective students
 * @package Edu\Cnm\DdcAaaa
 */
class Prospect implements \JsonSerializable {

	/**
	 * id for this prospect - primary key
	 * @var int $prospectId
	 */
	private $prospectId;

	/**
	 * phone number for this prospect
	 * @var string $prospectPhoneNumber
	 */
	private $prospectPhoneNumber;

	/**
	 * email for this prospect
	 * @var string $prospectEmail
	 */
	private $prospectEmail;

	/**
	 * first name for this prospect
	 * @var string $prospectFirstName
	 */
	private $prospectFirstName;

	/**
	 * last name for this prospect
	 * @var string $prospectLastName
	 */
	private $prospectLastName;

	/**
	 * Prospect constructor.
	 * @param int|null $newProspectId new id for this prospect, null if new prospect
	 * @param string $newProspectPhoneNumber phone number for this prospect
	 * @param string $newProspectEmail email for this prospect
	 * @param string $newProspectFirstName first name for this prospect
	 * @param string $newProspectLastName last name for this prospect
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data is not out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs.
	 */
	public function __construct(int $newProspectId = null, string $newProspectPhoneNumber, string $newProspectEmail, string $newProspectFirstName, string $newProspectLastName){
		try {
			$this->setProspectId($newProspectId);
			$this->setProspectPhoneNumber($newProspectPhoneNumber);
			$this->setProspectEmail($newProspectEmail);
			$this->setProspectFirstName($newProspectFirstName);
			$this->setProspectLastName($newProspectLastName);
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
	 * accessor method for prospect id
	 * @return int  value of prospect id
	 */
	public function getProspectId(){
		return($this->prospectId);
	}

	/**
	 * accessor method for prospect phone number
	 * @return string value of prospect phone number
	 */
	public function getProspectPhoneNumber(){
		return($this->prospectPhoneNumber);
	}
	/**
	 * accessor method for prospect email
	 * @return string value of prospect email
	 */
	public function getProspectEmail(){
		return($this->prospectEmail);
	}
	/**
	 * accessor method for prospect first name
	 * @return string value of prospect first name
	 */
	public function getProspectFirstName(){
		return($this->prospectFirstName);
	}
	/**
	 * accessor method for prospect last name
	 * @return string value of prospect last name
	 */
	public function getProspectLastName(){
		return($this->prospectLastName);
	}

	/**
	 * mutator method for prospect id
	 * @param int|null $newProspectId new value for prospect Id
	 * @throws \RangeException throws this if number is negative, or 0.
	 * @throws \TypeError throws this if $newProspectId is not an integer.
	 */
	public function setProspectId(int $newProspectId = null){
		if($newProspectId === null){
			$this->prospectId = null;
			return;
		}

		if ($newProspectId <= 0) {
			throw(new \RangeException("Prospect ID cannot be negative."));
		}
		$this->prospectId=$newProspectId;
	}

	/**
	 * mutator method for prospect phone number
	 * @param string $newProspectPhoneNumber new value for prospect phone number
	 * @throws \InvalidArgumentException if $newProspectPhoneNumber is not a string or insecure
	 * @throws \RangeException if $newProspectPhoneNumber is > 100 characters
	 * @throws \TypeError if $newProspectPhoneNumber is not a string
	 */
	public function setProspectPhoneNumber(string $newProspectPhoneNumber){
		// verify the prospect phone number is secure
		$newProspectPhoneNumber = trim($newProspectPhoneNumber);
		$newProspectPhoneNumber = filter_var($newProspectPhoneNumber, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProspectPhoneNumber) === true) {
			throw(new \InvalidArgumentException("Prospect Phone Number is empty or insecure"));
		}
		// verify the phone number will fit in the database
		if(strlen($newProspectPhoneNumber) > 100) {
			throw(new \RangeException("Prospect Phone Number too large"));
		}
		// store phone number
		$this->prospectPhoneNumber=$newProspectPhoneNumber;
	}

	/**
	 * mutator method for prospect email
	 * @param string $newProspectEmail new value for prospect email
	 * @throws \InvalidArgumentException if $newProspectEmail is not a string or insecure
	 * @throws \RangeException if $newProspectEmail is > 30 characters
	 * @throws \TypeError if $newProspectEmail is not a string
	 */
	public function setProspectEmail(string $newProspectEmail){
		// verify the email is secure
		$newProspectEmail = trim($newProspectEmail);
		$newProspectEmail = filter_var($newProspectEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProspectEmail) === true) {
			throw(new \InvalidArgumentException("Prospect Email is empty or insecure"));
		}
		// verify the email will fit in the database
		if(strlen($newProspectEmail) > 30) {
			throw(new \RangeException("Prospect Email too large"));
		}
		// store email
		$this->prospectEmail=$newProspectEmail;
	}

	/**
	 * mutator method for prospect first name
	 * @param string $newProspectFirstName new value for prospect first name
	 * @throws \InvalidArgumentException if $newProspectFirstName is not a string or insecure
	 * @throws \RangeException if $newProspectFirstName is > 40 characters
	 * @throws \TypeError if $newProspectFirstName is not a string
	 */
	public function setProspectFirstName(string $newProspectFirstName){
		// verify the first name is secure
		$newProspectFirstName = trim($newProspectFirstName);
		$newProspectFirstName = filter_var($newProspectFirstName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProspectFirstName) === true) {
			throw(new \InvalidArgumentException("Prospect First Name is empty or insecure"));
		}
		// verify the first name will fit in the database
		if(strlen($newProspectFirstName) > 40) {
			throw(new \RangeException("Prospect First Name too large"));
		}
		// store first name
		$this->prospectFirstName=$newProspectFirstName;
	}

	/**
	 * mutator method for prospect last name
	 * @param string $newProspectLastName new value for prospect last name
	 * @throws \InvalidArgumentException if $newProspectLastName is not a string or insecure
	 * @throws \RangeException if $newProspectLastName is > 40 characters
	 * @throws \TypeError if $newProspectLastName is not a string
	 */
	public function setProspectLastName(string $newProspectLastName){
		// verify the last name is secure
		$newProspectLastName = trim($newProspectLastName);
		$newProspectLastName = filter_var($newProspectLastName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProspectLastName) === true) {
			throw(new \InvalidArgumentException("Prospect Last Name is empty or insecure"));
		}
		// verify the last name will fit in the database
		if(strlen($newProspectLastName) > 40) {
			throw(new \RangeException("Prospect Last Name too large"));
		}
		// store last name
		$this->prospectLastName=$newProspectLastName;
	}

	/**
	 * insert this prospect into mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL errors occur.
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) {
		// enforce the prospectId is null (i.e., don't insert a prospect that already exists)
		if($this->prospectId !== null) {
			throw(new \PDOException("not a new prospect"));
		}

		// create query template
		$query = "INSERT INTO prospect(prospectCohortId, prospectPhoneNumber, prospectEmail, prospectFirstName, prospectLastName) VALUES(:prospectCohortId, :prospectPhoneNumber, :prospectEmail, :prospectFirstName, :prospectLastName)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = [
			"prospectCohortId" => $this->prospectCohortId,
			"prospectPhoneNumber" => $this->prospectPhoneNumber,
			"prospectEmail" => $this->prospectEmail,
			"prospectFirstName" => $this->prospectFirstName,
			"prospectLastName" => $this->prospectLastName
		];
		$statement->execute($parameters);

		// update the null prospectId with what mySQL just gave us
		$this->prospectId = intval($pdo->lastInsertId());
	}

	/**
	 * gets prospects by prospect id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $prospectId to search by
	 * @return Prospect|null prospect if found, null if not
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProspectByProspectId(\PDO $pdo, int $prospectId){
		// sanitize the prospectId before searching
		if($prospectId <= 0){
			throw(new \PDOException("prospectId not positive"));
		}

		// create query template
		$query = "SELECT prospectId, prospectCohortId, prospectPhoneNumber, prospectEmail, prospectFirstName, prospectLastName From prospect WHERE prospectId = :prospectId";
		$statement = $pdo->prepare($query);

		// bind the prospect id to the place holder in template
		$parameters = ["prospectId" => $prospectId];
		$statement->execute($parameters);

		// grab prospect from SQL
		try {
			$prospect = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$prospect = new Prospect(
					$row["prospectId"],
					$row["prospectCohortId"],
					$row["prospectPhoneNumber"],
					$row["prospectEmail"],
					$row["prospectFirstName"],
					$row["prospectLastName"]
				);
			}
		} catch(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($prospect);
	}

	/**
	 * gets prospects by prospect cohort id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $prospectCohortId to search by
	 * @return \SplFixedArray SplFixedArray of prospects found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProspectsByProspectsCohortId(\PDO $pdo, int $prospectCohortId){
		// sanitize the prospectId before searching
		if($prospectCohortId <= 0){
			throw(new \PDOException("prospectCohortId not positive"));
		}

		// create query template
		$query = "SELECT prospectId, prospectCohortId, prospectPhoneNumber, prospectEmail, prospectFirstName, prospectLastName From prospect WHERE prospectCohortId = :prospectCohortId";
		$statement = $pdo->prepare($query);

		// bind the prospect id to the place holder in template
		$parameters = ["prospectCohortId" => $prospectCohortId];
		$statement->execute($parameters);

		// build an array of prospects
		$prospects = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$prospect = new prospect(
					$row["prospectId"],
					$row["prospectCohortId"],
					$row["prospectPhoneNumber"],
					$row["prospectEmail"],
					$row["prospectFirstName"],
					$row["prospectLastName"]
				);
				$prospects[$prospects->key()] = $prospect;
				$prospects->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($prospects);
	}

	/**
	 * gets the prospect by prospect email
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $prospectEmail to search by
	 * @return Prospect|null prospect found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProspectByProspectEmail(\PDO $pdo, int $prospectEmail){
		// sanitize the prospectEmail before searching
		$prospectEmail = trim($prospectEmail);
		$prospectEmail = filter_var($prospectEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($prospectEmail) === true) {
			throw(new \PDOException("Prospect Email is empty or insecure"));
		}

		// create query template
		$query = "SELECT prospectId, prospectCohortId, prospectPhoneNumber, prospectEmail, prospectFirstName, prospectLastName From prospect WHERE prospectEmail = :prospectEmail";
		$statement = $pdo->prepare($query);

		// bind the prospect id to the place holder in template
		$parameters = ["prospectEmail" => $prospectEmail];
		$statement->execute($parameters);

		// grab prospect from SQL
		try {
			$prospect = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$prospect = new Prospect(
					$row["prospectId"],
					$row["prospectCohortId"],
					$row["prospectPhoneNumber"],
					$row["prospectEmail"],
					$row["prospectFirstName"],
					$row["prospectLastName"]
				);
			}
		} catch(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($prospect);
	}

	/**
	 * gets prospects by prospect name
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $prospectName to search by
	 * @return \SplFixedArray SplFixedArray of prospects found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProspectsByProspectName(\PDO $pdo, string $prospectName){
		// sanitize the prospectEmail before searching
		$prospectName = trim($prospectName);
		$prospectName = filter_var($prospectName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($prospectName) === true) {
			throw(new \PDOException("Prospect Name is empty or insecure"));
		}
		$prospectName = "%$prospectName%";

		// create query template
		$query = "SELECT prospectId, prospectCohortId, prospectPhoneNumber, prospectEmail, prospectFirstName, prospectLastName From prospect WHERE prospectFirstName LIKE :prospectName OR prospectLastName LIKE :proscpectName";
		$statement = $pdo->prepare($query);

		// bind the prospect name to the place holder in template
		$parameters = ["prospectName" => $prospectName];
		$statement->execute($parameters);

		// build an array of prospects
		$prospects = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$prospect = new prospect(
					$row["prospectId"],
					$row["prospectCohortId"],
					$row["prospectPhoneNumber"],
					$row["prospectEmail"],
					$row["prospectFirstName"],
					$row["prospectLastName"]
				);
				$prospects[$prospects->key()] = $prospect;
				$prospects->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($prospects);
	}

	/**
	 * get all prospects
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of prospects found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getAllProspects(\PDO $pdo){
		// create query template
		$query = "SELECT prospectId, prospectCohortId, prospectPhoneNumber, prospectEmail, prospectFirstName, prospectLastName FROM prospect";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of prospects
		$prospects = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$prospect = new prospect(
					$row["prospectId"],
					$row["prospectCohortId"],
					$row["prospectPhoneNumber"],
					$row["prospectEmail"],
					$row["prospectFirstName"],
					$row["prospectLastName"]
				);
				$prospects[$prospects->key()] = $prospect;
				$prospects->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($prospects);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}
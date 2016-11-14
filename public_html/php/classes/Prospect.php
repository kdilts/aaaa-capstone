<?php
namespace Edu\Cnm\DdcAaaa;
class Prospect implements \JsonSerializable {
	/**
	 * @var int $prospectId
	 */
	private $prospectId;
	/**
	 * @var int $prospectCohortId
	 */
	private $prospectCohortId;
	/**
	 * @var string $prospectPhoneNumber
	 */
	private $prospectPhoneNumber;
	/**
	 * @var string $prospectEmail
	 */
	private $prospectEmail;
	/**
	 * @var string $prospectFirstName
	 */
	private $prospectFirstName;
	/**
	 * @var string $prospectLastName
	 */
	private $prospectLastName;
	/**
	 * Prospect constructor.
	 * @param int|null $newProspectId
	 * @param int $newProspectCohortId
	 * @param string $newProspectPhoneNumber
	 * @param string $newProspectEmail
	 * @param string $newProspectFirstName
	 * @param string $newProspectLastName
	 * @throws \InvalidArgumentException
	 * @throws \RangeException
	 * @throws \TypeError
	 * @throws \Exception
	 */
	public function __construct(int $newProspectId = null, int $newProspectCohortId, string $newProspectPhoneNumber, string $newProspectEmail, string $newProspectFirstName, string $newProspectLastName){
		try {
			$this->setProspectId($newProspectId);
			$this->setProspectCohortId($newProspectCohortId);
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
	 * @return int
	 */
	public function getProspectId(){
		return($this->getProspectId());
	}
	/**
	 * @return int
	 */
	public function getProspectCohortId(){
		return($this->getProspectCohortId());
	}
	/**
	 * @return string
	 */
	public function getProspectPhoneNumber(){
		return($this->getProspectPhoneNumber());
	}
	/**
	 * @return string
	 */
	public function getProspectEmail(){
		return($this->getProspectEmail());
	}
	/**
	 * @return string
	 */
	public function getProspectFirstName(){
		return($this->getProspectFirstName());
	}
	/**
	 * @return string
	 */
	public function getProspectLastName(){
		return($this->getProspectLastName());
	}
	/**
	 * @param $newProspectId
	 */
	public function setProspectId($newProspectId){
		if ($newProspectId <= 0) {
			throw(new \RangeException("Prospect ID cannot be negative."));
		}
		$this->prospectId=$newProspectId;
	}
	/**
	 * @param $newProspectCohortId
	 */
	public function setProspectCohortId($newProspectCohortId){
		if ($newProspectCohortId <= 0) {
			throw(new \RangeException("Prospect Cohort ID cannot be negative."));
		}
		$this->prospectCohortId=$newProspectCohortId;
	}
	/**
	 * @param $newProspectPhoneNumber
	 */
	public function setProspectPhoneNumber($newProspectPhoneNumber){
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
	 * @param $newProspectEmail
	 */
	public function setProspectEmail($newProspectEmail){
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
	 * @param $newProspectFirstName
	 */
	public function setProspectFirstName($newProspectFirstName){
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
	 * @param $newProspectLastName
	 */
	public function setProspectLastName($newProspectLastName){
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
	 * @param \PDO $pdo
	 * @throws \PDOException
	 */
	public function insert(\PDO $pdo) {
		// enforce the prospectId is null (i.e., don't insert a prospect that already exists)
		if($this->prospectId !== null) {
			throw(new \PDOException("not a new prospect"));
		}

		// create query template
		$query = "INSERT INTO prospect(prospectId, prospectCohortId, prospectPhoneNumber, prospectEmail, prospectFirstName, prospectLastName) VALUES(:prospectId, :prospectCohortId, :prospectPhoneNumber, :prospectEmail, :prospectFirstName, :prospectLastName)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = [
			"prospectId" => $this->prospectId,
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
	 * @param \PDO $pdo
	 * @param int $prospectId
	 * @return Prospect|null
	 * @throws \PDOException
	 */
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
	 * @param \PDO $pdo
	 * @param int $prospectCohortId
	 * @return Prospect|null
	 * @throws \PDOException
	 */
	public static function getProspectByProspectCohortId(\PDO $pdo, int $prospectCohortId){
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
	 * @param \PDO $pdo
	 * @param int $prospectEmail
	 * @return Prospect|null
	 * @throws \PDOException
	 */
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
	 * @param \PDO $pdo
	 * @param string $prospectName
	 * @return Prospect|null
	 */
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

		// bind the prospect id to the place holder in template
		$parameters = ["prospectName" => $prospectName];
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
	 * @param \PDO $pdo
	 * @return \SplFixedArray
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
	 * @return array
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}
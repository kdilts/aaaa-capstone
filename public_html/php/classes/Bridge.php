<?php
namespace Edu\Cnm\DdcAaaa;

	class Bridge {

		/**
		 * class Bridge for Ddcaaaa
		 *
		 * @version 1.0.0
		 **/

		/**
		 * @var string $bridgeStaffId
		 **/

		private $bridgeStaffId;
		/**
		 * @var int $bridgeName
		 **/
		private $bridgeName;
		/**
		 * @var int $bridgeUserName
		 **/
		private $bridgeUserName;

		/**
		 * Bridge constructor.
		 * @param string|null $newBridgeStaffId
		 * @param string $newBridgeName
		 * @param string $newBridgeUserName
		 * @throws \InvalidArgumentException
		 * @throws \RangeException
		 * @throws \TypeError
		 * @throws \Exception
		 */

		public function __construct(string $newBridgeStaffId = null, string $newBridgeName, string $newBridgeUserName) {
			try {
				$this->setBridgeStaffId($newBridgeStaffId);
				$this->setBridgeName($newBridgeName);
				$this->setBridgeUserName($newBridgeUserName);

			} catch(\InvalidArgumentException $invalidArgument) {
				throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
			} catch(\RangeException $range) {
				throw(new  \RangeException($range->getMessage(), 0, $range));
			} catch(\TypeError $typeError) {
				throw(new \TypeError($typeError->getMessage(), 0, $typeError));
			} catch(\Exception $exception) {
				throw(new \Exception($exception->getMessage(), 0, $exception));
			}
		}
		/**
		 * accessor method for bridge staff id
		 *
		 *@return string value for bridge staff id
		 **/
		public function getBridgeStaffId() {
				return $this->bridgeStaffId;
		}

		/**
		 * mutator method for bridge staff id
		 * @param string $newBridgeStaffId
		 * @throws \InvalidArgumentException if $newBridgeStaffId is not a valid string
		 * @throws \RangeException if $newBridgeStaffId is not positive
		 * @throws \Exception if some other exception occurs
		 **/
		public function setBridgeStaffId(string $newBridgeStaffId) {
			$newBridgeStaffId = trim ($newBridgeStaffId);
			$newBridgeStaffId = filter_var($newBridgeStaffId, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(empty($newBridgeStaffId) === true) {
				throw (new \InvalidArgumentException("Bridge staff id is either empty or insecure."));
			}
			$this ->bridgeStaffId = $newBridgeStaffId;
		}
		/**
		 * accessor method for bridge name
		 * @return string value of bridge name
		 **/
		public function getBridgeName() {
				return ($this->bridgeName);
		}
		/**
		 * mutator method for bridgeName
		 * @param string $newBridgeName
		 * @throws \InvalidArgumentException if $newBridgeName is not a valid string
		 * @throws \RangeException if $newBridgeName is not positive
		 * @throws \Exception if some other exception occurs
		 **/
		public function setBridgeName(string $newBridgeName) {
			$newBridgeName = trim ($newBridgeName);
			$newBridgeName = filter_var($newBridgeName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(empty($newBridgeName) === true) {
				throw (new \InvalidArgumentException("Bridge name is either empty or insecure."));
			}
			$this ->bridgeName = $newBridgeName;
		}
		/**
		 * accessor method for bridge user name
		 *@return string value of bridge user name
		 **/
		public function getBridgeUserName() {
			return ($this->bridgeUserName);
		}
		/**
		 * mutator method for bridgeUserName
		 * @param string $newBridgeUserName
		 * @throws \InvalidArgumentException if $newBridgeUserName is not a valid string
		 * @throws \RangeException if $newBridgeUserName is not positive
		 * @throws \Exception if some other exception occurs
		 **/
		public function setBridgeUserName(string $newBridgeUserName) {
			$newBridgeUserName = trim ($newBridgeUserName);
			//echo $newBridgeUserName;
			$newBridgeUserName = filter_var($newBridgeUserName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			//echo $newBridgeUserName;
			if(empty($newBridgeUserName) === true) {
				throw (new \InvalidArgumentException("Bridge name is either empty or insecure."));
			}
			$this ->bridgeUserName = $newBridgeUserName;
		}
		/**
		 * inserts this bridge member into database.
		 * @param \PDO $pdo
		 * @throws \PDOException
		 */
		public function insert(\PDO $pdo) {
			// enforce the bridgeStaffId is null (i.e., don't insert a bridge that already exists)
			$bridgeStaffIdQuery = "SELECT bridgeStaffId FROM bridge WHERE bridgeStaffId = :bridgeStaffId";
			$bridgeIdStatement = $pdo->prepare($bridgeStaffIdQuery);
			$bridgeIdParameters = ["bridgeStaffId" => $this->bridgeStaffId];
			$bridgeIdStatement->execute($bridgeIdParameters);
			try {
				$bridge = null;
				$bridgeIdStatement->setFetchMode(\PDO::FETCH_ASSOC);
				$row = $bridgeIdStatement->fetch();
				if($row !== false){
					$bridge = new Bridge($row["bridgeStaffId"], $row["bridgeName"], $row["bridgeUserName"]);
				}
			} catch(\Exception $exception){
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			echo 'Hello World';
			var_dump($bridge);

			if($bridge === null) {
				throw(new \PDOException("not a new bridge"));
			}
			// create query template
			$query = "INSERT INTO bridge(bridgeStaffId, bridgeName, bridgeUserName) VALUES(:bridgeStaffId, :bridgeName, :bridgeUserName)";
			$statement = $pdo->prepare($query);
			// bind the member variables to the place holders in the template
			$parameters = ["bridgeStaffId" => $this->bridgeStaffId, "bridgeName" => $this->bridgeName, "bridgeUserName" => $this->bridgeUserName];
			$statement->execute($parameters);
			// update the null bridgeStaffId with what mySQL just gave us
			$this->bridgeStaffId = intval($pdo->lastInsertId());
		}

		/**
		 * searches bridge by staffId
		 * @param \PDO $pdo PDO connection object
		 * @param \string bridgeStaffId search for bridge by StaffId
		 * @return bridge|null if found or null if not found
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError when variables are not the correct data type
		 */
		public static function getBridgeByBridgeStaffId(\PDO $pdo, string $bridgeStaffId) {
			// sanitize the bridgeId before searching
			$bridgeStaffId = trim($bridgeStaffId);
			$bridgeStaffId = filter_var($bridgeStaffId, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(empty($bridgeStaffId) === null) {
				throw(new \PDOException("bridgeStaffId is empty or insecure."));
			}

			// create query template
			$query = "SELECT bridgeStaffId, bridgeName, bridgeUserName FROM bridge WHERE bridgeStaffId = :bridgeStaffId";
			$statement = $pdo->prepare($query);

			// bind the bridgeStaff id to the place holder in template
			$parameters = ["bridgeStaffId" => $bridgeStaffId];
			$statement->execute($parameters);

			// grab bridge from SQL
			try {
				$bridge = null;
				$statement->setFetchMode(\PDO::FETCH_ASSOC);
				$row = $statement->fetch();
				if($row !== false) {
					$bridge = new bridge($row["bridgeStaffId"], $row["bridgeName"], $row["bridgeUserName"]);
				}
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			return ($bridge);
		}
		/**
		 * searches bridge by bridgeName
		 * @param \PDO $pdo PDO connection object
		 * @param string $bridgeName search for bridge by bridge name
		 * @return \SplFixedArray if found or null if not found
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError when variables are not the correct data type
		 */
		public static function getBridgeByBridgeName(\PDO $pdo, string $bridgeName) {
			// sanitize the bridgeName before searching
			$bridgeName = trim($bridgeName);
			$bridgeName = filter_var($bridgeName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(empty($bridgeName) === null) {
				throw(new \PDOException("bridgeName is empty or insecure")); //is this right?
			}

			// create query template
			$query = "SELECT bridgeStaffId, bridgeName, bridgeUserName FROM bridge WHERE bridgeName = :bridgeName";
			$statement = $pdo->prepare($query);

			// bind the bridge name to the place holder in template
			$parameters = ["bridgeName" => $bridgeName];
			$statement->execute($parameters);

			// build an array of bridges
			$bridges = new \SplFixedArray($statement->rowCount());
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			while(($row = $statement->fetch()) !== false) {
				try {
					$bridge = new Bridge($row["bridgeStaffId"], $row["bridgeName"], $row["bridgeUserName"]);
					$bridges[$bridges->key()] = $bridge;
					$bridges->next();
				} catch(\Exception $exception) {
					// if the row couldn't be converted, rethrow it
					throw(new \PDOException($exception->getMessage(), 0, $exception));
				}
			}
			return $bridges;
		}
		/**
		 * searches bridge by userName
		 * @param \PDO $pdo
		 * @param \string $bridgeUserName searches bridge by UserName
		 * @return \SplFixedArray
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError when variables are not the correct data type

		 */
		public static function getBridgeByBridgeUserName(\PDO $pdo, string $bridgeUserName) {
			// sanitize the bridgeUserName before searching
			$bridgeUserName = trim($bridgeUserName);
			$bridgeUserName = filter_var($bridgeUserName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(empty($bridgeUserName) === null) {
				throw(new \PDOException("bridgeUserName can't be empty"));
			}

			// create query template
			$query = "SELECT bridgeStaffId, bridgeName, bridgeUserName FROM bridge WHERE bridgeUserName = :bridgeUserName";
			$statement = $pdo->prepare($query);

			// bind the bridgeUserName to the place holder in template
			$parameters = ["bridgeUserName" => $bridgeUserName];
			$statement->execute($parameters);

			// build an array of bridges
			$bridges = new \SplFixedArray($statement->rowCount());
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			while(($row = $statement->fetch()) !== false) {
				try {
					$bridge = new Bridge($row["bridgeStaffId"], $row["bridgeName"], $row["bridgeUserName"]);
					$bridges[$bridges->key()] = $bridge;
					$bridges->next();
				} catch(\Exception $exception) {
					// if the row couldn't be converted, rethrow it
					throw(new \PDOException($exception->getMessage(), 0, $exception));
				}
			}
			return $bridges;
		}

		/**
		 * gets all bridge members
		 * @param \PDO $pdo connection objects
		 * @return \SplFixedArray SplFi
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError when variables are not the correct data type
		 */
		public static function getAllBridges(\PDO $pdo) {
			// create query template
			$query = "SELECT bridgeStaffId, bridgeName, bridgeUserName FROM bridge";
			$statement = $pdo->prepare($query);
			$statement->execute();

			// build an array of bridges
			$bridges = new \SplFixedArray($statement->rowCount());
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			while(($row = $statement->fetch()) !== false) {
				try {
					$bridge = new Bridge($row["bridgeStaffId"], $row["bridgeName"], $row["bridgeUserName"]);
					$bridges[$bridges->key()] = $bridge;
					$bridges->next();
				} catch(\Exception $exception) {
					// if the row couldn't be converted, rethrow it
					throw(new \PDOException($exception->getMessage(), 0, $exception));
				}
			}
			return $bridges;
		}

		/**
		 * @return array
		 */
		public function jsonSerialize() {
			$fields = get_object_vars($this);
			return($fields);
		}
	}



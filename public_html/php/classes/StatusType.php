<?php

namespace Edu\Cnm\DdcAaaa;

class StatusType {
	/**
	 * @var string $statusTypeName
	 */
	private $statusTypeName;
	/**
	 * @var int $statusTypeId
	 */
	private $statusTypeId;

	public function __construct(string $newStatusTypeName, int $newStatusTypeId) {
	try {
		$this->setStatusTypeId($newStatusTypeId);
		$this->setStatusTypeName($newStatusTypeName);
	} catch(\InvalidArgumentException $invalidArgumentException){
		throw(new \InvalidArgumentException($invalidArgumentException->getMessage(), 0, $invalidArgumentException));
	} catch(\RangeException $rangeException){
		throw(new \RangeException($rangeException->getMessage(), 0, $rangeException));
	} catch(\TypeError $typeError){
		throw(new \TypeError($typeError->getMessage(), 0, $typeError));
	} catch(\Exception $exception){
		throw(new \Exception($exception->getMessage(), 0, $exception));
	}

	}
	/**
	 * @return int
	 */
	public function getStatusTypeId(){
		return $this->statusTypeId;
	}
	/**
	 * @return string
	 */
	public function getStatusTypeName(){
		return $this->statusTypeName;
	}
	/**
 	* @param int $statusTypeId
 	*/
	public function setStatusTypeId(int $statusTypeId) {
		if($statusTypeId <= 0) {
			throw(new \RangeException("typeId can't be 0 or less."));
		}
	$this->statusTypeId = $statusTypeId;
	}
	/**
 	* @param string $newStatusTypeName
 	*/
	public function setStatusTypeName(string $newStatusTypeName) {
		$newStatusTypeName = trim($newStatusTypeName);
		$newStatusTypeName = filter_var($newStatusTypeName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newStatusTypeName) === true) {
			throw (new \InvalidArgumentException("Status type name is either empty or insecure."));
		}
	$this->statusTypeName = $newStatusTypeName;
}

	/**
	 * @param \PDO $pdo
	 */
public function insert(\PDO $pdo) {
	if($this->statusTypeId === null) {
		throw(new \PDOException("Need a status type."));
	}
	$query = "INSERT INTO statusType(statusTypeId, statusTypeName) VALUES(:statusTypeId, :statusTypeName)";
	$statement = $pdo->prepare($query);


	$parameters = ["statusTypeId" => $this->statusTypeId, "statusTypeName" => $this->statusTypeName];
	$statement->execute($parameters);


	$this->statusTypeId = intval($pdo->lastInsertId());

}
}

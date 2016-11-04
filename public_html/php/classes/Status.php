<?php
/**
 * Created by PhpStorm.
 * User: Fushi
 * Date: 11/4/2016
 * Time: 10:00 AM
 */
class Status {
	/**
	 * @var int $statusTypeName
	 */
	private $statusTypeName;
	/**
	 * @var int $statusTypeId
	 */
	private $statusTypeId
	/**
	 * @return int
	 */
	public function getStatusTypeId(): int {
		return $this->statusTypeId;
	}
	/**
	 * @return int
	 */
	public function getStatusTypeName(): int {
	return $this->statusTypeName;
	}
	/**
 	* @param int $statusTypeId
 	*/
	public function setStatusTypeId(int $statusTypeId) {
	$this->statusTypeId = $statusTypeId;
	}
	/**
 	* @param int $statusTypeName
 	*/
	public function setStatusTypeName(int $statusTypeName) {
	$this->statusTypeName = $statusTypeName;
}
}

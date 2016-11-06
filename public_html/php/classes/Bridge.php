<?php
namespace Edu\Cnm\DdcAaaa;

	class Bridge {

		/**
		 * class Bridge for Ddcaaaa
		 *
		 * @version 1.0.0
		 **/

		/**
		 * @var int $bridgeStaffId
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


		public function __construct(int $newBridgeStaffId = null, int $newBridgeName, int $newBridgeUserName) {
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
			$this->bridgeStaffId = $newBridgeStaffId;
			$this->bridgeStaffId = trim ($newBridgeStaffId);
			if($newBridgeStaffId = null) {
				$this ->bridgeStaffId = null;
				return;
			}
			//verify the bridge staff id !== 9
			if(strlen($newBridgeStaffId)!== 9){
					throw(new\RangeException("bridge staff id has to be 9"));
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
		/** mutator method for bridgeName
		 * @param string $newBridgeName
		 * @throws \InvalidArgumentException if $newBridgeName is not a valid string
		 * @throws \RangeException if $newBridgeName is not positive
		 * @throws \Exception if some other exception occurs
		 **/
		public function setBridgeName(string $newBridgeName) {
			$this->bridgeName = $newBridgeName;
			$this->bridgeName = trim ($newBridgeName);
			if($newBridgeName = null) {
				$this ->bridgeName = null;
				return;
			}
			$this ->bridgeName = $newBridgeName;
		}
		/**
		 * accessor method for bridge user name
		@return string value of bridge user name
		 **/
		public function getBridgeUserName() {
			return ($this->bridgeUserName);
		}
		/** mutator method for bridgeUserName
		 * @param string $newBridgeUserName
		 * @throws \InvalidArgumentException if $newBridgeUserName is not a valid string
		 * @throws \RangeException if $newBridgeUserName is not positive
		 * @throws \Exception if some other exception occurs
		 **/
		public function setBridgeUserName(string $newBridgeUserName) {
			$this->bridgeUserName = $newBridgeUserName;
			$this->bridgeUserName = trim ($newBridgeUserName);
			if($newBridgeUserName = null) {
				$this ->bridgeName = null;
				return;
			}
			$this ->bridgeUserName = $newBridgeUserName;
		}


		}



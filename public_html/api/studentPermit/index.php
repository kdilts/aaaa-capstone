<?php

require_once(dirname(__DIR__,2) . "/php/classes/autoload.php");
require_once (dirname(__DIR__,2) . "/php/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\DdcAaaa\StudentPermit;
use Edu\Cnm\DdcAaaa\Swipe;
use Edu\Cnm\DdcAaaa\Placard;
use Edu\Cnm\DdcAaaa\StatusType;
use Edu\Cnm\DdcAaaa\JsonObjectStorage;
use Edu\Cnm\DdcAaaa\ApplicationCohort;
use Edu\Cnm\DdcAaaa\Application;
use Edu\Cnm\DdcAaaa\Cohort;

/**
 * api for the StudentPermit class
 *
 * @author Kevin Dilts <kevin@kevindilts.net>
 **/

//verify the session, start if not active
//if(session_status() !== PHP_SESSION_ACTIVE) {
//	session_start();
//}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	// ensure there's a user logged in
//	if(empty($_SESSION["adUser"]) === true) {
//		throw(new RuntimeException("user not logged in", 401));
//	}

	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/ddcaaaa.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$studentPermitId = filter_input(INPUT_GET, "studentPermitId", FILTER_VALIDATE_INT);
	$studentPermitApplicationId = filter_input(INPUT_GET, "studentPermitApplicationId", FILTER_VALIDATE_INT);
	$studentPermitPlacardId = filter_input(INPUT_GET, "studentPermitPlacardId", FILTER_VALIDATE_INT);
	$studentPermitSwipeId = filter_input(INPUT_GET, "studentPermitSwipeId", FILTER_VALIDATE_INT);
	$studentPermitCheckOutDate = filter_input(INPUT_GET, "studentPermitCheckOutDate", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$studentPermitCheckInDate = filter_input(INPUT_GET, "studentPermitCheckInDate", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	$checkOutStartDate = filter_input(INPUT_GET, "checkOutStartDate", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$checkOutEndDate = filter_input(INPUT_GET, "checkOutEndDate", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	$checkInStartDate = filter_input(INPUT_GET, "checkInStartDate", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$checkInEndDate = filter_input(INPUT_GET, "checkInEndDate", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	// handle GET request
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific studentPermit or all studentPermits and update reply
		if(empty($studentPermitId) === false) {
			$studentPermit = StudentPermit::getStudentPermitByStudentPermitId($pdo, $studentPermitId);
			if($studentPermit !== null) {
				$reply->data = $studentPermit;
			}
		} else if(empty($studentPermitApplicationId) === false) {
			$studentPermit = StudentPermit::getStudentPermitByStudentPermitApplicationId($pdo, $studentPermitApplicationId);
			if($studentPermit !== null) {
				$reply->data = $studentPermit;
			}
		} else if(empty($studentPermitSwipeId) === false) {
			$studentPermit = StudentPermit::getStudentPermitByStudentPermitSwipeId($pdo, $studentPermitSwipeId);
			if($studentPermit !== null) {
				$reply->data = $studentPermit;
			}
		}
		else if(empty($studentPermitPlacardId) === false) {
			$studentPermit = StudentPermit::getStudentPermitByStudentPermitPlacardId($pdo, $studentPermitPlacardId);
			if($studentPermit !== null) {
				$reply->data = $studentPermit;
			}
		} else if(empty($checkOutStartDate) === false && empty($checkOutEndDate) === false) {
			$checkOutStartDate = \DateTime::createFromFormat("Y-m-d", $checkOutStartDate);
			$checkOutEndDate = \DateTime::createFromFormat("Y-m-d", $checkOutEndDate);
			$studentPermits = StudentPermit::getStudentPermitsByStudentPermitCheckOutDateRange($pdo, $checkOutStartDate, $checkOutEndDate);
			if($studentPermits !== null) {
				$reply->data = $studentPermits->toArray();
			}
		} else if(empty($checkInStartDate) === false && empty($checkInEndDate) === false) {
			$checkInStartDate = \DateTime::createFromFormat("Y-m-d", $checkInStartDate);
			$checkInEndDate = \DateTime::createFromFormat("Y-m-d", $checkInEndDate);
			$studentPermits = StudentPermit::getStudentPermitsByStudentPermitCheckInDateRange($pdo, $checkInStartDate, $checkInEndDate);
			if($studentPermits !== null) {
				$reply->data = $studentPermits->toArray();
			}
		} else {
			$studentPermits = StudentPermit::getAllStudentPermits($pdo);
			if($studentPermits !== null) {
				$storage = new JsonObjectStorage();
				for ($i=0; $i<count($studentPermits); $i++){
					$placard = Placard::getPlacardByPlacardId($pdo, $studentPermits[$i]->getStudentPermitPlacardId());
					$applicationCohorts = ApplicationCohort::getApplicationCohortsByApplicationId($pdo, $studentPermits[$i]->getStudentPermitApplicationId());

					$cohorts = [];
					for($j = 0; $j < count($applicationCohorts); $j++){
						$cohorts[$j] = Cohort::getCohortByCohortId($pdo, $applicationCohorts[$j]->getApplicationCohortCohortId());
					}

					$storage->attach(
						$studentPermits[$i],
						[
							$placard,
							Swipe::getSwipeBySwipeId($pdo, $studentPermits[$i]->getStudentPermitSwipeId()),
							StatusType::getStatusTypeByStatusTypeId($pdo, $placard->getPlacardStatusTypeId()),
							Application::getApplicationByApplicationId($pdo, $applicationCohorts[0]->getApplicationCohortApplicationId()),
							$cohorts
						]
					);
				}

				$reply->data = $storage;
			}
		}
	} else if($method === "POST" || "PUT") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//make sure studentPermit Application Id is available (required field)
		if(empty($requestObject->studentPermitApplicationId) === true) {
			throw(new \InvalidArgumentException ("studentPermit Application Id is missing.", 405));
		}

		//make sure studentPermit placard id is available (required field)
		if(empty($requestObject->studentPermitPlacardId) === true) {
			throw(new \InvalidArgumentException ("studentPermit placard id is missing.", 405));
		}

		//make sure studentPermit swipe id is available (required field)
		if(empty($requestObject->studentPermitSwipeId) === true) {
			throw(new \InvalidArgumentException ("studentPermit swipe id is missing.", 405));
		}

		//make sure studentPermit check out date is available (required field)
		if(empty($requestObject->studentPermitCheckOutDate) === true) {
			throw(new \InvalidArgumentException ("studentPermit checkout date is missing.", 405));
		}

		//make sure studentPermit check in date is available (required field)
		if(empty($requestObject->studentPermitCheckInDate) === true) {
			throw(new \InvalidArgumentException ("studentPermit checkin date is missing.", 405));
		}
		
		//perform the actual post
		if($method === "POST") {

			// create new student permit and insert into the database
			$studentPermit = new StudentPermit(
				$requestObject->studentPermitId,
				$requestObject->studentPermitApplicationId,
				$requestObject->studentPermitPlacardId,
				$requestObject->studentPermitSwipeId,
				\DateTime::createFromFormat("Y-m-d",$requestObject->studentPermitCheckOutDate),
				\DateTime::createFromFormat("Y-m-d",$requestObject->studentPermitCheckInDate)
			);
			$studentPermit->insert($pdo);

			// update reply
			$reply->message = "StudentPermit created OK";
		}else if($method === "PUT"){

			// retrieve the studentPermit to update
			$studentPermit = StudentPermit::getStudentPermitByStudentPermitId($pdo, $studentPermitId);
			if($studentPermit === null) {
				throw(new RuntimeException("StudentPermit does not exist", 404));
			}

			// update all attributes
			$studentPermit->setStudentPermitApplicationId($requestObject->studentPermitApplicationId);
			$studentPermit->setStudentPermitPlacardId($requestObject->studentPermitPlacardId);
			$studentPermit->setStudentPermitSwipeId($requestObject->studentPermitSwipeId);
			$studentPermit->setStudentPermitCheckOutDate(\DateTime::createFromFormat("Y-m-d",$requestObject->studentPermitCheckOutDate));
			$studentPermit->setStudentPermitCheckInDate(\DateTime::createFromFormat("Y-m-d",$requestObject->studentPermitCheckInDate));

			$studentPermit->update($pdo);

			// update reply
			$reply->message = "StudentPermit updated OK";

		}

	} else {
		throw (new Exception("Invalid HTTP request!", 405));
	}
	// update reply with exception information
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}

header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}

// encode and return reply to front end caller
echo json_encode($reply);
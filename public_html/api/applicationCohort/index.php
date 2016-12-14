<?php

require_once(dirname(__DIR__,2) . "/php/classes/autoload.php");
require_once (dirname(__DIR__,2) . "/php/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\DdcAaaa\Application;
use Edu\Cnm\DdcAaaa\ApplicationCohort;
use Edu\Cnm\DdcAaaa\Cohort;
use Edu\Cnm\DdcAaaa\JsonObjectStorage;

/**
 * api for the application class
 *
 * @author Kevin Dilts <kevin@kevindilts.net>
 **/

//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

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
	$applicationCohortId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$applicationCohortApplicationId = filter_input(INPUT_GET, "applicationCohortApplicationId", FILTER_VALIDATE_INT);
	$applicationCohortCohortId = filter_input(INPUT_GET, "applicationCohortCohortId", FILTER_VALIDATE_INT);
	// handle GET request
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific application or all applications and update reply
		if(empty($applicationCohortId) === false) {
			$applicationCohort = ApplicationCohort::getApplicationCohortByApplicationCohortId($pdo, $applicationCohortId);
			if($applicationCohort !== null) {
				$reply->data = $applicationCohort;
			}
		} else if(empty($applicationCohortApplicationId) === false) {
			$applicationCohorts = ApplicationCohort::getApplicationCohortsByApplicationId($pdo, $applicationCohortApplicationId);
			if($applicationCohorts !== null) {
				$storage = new JsonObjectStorage();

				for($i = 0; $i < count($applicationCohorts); $i++){
					$storage->attach(
						$applicationCohorts[$i],
						[
							Application::getApplicationByApplicationId($pdo, $applicationCohorts[$i]->getApplicationCohortApplicationId()),
							Cohort::getCohortByCohortId($pdo, $applicationCohorts[$i]->getApplicationCohortCohortId())
						]
					);
				}

				$reply->data = $storage;
			}
		} else if(empty($applicationCohortCohortId) === false) {
			$applicationCohorts = ApplicationCohort::getApplicationCohortsByCohortId($pdo, $applicationCohortCohortId);
			if($applicationCohorts !== null) {
				$reply->data = $applicationCohorts->toArray();
			}
		} else {
			$applicationCohorts = ApplicationCohort::getAllApplicationCohorts($pdo);
			if($applicationCohorts !== null) {
				$storage = new JsonObjectStorage();

				for($i = 0; $i < count($applicationCohorts); $i++){
					$storage->attach(
						$applicationCohorts[$i],
						[
							Application::getApplicationByApplicationId($pdo, $applicationCohorts[$i]->getApplicationCohortApplicationId()),
							Cohort::getCohortByCohortId($pdo, $applicationCohorts[$i]->getApplicationCohortCohortId())
						]
					);
				}

				$reply->data = $storage;
			}
		}

	}else if($method === "POST") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//make sure application ID is available (required field)
		if(empty($requestObject->applicationCohortApplicationId) === true) {
			throw(new \InvalidArgumentException ("Application ID is missing.", 405));
		}

		//  make sure application Cohort Id is available (required field)
		if(empty($requestObject->applicationCohortCohortId) === true) {
			throw(new \InvalidArgumentException ("Application Cohort ID is missing.", 405));
		}
//TODO: do we need a applicationCohortId version of the above functions? ^^^^
		//perform the actual post
		if($method === "POST") {

			// create new tweet and insert into the database
			$applicationCohort = new ApplicationCohort(
				$requestObject->applicationCohortId,
				$requestObject->applicationCohortApplicationId,
				$requestObject->applicationCohortCohortId
			);
			$applicationCohort->insert($pdo);

			// update reply
			$reply->message = "application cohort created OK";
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
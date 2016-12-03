<?php

require_once(dirname(__DIR__,2) . "/php/classes/autoload.php");
require_once (dirname(__DIR__,2) . "/php/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\DdcAaaa\Cohort;


/**
 * api for the Cohort class
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
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/ddcaaaa.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$cohortId = filter_input(INPUT_GET, "cohortId", FILTER_VALIDATE_INT);
	$cohortName = filter_input(INPUT_GET, "cohortName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	// handle GET request
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific bridge or all bridges and update reply
		if(empty($cohortId) === false) {
			$cohort = Cohort::getCohortByCohortId($pdo, $cohortId);
			if($cohort !== null) {
				$reply->data = $cohort;
			}
		} else if(empty($cohortName) === false) {
			$cohort = Cohort::getCohortByCohortName($pdo, $cohortName);
			if($cohort !== null) {
				$reply->data = $cohort;
			}
		} else {
			$cohorts = Cohort::getAllCohorts($pdo);
			if($cohorts !== null) {
				$reply->data = $cohorts->toArray();
			}
		}
	} else if($method === "POST") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//make sure cohort name is available (required field)
		if(empty($requestObject->cohortName) === true) {
			throw(new \InvalidArgumentException ("Cohort Name is missing.", 405));
		}

		//perform the actual post
		if($method === "POST") {

			// create new tweet and insert into the database
			$bridge = new Cohort($requestObject->cohortId, $requestObject->cohortName);
			$bridge->insert($pdo);

			// update reply
			$reply->message = "Cohort created OK";
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
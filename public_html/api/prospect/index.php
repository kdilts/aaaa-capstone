<?php

require_once(dirname(__DIR__,2) . "/php/classes/autoload.php");
require_once (dirname(__DIR__,2) . "/php/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\DdcAaaa\Prospect;
use Edu\Cnm\DdcAaaa\ProspectCohort;

/**
 * api for the prospect class
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
	if(empty($_SESSION["adUser"]) === true) {
		throw(new RuntimeException("user not logged in", 401));
	}

	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/ddcaaaa.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$prospectId = filter_input(INPUT_GET, "prospectId", FILTER_VALIDATE_INT);
	$prospectFirstName = filter_input(INPUT_GET, "prospectFirstName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$prospectLastName = filter_input(INPUT_GET, "prospectLastName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$prospectEmail = filter_input(INPUT_GET, "prospectEmail", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$prospectPhoneNumber = filter_input(INPUT_GET, "prospectPhoneNumber", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	$prospectCohortId = filter_input(INPUT_GET, "prospectCohortId", FILTER_VALIDATE_INT);

	// handle GET request
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific prospect or all prospects and update reply
		if(empty($prospectId) === false) {
			$prospect = Prospect::getProspectByProspectId($pdo, $prospectId);
			if($prospect !== null) {
				$reply->data = $prospect;
			}
		} else if(empty($prospectFirstName) === false) {
			$prospects = Prospect::getProspectsByProspectName($pdo, $prospectFirstName);
			if($prospects !== null) {
				$reply->data = $prospects->toArray();
			}
		} else if(empty($prospectLastName) === false) {
			$prospects = Prospect::getProspectsByProspectName($pdo, $prospectLastName);
			if($prospects !== null) {
				$reply->data = $prospects->toArray();
			}
		} else if(empty($prospectEmail) === false) {
			$prospect = Prospect::getProspectByProspectEmail($pdo, $prospectEmail);
			if($prospect !== null) {
				$reply->data = $prospect;
			}
		} else {
			$prospects = Prospect::getAllProspects($pdo);
			if($prospects !== null) {
				$reply->data = $prospects->toArray();
			}
		}
	}else if($method === "POST") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent, false);

		//make sure prospect first name is available (required field)
		if(empty($requestObject->prospectFirstName) === true) {
			throw(new \InvalidArgumentException ("Prospect First Name is missing.", 405));
		}

		//  make sure prospect last name is available (required field)
		if(empty($requestObject->prospectLastName) === true) {
			throw(new \InvalidArgumentException ("Prospect Last Name is missing.", 405));
		}

		//make sure prospect email is available (required field)
		if(empty($requestObject->prospectEmail) === true) {
			throw(new \InvalidArgumentException ("Prospect Email is missing.", 405));
		}

		//  make sure prospect phone number is available (required field)
		if(empty($requestObject->prospectPhoneNumber) === true) {
			throw(new \InvalidArgumentException ("Prospect Phone Number is missing.", 405));
		}

		//perform the actual post
		if($method === "POST") {

			// create new prospect and insert into the database
			$prospect = new Prospect(
				null,
				$requestObject->prospectPhoneNumber,
				$requestObject->prospectEmail,
				$requestObject->prospectFirstName,
				$requestObject->prospectLastName
			);
			$prospect->insert($pdo);

			$prospectCohort = new ProspectCohort(null, $prospect->getProspectId(), $requestObject->prospectCohortId);
			$prospectCohort->insert($pdo);

			// update reply
			$reply->message = "prospect created OK";
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
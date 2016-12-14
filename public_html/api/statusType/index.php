<?php

require_once(dirname(__DIR__,2) . "/php/classes/autoload.php");
require_once (dirname(__DIR__,2) . "/php/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\DdcAaaa\StatusType;


/**
 * api for the statusType class
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
	$statusTypeId = filter_input(INPUT_GET, "statusTypeId", FILTER_VALIDATE_INT);
	$statusTypeName = filter_input(INPUT_GET, "statusTypeName", FILTER_VALIDATE_INT);

	// handle GET request
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific statusType or statusTypes and update reply
		if(empty($statusTypeId) === false) {
			$statusType = StatusType::getStatusTypeByStatusTypeId($pdo, $statusTypeId);
			if($statusType !== null) {
				$reply->data = $statusType;
			}
		} else if(empty($statusTypeName) === false) {
			$statusTypes = StatusType::getStatusTypesByStatusTypeName($pdo, $statusTypeName);
			if($statusTypes !== null) {
				$reply->data = $statusTypes->toArray();
			}
		} else {
			$statusTypes = StatusType::getAllStatusTypes($pdo);
			if($statusTypes !== null) {
				$reply->data = $statusTypes->toArray();
			}
		}
	} else if($method === "POST") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//make sure statusType name is available (required field)
		if(empty($requestObject->statusTypeName) === true) {
			throw(new \InvalidArgumentException ("StatusType Name is missing.", 405));
		}

		//perform the actual post
		if($method === "POST") {

			// create new tweet and insert into the database
			$statusType = new StatusType($requestObject->statusTypeId, $requestObject->statusTypeName);
			$statusType->insert($pdo);

			// update reply
			$reply->message = "StatusType created OK";
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
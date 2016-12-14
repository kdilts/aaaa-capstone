<?php

require_once(dirname(__DIR__,2) . "/php/classes/autoload.php");
require_once (dirname(__DIR__,2) . "/php/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\DdcAaaa\NoteType;


/**
 * api for the NoteType class
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
	$noteTypeId = filter_input(INPUT_GET, "noteTypeId", FILTER_VALIDATE_INT);
	$noteTypeName = filter_input(INPUT_GET, "noteTypeName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	// handle GET request
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific bridge or all bridges and update reply
		if(empty($noteTypeId) === false) {
			$noteType = NoteType::getNoteTypeByNoteTypeId($pdo, $noteTypeId);
			if($noteType !== null) {
				$reply->data = $noteType;
			}
		} else if(empty($noteTypeName) === false) {
			$noteType = NoteType::getNoteTypeByNoteTypeName($pdo, $noteTypeName);
			if($noteType !== null) {
				$reply->data = $noteType;
			}
		} else {
			$noteTypes = NoteType::getAllNoteTypes($pdo);
			if($noteTypes !== null) {
				$reply->data = $noteTypes->toArray();
			}
		}
	} else if($method === "POST") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//make sure noteType name is available (required field)
		if(empty($requestObject->noteTypeName) === true) {
			throw(new \InvalidArgumentException ("NoteType Name is missing.", 405));
		}

		//perform the actual post
		if($method === "POST") {

			// create new noteType and insert into the database
			$noteType = new NoteType($requestObject->noteTypeId, $requestObject->noteTypeName);
			$noteType->insert($pdo);

			// update reply
			$reply->message = "NoteType created OK";
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
<?php

require_once(dirname(__DIR__,2) . "/php/classes/autoload.php");
require_once (dirname(__DIR__,2) . "/php/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\DdcAaaa\Note;


/**
 * api for the Note class
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
	$noteId = filter_input(INPUT_GET, "noteId", FILTER_VALIDATE_INT);
	$noteContent = filter_input(INPUT_GET, "noteContent", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$noteNoteTypeId = filter_input(INPUT_GET, "noteNoteTypeId", FILTER_VALIDATE_INT);
	$noteApplicationId = filter_input(INPUT_GET, "noteApplicationId", FILTER_VALIDATE_INT);
	$noteProspectId = filter_input(INPUT_GET, "noteProspectId", FILTER_VALIDATE_INT);
	$noteDateTime = filter_input(INPUT_GET, "noteDateTime", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$noteBridgeStaffId = filter_input(INPUT_GET, "noteBridgeStaffId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	$startDate = filter_input(INPUT_GET, "startDate", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$endDate = filter_input(INPUT_GET, "endDate", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);


	// handle GET request
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific note or all notes and update reply
		if(empty($noteId) === false) {
			echo "id" . PHP_EOL;
			$note = Note::getNoteByNoteId($pdo, $noteId);
			if($note !== null) {
				$reply->data = $note;
			}
		} else if(empty($noteApplicationId) === false) {
			echo "app" . PHP_EOL;
			$notes = Note::getNotesByNoteApplicationId($pdo, $noteApplicationId);
			if($notes !== null) {
				$reply->data = $notes->toArray();
			}
		} else if(empty($noteProspectId) === false) {
			echo "prospect" . PHP_EOL;
			$notes = Note::getNotesByNoteProspectId($pdo, $noteProspectId);
			if($notes !== null) {
				$reply->data = $notes->toArray();
			}
		}
		else if(empty($noteNoteTypeId) === false) {
			echo "note type" . PHP_EOL;
			$notes = Note::getNotesByNoteNoteTypeId($pdo, $noteNoteTypeId);
			if($notes !== null) {
				$reply->data = $notes->toArray();
			}
		} else if(empty($noteBridgeStaffId) === false) {
			echo "bridge" . PHP_EOL;
			$notes = Note::getNotesByNoteBridgeStaffId($pdo, $noteBridgeStaffId);
			if($notes !== null) {
				$reply->data = $notes->toArray();
			}
		} else if(empty($startDate) === false && empty($endDate) === false) {
			echo "dates" . PHP_EOL;
			$startDate = \DateTime::createFromFormat("Y-m-d H:i:s", $startDate);
			$endDate = \DateTime::createFromFormat("Y-m-d H:i:s", $endDate);
			$notes = Note::getNotesByNoteDateRange($pdo, $startDate, $endDate);
			if($notes !== null) {
				$reply->data = $notes->toArray();
			}
		} else {
			echo "all" . PHP_EOL;
			$notes = Note::getAllNotes($pdo);
			if($notes !== null) {
				$reply->data = $notes->toArray();
			}
		}
	} else if($method === "POST") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//make sure note content is available (required field)
		if(empty($requestObject->noteContent) === true) {
			throw(new \InvalidArgumentException ("note content is missing.", 405));
		}

		//  make sure note note type id is available (required field)
		if(empty($requestObject->noteNoteTypeId) === true) {
			throw(new \InvalidArgumentException ("note note type id is missing.", 405));
		}

		//make sure note datetime is available (required field)
		if(empty($requestObject->noteDateTime) === true) {
			throw(new \InvalidArgumentException ("note datetime is missing.", 405));
		}

		//  make sure note bridgestaffid is available (required field)
		if(empty($requestObject->noteBridgeStaffId) === true) {
			throw(new \InvalidArgumentException ("note bridge staff id is missing.", 405));
		}

		//perform the actual post
		if($method === "POST") {

			// create new tweet and insert into the database
			$note = new Note(
				$requestObject->noteId,
				$requestObject->noteContent,
				$requestObject->noteNoteTypeId,
				$requestObject->noteApplicationId,
				$requestObject->noteProspectId,
				\DateTime::createFromFormat("Y-m-d H:i:s", $requestObject->noteDateTime),
				$requestObject->noteBridgeStaffId
			);
			$note->insert($pdo);

			// update reply
			$reply->message = "Note created OK";
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
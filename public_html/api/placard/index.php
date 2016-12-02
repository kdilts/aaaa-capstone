<?php

require_once(dirname(__DIR__,2) . "/php/classes/autoload.php");
require_once (dirname(__DIR__,2) . "/php/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\DdcAaaa\Placard;


/**
 * api for the Bridge class
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
	$placardId = filter_input(INPUT_GET, "placardId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$placardStatusTypeId = filter_input(INPUT_GET, "placardStatusTypeId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$placardNumber = filter_input(INPUT_GET, "placardNumber", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	// handle GET request
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific bridge or all bridges and update reply
		if(empty($placardId) === false) {
			$placard = Placard::getPlacardByPlacardId($pdo, $placardId);
			if($placard !== null) {
				$reply->data = $placard;
			}
		} else if(empty($placardStatusTypeId) === false) {
			$placard = Placard::getPlacardsByPlacardStatusTypeId($pdo, $placardStatusTypeId);
			if($placard !== null) {
				$reply->data = $placard;
			}
		} else if(empty($placardNumber) === false) {
			$placard = Placard::getPlacardByPlacardNumber($pdo, $placardNumber);
			if($placard !== null) {
				$reply->data = $placard;
			}
		} else {
			$placards = Placard::getAllPlacards($pdo);
			if($placards !== null) {
				$reply->data = $placards->toArray();
			}
		}
	} else if($method === "POST") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//make sure bridge name is available (required field)
		if(empty($requestObject->placardId) === true) {
			throw(new \InvalidArgumentException ("Placard ID is missing.", 405));
		}

		//  make sure bridge user name is available (required field)
		if(empty($requestObject->placardStatusTypeId) === true) {
			throw(new \InvalidArgumentException ("Placard Status Type ID is missing.", 405));
		}

		//perform the actual post
		if($method === "POST") {

			// create new tweet and insert into the database
			$bridge = new Placard(null, $requestObject->placardStatusTypeId, $requestObject->placardNumber);
			$bridge->insert($pdo);

			// update reply
			$reply->message = "Placard created OK";
		}

	} else {
		throw (new Exception("Invalid HTTP request!", 405));
	}
	// update reply with exception information
} catch(Exception $exception) { // TODO shouldn't exceptions be ordered from most specific to least?
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
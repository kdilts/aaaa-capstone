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

	// ensure there's a user logged in
	if(empty($_SESSION["adUser"]) === true) {
		throw(new RuntimeException("user not logged in", 401));
	}

	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/ddcaaaa.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$placardId = filter_input(INPUT_GET, "placardId", FILTER_VALIDATE_INT);
	$placardStatusTypeId = filter_input(INPUT_GET, "placardStatusTypeId", FILTER_VALIDATE_INT);
	$placardNumber = filter_input(INPUT_GET, "placardNumber", FILTER_VALIDATE_INT);

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
	} else if($method === "POST" || $method === "PUT") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//  make sure placard status type id name is available (required field)
		if(empty($requestObject->placardStatusTypeId) === true) {
			throw(new \InvalidArgumentException ("Placard Status Type Id is missing.", 405));
		}

		//make sure placard number is available (required field)
		if(empty($requestObject->placardNumber) === true) {
			throw(new \InvalidArgumentException ("Placard Number is missing.", 405));
		}
		//perform the actual post
		if($method === "POST") {

			// create new tweet and insert into the database
			$placard = new Placard($requestObject->placardId, $requestObject->placardStatusTypeId, $requestObject->placardNumber);
			$placard->insert($pdo);

			// update reply
			$reply->message = "Placard created OK";
		}else if($method === "PUT"){
			// retrieve the placard to update
			$placard = Placard::getPlacardByPlacardId($pdo, $placardId);
			if($placard === null) {
				throw(new RuntimeException("Placard does not exist", 404));
			}

			// update all attributes
			$placard->setPlacardStatusTypeId($requestObject->placardStatusTypeId);
			$placard->setPlacardNumber($requestObject->placardNumber);

			$placard->update($pdo);

			// update reply
			$reply->message = "Placard updated OK";
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
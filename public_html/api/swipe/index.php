<?php

require_once(dirname(__DIR__,2) . "/php/classes/autoload.php");
require_once (dirname(__DIR__,2) . "/php/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\DdcAaaa\Swipe;


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
	$swipeId = filter_input(INPUT_GET, "swipeId", FILTER_VALIDATE_INT);
	$swipeStatusTypeId = filter_input(INPUT_GET, "swipeStatusTypeId", FILTER_VALIDATE_INT);
	$swipeNumber = filter_input(INPUT_GET, "swipeNumber", FILTER_VALIDATE_INT);

	// handle GET request
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific swipe or all swipes and update reply
		if(empty($swipeId) === false) {
			$swipe = Swipe::getSwipeBySwipeId($pdo, $swipeId);
			if($swipe !== null) {
				$reply->data = $swipe;
			}
		} else if(empty($swipeStatusTypeId) === false) {
			$swipe = Swipe::getSwipesBySwipeStatus($pdo, $swipeStatusTypeId);
			if($swipe !== null) {
				$reply->data = $swipe;
			}
		} else if(empty($swipeNumber) === false) {
			$swipe = Swipe::getSwipeBySwipeNumber($pdo, $swipeNumber);
			if($swipe !== null) {
				$reply->data = $swipe;
			}
		} else {
			$swipes = Swipe::getAllSwipes($pdo);
			if($swipes !== null) {
				$reply->data = $swipes->toArray();
			}
		}
	} else if($method === "POST" || $method === "PUT") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//make sure swipe number is available (required field)
		if(empty($requestObject->swipeNumber) === true) {
			throw(new \InvalidArgumentException ("swipe number is missing.", 405));
		}

		//  make sure swipe status type id is available (required field)
		if(empty($requestObject->swipeStatusTypeId) === true) {
			throw(new \InvalidArgumentException ("swipe Status Type Id is missing.", 405));
		}

		//perform the actual post
		if($method === "POST") {

			// create new tweet and insert into the database
			$swipe = new swipe($requestObject->swipeId, $requestObject->swipeStatusTypeId, $requestObject->swipeNumber);
			$swipe->insert($pdo);

			// update reply
			$reply->message = "swipe created OK";
		} else if($method === "PUT"){
			// retrieve the swipe to update
			$swipe = Swipe::getSwipeBySwipeId($pdo, $swipeId);
			if($swipe === null) {
				throw(new RuntimeException("Swipe does not exist", 404));
			}

			// update all attributes
			$swipe->setSwipeStatus($requestObject->swipeStatusTypeId);
			$swipe->setSwipeNumber($requestObject->swipeNumber);

			$swipe->update($pdo);

			// update reply
			$reply->message = "Swipe updated OK";
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
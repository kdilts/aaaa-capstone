<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\DdcAaaa\Bridge;


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
	$id = filter_input(INPUT_GET, "bridgeStaffId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$bridgeName = filter_input(INPUT_GET, "bridgeName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$bridgeUserName = filter_input(INPUT_GET, "bridgeUserName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	// handle GET request
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific bridge or all bridges and update reply
		if(empty($id) === false) {
			$bridge = Bridge::getBridgeByBridgeStaffId($pdo, $id);
			if($bridge !== null) {
				$reply->data = $bridge;
			}
		} else if(empty($bridgeName) === false) {
			$bridges = Bridge::getBridgeByBridgeName($pdo, $bridgeName);
			if($bridges !== null) {
				$reply->data = $bridges;
			}
		} else if(empty($bridgeUserName) === false) {
			$bridges = Bridge::getBridgeByBridgeUserName($pdo, $bridgeUserName);
			if($bridges !== null) {
				$reply->data = $bridges;
			}
		} else {
			$bridges = Bridge::getAllBridges($pdo);
			if($bridges !== null) {
				$reply->data = $bridges;
			}
		}
	} else if($method === "POST") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//make sure tweet content is available (required field)
		if(empty($requestObject->tweetContent) === true) {
			throw(new \InvalidArgumentException ("No content for Tweet.", 405));
		}

		// make sure tweet date is accurate (optional field)
		if(empty($requestObject->tweetDate) === true) {
			$requestObject->tweetDate = new \DateTime();
		}

		//  make sure profileId is available
		if(empty($requestObject->profileId) === true) {
			throw(new \InvalidArgumentException ("No Profile ID.", 405));
		}

		//perform the actual post
		if($method === "POST") {

			// create new tweet and insert into the database
			$tweet = new Tweet(null, $requestObject->profileId, $requestObject->tweetContent, null);
			$tweet->insert($pdo);

			// update reply
			$reply->message = "Tweet created OK";
		}

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
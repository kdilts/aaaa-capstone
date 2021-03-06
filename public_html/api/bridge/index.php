<?php

require_once(dirname(__DIR__,2) . "/php/classes/autoload.php");
require_once (dirname(__DIR__,2) . "/php/lib/xsrf.php");
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

// ensure there's a user logged in
//	if(empty($_SESSION["adUser"]) === true) {
//		throw(new RuntimeException("user not logged in", 401));
//	}

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
			$bridge = Bridge::getBridgeByBridgeName($pdo, $bridgeName);
			if($bridge !== null) {
				$reply->data = $bridge;
			}
		} else if(empty($bridgeUserName) === false) {
			$bridge = Bridge::getBridgeByBridgeUserName($pdo, $bridgeUserName);
			if($bridge !== null) {
				$reply->data = $bridge;
			}
		} else {
			$bridges = Bridge::getAllBridges($pdo);
			if($bridges !== null) {
				$reply->data = $bridges->toArray();
			}
		}
	} else if($method === "POST") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//make sure bridge name is available (required field)
		if(empty($requestObject->bridgeName) === true) {
			throw(new \InvalidArgumentException ("Bridge Name is missing.", 405));
		}

		//  make sure bridge user name is available (required field)
		if(empty($requestObject->bridgeUserName) === true) {
			throw(new \InvalidArgumentException ("Bridge User Name is missing.", 405));
		}

		//perform the actual post
		if($method === "POST") {

			// create new tweet and insert into the database
			$bridge = new Bridge($requestObject->bridgeId, $requestObject->bridgeName, $requestObject->bridgeUserName);
			$bridge->insert($pdo);

			// update reply
			$reply->message = "Bridge created OK";
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
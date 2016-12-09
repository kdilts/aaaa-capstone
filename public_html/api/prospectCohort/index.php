<?php

require_once(dirname(__DIR__,2) . "/php/classes/autoload.php");
require_once (dirname(__DIR__,2) . "/php/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\DdcAaaa\ProspectCohort;
use Edu\Cnm\DdcAaaa\JsonObjectStorage;
use Edu\Cnm\DdcAaaa\Cohort;
use Edu\Cnm\DdcAaaa\Prospect;

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
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/ddcaaaa.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$prospectCohortId = filter_input(INPUT_GET, "prospectCohortId", FILTER_VALIDATE_INT);
	$prospectCohortProspectId = filter_input(INPUT_GET, "prospectCohortProspectId", FILTER_VALIDATE_INT);
	$prospectCohortCohortId = filter_input(INPUT_GET, "prospectCohortCohortId", FILTER_VALIDATE_INT);
	// handle GET request
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific prospect or all prospects and update reply
		if(empty($prospectCohortId) === false) {
			$prospectCohort = ProspectCohort::getProspectCohortByProspectCohortId($pdo, $prospectCohortId);
			if($prospectCohort !== null) {
				$reply->data = $prospectCohort;
			}
		} else if(empty($prospectCohortProspectId) === false) {
			$prospectCohort = ProspectCohort::getProspectCohortsByProspectId($pdo, $prospectCohortProspectId);
			if($prospectCohort !== null) {
				$reply->data = $prospectCohort->toArray();
			}
		} else if(empty($prospectCohortCohortId) === false) {
			$prospectCohorts = ProspectCohort::getProspectCohortsByCohortId($pdo, $prospectCohortCohortId);
			if($prospectCohorts !== null) {
				$reply->data = $prospectCohorts->toArray();
			}
		} else {
			$prospectCohorts = ProspectCohort::getAllProspectCohorts($pdo);
			if($prospectCohorts !== null) {
				$storage = new JsonObjectStorage();

				for($i = 0; $i < count($prospectCohorts); $i++){
					$storage->attach(
						$prospectCohorts[$i],
						[
							Prospect::getProspectByProspectId($pdo, $prospectCohorts[$i]->getProspectCohortProspectId()),
							Cohort::getCohortByCohortId($pdo, $prospectCohorts[$i]->getProspectCohortCohortId())
						]
					);
				}

				$reply->data = $storage;
			}
		}

	}else if($method === "POST") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//make sure prospect ID is available (required field)
		if(empty($requestObject->prospectCohortProspectId) === true) {
			throw(new \InvalidArgumentException ("Prospect ID is missing.", 405));
		}

		//  make sure prospect Cohort Id is available (required field)
		if(empty($requestObject->prospectCohortCohortId) === true) {
			throw(new \InvalidArgumentException ("Prospect Cohort ID is missing.", 405));
		}
//TODO: do we need a prospectCohortId version of the above functions? ^^^^
		//perform the actual post
		if($method === "POST") {

			// create new tweet and insert into the database
			$prospectCohort = new ProspectCohort(
				$requestObject->prospectCohortId,
				$requestObject->prospectCohortProspectId,
				$requestObject->prospectCohortCohortId
			);
			$prospectCohort->insert($pdo);

			// update reply
			$reply->message = "prospect cohort created OK";
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
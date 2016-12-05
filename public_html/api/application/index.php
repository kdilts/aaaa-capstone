<?php

require_once(dirname(__DIR__, 2) . "/php/classes/autoload.php");
require_once(dirname(__DIR__, 2) . "/php/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\DdcAaaa\Application;


/**
 * api for the application class
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
	$applicationId = filter_input(INPUT_GET, "ApplicationId", FILTER_VALIDATE_INT);
	$applicationFirstName = filter_input(INPUT_GET, "applicationFirstName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$applicationLastName = filter_input(INPUT_GET, "applicationLastName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$applicationEmail = filter_input(INPUT_GET, "applicationEmail", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$applicationPhoneNumber = filter_input(INPUT_GET, "applicationPhoneNumber", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$applicationSource = filter_input(INPUT_GET, "applicationSource", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$applicationAboutYou = filter_input(INPUT_GET, "applicationAboutYou", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	$applicationHopeToAccomplish = filter_input(INPUT_GET, "applicationHopeToAccomplish", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	$applicationExperience = filter_input(INPUT_GET, "applicationExperience", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$applicationDateTime = filter_input(INPUT_GET, "applicationDateTime", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$applicationUtmCampaign = filter_input(INPUT_GET, "applicationUtmCampaign", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$applicationUtmMedium = filter_input(INPUT_GET, "applicationUtmMedium", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$applicationUtmSource = filter_input(INPUT_GET, "applicationUtmSource", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	$startDate = filter_input(INPUT_GET, "startDate", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$endDate = filter_input(INPUT_GET, "endDate", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	// handle GET request
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific application or all applications and update reply
		if(empty($id) === false) {
			$application = Application::getApplicationByApplicationId($pdo, $id);
			if($application !== null) {
				$reply->data = $application;
			}
		} else if(empty($applicationFirstName) === false) {
			$applications = Application::getApplicationsByApplicationName($pdo, $applicationFirstName);
			if($applications !== null) {
				$reply->data = $applications;
			}
		} else if(empty($applicationLastName) === false) {
			$applications = Application::getApplicationsByApplicationName($pdo, $applicationLastName);
			if($applications !== null) {
				$reply->data = $applications;
			}
		} else if(empty($applicationEmail) === false) {
			$applications = Application::getApplicationByApplicationEmail($pdo, $applicationEmail);
			if($applications !== null) {
				$reply->data = $applications;
			} else if(empty($applicationDateTime) === false) {
				$applications = Application::getApplicationsByApplicationDateRange($pdo, $startDate, $endDate);
				if($applications !== null) {
					$reply->data = $applications;
				} else {
					$applications = Application::getAllApplications($pdo);
					if($applications !== null) {
						$reply->data = $applications;
					}
				}
			}
		} else if($method === "POST") {

			verifyXsrf();
			$requestContent = file_get_contents("php://input");
			$requestObject = json_decode($requestContent);

			//make sure application name is available (required field)
			if(empty($requestObject->applicationFirstName) === true) {
				throw(new \InvalidArgumentException ("application First Name is missing.", 405));
			}

			//  make sure application user name is available (required field)
			if(empty($requestObject->applicationLastName) === true) {
				throw(new \InvalidArgumentException ("application Last Name is missing.", 405));
			}

			//perform the actual post
			if($method === "POST") {

				// create new application and insert into the database
				$application = new Application(null, $requestObject->applicationFirstName, $requestObject->applicationLastName, $requestObject->applicationEmail, $requestObject->applicationPhoneNumber, $requestObject->applicationSource, $requestObject->applicationAboutYou, $requestObject->applicationHopeToAccomplish, $requestObject->applicationExperience, $requestObject->applicationDateTime, $requestObject->applicationUtmCampaign, $requestObject->applcationUtmMedium, $requestObject->applicationUtmSource);
				$application->insert($pdo);

				// update reply
				$reply->message = "application created OK";
			}

		} else {
			throw (new Exception("Invalid HTTP request!", 405));
		}
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
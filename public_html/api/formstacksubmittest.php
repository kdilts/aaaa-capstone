<?php

namespace Edu\Cnm\DdcAaaa;
use Edu\Cnm\DdcAaaa\{ Application };
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

// get json string from post request and decode it
$requestContent = file_get_contents("php://input");
$decodeContent = json_decode($requestContent, true);

// get pdo object so that things can be inserted into the database
$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/ddcaaaa.ini");

// create application object from data decoded from post request and insert it into databse
$newApp = new Application(
	null,
	$decodeContent["46813104"]["first"], //first name
	$decodeContent["46813104"]["last"],//last name
	$decodeContent["46813105"], //email
	$decodeContent["46813106"],//phonenumber
	$decodeContent["46813107"],//source
	$decodeContent["46813110"],//about you
	$decodeContent["46813111"],//hopetoaccomplish
	$decodeContent["46813112"],//experience
	new \DateTime(),
	"empty",
	"empty",
	"empty3"
	//$decodeContent["Campaign Term"],
	//$decodeContent["Campaign Medium"],
	//$decodeContent["Campaign Source"]
);
$newApp->insert($pdo);

// create applicationCohort object(s) to associate this application with the cohort(s) the user selected and insert them into the database

		// full stack
if($decodeContent["46813108"] !== null) {
	if(is_array($decodeContent["46813108"])){
		foreach($decodeContent["46813108"] as &$cohortId){
			$newAppCohort = new ApplicationCohort(null, $newApp->getApplicationId(), $cohortId);
			$newAppCohort->insert($pdo);
		}
	}else{
		$newAppCohort = new ApplicationCohort(null, $newApp->getApplicationId(), $decodeContent["46813108"]);
		$newAppCohort->insert($pdo);
	}
}
		// .net
if($decodeContent["46813109"] !== null){
	if(is_array($decodeContent["46813109"])){
		foreach($decodeContent["46813109"] as &$cohortId){
			$newAppCohort = new ApplicationCohort(null, $newApp->getApplicationId(), $cohortId);
			$newAppCohort->insert($pdo);
		}
	}else{
		$newAppCohort = new ApplicationCohort(null, $newApp->getApplicationId(), $decodeContent["46813109"]);
		$newAppCohort->insert($pdo);
	}
}

// TODO throw exception if no cohorts are selected

//$decodeContentString = var_export($decodeContent, true);
//$fd = fopen("/tmp/posttest.txt", "w");
//fwrite($fd, $requestContent);
//fclose($fd);
//$fd = fopen("/tmp/posttest2.txt", "w");
//fwrite($fd, $decodeContentString);
//fclose($fd);
//$fd = fopen("/tmp/jsonerror.txt", "w");
//fwrite($fd, json_last_error_msg());
//fclose($fd);
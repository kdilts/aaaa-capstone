<?php


namespace Edu\Cnm\DdcAaaa;
use Edu\Cnm\DdcAaaa\{ Application };
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
$requestContent = file_get_contents("php://input");
$decodeContent = json_decode($requestContent, true);

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

	//grab the mySQL DataBase connection
//$config = readConfig("/etc/apache2/capstone-mysql/ddcaaaa.ini");
$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/ddcaaaa.ini");
//$this->connection = $this->createDefaultDBConnection($pdo, $config["database"]);

$newApp->insert($pdo);

if($decodeContent["4681308"] === null) {
	$newAppCohort = new ApplicationCohort(null, $newApp->getApplicationId(), $decodeContent["46813109"]);
}else{
	$newAppCohort = new ApplicationCohort(null, $newApp->getApplicationId(), $decodeContent["46813108"]);
}
$newAppCohort->insert($pdo);
$decodeContentString = var_export($decodeContent, true);
//
//$fd = fopen("/tmp/apptest.txt", "w");
//fwrite($fd, $requestContent);
//fclose($fd);

$fd = fopen("/tmp/posttest.txt", "w");
fwrite($fd, $requestContent);
fclose($fd);
$fd = fopen("/tmp/posttest2.txt", "w");
fwrite($fd, $decodeContentString);
fclose($fd);
$fd = fopen("/tmp/jsonerror.txt", "w");
fwrite($fd, json_last_error_msg());
fclose($fd);
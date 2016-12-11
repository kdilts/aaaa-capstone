<?php

namespace Edu\Cnm\DdcAaaa;
use Edu\Cnm\DdcAaaa\Note;
require_once(dirname(__DIR__) . "/php/classes/autoload.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

$requestContent = file_get_contents("php://input");
$noteContent = $requestContent['noteContent'];
$noteTypeId = 2; //htmlspecialchars($_POST['noteTypeId']);
$noteBridgeStaffId = 111222333; //htmlspecialchars($_POST['noteBridgeStaffId']);
$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/ddcaaaa.ini");


$fd = fopen("/tmp/posttest.txt", "w");
fwrite($fd, $requestContent);
fclose($fd);
// create Note object from data decoded from post request and insert it into databse
$newNote = new Note(
	null,
	$noteContent,
	$noteTypeId,
	1,
	null,
	new \DateTime(),
	$noteBridgeStaffId
	);
$newNote->insert($pdo);

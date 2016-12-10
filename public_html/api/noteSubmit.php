<?php

namespace Edu\Cnm\DdcAaaa;
use Edu\Cnm\DdcAaaa\{ Note };
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

$noteContent = $_POST['noteContent'];
$noteTypeId = 2; //htmlspecialchars($_POST['noteTypeId']);
$noteBridgeStaffId = 111222333; //htmlspecialchars($_POST['noteBridgeStaffId']);
$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/ddcaaaa.ini");

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

$fd = fopen("/tmp/posttest.txt", "w");
fwrite($fd, var_export($_POST));
fclose($fd);

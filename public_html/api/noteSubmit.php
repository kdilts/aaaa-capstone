<?php

namespace Edu\Cnm\DdcAaaa;
use Edu\Cnm\DdcAaaa\{ Note };
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

$noteContent = htmlspecialchars($_POST['noteContent']);
$noteTypeId = htmlspecialchars($_POST['noteTypeId']);
$noteBridgeStaffId = htmlspecialchars($_POST['noteBridgeStaffId']);
$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/ddcaaaa.ini");

// create Note object from data decoded from post request and insert it into databse
$newNote = new Note(
	null,
	$noteContent,
	$noteTypeId,
	null,
	null,
	new \DateTime(),
	$noteBridgeStaffId
	);
$newNote->insert($pdo);


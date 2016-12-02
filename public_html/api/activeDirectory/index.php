<?php
// author: Dylan Mcdonald
// shamelessly copied at Dylan's behest

require_once("encrypted-config.php");
require_once("xsrf.php");
require_once(dirname(__DIR__, 3) . "/vendor/autoload.php");

// prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->message = null;

try {
	// verify XSRF token defend against operator error
	if(session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	verifyXsrf();
	$requestContent = file_get_contents("php://input");
	$requestObject = json_decode($requestContent);

	// filter the username, but let the password be because filter_var() can change the password inadvertently
	$username = strtolower(filter_var($requestObject->username, FILTER_SANITIZE_STRING));
	$password = $requestObject->password;

	// read the active directory configuration
	$config = readConfig("/etc/apache2/capstone-mysql/ddcaaaa.ini");
	$adconfig = json_decode($config["adconfig"], true);

	// setup active directory connection
	$provider = new \Adldap\Connections\Provider($adconfig);
	$activeDirectory = new \Adldap\Adldap();
	$activeDirectory->addProvider("default", $provider);
	$activeDirectory->connect("default");

	// connect & bind to active directory connection
	if($provider->auth()->attempt($username, $password, true)) {
		$search = $provider->search();
		$search->select(["displayname", "employeeid"]);
		$result = $search->findBy("samaccountname", $username);
		$_SESSION["adUser"] = ["studentId" => $result->getEmployeeId(), "fullName" => $result->getDisplayName(), "loginTime" => time(), "username" => $username];
	} else {
		throw(new RuntimeException("invalid username/password", 401));
	}
	$reply->message = "login successful";
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}

header("Content-type: application/json");
echo json_encode($reply);

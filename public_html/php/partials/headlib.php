<?php
require_once(dirname(__DIR__) . "/classes/autoload.php");
require_once(dirname(__DIR__) . "/lib/xsrf.php");
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}
setXsrfCookie();
?>
<!DOCTYPE html>
<html lang="" ng-app="FlekApp">
	<head>
		<!-- The 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<!-- set base for relative links - to enable pretty URLs -->
		<base href="/">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
				integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
				crossorigin="anonymous">

		<!-- FontAwesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<!-- Our Custom CSS -->
		<link rel="stylesheet" href="css/style.css" type="text/css">


		<!---------------------- old ------------------->


		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<script data-require="jquery@2.2.0" data-semver="2.2.0"
				  src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link data-require="bootstrap@3.3.6" data-semver="3.3.6" rel="stylesheet"
				href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
		<script data-require="bootstrap@3.3.6" data-semver="3.3.6"
				  src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link href="CustomStyles.css" rel="stylesheet"/>
		<link rel="stylesheet" href="style.css"/>
		<script src="script.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

		<script; src="bootstrap/js/bootstrap.min.js"></script>
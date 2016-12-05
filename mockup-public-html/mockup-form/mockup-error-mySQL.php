<?php
/**
 * form for note
 */

$db_host="localhost";
$db_username="root";
$db_password="";
$db_name="";

$db_connect=mySQL_connect($db_host,$db_username,$db_password,$db_name);

// Check connection

if(mySQL_connect_error())
{
	echo "failed to connect to MySQL:" mysql_connect_error() or die();
}
echo "connection susccessful";
?>
<?php
// The global $_POST variable allows you to access the data sent with the POST method
// To access the data sent with the GET method, you can use $_GET
//$say = htmlspecialchars($_POST['say']);
//$to  = htmlspecialchars($_POST['to']);

$requestContent = file_get_contents("php://input");
// Retrieves the JSON package that the front end sent, and stores it in $requestContent. Here we are using file_get_contents("php://input") to get the request from the front end. file_get_contents() is a PHP function that reads a file into a string. The argument for the function, here, is "php://input". This is a read only stream that allows raw data to be read from the front end request which is, in this case, a JSON package.


//$requestObject = json_decode($requestContent);

$fd = fopen("/tmp/ASTM-D4236.txt", "w");
fwrite($fd, $requestContent);
fclose($fd);
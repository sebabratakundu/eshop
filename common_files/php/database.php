<?php

// define database constant
define("HOST","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DB","eshop");

$db = new mysqli(HOST,USERNAME,PASSWORD,DB);

if($db -> connect_error){
	die("database not connected");
}

// define constants

define("ROOT",$_SERVER["SERVER_NAME"]);


?>
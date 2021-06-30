<?php
	require_once("../../common_files/php/database.php");

	$username = base64_decode($_COOKIE["_ua_"]);

	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$email  = $_POST["email"];
	$mobile = $_POST["mobile"];
	$address = $_POST["address"];
	$pincode = $_POST["pincode"];
	$state = $_POST["state"];
	$country = $_POST["country"];

	$update_info = "UPDATE users SET firstname='$firstname',lastname='$lastname',email='$email',mobile='$mobile',address='$address',pincode='$pincode',state='$state',country='$country'";

	if($db -> query($update_info)){
		echo "update success";
	}
	else{
		echo "update failed";
	}

?>
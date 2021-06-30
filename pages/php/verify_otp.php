<?php
	require_once("../../common_files/php/database.php");

	session_start();
	$original_otp = $_SESSION["otp"];
	$typed_otp = $_POST["otp"];
	$email = $_POST["email"];

	if($original_otp == $typed_otp){
		unset($_SESSION["otp"]);
		$update_status = "UPDATE users SET status = 'active' WHERE email = '$email'";
		if($db -> query($update_status)){
			echo "update success";
		}
		else{
			echo "update failed";
		}
	}
	else{
		echo "match failed";
	}

?>
<?php
	require_once("../../common_files/php/database.php");

	session_start();
	$original_otp = $_SESSION["otp"];
	$typed_otp = md5($_POST["v_code"]);
	if($original_otp == $typed_otp){
		unset($_SESSION["otp"]);
		echo "success";
	}
	else{
		echo "match failed";
	}

?>
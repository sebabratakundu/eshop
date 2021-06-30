<?php
	require_once("../../common_files/php/database.php");

	$username = base64_decode($_COOKIE["_ua_"]);
	$old_pass = md5($_POST["old-pass"]);
	$new_pass = md5($_POST["new-pass"]);

	$check_old_pass = "SELECT * FROM users WHERE email='$username' AND password='$old_pass'";
	$check_response = $db -> query($check_old_pass);
	if($check_response -> num_rows != 0){
		$update_password = "UPDATE users SET password='$new_pass' WHERE email='$username'";
		if($db -> query($update_password)){
			echo "update success";
		}
		else{
			echo "update failed";
		}
	}
	else{
		echo "old password not matched";
	}

?>
<?php
	require_once("../../common_files/php/database.php");

	$email = trim($_POST["username"]);
	$email = mysqli_real_escape_string($db,$email);
	$email = strip_tags($email);

	$password = trim(($_POST["password"]));
	$password = mysqli_real_escape_string($db,$password);
	$password = strip_tags($password);
	$password = md5($password);

	$check_user = "SELECT * FROM users WHERE email = '$email'";
	$user_response = $db -> query($check_user);
	if($user_response -> num_rows != 0){
			$user_data = $user_response -> fetch_assoc();
			$username = $user_data["email"];
			$real_password = $user_data["password"];
			if($username == $email && $real_password == $password){
				$status = $user_data["status"];
				if($status == "pending"){
					echo "pending";
				}	
				else{
					session_start();
					$_SESSION["username"] = $email;
					$encoded_username = base64_encode($email);
					$cookie_time = time()+(60*60*24*365);
					setcookie("_ua_",$encoded_username,$cookie_time,"/");
					echo "login success";
				}
			}
			else{
				echo "password not match";
			}
	}
	else{
		echo "user not found !!";
	}

?>
<?php
	require_once("../../common_files/php/database.php");

	$firstname = trim($_POST["firstname"]);
	$firstname = mysqli_real_escape_string($db,$firstname);
	$firstname = strip_tags($firstname);

	$lastname = trim($_POST["lastname"]);
	$lastname = mysqli_real_escape_string($db,$lastname);
	$lastname = strip_tags($lastname);

	$email = trim($_POST["username"]);
	$email = mysqli_real_escape_string($db,$email);
	$email = strip_tags($email);

	$password = trim($_POST["password"]);
	$password = mysqli_real_escape_string($db,$password);
	$password = strip_tags($password);
	$password = md5($password);

	$mobile = trim($_POST["mobile"]);
	$mobile = mysqli_real_escape_string($db,$mobile);
	$mobile = strip_tags($mobile);

	$address = trim($_POST["address"]);
	$address = mysqli_real_escape_string($db,$address);
	$address = strip_tags($address);

	$state = trim($_POST["state"]);
	$state = mysqli_real_escape_string($db,$state);
	$state = strip_tags($state);

	$country = trim($_POST["country"]);
	$country = mysqli_real_escape_string($db,$country);
	$country = strip_tags($country);

	$pincode = trim($_POST["pincode"]);
	$pincode = mysqli_real_escape_string($db,$pincode);
	$pincode = strip_tags($pincode);

	$check_table = "SELECT * FROM users";
	$check_response = $db -> query($check_table);
	if($check_response){
		$insert_data = "INSERT INTO users(firstname,lastname,email,mobile,password,address,state,country,pincode)
			VALUES('$firstname','$lastname','$email','$mobile','$password','$address','$state','$country','$pincode')";

			if($db -> query($insert_data)){
				require("sendsms.php");
			}
			else{
				echo "failed";
			}
	}
	else{
		$create_table = "CREATE TABLE users(
		id INT(11) NOT NULL AUTO_INCREMENT,
		firstname VARCHAR(50),
		lastname VARCHAR(50),
		email VARCHAR(100),
		mobile VARCHAR(20),
		password VARCHAR(150),
		address VARCHAR(250),
		state VARCHAR(150),
		pincode INT(11),
		country VARCHAR(150),
		status VARCHAR(20) DEFAULT 'pending',
		registration_date DATETIME DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY(id)
		)";

		if($db -> query($create_table)){
			$insert_data = "INSERT INTO users(firstname,lastname,email,mobile,password,address,state,pincode,country)
			VALUES('$firstname','$lastname','$email','$mobile','$password','$address','$state','$pincode','$country')";

			if($db -> query($insert_data)){
				//require("sendsms.php");
				echo "success";
			}
			else{
				echo "failed";
			}
		}
		else{
			echo "table not created";
		}
	}

?>
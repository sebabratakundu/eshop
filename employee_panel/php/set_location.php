<?php
	require_once("../../common_files/php/database.php");

	$country = $_POST["country"];
	$state = $_POST["state"];
	$city = $_POST["city"];
	$pincode = $_POST["pincode"];
	$delivery_msg = $_POST["delivery-text"];
	$payment_mode = $_POST["payment-mode"];

	$check_table = "SELECT * FROM delivery_location";
	$table_response = $db -> query($check_table);
	if($table_response){
		$insert_data = "INSERT INTO delivery_location(country,state,city,pincode,delivery_days,payment_mode)
			VALUES('$country','$state','$city','$pincode','$delivery_msg','$payment_mode')";

			if($db -> query($insert_data)){
				echo "success";
			}
			else{
				echo "data not inserted";
			}
	}
	else{
		$create_table = "CREATE TABLE delivery_location(
		id INT(11) NOT NULL AUTO_INCREMENT,
		country VARCHAR(150),
		state VARCHAR(150),
		city VARCHAR(150),
		pincode INT(12),
		delivery_days VARCHAR(250),
		payment_mode VARCHAR(50),
		PRIMARY KEY(id)
		)";

		if($db -> query($create_table)){
			$insert_data = "INSERT INTO delivery_location(country,state,city,pincode,delivery_days,payment_mode)
			VALUES('$country','$state','$city','$pincode','$delivery_msg','$payment_mode')";

			if($db -> query($insert_data)){
				echo "success";
			}
			else{
				echo "data not inserted";
			}
		}
		else{
			echo "table not created";
		}
	}

?>
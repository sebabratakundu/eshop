<?php
	require_once("../../common_files/php/database.php");

	$email = $_POST["email"];
	$date = date("Y-m-d");
	$check_table = "SELECT * FROM subscriber";
	$check_response = $db -> query($check_table);
	if($check_response){
		$insert_data = "INSERT INTO subscriber(email,subscribe_date)
		VALUES('$email','$date')";

		if($db -> query($insert_data)){
			echo "success";
		}	
		else{
			echo "data not inserted";
		}
	}
	else{
		$create_table = "CREATE TABLE subscriber(
		id INT(11) NOT NULL AUTO_INCREMENT,
		email VARCHAR(200),
		subscribe_date DATE,
		PRIMARY KEY(id)
		)";

		if($db -> query($create_table)){
			$insert_data = "INSERT INTO subscriber(email,subscribe_date)
			VALUES('$email','$date')";

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
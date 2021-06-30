<?php
require("../../common_files/php/database.php");

$category = $_POST["category"];
$brand_obj = json_decode($_POST["brands_data"]);
$length = count($brand_obj);
$massage = "";
$i;

$check_table = "SELECT * FROM brands";

if($db -> query($check_table)){
	for($i=0;$i<$length;$i++){
		$insert_data = "INSERT INTO brands(category,brand_name)
		VALUES('$category','$brand_obj[$i]')
		";

		if($db -> query($insert_data)){
			if(mkdir("../../stocks/".$category."/".$brand_obj[$i])){
				$massage = "success";
			}
		}
		else{
			$massage = "data not stored in the database";
		}
	}

	echo $massage;
}
else{
	$create_table = "CREATE TABLE brands(
	id INT(11) NOT NULL AUTO_INCREMENT,
	category VARCHAR(50),
	brand_name VARCHAR(50),
	PRIMARY KEY(id)
	)";

	if($db -> query($create_table)){
		for($i=0;$i<$length;$i++){
			$insert_data = "INSERT INTO brands(category,brand_name)
			VALUES('$category','$brand_obj[$i]')
			";

			if($db -> query($insert_data)){
				if(mkdir("../../stocks/".$category."/".$brand_obj[$i])){
					$massage = "success";
				}
			}
			else{
				$massage = "data not stored in the database";
			}
		}

		echo $massage;
	}
	else{
		echo "table not created";
	}
}

?>
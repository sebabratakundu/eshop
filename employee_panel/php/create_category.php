<?php

require_once("../../common_files/php/database.php");

$category_data = json_decode($_POST['category_data']);
$length = count($category_data);
$i;
$massage;
$check_table = "SELECT * FROM category";
if($db -> query($check_table)){
		for ($i=0; $i <$length ; $i++) { 
			$insert_data = "INSERT INTO category(category_name)
			VALUES('$category_data[$i]')
			";
			if($db -> query($insert_data)){
				if(mkdir("../../stocks/".$category_data[$i])){
					$massage = "success";
				}
			}
			else{
				$massage = "not inserted";
			}
		}

		echo $massage;
}
else{
	$create_table = "CREATE TABLE category(
	id INT(11) NOT NULL AUTO_INCREMENT,
	category_name VARCHAR(50),
	PRIMARY KEY(id)
	)";

	if($db -> query($create_table)){
		for ($i=0; $i <$length ; $i++) { 
			$insert_data = "INSERT INTO category(category_name)
			VALUES('$category_data[$i]')
			";
			if($db -> query($insert_data)){
				if(mkdir("../../stocks/".$category_data[$i])){
					$massage = "success";
				}
			}
			else{
				$massage = "not inserted";
			}
		}

		echo $massage;
	}
	else{
		echo "something went worng";
	}
}

?>
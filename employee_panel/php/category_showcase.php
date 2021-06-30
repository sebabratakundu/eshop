<?php
	require_once("../../common_files/php/database.php");

	$file = "";
	$photo_binary_data = "";

	if($_FILES){
		$file = $_FILES["photo"];
		$photo_binary_data = addslashes(file_get_contents($file["tmp_name"]));
	}
	else{
		$file = "";
		$photo_binary_data = "";
	}

	$text = $_POST["text"];
	$image_pos = $_POST["photo_pos"];

	$check_table = "SELECT * FROM category_showcase";
	$check_response = $db -> query($check_table);
	if($check_response){
		$check_direction = "SELECT * FROM category_showcase WHERE direction = '$image_pos'";
		$direction_response = $db -> query($check_direction);
		if($direction_response -> num_rows != 0){
			if($file != ""){
				$update_data = "UPDATE category_showcase SET image = '$photo_binary_data',lable = '$text' WHERE direction = '$image_pos'";
				if($db -> query($update_data)){
					echo "update success";
				}
				else{
					echo "update failed";
				}
			}
			else{
				$update_data = "UPDATE category_showcase SET lable = '$text' WHERE direction = '$image_pos'";
				if($db -> query($update_data)){
					echo "update success";
				}
				else{
					echo "update failed";
				}
			}
		}
		else{
			$insert_data = "INSERT INTO category_showcase(image,lable,direction)
			VALUES('$photo_binary_data','$text','$image_pos')";

			if($db -> query($insert_data)){
				echo "success";
			}
			else{
				echo "failed to insert data";
			}
		}
	}
	else{
		$create_table = "CREATE TABLE category_showcase(
		id INT(11) NOT NULL AUTO_INCREMENT,
		image MEDIUMBLOB,
		lable VARCHAR(100),
		direction VARCHAR(100),
		PRIMARY KEY(id)
		)";

		if($db -> query($create_table)){
			$insert_data = "INSERT INTO category_showcase(image,lable,direction)
			VALUES('$photo_binary_data','$text','$image_pos')";

			if($db -> query($insert_data)){
				echo "success";
			}
			else{
				echo "failed to insert data";
			}
		}
		else{
			echo "failed to create table";
		}
	}

?>
<?php
	require_once("../../common_files/php/database.php");

	$p_keyword = $_POST["p-keyword"];
	$s_keyword = $_POST["s-keyword"];

	$check_table = "SELECT * FROM keyword WHERE p_keyword='$p_keyword'";
	$table_response = $db -> query($check_table);
	if($table_response){
		if($table_response -> num_rows !=0){
			$get_stored_data = $table_response -> fetch_assoc();
			$secondary_keywords = $get_stored_data["s_keyword"];
			$new_s_keywords = $secondary_keywords." ".$s_keyword;

			$update_data = "UPDATE keyword SET s_keyword='$new_s_keywords' WHERE p_keyword='$p_keyword'";
			if($db -> query($update_data)){
				echo "success";
			}
			else{
				echo "update failed";
			}
		}
		else{
			$insert_data = "INSERT INTO keyword(p_keyword,s_keyword)
			VALUES('$p_keyword','$s_keyword')";

			if($db -> query($insert_data)){
				echo "success";
			}
			else{
				echo "data cannot stored";
			}
		}
	}
	else{
		$create_table = "CREATE TABLE keyword(
		id INT(11) NOT NULL AUTO_INCREMENT,
		p_keyword VARCHAR(200),
		s_keyword MEDIUMTEXT,
		PRIMARY KEY(id)
		)";

		if($db -> query($create_table)){
			$insert_data = "INSERT INTO keyword(p_keyword,s_keyword)
			VALUES('$p_keyword','$s_keyword')";

			if($db -> query($insert_data)){
				echo "success";
			}
			else{
				echo "data cannot stored";
			}
		}
		else{
			echo "Please contact the developer";
		}
	}

?>
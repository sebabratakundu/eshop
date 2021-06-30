<?php
	require_once("../../common_files/php/database.php");

	$p_keyword = $_POST["p_keyword"];

	$get_s_keyword = "SELECT * FROM keyword WHERE p_keyword='$p_keyword'";
	$s_keyword_response = $db -> query($get_s_keyword);
	if($s_keyword_response){
		if($s_keyword_response -> num_rows != 0){
			$s_keyword_data = $s_keyword_response -> fetch_assoc();
			echo $s_keyword_data["s_keyword"];
		}
	}

?>
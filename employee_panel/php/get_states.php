<?php
	require_once("../../common_files/php/database.php");

	$country_id = $_POST["country_id"];
	$states_array = [];

	$get_states = "SELECT * FROM states WHERE country_id='$country_id'";
	$states_response = $db -> query($get_states);
	if($states_response){
		while($states = $states_response -> fetch_assoc()){
			array_push($states_array, $states);
		}

		echo json_encode($states_array);
	}


?>
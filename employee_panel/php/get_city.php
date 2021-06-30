<?php
	require_once("../../common_files/php/database.php");

	$state_id = $_POST["state_id"];
	$city_array = [];

	$get_cities = "SELECT * FROM cities WHERE state_id='$state_id'";
	$cities_response = $db -> query($get_cities);
	if($cities_response){
		while($cities = $cities_response -> fetch_assoc()){
			array_push($city_array, $cities);
		}

		echo json_encode($city_array);
	}


?>
<?php
	require("../../common_files/php/database.php");

	$check_table = "SELECT brand_name,domain_name,email,facebook_url,twitter_url,address,phone,about_us,privacy_policy,cookie_policy,terms_policy FROM branding";
	$data = [];
	$check_response = $db -> query($check_table);
	if($check_response){
		$table_data = $check_response -> fetch_assoc();
		array_push($data, $table_data);
		echo json_encode($data);
	}
	else{
		echo "no data";
	}

?>
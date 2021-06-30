<?php
	require_once("../../common_files/php/database.php");

	$pincode = $_POST["pincode"];

	$get_pincode = "SELECT * FROM delivery_location WHERE pincode = '$pincode'";
	$pincode_response = $db -> query($get_pincode);
	if($pincode_response -> num_rows != 0){
		$delivery_data = $pincode_response -> fetch_assoc();
		echo $delivery_data["delivery_days"];
	}
	else{
		echo "Delivery not available in your pincode !";
	}

?>
<?php
	$email = $_POST["email"];
	$code = rand(4590,23649);

	$check_mail = mail($email, "Subcription to ESHOP", "Your varification code is : ".$code);
	if($check_mail){
		$data = ["success",trim($code)];

		echo json_encode($data);
	}
	else{
		echo "email not send";
	}

?>
<?php
	require_once("../../common_files/php/database.php");

	$get_new_product = "SELECT * FROM product ORDER BY id DESC LIMIT 1";
	$new_product_response = $db -> query($get_new_product);
	if($new_product_response){
		$new_product_data = $new_product_response -> fetch_assoc();
		$product_id = $new_product_data["id"];
		$product_title = $new_product_data["product_name"];
		$brand = $new_product_data["brand"];
		$description = $new_product_data["description"];
		$price = $new_product_data["price"];
		$pic = $new_product_data["thumb_pic"];

		//send notification

		$get_subscriber = "SELECT * FROM subscriber";
		$subscriber_response = $db -> query($get_subscriber);
		$massage = "";
		if($subscriber_response){
			while($subscribers = $subscriber_response -> fetch_assoc()){
				$check_mail = mail($subscribers["email"], "New Product Launch at ESHOP.COM",$product_title);
				if($db -> query($check_mail)){
					$massage = "success";
				}
				else{
					$massage = "failed";
				}
			}

			echo $massage;
		}
	}


?>
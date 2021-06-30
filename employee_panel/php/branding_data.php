<?php
	require("../../common_files/php/database.php");

	$file = $_FILES["upload-logo"];
	$location = "";
	$logo_binary_data = "";
	if($file["name"] == ""){
		$location = "";
		$logo_binary_data = "";
	}
	else{
		$location = $file["tmp_name"];
		$logo_binary_data = addslashes(file_get_contents($location));
	}
	$brand_name = $_POST["brand-name"];
	$domain_name = $_POST["domain-name"];
	$email = $_POST["email"];
	$facebook = $_POST["facebook"];
	$twitter = $_POST["twitter"];
	$address = addslashes($_POST["address"]);
	$phone = $_POST["phone"];
	$about_us = addslashes($_POST["about-us"]);
	$privacy = addslashes($_POST["privacy-policy"]);
	$cookie = addslashes($_POST["cookies-policy"]);
	$terms = addslashes($_POST["terms-and-conditions"]);

	$check_branding_table = "SELECT * FROM branding";
	$check_response = $db -> query($check_branding_table);
	if($check_response){
		if($logo_binary_data == ""){
			$update_data = "UPDATE branding SET brand_name = '$brand_name',domain_name = '$domain_name',email = '$email',facebook_url = '$facebook',twitter_url = '$twitter',address = '$address',phone = '$phone',about_us = '$about_us',privacy_policy = '$privacy',cookie_policy = '$cookie',terms_policy = '$terms'";
			if($db -> query($update_data)){
				echo "update success";
			}
			else{
				echo "update failed";
			}
		}
		else{
			$update_data = "UPDATE branding SET brand_name = '$brand_name',brand_logo = '$logo_binary_data',domain_name = '$domain_name',email = '$email',facebook_url = '$facebook',twitter_url = '$twitter',address = '$address',phone = '$phone',about_us = '$about_us',privacy_policy = '$privacy',cookie_policy = '$cookie',terms_policy = '$terms'";
			if($db -> query($update_data)){
				echo "update success";
			}
			else{
				echo "update failed";
			}
		}
	}
	else{
		$create_table = "CREATE TABLE branding(
		id INT(11) NOT NULL AUTO_INCREMENT,
		brand_name VARCHAR(50),
		brand_logo MEDIUMBLOB,
		domain_name VARCHAR(100),
		email VARCHAR(100),
		facebook_url VARCHAR(100),
		twitter_url VARCHAR(100),
		address MEDIUMTEXT,
		phone INT(12),
		about_us MEDIUMTEXT,
		privacy_policy MEDIUMTEXT,
		cookie_policy MEDIUMTEXT,
		terms_policy MEDIUMTEXT,
		PRIMARY KEY(id)
		)";

		if($db -> query($create_table)){
			$insert_data = "INSERT INTO branding(brand_name,brand_logo,domain_name,email,facebook_url,twitter_url,address,phone,about_us,privacy_policy,cookie_policy,terms_policy)
			VALUES('$brand_name','$logo_binary_data','$domain_name','$email','$facebook','$twitter','$address','$phone','$about_us','$privacy','$cookie','$terms')";

			if($db -> query($insert_data)){
				echo "success";
			}
			else{
				echo "data cannot be updated into database";
			}
		}
		else{
			echo "table not created";
		}
	}

?>
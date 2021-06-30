<?php
	require_once("../../common_files/php/database.php");

	$rating = $_POST["rating"];
	$product_id = $_POST["product_id"];
	$comment = $_POST["comment"];
	$file = $_FILES["photo"];
	$photo_binary = addslashes(file_get_contents($file["tmp_name"]));
	$username = base64_decode($_COOKIE["_ua_"]);

	$update_rating = "UPDATE purchase SET rating='$rating',comment='$comment',picture='$photo_binary' WHERE email='$username' AND product_id='$product_id'";
	if($db -> query($update_rating)){
		echo "update success";
	}
	else{
		echo "update failed";
	}

?>
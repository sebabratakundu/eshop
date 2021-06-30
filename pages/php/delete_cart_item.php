<?php
	require_once("../../common_files/php/database.php");

	$product_id = $_POST["product_id"];
	$username = base64_decode($_COOKIE["_ua_"]);
	$delete_product = "DELETE FROM cart WHERE product_id='$product_id' AND username='$username'";
	if($db -> query($delete_product)){
		echo "delete success";
	}
	else{
		echo "delete failed";
	}

?>
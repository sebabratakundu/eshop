<?php
	require_once("../../common_files/php/database.php");

	$brand = $_POST["brand"];
	$all_products = [];

	$get_product = "SELECT * FROM product WHERE brand='$brand'";
	$product_response = $db -> query($get_product);
	if($product_response){
		if($product_response -> num_rows != 0){
			while($product_data = $product_response -> fetch_assoc()){
				array_push($all_products, $product_data);
			}

			echo json_encode($all_products);
		}
		else{
			echo "No such product avilable in this brand";
		}
	}


?>
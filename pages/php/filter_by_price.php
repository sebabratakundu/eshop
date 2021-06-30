<?php
	require_once("../../common_files/php/database.php");

	$min_price = $_POST["min_price"];
	$max_price = $_POST["max_price"];
	$category = $_POST["category"];
	$products = [];

	$get_product = "SELECT * FROM product WHERE category = '$category' AND price BETWEEN $min_price AND $max_price";
	$product_response = $db -> query($get_product);

	if($product_response){
		if($product_response -> num_rows != 0){
			while($product_data = $product_response -> fetch_assoc()){
				array_push($products, $product_data);
			}

			echo json_encode($products);
		}
		else{
			echo "No product avilable";
		}
	}	
?>
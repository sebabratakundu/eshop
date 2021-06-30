<?php
	require_once("../../common_files/php/database.php");

	$cat_name = $_POST["cat_name"];
	$brand_name = $_POST["brand_name"];
	$all_products = [];
	if($brand_name != "all"){
		$get_products = "SELECT * FROM product WHERE category = '$cat_name' AND brand = '$brand_name'";
		$product_response = $db -> query($get_products);
		if($product_response){
			if($product_response -> num_rows != 0){
				while($products = $product_response -> fetch_assoc()){
					array_push($all_products, $products);
				}

				echo json_encode($all_products);
			}
			else{
				echo "No product avilable";
			}
		}
	}
	else{
		$get_products = "SELECT * FROM product WHERE category = '$cat_name'";
		$product_response = $db -> query($get_products);
		if($product_response){
			if($product_response -> num_rows != 0){
				while($products = $product_response -> fetch_assoc()){
					array_push($all_products, $products);
				}

				echo json_encode($all_products);
			}
			else{
				echo "No product avilable";
			}
		}
	}

?>
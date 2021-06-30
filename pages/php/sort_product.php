<?php
	require_once("../../common_files/php/database.php");

	if(empty($_COOKIE["_ua_"])){
		header("Location:http://localhost/bom/php/eshop/signin.php");
		exit;
	}

	$username = base64_decode($_COOKIE["_ua_"]);
	$cat_name = $_POST["cat_name"];
	$brand_name = $_POST["brand_name"];
	$sort_val = $_POST["sort_val"];
	$products = [];

	if($brand_name == "all"){
		if($sort_val == "high"){
			$get_product = "SELECT * FROM product WHERE category='$cat_name' ORDER BY price DESC";
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
		}

		else if($sort_val == "low"){
			$get_product = "SELECT * FROM product WHERE category='$cat_name' ORDER BY price ASC";
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
		}

		else if($sort_val == "recomended"){
			$get_product = "SELECT * FROM product WHERE category='$cat_name'";
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
		}

		else if($sort_val == "new"){
			$get_product = "SELECT * FROM product WHERE category='$cat_name' ORDER BY entry_date DESC";
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
		}
	}
	else{
		if($sort_val == "high"){
			$get_product = "SELECT * FROM product WHERE category='$cat_name' AND brand='$brand_name' ORDER BY price DESC";
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
		}

		else if($sort_val == "low"){
			$get_product = "SELECT * FROM product WHERE category='$cat_name' AND brand='$brand_name' ORDER BY price ASC";
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
		}

		else if($sort_val == "recomended"){
			$get_product = "SELECT * FROM product WHERE category='$cat_name' AND brand='$brand_name'";
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
		}

		else if($sort_val == "new"){
			$get_product = "SELECT * FROM product WHERE category='$cat_name' AND brand='$brand_name' ORDER BY entry_date DESC";
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
		}
	}

?>
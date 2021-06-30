<?php
	require_once("../../common_files/php/database.php");

	$keyword = $_POST["keyword"];

	$get_product = "SELECT * FROM product WHERE product_name LIKE '%$keyword%' LIMIT 10";
	$product_response = $db -> query($get_product);
	if($product_response){
		if($product_response -> num_rows !=0){
			while ($product_data = $product_response -> fetch_assoc()) {
				echo "<p class='p-3 search-result' style='font-size:13px;' product-id='".$product_data['id']."'>".$product_data['product_name']."</p>";
			}
		}
		else{
			echo "No such product";
		}
	}

?>
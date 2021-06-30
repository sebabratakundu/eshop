<?php
	require_once("../../common_files/php/database.php");
	$product_id = $_POST["product_id"];
	$product_title = $_POST["product_title"];
	$product_price = $_POST["product_price"];
	$product_qty = $_POST["product_qty"];
	$product_brand = $_POST["product_brand"];
	$product_pic = $_POST["product_pic"];
	$username = base64_decode($_COOKIE["_ua_"]);

	$check_table = "SELECT * FROM cart WHERE product_id='$product_id' AND username = '$username'";
	$check_response = $db -> query($check_table);
	if($check_response){
		// check item already in cart or not

		if($check_response -> num_rows == 0){
			$insert_data = "INSERT INTO cart(product_id,product_title,product_price,product_qty,product_brand,product_pic,username)
			VALUES('$product_id','$product_title','$product_price','$product_qty','$product_brand','$product_pic','$username')
			";

			if($db -> query($insert_data)){
				echo "success";
			}
			else{
				echo "data not inserted";
			}
		}
		else{
			echo "Item already in cart !!";
		}
	}
	else{
		$create_table = "CREATE TABLE cart(
		id INT(11) NOT NULL AUTO_INCREMENT,
		product_id INT(11),
		product_title VARCHAR(150),
		product_price FLOAT(20),
		product_qty INT(20),
		product_brand VARCHAR(150),
		product_pic VARCHAR(250),
		username VARCHAR(250),
		PRIMARY KEY(id)
		)";

		if($db -> query($create_table)){
			$insert_data = "INSERT INTO cart(product_id,product_title,product_price,product_qty,product_brand,product_pic,username)
			VALUES('$product_id','$product_title','$product_price','$product_qty','$product_brand','$product_pic','$username')
			";

			if($db -> query($insert_data)){
				echo "success";
			}
			else{
				echo "data not inserted";
			}
		}
		else{
			echo "table not created";
		}
	}


?>
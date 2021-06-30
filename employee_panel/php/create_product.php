<?php
	require("../../common_files/php/database.php");

	$product_name = $_POST["product-name"];
	$brand_name = $_POST["select-brand"];
	$cat_name = $_GET["category"];
	$massage = "";
	$date = date("Y-m-d");

	//retrive category

	$select_category = "SELECT category FROM brands WHERE brand_name = '$brand_name'";
	$category_obj = $db -> query($select_category);
	if($category = $category_obj -> fetch_assoc()){
		$category_name = $category["category"];
	}

	// checking product directory is present or not

	$check_dir = is_dir("../../stocks/".$category_name."/".$brand_name."/".$product_name);
	if($check_dir){
		echo "product already exists";
	}
	else{
		$create_dir = mkdir("../../stocks/".$category_name."/".$brand_name."/".$product_name);
	}

	$description = $_POST["description"];
	$price = $_POST["price"];
	$qty = $_POST["qty"];
	$photos = [$_FILES["thumb"],$_FILES["front"],$_FILES["back"],$_FILES["left"],$_FILES["right"]];
	$photos_col = ['thumb_pic','front_pic','back_pic','left_pic','right_pic'];
	$length = count($photos);
	$i;

	$check_table = "SELECT * FROM product";
	if($db -> query($check_table)){
		$insert_data = "INSERT INTO product(product_name,brand,category,description,price,qty,entry_date)
			VALUES('$product_name','$brand_name','$cat_name','$description','$price','$qty','$date')
			";

			if($db -> query($insert_data)){
				$current_id = $db -> insert_id;
				if($create_dir){
					for($i=0;$i<$length;$i++){
						$files = $photos[$i];
						$photo_name = $files["name"];
						$location = $files["tmp_name"];
						$destination = "stocks/".$category_name."/".$brand_name."/".$product_name."/".$photo_name;
						if(move_uploaded_file($location, "../../stocks/".$category_name."/".$brand_name."/".$product_name."/".$photo_name)){
							$upload_pic_path = "UPDATE product SET $photos_col[$i] = '$destination' WHERE id = '$current_id'";
							if($db -> query($upload_pic_path)){
								$massage = "success";
							}
							else{
								$massage = "photos path cannot updated in database";
							}
						}
						else{
							$massage = "photos cannot be uploaded in the server";
						}
					}

					echo $massage;
				}
			}
			else{
				echo "data cannot be stored in database";
			}
	}
	else{
		$create_table = "CREATE TABLE product(
			id INT(11) NOT NULL AUTO_INCREMENT,
			product_name VARCHAR(100),
			brand VARCHAR(50),
			category VARCHAR(50),
			description VARCHAR(255),
			price FLOAT(20),
			qty INT(20),
			thumb_pic VARCHAR(100) NULL,
			front_pic VARCHAR(100) NULL,
			back_pic VARCHAR(100) NULL,
			left_pic VARCHAR(100) NULL,
			right_pic VARCHAR(100) NULL,
			entry_date DATE NULL,
			PRIMARY KEY(id)
		)";

		if($db -> query($create_table)){
			$insert_data = "INSERT INTO product(product_name,brand,category,description,price,qty,entry_date)
			VALUES('$product_name','$brand_name','$cat_name','$description','$price','$qty','$date')
			";

			if($db -> query($insert_data)){
				$current_id = $db -> insert_id;
				if($create_dir){
					for($i=0;$i<$length;$i++){
						$files = $photos[$i];
						$photo_name = $files["name"];
						$location = $files["tmp_name"];
						$destination = "stocks/".$category_name."/".$brand_name."/".$product_name."/".$photo_name;
						if(move_uploaded_file($location, "../../stocks/".$category_name."/".$brand_name."/".$product_name."/".$photo_name)){
							$upload_pic_path = "UPDATE product SET $photos_col[$i] = '$destination' WHERE id = '$current_id'";
							if($db -> query($upload_pic_path)){
								$massage = "success";
							}
							else{
								$massage = "photos path cannot updated in database";
							}
						}
						else{
							$massage = "photos cannot be uploaded in the server";
						}
					}

					echo $massage;
				}
			}
			else{
				echo "data cannot be stored in database";
			}
		}
		else{
			echo "product table not created";
		}

	}

?>
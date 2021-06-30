<?php
require("../../common_files/php/database.php");

$category = $_POST['category'];
$brands_data = [];

$select_brands = "SELECT * FROM brands WHERE category = '$category'";
$response_obj = $db -> query($select_brands);

if($response_obj -> num_rows != 0){
	while($data = $response_obj -> fetch_assoc()){
		array_push($brands_data, $data);
	}

	echo json_encode($brands_data);
}
else{
	echo "brands are not created in this category";
}


?>
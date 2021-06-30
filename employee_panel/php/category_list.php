<?php
require("../../common_files/php/database.php");
$check_table = "SELECT * FROM category";
$category_data = [];
$response = $db -> query($check_table);
if($response){
	while($data = $response -> fetch_assoc()){
		array_push($category_data, $data);
	}

	echo json_encode($category_data);
}
else{
	echo "table not exists";
}

?>
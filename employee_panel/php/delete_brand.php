<?php
require("../../common_files/php/database.php");

$category = $_POST["category"];
$brand = $_POST['brand'];

$delete_brand = "DELETE FROM brands WHERE category = '$category' AND brand_name = '$brand'";
if($db -> query($delete_brand)){
	echo "delete success";
}
else{
	echo "delete failed";
}
?>
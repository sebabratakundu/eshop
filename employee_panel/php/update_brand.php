<?php
require("../../common_files/php/database.php");

$previous_category = $_POST["previous_category"];
$previous_brand = $_POST["previous_brand"];
$category = $_POST["category"];
$brand = $_POST["brand"];

$update_brand = "UPDATE brands SET category = '$category',brand_name = '$brand' WHERE category = '$previous_category' AND brand_name = '$previous_brand'";

if($db -> query($update_brand)){
	echo "update success";
}
else{
	echo "update failed";
}
?>
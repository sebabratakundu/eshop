<?php
require("../../common_files/php/database.php");

$id = $_POST['id'];

$delete_category = "DELETE FROM category WHERE id = '$id'";

if($db -> query($delete_category)){
	echo "delete success";
}
else{
	echo "not deleted";
}

?>
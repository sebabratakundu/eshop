<?php
require("../../common_files/php/database.php");

$id = $_POST['id'];
$changed_category = $_POST['changed_category'];

$update_category = "UPDATE category SET category_name = '$changed_category' WHERE id = '$id'";
if($db -> query($update_category)){
	echo "update success";
}
else{
	echo "cannot updated";
}

?>
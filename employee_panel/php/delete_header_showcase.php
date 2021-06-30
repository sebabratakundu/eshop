<?php
	require_once("../../common_files/php/database.php");

	$id = $_POST["id"];
	$delete_showcase = "DELETE FROM header_showcase WHERE id = '$id'";
	if($db -> query($delete_showcase)){
		echo "success";
	}
	else{
		echo "failed";
	}

?>
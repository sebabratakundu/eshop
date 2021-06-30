<?php
	require_once("../../common_files/php/database.php");

	$id = $_POST["id"];
	$get_data  = "SELECT * FROM header_showcase WHERE id = '$id'";
	$get_response = $db -> query($get_data);
	if($get_response){
		$data = $get_response -> fetch_assoc();
		$image = "data:image/png;base64,".base64_encode($data["title_photo"]);
		$title_text = $data["title_text"];
		$title_color = $data["title_color"];
		$title_size = $data["title_size"];
		$subtitle_text = $data["subtitle_text"];
		$subtitle_color = $data["subtitle_color"];
		$subtitle_size = $data["subtitle_size"];
		$h_align = $data["h_align"];
		$v_align = $data["v_align"];
		$btn_data = $data["btn_data"];

		$showcase_array_data = [$image,$title_text,$title_color,$title_size,$subtitle_text,$subtitle_color,$subtitle_size,$h_align,$v_align,$btn_data];

		echo json_encode($showcase_array_data);
	}
	else{
		echo "data is not there";
	}


?>
<?php
	require("../../common_files/php/database.php");

	$file = "";
	$photo_name = "";
	$file_location = "";
	$file_binary_data = "";
	if($_FILES){
		$file = $_FILES["file_data"];
		$photo_name = $file["name"];
		$file_location = $file["tmp_name"];
		$file_binary_data = addslashes(file_get_contents($file_location));
	}

	$encode_json_data = json_encode($_POST["css_data"]);
	$decode_first_time = json_decode($encode_json_data,true);
	$assoc_array = json_decode($decode_first_time,true);

	$title_text = addslashes($assoc_array["title_text"]);
	$title_color = $assoc_array["title_color"];
	$title_size = $assoc_array["title_size"];
	$subtitle_text = addslashes($assoc_array["subtitle_text"]);
	$subtitle_color = $assoc_array["subtitle_color"];
	$subtitle_size = $assoc_array["subtitle_size"];
	$h_align = $assoc_array["h_align"];
	$v_align = $assoc_array["v_align"];
	$btn_data = addslashes($assoc_array["btn_data"]);
	$option = $assoc_array["options"];

	//check database

	$check_table = "SELECT count(id) AS row_count FROM header_showcase";
	$check_response = $db -> query($check_table);
	if($check_response){
		$data = $check_response -> fetch_assoc();
		if($data["row_count"] < 3){
			if($option == "Choose showcase"){

				$insert_data = "INSERT INTO header_showcase(title_photo_name,title_photo,title_text,title_color,title_size,subtitle_text,subtitle_color,subtitle_size,h_align,v_align,btn_data)
				VALUES('$photo_name','$file_binary_data','$title_text','$title_color','$title_size','$subtitle_text','$subtitle_color','$subtitle_size','$h_align','$v_align','$btn_data')
				";

				if($db -> query($insert_data)){
					echo "success";
				}
				else{
					echo "data not inserted !! ";
				}
			}
			else{
				if($file == ""){
					$update_showcase = "UPDATE header_showcase SET title_text='$title_text',title_color='$title_color',title_size='$title_size',subtitle_text='$subtitle_text',subtitle_color='$subtitle_color',subtitle_size='$subtitle_size',h_align='$h_align',v_align='$v_align',btn_data='$btn_data' WHERE id='$option'";
					if($db -> query($update_showcase)){
						echo "update success";
					}
					else{
						echo "update failed";
					}
				}
				else{
					$update_showcase = "UPDATE header_showcase SET title_photo_name='$photo_name',title_photo='$file_binary_data'title_text='$title_text',title_color='$title_color',title_size='$title_size',subtitle_text='$subtitle_text',subtitle_color='$subtitle_color',subtitle_size='$subtitle_size',h_align='$h_align',v_align='$v_align',btn_data='$btn_data' WHERE id='$option'";
					if($db -> query($update_showcase)){
						echo "update success";
					}
					else{
						echo "update failed";
					}
				}
			}
		}
		else{
			if($option == "Choose showcase"){
				echo "Limit exceeded !";
			}
			else{
				if($file == ""){
					$update_showcase = "UPDATE header_showcase SET title_text='$title_text',title_color='$title_color',title_size='$title_size',subtitle_text='$subtitle_text',subtitle_color='$subtitle_color',subtitle_size='$subtitle_size',h_align='$h_align',v_align='$v_align',btn_data='$btn_data' WHERE id='$option'";
					if($db -> query($update_showcase)){
						echo "update success";
					}
					else{
						echo "update failed";
					}
				}
				else{
					$update_showcase = "UPDATE header_showcase SET title_photo_name='$photo_name',title_photo='$file_binary_data',title_text='$title_text',title_color='$title_color',title_size='$title_size',subtitle_text='$subtitle_text',subtitle_color='$subtitle_color',subtitle_size='$subtitle_size',h_align='$h_align',v_align='$v_align',btn_data='$btn_data' WHERE id='$option'";
					if($db -> query($update_showcase)){
						echo "update success";
					}
					else{
						echo "update failed";
					}
				}
			}
		}
	}
	else{
		$create_table = "CREATE TABLE header_showcase(
		id INT(11) NOT NULL AUTO_INCREMENT,
		title_photo_name VARCHAR(100),
		title_photo MEDIUMBLOB,
		title_text VARCHAR(255),
		title_color VARCHAR(20),
		title_size VARCHAR(20),
		subtitle_text VARCHAR(255),
		subtitle_color VARCHAR(20),
		subtitle_size VARCHAR(20),
		h_align VARCHAR(20),
		v_align VARCHAR(20),
		btn_data MEDIUMTEXT,
		PRIMARY KEY(id)
		)";

		if($db -> query($create_table)){
			$insert_data = "INSERT INTO header_showcase(title_photo_name,title_photo,title_text,title_color,title_size,subtitle_text,subtitle_color,subtitle_size,h_align,v_align,btn_data)
			VALUES('$photo_name','$file_binary_data','$title_text','$title_color','$title_size','$subtitle_text','$subtitle_color','$subtitle_size','$h_align','$v_align','$btn_data')";

			if($db -> query($insert_data)){
				echo "success";
			}
			else{
				echo "data not inserted !!";
			}
		}
		else{
			echo "table not created";
		}
	}

?>
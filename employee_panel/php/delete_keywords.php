<?php
	require_once("../../common_files/php/database.php");

	$keywords = json_decode($_POST["keywords"]);
	$i;
	for($i=0;$i<count($keywords);$i++){
		$match_keyword = "SELECT * FROM keyword WHERE s_keyword LIKE '%keywords[$i]%'";
		$match_keyword_response = $db -> query($match_keyword);
		if($match_keyword_response){
			if($match_keyword_response -> num_rows !=0){
				$delete_keywords = "DELETE FROM failed_keyword WHERE failed_keyword='$keywords[$i]'";
				if($db -> query($delete_keywords)){
					echo "success";
				}
				else{
					echo "not deleted";
				}
			}
			else{
				echo "no match keywords";
			}
		}
	}

?>
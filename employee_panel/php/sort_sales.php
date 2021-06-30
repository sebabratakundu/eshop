<?php
	require_once("../../common_files/php/database.php");

	$sort_value = $_POST["sort_value"];
	$sales_arry = [];

// todays sales
	
	$current_date = date("Y-m-d");
	if($sort_value == "today-sale"){
		$get_sales_data = "SELECT * FROM purchase WHERE purchase_date='$current_date'";
		$sales_response = $db -> query($get_sales_data);
		if($sales_response){
			if($sales_response -> num_rows != 0){
				while($sales_data = $sales_response -> fetch_assoc()){
					array_push($sales_arry, $sales_data);
				}

				echo json_encode($sales_arry);
			}
			else{
				echo "No sales found !!";
			}
		}
	}
	else if($sort_value == "old-sale"){
		$get_sales_data = "SELECT * FROM purchase ORDER BY purchase_date ASC";
		$sales_response = $db -> query($get_sales_data);
		if($sales_response){
			if($sales_response -> num_rows != 0){
				while($sales_data = $sales_response -> fetch_assoc()){
					array_push($sales_arry, $sales_data);
				}

				echo json_encode($sales_arry);
			}
			else{
				echo "No sales found !!";
			}
		}
	}
	else if($sort_value == "new-sale"){
		$get_sales_data = "SELECT * FROM purchase ORDER BY purchase_date DESC";
		$sales_response = $db -> query($get_sales_data);
		if($sales_response){
			if($sales_response -> num_rows != 0){
				while($sales_data = $sales_response -> fetch_assoc()){
					array_push($sales_arry, $sales_data);
				}

				echo json_encode($sales_arry);
			}
			else{
				echo "No sales found !!";
			}
		}
	}
	else if($sort_value == "processing"){
		$get_sales_data = "SELECT * FROM purchase WHERE status='$sort_value'";
		$sales_response = $db -> query($get_sales_data);
		if($sales_response){
			if($sales_response -> num_rows != 0){
				while($sales_data = $sales_response -> fetch_assoc()){
					array_push($sales_arry, $sales_data);
				}

				echo json_encode($sales_arry);
			}
			else{
				echo "No sales found !!";
			}
		}
	}
	else if($sort_value == "Dispatched"){
		$get_sales_data = "SELECT * FROM purchase WHERE status='$sort_value'";
		$sales_response = $db -> query($get_sales_data);
		if($sales_response){
			if($sales_response -> num_rows != 0){
				while($sales_data = $sales_response -> fetch_assoc()){
					array_push($sales_arry, $sales_data);
				}

				echo json_encode($sales_arry);
			}
			else{
				echo "No sales found !!";
			}
		}
	}
	else if($sort_value == "returned"){
		$get_sales_data = "SELECT * FROM purchase WHERE status='$sort_value'";
		$sales_response = $db -> query($get_sales_data);
		if($sales_response){
			if($sales_response -> num_rows != 0){
				while($sales_data = $sales_response -> fetch_assoc()){
					array_push($sales_arry, $sales_data);
				}

				echo json_encode($sales_arry);
			}
			else{
				echo "No sales found !!";
			}
		}
	}

?>
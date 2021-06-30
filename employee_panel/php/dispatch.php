<?php
	require_once("../../common_files/php/database.php");

	$order_id = $_POST["order_id"];
	$product_title = $_POST["product_title"];
	$price = $_POST["price"];
	$fullname = $_POST["fullname"];
	$address = $_POST["address"];
	$email = $_POST["email"];
	$mobile = $_POST["mobile"];
	$qty = $_POST["qty"];
	$date = date("Y-m-d");

	$update_status = "UPDATE purchase SET status='Dispatched',dispatch_date='$date' WHERE id='$order_id'";
	if($db -> query($update_status)){
		$header = "From:ESHOP <purchase@eshop.com>\r\nContent-type:text/html;CHARSET:UTF-8";
		$massage = "<body>
		<div>
			<h1 style='color:#EA7773'>ORDER UPDATE</h1>
			<p>Your order has been shipped</p>
			<p>".$fullname."</p>
			<p> Product Name : ".$product_title."</p>
			<p>Quantity : ".$qty."</p>
			<p> Price : ".$price."</p>
			<p>Address : ".$address."</p>
			<p>Mobile : ".$mobile."</p>

			<h4>Thanks and Regards</h4>
			<p>ESHOP</p>
		</div>
		</body>";
		$check_mail = mail($email, "ESHOP ORDER UPDATE", $massage,$header);
		if($check_mail){
			echo "success";
		}
		else{
			echo "failed";
		}
	}
	else{
		echo "product cannot dispatch";
	}

?>
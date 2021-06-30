<?php
	require_once("../../common_files/php/database.php");
	//user loged in or not coding

	if(empty($_COOKIE["_ua_"])){
		header("Location:http://localhost/bom/php/eshop/signin");
		exit;
	}

	$product_id = base64_decode($_GET["product_id"]);
	$username = base64_decode($_COOKIE["_ua_"]);
	$add_cart_btn = "";
	$stock = "";
	$get_product = "SELECT * FROM product WHERE id='$product_id'";
	$product_response = $db -> query($get_product);
	if($product_response){
		if($product_response -> num_rows !=0){
			$product_data = $product_response -> fetch_assoc();
			$product_title = $product_data["product_name"];
			$product_brand = $product_data["brand"];
			$product_category = $product_data["category"];
			$price = $product_data["price"];
			$description = $product_data["description"];
			$thumb_pic = $product_data["thumb_pic"];
			$front_pic = $product_data["front_pic"];
			$back_pic = $product_data["back_pic"];
			$left_pic = $product_data["left_pic"];
			$right_pic = $product_data["right_pic"];
			$stock = $product_data["qty"];
		}
		else{
			header("Location:http://localhost/bom/php/eshop/index.php");
		}
	}

	//item in cart or not

	$get_item_details = "SELECT * FROM cart WHERE product_id='$product_id' AND username='$username'";
	$item_response = $db -> query($get_item_details);
	if(!$item_response){
		$add_cart_btn = '<button class="btn py-2 px-5 text-white font-weight-bold add-to-cart-btn shadow-sm" style="background: #E83350;border-radius: 20px;" product-id="'.$product_id.'" product-title="'.$product_title.'" product-brand="'.$product_brand.'" product-price="'.$price.'" product-pic="'.$thumb_pic.'"><i class="fa fa-shopping-cart mr-2"></i>Add to Cart</button>';
	}
	else{
		if($item_response -> num_rows == 0){
			$add_cart_btn = '<button class="btn py-2 px-5 text-white font-weight-bold add-to-cart-btn shadow-sm" style="background: #E83350;border-radius: 20px;" product-id="'.$product_id.'" product-title="'.$product_title.'" product-brand="'.$product_brand.'" product-price="'.$price.'" product-pic="'.$thumb_pic.'"><i class="fa fa-shopping-cart mr-2"></i>Add to Cart</button>';
		}
		else{
			$add_cart_btn = "";
		}
	}


?>


<!DOCTYPE html>
<html lang="en-US">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="http://localhost/bom/php/eshop/common_files/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="http://localhost/bom/php/eshop/common_files/css/animate.css">
<link rel="stylesheet" type="text/css" href="http://localhost/bom/php/eshop/common_files/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<head>
	<title>eshop</title>
</head>
<script type="text/javascript" src="http://localhost/bom/php/eshop/common_files/js/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/bom/php/eshop/common_files/js/popper.min.js"></script>
<script type="text/javascript" src="http://localhost/bom/php/eshop/common_files/js/bootstrap.js"></script>
<script type="text/javascript" src="http://localhost/bom/php/eshop/pages/js/index.js"></script>
<body style="background: #f8f8f8;font-family: Raleway;">

<!-- start navbar coding -->

<?php
	include_once("../../assets/php/nav.php");
	$pincode = $_SESSION["pincode"];
	$check_pincode = "SELECT * FROM delivery_location WHERE pincode = '$pincode'";
	$pincode_response = $db -> query($check_pincode);
	if($pincode_response -> num_rows != 0){

		$delivery_data = $pincode_response -> fetch_assoc();
		$payment_mode = $delivery_data["payment_mode"];
		if($payment_mode == "All"){
			$pay_mode = '<div class="custom-control custom-radio">
				<input type="radio" name="pay-mode" class="custom-control-input" id="online" value="online">
				<label class="custom-control-label" for="online">Online</label>
			</div>
			<div class="custom-control custom-radio mb-4">
				<input type="radio" name="pay-mode" class="custom-control-input" id="cod" value="cod">
				<label class="custom-control-label" for="cod">COD</label>
			</div>';
		}
		else{
			$pay_mode = '<div class="custom-control custom-radio mb-4">
				<input type="radio" name="pay-mode" class="custom-control-input" id="online" value="online">
				<label class="custom-control-label" for="online">Online</label>
			</div>';
		}

		if($stock != 0){
			$buy_btn = '<button class="btn py-2 px-5 text-white font-weight-bold purchase-btn shadow-sm" style="background: #2B2B52;border-radius: 20px;" product-id="'.$product_id.'" product-title="'.$product_title.'" product-brand="'.$product_brand.'" product-price="'.$price.'"><i class="fa fa-shopping-bag mr-2"></i>Buy Now</button>';
		}
		else{
			$buy_btn = '<button class="btn btn-light py-2 px-5 shadow-sm font-weight-bold border" style="border-radius:20px;"><i class="fa fa-shopping-cart mr-2"></i>Out of stock</button>';
		}
	}
	else{
		$buy_btn = "<button class='btn text-white shadow-sm' style='background:#2B2B52'>Whoops !! Product delivery is not available in your pincode</button>";
		$add_cart_btn = "";
	}
?>

<!-- end navbar coding -->

<!-- start cart item coding -->

<div class="container px-5" style="margin-top: 80px;margin-bottom: 80px;">
	<a href="#" class="text-capitalize" style="font-family: calibri;"><?php echo $product_category;?></a>
	>
	<a href="#" class="text-capitalize" style="font-family: calibri;"><?php echo $product_brand;?></a>
	>
	<a href="#" class="text-capitalize" style="font-family: calibri;"><?php echo $product_title;?></a>
	<div class="row pt-2">
		<div class="col-md-6 bg-white shadow-sm py-3" align="center">
			<img src="<?php echo "../".$front_pic;?>" width="300" class="preview-pic">
			<br>
			<img src="<?php echo "../".$front_pic;?>" width="80" class="shadow-sm border p-2 pro-pic">
			<img src="<?php echo "../".$back_pic;?>" width="80" class="shadow-sm border p-2 pro-pic">
			<img src="<?php echo "../".$left_pic;?>" width="80" class="shadow-sm border p-2 pro-pic">
			<img src="<?php echo "../".$right_pic;?>" width="80" class="shadow-sm border p-2 pro-pic">
		</div>
		<div class="col-md-6 bg-white shadow-sm p-3">
			<h4 class="p-0 m-0 text-capitalize font-weight-bold"><?php echo $product_title;?></h4>
			<p class="p-0 m-0 text-uppercase" style="color:#E83350;"><?php echo $product_brand;?></p>
			<p class="font-weight-bold">Price : <i class="fa fa-rupee"></i><?php echo $price;?></p>
			<hr>
			<h5>Description</h5>
			<?php echo $description;?>
			<h5>Quantity</h5>
			<?php
				if($stock >0 && $stock <= 5){
					echo "<p class='text-danger font-weight-bold'>Hurry only <span class='product-stock'>".$stock."</span> in stock !</p>";
				}
				else if($stock == 0){
					echo "<p class='text-danger font-weight-bold'>Stock is empty !<span class='product-stock d-none'>".$stock."</span></p>";
				}
				else{
					echo "<p class='text-danger font-weight-bold d-none'>Hurry only <span class='product-stock'>".$stock."</span> in stock !</p>";
				}
			?>
			<input type="number" name="quantity" class="form-control mb-4 qty" value="1" style="width:80px;">

			<h5>Pay Mode</h5>
			<?php echo $pay_mode; ?>
			<?php echo $add_cart_btn; ?>
			<?php echo $buy_btn; ?>
			<h5 class="my-4">Check Pincode</h5>
			<div class="input-group w-75">
				<input type="number" name="pincode" id="check-pin" class="form-control">
				<div class="input-group-append">
					<span class="btn input-group-btn text-white check-pin-btn" style="background: #E83350;">Check</span>
				</div>
			</div>
			<p class="pincode-massage text-success font-weight-bold my-2"></p>
		</div>
		<div class="col-md-12 bg-white shadow-sm p-3 my-4">
			<h4>Product Reviews</h4>
			<hr>
			<?php
				$get_reviews = "SELECT * FROM purchase WHERE product_id='$product_id' AND rating<>0";
				$review_response = $db -> query($get_reviews);
				if($review_response){
					if($review_response -> num_rows !=0){
						while($review_data = $review_response -> fetch_assoc()){
							$fullname = $review_data["fullname"];

							$src = "data:image/png;base64,".base64_encode($review_data["picture"]);
							echo "<div class='media mb-3'>";
							echo "<img src='".$src."' width='60' height='60' class='shadow-sm p-1 rounded-circle'>";
							echo "<div class='media-body px-2'>";
							echo "<p class='p-0 m-0 font-weight-bold'>".$fullname."</p>";
							echo "<div>";
										$rating = $review_data['rating'];
										for($i=0;$i<$rating;$i++){
											echo "<i class='fa fa-star text-warning star-icons' style='font-size:20px;pointer-events:none;' index='".$i."'></i>";
										}

										$rest = 5-$rating;
										for($i=0;$i<$rest;$i++){
											echo "<i class='fa fa-star-o text-warning star-icons' style='font-size:20px;pointer-events:none;' index='".$i."'></i>";
										}
										echo "</div>";
										echo "<p>".$review_data['comment']."</p>";
							echo "</div>";
							echo "</div>";
						}
					}
				}

			?>
		</div>
	</div>
</div>

<!-- end cart item coding -->

<!-- start footer coding -->

<?php
	include_once("../../assets/php/footer.php");
?>

<!-- end footer coding -->

<script>
</script>
</body>
</html>

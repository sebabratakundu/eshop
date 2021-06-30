<?php
	require_once("../../common_files/php/database.php");
	//user loged in or not coding

	if(empty($_COOKIE["_ua_"])){
		header("Location:http://localhost/bom/php/eshop/signin.php");
		exit;
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
?>

<!-- end navbar coding -->

<!-- start cart item coding -->

<div class="container px-5" style="margin-top: 80px;">
	<div class="row">
		<div class="col-md-8">
			<div class=" bg-white p-3 shadow-sm rounded">
				<?php
					$username = base64_decode($_COOKIE["_ua_"]);
					$price = 0;
					$total_price = 0;
					$delevery_fee = 0;
					$product_qty = 0;
					$get_cart_item = "SELECT * FROM cart WHERE username = '$username'";
					$cart_item_response = $db -> query($get_cart_item);
					if($cart_item_response){
						if($cart_item_response -> num_rows != 0){
							while($cart_item_data = $cart_item_response -> fetch_assoc()){
								$price += $cart_item_data["product_price"];
								$product_qty += $cart_item_data["product_qty"];
								echo "<div class='media p-2 mb-3'>
								<div class='media-left'>
								<img src='".$cart_item_data['product_pic']."' width='100'>
								</div>
								<div class='media-body px-3'>
								<h5 class='text-catialize font-monsserat font-weight-bold m-0 p-0'>".$cart_item_data['product_title']."</h5>
								<span style='font-size:15px'>".$cart_item_data['product_brand']."</span><br>
								<span style='font-size:15px'><i class='fa fa-rupee'></i> ".$cart_item_data['product_price']."</span><br>
								<div class='input-group w-25 position-absolute mt-3'>
									<div class='input-group-prepend'>
										<button class='btn btn-dark'><i class='fa fa-minus'></i></button>
									</div>
									<input type='number' name='qty' class='form-control' value='1'>
									<div class='input-group-append'>
										<button class='btn btn-dark'><i class='fa fa-plus'></i></button>
									</div>
								</div>
								<div class='btn-group shadow-sm mt-3 float-right'>
								<button class='btn text-white delete-item-btn' product-id='".$cart_item_data['product_id']."' price='".$cart_item_data['product_price']."' qty='".$cart_item_data['product_qty']."' style='background:#E83350'><i class='fa fa-trash'></i></button>
								<button class='btn text-white buy-btn' product-id='".$cart_item_data['product_id']."' style='background:#2B2B52'>Place Order</button>
								</div>
								</div>
								</div>";
							}
							$total_price += $price+$delevery_fee;
						}
						else{
							echo "<div class='jumbotron rounded shadow-sm text-center' style='border-left:5px solid #2B2B52'>
							<h1>Your cart is empty !!</h1>;
							</div>";
						}
					}
					else{
						echo "<div class='jumbotron rounded shadow-sm text-center' style='border-left:5px solid #2B2B52'>
						<h1>Your cart is empty !!</h1>;
						</div>";
					}
				?>
			</div>
		</div>
		<div class="col-md-4">
					<div class=" bg-white p-3 shadow-sm rounded price-details-box">
						<h5>PRICE DETAILES</h5>
						<hr>
						<div class="d-flex flex-column">
							<div class="d-flex justify-content-between">
								<p>Price(<span class="product-qty"><?php echo $product_qty; ?></span> Items)</p>
								<p class="price"><i class="fa fa-rupee"></i><?php echo $price; ?></p>
							</div>
							<div class="d-flex justify-content-between">
								<p>Delivery Fee</p>
								<p class="text-success">FREE</p>
							</div>
						</div>
						<hr>
						<div class="d-flex justify-content-between">
								<h5>Total Amount</h5>
								<h5 class="total-price"><i class="fa fa-rupee"></i><?php echo $total_price; ?></h5>
							</div>
						<button class="btn btn-primary w-100 py-2 place-order-btn mt-3 shadow-sm">Place Order</button>							
					</div>
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

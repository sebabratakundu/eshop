<?php
	require_once("../../common_files/php/database.php");
	//user loged in or not coding

	if(empty($_COOKIE["_ua_"])){
		header("Location:../../signin.php");
		exit;
	}

	$username = base64_decode($_COOKIE["_ua_"]);

?>


<!DOCTYPE html>
<html lang="en-US">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="http://localhost/bom/php/eshop/common_files/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="http://localhost/bom/php/eshop/common_files/css/animate.css">
<link rel="stylesheet" type="text/css" href="http://localhost/bom/php/eshop/common_files/css/sstyle.css">
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

<div class="container px-5" style="margin-top: 80px;margin-bottom: 80px;">
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li class="nav-item"><a href="#personal" class="nav-link active" data-toggle="tab">Personal</a></li>
				<li class="nav-item"><a href="#privacy" class="nav-link" data-toggle="tab">Privacy</a></li>
				<li class="nav-item"><a href="#purchase" class="nav-link" data-toggle="tab">Order History</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="personal">
					<?php
						$get_personal_data = "SELECT * FROM users WHERE email='$username'";
						$data_response = $db -> query($get_personal_data);
						$firstname = "";
						$lastname = "";
						$email = "";
						$mobile = "";
						$address = "";
						$state = "";
						$country = "";
						$pincode = "";
						if($data_response -> num_rows != 0){
							$personal_data = $data_response -> fetch_assoc();

							$firstname = $personal_data["firstname"];
							$lastname = $personal_data["lastname"];
							$email = $personal_data["email"];
							$mobile = $personal_data["mobile"];
							$address = $personal_data["address"];
							$state = $personal_data["state"];
							$pincode = $personal_data["pincode"];
							$country = $personal_data["country"];
						}

					?>

					<div class="jumbotron shadow-sm mt-3" style="border-left:5px solid #2B2B52;">
						<h4 class="text-center font-monsserat font-weight-bold">Personal Information</h4>
						<hr>
						<form class="personal-form">
							<div class="form-group">
								<label for="firstname" class="font-weight-bold">Firstname</label>
								<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo $firstname;?>">
							</div>
							<div class="form-group">
								<label for="lastname" class="font-weight-bold">Lastname</label>
								<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo $lastname;?>">
							</div>
							<div class="form-group">
								<label for="email" class="font-weight-bold">Email</label>
								<input type="email" name="email" id="email" class="form-control" value="<?php echo $email;?>">
							</div>
							<div class="form-group">
								<label for="mobile" class="font-weight-bold">Mobile</label>
								<div class="input-group">
								<input type="number" name="mobile" id="mobile" class="form-control" disabled="disabled" value="<?php echo $mobile;?>">
								<div class="input-group-append">
									<button class="btn btn-primary send-otp-btn" type="button">Send OTP</button>
								</div>
								</div>
								<div class="input-group mt-3 w-50 d-none verify-mobile-box">
								<input type="number" name="verification-code" id="verification-code" class="form-control">
								<div class="input-group-append">
									<button class="btn btn-danger verify-mobile" type="button">Verify</button>
								</div>
								</div>
							</div>
							<div class="form-group">
								<label for="address" class="font-weight-bold">Address</label>
								<textarea name="address" id="address" class="form-control">
									<?php echo $address; ?>
								</textarea>
							</div>
							<div class="form-group">
								<label for="pincode" class="font-weight-bold">Pincode</label>
								<input type="text" name="pincode" id="pincode" class="form-control" value="<?php echo $pincode;?>">
							</div>
							<div class="form-group">
								<label for="state" class="font-weight-bold">State</label>
								<input type="text" name="state" id="state" class="form-control" value="<?php echo $state;?>">
							</div>
							<div class="form-group">
								<label for="country" class="font-weight-bold">Country</label>
								<input type="text" name="country" id="country" class="form-control" value="<?php echo $country;?>">
							</div>
							<input type="submit" class="btn btn-dark update-info-btn" value="Update">
						</form>
					</div>
				</div>
				<div class="tab-pane fade" id="privacy">
					<div class="jumbotron mt-3 shadow-sm" style="border-left:5px solid #2B2B52;">
						<h4 class="text-center font-monsserat font-weight-bold">Privacy Settings</h4>
						<hr>
						<form class="privacy-form">
							<div class="form-group">
								<label for="old-pass" class="font-weight-bold">Old password</label>
								<input type="password" name="old-pass" id="old-pass" required="required" class="form-control">
							</div>
							<div class="form-group">
								<label for="new-pass" class="font-weight-bold">New password</label>
								<input type="password" name="new-pass" id="new-pass" required="required" class="form-control">
							</div>
							<div class="form-group">
								<label for="reenter-pass" class="font-weight-bold">Re-enter password</label>
								<input type="password" name="reenter-pass" id="reenter-pass" required="required" class="form-control">
							</div>
							<button class="btn btn-dark" type="submit">Change</button>
						</form>
					</div>
				</div>
				<div class="tab-pane fade" id="purchase" style="background: #F8F8F8;">
					<h4 class="text-center font-monsserat font-weight-bold my-3">Order history</h4>
					<hr>
					<?php
						$get_purchase_product = "SELECT * FROM purchase WHERE email='$username'";
						$purchase_response = $db -> query($get_purchase_product);
						if($purchase_response -> num_rows !=0){
							while($products = $purchase_response -> fetch_assoc()){

								//get photo
								$product_id = $products['product_id'];
								$get_photo = "SELECT * FROM product WHERE id='$product_id'";
								$photo_response = $db -> query($get_photo);
								if($photo_response -> num_rows != 0){
									$photos = $photo_response -> fetch_assoc();
									$thumb = $photos["thumb_pic"];
								}

								$date = date_create($products['purchase_date']);
								$purchase_date = date_format($date,"d-m-Y");

								echo "<div class='media bg-white shadow-sm my-3 position-relative'>";
								echo "<img src='".$thumb."' width='150'>";
								echo "<div class='media-body p-3'>";
								echo "<h5 class='font-weight-bold'>".$products['product_title']."</h5>";
								echo "<p class='p-0 m-0'>".$products['brand']."</p>";
								echo "<p class='p-0 m-0'><i class='fa fa-rupee'></i>".$products['price']."</p>";
								echo "<p class='p-0 m-0'>Quantity : ".$products['quantity']."</p>";
								echo "<p class='p-0 m-0'>Pay mode : ".$products['payment_mode']."</p>";
								echo "<p class='p-0 m-0'>Status : ".$products['status']."</p>";
								echo "<p>Purchase Date : ".$purchase_date."</p>";
								if($products['status'] == "Delivered"){
									if($products['rating'] == 0){
										echo "<h6 class='position-absolute comment-header font-weight-bold' style='top:30px;right:30px;'>Please rate this product</h6>";
										echo "<div class='position-absolute' style='top:60px;right:30px'>";
										for($i=0;$i<5;$i++){
											echo "<i class='fa fa-star-o text-warning star-icons' style='font-size:20px;' index='".$i."'></i>";
										}
										echo "</div>";
										echo "<div class='form-group comment-box'>
										<label for='comment' class='font-weight-bold'>Comment</label>
										<textarea id='comment' class='form-control w-75'></textarea>
										</div>";
										echo "<div class='form-group pic-box'>
										<div class='custom-file w-75'>
										<input type='file' accept='image/*' class='custom-file-input' id='pic'>
										<label for='pic' class='custom-file-label'>Choose photo</label>
										</div>
										</div>";

										echo "<p class='comment-notice'></p>";

										echo "<button class='btn btn-primary d-none my-3 position-absolute rating-btn' style='top:100px;right:30px;' product-id='".$products['product_id']."'>Send feedback</button>";
									}
									else{
										echo "<h6 class='position-absolute font-weight-bold comment-header' style='top:30px;right:30px;'>Your Rating</h6>";
										echo "<div class='position-absolute' style='top:60px;right:30px'>";
										$rating = $products['rating'];
										for($i=0;$i<$rating;$i++){
											echo "<i class='fa fa-star text-warning star-icons' style='font-size:20px;pointer-events:none;' index='".$i."'></i>";
										}

										$rest = 5-$rating;
										for($i=0;$i<$rest;$i++){
											echo "<i class='fa fa-star-o text-warning star-icons' style='font-size:20px;pointer-events:none;' index='".$i."'></i>";
										}
										echo "</div>";
										echo "<h6 class='font-weight-bold'>Your Review</h6>";
										echo "<p>".$products['comment']."</p>";
									}
								}
								echo "</div>";
								echo "</div>";
							}
						}
					?>
				</div>
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

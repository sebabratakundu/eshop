<?php
	require_once("common_files/databases/database.php");
	include_once("common_files/php/database.php");

	$root = "http://www.".ROOT."/eshop";

	$company_logo = "";
	$company_name = "";
	$get_company = "SELECT * FROM branding";
	$company_response = $db -> query($get_company);
	if($company_response){
		if($company_response -> num_rows !=0){
			$company_data = $company_response -> fetch_assoc();
			$company_logo = "data:image/png;base64,".base64_encode($company_data["brand_logo"]);
			$company_name = $company_data["brand_name"];
		}
	}
?>


<!DOCTYPE html>
<html lang="en-US">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="common_files/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="common_files/css/animate.css">
<link rel="stylesheet" type="text/css" href="employee_panel/css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<head>
	<title>eshop</title>
</head>
<script type="text/javascript" src="common_files/js/jquery.min.js"></script>
<script type="text/javascript" src="common_files/js/popper.min.js"></script>
<script type="text/javascript" src="common_files/js/bootstrap.js"></script>
<body style="background: #f8f8f8;font-family: Raleway;">

<!-- start navbar coding -->

<!-- end navbar coding -->

<div class="container-fluid my-4">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6 d-flex flex-column align-items-center">
		<div class="mb-3" style="cursor:pointer;">
			<a href="http://localhost/bom/php/eshop/index" class="d-flex align-items-center text-dark" style="text-decoration:none;"><img src="<?php echo $company_logo;?>" width="50" alt="company logo">&nbsp;<h4 class="p-0 m-0"><?php echo strtoupper($company_name); ?></h4></a>
		</div>
			<form class="signup-form p-4 w-75 rounded shadow-lg bg-white" style="font-family: 'Cardo', serif;">
				<h2 style="font-family: Raleway;" class="text-uppercase font-weight-bold text-center text-dark">Sign Up</h2>
				<hr>
				<div class="form-group">
					<label for="first-name">First Name<sup class="text-danger">*</sup></label>
					<input type="text" name="firstname" id="first-name" required="required" placeholder="Ex : Robart" class="form-control shadow-sm">
				</div>
				<div class="form-group">
					<label for="last-name">Last Name<sup class="text-danger">*</sup></label>
					<input type="text" name="lastname" id="last-name" required="required" placeholder="Ex : Pattinson" class="form-control shadow-sm">
				</div>
				<div class="form-group">
					<label for="username">Username<sup class="text-danger">*</sup></label>
					<input type="email" name="username" id="username" placeholder="Ex : example@gmail.com" class="form-control shadow-sm">
				</div>
				<div class="form-group">
					<label for="password">Password<sup class="text-danger">*</sup></label>
					<input type="password" name="password" id="password" required="required" placeholder="Ex : ******" class="form-control shadow-sm">
				</div>
				<div class="form-group">
					<label for="mobile">Mobile<sup class="text-danger">*</sup></label>
					<input type="text" name="mobile" id="mobile" required="required" placeholder="Ex : +91-9011294222" class="form-control shadow-sm">
				</div>
				<div class="form-group">
					<label for="address">Address<sup class="text-danger">*</sup></label>
					<textarea name="address" id="address" class="form-control shadow-sm" required="required"></textarea>
				</div>
				<div class="form-group">
					<label for="state">State<sup class="text-danger">*</sup></label>
					<input type="text" name="state" id="state" required="required" placeholder="Ex : West Bengal" class="form-control shadow-sm">
				</div>
				<div class="form-group">
					<label for="country">Country<sup class="text-danger">*</sup></label>
					<input type="text" name="country" id="country" required="required" placeholder="Ex : India" class="form-control shadow-sm">
				</div>
				<div class="form-group">
					<label for="pincode">Pincode<sup class="text-danger">*</sup></label>
					<input type="text" name="pincode" id="pincode" required="required" placeholder="Ex : 734001" class="form-control shadow-sm">
				</div>

				<button class="btn btn-dark shadow-sm py-2 register-btn w-100 my-3 font-weight-bold" type="submit" style="font-family: Raleway;">Create Account</button>
				<span class="d-block text-center">Already have an account? <a href="http://localhost/bom/php/eshop/signin.php">Login</a></span>
			</form>
			<form class="otp-form shadow-lg rounded p-4 d-none" style="font-family: 'Cardo', serif;">
				<h2 style="font-family: Raleway">Verify OTP</h2>
				<hr>
				<div class="form-group">
					<div class="input-group">
						<input type="number" name="otp" required="required" placeholder="type your OTP here" class="form-control border-dark otp shadow-sm">
						<div class="input-group-append">
							<span class="input-group-text bg-dark border-dark text-white verify-otp-btn">Verify</span>
						</div>
					</div>
					<span class="d-block float-right mt-3 btn btn-danger shadow-sm resend-otp-btn">Resend OTP</span>
				</div>
			</form>
			<div class="alert alert-warning w-75 mt-4 shadow-sm signup-notice-box d-none"></div>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>

<!-- start footer coding -->


<!-- end footer coding -->


<script type="text/javascript">
	$(document).ready(function(){
		$(".signup-form").submit(function(event){
			event.preventDefault();
			$(".register-btn").attr("disabled","disabled");
			$.ajax({
				type : "POST",
				url : "pages/php/register.php",
				data : new FormData(this),
				processData : false,
				contentType : false,
				cache : false,
				beforeSend : function(){
					$(".register-btn").html("Please wait...");
				},
				success : function(response){
					if(response.trim() == "success"){
						$(".register-btn").html("Register");
						$(".signup-form").addClass("d-none");
						$(".otp-form").removeClass("d-none");

						//verify otp coding

						$(".verify-otp-btn").click(function(){
							$.ajax({
								type : "POST",
								url : "pages/php/verify_otp.php",
								data : {
									otp : $(".otp").val().trim(),
									email : $("#username").val()
								},
								beforeSend : function(){
									$(".verify-otp-btn").html("Please wait...");
								},
								success : function(response){
									if(response.trim() == "update success"){
										window.location = "signin.php";
									}
									else{
										$(".signup-notice-box").removeClass("d-none");
										$(".signup-notice-box").html("<b>"+response+"</b>");
										setTimeout(function(){
											$(".signup-notice-box").addClass("d-none");
										},3000);
									}
								}
							});
						});

						//resend otp coding

						$(".resend-otp-btn").click(function(){
							$.ajax({
								type : "POST",
								url : "pages/php/resend_otp.php",
								data : {
									mobile : $("#mobile").val()
								},
								beforeSend : function(){
									$(".resend-otp-btn").html("Please wait...");
								},
								success : function(response){
									if(response.trim() == "success"){
										$(".signup-notice-box").removeClass("d-none");
										$(".signup-notice-box").html("<b>resend OTP successful...</b>");
										setTimeout(function(){
											$(".signup-notice-box").addClass("d-none");
										},3000);
									}
								}
							});
						});

					}
					else{
						$(".signup-notice-box").removeClass("d-none");
						$(".signup-notice-box").html("<b>"+response+"</b>");
						setTimeout(function(){
							$(".signup-notice-box").addClass("d-none");
							$(".signup-form").trigger("reset");
							$(".register-btn").attr("disabled",false);
							$(".register-btn").html("Create Account");
						},3000);
					}
				}
			});
		});
	});

</script>
</body>
</html>

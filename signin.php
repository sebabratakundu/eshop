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
			<form class="signin-form p-4 w-75 rounded shadow-lg bg-white" style="font-family: 'Cardo', serif;">
				<h2 style="font-family: Raleway;" class="text-center text-uppercase font-weight-bold text-dark">Sign In</h2>
				<hr>
				<div class="form-group">
					<label for="username">Username<sup class="text-danger">*</sup></label>
					<input type="email" name="username" id="username" placeholder="Ex : example@gmail.com" required="required" class="form-control shadow-sm">
				</div>
				<div class="form-group">
					<label for="password">Password<sup class="text-danger">*</sup></label>
					<input type="password" name="password" id="password" placeholder="Ex : ******" required="required" class="form-control shadow-sm">
				</div>
				<a href="http://localhost/bom/php/eshop/pages/php/forgot_password.php">Forgot password?</a>
				<button class="btn btn-success shadow-sm signin-btn w-100 my-3 py-2 font-weight-bold" type="submit" style="font-family: Raleway;">Sign in</button>
				<span class="d-block text-center">Not resgistred? <a href="http://localhost/bom/php/eshop/signup.php">Create an account!</a></span>
			</form>
			<form class="otp-form shadow-lg rounded p-4 d-none" style="font-family: 'Cardo', serif;">
				<h2 style="font-family: Raleway">Verify OTP</h2>
				<hr>
				<div class="form-group">
					<div class="input-group">
						<input type="number" name="otp" required="required" placeholder="type your OTP here" class="form-control otp shadow-sm border-right-0">
						<div class="input-group-append">
							<button class="input-group-text bg-dark border-dark text-white verify-otp-btn">Verify</button>
						</div>
					</div>
					<span class="d-block float-right mt-3 btn btn-danger shadow-sm resend-otp-btn">Resend OTP</span>
				</div>
			</form>
			<div class="alert alert-warning w-75 mt-4 shadow-sm signin-notice-box d-none"></div>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>

<!-- start footer coding -->

<!-- end footer coding -->


<script type="text/javascript">

	//sign in coding
	$(document).ready(function(){
		$(".signin-form").submit(function(event){
			event.preventDefault();
			$.ajax({
				type : "POST",
				url : "pages/php/login.php",
				data : new FormData(this),
				processData : false,
				contentType : false,
				cache : false,
				beforeSend : function(){
					$(".signin-btn").html("Please wait...");
					$(".signin-btn").attr("disabled","disabled");
				},
				success : function(response){
					if(response.trim() == "pending"){
						$(".signin-btn").html("Sign in");
						$(".signin-form").addClass("d-none");
						$(".otp-form").removeClass("d-none");
						$(".signin-notice-box").removeClass("d-none");
						$(".signin-notice-box").html("<b>Please verify your account</b>");
						setTimeout(function(){
							$(".signin-notice-box").addClass("d-none");
						},3000);

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
									$(".verify-otp-btn").attr("disabled","disabled");
								},
								success : function(response){
									if(response.trim() == "update success"){
										$(".signin-notice-box").removeClass("d-none alert-warning");
										$(".signin-notice-box").addClass("alert-success");
										$(".signin-notice-box").html("<b>Mobile number varified. Please login</b>");
										setTimeout(function(){
											$(".signin-notice-box").addClass("d-none");
											$(".verify-otp-btn").html("Verify");
											$(".verify-otp-btn").removeAttr("disabled");
											$(".otp-form").trigger("reset");
											window.location = "signin.php";
										},3000);
									}
									else{
										$(".signin-notice-box").removeClass("d-none");
										$(".signin-notice-box").html("<b>"+response+"</b>");
										setTimeout(function(){
											$(".signin-notice-box").addClass("d-none");
											$(".verify-otp-btn").html("Verify");
											$(".verify-otp-btn").removeAttr("disabled");
											$(".otp-form").trigger("reset");
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
									mobile : $("#username").val()
								},
								beforeSend : function(){
									$(".resend-otp-btn").html("Please wait...");
								},
								success : function(response){
									if(response.trim() == "success"){
										$(".signin-notice-box").removeClass("d-none");
										$(".signin-notice-box").html("<b>resend OTP successful...</b>");
										setTimeout(function(){
											$(".signin-notice-box").addClass("d-none");
										},3000);
									}
								}
							});
						});
					}
					else if(response.trim() == "login success"){
						window.location = "index.php";
					}
					else{
						$(".signin-notice-box").removeClass("d-none");
						$(".signin-notice-box").html("<b>"+response+"</b>");
						setTimeout(function(){
							$(".signin-notice-box").addClass("d-none");
							$(".signin-btn").html("Sign in");
							$(".signin-btn").removeAttr("disabled");
							$(".signin-form").trigger("reset");
						},3000);
					}
				}
			});
		});
	});
</script>
</body>
</html>

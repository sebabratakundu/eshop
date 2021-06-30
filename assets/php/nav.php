<?php
	//start branding details retriving coding
	$branding_details = "";
	$cart_item_count = "";
	$get_branding_details = "SELECT * FROM branding";
	$details_response = $db -> query($get_branding_details);
	if($details_response -> num_rows != 0){
		$branding_details = $details_response -> fetch_assoc();
	}

	$user_or_sign = "";
	session_start();
	if(empty($_COOKIE["_ua_"])){
		$user_or_sign = '<a href="'.$root.'/signup.php" class="dropdown-item p-0 text-center"><i class="fa fa-user-circle-o text-warning" style="font-size:20px"></i><span class="text-white px-2">Sign Up</span></a><hr>
	  <a href="'.$root.'/signin.php" class="dropdown-item p-0 text-center"><i class="fa fa-sign-in text-info" style="font-size:20px"></i><span class="text-white px-2">Sign In</span></a>';
	}
	else{
		$username = base64_decode($_COOKIE["_ua_"]);
		$get_user_data = "SELECT * FROM users WHERE email = '$username'";
		$user_response = $db -> query($get_user_data);
		if($user_response){
			$user_data = $user_response -> fetch_assoc();
			$fullname = $user_data["firstname"]." ".$user_data["lastname"];
			$_SESSION["fullname"] = $fullname;
			$_SESSION["mobile"] = $user_data["mobile"];
			$_SESSION["pincode"] = $user_data["pincode"];
		}
		$user_or_sign = '<a href="'.$root.'/profile" class="dropdown-item p-0"><i class="fa fa-user-circle-o text-info" style="font-size:20px;"></i><span class="text-white px-2">'.$fullname.'</span></a><hr>
		<a href="'.$root.'/pages/php/sign_out.php" class="dropdown-item text-center p-0 text-uppercase font-weight-bold"><i class="fa fa-sign-out" style="font-size:20px;color:#E83350;"></i><span class="text-white px-2">Sign Out</span></a>';
		$get_cart_item = "SELECT COUNT(id) AS result FROM cart WHERE username='$username'";
		$cart_response = $db -> query($get_cart_item);
		if($cart_response){
			$cart_data = $cart_response -> fetch_assoc();
			$result = $cart_data['result'];
			if($result != 0){
				$cart_item_count = '<div class="text-center text-white cart-item-count-box" style="position:absolute; width: 20px;height:20px;border-radius: 50%;z-index: 1000;left:35px;top:-5px;background:#E83350">
						<span style="display:block;font-weight: bold;font-size:13px;">'.$cart_data['result'].'</span></div>';
			}
		}
	}

?>

<style>
.dropdown-item:hover{
  background:inherit;
}
</style>
<div>
	<nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top" style="padding-left:10%; padding-right: 10%;">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="#menu" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  	</button>
		<div class="collapse navbar-collapse" id="menu">
			<a href="<?= $root; ?>/index.php" class="navbar-brand mb-0 h1 text-uppercase">
				<?php
					if(isset($branding_details["brand_logo"]) && isset($branding_details["brand_name"])){
						$brand_logo_encoded_string = base64_encode($branding_details["brand_logo"]);
						$complete_src = "data:image/png;base64,".$brand_logo_encoded_string;
						echo "<img src='".$complete_src."' width='40'> "; 
						echo $branding_details["brand_name"]; 
					}
					else{
						echo "<img src='".$root."/common_files/images/brand_logo.png' width='40'> "; 
						echo "DEMO SITE"; 
					}
				?>	
				</a>
			<ul class="nav navbar-nav">
				<?php

					$get_caterogy = "SELECT category_name FROM category";
					$category_obj = $db -> query($get_caterogy);
					if($category_obj){
						while ($categories = $category_obj -> fetch_assoc()) {
							echo "<li class='nav-item'><a href='".$root."/products/".$categories['category_name']."' class='nav-link'>".$categories['category_name']."</a></li>";
						}
					}
				?>
			</ul>
		</div>
		<ul class="nav navbar-nav navbar-right d-flex flex-row align-items-center">
			<input type="search" name="search-product" autocomplete="off" class="form-control float-left mr-2 d-none d-lg-block search-product" placeholder="search product here" style="width:350px;">
			<li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-search search-icon d-none d-lg-block" style="font-size:20px"></i></a></li>
			<li class="nav-item">
				<a href="'.$root.'/cart" class="nav-link cart-item-link" style="position:relative;">
					<?php
						echo $cart_item_count;
					?>
					<i class="fa fa-shopping-cart mx-3" style="font-size:20px">
					</i>
				</a>
			</li>
			<li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user-circle-o" style="font-size:20px"></i></a>
	        <div class="dropdown-menu bg-dark p-3">
	          <?php
	          	echo $user_or_sign;
	          ?>
	        </div>
	      </li>
	      <div class="position-absolute search-hint-box bg-white rounded shadow-sm" style="width:350px;z-index: 5000;top:70px;"></div>
		</ul>
	</nav>
</div>
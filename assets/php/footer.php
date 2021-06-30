<div class="container-fluid p-4" style="background: #E83350;margin-top: 100px;">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="input-group">
					<input type="email" name="subscribe" placeholder="Ex : example@gmail.com" id="subscribe" class="form-control border-0">
					<div class="input-group-append">
						<span class="btn btn-dark input-group-btn border-0 subscribe-btn" style="cursor: pointer;">Subscribe</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 p-3"></div>
			<div class="col-md-3 d-flex justify-content-between align-items-center text-white">
				<i class="fa fa-facebook" style="font-size:20px;"></i>
				<i class="fa fa-twitter" style="font-size:20px;"></i>
				<i class="fa fa-google" style="font-size:20px;"></i>
				<i class="fa fa-instagram" style="font-size:20px;"></i>
				<i class="fa fa-pinterest" style="font-size:20px;"></i>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid bg-dark p-5">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h5 class="text-white">CATEGORY</h5>
					<?php

					$get_caterogy = "SELECT category_name FROM category";
					$category_obj = $db -> query($get_caterogy);
					if($category_obj){
						while ($categories = $category_obj -> fetch_assoc()) {
							echo "<a href='".$root."/products/".$categories['category_name']."'' class='d-block py-2' style='color:#E83350'>".$categories['category_name']."</a>";
						}
					}
				?>
			</div>
			<div class="col-md-4">
				<h5 class="text-white">POLICIES</h5>
				<a href="<?= $root;?>/privacy.php" class="d-block py-2" style='color:#E83350'>Privacy policy</a>
				<a href="<?= $root;?>/cookies.php" class="d-block py-2" style='color:#E83350'>Cookies policy</a>
				<a href="<?= $root;?>/terms.php" class="d-block py-2" style='color:#E83350'>Terms & Conditions</a>
			</div>
			<div class="col-md-4">
				<h5 class="text-white">CONTACT</h5>
				<address style="color:#CCCECF">
					<p>Venue : <?php echo $branding_details["address"]; ?></p>
					<p>Call : <?php echo $branding_details["phone"]; ?></p>
					<p>Email : <?php echo $branding_details["email"]; ?></p>
					<p>Website : <?php echo $branding_details["domain_name"]; ?></p>
				</address>
			</div>
		</div>
	</div>
</div>
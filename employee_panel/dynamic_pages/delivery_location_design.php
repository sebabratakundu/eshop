<?php 
require_once("../../common_files/php/database.php");
echo '<div class="row p-5">
				<div class="col-md-3"></div>
				<div class="col-md-6 bg-light rounded shadow-sm p-4">
					<h4 class="font-monsserat">SET DELIVERY LOCATION</h4>
					<hr>
					<form class="set-location-form">
					<select name="country" class="form-control mb-3 border-blue shadow-sm choose-country" required="required">
						<option>Choose Country</option>'; ?>
						<?php
							//get countries
							$get_countries = "SELECT * FROM countries";
							$countries_response = $db -> query($get_countries);
							if($countries_response){
								while($countries = $countries_response->fetch_assoc()){
									echo "<option country-id='".$countries["id"]."'>".$countries["name"]."</option>";
								}
							}
						?>
					<?php echo '</select>
					<select name="state" class="form-control mb-3 border-blue shadow-sm choose-state" required="required">
						<option>Choose State</option>
					</select>
					<select name="city" class="form-control mb-3 border-blue shadow-sm choose-city" required="required">
						<option>Choose City</option>
					</select>
					<input type="number" name="pincode" class="form-control border-blue shadow-sm mb-3" required="required" placeholder="Pincode" id="pincode">
					<input type="text" name="delivery-text" class="form-control border-blue shadow-sm mb-3" required="required" placeholder="Delivery within 5 to 10 days">
					<select name="payment-mode" class="form-control mb-3 border-blue shadow-sm" required="required">
						<option>Choose payment mode</option>
						<option>All</option>
						<option>Online</option>
					</select>
					<button class="btn btn-dark shadow-sm">Set Location</button>
				</form>
				</div>
				<div class="col-md-3"></div>
			</div>'; 
			?>
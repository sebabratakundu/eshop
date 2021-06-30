<?php

echo '<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8 p-5">
					<div class="bg-light rounded shadow-sm p-4">
						<h4 class="font-monsserat">BRANDING DETAILS</h4>
						<hr>
						<button class="btn close edit-branding-btn"><i class="fa fa-edit"></i>Edit</button>
						<form class="branding-form" enctype="multipart/form-data">
							<div class="form-group">
								<label for="brand-name" class="h6">Brand Name</label>
								<input type="text" name="brand-name" id="brand-name" placeholder="Enter your brand name" class="form-control border-0 border-blue">
							</div>
							<div class="form-group">
								<label for="choose-brand-logo" class="h6">Brand Logo</label>
								<div class="custom-file">
								<input type="file" class="custom-file-input" name="upload-logo" id="choose-brand-logo">
								<label class="custom-file-label" for="choose-brand-logo">Choose file</label>
								</div>
							</div>
							<div class="form-group">
								<label for="Domain-name" class="h6">Domain Name</label>
								<input type="text" name="domain-name" id="domain-name" class="form-control border-0 border-blue" placeholder="Ex : www.example.com">
							</div>
							<div class="form-group">
								<label for="email" class="h6">Email</label>
								<input type="email" name="email" id="email" class="form-control border-0 border-blue" placeholder="Ex : example@gmai.com">
							</div>
							<div class="form-group">
								<label for="social-media" class="h6">Social Handles</label>
								<input type="text" name="facebook" id="social-media" class="form-control border-0 border-blue mb-3" placeholder="Facebook page url">
								<input type="text" name="twitter" id="twitter" class="form-control border-0 border-blue" placeholder="Twitter page url">
							</div>
							<div class="form-group">
								<label for="address" class="h6">Address</label>
								<textarea id="address" name="address" class="form-control border-blue border-0"></textarea>
							</div>
							<div class="form-group">
								<label for="phone" class="h6">Phone</label>
								<input type="number" name="phone" id="phone" class="form-control border-0 border-blue" placeholder="Ex : 1800 1200 1931">
							</div>
							<div class="form-group">
								<label for="about-us" class="h6">About Us
									<small class="about-us-count"> 0</small>
									<small> / 5000</small>
								</label>
								<textarea id="about-us" name="about-us" rows="20" maxlength="5000" class="form-control border-blue border-0"></textarea>
							</div>
							<div class="form-group">
								<label for="privacy-policy" class="h6">Privacy Policy
									<small class="privacy-count"> 0</small>
									<small> / 5000</small>
								</label>
								<textarea id="privacy-policy" name="privacy-policy" rows="20" class="form-control border-blue border-0"></textarea>
							</div>
							<div class="form-group">
								<label for="cookies-policy" class="h6">Cookies Policy
									<small class="cookie-count"> 0</small>
									<small> / 5000</small>
								</label>
								<textarea id="cookies-policy" name="cookies-policy" rows="20" class="form-control border-blue border-0"></textarea>
							</div>
							<div class="form-group">
								<label for="terms-and-conditions" class="h6">Terms and Conditions
									<small class="terms-count"> 0</small>
									<small> / 5000</small>
								</label>
								<textarea id="terms-and-conditions" name="terms-and-conditions" rows="20" class="form-control border-blue border-0"></textarea>
							</div>

							<button class="btn btn-danger" type="submit">Submit</button>
						</form>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
			<div class="progress bg-light shadow-sm d-none">
				<div class="progress-bar bg-dark progress-bar-striped progress-bar-animated"></div>
			</div>
			';

?>
<?php
echo '<div class="row p-5">
				<div class="col-md-12 bg-light p-4 rounded shadow-sm">
					<h5 class="font-monsserat">CREATE PRODUCT
					<i class="fa fa-circle-o-notch fa-spin close product-loader d-none" style="font-size:15px"></i>
					</h5>
					<hr>
					<form class="product-form" enctype="multipart/form-data">
						<div class="row my-3">
							<div class="col-md-6">
								<input type="text" name="product-name" class="form-control border-0 border-blue" placeholder="Product name" required="required">
							</div>
							<div class="col-md-3 my-lg-0 my-2"></div>
							<div class="col-md-3">
								<select class="form-control border-0 border-blue" name="select-brand" id="select-brand" required="required">
									<option>Choose brand</option>';
									require("../../common_files/php/database.php");
									$get_brands = "SELECT * FROM brands";
									$brand_obj = $db -> query($get_brands);
									if($brand_obj -> num_rows != 0){
										while($brands = $brand_obj -> fetch_assoc()){
											echo "<option cat-name='".$brands['category']."'>".$brands['brand_name']."</option>";
										}
									}

							echo '</select>
							</div>
						</div>
						<div class="row ">
							<div class="col-md-12">
								<h6>DESCRIPTION</h6>
								<textarea class="form-control border-0 border-blue" name="description" id="description" rows="6" required="required"></textarea>
							</div>
						</div>
						<div class="row my-3">
							<div class="col-md-6 my-lg-0 my-2">
								<h6>PRICE</h6>
								<input type="number" name="price" id="price" placeholder="Enter price" class="form-control border-0 border-blue" required="required">
							</div>
							<div class="col-md-6">
								<h6>QUANTITY</h6>
								<input type="number" name="qty" id="qty" placeholder="Enter quantity" class="form-control border-0 border-blue" required="required">
							</div>
						</div>
						<div>
							<h6>UPLOAD PHOTO</h6>
							<div class="d-flex mb-3 justify-content-center align-items-center justify-content-lg-around flex-lg-row flex-column">
							<div style="width:80px;height:100px" class="rounded shadow-sm text-center bg-dark text-light p-3 upload-box my-2">
									<i class="fa fa-camera mb-1" style="font-size:30px"></i>
									<h6>Thumb</h6>
									<p style="font-size:12px">250*316</p>
									<input type="file" name="thumb" id="thumb" class="upload-input" required="required"> 
								</div>

							<div style="width:80px;height:100px" class="rounded shadow-sm text-center bg-dark text-light p-3 upload-box my-2">
									<i class="fa fa-camera mb-1" style="font-size:30px"></i>
									<h6>Front</h6>
									<p style="font-size:12px">350*615</p>
									<input type="file" name="front" id="front" class="upload-input" required="required"> 
								</div>

							<div style="width:80px;height:100px" class="rounded shadow-sm text-center bg-dark text-light p-3 upload-box">
									<i class="fa fa-camera mb-1" style="font-size:30px"></i>
									<h6>Back</h6>
									<p style="font-size:12px">350*615</p>
									<input type="file" name="back" id="front" class="upload-input" required="required"> 
								</div>
								
							<div style="width:80px;height:100px" class="rounded shadow-sm text-center bg-dark text-light p-3 upload-box my-2">
									<i class="fa fa-camera mb-1" style="font-size:30px"></i>
									<h6>Left</h6>
									<p style="font-size:12px">350*615</p>
									<input type="file" name="left" id="left" class="upload-input" required="required"> 
								</div>
								
							<div style="width:80px;height:100px" class="rounded shadow-sm text-center bg-dark text-light p-3 upload-box my-2">
									<i class="fa fa-camera mb-1" style="font-size:30px"></i>
									<h6>Right</h6>
									<p style="font-size:12px">350*615</p>
									<input type="file" name="right" id="right" class="upload-input" required="required"> 
								</div>			
						</div>
						</div>
							<div class="progress mt-3 w-75 float-left d-none product-progress">
								<div class="progress-bar progress-bar-striped progress-bar-animated"></div>
							</div>
							<div>
								<button class="btn btn-danger float-right">Create</button>
							</div>
					</form>
					<div class="product-notice-box"></div>
				</div>
			</div>
			<div class="progress bg-light shadow-sm d-none">
				<div class="progress-bar bg-dark progress-bar-striped progress-bar-animated"></div>
			</div>
			';

?>
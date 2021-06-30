<?php
	require_once("../../common_files/php/database.php");

	echo 	'<div class="row">
				<div class="col-md-6 p-5">
					<div class="bg-light shadow-sm rounded p-4">
						<h4 class="font-monsserat">KEYWORDS PLANNER FOR CATEGORY</h4>
						<hr>
						<form class="keyword-form">
							<div class="form-group">
								<label for="p-keyword" class="h6">Primary Keyword</label>
								<select name="p-keyword" id="p-keyword" class="form-control border-blue">
									<option>Choose primary keyword</option>' ;?>
									<?php
										// get category as a primary keyword

										$get_category = "SELECT * FROM category";
										$category_response = $db -> query($get_category);
										if($category_response){
											while($category_data = $category_response -> fetch_assoc()){
												echo "<option>".$category_data['category_name']."</option>";
											}
										}

									?>
							<?php		
								echo '</select>
							</div>
							<div class="form-group">
								<label for="s-keyword" class="h6">Secondary Keyword</label>
								<textarea name="s-keyword" id="s-keyword" required="required" class="form-control border-blue"></textarea>
							</div>
							<div class="form-group">
								<button class="btn btn-dark shadow-sm update-keyword-btn" type="submit">Update</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-6 p-5">
					<div class="bg-light shadow-sm rounded p-4">
						<div class="d-flex align-items-center">
							<h4 class="font-monsserat mr-2">FAILED KEYWORDS :</h4>
							<button class="btn btn-dark">';?>
								<?php

									$count = 0;
									$all_failed_keywords = [];
									$get_failed_keyword = "SELECT * FROM failed_keyword";
									$failed_keyword_response = $db -> query($get_failed_keyword);
									if($failed_keyword_response){
										while($failed_keyword_data = $failed_keyword_response -> fetch_assoc()){
											$count ++;
											array_push($all_failed_keywords, $failed_keyword_data["failed_keyword"]);
										}
										echo $count;
									}
									else{
										echo "0";
									}
								?>
							<?php	
							echo '</button>
						</div>
						<hr>
						<div class="d-flex rounded p-3 flex-wrap shadow-sm border mb-3 failed-keyword-box">'?>
							<?php
								for($i=0;$i<count($all_failed_keywords);$i++){
									echo "<div class='alert alert-danger mr-2 failed-keyword'>".$all_failed_keywords[$i]." &nbsp;<i class='fa fa-times-circle' data-dismiss='alert'></i></div>";
								}

							?>
						<?php
							
						echo '</div>
						<button class="btn btn-primary shadow-sm failed-cat-keyword-btn w-100 mb-3"><i class="fa fa-copy mr-2"></i> Copy to category clipboard</button>
						<button class="btn btn-primary shadow-sm failed-brand-keyword-btn w-100 mb-3"><i class="fa fa-copy mr-2"></i> Copy to brand clipboard</button>
						<button class="btn btn-primary shadow-sm failed-product-keyword-btn w-100 mb-3"><i class="fa fa-copy mr-2"></i> Copy to product clipboard</button>
						<button class="btn btn-danger shadow-sm delete-updated-keyword-btn w-100 mb-3"><i class="fa fa-trash mr-2"></i>Delete updated keywords</button>
					</div>
				</div>
			</div>
			<div class="row">		
				<div class="col-md-6 px-5 pb-5">
					<div class="bg-light shadow-sm rounded p-4">
						<h4 class="font-monsserat">KEYWORDS PLANNER FOR BRANDS</h4>
						<hr>
						<form class="brand-keyword-form">
							<div class="form-group">
								<label for="brand-category" class="h6">Category</label>
								<select name="brand-category" id="brand-category" class="form-control border-blue">
									<option>Choose category</option>';?>
									<?php
										// get category as a primary keyword

										$get_category = "SELECT * FROM category";
										$category_response = $db -> query($get_category);
										if($category_response){
											while($category_data = $category_response -> fetch_assoc()){
												echo "<option>".$category_data['category_name']."</option>";
											}
										}

									?>
								<?php	
								echo '</select>
							</div>
							<div class="form-group">
								<label for="brand-p-keyword" class="h6">Primary Keyword</label>
								<select name="p-keyword" id="brand-p-keyword" class="form-control border-blue">
									<option>Choose primary keyword</option>
								</select>
							</div>
							<div class="form-group">
								<label for="brand-s-keyword" class="h6">Secondary Keyword</label>
								<textarea name="s-keyword" id="brand-s-keyword" required="required" class="form-control border-blue"></textarea>
							</div>
							<div class="form-group">
								<button class="btn btn-dark shadow-sm update-brand-keyword-btn" type="submit">Update</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-6 p-5">
				</div>
			</div>
			<div class="row">		
				<div class="col-md-6 px-5 pb-5">
					<div class="bg-light shadow-sm rounded p-4">
						<h4 class="font-monsserat">KEYWORDS PLANNER FOR PRODUCTS</h4>
						<hr>
						<form class="product-keyword-form">
							<div class="form-group">
								<label for="product-category" class="h6">Category</label>
								<select name="product-category" id="product-category" class="form-control border-blue">
									<option>Choose category</option>';?>
									<?php
										// get category as a primary keyword

										$get_category = "SELECT * FROM category";
										$category_response = $db -> query($get_category);
										if($category_response){
											while($category_data = $category_response -> fetch_assoc()){
												echo "<option>".$category_data['category_name']."</option>";
											}
										}

									?>
								<?php	
								echo '</select>
							</div>
							<div class="form-group">
								<label for="product-brand" class="h6">Brand</label>
								<select name="product-brand" id="product-brand" class="form-control border-blue">
									<option>Choose brand</option>
								</select>
							</div>
							<div class="form-group">
								<label for="product-p-keyword">Primary Keyword</label>
								<select name="product-p-keyword" id="product-p-keyword" class="form-control border-blue">
									<option>Choose primary keyword</option>
								</select>
							</div>
							<div class="form-group">
								<label for="product-s-keyword" class="h6">Secondary Keyword</label>
								<textarea name="s-keyword" id="product-s-keyword" required="required" class="form-control border-blue"></textarea>
							</div>
							<div class="form-group">
								<button class="btn btn-dark shadow-sm update-product-keyword-btn" type="submit">Update</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-6 p-5">
				</div>
			</div>';?>
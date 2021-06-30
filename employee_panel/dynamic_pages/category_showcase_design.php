				<?php

					require_once("../../common_files/php/database.php");
					echo '<div class="row p-4">';
					$get_category_showcase = "SELECT * FROM category_showcase";
					$category_showcase_response = $db -> query($get_category_showcase);
					$top_left_pic = "../common_files/images/small_sample.jpg";
					$top_left_label = "";
					$bottom_left_pic = "../common_files/images/small_sample.jpg";
					$bottom_left_label = "";
					$center_pic = "../common_files/images/large_sample.jpg";
					$center_label = "";
					$top_right_pic = "../common_files/images/small_sample.jpg";
					$top_right_label = "";
					$bottom_right_pic = "../common_files/images/small_sample.jpg";
					$bottom_right_label = "";
					if($category_showcase_response){
						if($category_showcase_response -> num_rows !=0){
							while($category_showcase_data = $category_showcase_response -> fetch_assoc()){
								$img = "data:image/png;base64,".base64_encode($category_showcase_data["image"]);
								if($category_showcase_data["direction"] == "top-left"){
									$top_left_pic = $img;
									$top_left_label = $category_showcase_data["lable"];
								}
								else if($category_showcase_data["direction"] == "bottom-left"){
									$bottom_left_pic = $img;
									$bottom_left_label = $category_showcase_data["lable"];
								}
								else if($category_showcase_data["direction"] == "center"){
									$center_pic = $img;
									$center_label = $category_showcase_data["lable"];
								}
								else if($category_showcase_data["direction"] == "top-right"){
									$top_right_pic = $img;
									$top_right_label = $category_showcase_data["lable"];
								}
								else{
									$bottom_right_pic = $img;
									$bottom_right_label = $category_showcase_data["lable"];
								}
							}
						}
					}

				?>

				<?php
				echo '<div class="col-md-4">
					<div class="position-relative">
						<div class="btn-group position-absolute shadow-sm border w-100">
							<button class="btn btn-dark position-relative">
								<input type="file" name="choose-image" accept="image/*" class="form-control border-danger position-absolute h-100 upload-btn" style="top:0;left: 0; opacity: 0;">
								<i class="fa fa-upload"></i>
							</button>
							<button class="btn"><input type="text" name="top-left-image" value="';?><?php echo $top_left_label;?><?php echo'" placeholder="Mobile" class="form-control image-name"></button>
							<button class="btn btn-dark set-btn" disabled="disabled">SET</button>
						</div>
						<img src="';?><?php echo $top_left_pic;?><?php echo '" alt="small sample" img-pos = "top-left" class="w-100 mb-3">
					</div>
					<div class="position-relative">
						<div class="btn-group position-absolute shadow-sm border w-100">
							<button class="btn btn-dark position-relative">
								<input type="file" name="choose-image" accept="image/*" class="form-control border-danger position-absolute h-100 upload-btn" style="top:0;left: 0; opacity: 0;">
								<i class="fa fa-upload"></i>
							</button>
							<button class="btn"><input type="text" name="bottom-left-image" value="';?><?php echo $bottom_left_label;?><?php echo '" placeholder="Mobile" class="form-control image-name"></button>
							<button class="btn btn-dark set-btn" disabled="disabled">SET</button>
						</div>
						<img src="';?><?php echo $bottom_left_pic;?><?php echo '" alt="small sample" img-pos = "bottom-left" class="w-100 mb-3">
					</div>
				</div>
				<div class="col-md-4">
					<div class="position-relative">
						<div class="btn-group position-absolute shadow-sm border w-100">
							<button class="btn btn-dark position-relative">
								<input type="file" name="choose-image" accept="image/*" class="form-control border-danger position-absolute h-100 upload-btn" style="top:0;left: 0; opacity: 0;">
								<i class="fa fa-upload"></i>
							</button>
							<button class="btn"><input type="text" name="center-image" value="';?><?php echo $center_label;?><?php echo '" placeholder="Mobile" class="form-control image-name"></button>
							<button class="btn btn-dark set-btn" disabled="disabled">SET</button>
						</div>
						<img src="';?><?php echo $center_pic;?><?php echo '" alt="large sample" img-pos="center" class="w-100">
					</div>
				</div>
				<div class="col-md-4">
					<div class="position-relative">
						<div class="btn-group position-absolute shadow-sm border w-100">
							<button class="btn btn-dark position-relative">
								<input type="file" name="choose-image" accept="image/*" class="form-control border-danger position-absolute h-100 upload-btn" style="top:0;left: 0; opacity: 0;">
								<i class="fa fa-upload"></i>
							</button>
							<button class="btn"><input type="text" name="top-right-image" value="';?><?php echo $top_right_label;?><?php echo '" placeholder="Mobile" class="form-control image-name"></button>
							<button class="btn btn-dark set-btn" disabled="disabled">SET</button>
						</div>
						<img src="';?><?php echo $top_right_pic;?><?php echo '" alt="small sample" img-pos = "top-right" class="w-100 mb-3">
					</div>
					<div class="position-relative">
						<div class="btn-group position-absolute shadow-sm border w-100">
							<button class="btn btn-dark position-relative">
								<input type="file" name="choose-image" accept="image/*" class="form-control border-danger position-absolute h-100 upload-btn" style="top:0;left: 0; opacity: 0;">
								<i class="fa fa-upload"></i>
							</button>
							<button class="btn"><input type="text" name="bottom-right-image" value="';?><?php echo $bottom_right_label;?><?php echo '" placeholder="Mobile" class="form-control image-name"></button>
							<button class="btn btn-dark set-btn" disabled="disabled">SET</button>
						</div>
						<img src="';?><?php echo $bottom_right_pic;?><?php echo '" alt="small sample" img-pos = "bottom-right" class="w-100 mb-3">
					</div>
				</div>
			</div>';
			?>